<!DOCTYPE html>

<?php
	session_start();
	$is_driver = $_SESSION['SESS_IS_DRIVER'];
?>
<html>

<head>
	<meta charset="utf-8">
	<title> Byte Me </title>
	<link rel="stylesheet" href="../css/home.css" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<?php
		if ($is_driver == 0) {
			echo '<meta http-equiv="refresh" content="3;url=homepage.php">';
		} else {
			echo '<meta http-equiv="refresh" content="3;url=../driver_home.html">';
		}
	?>
<style>
@font-face {
  font-family: "Chalky";
  src: url("../font/Eraser.ttf");
  src: local("☺"),
    url("../font/Eraser.ttf") format("truetype"),   
  }
  </style>
</head>

<body background="../images/b1.jpg">
	<div id="wrapper"> 
	<header>
		<img src="../images/car.png" height="120" width="120">
		<h1>Pool Me !</h1>
	<div class="nav">
	<ul>
	<li><a href="homepage.html"> <div id="orange"> Sign Out</div> </a></li>
	<li><a href="aboutus.html"> <div id="orange"> About Us</div></a></li>
	<li><a href="homepage.html"> <div id="orange"> Home </div></a></li>
	
	</ul>
	</div>
	</header>
	<section>
		<div id="main">
		<div id="content">
			<p>Congratulations!
				<br/>Your request has been submmited to the driver!
			</p>
			<p class="tip">
				If your browser doesn't jump automatically, please
			</p>
			<a id="homepage" href="../homepage.html">click here</a>
			<p class="tip">
				.
			</p>
		</div>
	</div>
	
<marquee class="car" direction="left" scrollamount="7" behavior="scroll">
<a href="direction.html"><img src="../images/m1.png" height="200"> </a> Ride Now...
</marquee>

	</section>
	
	<footer>
	<p>Copyright © Sonal Maloo, <small>All Rights Reserved !</small></p>
	</footer>


	
	
	</div> <!--closing wrapper-->
	</body>
	</html>
