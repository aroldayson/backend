<?php
    include 'connection.php';

    $q = "SELECT * FROM laundry_category ORDER BY categ_id DESC";

    $result = $conn->query($q);

    $data = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
?>
