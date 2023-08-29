<?php
$hostname = "localhost";   
$username = "root"; 
$password = ""; 
$database = "project"; 

$hotel_id = $_GET['hotel_id'];


// Establish a database connection
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$query2 = "
SELECT heading, description_long, highlight_line, google_map, name, hotel_id
FROM hotels JOIN hotel_details ON hotels.id = hotel_details.hotel_id
WHERE hotel_id = '$hotel_id';
";


$result2 = $conn->query($query2);

if ($result2->num_rows > 0) {
  while ($row = $result2->fetch_assoc()) {

    $name = $row['name'];
    $heading = $row['heading'];
    $description_l = $row['description_long'];
    $highlighter = $row['highlight_line'];
    $map = $row['google_map'];
    $hotel_id = $row['hotel_id'];
  }

  } 

$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
    <title>Hotel Reservation</title>
    <script src="https://kit.fontawesome.com/4a07888b37.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/framework.css">	
  <link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/bookings_hotels.css">	
</head>
<body>
    <nav>
        <a class="active" href="index.html">
            <p>Home</p>
          </a>
          <a href="login.html">
            <p>My Bookings</p>
          </a>
          <a href="help.html">
            <p>Help</p>
          </a>
          <a href="about.html">
            <p>About</p>
          </a>
          <div class="login-signup-customer">
            <a href="login.html">
              <p>Login/Signup</p>
            </a>
          </div>
    </nav>

    <div class="body">

      <div class="search-bar margin">

        <div class="search-bar-elements">
          <input type="text" class="search-bar-elements" id="search-province" onkeyup="myFunction()" placeholder="Where are you going?">
        </div>

        <div class="search-bar-elements">
          <p>check in date - check out date</p>
        </div>

        <div class="search-bar-elements">
          <p>occupancy</p>
        </div>

        <div class="search-bar-elements" id="search-search-bar">
          <p>Search</p>
        </div>

      </div>

      <div class="heading-hotel-details">
        <h1><?php echo $heading ?></h1>
      </div>

      <div class="hotel-details-text clear">

        <p> <?php echo $description_l ?> </p>
        <p class="bold"> <?php echo $highlighter ?> </p>
        <a href="<?php echo $map ?>">Show on map</a>

      </div>

      <div class="reserve-area-buttons">
        <a href="login.html">
          <p>Reserve</p>
        </a>
        <div class="tooltip">
        <a href="#" id="copyButton"><p>Share</p></a>
        </div>
        <a href="#">
          <p>Star</p>
        </a>
        

      </div>

      <!-- The grid: four columns -->
      <div class="row clear">
        <div class="column">
          <img id="imgs" src="http://localhost/co226/project/customer_ui/images/hotels/<?php echo $name ?>/1.jpg" alt="" onclick="myFunction(this);">
        </div>
        <div class="column">
          <img id="imgs" src="http://localhost/co226/project/customer_ui/images/hotels/<?php echo $name ?>/2.jpg" alt="" onclick="myFunction(this);">
        </div>
        <div class="column">
          <img id="imgs" src="http://localhost/co226/project/customer_ui/images/hotels/<?php echo $name ?>/3.jpg" alt="" onclick="myFunction(this);">
        </div>
        <div class="column">
          <img id="imgs" src="http://localhost/co226/project/customer_ui/images/hotels/<?php echo $name ?>/4.jpg" alt="" onclick="myFunction(this);">
        </div>
        <div class="column">
          <img id="imgs" src="http://localhost/co226/project/customer_ui/images/hotels/<?php echo $name ?>/5.jpg" alt="" onclick="myFunction(this);">
        </div>
        <div class="column">
          <img id="imgs" src="http://localhost/co226/project/customer_ui/images/hotels/<?php echo $name ?>/6.jpg" alt="" onclick="myFunction(this);">
        </div>
        <div class="column">
          <img id="imgs" src="http://localhost/co226/project/customer_ui/images/hotels/<?php echo $name ?>/7.jpg" alt="" onclick="myFunction(this);">
        </div>
        <div class="column">
          <img id="imgs" src="http://localhost/co226/project/customer_ui/images/hotels/<?php echo $name ?>/8.jpg" alt="" onclick="myFunction(this);">
        </div>
      </div>

      <!-- The expanding image container -->
      <div class="container clear">

        <!-- Expanded image -->
        <img id="expandedImg" style="width: 1026px; height: 700px; margin: 10px; margin-left: 200px;">
      </div>

    </div>
	
 </body>					
 <script src = "http://localhost/co226/project/customer_ui/js/bookings_hotels.js"></script>			
</html>
