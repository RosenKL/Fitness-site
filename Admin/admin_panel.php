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

?>

  
<?php
$servername = "localhost";
$username = "root";
$password = "1234";



$conn = new PDO("mysql:host=$servername;dbname=fitness_site", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $firstname = '';
        $lastname = '';
        $address = '';  
        $city = '';
        $country = '';


$update_id = @$_GET['update_id'];

    if ( $update_id ) {

      $PDOstatement = $conn->prepare("SELECT * from users WHERE ID = ?");
      $PDOstatement->execute( [ $update_id ] );
        $result = $PDOstatement->fetch(PDO::FETCH_ASSOC);

        
        $firstname = $result['firstname'];
		$lastname = $result['lastname'];
        $address = $result['address'];  
        $city = $result['city'];
        $country = $result['country'];

      }
    




try {
  

  if ( isset( $_POST['submit'] ) ) {
		    $firstname = $_POST['firstname']; 
		    $lastname = $_POST['lastname'];
        $address = $_POST['address'];  
        $city = $_POST['city'];
        $country = $_POST['country'];

    if ( $update_id ) {

      $sql = "UPDATE users SET firstname= ?, lastname=?, address= ?, city= ?, country= ? WHERE ID = ?";
     $conn->prepare($sql)->execute([$firstname,$lastname,$address,$city,$country,$update_id]);
      header("Location:http://localhost/site%20for%20project/Fitness-site/Admin/admin_panel.php");
  
    } 
 
	}

  $delete_id = @$_GET['delete_id'];

  if ( $delete_id ) {
$sql_appointment = "DELETE FROM appointment WHERE user_id = ?";
$conn->prepare($sql_appointment)->execute([$delete_id]);
  // Delete from the 'users' table



// Delete from the 'rating' table
$sql_rating = "DELETE FROM rating WHERE user_id = ?";
$conn->prepare($sql_rating)->execute([$delete_id]);

// Delete from the 'orders' table
$sql_orders = "DELETE FROM orders WHERE user_id = ?";
$conn->prepare($sql_orders)->execute([$delete_id]);

$sql_users = "DELETE FROM users WHERE ID = ?";
$conn->prepare($sql_users)->execute([$delete_id]);

// Delete from the 'appointment' table
  }
  $make_admin_id = @$_GET['make_admin_id'];

  if ($make_admin_id) {
    $sql = "UPDATE users SET is_admin = 1 WHERE ID = ?";
    $conn->prepare($sql)->execute([$make_admin_id]);
  }

  $remove_admin_id = @$_GET['remove_admin_id'];

  if ($remove_admin_id) {
    $sql = "UPDATE users SET is_admin = 0 WHERE ID = ?";
    $conn->prepare($sql)->execute([$remove_admin_id]);
  }




} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
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

      


/* Form styles */
form {
    display: 50px;
    margin-top: 100px;
    

}


input[type="text"],
input[type="password"],
input[type="submit"] {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #333;
    color: #fff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #555;
}

.error-message {
    color: red;
    margin-bottom: 10px;
}

.success-message {
    color: green;
    margin-bottom: 10px;
}

/* Table */
.table-container {
  margin: 10px auto;
  width: 80%;
}

table {
  width: 100%;
  border-collapse: collapse;
}

table th, table td {
  padding: 8px;
  text-align: left;
  border: 1px solid #ddd;
}

table th {
  background-color: #f2f2f2;
}

table tr {
  background-color: #f9f9f9;
}
.table-container table td a {
  text-decoration: none; /* Remove underline */
}



.button {
  display: inline-block;
  padding: 6px 12px;
  margin-right: 12px;
  margin-bottom: 4px;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.42857143;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  color: #333;
  background-color: #fff;
  border-color: #ccc;
}

.button:hover {
  background-color: #e6e6e6;
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
             <!-- this for navbar -->
        <div class="center">
           <ul class="navbar">
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/logedindex.php">НАЧАЛО</a></li> 
               
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/aboutus.php">ЗА НАС</a></li>
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/profile.php">ПРОФИЛ</a></li>
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/contact.php">ЗАПИТВАНИЯ</a></li>
               <br>
               <br>  
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Admin/admin_orders.php"> ПОРЪЧКИ И ЗАПИТВАНИЯ</a></li>  
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Admin/admin_panel_add_products.php"> ДОБАВИ ПРОДУКТ</a></li>        
            </ul>
          
        </div>
</header>
  
<div class="formPanel">
<form action="http://localhost/site%20for%20project/Fitness-site/Admin/admin_panel.php<?php if ( $update_id ) echo "?update_id=". $update_id ?>" method="post">
           <input type="text" class="input" placeholder="Име" name="firstname" id="firstname"  required value="<?php echo $firstname;?>"/>
           
           <input type="text" class="input" placeholder="Фамилия" name="lastname" id="lastname" required value="<?php echo $lastname;?>" >
           <br><br>
 
           <input type="text" class="input" name="address" id="address" placeholder="Адрес" required value="<?php echo $address; ?>"/>
          
           <input type="text" class="input" name="city" id="city" placeholder="Град" required value="<?php echo $city; ?>"/>
           <br><br>
           
           <input type="text" class="input" name="country" id="country" placeholder="Държава" required value="<?php echo $country; ?>"/>
           <br><br>   
           
           <input type="submit" name="submit" id = "submit" value = "Submit"><br><br>
  </form>
  <div class="table-container">
<table>
<tr>
    <th>Име</th>
    <th>Фамилия</th>
    <th>Имейл</th>
    <th>Тел. номер</th>
    <th>Адрес</th>
    <th>Град</th>
    <th>Държава</th>
    <th>Админ</th>
    <th>Изберете действие:</th>
</tr>
<?php

$PDOstatement = $conn->prepare("SELECT * from users");
$PDOstatement->execute();
$result = $PDOstatement->fetchAll(PDO::FETCH_ASSOC);

 foreach($result as $row){
   echo "<tr>";
   echo "<td>" . $row['firstname'] . "</td>";
   echo "<td>" . $row['lastname'] . "</td>"; 
   echo "<td>" . $row['email'] . "</td>";
   echo "<td>" . $row['mobile'] . "</td>";
   echo "<td>" . $row['address'] . "</td>"; 
   echo "<td>" . $row['city'] . "</td>"; 
   echo "<td>" . $row['country'] . "</td>"; 
   echo "<td>" . ($row['is_admin'] ? 'Admin' : 'Not Admin') . "</td>"; // Display admin status
   echo '<td>';
   echo '<a class="button" href="?delete_id=' . $row['ID'] . '">Delete</a>';
   echo '<a class="button" href="?update_id=' . $row['ID'] . '">Edit</a>';
   if ($row['is_admin']) {
       echo '<a class="button admin-button" href="?remove_admin_id=' . $row['ID'] . '">Remove Admin</a>';
   } else {
       echo '<a class="button admin-button" href="?make_admin_id=' . $row['ID'] . '">Make Admin</a>';
   }
   echo '</td>';
   echo "</tr>";
}
 ?>
  </table>
</div>
</div>
</body>
</html>