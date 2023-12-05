<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once './connection.php';

try {
    $data = json_decode(file_get_contents("php://input"));

    $title = $data->title;
    $content = $data->content;
    $image = $data->image;
    $user_id = $data->user_id;
    $topic_id = $data->topic_id;

    $sqlQuery = "INSERT INTO `news` (title, content, image, created_at, user_id, topic_id) 
                VALUES (:title, :content, :image, NOW(), :user_id, :topic_id)";

    $stmt = $dbConn->prepare($sqlQuery);
    
    // Bind parameters
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':topic_id', $topic_id);

    $stmt->execute();

    echo json_encode(array('message' => 'Thêm mới tin tức thành công'));
} catch (\Throwable $th) {
    echo json_encode(array('message' => $th->getMessage()));
}
?>
