<?php
    session_start();
    if(!isset($_SESSION['email']))
    {
    header('location:login.php');
    }

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
try {
  if (isset($_POST['submit'])) {
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $email = $_POST['email'];
      $mobile = $_POST['mobile'];
      $category = $_POST['category'];
      $comment = $_POST['textarea'];

      // Insert the form data into the "appointment" table
      $sql = "INSERT INTO appointment (firstname, lastname, email, mobile, category, comment) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssssss", $firstname, $lastname, $email, $mobile, $category, $comment);
      $stmt->execute();

      
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
try {
  if (isset($_POST['send'])) {
      $email = $_SESSION['email'];
      $rating = $_POST['rate'];

      // Insert the rating into the "rating" table
      $sql = "INSERT INTO rating (email, rating) VALUES (?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $email, $rating);
      $stmt->execute();

      
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>

    <style>
      body{
        
        display: block;   
        padding: 100px 150px;
        font-family: 'Calibri', Courier, monospace;
        background:url('img/contactbg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
       
      }
      table{
        padding: 2%;
        border: 1px solid rgba(68, 66, 66, 0.377);
        border-radius: 15px;
        width: 50%;
        height: 50%;
        background-color: rgba(0, 0, 0, 0.39);
        transition:1s;
      }
      .contact{
        padding: 20px;
        /* border: 2px solid ; */
        border-radius: 15px;
        background-color: rgba(240, 248, 255, 0.534);
      }
      .container{
        padding: 20px;
      }
      
      .input{
         border:none;
         border-radius: 4px;
         border-bottom:2px solid rgb(99, 96, 96); 
         height: 20px;
         width: 250px; 
         color: rgb(110, 108, 108);
         font-size: 16px ;
         font-weight: bold;
         text-align: center;
         font-family: 'Calibri', Courier, monospace;
         transition:1ms;
         
      }

      #Category{                    /* for select tag*/
          text-align-last:center;
          height: 24px;
          width: 255px;
        }

      .input:hover{

        background-color: rgba(255, 255, 255, 0.671);
        }
       
    
     
      table:hover{
        background-color: rgba(240, 248, 255, 0.39);
      }

      button{
         border:none;
         border-radius: 4px;
         /* border-bottom:2px solid rgb(255, 255, 255);  */
         height: 28px;
         width: 255px; 
         color: rgb(0, 0, 0);
         font-size: 20px ;
         font-weight: bold;
         text-align: center;
         font-family: 'Calibri', Courier, monospace;
         
         transition:0.5s;
      }

      button:hover{
        color: rgb(255, 255, 255);
        background-color: rgba(0, 0, 0, 0.644);
        text-shadow: 1px 1px 10px rgb(255, 255, 255);
      }
      
      .contact h3 img{
        padding: 5px;
        margin:0px;
        position: absolute;
        width: 20px;
        height: 20px;             
      }     
      
      .contact h3 b{
       
        margin-left: 40px;
        font-size: 16px;
        font-weight: bold;
        
        
      }
      p {
  color: white; /* Set the text color to bright red */
  font-family: 'Montserrat', Arial, sans-serif;
  text-decoration: none;
}

      .contact h3 a{
        text-decoration:none;
        color:black;
      }

       /* social media icon */
      .col{
        text-align:center;
        
      }
      
      .col a{
        text-decoration: none;
        padding: 0px;
        margin:9px;
        width: 35px;
        height: 35px;
        
        
      }
      .col a:hover{
        filter:invert(100%);    /* for inverting image color */
       
      }

      .rate{
        width: 300px;
        padding: 10px;
        position: absolute;   
        margin-left: 55%;
        font-size: 20px;
        font-weight: bold;     
        border-radius: 15px;
        color: white;
        text-shadow: 2px 2px 2px rgb(0, 0, 0);
      }


      .rate .raticon{
        margin-left: 30%;
        width: 100px;
        height: 100px;
        box-shadow:  4px 4px 4px black;
        border-radius: 50%;
      }
      
      .opt{
        margin-left: 20%;
      }

      .opt input{
        cursor: pointer;
        
      }

      .submit{
        background-color:rgba(0, 0, 0, 0.486);
        
        color:white;
        font-size: 18px;
        margin-left: 20px;
        margin-top: 8px;
        letter-spacing: 2px;
        border:1px solid white;
        text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.911);
        font-weight: bold; 
        cursor:pointer;
      }
      .submit:hover{
        background-color:rgba(0, 0, 0, 0);
        
      }
     
    </style>
</head>
<body>


    
  <table>
      <tr>
         
            <td>
            <div class="contact">
                <h1>НАШИТЕ КОНТАКТИ</h1>
                
                <h3>
                  <img src="img/mail-i.png" alt=""><b>HammerCross@gmail.com</b>
                </h3>
                
                <h3>
                    <img src="img/phone-i.png" alt=""><b>0895757180</b><br>
                                                      <b>0898274365</b>
                </h3>
                
                <h3>
                  
                   <img src="img/add-i.png"  ><b>кв. Север, гр.Ботевград<br> </b>
                  </a>
                </h3>

                <div class="col">
                  
                  <a href="#" class="twitter btn">
                     <img class="twitter" src="img/tweet-i.webp">
                  </a>
                  <a href="#" class="fb btn">
                     <img class="facebook" src="img/fb-i.webp">
                  </a>
                  <a href="#" class="insta btn">
                     <img class="instagram" src="img/insta-i.webp">
                  </a>
                </div>
            </div>

          </td>
  
          <td>
            <form action="contact.php" method="POST" >
                <div class="container">
                                                  
                                    
                  <input type="text" class="input" placeholder="Име" name="firstname" id="firstname" required/>
                  <br>
                  <br>
                  <input type="text" class="input" placeholder=" Фамилия" name="lastname" id="lastname" >
                  <br>
                  <br>        
                                   
                  <input type="text" class="input" placeholder="Емайл" name="email" id="email" required/>
                  <br>
                  <br>     
                  <input type="number" class="input" name="mobile" id="mobile" placeholder=" Тел. номер" size="10" required/>
                  <br> 
                  <br>
                  
                  <select class="input"  name="category" id="Category" required>
                    <option name="category" value="" selected >Заявка за..</option>
                    <option name="category" value="Тренировка с тренъор" >Тренировка с тренъор</option>
                    <option name="category" value="Режим за хранене" >Режим за хранене(Диета)</option>
                    <option name="category" value="Режим за тренировки" >Режим за тренировки</option>
                    <option name="category" value="Друго" >Друго</option>
                  </select>
                  <br>
                  <br>

                  <textarea name="textarea" class="input" id="textarea" cols="" rows="" placeholder="Добавете коментар към заявката" ></textarea>
                       
                  <br>
                  <br>
                  
                  <button type="submit" name="submit">Submit</button>
                </div>
                <p>След като подадете заявката си ,нашият екип ще се свърже с вас <strong> в най-кратък възможен срок!</strong></p>
                            
               
              </form>

          </td>
         
      </tr>
      




      <div class="rate">
        <a href="logedindex.php">
          <img class="raticon" src="img/gyml3w.png" alt="">
        </a>
        
           
            <div class="opt" >
              <form action="contact.php" method="POST" >
                <h3>Дайте мнение за нашето..<br>представяне!</h3>
                <input  type="radio" name="rate" value="Най-добрите!" /> Най-добрите!
                <br>
                <input  type="radio" name="rate" value="Много добро!" /> Много добро!
                <br>
                <input  type="radio" name="rate" value=" Добро." /> Добро.
                <br>
                <input  type="radio" name="rate" value="Слаба работа!"/> Слаба работа!
                <br>
              
                <input type="submit" value="Send" name="send" class="submit"/>
              </form>
            </div>
            
      </div>


  </table>

  
     
</body>
</html>


     