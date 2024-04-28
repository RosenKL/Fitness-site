<?php
session_start();

// Check if the login form is submitted
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Database connection
    $servername = 'localhost';
    $username = 'root';
    $dbpassword = '1234';
    $dbname = 'fitness_site';

    // Create a new mysqli instance
    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the login query
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    // Check if the login is successful
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables to indicate successful login
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $user['email'];
            
            // Check if the user is an admin
            if ($user['is_admin'] == 1) {
                $_SESSION['is_admin'] = true;
                header('Location:http://localhost/site%20for%20project/Fitness-site/Admin/admin_index.php');
                exit();
            } else {
                header('Location:http://localhost/site%20for%20project/Fitness-site/Main/logedindex.php');
                exit();
            }
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    // Close the database connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

   	<script type="text/javascript" src="http://localhost/site%20for%20project/Fitness-site/Processors/login.js"></script>
	
<style>

			body {
			
				background:url('http://localhost/site%20for%20project/Fitness-site/img/bgimg.jpg');
				color:rgb(255, 255, 255);
				margin-top: 50px;
				margin-left: 100px;
			
				text-align: center;
				font-family:'Calibri', courier, monospace; 
				background-size:cover;
				background-repeat: no-repeat;
				
				
			}

			form{
				
				border-radius: 20px;
				padding: 3%;
				
				width: 60%;
				height: 30%;
				
				border-radius: 20px;
				
			}
			form:hover{
				
				background-image: radial-gradient(rgba(255, 255, 255, 0.24),  rgba(0, 0, 0, 0.349) );   
			}

			.input{
					background:rgba(0, 0, 0, 0.671);
					border:none;
					border-radius: 20px;
					border-bottom:2px solid rgba(255, 255, 255, 0.459); 
					height: 26px;
					width: 400px; 
					color: rgb(255, 255, 255);
					font-size: 24px;
					/* text-transform: lowercase; */
					text-align: center;
					word-spacing: 4px;
					letter-spacing: 2px;
					font-family:'Calibri', courier, monospace; 
					outline:none;
			}
			.input:hover{
				border-bottom:2px solid rgb(255, 255, 255);
			}

			::placeholder{
				color: white;
			}
			

			.submit{
					background:rgba(0, 0, 0, 0.671);
					border:none;
					border-radius: 20px;
					border-bottom:2px solid rgba(255, 255, 255, 0.459); 
					height: 35px;
					width: 400px; 
					color: rgb(255, 255, 255);
					font-size: 24px;
					font-weight: bold;
					text-align: center;
					word-spacing: 4px;
					letter-spacing: 2px;
					font-family:'Calibri', courier, monospace; 
				
			}
			.submit:hover{
				border-bottom:2px solid rgb(255, 255, 255); 
				letter-spacing: 8px;
				transition:0.5s;
			}
			.eye{
				
				
				border-radius: 20px; 
				background-color:rgba(30, 143, 255, 0.479);
				font-size: 23px;
				cursor: pointer;
				
			}
			.eye:hover{
				background-color: rgba(30, 143, 255, 0.178);
			}

			.link a{
				margin-left:5em ;
				text-decoration: none;
				color:dodgerblue;

				
			}
			.a{
				margin-left: 270px;
				text-decoration: none;
				color:dodgerblue;
			}
			a:hover{
				color: white;
			}
   
	</style>
			
</head>
        
<body>
	<form  method="POST" name="lform">
	
	 	
		<div class="container">
			
			<a href="http://localhost/site%20for%20project/Fitness-site/Main/index.php"><img src="http://localhost/site%20for%20project/Fitness-site/img/gyml3w.png" class="avtar" width="130"hight="130"></a>
			
			<h1>ДОБРЕ ДОШЛИ В HAMMERCROSS</h1>
			<br>

			<input type="email" class="input" name="email" placeholder="Е-майл"  required="">
        	 <br><br>
			
			<input type="password" class="input" name="password" id="psw" placeholder="Парола" required="" >
			
			<b class="eye" id="color" onclick="eyeFunction()">👁</b>
			<br><br><br>

			<button type="submit" class="submit" name="submit">Да започваме!</button>
		 </div>
		 <br><br>
		<div class="container">
			
			<span class="">
				<a class="a" href="http://localhost/site%20for%20project/Fitness-site/Main/registration.php">Нямаш акаунт?Регистрирай се бързо и лесно!</a>
			</span>
		</div>
	</form>

</body>
</html>