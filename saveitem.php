<?php
    include 'connection.php';
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    if (isset($request->laundryname, $request->kilograms, $request->price)) {
        $stmt = $conn->prepare("INSERT INTO laundry_category (category, kilo, price) VALUES ('$request->laundryname','$request->kilograms', '$request->price')");
        //$stmt->bind_param("sdi", );


        if ($stmt->execute()) {
            $fetchResult = $conn->query("SELECT * FROM laundry_category");
            $data = $fetchResult->fetch_all(MYSQLI_ASSOC);
            
            echo json_encode(['message' => 'Success', 'data' => $data]);
        } else {
            echo json_encode(['message' => 'Error inserting data']);
        }

        $stmt->close();
    } else {
        echo json_encode(['message' => 'Invalid Input']);
    }

    $conn->close();
?>
