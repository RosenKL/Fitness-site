<?php
// Set up the database connection parameters
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "fitness_site";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstname = $lastname = $dob = $gender = $mobile = $email = $password = $address = $city = $country = "";

// Check if the form is submitted
if (isset($_POST["submit"])) {
    // Get the form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $country = $_POST["country"];

    $mobileCheckSql = "SELECT * FROM users WHERE mobile = '$mobile'";
    $mobileResult = $conn->query($mobileCheckSql);
    if ($mobileResult->num_rows > 0) {
        // Mobile number already exists, display a warning message
        echo "Mobile number already exists!";
    } else {
        // Check if the email already exists in the database
        $emailCheckSql = "SELECT * FROM users WHERE email = '$email'";
        $emailResult = $conn->query($emailCheckSql);
        if ($emailResult->num_rows > 0) {
            // Email already exists, display a warning message
            echo "Email already exists!";
        } else {
           // Hash the password
           $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the SQL statement
            $sql = "INSERT INTO users (firstname, lastname, dob, gender, mobile, email, password, address, city, country)
                    VALUES ('$firstname', '$lastname', '$dob', '$gender', '$mobile', '$email', '$hashedPassword', '$address', '$city', '$country')";

            if ($conn->query($sql) === TRUE) {
                // Registration successful, redirect to login.php
                header("Location:login.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>registration</title>

    <script type="text/javascript" src="login.js"></script>
    
  <style>
        
    body
        { 
          margin: 0px;
          padding: 0px;
          text-align: center;
          font-family:'Calibri', Courier, monospace;
          color: rgb(255, 255, 255);
          background:url('img/bgimg.jpg');
          background: opacity 0.1;
          background-repeat: no-repeat;
          background-size: cover;
        }
        .container h1 a{
            text-decoration:none;
            color:white;
          }
          .container h1 a:hover{
           
            color:DodgerBlue;
           }
         
        .input{
         padding-left: 5%;
         background:rgba(0, 0, 0, 0.671);
         border:none;
         border-radius: 20px;
         border-bottom:2px solid rgba(255, 255, 255, 0.459); 
         height: 26px;
         width: 500px; 
         color: rgb(255, 255, 255);
         font-size: 24px;
         font-weight:lighter;
         text-shadow: 1px 1px 10px rgba(255, 255, 255, 0.747);
         word-spacing: 4px;
         letter-spacing: 2px;
         font-family:'Calibri', courier, monospace; 
        }

        .input:hover{
          background-color: rgb(61, 61, 43);
          border-bottom:2px solid rgb(238, 238, 168);
        }
        ::placeholder {
            color: white;
            opacity: 1; 
           
          }

        
        .select{
         
         background:rgba(0, 0, 0, 0.671);
         border:none;
         border-radius: 20px;
         border-bottom:2px solid rgba(255, 255, 255, 0.459); 
         height: 31px;
         width: 560px; 
         color: rgb(255, 255, 255);
         font-size: 24px;
         word-spacing: 4px;
         letter-spacing: 2px;
         font-family:'Calibri', courier, monospace; 
         padding-left: 5%;
         font-weight:lighter;
         text-shadow: 1px 1px 10px rgba(255, 255, 255, 0.747);
          /* text-align-last:center; */
          /* text-transform:lowercase ; */
        }

        .select:hover{
          background-color: rgb(61, 61, 43);
          border-bottom:2px solid rgb(238, 238, 168);
        }
        
        input[type=password]{
          width: 470px;
        }
         
          
        .eye{
          border-radius: 20px;
          padding: 1px;
          cursor: pointer;         
          font-size: 22px;
          color: rgb(255, 255, 255);
          background:rgba(0, 0, 0, 0.671);
          border-bottom:2px solid rgba(255, 255, 255, 0.459);
          
         
        }

        .eye:hover{
          
           background-color: rgb(61, 61, 43);
           border-bottom:2px solid rgb(238, 238, 168);
          
        }

        .container{
         
          width: auto;
          height: auto;
          
          
        }
        
            .form{
              padding: 3%;
              text-align: center;
              background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(0, 0, 0, 0.74));
              
            }

            .registerbtn{
                  background:rgba(0, 0, 0, 0.671);
                  border:none;
                  border-radius: 20px;
                  border-bottom:2px solid rgb(238, 238, 168); 
                  height: 35px;
                  width: 600px; 
                  color: rgb(238, 238, 168);
                  font-size: 24px;
                  font-weight: bold;
                  text-transform: uppercase;
                  text-align: center;
                  letter-spacing: 10px;
                  font-family:'Calibri', courier, monospace; 
                  transition: 0.6s;
                 
                  text-shadow: 2px 2px 10px rgba(255, 255, 255, 0.747);
            }
            .registerbtn:hover{
              background-color: aliceblue;
              background-image: linear-gradient(to right, rgb(243, 243, 160),white,rgb(243, 243, 160));
              color: black;
              letter-spacing: 20px;
              
            }

            .avtar
        {
          border: 1px solid white;
          border-radius: 100%;
          width: 100px;
          height: 100px;
          cursor: pointer;
         
        }
        .avtar:hover{
          transition: 0.5s;
         box-shadow: 2px 2px 20px rgba(255, 255, 255, 0.747);
        }
        
       
        .link{
          color:DodgerBlue;
        }
           .upload{
             display: none;
             
           } 
           #upload b{
           
             font-size:30px;
             cursor: pointer;
             
          }
          
           #upload b:hover{
             background-color: rgba(255, 255, 255, 0.521);
            
           }

    </style>
</head>
<body>   

    <form  method="post" class="form" name="form" >
        <div class="container">
          <h1>РЕГИСТРИРАХ СЕ В <a href="index.php">HAMMERCROSS</a></h1>
          <div class="icon">

            <input class="upload" type="file" id="file" name="photo" >
            <label for="file" id="upload">  
              
              <img src="img/s4.jpg" class="avtar" id="avtar">
            </label>
            
          </div>
            
          
        
          <hr>
          <br>
         
          <input type="text" class="input" placeholder="Име" name="firstname" id="firstname" size="15" required value="<?php echo $firstname;?>"/>
           
          <br><br>

          
          <input type="text" class="input" placeholder="Фамилия" name="lastname" id="lastname" required value="<?php echo $lastname;?>" >
          <br><br>

          <input type="date" class="input" name="dob" id="dob" placeholder="Дата на Раждане" value=""
       min="1960-01-01" max="2023-12-31" required value="<?php echo $dob;?>" />
       <br><br>

          
           <select name="gender" class="select" id="gender" required value="<?php echo $gender;?>">
             <option value="Мъж" >Мъж</option>
             <option value="Жена" >Жена</option>
             <option value="Друг" >Друг</option>
           </select>
           <br><br>

          
          <input type="number" class="input" name="mobile" id="mobile"  placeholder="Тел. номер" size="10" required value="<?php echo $mobile; ?>"/>
          <br><br>

          
          <input type="email" class="input" placeholder="Ймеил" name="email" id="email" required value="<?php echo $email; ?>"/>
          <br><br>

        
            
            <input type="password" class="input" placeholder="Парола" name="password" id="psw" required/>
            <b class="eye" id="color" onclick="eyeFunction()">👁</b>
            <br><br>

          
            

          
          <input type="text" class="input" name="address" id="address" placeholder="Адрес" required value="<?php echo $address; ?>"/>
          
          <br><br>
         
          
         
          <input type="text" class="input" name="city" id="city" placeholder="Град/Село" required value="<?php echo $city; ?>"/>
          <br><br>
          
          <input type="text" class="input" name="country" id="country" placeholder="Държава" required value="<?php echo $country; ?>"/>
          <br><br>               

          <hr>
          
          
          <button type="submit" class="registerbtn" name="submit">Изпрати</button>
          <br>

        </div>
          <br>
        <div class="container">
          <p>Вече имате акаунт? <a class="link" href="login.php">Влез</a>.</p>
        </div>
        <br><br>
      </form>
</body>
</html>


