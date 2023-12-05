<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// http://127.0.0.1:8686/register.php
include_once './connection.php';
try {
    $data = json_decode(file_get_contents("php://input"));
    $email = $data->email;
    $password = $data->password;
    $password_confirm = $data->password_confirm;
    $name = $data->name;
    $role = $data->role;
    $avatar = $data->avatar;
    //so sánh password và password comfirm
    if($password != $password_confirm){
        echo json_encode(array(
            "status" => false,
            "message" => "Mật khẩu không khớp"
        ));
        return;
    }
    $sqlQuery = "SELECT * FROM users WHERE email = '$email' ";
    $stmt = $dbConn->prepare($sqlQuery);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user){
        echo json_encode(array(
            "status" => false,
            "message" => "Email đã tồn tại"
        ));
        return;
    }
    // mã hóa mật khẩu
    $password = password_hash($password, PASSWORD_BCRYPT);
    // thêm dữ liệu vào db
    $sqlQuery = "INSERT INTO users(email, password, name, role, avatar) VALUE ('$email', '$password', '$name', '$role', '$avatar') ";
    $stmt = $dbConn->prepare($sqlQuery);
    $stmt->execute();
    echo json_encode(array(
        "status" => true,
        "message" => "Đăng ký  thành công"
    ));
} catch (Exception $th) {
    echo json_encode(array(
        "status" => false,
        "message" => $th->getMessage()
    ));
} 