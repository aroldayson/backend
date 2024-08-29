<?php
include 'connection.php';  // Include the database connection

$response = [];  // Initialize response array to hold the response data

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);  // Sanitize and get the user ID from GET request

    // Prepare the DELETE SQL statement
    $stmt = $conn->prepare("DELETE FROM laundry_category WHERE categ_id = ?");
    
    if ($stmt) {
        $stmt->bind_param("i", $user_id);  // Bind the user ID parameter

        if ($stmt->execute()) {
            $response['message'] = "Success";  // Set success message if deletion is successful

            // Fetch updated data after deletion
            $result = $conn->query("SELECT * FROM laundry_category ORDER BY categ_id DESC");  // Simple select query to fetch updated data

            if ($result) {
                $response['data'] = $result->fetch_all(MYSQLI_ASSOC);  // Fetch all rows as an associative array
            } else {
                $response['message'] = 'Error fetching data: ' . $conn->error;  // Error message if SELECT fails
            }
        } else {
            $response['message'] = 'Error executing DELETE: ' . $stmt->error;  // Error message if DELETE fails
        }

        $stmt->close();  // Close the prepared statement
    } else {
        $response['message'] = 'Error preparing statement: ' . $conn->error;  // Error message if preparation fails
    }
} else {
    $response['message'] = "Missing 'id' parameter in the query string.";  // Error message if 'id' is not provided
}

$conn->close();  // Close the database connection

echo json_encode($response);  // Return the response as a JSON object
?>
