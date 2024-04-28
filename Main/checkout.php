<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page or display an error message
    header("Location: http://localhost/site%20for%20project/Fitness-site/Main/login.php"); 
    exit();
}

// Database connection parameters
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

// Fetch cart items for the logged-in user from the database
$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM cart WHERE user_id = $userId";
$result = $conn->query($sql);

// Check if the cart is empty
if ($result->num_rows === 0) {
    // Redirect the user to the cart page
    header("Location: http://localhost/site%20for%20project/Fitness-site/Main/cart.php");
    exit();
}

// Initialize total price
$totalPrice = 0;

// Loop through each cart item and calculate total price
while ($row = $result->fetch_assoc()) {
    $quantity = $row['quantity'];
    $productId = $row['product_id'];

    // Fetch product details from the products table
    $productSql = "SELECT price FROM products WHERE id = $productId";
    $productResult = $conn->query($productSql);
    
    if ($productResult->num_rows > 0) {
        $productRow = $productResult->fetch_assoc();
        $price = $productRow['price'];
        $totalPrice += $price * $quantity;
    }
}

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url(http://localhost/site%20for%20project/Fitness-site/img/R.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        body {
            font-size: 20px;
            background-repeat: repeat;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Set the minimum height of the body to 100% of the viewport */
            overflow-x: hidden; /* Hide horizontal overflow */
        }
        .heading img {
            padding: 0px;
            width: 120px;
            height: 120px;
            left: 1px;
            position: absolute;
        }
        header {
            padding: 0px;
            margin: 0px;
            position: relative;
            color: rgba(255, 255, 255, 0.966);
            border-radius: 10px;
            width: 98.5%;
            height: 15%;
        }

        .container {
            margin-top: 100px;
        }

        .card-header h5 {
            margin-bottom: 0;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-body input[type="text"],
        .card-body input[type="email"],
        .card-body textarea {
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .card-body input[type="submit"] {
            width: 100%;
            padding: 0.75rem;
            margin-top: 1rem;
            font-size: 1.25rem;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .card-body input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<header class="heading">
        <div id="nav">
            <a href="http://localhost/site%20for%20project/Fitness-site/Main/index.php">
                <img class="logo" src="http://localhost/site%20for%20project/Fitness-site/img/gyml3w.png" alt="" >
            </a>
        </div>
</header>      
<!-- this for navbar -->
       
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Checkout</h5>
                    </div>
                    <div class="card-body">
                    <p>Обща сума за плащане: <?php echo number_format($totalPrice, 2); ?>лв. с ДДС</p>
                        <form action="http://localhost/site%20for%20project/Fitness-site/Processors/process_checkout.php" method="POST">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Име:</label>
                                <input type="text" id="firstname" name="firstname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Фамилия:</label>
                                <input type="text" id="lastname" name="lastname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Ймеил:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Тел. номер:</label>
                                <input type="text" id="mobile" name="mobile" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Моля въведете адрес за доствка(работим само с наш куриер до личен адрес):</label>
                                <textarea id="address" name="address" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                                <label class="form-check-label" for="agreeTerms">I agree to the Terms of Service</label>
                            </div>
                            
                            <!-- Submit button -->
                            <input type="submit" value="Завърши поръчката" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>