<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// http://127.0.0.1:2828/get-topics.php
// import file connection.php
include_once './connection.php';
// đọc dữ liệu
$sqlQuery = "SELECT id, name, description from topics";
// thực thi câu lệnh
$stmt = $dbConn->prepare($sqlQuery);
$stmt->execute();
// lấy tất cả dữ liệu từ câu lệnh pdo
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
// trả về dữ liệu dạng json
echo json_encode($news);
?>