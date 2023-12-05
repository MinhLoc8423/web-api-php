<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// http://127.0.0.1:2828/update-news.php?id=1
// import connection.php
include_once './connection.php';
try {
     // đọc dữ liệu từ body
     $data = json_decode(file_get_contents("php://input"));
     // đọc dữ liệu json
     $title = $data->title;
     $content = $data->content;
     $image = $data->image;
     $user_id = $data->user_id;
     $topic_id = $data->topic_id;
     $id = $_GET['id'];
     // update dữ liệu vào database
     $sqlQuery = "UPDATE news SET title = '$title',
                                    content = '$content',
                                    image = '$image',
                                    created_at = now(),
                                    user_id = '$user_id',
                                    topic_id = '$topic_id'
                                    where id = $id";
     // thực thi câu lệnh
     $stmt = $dbConn -> prepare($sqlQuery);
     $stmt->execute();
     // trả về thông báo
     echo json_encode(array('status'=>true));
}catch(\Throwable $th){
    // throw $th
    echo json_encode(array("status" => false));
}