<!-- order_details.php -->
<?php
session_start();

// Check if the user is already logged in
if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page if not logged in
    header('Location: http://localhost/site%20for%20project/Fitness-site/Main/login.php');
    exit();
}

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

// Check if order_id is provided in the URL
if (!isset($_GET['id'])) {
    // Redirect or show an error message
    echo "Order ID not provided.";
    exit();
}

$order_id = $_GET['id'];

// Retrieve order details from the database based on order_id
$query = "SELECT orders.*, orders.firstname, orders.lastname, orders.email, orders.address, orders.mobile 
          FROM orders 
          INNER JOIN users ON orders.user_id = users.id 
          WHERE orders.id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // No order found with the provided order_id
    // Redirect or show an error message
    echo "Order not found.";
    exit();
}

// Fetch order details
$order = $result->fetch_assoc();

// Fetch order items for the current order
$query = "SELECT order_items.quantity, products.name, products.price, products.image 
          FROM order_items
          INNER JOIN products ON order_items.product_id = products.id
          WHERE order_items.order_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an empty array to store order items
$orderItems = array();

while ($item = $result->fetch_assoc()) {
    $orderItems[] = $item;
}


function getStatusColor($status) {
    switch ($status) {
        case 'sent':
            return 'orange';
        case 'in progress':
            return 'red';
        case 'delivered':
            return 'green';
        default:
            return 'black'; // Default color
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .gradient-custom {
            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        }
        body {
            background-image: url(http://localhost/site%20for%20project/Fitness-site/img/R.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        .center {
            display: flex;
            width: 70%;
            height: 50px;
            left: 60%;
            top: 0;
            margin: 10px auto;
            position: absolute;
        }
        .navbar li {
            display: inline-block;
            font: 20px solid;
        }
        .navbar li a {
            color: #ffffff;
            text-decoration-line: none;
            padding: 34px 5px;
            text-shadow: 2px 2px 20px black;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar li a:hover {
            text-shadow: 0 0 10px cyan, 0 0 25px cyan, 0 0 40px cyan, 0 0 55px cyan, 0 0 70px cyan, 0 0 80px cyan;
        }
        h1 {
            padding: 6px;
            margin-left: 100px;
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
        a {
            text-decoration: none;
            color: dodgerblue;
            text-shadow: 3px 3px 30px rgb(0, 0, 0);
        }
        .heading img {
            padding: 0px;
            width: 120px;
            height: 120px;
            left: 1px;
            position: absolute;
        }
        .main {
            margin-top: 100px;
        }
    </style>
    <title>Order Details</title>
</head>
<body>
<header class="heading">
    <div id="nav">
        <a href="http://localhost/site%20for%20project/Fitness-site/Main/index.php">
            <img class="logo" src="http://localhost/site%20for%20project/Fitness-site/img/gyml3w.png" alt="">
        </a>
    </div>
    <!-- this for navbar -->
    <div class="center">
        <ul class="navbar">
            <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/logedindex.php">НАЧАЛО</a></li>
            <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/aboutus.php">ЗА НАС</a></li>
            <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/profile.php">ПРОФИЛ</a></li>
            <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/catalog.php">КАТАЛОГ</a></li>
        </ul>
    </div>
</header>

<div class="main">
        <section class="h-100 gradient-custom">
            <div class="container py-5">
                <div class="row d-flex justify-content-center my-4">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Детайли за поръчка - #<?php echo $order['id']; ?></h5>
                            </div>
                            <div class="card-body">
                            <h5>Статус на поръчката:
                                <span style="color: <?php echo getStatusColor($order['status']); ?>">
                                    <?php echo $order['status']; ?>
                                </span>
                            </h5>
                                <p>Обща цена: <?php echo $order['total_price']; ?>лв.</p>
                                <p>Дата на поръчка: <?php echo $order['created_at']; ?></p>

                                <h3>Детайли за получател</h3>
                                <p>Име: <?php echo $order['firstname'] . ' ' . $order['lastname']; ?></p>
                                <p>Имейл: <?php echo $order['email']; ?></p>
                                <p>Адрес: <?php echo $order['address']; ?></p>
                                <p>Телефонен номер: <?php echo $order['mobile']; ?></p>

                                <h3>Продукти</h3>
                                <?php foreach ($orderItems as $item): ?>
                                    <!-- Display order items -->
                                    <div class="row mb-4">
                                    <div class="col-lg-3 col-md-12">
                                        <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                            <img src="http://localhost/site%20for%20project/Fitness-site/img/<?php echo $item['image']; ?>" class="w-100" alt="<?php echo $item['name']; ?>" />
                                            <a href="#!">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-12">
                                        <p><strong><?php echo $item['name']; ?></strong></p>
                                        <p>Брой: <?php echo $item['quantity']; ?></p>
                                        <p>Цена: <?php echo $item['price']; ?>лв.</p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>

