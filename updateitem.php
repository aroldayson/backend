<?php
    include 'connection.php';
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    if (isset($request->categ_id, $request->laundryname, $request->kilograms, $request->price)) {
        // Prepare an UPDATE statement
        $stmt = $conn->prepare("UPDATE laundry_category SET category = ?, kilo = ?, price = ? WHERE categ_id = ?");
        // Bind parameters to the statement
        $stmt->bind_param("sdii", $request->laundryname, $request->kilograms, $request->price, $request->categ_id);

        // Execute the statement and check if the update was successful
        if ($stmt->execute()) {
            // Fetch the updated data to return to the client
            $fetchResult = $conn->query("SELECT * FROM laundry_category");
            
            $data = $fetchResult->fetch_all(MYSQLI_ASSOC);
            
            echo json_encode(['message' => 'Success', 'data' => $data]);
        } else {
            echo json_encode(['message' => 'Error updating data']);
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo json_encode(['message' => 'Invalid Input']);
    }

    // Close the database connection
    $conn->close();
?>
