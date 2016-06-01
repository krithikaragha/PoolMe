<!DOCTYPE html>
<?php
  session_start();
  $is_driver = $_SESSION['SESS_IS_DRIVER'];
  $firstname = $_SESSION['SESS_FIRST_NAME'];
  $lastname = $_SESSION['SESS_LAST_NAME'];
  $email = $_SESSION['SESS_EMAIL'];
  $phone = $_SESSION['SESS_PHONE'];
 ?>
<html>

<head>
	<meta charset="utf-8">
	<title> Byte Me </title>
	<link rel="stylesheet" href="../css/message_page.css" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

<style>
@font-face {
  font-family: "Chalky";
  src: url("../font/Eraser.ttf");
  src: local("☺"),
    url("../font/Eraser.ttf") format("truetype"),   
  }
  .container {
        margin: 0 auto;
        width: 250px;
        clear: both;
    }
    .container input {
        width: 100%;
        clear: both;
    }
    .errorDisplay {
        margin: 10px 0px;
        padding:12px;
        color: #D8000C;
        background-color: #FFBABA;
    }
  </style>
</head>


<body background="../images/g2.png">
	<div id="wrapper"> 
	<header>
		<img src="../images/car.png" height="120" width="120">
		<h1>Pool Me !</h1>
	
	
	<nav>
	<ul>
	<li><a href="signout.php"> <div id="orange1"> Sign Out </div> </a></li>
	<li><a href="../aboutus.html"> <div id="orange"> About Us</div></a></li>
	<li><a href="../homepage.html"> <div id="orange"> Home </div></a></li>
	</ul>
</nav>
</header>


<section>
<div class = "section" ><br><br><br><br>
        <h2>Send An Email</h2>
        <form action="mailto:?" method="post" enctype="text/plain">
          Name:<br>
          <input class = "input" type="text" name="name" ><br>
          <!-- Email:<br>
          <input class = "input" type="text" name="email"><br> -->
          Message:<br>
          <input id = "message" type="text" name="message"><br>
          <input class = "button" type="submit" value="Submit"> <br>
          <input class = "button" type="reset" value="Reset">
        </form>
    </div>

<div class="aside">
</div>


 	

	<marquee class="car" direction="left" scrollamount="7" behavior="scroll">
	<img src="../images/m1.png" height="100"> Ride Now...
	</marquee>

</section>
	
	<footer>
	<p>Copyright © Sonal Maloo, <small>All Rights Reserved !</small></p>
	</footer>


	
	
	</div> <!--closing wrapper-->
	</body>
	</html>
