<?php
session_start();

// Check if the request contains the necessary parameters
if(isset($_POST["product_id"]) && isset($_POST["user_id"]) && isset($_POST["quantity"])) {
    // All parameters are present
    $productId = $_POST["product_id"];
    $userId = $_POST["user_id"];
    $quantity = $_POST["quantity"];

    // Log received parameters for debugging
    echo("Product ID: " . $productId);
    echo("User ID: " . $userId);
    echo("Quantity: " . $quantity);

    // Insert or update the product in the cart table in the database (replace placeholders with your actual database connection and table name)
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "fitness_site";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the product already exists in the cart for the user
    $checkQuery = "SELECT * FROM cart WHERE user_id = '$userId' AND product_id = '$productId'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Product already exists in the cart, update the quantity
        $updateQuery = "UPDATE cart SET quantity = quantity + '$quantity' WHERE user_id = '$userId' AND product_id = '$productId'";
        if ($conn->query($updateQuery) === TRUE) {
            echo "Quantity updated successfully";
        } else {
            echo "Error updating quantity: " . $conn->error;
        }
    } else {
        // Product does not exist in the cart, insert a new row
        $insertQuery = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$userId', '$productId', '$quantity')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "Product added to cart successfully";
            
        } else {
            echo "Error adding product to cart: " . $conn->error;
        }
    }

    $conn->close();
} else {
   
    // Output error message
    echo "Error: Missing parameters";
}
?>


