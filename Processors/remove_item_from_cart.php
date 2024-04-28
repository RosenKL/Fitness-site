<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page if not logged in
    header('Location: http://localhost/site%20for%20project/Fitness-site/Main/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    // Assuming you have already established a database connection

    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $database = "fitness_site";

    // Create connection
    $mysqli = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Remove the item from the cart table
    $itemId = $_POST['item_id'];
    $userId = $_SESSION['user_id'];
    $query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ii", $userId, $itemId);
    if ($stmt->execute()) {
        echo "Item removed successfully";
    } else {
        echo "Error removing item: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $mysqli->close();
} else {
    // Invalid request
    echo "Invalid request";
}
?>
