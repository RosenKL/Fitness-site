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

    // Fetch user data from the database
    $email = $_SESSION['email']; // Assuming the email is stored in the session
    $sql = "SELECT ID FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // If user found, fetch the user ID
        $row = $result->fetch_assoc();
        $user_iD = $row['ID'];

        // Set the user ID in the session
        $_SESSION['user_id'] = $user_iD;

        // Debugging: Output the value of the user_id session variable
     
    } else {
        echo "User not found.";
    }
} else {
    echo "User is not logged in.";
}

// Pagination settings
$recordsPerPage = 6; // Number of products to display per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Current page number
$offset = ($page - 1) * $recordsPerPage; // Offset for fetching products
// Check if sorting options are set
$orderBy = ""; // Initialize the orderBy variable
if (isset($_GET['sortPrice'])) {
    $sortPrice = $_GET['sortPrice'];
    if ($sortPrice == "low_to_high") {
        $orderBy = "ORDER BY price ASC"; // Sort by price from low to high
    } elseif ($sortPrice == "high_to_low") {
        $orderBy = "ORDER BY price DESC"; // Sort by price from high to low
    }
} elseif (isset($_GET['sortName'])) {
    $sortName = $_GET['sortName'];
    if ($sortName == "a_to_z") {
        $orderBy = "ORDER BY name ASC"; // Sort by name from A to Z
    } elseif ($sortName == "z_to_a") {
        $orderBy = "ORDER BY name DESC"; // Sort by name from Z to A
    }
}

