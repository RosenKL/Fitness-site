<?php
session_start();
 //Check if the user is already logged in
if (isset($_SESSION['email'])) {
    // Redirect the user to the appropriate page based on their role
   if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
        header('Location: http://localhost/site%20for%20project/Fitness-site/Admin/admin_index.php');
        exit();
    } else {
       header('Location: http://localhost/site%20for%20project/Fitness-site/Main/logedindex.php');
       exit();
   }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="gym,fitness,health">
    <title>home</title>
     
    <style>
       
       body{
            padding: 0%;
            margin: 0%;
            background-image: url("http://localhost/site%20for%20project/Fitness-site/img/gymbgl34.webp");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }       
        
        
        .left{
            position:absolute;
            display: flex;
            left:20px;
            }

        .left img{
            width: 100px;
            border-radius: 100px;
            box-shadow: 2px 2px 2px rgb(255, 255, 255);
            }

        .center{
            display: flex;
            width: 70%;
            height:45px;
            left: 43%;
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
            padding: 34px 8px ;
            text-shadow: 2px 2px 20px black;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            
        }
        .navbar li a:hover {
           
            /* text-decoration:underline .5px ; */
            /* color:#fbff00;
            color:cyan; */
            text-shadow:0 0 10px cyan,
            0 0 25px cyan,
            0 0 40px cyan,
            0 0 55px cyan,
            0 0 70px cyan,
            0 0 80px cyan;
            
        }




      
          table{
            position: absolute;
            /* width: 100%;  */
            top: 212%;           
            background-image: linear-gradient(to bottom,rgba(0, 0, 0, 0.466), rgba(0, 0, 0, 0.836),black,black);
            box-shadow: 2px 2px 20px black;
              
          }
          .footdown{
             
              text-align: center;
              color: white;
              padding-bottom:20px;
              padding-top:50px;
             
          }
          .footoption{
            
              color: rgb(255, 255, 255);
              /* border:1px solid red; */
                           
          }

          .footoption li {
            display: inline-block;
            padding: 2%;
            
          }

          a{
              text-decoration: none;
              color: white;
          }
          a:hover
          {
              color: rgb(255, 255, 0);
              text-shadow: 4px 4px 30px  white;
          }
          .footoption td{
              width: 5%;
              padding-left: 10%;
              padding-top: 2%;
              padding-bottom: 1%;
          }

          .pagec{
              display: flex;
              width: 100%;
              /* height: 100vh; */
              /* margin-top: 278px; */
              margin-top:250px ;
              padding-left: 5%;
              padding-top: 15%;
              padding-bottom: 35%;
              /* background-image: url("img/bgtemp2.png"); */
              background: url("http://localhost/site%20for%20project/Fitness-site/img/bgtemp2.png");
              background-repeat: no-repeat;
              background-size: 100% 80%;
              /* background-color: rgba(79, 155, 255, 0.685); */
            
              
              
          }

          .pagediv{
                
                margin-left: 2%;
                padding: 2%;
                border-radius: 20px;
                box-shadow:0px 0px 40px 10px rgba(0, 0, 0, 0.397);
                color:rgb(255, 255, 255);
                width: 25%;
                background-color: rgba(0, 0, 0, 0.829);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

          .pagediv:hover{
             
               background-color: rgb(255, 255, 255);
               color: rgb(31, 31, 31);
               box-shadow:0px 0px 40px 10px rgba(255, 255, 255, 0.521);
              
        }

       

        .main{
            display:flex;
            justify-content:center;
            align-items:center;
            width:130%;
            height:85vh;
            color:white;
            text-align:center;
        }

        section:hover{
            background-color:rgba(0, 0, 0, 0.421);
            border-radius:30px;
            padding:50px;
            transition:2s;
        }
      
       
        section h3{
           
            font-size: 35px;
            font-weight: 200px;
            letter-spacing: 20px;
            font-weight: lighter;
            text-shadow: 2px 2px 20px rgb(255, 255, 255);
           
        }
        section h1{
            margin: 20px 0 10px 0;
            
            text-shadow: 2px 12px 2px rgb(0, 0, 0);
            text-transform: uppercase;
        }
        .name{
            font-size:50px;
            text-shadow:0 0 10px cyan,
            0 0 20px  cyan,
            0 0 30px cyan,
            0 0 70px cyan;
            
        }
        section p{
            margin-bottom: -10px;
            font-size: 30px;
            letter-spacing: 1px;
            font-weight:lighter;
           
        }
        .b1{
            color: dodgerblue;
        }
        .b1:hover{
            color: white;
        }
        .footer{
            position: relative;
            bottom: 205px;
        }
    </style>
</head>
<body>
    
   
   
  
    <header class="header">
       
        <div class="left">
          
           <img src="http://localhost/site%20for%20project/Fitness-site/img/gyml3w.png" >       
                        
        </div>

       

        <!-- this for navbar -->
        <div class="center">
           <ul class="navbar">
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/aboutus.php">ЗА НАС</a></li>
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/profile.php">ПРОФИЛ</a></li>
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/contact.php">ЗАПИТВАНИЯ</a></li>
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/catalog.php">КАТАЛОГ</a></li> 
               <li><a href="http://localhost/site%20for%20project/Fitness-site/Main/registration.php">РЕГИСТРАЦИЯ</a></li>
               <li> <a href="http://localhost/site%20for%20project/Fitness-site/Main/login.php">ВЛЕЗ</a></li>             
            </ul>
          
        </div>
              
    


    <div class="main">
        <section>
           
            <!-- <h3>&nbsp;WELCOME <br></h3> -->
            <h1 class="name">HammerCross</h1>
            <p>Здраво тяло,здрав живот</p>
            <h1>Включи се сега</h1>
            <!-- <p>"stop Wishing start Doing"</p> -->
            <a href="http://localhost/site%20for%20project/Fitness-site/Main/aboutus.php" class="b1">Научи повече &nbsp;</a>
            <a href="http://localhost/site%20for%20project/Fitness-site/Main/registration.php" class="b1">Регистрирай се</a>
        </section>
    </div>

    <div class="pagec">
        <div class="pagediv" >
            <h3>Фитнес</h3>
            
            <p>"Фитнесът е пътят, който води към силата на тялото, ума и духа. Не го пропускай - той е ключът към постижения и преодоляване на границите."</p>
        </div>
        <div class="pagediv" >
            <h3>Диети</h3>
           
            <p>"Здравето не е само за ценителите на фитнес залите, то е и за тези, които избират мъдростта на правилното хранене."</p>
        </div>
        <div class="pagediv" >
            <h3>Тренировки</h3>
            <p>"Дайте ми минутка, добър съм. Дай ми един час, перфектен съм. Дай ми шест месеца, и ще бъда непобедим."</p> 
            
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

   