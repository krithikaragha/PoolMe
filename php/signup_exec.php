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
		$firstname  = filter_input(INPUT_POST, "firstname");
        $lastname = filter_input(INPUT_POST, "lastname");
        $phone  = filter_input(INPUT_POST, "phone");
		$email  = filter_input(INPUT_POST, "email");
		$password  = filter_input(INPUT_POST, "newpass");
		$confirm_password  = filter_input(INPUT_POST, "confirmpass");
		
  
  
  
  //Input validations
  if ($firstname == '') {
    $errmsg_arr[] = 'First Name missing';
    $errflag = true;
  }
  if ($lastname == '') {
    $errmsg_arr[] = 'Last Name missing';
    $errflag = true;
  }
  if ($phone == '') {
    $errmsg_arr[] = 'Phone Number missing';
    $errflag = true;
  }
  if ($email == '') {
    $errmsg_arr[] = 'Email Address missing';
    $errflag = true;
  }
  if ($password == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true;
  }
  if ($password != $confirm_password) {
    $errmsg_arr[] = 'Password does not match';
    $errflag = true;
  }

  //If there are input validations, redirect back to the login form
  if ($errflag) {
    session_write_close();
    header("location: signup.php");
    exit();
  }

  //Create query
  $sql = "INSERT INTO Users (firstname, lastname, phone, email, psw, is_driver)
  VALUES ('$firstname', '$lastname', '$phone', '$email', '$password', null);";
 // $result = $conn->query($sql);
    $result = $conn->prepare($sql);
	$result->bindParam(':firstname', $firstname);
    $result->bindParam(':lastname', $lastname);
    $result->bindParam(':phone', $phone);
	$result->bindParam(':email', $email);
    $result->bindParam(':psw', $password);
   $result->execute();

  //Check whether the query was successful or not
  if ($result) {
    session_regenerate_id();
    $_SESSION['SESS_USER_ID'] = $result->insert_id;
    $_SESSION['SESS_FIRST_NAME'] = $firstname;
    $_SESSION['SESS_LAST_NAME'] = $lastname;
    $_SESSION['SESS_EMAIL'] = $email;
    $_SESSION['SESS_PHONE'] = $phone;
    $_SESSION['SESS_IS_DRIVER'] = NULL;
    session_write_close();
    header("location: homepage.php");
    exit();
  } else {
    echo "Query failed!";
  }
   }
	catch(PDOException $ex) {
        echo 'ERROR: '.$ex->getMessage();
    }

?>
