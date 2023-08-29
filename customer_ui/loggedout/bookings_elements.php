<?php
$hostname = "localhost";   
$username = "root"; 
$password = ""; 
$database = "project"; 

$city = $_GET['search'];


// Establish a database connection
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$query2 = "
SELECT heading, description_long, description_short, highlight_line, google_map, name, hotel_id
FROM hotels JOIN hotel_details ON hotels.id = hotel_details.hotel_id
WHERE city = '$city';
";


$result2 = $conn->query($query2);

if ($result2) {
  $totalresults = mysqli_num_rows($result2);
}

$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
    <title>Hotel Reservation</title>
    <script src="https://kit.fontawesome.com/4a07888b37.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/framework.css">	
  <link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/bookings_elements.css">	
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

      <h1><?php echo $totalresults ?> Properties found:</h1>

      <div class="main-card">
      <?php 
      
        // Step 3: Fetch data and build HTML table
        if ($result2->num_rows > 0) {


            while ($row = $result2->fetch_assoc()) {

              $name = $row['name'];
              $heading = $row['heading'];
              $description_l = $row['description_long'];
              $description_s = $row['description_short'];
              $highlighter = $row['highlight_line'];
              $map = $row['google_map'];
              $hotel_id = $row['hotel_id'];

              echo '<div class="sub-card">';
              echo '<img src="http://localhost/co226/project/customer_ui/images/hotels/'.$name.'/1.jpg" alt="">';
              echo '<div class="sub-card-theory">';
              echo '<h3>'.$heading.'</h3>';
              echo '<p>'.$description_s.'</p>';
              echo '</div>';
              echo '<div>';
              echo '<a href="bookings_hotels.php?hotel_id='.$hotel_id.'"><p class="button" >More Details</p></a>';
              echo '</div>';
              echo '</div>';
            }
            } 
      ?>   

      </div>      
    </div>
	
 </body>				
 <script>
  function myFunction(imgs) {
    } 
 </script>
 
</html>
