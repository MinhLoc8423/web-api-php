<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once './connection.php';

try {
    $data = json_decode(file_get_contents("php://input"));

    $name = $data->name;
    $description = $data->description;

    $sqlQuery = "INSERT INTO `topics` (name, description) 
                VALUES (:name, :description)";

    $stmt = $dbConn->prepare($sqlQuery);
    
    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->execute();

    echo json_encode(array('message' => 'Thêm mới doanh mục thành công'));
} catch (\Throwable $th) {
    echo json_encode(array('message' => $th->getMessage()));
}
?>
