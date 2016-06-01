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

	$email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
 //Input validations
  if ($email == '') {
    $errmsg_arr[] = 'Username missing';
    $errflag = true;
  }
  if ($password == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true;
  }
  //If there are input validations, redirect back to the login form
  if ($errflag) {
    session_write_close();
    header("location: login.php");
    exit();
  }
  //Create query
	$sql = "SELECT * FROM Users WHERE email = '$email' AND psw = '$password'";
    
	$result = $conn->prepare($sql);
	$result->bindParam(':email', $email);
    $result->bindParam(':psw', $password);
    $result->execute();
	//$rows = $result->fetch(PDO::FETCH_NUM);
	$rows=$result->fetch(PDO::FETCH_ASSOC);
	
	if($result->rowCount() > 0) {
		
	session_regenerate_id();
      $_SESSION['SESS_USER_ID'] = $rows['id'];
      $_SESSION['SESS_FIRST_NAME'] = $rows['firstname'];
      $_SESSION['SESS_LAST_NAME'] = $rows['lastname'];
      $_SESSION['SESS_EMAIL'] = $rows['email'];
      $_SESSION['SESS_IS_DRIVER'] = $rows['is_driver'];
      $_SESSION['SESS_PHONE'] = $rows['phone'];
      session_write_close();
	  if ($_SESSION['SESS_IS_DRIVER'] === null) {
     	header("location: homepage.php");
        exit();
      } else {
        header("location: ../driver_home.html");
        exit();
      }
	}
	else{
		$errmsg_arr[] = 'Username and Password are not found';
		$errflag = true;
			print_r($result);
		if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: login.php");
		exit();
	}
	}
   }catch(PDOException $ex) {
        echo 'ERROR: '.$ex->getMessage();
    }
 
?>