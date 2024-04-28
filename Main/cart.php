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
// Retrieve the user's cart items from the database based on the user's ID
$userId = $_SESSION['user_id'];
$query = "SELECT products.id, products.name, products.image, cart.quantity, products.price FROM cart INNER JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an empty array to store the cart items
$cartItems = array();


while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

// Close the statement and free up the result set
$stmt->close();


$totalQuantity = 0;

// Iterate through each item in the cart and sum up the quantities
foreach ($cartItems as $item) {
    $totalQuantity += $item['quantity'];
}

$totalProductsPrice = 0;
foreach ($cartItems as $item) {
    $totalProductsPrice += $item['quantity'] * $item['price'];
}
// Now $cartItems contains the user's cart items fetched from the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const removeButtons = document.querySelectorAll('.remove-item-btn');
        removeButtons.forEach(button => {
            button.addEventListener('click', function () {
                const itemId = this.getAttribute('data-item-id');
                const confirmation = confirm("Сигурни ли сте ,че иксате да премахнете продукта от количката? ");
                if (confirmation) {
                    // Make an AJAX request
                    const xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                // Reload the page after successful removal
                                window.location.reload();
                            } else {
                                // Handle error
                                console.error(xhr.responseText);
                            }
                        }
                    };
                    xhr.open('POST', 'remove_item_from_http://localhost/site%20for%20project/Fitness-site/Main/cart.php');
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send(`item_id=${itemId}`);
                }
            });
        });
    });
</script>
    <style>
        .gradient-custom {


/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

}
body{
            background-image:url(http://localhost/site%20for%20project/Fitness-site/img/R.jpg);
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


        .center{
            display: flex;
            width: 70%;
            height:50px;
            left: 60%;
            top: 0;
            margin: 10px auto;
            position: absolute;   
        }
        
    
        .navbar li{
            display: inline-block;
            font:20px solid;
           
        }
        .navbar li a{
           
            color:#ffffff;
            text-decoration-line: none;
            padding:34px 5px;
            text-shadow: 2px 2px 20px black;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            
        }
        .navbar li a:hover {
           
          
            text-shadow:0 0 10px cyan,
            0 0 25px cyan,
            0 0 40px cyan,
            0 0 55px cyan,
            0 0 70px cyan,
            0 0 80px cyan;
            
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
       /** main*/
       .main{
        margin:top 100px;
       }

        

    </style>
    <title>Document</title>
</head>
<body>
<header class="heading">
        <div id="nav">
            <a href="http://localhost/site%20for%20project/Fitness-site/Main/index.php">
                <img class="logo" src="http://localhost/site%20for%20project/Fitness-site/img/gyml3w.png" alt="" >
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
                                <h5 class="mb-0">Cart - <?php echo $totalQuantity  ?> items</h5>
                            </div>
                            <div class="card-body">
                                <?php foreach ($cartItems as $item): ?>
                                    <!-- Single item -->
                                    <div class="row mb-4">
                                        <div class="col-lg-3 col-md-12">
                                            <!-- Image -->
                                            <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                                <img src="http://localhost/site%20for%20project/Fitness-site/img/<?php echo $item['image']; ?>" class="w-100" alt="<?php echo $item['name']; ?>" />
                                                <a href="#!">
                                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                                </a>
                                            </div>
                                            <!-- Image -->
                                        </div>
                                        <div class="col-lg-5 col-md-6">
                                            <!-- Data -->
                                            <p><strong><?php echo $item['name']; ?></strong></p>
                                            <p>Цена: <?php echo $item['price']; ?>лв.</p>
                                            <button type="button" data-item-id="<?php echo $item['id']; ?>" class="btn btn-primary btn-sm me-1 mb-2 remove-item-btn" style="background-color:red;" data-mdb-tooltip-init title="Remove item">
                                              <i class="fas fa-trash">Премахни</i>
                                            </button>
                                        
                                            <!-- Data -->
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <!-- Quantity -->
                                            <div class="d-flex mb-4" style="max-width: 300px">
                                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary px-3 me-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                    <i class="fas fa-minus"><strong>-</strong></i>
                                                </button>
                                                <div data-mdb-input-init class="form-outline">
                                            <input id="quantity_<?php echo $item['id']; ?>" min="0" name="quantity"
                                                value="<?php echo $item['quantity']; ?>" type="number"
                                                class="form-control" />
                                            <label class="form-label"
                                                for="quantity_<?php echo $item['id']; ?>">Quantity</label>
                                        </div>
                                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary px-3 ms-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                    <i class="fas fa-plus"><strong>+</strong></i>
                                                </button>
                                            </div>
                                            <!-- Quantity -->
                                            <!-- Price -->
                                            <p class="text-start text-md-center">
                                                <strong>Общо:<?php echo number_format($item['price'] * $item['quantity'], 2); ?>лв.</strong>
                                            </p>
                                            <!-- Price -->
                                        </div>
                                    </div>
                                    <!-- Single item -->
                                    <hr class="my-4" />
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Summary</h5>
                            </div>
                            <div class="card-body">
                            <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        Продукти:
                        <span><?php echo number_format($totalProductsPrice, 2); ?>лв.</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        Доставка
                        <span><?php echo ($totalProductsPrice > 100) ? 'Безплатно' : '5.00лв.'; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                        <div>
                            <strong>Обща сума: </strong>
                            <strong>
                                <p class="mb-0">(със ДДС)</p>
                            </strong>
                        </div>
                        <span><strong><?php echo number_format(($totalProductsPrice > 100) ? $totalProductsPrice : $totalProductsPrice + 5, 2); ?>лв.</strong></span>
                    </li>
                </ul>
    
                <a class="btn btn-primary btn-lg btn-block" href='http://localhost/site%20for%20project/Fitness-site/Main/checkout.php'>
                Go to checkout
                                </a>

                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                             <p><strong>Очаквана доставка</strong></p>
                               <?php
                                 // Get the current date
                                 $currentDate = date('d.m.Y');
    
                                 // Calculate the date after two days
                                 $dateAfterTwoDays = date('d.m.Y', strtotime($currentDate . ' + 2 days'));
                                ?>
                              <p class="mb-0"><?php echo $currentDate; ?> - <?php echo $dateAfterTwoDays; ?></p>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>
</html>