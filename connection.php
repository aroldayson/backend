<?php	
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
    header('Content-Type: application/json');
	
	$mysql_hostname = "localhost";
	$mysql_user = "root";
	$mysql_password = "";
	$mysql_database = "s2klaundry";

	$conn = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);
	if ($conn->connect_errno){}
?>