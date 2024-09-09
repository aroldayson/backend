<?php
	header('Access-Control-Allow-Headers: X-Requested-With');
	header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
	header('Content-Type: application/json');

	include 'connection.php';

	if (isset($_GET['id'])) { 
		$id = $_GET['id'];
		
		$query = "SELECT * FROM laundry_category WHERE categ_id = $id";

		$_result = $conn->query($query);
		
		// Fetch all rows into an array
		$rows = $_result->fetch_all(MYSQLI_ASSOC);

		echo json_encode($rows);
	} else {
		echo json_encode(["error" => "No ID provided"]);
	}
?>
