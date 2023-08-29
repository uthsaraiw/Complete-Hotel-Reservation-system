<?php
    // Step 1: Connect to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $guestid = $_GET['guest_id'];
    $reservationid = $_GET['reservation_id'];

    // Using MySQLi extension
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //total reservations

    $query2 = "
    SELECT *
    FROM reservation 
    JOIN hotels ON reservation.hotel_id = hotels.id
    JOIN room ON reservation.room_id = room.room_number

    WHERE guest_nic = '$guestid' AND reservation_id = '$reservationid';
    ";

    $result2 = $conn->query($query2);
    $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Reservation</title>
    <script src="https://kit.fontawesome.com/4a07888b37.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/framework.css">
	<link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/bookingsdetails.css">
</head>
<body>
    <nav>
      <a href="http://localhost/co226/project/customer_ui/loggedin/indexloggedin.php?guest_id=<?php echo $guestid ?>">
          <p>Home</p>
        </a>
        <a class="active" href="http://localhost/co226/project/customer_ui/loggedin/bookingsloggedin.php?guest_id=<?php echo $guestid ?>">
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
    <body>

	<div class="free-room">

        <div class="rooms-free-table">
            <table id="myTable">
          <?php

            // Step 3: Fetch data and build HTML table

            if ($result2->num_rows > 0) {

            while ($row = $result2->fetch_assoc()) {

              echo "<tr>";
              echo "<td> Booking ID:  </td>";
              echo "<td>" . $row['reservation_id'] . "</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<td> Hotel Name:  </td>";
              echo "<td>" . $row['name'] . "</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<td> Reservation Status:  </td>";
              echo "<td>" . $row['reservation_status'] . "</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<td> Check In Date:  </td>";
              echo "<td>" . $row['check_in_date'] . "</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<td> Check Out Date:  </td>";
              echo "<td>" . $row['check_out_date'] . "</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<td> Occupancy Limit:  </td>";
              echo "<td>" . $row['occupancy_limit'] . "</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<td> Room ID:  </td>";
              echo "<td>" . $row['room_number'] . "</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<td> Price Per Night:  </td>";
              echo "<td>" . $row['price_per_night'] . "</td>";
              echo "</tr>";
            }} else {
              echo "<h2> Reservation is not approved by the hotel yet for the details </h2>";
              echo "<h2> Respective Hotel will contact you within 1 hour</h2>";
            } 

            ?>
            </table>		 	 	
        </div>
		 </div>
     
     <a href='#' class='button-print'>
            <p>Print</p>
      </a>

    </body>
</body>
<script src = "http://localhost/co226/project/customer_ui/js/bookings.js"></script>

</html>
