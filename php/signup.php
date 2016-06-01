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
<!DOCTYPE html>
<html>
<!-- begin head -->
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
    
    h2{
        font-size: 16px;
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
    .buttoncss{
        background-color: #ff6600; 
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        -webkit-transition-duration: 0.4s; 
        transition-duration: 0.4s;
    }   
    #errorDisplay {
        margin: 10px 0px;
        padding:12px;
        color: #D8000C;
        background-color: #FFBABA;
    }
    </style>
<script src = "../js/signup_input_validation.js"></script>
<!--type = "text/javascript"-->
</head><!-- begin body -->
<body background="../images/g2.png">
    <!-- begin div(wrapper) -->
	<div id="wrapper"> 
        <!-- begin header -->
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
        </header> <!-- end header -->
        <!-- begin section -->
        <section>
            <!-- begin div(container) -->
            <div class = "container">
                <form action = "signup_exec.php" method = "post" onsubmit = "return inputValidation();" >
				                
				   <h2> Sign-up Information </h2>
                    <p>
                        <label> First Name </label>
                        <input type = "text" name = "firstname" id = "firstname" />
                        <br>
                        <label> Last Name </label>
                        <input type = "text" name = "lastname" id = "lastname" />
                        <br>
                        <label> Phone </label>
                        <input type = "text" name = "phone" id = "phone" />
                        <br>
                        <label> Email </label>
                        <input type = "text" name = "email" id = "email"/>
                        <br>
                        <label> Password </label>
                        <input type="password" name="newpass" id = "newpass" value="">
                        <br>
                        <label> Confirm Password </label>
                        <input type="password" name="confirmpass" id = "confirmpass" value="" onchange="checkPass()"><br>
                        <br>
                    </p>
					<p class = "button"> 
                        <input type = "submit" class = "buttoncss" value = "Sign Up" >
                    </p>
                </form>
            </div> <!-- end div(container) -->
            <div class = "errorDisplay">
                <p id = "errorDisplay">
                    <!-- Javascript form validation errors are displayed here -->
                </p>
            </div>
		
            <!-- begin marquee -->
            <marquee class="car" direction="left" scrollamount="7" behavior="scroll">
                <img src="../images/m1.png" height="80"> Ride Now...
            </marquee> <!-- end marquee -->
        </section> <!-- end section -->
        
        <br><br><br><br><br>
        
        <!-- begin footer -->
        <footer>
            <p>Copyright © ByteMe, <small>All Rights Reserved !</small></p>
        </footer> <!-- end footer -->

    </div> <!--end wrapper-->
</body> <!-- end body -->
</html>
