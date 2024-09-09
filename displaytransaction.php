<?php
    include 'connection.php';

    $q = "SELECT t.*, c.*, td.*, a.* FROM transactions t INNER JOIN customer c ON t.cust_id = c.cust_id INNER JOIN transaction_details td ON t.transac_id=td.transac_id INNER JOIN admin a ON t.admin_id=a.admin_id ORDER BY t.cust_id DESC;";

    $result = $conn->query($q);

    $data = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
?>
