<?php
$databaseHost = '127.0.0.1:3306';
$databaseName = 'md18102';
$databaseUsername = 'root';
$databasePassword = '';

try {
	$dbConn = new PDO("mysql:host={$databaseHost};dbname={$databaseName}", 
						$databaseUsername, $databasePassword);
	$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>