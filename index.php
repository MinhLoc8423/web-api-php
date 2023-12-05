<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST GET PUT DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// http://127.0.0.1:2828/?name=minhloc&age=20
$name = $_GET['name'];
$age = $_GET['age'];

echo json_encode(
    array(
        "message" =>  "Hello $name, your are $age years old",
        "name" => $name,
        "age" => $age
    )
);
?>