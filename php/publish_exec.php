<?php
  session_start();

  try {
        // Connect to the database.
        $conn = new PDO("mysql:host=localhost;dbname=poolme", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//Array to store validation errors
		$errmsg_arr = array();

		//Validation error flag
		$errflag = false;

			
		$direction     = filter_input(INPUT_POST, "direction");
        $region = filter_input(INPUT_POST, "area");
        $firststop  = filter_input(INPUT_POST, "first_stop");
		$laststop  = filter_input(INPUT_POST, "last_stop");
		$time  = filter_input(INPUT_POST, "time");
		

  
		$cost = $_POST['cost'];
		$maxpeople = $_POST['max_people'];
		$stops = $_POST['stops'];
		$email = $_SESSION['SESS_EMAIL'];
		$driver_id = $_SESSION['SESS_IS_DRIVER'];
		$user_id = $_SESSION['SESS_USER_ID'];

  //Add departure and destination to stops
  array_push($stops, $firststop, $laststop);
  if ($direction == 0) {
    sort($stops);
  } else {
    rsort($stops);
  }

  if ($direction == '') {
    $errmsg_arr[] = 'Direction missing';
    $errflag = true;
  }
  if ($region == '') {
    $errmsg_arr[] = 'Area missing';
    $errflag = true;
  }
  if ($firststop == '') {
    $errmsg_arr[] = 'First Stop missing';
    $errflag = true;
  }
  if ($laststop == '') {
    $errmsg_arr[] = 'Last Stop missing';
    $errflag = true;
  }
  if ($maxpeople == '') {
    $errmsg_arr[] = 'Maximum People missing';
    $errflag = true;
  }
  if ($time == '') {
    $errmsg_arr[] = 'Time Schedule missing';
    $errflag = true;
  }
  if ($cost == '') {
    $errmsg_arr[] = 'Cost per Mile missing';
    $errflag = true;
  }

  //If there are input validations, redirect back to the login form
  if ($errflag) {
    session_write_close();
    header("location: ../route.html");
    exit();
  }

  //Calculate time for each stop
  // $times = array_fill(0, 10, '');
  // array_push($stops, $firststop, $laststop);
  // if ($direction == 0) {
  //   sort($stops);
  // } else {
  //   rsort($stops);
  // }

  // Debug Purpose
  // foreach ($stops as $stop) {
  //   echo $stop;
  // }

  // Initialize some temporary data
  $date = '';
  $combine_date = $date . ' ' . $time;
  $date = date('Y-m-d H:i:s', strtotime($combine_date));
  $base = 10;
  $first = True;

  // Previous
  // foreach ($stops as $stop) {
  //   $diff = ($stop - $pre) * $base;
  //   // $curr = DateTime::createFromFormat('j-M-Y', '15-Feb-2009');
  //   $date->add(new DateInterval('PT' . $diff . 'M'));
  //   $times[$stop] = $date->format('Y-m-d H:i:s');
  //   $pre = $stop;
  //   // $time = $new_time;
  // }
  // //Create query
  // foreach ($times as $tt) {
  //   echo $tt . "<br/>";
  // }
  $get_start = "SELECT stop_name FROM Stops WHERE area = '$region' AND sub_index = '$firststop'";
  $get_end = "SELECT stop_name FROM Stops WHERE sub_index = '$laststop' AND area = '$region'";
  $depart = ($conn->query($get_start))->fetch(PDO::FETCH_ASSOC)['stop_name'];

 

  $dest = ($conn->query($get_end))->fetch(PDO::FETCH_ASSOC)['stop_name'];
  // if ($dest == TRUE) {
  //   echo $dest->fetch_assoc()['stop_name'];
  // } else {
  //   echo "Error: " . $get_end . "<br>" . $conn->error;
  // }

  $sql = "INSERT INTO Routes (region, direction, max_people, cost, depart, dest)
  VALUES ('$region', '$direction', '$maxpeople', '$cost', '$depart', '$dest');";

  
  if ($conn->query($sql)) {
    $last_id = $conn->lastInsertId();
  } else {
    echo "Error processing: " . $sql . "<br>" ;
  }

  foreach ($stops as $stop) {
    if ($first === False) {
      if ($direction == 1) {
        $diff = ($pre - $stop) * $base;
      } else {
        $diff = ($stop - $pre) * $base;
      }

      $curr_date = strtotime($date);
      $future_date = $curr_date + 60 * $diff;
      $date = date('Y-m-d H:i:s', $future_date);
      $pre = $stop;
    } else {
      $pre = $stop;
      $first = False;
    }

    switch ($stop) {
      case '0':
        $update = "UPDATE Routes SET Routes.stop_0 = '$date' WHERE route_id = $last_id";
        break;
      case '1':
        $update = "UPDATE Routes SET Routes.stop_1 = '$date' WHERE route_id = $last_id";
        break;
      case '2':
        $update = "UPDATE Routes SET Routes.stop_2 = '$date' WHERE route_id = $last_id";
        break;
      case '3':
        $update = "UPDATE Routes SET Routes.stop_3 = '$date' WHERE route_id = $last_id";
        break;
      case '4':
        $update = "UPDATE Routes SET Routes.stop_4 = '$date' WHERE route_id = $last_id";
        break;
      case '5':
        $update = "UPDATE Routes SET Routes.stop_5 = '$date' WHERE route_id = $last_id";
        break;
      case '6':
        $update = "UPDATE Routes SET Routes.stop_6 = '$date' WHERE route_id = $last_id";
        break;
      case '7':
        $update = "UPDATE Routes SET Routes.stop_7 = '$date' WHERE route_id = $last_id";
        break;
      case '8':
        $update = "UPDATE Routes SET Routes.stop_8 = '$date' WHERE route_id = $last_id";
        break;
      case '9':
        $update = "UPDATE Routes SET Routes.stop_9 = '$date' WHERE route_id = $last_id";
        break;
      default:
        echo "No Match";
    }
    $conn->query($update);
	
	
  }
  echo "Route created!";
  $sql = "INSERT INTO `drivers-routes` (driver_id, routes_id) VALUES ('$driver_id', '$last_id' );";
	$result = $conn->prepare($sql);
	$result->bindParam(':driver_id', $driver_id);
	$result->bindParam(':routes_id', $last_id);
    $result->execute();

	$sql = "INSERT INTO `user-routes` (user_id, routes_id) VALUES ('$user_id', '$last_id' );";
	$result = $conn->prepare($sql);
	$result->bindParam(':user_id', $user_id);
	$result->bindParam(':routes_id', $last_id);
    $result->execute();
  header("location: ../driver_home.html");
  exit();
   }
	catch(PDOException $ex) {
        echo 'ERROR: '.$ex->getMessage();
    }

 
?>
