<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// http://127.0.0.1:2828/get-news-detail.php?id=1
// import file connection.php
include_once './connection.php';
// đọc id từ query string
$id = $_GET['id'];
// đọc dữ liệu từ database
$sqlQuery = "SELECT id, name, description from topics where id = $id";
// thực thi câu lệnh pdo
$stmt = $dbConn -> prepare($sqlQuery);
$stmt->execute();
// đọc dữ liệu 1 lần
$news = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($news)
?>