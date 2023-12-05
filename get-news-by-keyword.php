<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST GET PUT DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// http://127.0.0.1:2828/get-news-by-keyword.php?keyword=abc
include_once './connection.php';
// đọc keyword từ query string
$keyword = $_GET['keyword'];
// đọc dữ liệu từ database
$sqlQuery = "SELECT id, title, content, created_at, user_id, topic_id 
            from news where title like '%$keyword%' 
            or content like '%$keyword%'";
// thực thi câu lệnh pdo
$stmt = $dbConn -> prepare($sqlQuery);
$stmt->execute();
// lấy tất cả  dữ liệu từ câu lệnh pdo
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
// trả về dữ liệu dạng json
echo json_encode($news)
?>