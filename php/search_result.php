<!DOCTYPE html>
<?php
// 	if(session_id() == '' || !isset($_SESSION))
		session_start();
  $is_driver = $_SESSION['SESS_IS_DRIVER']; 

   try {
        // Connect to the database.
        $conn = new PDO("mysql:host=localhost;dbname=poolme", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
	catch(PDOException $ex) {
        echo 'ERROR: '.$ex->getMessage();
    }
  
	//Array to store validation errors
	$errmsg_arr = array();

	//Validation error flag
	$errflag = false;

	$start     = filter_input(INPUT_POST, "start");
    $end = filter_input(INPUT_POST, "end");
    $guest_num  = filter_input(INPUT_POST, "guest_num");
	$daytime  = filter_input(INPUT_POST, "daytime");
		
  

  if ($start == '') {
    $errmsg_arr[] = 'start missing';
    $errflag = true;
  }
  if ($end == '') {
    $errmsg_arr[] = 'end missing';
    $errflag = true;
  }
  if ($guest_num == '') {
    $errmsg_arr[] = 'guest_num missing';
    $errflag = true;
  }
  if ($daytime == '') {
    $errmsg_arr[] = 'daytime missing';
    $errflag = true;
  }



 ?>
 <html>
 <style>
@font-face {
  font-family: "Chalky";
  src: url("../font/Eraser.ttf");
  src: local("☺"),
    url("../font/Eraser.ttf") format("truetype"),   
  }
  
  </style>

<head>
	<meta charset="utf-8">
	<title>Search Result </title>
	<link rel="stylesheet" href="../css/search_result.css" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
   </head>
<body background="../images/g2.png">
	<div id="wrapper"> 
	<header>
		<img src="../images/car.png" height="120" width="120">
		<h1>Pool Me !</h1>
	
	
	<nav>
	<ul>
	<li><a href="../homepage.html"> <div id="orange1"> Sign Out </div> </a></li>
	<li><a href="../aboutus.html"> <div id="orange"> About Us</div></a></li>
	<li><a href="../homepage.html"> <div id="orange"> Home </div></a></li>
	</ul>
	</nav>
	</header>
           
     </div>
<section>
	<div class ="left-half">
        <div id="search_box">
          <div id="search_box_left">
          <form action="search_result.php" method="post">
            <div class="search_box_line">
                <p class="label">Stops</p>
                <div class="search_body">
                    <?php
                      echo '<input type="text" id ="start" name="start" placeholder="Departure" value="' . $start . '" onkeyup="showHint(this.value)">
                            <input type="text" id ="end" name="end" placeholder="Destination" value="' . $end . '" onkeyup="showHint(this.value)">';
                    ?>
                    <!-- <input type="text" id ="start" name="start" placeholder="Departure" value="" onkeyup="showHint(this.value)">
                    <input type="text" id ="end" name="end" placeholder="Destination" value="" onkeyup="showHint(this.value)"> -->
                </div>
            </div>


           <div class="search_box_line">
                <p class="label">Time</p>
                <div class="search_body"><br>
                    <?php
                      echo '<input id="time" type="text" name="daytime" placeholder="00:00" value="' . $daytime . '">
                      <input id ="guests" type="text" name="guest_num" placeholder="Guest Number" value="' . $guest_num . '">';
                    ?>
                    <!-- <input id="time" type="text" name="daytime" placeholder="00:00" value="">
                    <input id ="guests" type="text" name="guest_num" placeholder="Guest Number" value=""> -->
                </div>
           </div>
           <div class="search_box_line">
              <p class="label">Suggestions:  </p>
              <div class="search_body"> <br>
                <p id="recommendation"></p>
              </div>
           </div>
         </div>
         <div id="search_box_right">
            <input id="search_button" type="submit" value="Go!">
         </div>
         </form>
        </div>
        <div id = "search_results">
          <?php
            if (!$errflag) {

              // echo "Your direction after escaping: {$start}<br>";
              // echo "Your area after escaping: {$end}<br>";
              // echo "Your first stop after escaping: {$guest_num}<br>";
              // echo "Your last stop after escaping: {$daytime}<br>";

              //Write search departure and destination to session
              session_regenerate_id();
              $_SESSION['SESS_DEPART'] = $start;
              $_SESSION['SESS_DEST'] = $end;
              session_write_close();

              //Calculate time Limit
              $input_time = strtotime($daytime);
              $upper_time = date("H:i:s", strtotime('+30 minutes', $input_time));
              $lower_time = date("H:i:s", strtotime('-30 minutes', $input_time));
            $sql = "SELECT Stops.area, Stops.sub_index FROM Stops WHERE Stops.stop_name = '$start'";
             if ($end == 'SJSU') {
                $direction = 0;
                $sql = "SELECT Stops.area, Stops.sub_index FROM Stops WHERE Stops.stop_name = '$start'";
              }
              if ($start == 'SJSU') {
                $direction = 1;
                $sql = "SELECT Stops.area, Stops.sub_index FROM Stops WHERE Stops.stop_name = '$end'";
              }
			  if ($start!= 'SJSU' || $end!='SJSU')
				   $direction = null;
				  
			  $result = $conn->prepare($sql);
			  $result->execute();
			  $row = $result->fetch(PDO::FETCH_ASSOC);
              $area = $row['area'];
              $sub_index = $row['sub_index'];

             
              switch ($sub_index) {
                case 0:
				 $sql = "SELECT route_id, depart, dest, max_people, stop_0, Users.firstname, Users.lastname FROM Routes, Users WHERE Routes.region = $area AND Routes.direction = '$direction' AND Routes.max_people >= '$guest_num' AND Routes.stop_0 is not NULL AND Routes.stop_0 >= '$lower_time' AND Routes.stop_0 <= '$upper_time'";
                  break;
                case 1:
                 $sql = "SELECT route_id, depart, dest, max_people, stop_1, Users.firstname, Users.lastname FROM Routes, Users WHERE Routes.region = $area AND Routes.direction = '$direction' AND Routes.max_people >= '$guest_num' AND Routes.stop_1 is not NULL AND Routes.stop_1 >= '$lower_time' AND Routes.stop_1 <= '$upper_time'";
                 break;
                case 2:
                  $sql = "SELECT route_id, depart, dest, max_people, stop_2, Users.firstname, Users.lastname FROM Routes, Users WHERE Routes.region = $area AND Routes.direction = '$direction' AND Routes.max_people >= '$guest_num' AND Routes.stop_2 is not NULL AND Routes.stop_2 >= '$lower_time' AND Routes.stop_2 <= '$upper_time'";
                break;
                case 3:
                 $sql = "SELECT route_id, depart, dest, max_people, stop_3, Users.firstname, Users.lastname FROM Routes, Users WHERE Routes.region = $area AND Routes.direction = '$direction' AND Routes.max_people >= '$guest_num' AND Routes.stop_3 is not NULL AND Routes.stop_3 >= '$lower_time' AND Routes.stop_3 <= '$upper_time'";
                 break;
                case 4:
                 $sql = "SELECT route_id, depart, dest, max_people, stop_4, Users.firstname, Users.lastname FROM Routes, Users WHERE Routes.region = $area AND Routes.direction = '$direction' AND Routes.max_people >= '$guest_num' AND Routes.stop_4 is not NULL AND Routes.stop_4 >= '$lower_time' AND Routes.stop_4 <= '$upper_time'";
				break;
                case 5:
                 $sql = "SELECT route_id, depart, dest, max_people, stop_5, Users.firstname, Users.lastname FROM Routes, Users WHERE Routes.region = $area AND Routes.direction = '$direction' AND Routes.max_people >= '$guest_num' AND Routes.stop_5 is not NULL AND Routes.stop_5 >= '$lower_time' AND Routes.stop_5 <= '$upper_time'";
                 break;
                case 6:
                $sql = "SELECT route_id, depart, dest, max_people, stop_6, Users.firstname, Users.lastname FROM Routes, Users WHERE Routes.region = $area AND Routes.direction = '$direction' AND Routes.max_people >= '$guest_num' AND Routes.stop_6 is not NULL AND Routes.stop_6 >= '$lower_time' AND Routes.stop_6 <= '$upper_time'";
                  break;
                case 7:
                $sql = "SELECT route_id, depart, dest, max_people, stop_7, Users.firstname, Users.lastname FROM Routes, Users WHERE Routes.region = $area AND Routes.direction = '$direction' AND Routes.max_people >= '$guest_num' AND Routes.stop_7 is not NULL AND Routes.stop_7 >= '$lower_time' AND Routes.stop_7 <= '$upper_time'";
                  break;
                case 8:
                $sql = "SELECT route_id, depart, dest, max_people, stop_8, Users.firstname, Users.lastname FROM Routes, Users WHERE Routes.region = $area AND Routes.direction = '$direction' AND Routes.max_people >= '$guest_num' AND Routes.stop_8 is not NULL AND Routes.stop_8 >= '$lower_time' AND Routes.stop_8 <= '$upper_time'";
                  break;
                case 9:
                $sql = "SELECT route_id, depart, dest, max_people, stop_9, Users.firstname, Users.lastname FROM Routes, Users WHERE Routes.region = $area AND Routes.direction = '$direction' AND Routes.max_people >= '$guest_num' AND Routes.stop_9 is not NULL AND Routes.stop_9 >= '$lower_time' AND Routes.stop_90 <= '$upper_time'";
                default:
                  echo "No Match Found";
              }
			  //$result = $conn->prepare($sql);
			  //$result->execute();
				$result =  $conn->query($sql);
			  
			  $flag = FALSE;
			  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				  $flag=TRUE;
			      $route = $row['route_id'];
                  $depart = $row['depart'];
                  $dest = $row['dest'];
                  $maxpeople = $row['max_people'];
                  $firstname = $row['firstname'];
                  $lastname = $row['lastname'];
				//  $driver = $row['driver_id'];
                //  $user = $row['user_id'];
                  
                  
				  switch ($sub_index) {
                    case 0:
                      $eta = $row['stop_0'];
                      break;
                    case 1:
                      $eta = $row['stop_1'];
                      break;
                    case 2:
                      $eta = $row['stop_2'];
                      break;
                    case 3:
                      $eta = $row['stop_3'];
                      break;
                    case 4:
                      $eta = $row['stop_4'];
                      break;
                    case 5:
                      $eta = $row['stop_5'];
                      break;
                    case 6:
                      $eta = $row['stop_6'];
                      break;
                    case 7:
                      $eta = $row['stop_7'];
                      break;
                    case 8:
                      $eta = $row['stop_8'];
                      break;
                    case 9:
                      $eta = $row['stop_9'];
                      break;
                    default:
                      echo "no result";
                  }

                    echo '<div class="tag">
                          <form action="confirmation.php" method="post">
                          <div class = "search_tag">
                            <div class = "select_box">
                             <div id="id">' . $firstname. ' ' . $lastname . '</div>

                                 <div>
                                     <p >ETA: </p>
                                     <p class="eta">' . $eta . '</p>
                                 </div>
                                 <div>
                                     <input class="php_result" name="route_id" value="'. $route . '" />
                                     <input class="php_result" name="eta" value="'. $eta . '" />
                                 </div>
                                 <div>
                                     <p class="from">' . $depart .'</p>
                                     <p class="arrow">→</p>
                                     <p class="to">' . $dest. '</p>
                                 </div>
                                 <div>
                                     <p >Available Seats: </p>
                                     <p class="num">' . $maxpeople . '</p>
                                 </div>


                         </div>
                      </div>
                     <input class="b" type="submit" value="Detail">
                    </form>
                   </div>';
                
              } if ($flag==FALSE) {
				 
                echo "Sorry, no match found!";
              }
            }
           ?>
</article>
          
    </div>
	</div>
	<div id="map"></div>
    </div></div>
</section>



    <script>
       $(document).ready(function(){
          $("#pic").click(function(){
            $("#slideProfile").slideDown("slow").css("z-index","1");
          });
          $("#pic").mouseout(function(){
            $("#slideProfile").slideUp("slow");
          });
        });
        // load map
        function initMap() {

          var origin = document.getElementById('start').value;
          var destination = document.getElementById('end').value;
          var directionsService = new google.maps.DirectionsService;
          var directionsDisplay = new google.maps.DirectionsRenderer;

          var myCenter=new google.maps.LatLng(37.335645, -121.881418);
          var mapProp = {
            center : myCenter,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          var map=new google.maps.Map(document.getElementById("map"),mapProp);

          var onChangeHandler = function() {
            calculateAndDisplayRoute(directionsService, directionsDisplay);
          };

          if(origin != null && destination != null) {
            calculateAndDisplayRoute(directionsService, directionsDisplay);
          }
          document.getElementById('search_button').addEventListener("click",onChangeHandler);
          // document.getElementById('start').addEventListener('change', onChangeHandler);
          // document.getElementById('end').addEventListener('change', onChangeHandler);
          directionsDisplay.setMap(map);
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        if($("#start").val() == "SJSU") {
          directionsService.route({
            origin: "1 Washington Sq, San Jose, CA 95192",
            destination: document.getElementById('end').value,
            travelMode: google.maps.TravelMode.DRIVING
            }, function(response, status) {
              if (status === google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
              } else {
                window.alert('Directions request failed due to ' + status);
              }
            });
         }
         if($("#end").val() == "SJSU") {
           directionsService.route({
             origin: document.getElementById('start').value,
             destination: "1 Washington Sq, San Jose, CA 95192",
             travelMode: google.maps.TravelMode.DRIVING
             }, function(response, status) {
               if (status === google.maps.DirectionsStatus.OK) {
                 directionsDisplay.setDirections(response);
               } else {
                 window.alert('Directions request failed due to ' + status);
               }
             });
         }
       }
       function showHint(str) {
        var xhttp;
        if (str.length == 0) {
          document.getElementById("recommendation").innerHTML = "";
          return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("recommendation").innerHTML = xhttp.responseText;
          }
        };
        xhttp.open("GET", "gethint.php?q="+str, true);
        xhttp.send();
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDu4RXGOHMhpNU-XpOwOkNYCNgj8i4Uc0&signed_in=true&callback=initMap"
        async defer></script>


	

	

	<marquee class="car" direction="left" scrollamount="7" behavior="scroll">
	<img src="../images/m1.png" height="100"> Ride Now...
	</marquee>
	<footer>
	<p>Copyright © ByteMe, <small>All Rights Reserved !</small></p>
	</footer>


	
	</body>
	</html>
