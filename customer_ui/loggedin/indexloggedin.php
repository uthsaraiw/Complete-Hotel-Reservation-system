<?php
$hostname = "localhost";   
$username = "root"; 
$password = ""; 
$database = "project"; 

$todayDate = date("Y-m-d"); // Get today's date in "YYYY-MM-DD" format
$guestid = $_GET['guest_id'];


// Establish a database connection
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$query ="

SELECT city, COUNT(*) AS frequency
FROM reservation JOIN hotels ON reservation.hotel_id = hotels.id
GROUP BY city
ORDER BY frequency DESC
LIMIT 5
";

$query2 = "
SELECT *
FROM offers
WHERE exp_date > '$todayDate';
";


$result = $conn->query($query);
$result2 = $conn->query($query2);

if ($result->num_rows > 0) {
  $popular_cities = array();

  while ($row = $result->fetch_assoc()) {
    $popular_cities[] = $row['city'];
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
    <link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav>
        <a class="active" href="http://localhost/co226/project/customer_ui/loggedin/indexloggedin.php?guest_id=<?php echo $guestid ?>">
            <p>Home</p>
          </a>
          <a href="http://localhost/co226/project/customer_ui/loggedin/bookingsloggedin.php?guest_id=<?php echo $guestid ?>">
            <p>My Bookings</p>
          </a>
          
          <a href="http://localhost/co226/project/customer_ui/loggedin/helploggedin.php?guest_id=<?php echo $guestid ?>">
            <p>Help</p>
          </a>
          <a href="http://localhost/co226/project/customer_ui/loggedin/aboutloggedin.php?guest_id=<?php echo $guestid ?>">
            <p>About</p>
          </a>

          <div class="login-signup-customer">
            <a href="http://localhost/co226/project/customer_ui/loggedout/index.html">
              <p>Logout</p>
            </a>
          </div>
    </nav>

    <div class="nav-img clear" style="background-image: url('http://localhost/co226/project/customer_ui/images/nav/nav.jpg'); background-repeat: no-repeat; background-size: cover;">
      <h1 class="nav-topic">The Joy of Freedom</h1>
      <h1 class="nav-topic">The trill of Travel</h1>
      <h4>Discover dreamy beach houses, cabins & more</h4>
    </div>

    <div class="body">

      <div class="search-bar margin">

        <div class="search-bar-elements">
          <i class="fa-solid fa-bed" style="float: left; margin: 15px 0 10px 25px;"></i>
          <input type="text" class="search-bar-elements" id="search-province" onkeyup="myFunction()" placeholder=" Where are you going?" style="color: black; width: 200px;">
        </div>

        <div class="search-bar-elements">
          <p> <i class="fa-regular fa-calendar-days"></i>   check in date-check out date</p>
        </div>

        <div class="search-bar-elements">
          <p><i class="fa-solid fa-person"></i>   occupancy</p>
        </div>

        <div class="search-bar-elements" id="search-search-bar">
          <p>Search</p>
        </div>

      </div>

      <!-- for the date select pop up-->
      <div class="date-popup" id="date-popup">

      </div>

      <!-- for the occupancy select pop up -->
      <div class="occupancy-popup" id="occupancy-popup">

      </div>

      <div class="offers margin">

        <h1>Offers</h1>
        <p>Promotions, deals and special offers for you</p>

        <div>
          <!-- Slideshow container -->
          <div class="slideshow-container">



            <!-- Full-width images with number and caption text -->
            <?php 
            
              // Step 3: Fetch data and build HTML table
              if ($result2->num_rows > 0) {


                  while ($row = $result2->fetch_assoc()) {

                    $heading = $row['heading'];
                    $description = $row['description'];
                    $offer_id = $row['offer_id'];
                    $hotel_id = $row['hotel_id'];
                    $exp_date = $row['exp_date'];
                    $start_date = $row['start_date'];

                    echo '<div class="mySlides fade mySlides1-float" >';
                    echo '<img src="http://localhost/co226/project/customer_ui/images/offers/img'. $offer_id .'.jpg" class="img-slide1" >';
                    echo '<p style="font-weight: bold; font-size: 20px; text-indent: 35px;">' . $heading . '</p>';
                    echo '<p style="font-weight: 2px; text-indent: 35px;">' . $description .'</p>';
                    echo '<p style="font-weight: 2px; text-indent: 35px;"> validity:' . $start_date .' to '. $exp_date .'</p>';
                    echo '<a href="bookings_hotelsloggedin.php?hotel_id='.$hotel_id.'&guest_id='.$guestid.'"> <p class="mySlides1-button"> Find a stay</p> </a>';
                    echo '</div>';

                  }
                  } 
            ?>   

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
          </div>
          <br>
        </div>

      </div>

      <div class="explore-srilanka margin clear">

        <h1>Explore Sri Lanka</h1>
        <p >These destinations has a lot to offer</p>

        <div>
          <!-- Slideshow container -->
          <div class="slideshow-container2">

            <!-- Full-width images with number and caption text -->
            <div class="mySlides2 fade mySlides2-float">
              <a href="bookings_elementsloggedin.php?search=nuwara_eliya&guest_id=<?php echo $guestid ?>"><img class="img-slide2" src="http://localhost/co226/project/customer_ui/images/offers/img1.jpg"></a>
              <p>Nuwara Eliya</p>
            </div>

            <div class="mySlides2 fade mySlides2-float">
              <a href="bookings_elementsloggedin.php?search=kandy&guest_id=<?php echo $guestid ?>"><img class="img-slide2" src="http://localhost/co226/project/customer_ui/images/offers/img2.jpg" ></a>
              <p>Kandy</p>
            </div>

            <div class="mySlides2 fade mySlides2-float">
              <a href="bookings_elementsloggedin.php?search=colombo&guest_id=<?php echo $guestid ?>"><img class="img-slide2" src="http://localhost/co226/project/customer_ui/images/offers/img3.jpg" ></a>
              <p>Colombo</p>
            </div>

            <div class="mySlides2 fade mySlides2-float">
              <a href="bookings_elementsloggedin.php?search=anuradhapura&guest_id=<?php echo $guestid ?>"><img class="img-slide2" src="http://localhost/co226/project/customer_ui/images/offers/img4.jpg" ></a>
              <p>Anuradhapura</p>
            </div>

            <div class="mySlides2 fade mySlides2-float">
              <a href="bookings_elementsloggedin.php?search=jaffna&guest_id=<?php echo $guestid ?>"><img class="img-slide2" src="http://localhost/co226/project/customer_ui/images/offers/img5.jpg" ></a>
              <p>Jaffna</p>
            </div>

            <div class="mySlides2 fade mySlides2-float">
              <a href="bookings_elementsloggedin.php?search=trincomalee&guest_id=<?php echo $guestid ?>"><img class="img-slide2" src="http://localhost/co226/project/customer_ui/images/offers/img6.jpg" ></a>
              <p>Trincomalee</p>
            </div>

            <div class="mySlides2 fade mySlides2-float">
              <a href="bookings_elementsloggedin.php?search=galle&guest_id=<?php echo $guestid ?>"><img class="img-slide2" src="http://localhost/co226/project/customer_ui/images/offers/img7.jpg" ></a>
              <p>Galle</p>
            </div>

            <div class="mySlides2 fade mySlides2-float">
              <a href="bookings_elementsloggedin.php?search=mathale&guest_id=<?php echo $guestid ?>"><img class="img-slide2" src="http://localhost/co226/project/customer_ui/images/offers/img8.jpg" ></a>
              <p>Mathale</p>
            </div>

            <div class="mySlides2 fade mySlides2-float">
              <a href="bookings_elementsloggedin.php?search=mannar&guest_id=<?php echo $guestid ?>"><img class="img-slide2" src="http://localhost/co226/project/customer_ui/images/offers/img9.jpg">
</a>              <p>Mannar</p>
            </div>

            <!-- Next and previous buttons -->
            <a class="prev2" onclick="plusSlides2(-1)">&#10094;</a>
            <a class="next2" onclick="plusSlides2(1)">&#10095;</a>
            
          </div>
          <br>
        </div>
        
      </div>

      <div class="trending margin clear">

        <h1>Trending</h1>
        <p>Most popular searches for travelers from Sri Lanka</p>

        <div class="row1">
          <div class="trending-card" id ="tc1">
          <a href="bookings_elementsloggedin.php?search=<?php echo ucwords($popular_cities[0]);?>&guest_id=<?php echo $guestid ?>"><img class="trending-row1-img" src="http://localhost/co226/project/customer_ui/images/trending/<?php echo ucwords($popular_cities[0]);?>.jpg" ></a>
          <h1><?php echo ucwords($popular_cities[0]);?> <img src="http://localhost/co226/project/customer_ui/images/trending/flag.jpg" style="height: 20px; width: 40px; border-radius: 0;" ></h1>
          </div>
          <div class="trending-card" id ="tc2">
          <a href="bookings_elementsloggedin.php?search=<?php echo ucwords($popular_cities[1]);?>&guest_id=<?php echo $guestid ?>"><img class="trending-row1-img" src="http://localhost/co226/project/customer_ui/images/trending/<?php echo ucwords($popular_cities[1]);?>.jpg" ></a>
          <h1><?php echo ucwords($popular_cities[1]);?><img src="http://localhost/co226/project/customer_ui/images/trending/flag.jpg" style="height: 20px; width: 40px; border-radius: 0;" ></h1>
          </div>
        </div>

        <div class="row2">
          <div class="trending-card" id ="tc3">
          <a href="bookings_elementsloggedin.php?search=<?php echo ucwords($popular_cities[2]);?>&guest_id=<?php echo $guestid ?>"><img class="trending-row2-img" src="http://localhost/co226/project/customer_ui/images/trending/<?php echo ucwords($popular_cities[2]);?>.jpg" ></a>
            <h2><?php echo ucwords($popular_cities[2]);?><img src="http://localhost/co226/project/customer_ui/images/trending/flag.jpg" style="height: 20px; width: 40px; border-radius: 0;" ></h2>
          </div>
          <div class="trending-card" id ="tc4">
          <a href="bookings_elementsloggedin.php?search=<?php echo ucwords($popular_cities[3]);?>&guest_id=<?php echo $guestid ?>"><img class="trending-row2-img" src="http://localhost/co226/project/customer_ui/images/trending/<?php echo ucwords($popular_cities[3]);?>.jpg" ></a>
            <h2><?php echo ucwords($popular_cities[3]);?><img src="http://localhost/co226/project/customer_ui/images/trending/flag.jpg" style="height: 20px; width: 40px; border-radius: 0;" ></h2>
          </div>
          <div class="trending-card" id ="tc5">
          <a href="bookings_elementsloggedin.php?search=<?php echo ucwords($popular_cities[4]);?>&guest_id=<?php echo $guestid ?>"><img class="trending-row2-img" src="http://localhost/co226/project/customer_ui/images/trending/<?php echo ucwords($popular_cities[4]);?>.jpg" ></a>
            <h2><?php echo ucwords($popular_cities[4]);?><img src="http://localhost/co226/project/customer_ui/images/trending/flag.jpg" style="height: 20px; width: 40px; border-radius: 0;" ></h2>
          </div>
        </div>

      </div>

      <div class="blog margin clear">
        <h5>Get inspiration for your next trip</h5>
      </div>

    </div>
</body>
<script src = "http://localhost/co226/project/customer_ui/js/index.js"></script>
</html>
