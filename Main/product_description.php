<?php
session_start();

// Check if the user is already logged in
if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page if not logged in
    header('Location: http://localhost/site%20for%20project/Fitness-site/Main/login.php');
    exit();
}

if (isset($_SESSION['email'])) {
    // Connect to your database
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "fitness_site";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

// Fetch product data based on the ID from the URL parameter
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = '$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Product details
        $name = $row['name'];
        $price = $row['price'];
        $image = $row['image'];
        $description = $row['description'];
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "Product ID not provided.";
    exit();
}

$is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Description</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
$(document).ready(function() {
    $(".quantity-btn").click(function() {
        var action = $(this).data("action");
        var input = $(this).siblings(".quantity-input");
        var currentValue = parseInt(input.val());

        if (action === "decrease" && currentValue > 1) {
            input.val(currentValue - 1);
        } else if (action === "increase") {
            input.val(currentValue + 1);
        }
    });

    $(".add-to-cart-form").submit(function(event) {
        event.preventDefault(); // Prevent default form submission behavior

        var formData = $(this).serialize(); // Serialize form data
        $.ajax({
            url: "http://localhost/site%20for%20project/Fitness-site/Processors/addToCart.php",
            method: "POST",
            data: formData,
            success: function(response) {
                // Show success popup
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Product added to cart successfully!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            },
            error: function(xhr, status, error) {
                // Show error popup
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while adding the product to the cart.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
</script>
    <style>
        /* Use the provided template styling */
        /* Container styles */
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
        }
        body{
            background-image:url(http://localhost/site%20for%20project/Fitness-site/img/R.jpg);
            background-repeat: repeat;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 20px;
            flex-direction: column;
            min-height: 100vh; /* Set the minimum height of the body to 100% of the viewport */
            overflow-x: hidden; /* Hide horizontal overflow */
        }
        .heading {
            margin-bottom: 10%;
        }
        h1 {
            padding: 6px;
            margin-left: 100px;
        }

        
        a {
            text-decoration: none;
            color: dodgerblue;
            text-shadow: 3px 3px 30px rgb(0, 0, 0);
        }

        header {
            padding: 0px;
            margin: 0px;
            position: relative;
            color: rgba(255, 255, 255, 0.966);
            border-radius: 10px;
            width: 98.5%;
            height: 3%;
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

        .heading img {
            padding: 0px;
            width: 120px;
            height: 120px;
            left: 1px;
            position: absolute;
        }
        .navbar li a:hover {
           
          
           text-shadow:0 0 10px cyan,
           0 0 25px cyan,
           0 0 40px cyan,
           0 0 55px cyan,
           0 0 70px cyan,
           0 0 80px cyan;
           
       }





        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .product-details {
    display: flex;
    justify-content: space-between; /* Align items with space between them */
    margin-bottom: 20px; /* Add margin at the bottom */
}


.product-info {
    display: flex;
    align-items: flex-start; /* Align items vertically at the start */
}
.product-info img {
    max-width: 25%;
    height: auto;
    margin-right: 20px; /* Add margin to the right of the image */

}
.product-info {
    width: 100%; /* Adjust the width of the product info */
    float: left; /* Float the product info to the left */
    color:white;
}

.info{
    width: 20%;
}
.description {
    width: 80%; /* Adjust the width of the description */
    float: right; /* Float the description to the right */
}

        .product-details .description {
            flex: 1; /* Let the description take up remaining space */
            margin-left: 20px; /* Add margin to the left */
        }


        .product-details h2 {
            margin-top: 0;
            color:white;
        }

        .product-details p {
            color: white;
        }

       

        .add-to-cart-form {
    display: flex;
    flex-direction: column; /* Align items in a column */
    margin-top: 10px; /* Add margin to the top */
}
.add-to-cart-form label {
    margin-right: 10px; /* Add spacing between label and input */
}
.description h3 {
    margin-top: 0; /* Remove default margin */
}

.quantity-container{
    text-align:center;
}

        

        .add-to-cart-form input[type="number"] {
            width: 50px;
            text-align: center;
        }


        .add-to-cart-form button {
            
            padding: 10px 20px;
            margin-top:10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .add-to-cart-form button:hover {
            background-color: #45a049;
        }

         /* Footer */

         .footer {
    width: 100%;
    height: auto;
    background-color: rgb(15, 32, 48);
    padding: 5px 0;
    text-align: center;
    color: white;
    position: relative;
    bottom: 0;
}

         table{            
            background-image: linear-gradient(to bottom,rgba(0, 0, 0, 0.466), rgba(0, 0, 0, 0.836),black,black);
            box-shadow: 2px 2px 20px black;
          }

          .content {
        flex: 1;
        overflow: auto;
        flex: 1;
          }

    .footdown {
        text-align: center;
        color: white;
        box-sizing: border-box;
    }
    
          .footoption{
            
              color: rgb(255, 255, 255);
               
                           
          }

          .footoption li {
            display: inline-block;
            padding: 2%;
            
          }

          .footoption td{
              width: 5%;
              padding-left: 10%;
              padding-top: 2%;
              padding-bottom: 2%;
          }
    </style>
</head>
<body>
    <header class="heading">
        <div id="nav">
            <a href="http://localhost/site%20for%20project/Fitness-site/Main/index.php">
                <img class="logo" src="http://localhost/site%20for%20project/Fitness-site/img/gyml3w.png" alt="">
            </a>
        </div>
        <div class="center">
            <ul class="navbar">
                <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/logedindex.php">НАЧАЛО</a></li>
                <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/aboutus.php">ЗА НАС</a></li>
                <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/profile.php">ПРОФИЛ</a></li>
                <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/catalog.php">КАТАЛОГ</a></li>
                <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/cart.php">КОЛИЧКА</a></li>
            </ul>
        </div>
    </header>

    <div class="product-details">
    <div class="product-info">
        <img style="border: 3px solid black; background-color:white;" src="http://localhost/site%20for%20project/Fitness-site/img/<?php echo $image; ?>" alt="<?php echo $name; ?>">
        <div class="info">
            <h2><?php echo $name; ?></h2>
            <p>Цена: <?php echo $price; ?>лв.</p>
            <form class="add-to-cart-form" method="POST" action="http://localhost/site%20for%20project/Fitness-site/Processors/addToCart.php">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
    <div class="quantity-container">
        <label for="quantity">Количество:</label>
        <br>
        <button type="button" class="quantity-btn" data-action="decrease"><i class="fas fa-minus"></i></button>
        <input type="number" name="quantity" class="quantity-input" id="quantity" value="1" min="1">
        <button type="button" class="quantity-btn" data-action="increase"><i class="fas fa-plus"></i></button>
    </div>
        
    
    <button type="submit"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
</form>
<?php if ($is_admin == 1): ?>
                <!-- Display admin actions if the user is an admin -->
                <form action="http://localhost/site%20for%20project/Fitness-site/Processors/deleteProduct.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <button type="submit">Изтрии продукт</button>
                </form>
                
            <?php endif; ?>
          </div>  
       <div class="description">
        <h3>Описание:</h3>
        <p><?php echo $description; ?></p>
       
    </div>
</div>
</div>
<footer class="footer">
        <table >
           
           
        <tr class="footoption" >
           
          <td >                                         
            <li> <a href="http://localhost/site%20for%20project/Fitness-site/Main/aboutus.php">ЗА НАС</a></li>
                <br>
            <li> <a href="http://localhost/site%20for%20project/Fitness-site/Main/contact.php">ЗАПИТВАНИЯ</a></li>                       
          </td>
          <td>               
            <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/catalog.php">КАТАЛОГ</a></li>
                 <br>
            <li> <a href="http://localhost/site%20for%20project/Fitness-site/Main/profile.php">ПРОФИЛ</a></li> 
                                     
           </td>
           <td>                      
        <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/contact.php">КОНТАКТИ</a></li>
            <br>                         
           </td>
               
        </tr>
        
        <tr >
            <td class="footdown" colspan="3" >© 2023 HammerCross Всички права са запазени!</td>
        </tr>
    
    </table>
    </footer>
</body>
</html>