// Modify the SQL query to include the orderBy clause
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM products WHERE name LIKE '%$search%' OR description LIKE '%$search%' $orderBy LIMIT $offset, $recordsPerPage";
    $result = $conn->query($sql); // Execute the search query
} else {
    $sql = "SELECT * FROM products $orderBy LIMIT $offset, $recordsPerPage";
    $result = $conn->query($sql); // Execute the default query
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include SweetAlert2 library -->
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

    $(".add-to-cart-btn").click(function(event) {
        event.preventDefault(); // Prevent default form submission behavior
        console.log("Add to Cart button clicked"); // Debugging statement
          
        var product_id = $(this).closest(".product-container").find("input[name='product_id']").val();
        var quantity = $(this).closest(".product-container").find(".quantity-input").val();
        var user_id = <?php echo $_SESSION['user_id']; ?>;
          
        console.log("Product ID:", product_id); // Debugging statement
        console.log("User ID:", user_id); // Debugging statement
        console.log("Quantity:", quantity); // Debugging statement

        $.ajax({
            url: "addTo: http://localhost/site%20for%20project/Fitness-site/Processors/addToCart.php",
            method: "POST",
            data: { product_id: product_id, user_id: user_id, quantity: quantity },
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
        .formPanel{
          margin: top 10%;
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
            height: 3%;
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
        
        /* Container styles */
.container {
    display: flex;
    min-height: 46.5vh;
    position: relative;
}

.left-panel {
    width: 30%; /* Adjust as needed */
    padding-right: 20px; /* Add spacing between panels */
}

.right-panel {
    flex-grow: 1; /* Take remaining space */
   
    
}

     /**SEARCH PANEL */
     .search-container {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
            margin-left: 20px; /* Adjust left margin as needed */
            margin-top: 20px; /* Adjust top margin as needed */
            position: relative; /* Fix the container on the left side */
            left: 0; /* Align the container to the left */
        }
        .formPanel input[type="text"],
        .formPanel input[type="number"] {
            width: calc(100% - 22px); /* Adjust input width to fit container */
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .formPanel input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .formPanel input[type="submit"]:hover {
            background-color: #45a049;
        }
        .no-results {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%; /* Center vertically */
    color: black;
    font-size: 24px;
     }

/**products */

        /* Quantity container styles */
.quantity-container {
    display: flex;
    align-items: center;
}

/* Quantity input styles */
.quantity-input {
    width: 45px; /* Adjust the width as needed */
    text-align: center;
    margin: 0 5px;
    padding: 8px; /* Adjust padding as needed */
    border: 1px solid #ccc; /* Add border */
    border-radius: 4px; /* Add border radius */
    box-sizing: border-box; /* Include padding and border in width */
}

/* Quantity button styles */
.quantity-btn {
    background-color: #f0f0f0; /* Button background color */
    border: none; /* Remove border */
    color: #333; /* Button text color */
    cursor: pointer; /* Add cursor pointer */
    padding: 5px; /* Adjust padding as needed */
    border-radius: 4px; /* Add border radius */
    transition: background-color 0.3s; /* Add transition for hover effect */
}

.quantity-btn:hover {
    background-color: #ddd; /* Change background color on hover */
}
/* Add to cart button styles */
.add-to-cart-btn {
    background-color: #4caf50; /* Button background color */
    color: white; /* Button text color */
    padding: 10px 20px; /* Adjust padding as needed */
    border: none; /* Remove border */
    border-radius: 4px; /* Add border radius */
    cursor: pointer; /* Add cursor pointer */
    font-size: 16px; /* Adjust font size as needed */
    transition: background-color 0.3s; /* Add transition for hover effect */
}

.add-to-cart-btn:hover {
    background-color: #45a049; /* Change background color on hover */
}

        
   
        
        .content {
    overflow: auto;
}

.products {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between; /* Distribute items evenly along the main axis */
}

.product-container {
    width: calc(27% - 20px); /* Adjust the width as needed */
    margin: 10px 40px 20px; /* Add margin between rows */
    border: 4px solid black;
    border-radius: 5px;
    padding: 10px;
    box-sizing: border-box;
    position: relative;
    background-color: white;
}

.product-container img {
    max-width: 100%;
    max-height: 100%;
    display: block;
    margin: 0 auto;
}

.product-container .product-details {
    position: absolute;
    bottom: 10px;
    left: 10px;
    right: 10px;
    color: #fff;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 5px;
    border-radius: 5px;
}

.product-container .product-details h3,
.product-container .product-details p {
    margin: 0;

}
.pagination {
    padding: 10px; /* Add some padding for spacing */
    text-align: center; /* Center the pagination links */
    color:white;
}

.pagination a {
    display: inline-block;
    margin: 0 5px; /* Add margin between page numbers */
    width: 30px;
    height: 30px;
    background-color: #4caf50;
    color: white;
    text-align: center;
    line-height: 30px;
    border-radius: 5px;
    text-decoration: none;
}

.pagination p {
    display: inline-block;
}

.pagination a.active {
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
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/cart.php">КОЛИЧКА</a></li>         
            </ul>
          
        </div>
        </header>

<!-- Search Panel -->
<div class="container">
    <div class="left-panel">
        <div class="search-container">
            <form class="formPanel" action="" method="GET">
                <label for="search">Търси:</label>
                <input type="text" id="search" name="search" placeholder="Search...">
                <input type="submit" value="Submit">
            </form>
            <form class="formPanel" action="" method="GET">
                <p>Сортирай по:</p>
                <input type="radio" id="sortPriceLowToHigh" name="sortPrice" value="low_to_high">
                <label for="sortPriceLowToHigh">Цена възходящ ред</label><br>
                <input type="radio" id="sortPriceHighToLow" name="sortPrice" value="high_to_low">
                <label for="sortPriceHighToLow">Цена низходящ ред</label><br>
                <input type="radio" id="sortNameAToZ" name="sortName" value="a_to_z">
                <label for="sortNameAToZ">Име А до Я</label><br>
                <input type="radio" id="sortNameZToA" name="sortName" value="z_to_a">
                <label for="sortNameZToA">Име Я до А</label><br>
                <input type="submit" value="Apply">
            </form>
        </div>
        <div class="pagination">
          <p>Страница:</p>
    <?php 

// Fetch product data from the executed query result
$totalProductsSql = "SELECT COUNT(*) AS total FROM products";
$totalProductsResult = $conn->query($totalProductsSql);
$totalProductsRow = $totalProductsResult->fetch_assoc();
$totalProducts = $totalProductsRow['total'];

// Calculate total number of pages
$totalPages = ceil($totalProducts / $recordsPerPage);


    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="http://localhost/site%20for%20project/Fitness-site/Main/catalog.php?page=' . $i . '">' . $i . '</a>';
    }
    ?>
       </div>
    </div>

    <div class="right-panel">
        <div class="content">
            <div class="products">
                <?php
                // Fetch product data from the executed query result
                $totalProductsSql = "SELECT COUNT(*) AS total FROM products";
                $totalProductsResult = $conn->query($totalProductsSql);
                $totalProductsRow = $totalProductsResult->fetch_assoc();
                $totalProducts = $totalProductsRow['total'];

                // Calculate total number of pages
                $totalPages = ceil($totalProducts / $recordsPerPage);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Generate HTML for each product
                        echo '<div class="product-container">';
                        // Wrap the product container in an anchor tag
                        echo '<a href="http://localhost/site%20for%20project/Fitness-site/Main/product_description.php?id=' . $row["id"] . '" class="product-link">';
                        echo '<img src="http://localhost/site%20for%20project/Fitness-site/img/' . $row["image"] . '" alt="' . $row["name"] . '">';
                        echo '<div class="product-details">';
                        echo '<h3 style="color:white;">' . $row["name"] . '</h3>';
                        echo '<p style="color:white;">Цена: ' . $row["price"] . 'лв.</p>';
                        // Close product-details
                        echo '</a>'; // Close anchor tag
                        // Form to set the quantity and add product to cart
                        echo '<form class="add-to-cart-form" method="POST" action="">';
                        echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
                        echo '<input type="hidden" name="user_id" value="' . $_SESSION['user_id'] . '">'; // User ID from session
                        echo '<label for="quantity">Брой:</label>';
                        echo '<div class="quantity-container">';
                        echo '<button type="button" class="quantity-btn" data-action="decrease"><i class="fas fa-minus"></i></button>';
                        echo '<input type="number" name="quantity" class="quantity-input" id="quantity" value="1" min="1">';
                        echo '<button type="button" class="quantity-btn" data-action="increase"><i class="fas fa-plus"></i></button>';
                        echo '</div>';
                        echo '<button type="submit" class="add-to-cart-btn"><i class="fas fa-shopping-cart"></i> </button>';
                        echo '</form>';
                        echo '</div>'; // Close product-container
                        echo '</div>';
                    }
                } else {
                    echo '<div class="no-results">No results</div>';
                }
                ?>
            </div>
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
