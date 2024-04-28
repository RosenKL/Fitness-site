<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['email'])) {
    // Redirect the user to the appropriate page based on their role
    if (isset($_SESSION['is_admin']) xor $_SESSION['is_admin']) {
        header('Location: http://localhost/site%20for%20project/Fitness-site/Main/logedindex.php');
        exit();
    }
}
// Define a variable to hold the success message
$successMessage = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form data and add the product to the database
    $imageFileName = $_FILES['image']['name']; // Get the name of the uploaded file
    $imageTempName = $_FILES['image']['tmp_name']; // Get the temporary file name on the server
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Move the uploaded file to the img folder
    $uploadDirectory = '..\\img\\';
    $targetFilePath = $uploadDirectory . basename($imageFileName);
    if (move_uploaded_file($imageTempName, $targetFilePath)) {
        // File uploaded successfully, proceed to insert data into database
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

        // Prepare SQL statement to insert product
        $sql = "INSERT INTO products (image, name, price, description) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters and execute statement
        $stmt->bind_param("ssds", $imageFileName, $name, $price, $description);
        if ($stmt->execute()) {
            // Product added successfully, set success message
            $successMessage = "Успешно добавен продукт! &#128515; ";
        } else {
            // Error occurred while adding product
            $successMessage = "Неуспешно добавен продукт! &#128546; ";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        $successMessage = "Неуспешно добавяне на снимката.Моля, опитай отново!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Container styles */
        body{
            background-image:url(http://localhost/site%20for%20project/Fitness-site/img/R.jpg);
            background-repeat: repeat;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            
            
        }
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        body {
            color:black;
            font-size: 20px;
            display: flex;
            flex-direction: column;
            min-height: 110vh; /* Set the minimum height of the body to 100% of the viewport */
            overflow-x: hidden; /* Hide horizontal overflow */
        }
        .heading {
          margin-bottom: 25px;

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
      

        /**MAIN*/
      
        

        .container {
            max-width: 500px;
            margin: 10px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .successMsg{
            text-align: center;
            margin-bottom: 20px;

        }
        
    

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-group label {
            flex: 0 0 150px;
            text-align: right;
            margin-right: 10px;
            margin-bottom: 0;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group textarea {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            resize: vertical;
        }

        input[type="file"] {
            flex: 1;
        }

        input[type="submit"] {
            margin-left: auto;
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

    </style>
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
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/catalog.php">КАТАЛОГ</a></li>
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/profile.php">ПРОФИЛ</a></li>
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/contact.php">ЗАПИТВАНИЯ</a></li>  
               <br>
               <br>
               <li style="margin: left 10px;;"><a href="http://localhost/site%20for%20project/Fitness-site/Admin/admin_orders.php"> ПОРЪЧКИ И ЗАПИТВАНИЯ</a></li>  
               <li style=" margin: left 10px;"><a href="http://localhost/site%20for%20project/Fitness-site/Admin/admin_panel.php">ПРОФИЛИ</a></li>         
            </ul>
          
        </div>
</header>

<div class="container">
    <?php if (!empty($successMessage)): ?>
    <p class="successMsg"><strong><?php echo $successMessage; ?></strong></p>
   <?php endif; ?>
    <h1>Добави продукт</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="image">Изображение:</label>
        <input type="file" name="image" id="image" required><br><br>
        
        <label for="name">Име:</label>
        <input type="text" name="name" id="name" required><br><br>
        
        <label for="price">Цена:</label>
        <input type="number" name="price" id="price" min="0" step="0.01" required><br><br>
        
        <label for="description">Описание:</label><br>
        <textarea name="description" id="description" rows="4" cols="50" required></textarea><br><br>
        
        <input type="submit" value="Add Product">
    </form>
</div>

</body>
</html>