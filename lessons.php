<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
html, body {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        body {
            background-color: rgb(15, 32, 48);
            font-family: Bradley Hand ITC;
            font-size: 20px;
            background-repeat: repeat;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Set the minimum height of the body to 100% of the viewport */
            overflow-x: hidden; /* Hide horizontal overflow */
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

        .description {
            margin-top: 150px;
            text-align: center;
            color:white;
        }

        .lessons-container {
            padding: 20px;
            margin-top: 60px; /* Adjust the margin-top value to move the lesson containers down */
        }

        .lesson-container {
            border: 1px solid rgba(255, 255, 255, 0.966);
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
            color: white;
            display: flex;
            align-items: center;
        }

        .lesson-container img {
            width: 120px;
            height: 120px;
            margin-right: 10px;
        }

        .lesson-container .lesson-content {
            flex: 1;
        }

        .lesson-container h2 {
            margin: 0;
            padding-top: 10px;
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
         .section-header{
            color:white;
         }

         /* Footer */
         .footer {
            width: 100%;
            background-color: rgb(15, 32, 48);
            padding: 20px 0;
            text-align: center;
            color: white;
        }

         table{            
            background-image: linear-gradient(to bottom,rgba(0, 0, 0, 0.466), rgba(0, 0, 0, 0.836),black,black);
            box-shadow: 2px 2px 20px black;
          }

          .content {
        flex: 1;
        overflow: auto;
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
              padding-bottom: 1%;
          }

        
    </style>
    <title>Document</title>
</head>
<body>

        <header class="heading">
            <div id="nav">
                <a href="index.html">
                    <img class="logo" src="img/gyml3w.png" alt="" >
                </a>
                <h1 class="h1">HammerCross</h1>
            </div>

             <!-- this for navbar -->
        <div class="center">
           <ul class="navbar">
               <li><a href="logedindex.php">НАЧАЛО</a></li> 
               <li><a href="aboutus.php">ЗА НАС</a></li>
               <li><a href="profile.php">ПРОФИЛ</a></li>
               <li><a href="contact.php">ЗАПИТВАНИЯ</a></li>         
            </ul>
          
        </div>
        </header>

    <div class="description">
        <p >Ето няколко упражнения,които може да изпробвате .Ако, искате фитнес програма, която да бъде специализирана за вашите изисквания 
            и вашето тяло може да отидете в отдел <a href="contact.php">ЗАПИТВАНИЯ</a>, където може да пуснете своята заявка за създаване на фитнес програма, диета или тренировка с професионален фитнес треньор!  </p>
    </div>

        <div class="lessons-container">
            <h2 class="section-header">Упражнения за бицепс</h2>
        <section class="lesson-container">
            <img src="img\изтеглен файл.jpg" alt="Lesson 1" style="width: 200px; height: 150px;">
            <div class="lesson-content">
                <h2>Сгъване с лост</h2>
                <p>За това упражнение се нуждаеш от лост и седалка за бицепс. Сядай на седалката, хвани лоста с обхват малко по-широк от раменете и извършвай сгъвания на ръцете, като вдигаш тежестта към раменете. Започни с по-лека тежест и увеличавай я постепенно.</p>
            </div>
        </section>

        <section class="lesson-container">
            <img src="img\изтеглен файл (1).jpg" alt="Lesson 2" style="width: 200px; height: 150px;">
            <div class="lesson-content">
                <h2>Концентрирани сгъвания</h2>
                <p>Седни на сгъвачка и хвани една тежест с дясната ръка. Постави лакътя на дясната ръка на вътрешната страна на бедрото и извърши сгъване на ръката, докато тежестта достигне рамото. Повтори с лявата ръка. Това упражнение е добро за изолация на бицепса.</p>
            </div>
        </section>
        
        <section class="lesson-container">
            <img src="img\hammer curl.jpg" alt="Lesson 3" style="width: 200px; height: 150px;">
            <div class="lesson-content">
                <h2>Хамер кърл</h2>
                <p>Вземи две тежести в ръцете с обхват малко по-широк от раменете. Постави ръцете си по страните на тялото, с дланите насочени навън (като при дръжката на чук). Сгъвай ръцете си, като вдигаш тежестите към раменете. Това упражнение насочва повече внимание върху външната част на бицепса.</p>
            </div>
        </section>

        <section class="lesson-container">
            <img src="img\hammer curl.jpg" alt="Lesson 4" style="width: 200px; height: 150px;">
            <div class="lesson-content">
                <h2>Хамер кърл</h2>
                <p>Вземи две тежести в ръцете с обхват малко по-широк от раменете. Постави ръцете си по страните на тялото, с дланите насочени навън (като при дръжката на чук). Сгъвай ръцете си, като вдигаш тежестите към раменете. Това упражнение насочва повече внимание върху външната част на бицепса.</p>
            </div>
        </section>


        <h2 class="section-header">Упражнения за корем</h2>


        <section class="lesson-container">
            <img src="img\basic crunch.jpg" alt="Lesson 5" style="width: 200px; height: 150px;">
            <div class="lesson-content">
                <h2>Класически криле (Crunches)</h2>
                <p>Лягайте на гърб със сгънати колена и подложете краката на земята.Сложете ръцете си зад главата или кръста.Наведете горния си тялото, като дигате рамената от земята, използвайки силата на коремните мускули.Задръжте горния позицията за кратък момент и след това се връщайте назад в контролирано движение.</p>
            </div>
        </section>

        <section class="lesson-container">
            <img src="img\reverse crunch.png" alt="Lesson 6" style="width: 200px; height: 150px;">
            <div class="lesson-content">
                <h2>Обърнати криле (Reverse Crunches)</h2>
                <p>Лягайте на гърб с ръцете изпънати вдъхнати до тялото.Подигнете краката си и съберете коленете върху гърдите си.Използвайки коремните мускули, дигнете таза си от земята, като държите краката във въздуха.След кратка пауза се връщайте назад в контролирано движение.</p>
            </div>
        </section>
        
        <section class="lesson-container">
            <img src="img\plank.jpg" alt="Lesson 7" style="width: 200px; height: 150px;">
            <div class="lesson-content">
                <h2>Планк (Plank)</h2>
                <p>Започнете като легнете на корема с лактите под раменете си.Дигнете горната си част на тялото и опритайте се на предната си част на стъпалата.Правете линия от главата до петите си, задържайки тялото си в равна позиция.Държете позицията за определено време, обикновено 30 секунди до 1 минута.</p>
            </div>
        </section>

        <section class="lesson-container">
            <img src="img\russian twist.jpg" alt="Lesson 8" style="width: 200px; height: 150px;">
            <div class="lesson-content">
                <h2>Байдарка (Russian Twist)</h2>
                <p>Сядайте на пода с изправени крака и леко сгънати колена.Поддържайте гърба си прав, накланяйки се леко назад.Заобиколете ръцете си пред тялото си и започнете да въртите коремните мускули, докато докоснете ръцете си наляво и надясно от тялото.Завъртете се в контролирано движение, осигурявайки си интензивно изпълнение на упражнението.</p>
            </div>
        </section>

        <h2 class="section-header">Упражнения за крака</h2>


        <section class="lesson-container">
            <img src="img\squats.jpg" alt="Lesson 9" style="width: 200px; height: 150px;">
            <div class="lesson-content">
                <h2>Скватове (Squats)</h2>
                <p>Започнете, като застанете с рамената си на широчина.Сложете ръцете си пред вас или ги изпънете напред за баланс.Наклонете се в коленете и хълбоците си, като си позволите да се движат към задната част на стъпалата.Свивайте коремните мускули и държете гърба си равен.Наведете се, докато бедрата ви са паралелни с пода, а след това се върнете в изходната позиция.</p>
            </div>
        </section>

        <section class="lesson-container">
            <img src="img\Front Lunges.png" alt="Lesson 10" style="width: 200px; height: 150px;">
            <div class="lesson-content">
                <h2>Челен потиск (Front Lunges)</h2>
                <p>Започнете, като застанете с рамената си на широчина.Направете голям крачка напред с едната крака, като изправите горния си торс и спуснете се, докато предната ви крака образува прав ъгъл.Наклонете се в коляното, докато задната ви коляна се приближи до земята.Върнете се в изходната позиция и повторете с другата крака.</p>
            </div>
        </section>
        
        <section class="lesson-container">
            <img src="img\Deadlift.jpg" alt="Lesson 11" style="width: 200px; height: 150px;">
            <div class="lesson-content">
                <h2>Мъртва тяга (Deadlift)</h2>
                <p>Започнете, като застанете с краката си на широчина на раменете, с дланите си спуснати високо край бедрата.Загърбете и дръжте гърба си прав, докато вдигате тежестта към тялото си.Движете се с контрол и използвайте силата на краката и гърба си, за да вдигнете тежестта до изправена позиция.Внимавайте да не извивате гърба си и да изпълнявате движението с правилна форма.</p>
            </div>
        </section>

        <section class="lesson-container">
            <img src="img\Step-ups.jpg" alt="Lesson 12" style="width: 200px; height: 150px;">
            <div class="lesson-content">
                <h2>Изпълнение на стъпки (Step-ups)</h2>
                <p>Използвайте висока пейка или стълба, на който да стъпите.Започнете с една крака, като стъпите върху пейката или стълбата.Използвайки силата на краката си, издигнете се, като изправите крака си и използвате предната крака за да изтласкате тялото си.Внимавайте да запазите стабилността и да не се навивате в кръста.След това сменете краката и повторете упражнението.</p>
            </div>
        </section>
 <!-- Add more lesson containers as needed -->
        </div>

        <footer class="footer">
        <table >
           
           
        <tr class="footoption" >
           
          <td >                                         
            <li> <a href="aboutus.php">ЗА НАС</a></li>
                <br>
            <li> <a href="contact.php">ЗАПИТВАНИЯ</a></li>                       
          </td>
          <td>               
            <li><a href="lessons.php">УРОЦИ</a></li>
                 <br>
            <li> <a href="profile.php">ПРОФИЛ</a></li> 
                                     
           </td>
           <td>                      
        <li><a href="contact.php">КОНТАКТИ</a></li>
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