<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('location: http://localhost/site%20for%20project/Fitness-site/Main/login.php');
}



$dsn = 'mysql:host=localhost;dbname=fitness_site';
$username = 'root';
$password = '1234';

try {
  $conn = new PDO($dsn, $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Retrieve user data using the logged-in username
  $query = "SELECT * FROM users WHERE email = :email";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':email', $_SESSION['email']);
  $stmt->execute();
  $userData = $stmt->fetch(PDO::FETCH_ASSOC);

  // Check if user data is found
  if ($userData) {
    // Extract the user data
    $firstname = $userData['firstname'];
    $lastname = $userData['lastname'];
    $gender = $userData['gender'];
    $dob = $userData['dob'];
    $email = $userData['email'];
    $password = $userData['password'];
    $mobile = $userData['mobile'];
    $address = $userData['address'];
    $city = $userData['city'];
    $country = $userData['country'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Update the user profile with the edited fields
      $mobile = $_POST['mobile'];
      $address = $_POST['address'];
      $city = $_POST['city'];
      $country = $_POST['country'];

      $query = "UPDATE users SET mobile = :mobile, address = :address, city = :city, country = :country WHERE email = :email";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':mobile', $mobile);
      $stmt->bindParam(':address', $address);
      $stmt->bindParam(':city', $city);
      $stmt->bindParam(':country', $country);
      $stmt->bindParam(':email', $_SESSION['email']);
      $stmt->execute();

      // Refresh the user data after the update
      $userData['mobile'] = $mobile;
      $userData['address'] = $address;
      $userData['city'] = $city;
      $userData['country'] = $country;

      $successMessage = "Profile updated successfully.";
    }
  } else {
    $errorMessage = "User data not found.";
  }

  if ($userData) {
    // Extract user data
    $userId = $userData['ID']; // Assuming the column name is 'ID'
    $firstname = $userData['firstname'];
    $lastname = $userData['lastname'];
    // Other user data extraction here...

    // Fetch orders belonging to the user
    $stmt_orders = $conn->prepare("SELECT * FROM orders WHERE user_id = :userId");
    $stmt_orders->bindParam(':userId', $userId);
    $stmt_orders->execute();
    $orders = $stmt_orders->fetchAll(PDO::FETCH_ASSOC);

    // Fetch appointments belonging to the user by email
    
    $stmt_appointments = $conn->prepare("SELECT * FROM appointment WHERE user_id = :userId");
    $stmt_appointments->bindParam(':userId', $userId);
    $stmt_appointments->execute();
    $appointments = $stmt_appointments->fetchAll(PDO::FETCH_ASSOC);
} else {
    $errorMessage = "User data not found.";
}
} catch (PDOException $e) {
  echo "Database connection failed: " . $e->getMessage();
  // Handle the database connection error appropriately
  exit(); // Terminate the script
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user profile</title>
    <script type="text/javascript">
  function confirmDelete() {
            var password = prompt("Наистина ли искате да изтриете профила си? Въведете отново паролата си:", "");
            if (password) {
                if (confirm("Сигурни ли сте, че искате да изтриете профила си?")) {
                    window.location.href = "http://localhost/site%20for%20project/Fitness-site/Processors/delete_profile.php?password=" + encodeURIComponent(password);
                }
            }
          }
      
</script>

   


    <style>
        body{
            background-image:url(http://localhost/site%20for%20project/Fitness-site/img/R.jpg);
            background-repeat: repeat;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            
            
        }
        h3{
            position: absolute;
            color:white;
            margin-left:40%;
            margin-top:10%;
            font-size:20px;
            text-transform:uppercase;
            font-weight:lighter;
            letter-spacing:3px;
            
        }

        h3:hover{
            text-shadow: 1px 1px 10px white;
        }

        .header{
           
            height:45px;
            padding-left: 45%;
           }
        
        
      
           .navbar li{
            display: inline-block;
            font:20px solid;
             
           
        }
        .navbar li a{
           
            color:#ffffff;
            text-decoration-line: none;
            padding: 34px 8px ;
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


        .c1 img{
           margin: 16% auto;
           margin-left: 2%;  
            width: 120px;
            height: auto;
            box-shadow: 2px 2px 30px rgb(255, 255, 255);
        }

        .table td {
  position: relative;
}

.table td input {
  background: none;
  border: none;
  font-weight: lighter;
  border-bottom: 1px solid rgba(51, 51, 51, 0);
  height: 26px;
  width: 220px;
  color: rgb(255, 255, 255);
  font-size: 20px;
  text-shadow: 1px 1px 10px rgba(0, 0, 0, 0.712);
  font-family: 'Calibri', courier, monospace;
  cursor: pointer;
  outline: none;
  
}

.table td input:hover {
  text-shadow: 1px 1px 10px rgba(255, 255, 255, 0.616);
  border-bottom: 1px solid rgb(0, 128, 255);
}

        input{
         
         background:none;
         border:none;
         font-weight:lighter;
         border-bottom:1px solid rgba(51, 51, 51, 0); 
         height: 26px;
         width: 220px; 
         color: rgb(255, 255, 255);
         font-size: 20px;
         text-shadow: 1px 1px 10px rgba(0, 0, 0, 0.712);
         font-family:'Calibri', courier, monospace; 
         /*text-transform: uppercase;*/
         cursor:pointer;
         outline:none;
        }

        .table td label {
  display: inline-block;
  width: 150px; /* Adjust the width as needed */
  color: white;
  font-size: 18px;
  text-align: right;
  margin-right: 10px; /* Adjust the spacing between the label and the input */
}

        input:hover{
          text-shadow: 1px 1px 10px rgba(255, 255, 255, 0.616);
          border-bottom:1px solid rgb(0, 128, 255);
        }
        .input2{
            width: 110px; 
        }

       .input3{
        width: 190px;
       }

        .table {
           
            margin: 10% auto;
            padding: 1%;
            background-color: rgba(0, 0, 0, 0.582);
        }

        
        .td{
            
            padding: 70px;
            
        }
        #td{
            border:1px red;
        }

        .success-message {
      color: white;
    }

        button{
            padding:5px;
            color:white;
            background-color:transparent;
            font-size:18px;
            border:1px solid white;
            border-radius:5px;
            outline:none;
        }
        button a{
            text-decoration:none;
            color:white;
        }
        button:hover{
            background-color:rgba(240, 248, 255, 0.39);
        }


    </style>
</head>
<body>



    <h3>Добре дошъл <?php echo $userData['firstname']; ?> ! </h3>

<div class="header">
    
           <ul class="navbar">
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/logedindex.php">НАЧАЛО</a></li>
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/aboutus.php">ЗА НАС</a></li>
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/contact.php">ЗАПИТВАНИЯ</a></li>
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/catalog.php">КАТАЛОГ</a></li> 
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/login.php">НАПУСНИ ПРОФИЛА</a></li>             
            </ul>
          
        </div>
    <table class="table">

       <form method="POST">
      
        <tr>
           
            <td class="c1">
                <img src="http://localhost/site%20for%20project/Fitness-site/img/dp.jpg" >
                <td class="td">
    <br>

    <div>
    <label>Име:</label>
    <input type="text" class="input2" name="firstname" value="<?php echo $userData['firstname']; ?>" readonly>
    
</div>
<div>
    <label>Фамилия:</label>
    <input type="text" class="input2" name="lastname" value="<?php echo $userData['lastname']; ?>" readonly>

    <br>
</div>
<div>
    <label>Пол:</label>
    <input type="text" class="input2" name="gender" value="<?php echo $userData['gender']; ?>" readonly>
    
    </div>
    <div>
        <label>Рождена дата:</label>
    <input type="text" class="input2" name="dob" value="<?php echo $userData['dob']; ?>" readonly>
    
    <br>
</div>
<div>
    <label>Е-майл:</label>
    <input type="email" class="input" name="email" value="<?php echo $userData['email']; ?>" readonly>
    
    <br>
</div>
    
<button name="delprofile" id="del" onclick="confirmDelete()"><a href="#" id="delete">Delete Profile</a></button>
</td>
<td class="td" id="td">
    <div>
        <label>Тел. номер:</label>
        <input type="text" class="input" name="mobile" value="<?php echo $userData['mobile']; ?>" <?php if (isset($_POST['update'])) echo ''; else echo 'readonly'; ?>>
    
    <br>
</div>
<div>
    <label>Адрес:</label>
    <input type="text" class="input" name="address" value="<?php echo $userData['address']; ?>" <?php if (isset($_POST['update'])) echo ''; else echo 'readonly'; ?>>
    
    <br>
</div>
<div>
    <label>Град:</label>
    <input type="text" class="input" name="city" value="<?php echo $userData['city']; ?>" <?php if (isset($_POST['update'])) echo ''; else echo 'readonly'; ?>>
    
    <br>
</div>
<div>
    <label>Държава:</label>
    <input type="text" class="input" name="country" value="<?php echo $userData['country']; ?>" <?php if (isset($_POST['update'])) echo ''; else echo 'readonly'; ?>>
    
    <br><br>
</div>
   
<?php if (isset($successMessage) && isset($_POST['saveChanges'])) { ?>
            <p class="success-message"><?php echo $successMessage; ?></p>
          <?php } ?>
          <?php if (isset($errorMessage)) { ?>
            <p><?php echo $errorMessage; ?></p>
          <?php } ?>
          <?php if (isset($_POST['update'])) { ?>
            <button type="submit" name="saveChanges">Save Changes</button>
          <?php } else { ?>
            <button type="submit" name="update">Update Profile</button>
          <?php } ?>
</td>
</tr>
    </form>
  </table>


  <div style="text-align: center;">
    <h4 style="color: white;">Поръчки</h4>
<div class="table-container" style=" margin: 10px auto; width: 80%;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr style="background-color: #f9f9f9;">
                <th style="padding: 8px; text-align: left; border: 1px solid #ddd;  background-color: #f2f2f2;">First Name</th>
                <th style="padding: 8px; text-align: left; border: 1px solid #ddd;  background-color: #f2f2f2;">Last Name</th>
                <th style="padding: 8px; text-align: left; border: 1px solid #ddd;  background-color: #f2f2f2;">Mobile</th>
                <th style="padding: 8px; text-align: left; border: 1px solid #ddd;  background-color: #f2f2f2;">Total Price</th>
                <th style="padding: 8px; text-align: left; border: 1px solid #ddd;  background-color: #f2f2f2; ">Status</th>
                <th style="padding: 8px; text-align: left; border: 1px solid #ddd;  background-color: #f2f2f2;">Created At</th>
            </tr>
            <!-- PHP code to fetch and display orders -->
            <?php foreach ($orders as $order): ?>
                <tr style="background-color: #f9f9f9;">
                    <td style="padding: 8px; text-align: left; border: 1px solid #ddd;"><?php echo $order['firstname']; ?></td>
                    <td style="padding: 8px; text-align: left; border: 1px solid #ddd;"><?php echo $order['lastname']; ?></td>
                    <td style="padding: 8px; text-align: left; border: 1px solid #ddd;"><?php echo $order['mobile']; ?></td>
                    <td style="padding: 8px; text-align: left; border: 1px solid #ddd;"><?php echo $order['total_price']; ?></td>
                    <td style="padding: 8px; text-align: left; border: 1px solid #ddd; color: <?php echo getStatusColor($order['status']); ?>"><?php echo $order['status']; ?>
                        
                    </td>
                    <td style="padding: 8px; text-align: left; border: 1px solid #ddd;"><a href="http://localhost/site%20for%20project/Fitness-site/Main/order_details.php?id=<?php echo $order['id']; ?>"><?php echo $order['created_at']; ?></a></td>
              
                </tr>
            <?php endforeach; ?>
        </table>
       </div>
    </div>

<br>
<br>
<div style="text-align: center; margin-bottom: 50px;">
    <h4 style="color: white; ">Заявки</h4>
    <div class="table-container" style="margin-bottom: 150px;  margin: 10px auto; width: 80%;">
    <table style="width: 100%; border-collapse: collapse;">
        <!-- Table header -->
        <tr style="background-color: #f9f9f9;">
         <th style="padding: 8px; text-align: left; border: 1px solid #ddd;  background-color: #f2f2f2;">First Name</th>
         <th style="padding: 8px; text-align: left; border: 1px solid #ddd;  background-color: #f2f2f2;">Last Name</th>
         <th style="padding: 8px; text-align: left; border: 1px solid #ddd;  background-color: #f2f2f2;">Mobile</th>
         <th style="padding: 8px; text-align: left; border: 1px solid #ddd;  background-color: #f2f2f2;">Email</th>
         <th style="padding: 8px; text-align: left; border: 1px solid #ddd;  background-color: #f2f2f2;">Category</th>
         <th style="padding: 8px; text-align: left; border: 1px solid #ddd;  background-color: #f2f2f2;">Comment</th>
         <th style="padding: 8px; text-align: left; border: 1px solid #ddd;  background-color: #f2f2f2;">Appointment Date</th>
        </tr>
        <!-- PHP code to fetch and display appointments -->
        <?php foreach ($appointments as $appointment): ?>
            <tr style="background-color: #f9f9f9;">
              <td style="padding: 8px; text-align: left; border: 1px solid #ddd;"><?php echo $appointment['firstname']; ?></td>
              <td style="padding: 8px; text-align: left; border: 1px solid #ddd;"><?php echo $appointment['lastname']; ?></td>
              <td style="padding: 8px; text-align: left; border: 1px solid #ddd;"><?php echo $appointment['mobile']; ?></td>
              <td style="padding: 8px; text-align: left; border: 1px solid #ddd;"><?php echo $appointment['email']; ?></td>
              <td style="padding: 8px; text-align: left; border: 1px solid #ddd;"><?php echo $appointment['category']; ?></td>
              <td style="padding: 8px; text-align: left; border: 1px solid #ddd;"><?php echo $appointment['comment']; ?></td>
              <td style="padding: 8px; text-align: left; border: 1px solid #ddd;"><?php echo $appointment['appointment_date']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
     </div>
</div>

</body>
</html>