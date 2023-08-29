<?php
$guestid = $_GET['guest_id'];
$hotel_id = $_GET['hotel_id'];
?>


<!DOCTYPE html>
<html>
<head>
    <title>Hotel Reservation</title>
    <script src="https://kit.fontawesome.com/4a07888b37.js" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/framework.css">	
    <link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/signup.css">	
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
    </nav>

    <div class="body">

      <div class="form">
        <!--login form-->
        <form action="http://localhost/co226/project/customer_ui/loggedin/customer_reservation_form.php"  method="post" style="border:1px solid #ccc">
            <div class="container">
              <h1>RESERVATION</h1>
              <p>Please fill the form for reservation</p>
              <hr>
              
              <input type="hidden" name="guest_id" value='<?php echo $guestid ?>'>
              <input type="hidden" name="hotel_id" value='<?php echo $hotel_id ?>'>

              <label for="room_type"><b>Room Type</b></label>
              <input type="text" placeholder="Enter Room Type" name="room_type" required>

              <label for="occupancy"><b>Number of Occupancy</b></label>
              <input type="text" placeholder="Enter the number of Occupancy" name="occupancy" required>

              <label for="other"><b>Other</b></label>
              <input type="text" placeholder="Enter other notes" name="other" required>

              <label for="check_in_date"><b>Check In Date</b></label>
              <label for="dateInput">:</label>
              <input type="date" id="dateInput" name="check_in_date">

              <label for="check_out_date"><b>Check Out Date</b></label>
              <label for="dateInput">:</label>
              <input type="date" id="dateInput" name="check_out_date">


              <div class="clearfix">
                
                <button type="submit" class="signupbtn">Reserve</button>

              </div>

            </div>
          </form>
          <!--end of signup-->

        </div>


    </div>
	
 </body>								
</html>
