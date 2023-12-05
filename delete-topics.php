<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// http://127.0.0.1:2828/delete-news.php?id=10
// import connection.php
include_once './connection.php';
try {
    $id = $_GET['id'];
    $sqlQuery = "delete from topics where id = $id";
    // thực thi câu lệnh
    $stmt = $dbConn -> prepare($sqlQuery);
    $stmt->execute();
    // trả về thông báo
    echo json_encode(array('status' => true));
}catch(\Throwable $th){
    // throw $th
    echo json_encode(array("status" => false));
}