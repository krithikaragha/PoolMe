<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title> Byte Me </title>
	<link rel="stylesheet" href="../css/home.css" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

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
	<li><a href="../homepage.html"> <div id="orange"> Sign Out</div> </a></li>
	<li><a href="../aboutus.html"> <div id="orange"> About Us</div></a></li>
	<li><a href="../homepage.html"> <div id="orange"> Home </div></a></li>
	<li><a href="../cardetail.html"> <div id="orange"> Become a Driver </div></a></li>
	
	</ul>
	
	<div id="searchbar">
		<form id="search" action="search_result.php" method="post">
			<input class="inputs" type="text" name="start" placeholder="Departure" required=""/>
			<input class="inputs" type="text" name="end" placeholder="Destination" required="" /><br>
<!-- 			<input class="inputs" type="text" placeholder="Enter Date" required=""/> -->
			<input class="inputs" type="text" name="daytime" placeholder="Enter Time" required=""/>
			<input class="inputs" type="text" name="guest_num" placeholder="Guests" required=""/><br>
			<input id="button" type="submit" value="Search" />
		</form>
	</div>
	</div>
	</header>
	<section>
	<h5> Need A<span> Ride ???</span></h5>
	
	
<!-- <marquee class="car" direction="left" scrollamount="7" behavior="scroll">
<a href="direction.html"><img src="../images/m1.png" height="200"> </a> Ride Now...
</marquee>
 -->
	</section>
	
	<footer>
	<p>Copyright © ByteMe, <small>All Rights Reserved !</small></p>
	</footer>


	
	
	</div> <!--closing wrapper-->
	</body>
	</html>
