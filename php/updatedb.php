<?php
	session_start();
	$route_id = $_SESSION['SESS_ROUTE_ID'];
	$start = $_SESSION['SESS_DEPART'];
	$end = $_SESSION['SESS_DEST'];
	$eat = $_SESSION['SESS_EAT'];

  try {
        // Connect to the database.
        $conn = new PDO("mysql:host=localhost;dbname=poolme", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
    $max = `Routes.max_people`-1;
	$sql="UPDATE Routes SET  Routes.max_people = $max  WHERE Routes.route_id = $route_id";
	
	$result = $conn->prepare($sql);
	$result->execute();
	
	if ($result){
		$sql1="SELECT Users.email FROM Users 
		INNER JOIN `user-routes` ON `user-routes`.routes_id=$route_id";
		
		$result1 = $conn->prepare($sql1);
		$result1->execute();
		if ($result1){
			while ($row=$result1->fetch(PDO::FETCH_ASSOC)){
				$to=$row[email];
			}
		}
		$subject = "New Carpool Request from SJSUCARPOOL.com";
		$message = 'Dear Driver, \r\n There is a new carpool request from ' . $start. ' to ' . $end . ' at ' . $eat . '. Wish you a good journey!\r\n\r\n Regards,\r\n SJSU Carpool';

	$cmd = "curl -s --user 'api:key-9870132f6571b00f3bb59b5eea17d171' \
	 https://api.mailgun.net/v3/sandboxff15b8ba9b2843fc9eae5a05cac380c2.mailgun.org/messages \
-F from='SJSU CARPOOL <postmaster@sandboxff15b8ba9b2843fc9eae5a05cac380c2.mailgun.org>' \
-F to=".$to." \
-F subject='".$subject."' \
-F text='".$message."'";

		shell_exec($cmd);

	}
	else {
   		echo "Error updating record! ";
	}

	header("location:confirm_final.php");
	exit();
	
	 }
	catch(PDOException $ex) {
        echo 'ERROR: '.$ex->getMessage();
    }
	
?>
