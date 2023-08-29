<?php 
$guestid = $_GET['guest_id'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Reservation</title>
    <script src="https://kit.fontawesome.com/4a07888b37.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/framework.css">
	<link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/bookings.css">
    <link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/help.css">
	
</head>
  <body>
      <nav>
          <a href="http://localhost/co226/project/customer_ui/loggedin/indexloggedin.php?guest_id=<?php echo $guestid ?>">
              <p>Home</p>
            </a>
            <a href="http://localhost/co226/project/customer_ui/loggedin/bookingsloggedin.php?guest_id=<?php echo $guestid ?>">
              <p>My Bookings</p>
            </a>
            
            <a class="active" href="http://localhost/co226/project/customer_ui/loggedin/helploggedin.php?guest_id=<?php echo $guestid ?>">
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
    <body>
	
	<div class="free-room">
        <h1>Help</h1>
		
		<P>Need a help? We are here for u!</p>

		
        <!--creating a table with search bar-->
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search ..">
        <ul id="myMenu">
  <li><a href="#">Popular Questions</a></li>
  <li><a href="#">Booking Details</a></li>
  <li><a href="#">Cancellation</a></li>
  <li><a href="#">Change a booking</a></li>
  <li><a href="#">Special Requests</a></li>
  
</ul>
		
		<div class="help-table">
            <table id="myTable">
			<tr>
                <td>Update your account details</td></tr>
				<td>Get a receipt for </td></tr>
				<td>134</td></tr>
				<td>134</td></tr>
			<td>	
		<a href="#" id="detailButton" onclick="openForm()"> 
				Contact Us
				</a></td>
 </body>				
<script src = "http://localhost/co226/project/customer_ui/js/help.js"></script>
				
</html>
