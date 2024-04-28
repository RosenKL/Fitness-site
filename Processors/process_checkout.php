<?php
session_start();

// Check if the request contains the necessary parameters
if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["mobile"]) && isset($_POST["address"])) {
    // All parameters are present
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $address = $_POST["address"];
    
    // Retrieve user ID from session or database (assuming it's stored in $_SESSION['user_id'])
    $userId = $_SESSION['user_id'];

    // Include database connection
    $servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "fitness_site";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    // SQL query to retrieve cart items for the user
    $sql = "SELECT * FROM cart WHERE user_id = $userId";
    $result = $conn->query($sql);

    // Initialize total price
    $totalPrice = 0;

    if ($result->num_rows > 0) {
        // Loop through each cart item and calculate total price
        while ($row = $result->fetch_assoc()) {
            $quantity = $row['quantity'];
            $productId = $row['product_id'];

            // Fetch product price from the products table
            $productSql = "SELECT price FROM products WHERE id = $productId";
            $productResult = $conn->query($productSql);
            
            if ($productResult->num_rows > 0) {
                $productRow = $productResult->fetch_assoc();
                $price = $productRow['price'];
                $totalPrice += $price * $quantity;
            }
        }
    }

    // Log received parameters for debugging
    echo("First Name: " . $firstname);
    echo("Last Name: " . $lastname);
    echo("Email: " . $email);
    echo("Mobile: " . $mobile);
    echo("Address: " . $address);
    echo("Total Price: " . $totalPrice);
    echo("User ID: " . $userId);

    // Insert the order into the database
    $conn->begin_transaction();

    // Prepare and bind the SQL statement to insert order
    $stmtOrder = $conn->prepare("INSERT INTO orders (user_id, firstname, lastname, email, mobile, address, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmtOrder->bind_param("isssssd", $userId, $firstname, $lastname, $email, $mobile, $address, $totalPrice);


    // Execute the statement to insert order
    if ($stmtOrder->execute() === TRUE) {
        // Get the order ID of the inserted order
        $orderId = $conn->insert_id;

        // Prepare and bind the SQL statement to insert order items
        $stmtItems = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmtItems->bind_param("iii", $orderId, $productId, $quantity);

        // Execute the statement to insert order items
        $result->data_seek(0); // Reset result set pointer
        while ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];    
            $quantity = $row['quantity'];
            $stmtItems->execute();
        }

        // Commit the transaction
        $conn->commit();

        // Clear cart after successful order placement
        $stmtRemoveCart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmtRemoveCart->bind_param("i", $userId);
        $stmtRemoveCart->execute();
        echo "Order placed successfully";
        header("Location: http://localhost/site%20for%20project/Fitness-site/Main/cart.php");
        exit();
    } else {
        // Rollback the transaction if order insertion fails
        $conn->rollback();
        echo "Error placing order: " . $conn->error;

    }

    // Close statements and connection
    $stmtOrder->close();
    $stmtItems->close();
    $stmtRemoveCart->close();
    $conn->close();
} else {
    // Output error message
    echo "Error: Missing parameters";
}
?>
