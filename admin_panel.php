<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['email'])) {
    // Redirect the user to the appropriate page based on their role
    if (isset($_SESSION['is_admin']) xor $_SESSION['is_admin']) {
        header('Location: logedindex.php');
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
      header("Location:admin_panel.php");
  
    } 
 
	}

  $delete_id = @$_GET['delete_id'];

  if ( $delete_id ) {

    $sql = "DELETE FROM users WHERE ID = ?";
		$conn->prepare($sql)->execute([$delete_id]);

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
            background-image:url(img/gym1.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: auto;

            
            
        }

        .header{
           
            height:45px;
            padding-left: 40%;
           }
        
        
      
       
        .navbar li{
            display: inline-block;
            font:18px solid;
            background-color: rgba(0, 0, 0, 0.582);
            margin-left:16px;
            height: 32px;
            
            
           
        }
        .navbar li a{
           
            color:#ffffff;
            text-decoration-line: none;
            padding:34px 20px;
            transition:1s;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: normal;
            text-shadow: 2px 2px 20px black;
            
        }
        .navbar li:hover {
           
            
            background-color:#ffffff;
                       
        }
        .navbar li a:hover{
            color: black;
            font-weight: normal;
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
<header >
<div class="header">
    
    <ul class="navbar">
        <li><a href="index.php">HOME</a></li>
        <li><a href="aboutus.php">ABOUT US</a></li>
        <li><a href="contact.php">CONTACT US</a></li>
        <li><a href="login.php">LOGOUT</a></li>             
     </ul>
   
 </div>
             
   </header>

<form action="admin_panel.php<?php if ( $update_id ) echo "?update_id=". $update_id ?>" method="post">
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
</body>
</html>