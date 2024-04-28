<?php
// update_order_status.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the necessary parameters are set
    if (isset($_POST['order_id'], $_POST['status'])) {
        $orderId = $_POST['order_id'];
        $status = $_POST['status'];
        
        $servername = "localhost";
        $username = "root";
        $password = "1234";
        $dbname = "fitness_site";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Update the status in the database
            $stmt = $conn->prepare("UPDATE orders SET status = :status WHERE id = :id");
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $orderId);
            $stmt->execute();

            echo 'Status updated successfully.';
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    } else {
        echo 'Missing parameters.';
    }
} else {
    echo 'Invalid request method.';
}
?>
