<!DOCTYPE html>
<?php
  session_start();
  $is_driver = $_SESSION['SESS_IS_DRIVER'];
?>
<html>

<head>
	<meta charset="utf-8">
	<title>Confirmation</title>
	<link href="../css/confirmation.css" rel="stylesheet" type="text/css">
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
	<li><a href="message_page.php"> <div id="orange"> Mail </div></a></li>
	
	</ul>
</nav>
</header>


<section>


<div id="main">
			<div id="name"><span>

				<!-- Get DB Connection and get Driver Name -->
				<?php
				if(session_id() == '' || !isset($_SESSION)) {
					session_start();
				}
					$route_id = $_POST['route_id'];
					$eta = $_POST['eta'];

					session_regenerate_id();
					$_SESSION['SESS_ROUTE_ID'] = $route_id;
					$_SESSION['SESS_EAT'] = $eta;
					session_write_close();

					$start = $_SESSION['SESS_DEPART'];
					$end = $_SESSION['SESS_DEST'];
				

					 try {
						// Connect to the database.
						$conn = new PDO("mysql:host=localhost;dbname=poolme", "root", "");
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sql = "SELECT Users.firstname, Users.lastname 
						FROM Users
						INNER JOIN `user-routes` ON `user-routes`.routes_id=$route_id";
						
						$result = $conn->prepare($sql);
						$result->execute();
						if ($result == TRUE) {
							$row = $result->fetch(PDO::FETCH_ASSOC);
							echo $row['firstname'] . ' ' . $row['lastname'];
					}	
				   }
					catch(PDOException $ex) {
						echo 'ERROR: '.$ex->getMessage();
					}
			
				
				
				?>
			</span></div>
		</div>

		<div id="car">
			<table>

				<!-- Get Driver Detail infomation -->
				<?php
					$sql = "SELECT car_brand, car_model, car_color, plate_num 
					FROM Cars
					INNER JOIN `drivers-routes` ON `drivers-routes`.routes_id=$route_id
					INNER JOIN `drivers-cars` ON `drivers-cars`.driver_id = `drivers-routes`.driver_id";
					$result = $conn->prepare($sql);
					$result->execute();
					//$result = $conn->query($sql);
					if ($result ) {
						$row = $result->fetch(PDO::FETCH_ASSOC);
					} else {
						echo "Error: " . $result . "<br>" . $conn->error;
					}
				?>
				<tr class="row1">
					<td class="col1">
						<?php
							echo $row['car_brand'] . "<br>";
						?>
					</td>
					<td class="col1">
						<?php
							echo $row['car_model'] . "<br>";
						?>
					</td>
					<td class="col1">
						<?php
							echo $row['car_color'] . "<br>";
						?>
					</td>
					<td class="col1">
						<?php
							echo $row['plate_num'] . "<br>";
						?>
					</td>
				</tr>
			</table>
		</div>

		<div id="stop">
			<table>
				<tr class="row2">
					<td class="col2">
						<?php
							echo $start;
						?>
					</td>
					<td class="col2">
						<?php
							echo $end;
						?>

					</td>
				</tr>
			</table>
		</div>

		<div id="time">
			<table>
				<tr class="row3">
					<td class="col3">
						<?php
							echo $eta;
						 ?>
					</td>
				</tr>
			</table>
		</div>

		<div id="b">
			<form action="updatedb.php" method="post">
					<input id="button" type="submit" value="Submit">
			</form>
		</div>
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
