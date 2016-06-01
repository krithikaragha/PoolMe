<!DOCTYPE html>
<?php
  //Start session
  session_start();
  //Unset the variables stored in session
  unset($_SESSION['SESS_USER_ID']);
  unset($_SESSION['SESS_FIRST_NAME']);
  unset($_SESSION['SESS_LAST_NAME']);
  unset($_SESSION['SESS_EMAIL']);
  unset($_SESSION['SESS_IS_DRIVER']);
  unset($_SESSION['SESS_PHONE']);
 ?>
<html>

<head>
	<meta charset="utf-8">
	<title> Byte Me </title>
	<link rel="stylesheet" href="../css/signin.css" type="text/css">
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

<script >
    function checkEmptyField()
    {
        var email = document.getElementById("email").value;
        var passwd = document.getElementById("password").value;
        var errors = "";
        var errorOutput = document.getElementById("errorDisplay");
        if (email == null || passwd == null)
        {
            errors += "Error! Fieldnames cannot be empty."
        }
        if(errors != "")
        {
            errorOutput.innerHTML = errors;
            return false;
        }
        return true;
    }
</script>

<body background="../images/g2.png">
	<div id="wrapper"> 
	<header>
		<img src="../images/car.png" height="120" width="120">
		<h1>Pool Me !</h1>
	
	
	<nav>
	<ul>
	<li><a href="login.php"> <div id="orange1"> Sign In </div> </a></li>
	<li><a href="../aboutus.html"> <div id="orange"> About Us</div></a></li>
	<li><a href="../homepage.html"> <div id="orange"> Home </div></a></li>
	</ul>
</nav>
</header>


<section>
<div class="article">
<div id="login">
 		<div class="head"> Log In
 		<div class="container">
 			<form name="loginform" action="login_exec.php" method="post" onsubmit = "return checkEmptyField();">
			<?php
			if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			  echo '<li>',$msg,'</li>';
			  }
			echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
			}
		  ?>
 				<div class="label">Email</div> 
 				<input type="text" name="email" id = "email" required><br>
 				<div class="label">Password</div>
 				<input type="password" name="password" id = "password" required>
 				<div class="b">
 					<input class="button" type="submit" value="Log In">
 				</div>
                <div id = "errorDisplay">
                </div>
 			</form>
 		</div>
 	</div>
</div>
</div>

<div class="aside">
<a href="signup.php"><img src="../images/nu2.png" style="height:150px" ></a>
<span> <br> New User </span>
</div>


 	

	<marquee class="car" direction="left" scrollamount="7" behavior="scroll">
	<img src="../images/m1.png" height="100"> Ride Now...
	</marquee>

</section>
	
	<footer>
	<p>Copyright © ByteMe, <small>All Rights Reserved !</small></p>

	
	
	</footer>

	</div> <!--closing wrapper-->
	</body>
	</html>
