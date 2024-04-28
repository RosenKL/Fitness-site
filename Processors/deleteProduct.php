<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: http://localhost/site%20for%20project/Fitness-site/Main/login.php');
    exit();
}

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    // Redirect non-admin users
    header('Location: http://localhost/site%20for%20project/Fitness-site/Main/index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Connect to your database
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "fitness_site";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Remove product from cart first
    $delete_cart_sql = "DELETE FROM cart WHERE product_id = '$product_id'";
    if ($conn->query($delete_cart_sql) !== TRUE) {
        echo "Error deleting product from cart: " . $conn->error;
        $conn->close();
        exit();
    }

    // Perform delete operation on products table
    $delete_product_sql = "DELETE FROM products WHERE id = '$product_id'";
    if ($conn->query($delete_product_sql) === TRUE) {
        // Delete successful
        header('Location: http://localhost/site%20for%20project/Fitness-site/Main/catalog.php'); // Redirect to appropriate page
        exit();
    } else {
        // Delete failed
        echo "Error deleting product: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
