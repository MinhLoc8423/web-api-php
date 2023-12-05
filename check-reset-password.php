<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// http://127.0.0.1:8686/check-reset-password.php
// đọc email và token từ body
include_once './connection.php';
try {
    $data = json_decode(file_get_contents("php://input"));
    $email = $data->email;
    $token = $data->token;
    // kiểm tra email và token có trong db hay không
    $sqlQuery = "SELECT * FROM password_resets WHERE 
                        email = '$email' AND token = '$token' 
                        AND created_at >= NOW() - INTERVAL 24 HOUR 
                        AND available = 1";
    $stmt = $dbConn->prepare($sqlQuery);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        echo json_encode(array(
            'status' => true,
            'message' => 'Token is valid'
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