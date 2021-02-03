<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
     echo "you are not logged Please logged here";
     header('location: ../account/login.php');
     exit();
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     include "../db.php";
     
     $title = $_POST["title"];
     $paira = $_POST["paira"];
     
     if (empty($title) || empty($paira)) {
          echo "Please fill the filed";
          // header('location: ../account/login.php#catries');
          exit();
     }else {
          $sql = "SELECT * FROM `catries` WHERE title = '$title'";
          $result = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($result);
          if ($num == 1) {
               echo "Your Catries Name $itite is all ready taken";
               exit();
          }else {
               $user = $_SESSION['username'];
               $sqli = "INSERT INTO `catries`(`title`, `paira`, `username`) VALUES ('$title', '$paira', '$user')";
               $res = mysqli_query($conn, $sqli);
               if ($res) {
                   
                   
                    header('location: ../index.php#catries');
               }else {
                    echo "nooooo";
                    exit();
               }
          }
     }
}


?>
<!DOCTYPE html>
<html>
     <head>
          <meta http-equiv="content-type" content="text/html; charset=utf-8" />
          <meta name="viewport" content="width=device-width,  initial-scale=1.0">
          <title>Lonin and Registration Pages</title>
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
          <link rel="stylesheet" href="style.css" type="text/css" media="all" />
     </head>
     <body>
          <div class="bgc"></div>
     <header>
          <div class="logo">
               <a href="#">IDISCUSE</a>
          </div>
          <nav class="nav">
               <ul>
                    <li><a href="/index.php">Home</a></li>
                    <li class="menushow"><a>Catries<i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                         <ul class="l">
                              <li><a href="/index.php#catries">Catries</a></li>
                              <li><a href="/catries/addcatries.php">Add Catries</a></li>
                         </ul>
                    </li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">About Us</a></li>
                    <li class="showprofile"><a>Account<i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                         <ul class="pm">
                              <li><a href="/account/profile.php">Profile</a></li>
                              <li><a href="/account/login.php">Login</a></li>
                              <li><a href="/account/Signup.php">Register</a></li>
                              <li><a href="/account/logout.php">logout</a></li>
                         </ul>
                    </li>
                  <!--  <a class="profile" href="account/profile.php"><img src="image/icon/user.png" alt="" /></a>-->
               </ul>
               <div class="searchBx">
                    <form action="" method="get" accept-charset="utf-8">
                         <input type="search" placeholder="Search Box">
                         <input class="sbtn" type="submit" name="submit" value="Submit">
                    </form>
               </div>
          </nav>
          <div id="menu">
               <div class="line1"></div>
               <div class="line2"></div>
               <div class="line3"></div>
          </div>
     </header>
          <div class="main">
          <div class="card">
               <h3> Hello Mr/Mrs <?php echo $_SESSION['username']; ?> Please Categories Generate </h3>
               <div class="registration">
                    <form action="#" method="POST" accept-charset="utf-8">
                         <div class="input-filed">
                              <label>Catries Name</label>
                              <select name="title" id="title" placeholder="select title">
                                   <option> --select-- </option>
                                   <option>PYTHON</option>
                                   <option>HTML</option>
                                   <option>CSS</option>
                                   <option>JAVASCRIPT</option>
                                   <option>C++</option>
                                   <option>C</option>
                                   <option>Android Studio</option>
                              </select>
                         </div>
                         <div class="input-filed">
                              <label>Catries Name</label>
                              <textarea name="paira" id=paira rows="8" cols="40" placeholder="Please Text PairaGrap"></textarea>
                         </div>
                         
                         <div class="btn">
                              <input type="submit" value="Generate" />
                         </div>
                         <div class="paire">
                              <p> Social Media Icon look this</p>
                         </div>
                         <div class="social-icon">
                              <i class="fa fa-facebook" aria-hidden="true"></i>
                              <i class="fa fa-google" aria-hidden="true"></i>
                              <i class="fa fa-twitter" aria-hidden="true"></i>
                              <i class="fa fa-linkedin" aria-hidden="true"></i>
                         </div>
                    </form>
               </div>
          </div>
          </div>
          
        <script type="text/javascript" charset="utf-8">
             const header = () => {
             const menu = document.querySelector('#menu');
             const nav = document.querySelector('.nav');
             const list = document.querySelector('.nav li a');
          
             menu.addEventListener('click', () => {
                  nav.classList.toggle('active');
               
                  //menu style animations 
                  menu.classList.toggle('close');
             });
       }
     
     header();
        </script>
     </body>
</html>