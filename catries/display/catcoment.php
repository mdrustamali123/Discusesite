<?php
session_start();
include"../db.php";
$catlist_id = $_GET['catlist_id'];
$susername = $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $paira = $_POST['paira'];
     if (empty($paira)) {
          echo "Please fill the filed";
     
     }else {
          $sql = "SELECT * FROM `answer` WHERE paira = '$paira'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
          if ($num == 1) {
               echo "This $paira is all ready taken";
          }else{
               $sqli = "INSERT INTO `answer`(`catlist_id`, `paira`, `username`) VALUES ('$catlist_id', '$paira', '$susername')";
               $resulti = mysqli_query($conn, $sqli);
               if (!$resulti) {
                   echo "your comment is not Successful";
               }
          }
          
     }
}



$sql = "SELECT * FROM `catrieslist` WHERE catlist_id = '$catlist_id'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
     $tque = $row['tque'];
     $que = $row['que'];
     $username = $row['username'];

}

$sql = "SELECT * FROM `userimage` WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
     $img = $row['image'];
     
}

?>

<!DOCTYPE html>
<html>
     <head>
          <meta http-equiv="content-type" content="text/html; charset=utf-8" />
          
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Catries List Display and Show</title>
          <link rel="stylesheet" href="catcoment.css" type="text/css" media="all" />
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
          <style>
               .dbname{
                    color: #646464;
                    font-weight: 700;
                    float: right;
                    margin: 10px
               }
               .dbname span{
                   border-bottom: 0.9px solid red;
               }
          </style>
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
          <section>
               <div class="main">
                    <div class="trxtbx">
                         <h2><?php echo $tque; ?></h2>
                         <p><?php echo $que; ?></p>
                         <br />
                         <br />
                         <h3>Rules</h3>
                         <p>Please read the rules No gaming discussing, No matter what is going happening Friday and3</p>
                    </div>
                    <div class="user">
                         <img src="/account/<?php echo $img ?>" alt="" />
                         <h5>Mr. <?php echo $username ?></h5>
                    </div>
               </div>
          </section>
          <div class="modal">
               <?php
               if (isset($_SESSION['loggedin']) || $_SESSION['loggedin']  == true) {
                    echo' <a class="btn" onclick="popupTongle();">Coment</a> ';
               }
               ?>
               <div id="popup">
                    <i class="fa fa-times" aria-hidden="true" onclick="popupTongle();"></i>
                    <h2>Please text Coment</h2>
                    <form action="#" method="POST" accept-charset="utf-8">
                         <label>Coment</label>
                         <textarea name="paira" id=paira rows="8" cols="40" placeholder="Please Text PairaGrap"></textarea>
                    
                         <input class="btns" type="submit" value="Submit" />
                    </form>
               </div>
          </div>
          <div class="que">
               <h3><span>-IDISCUSE-</span> Browse Coments</h3>
          </div>
          <?php
          
          $sql = "SELECT * FROM `answer` WHERE catlist_id = '$catlist_id'";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
               $paragraph = $row['paira'];
               $pairausername = $row['username'];
               
               $sqli = "SELECT * FROM `userimage` WHERE username = '$pairausername'";
               $result = mysqli_query($conn, $sqli);
               while($row = mysqli_fetch_assoc($result)){
                    $image = $row['image'];
               
               ?>
          <div class="catries">
               <img src="/account/<?php echo $image; ?>" alt="" />
               <div class="fetchdb">
                    <p><?php echo $paragraph; ?></p>
                    <p class="dbname">Comment By <span><?php echo $pairausername; ?> </span></p>
               </div>
          </div>
          <?php
               }
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