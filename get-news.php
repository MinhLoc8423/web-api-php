<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// http://127.0.0.1:2828/get-news.php
// import file connection.php
include_once './connection.php';
include_once './helpers/jwt.php';

// $bearer_token = get_bearer_token();
// if(!$bearer_token){
//     echo json_encode(array("message" => "Assess denied.", "status" => false, "news" => null));
//     exit();
// }
// $is_jwt_valid = is_jwt_valid($bearer_token);
// if(!$is_jwt_valid){
//     echo json_encode(array("message" => "Assess denied.", "status" => false, "news" => null));
//     exit();
// }

// đọc dữ liệu
$sqlQuery = "SELECT id, title, content, created_at, user_id, topic_id from news";
// thực thi câu lệnh
$stmt = $dbConn->prepare($sqlQuery);
$stmt->execute();
// lấy tất cả dữ liệu từ câu lệnh pdo
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
// trả về dữ liệu dạng json
echo json_encode($news);
?>