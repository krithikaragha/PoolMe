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

			
		$carBrand     = filter_input(INPUT_POST, "carbrand");
        $carModel = filter_input(INPUT_POST, "carmodel");
        $carColor  = filter_input(INPUT_POST, "carcolor");
		$carPlate  = filter_input(INPUT_POST, "carnum");
		$license  = filter_input(INPUT_POST, "drivingnum");
		
		

  
  // //Debuging Purpose
  // echo "Your carBrand after escaping: {$carBrand}<br>";
  // echo "Your License after escaping: {$carModel}<br>";
  // echo "Your carBrand after escaping: {$carColor}<br>";
  // echo "Your License after escaping: {$carPlate}<br>";
  // echo "Your License after escaping: {$license}<br>";

  // Input validations
  if ($carBrand == '') {
    $errmsg_arr[] = 'Car Brand Missing';
    $errflag = true;
  }


  if ($carModel == '') {
    $errmsg_arr[] = 'Car Model Missing';
    $errflag = true;
  }


  if($carColor == '') {
    $errmsg_arr[] = 'Color Missing';
    $errflag = true;
  }

  if($carPlate == '') {
    $errmsg_arr[] = 'Plate Number Missing';
    $errflag = true;
  }


  if($license == '') {
    $errmsg_arr[] = 'License Number Missing';
    $errflag = true;
  }

  //If there are input validations, redirect back to the login form
  if ($errflag) {
    session_write_close();
    // echo "Typing error";
    header("location: ../cardetail.html");
    exit();
  }

  // Create query
  $email = $_SESSION['SESS_EMAIL'];
  $sql = "INSERT INTO cars (car_brand, car_model, car_color, plate_num, license_num)
  VALUES ('$carBrand', '$carModel', '$carColor', '$carPlate', '$license');";
	$result = $conn->prepare($sql);
	$result->bindParam(':car_brand', $carBrand);
    $result->bindParam(':car_model', $carModel);
    $result->bindParam(':car_color', $carColor);
	$result->bindParam(':plate_num', $carPlate);
    $result->bindParam(':license_num', $license);
	$result->execute();
	
	if ($result) {
    // Insert successful
    $driver_id = $conn->lastInsertId();
	$update = "UPDATE Users SET is_driver = '$driver_id' WHERE email = '$email'";
	
	$result = $conn->prepare($update);
	$result->bindParam(':is_driver', $driver_id);
	$result->bindParam(':email', $email);
    $result->execute();
	
	$sql = "INSERT INTO `drivers-cars` (driver_id, car_id) VALUES ('$driver_id', '$driver_id' );";
	$result = $conn->prepare($sql);
	$result->bindParam(':driver_id', $driver_id);
	$result->bindParam(':car_id', $driver_id);
    $result->execute();

	
	$_SESSION['SESS_IS_DRIVER'] = $driver_id;
      
    if ($_SESSION['SESS_IS_DRIVER'] !== null ) {
	  session_write_close();
	  header("location:../driver_home.html");
      exit();
    } else {
      // Insert failed
      echo "Error processing: " . $update . "<br>" ;
    }
   }
   else {
     echo "Error processing: " . $update . "<br>" ;
	}
   
	}
	catch(PDOException $ex) {
        echo 'ERROR: '.$ex->getMessage();
    }

?>
