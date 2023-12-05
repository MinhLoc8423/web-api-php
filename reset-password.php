<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// http://127.0.0.1:8686/reset-password.php
// đọc email và token, password, password_confimation từ body

try {
    include_once './connection.php';
    $data = json_decode(file_get_contents("php://input"));
    $email = $data->email;
    $token = $data->token;
    $password = $data->password;
    $password_confirmation = $data->password_confirmation;
    // kiểm tra email và token có trong db không
    $sqlQuery = "SELECT * FROM password_resets WHERE 
                        email = '$email' AND token = '$token' 
                        AND created_at >= NOW() - INTERVAL 24 HOUR 
                        AND available = 1";
    $stmt = $dbConn->prepare($sqlQuery);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        // cập nhật mật khẩu vào bảng user
        $query = "update users set password = '$password' where email = '$email' ";
        $stmt = $dbConn->prepare($query);
        $stmt->execute();
        // cập nhật available = 0 trong bảng password_resets
        $query = "update password_resets set available = 0 where email = '$email' ";
        $stmt = $dbConn->prepare($query);
        $stmt->execute();
        echo json_encode(array(
            "status" => true,
            "message" => "Password reset successfully"
        ));
    }else{
        echo json_encode(array(
            'status' => false,
            'message' => 'Token is invalid'
        ));
    }
} catch (Exception $th) {
    echo json_encode(array(
        'status' => false,
        'error' => $th->getMessage()
    ));
}