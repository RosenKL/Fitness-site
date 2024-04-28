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
$dbname = "fitness_site";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch orders from the database
    $stmt = $conn->query("SELECT * FROM orders");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $conn->query("SELECT * FROM appointment");
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <script>
        function updateStatus(selectElement, orderId) {
            const status = selectElement.value;
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://localhost/site%20for%20project/Fitness-site/Processors/update_order_status.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText); // You can handle the response as needed
                } else {
                    console.error('Request failed. Status:', xhr.status);
                }
            };
            xhr.send('order_id=' + orderId + '&status=' + status);
        }
    </script>
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
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Admin/admin_panel.php"> ПОРЪЧКИ</a></li>  
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Admin/admin_panel_add_products.php"> ДОБАВИ ПРОДУКТ</a></li>        
            </ul>
          
        </div>
</header>
  
<div style="text-align: center;">
    <h3 style="color: white;">Поръчки</h3>
<div class="table-container">
        <table>
            <tr>
                <th>Име</th>
                <th>Фамилия</th>
                <th>Тел. номер</th>
                <th>Обща сума</th>
                <th>Статус</th>
                <th>Създадена на</th>
            </tr>
            <!-- PHP code to fetch and display orders -->
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['firstname']; ?></td>
                    <td><?php echo $order['lastname']; ?></td>
                    <td><?php echo $order['mobile']; ?></td>
                    <td><?php echo $order['total_price']; ?></td>
                    <td>
                        <select onchange="updateStatus(this, <?php echo $order['id']; ?>)">
                            <option value="in_progress" <?php if ($order['status'] == 'in_progress') echo 'selected'; ?>>In Progress</option>
                            <option value="sent" <?php if ($order['status'] == 'sent') echo 'selected'; ?>>Sent</option>
                            <option value="delivered" <?php if ($order['status'] == 'delivered') echo 'selected'; ?>>Delivered</option>
                        </select>
                    </td>
                    <td><a href="http://localhost/site%20for%20project/Fitness-site/Main/order_details.php?id=<?php echo $order['id']; ?>"><?php echo $order['created_at']; ?></a></td>
              
                </tr>
            <?php endforeach; ?>
        </table>
       </div>
    </div>

<br>
<br>
<div style="text-align: center; margin-bottom: 50px;">
    <h3 style="color: white; ">Заявки</h3>
    <div class="table-container" style="margin-bottom: 100px;">
    <table>
        <!-- Table header -->
        <tr>
            <th>Име</th>
            <th>Фамилия</th>
            <th>Тел. номер</th>
            <th>Email</th>
            <th>Категория</th>
            <th>Коментар</th>
            <th>Дата</th>
        </tr>
        <!-- PHP code to fetch and display appointments -->
        <?php foreach ($appointments as $appointment): ?>
            <tr>
                <td><?php echo $appointment['firstname']; ?></td>
                <td><?php echo $appointment['lastname']; ?></td>
                <td><?php echo $appointment['mobile']; ?></td>
                <td><?php echo $appointment['email']; ?></td>
                <td><?php echo $appointment['category']; ?></td>
                <td><?php echo $appointment['comment']; ?></td>
                <td><?php echo $appointment['appointment_date']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
     </div>
</div>
</body>
</html>