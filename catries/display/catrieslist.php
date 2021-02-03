<?php

session_start();
include"../db.php";
$cat_id = $_GET['catid'];
$username = $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $tque = $_POST['tque'];
     $que = $_POST['que'];
       if (empty($tque) || empty($que)) {
            echo "Please fill the filed";
       }else{
            $sql = "SELECT * FROM `catrieslist` WHERE tque = '$tque'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 1) {
                 echo "Title is all ready taken";
            }else {
                 $sql = "INSERT INTO `catrieslist`(`cat_id`, `tque`, `que`, `username`) VALUES ('$cat_id', '$tque', '$que', '$username')";
                 $result = mysqli_query($conn, $sql);
                 if ($result) {
                      
                 }
            }
     }
}

$sqlc = "SELECT * FROM `catries` WHERE cat_id = '$cat_id'";
$resultc = mysqli_query($conn, $sqlc);
while($row = mysqli_fetch_assoc($resultc)){
     $paira = $row['paira'];
     $title = $row['title'];
     $user = $row['username'];
   
}
$sqli = "SELECT * FROM `userimage` WHERE username = '$user'";
$resulti = mysqli_query($conn, $sqli);
while($row = mysqli_fetch_assoc($resulti)){
     $uimg = $row['image'];
}

?>
<!DOCTYPE html>
<html>
     <head>
          <meta http-equiv="content-type" content="text/html; charset=utf-8" />
          
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Catries List Display and Show</title>
          <link rel="stylesheet" href="stylecatlist.css" type="text/css" media="all" />
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
     </head>
     <body>
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
                              <li><a href="catries/addcatries.php">Add Catries</a></li>
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
          <section>
               <div class="main">
                    <div class="trxtbx">
                         <h2>Welcome to <?php echo $title; ?> Fourms</h2>
                         <p><?php echo $paira; ?></p>
                         <br />
                         <br />
                         <h3>Rules</h3>
                         <p>Please read the rules No gaming discussing, No matter what is going happening Friday and3</p>
                    </div>
                    <div class="user">
                         <img src="/Account/<?php echo $uimg; ?>" alt="" />
                         <h5>Mr. <?php echo $user; ?></h5>
                    </div>
               </div>
          </section>
          <div class="modal">
               <?php
               session_start();
               if (isset($_SESSION['loggedin']) || $_SESSION['loggedin']  == true) {
                    echo' <a class="btn" onclick="popupTongle();">Show Insert Que</a>';
               }
               ?>
               <div id="popup">
                    <i class="fa fa-times" aria-hidden="true" onclick="popupTongle();"></i>
                    <h2>Please fill the Python Catries filed</h2>
                    <form action="#" method="POST" accept-charset="utf-8">
                         <label>Title lines</label>
                         <textarea name="tque" id=paira rows="2" cols="40" placeholder="Please Text PairaGrap" maxlength="100"></textarea>
                         <label>What's a problem</label>
                         <textarea name="que" id=paira rows="8" cols="40" placeholder="Please Text PairaGrap"></textarea>
                    
                         <input class="btns" type="submit" value="Submit" />
                    </form>
                    
               </div>
          </div>
          <div class="que">
               <h3><span>-IDISCUSE-</span> Browse Question</h3>
          </div>
          <?php
          
          $sqli = "SELECT * FROM `catrieslist` WHERE cat_id = '$cat_id'";
          $result = mysqli_query($conn, $sqli);
          while($row = mysqli_fetch_assoc($result)){
               $user = $row['username'];
               $catlist_id = $row['catlist_id'];
               $tque = $row['tque'];
               $que = $row['que'];
               
               $uimg = "SELECT * FROM `userimage` WHERE username = '$user'";
                    $uresult = mysqli_query($conn, $uimg);
                    while($row = mysqli_fetch_assoc($uresult)){
                         $img = $row['image'];
                    }
          ?>
          <div class="catries">
               <img src="/Account/<?php echo $img; ?>" alt="" />
               <div class="fetchdb">
                    <h5><?php echo $tque; ?></h5>
                    <p><?php echo $que; ?></p>
                    <a class="view" href="catcoment.php?catlist_id=<?php echo $catlist_id ?>">View more</a>
               </div>
          </div>
          <?php
          }
          ?>
          
          <script type="text/javascript" charset="utf-8">
               function popupTongle(){
                    const popup = document.getElementById('popup');
                    popup.classList.toggle('active');
               }
          </script>
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