<?php
    // Step 1: Connect to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $guestid = $_GET['guest_id'];

    // Using MySQLi extension
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //total reservations

    $query2 = "
    SELECT reservation_id, reservation_status, name
    FROM reservation 
    JOIN hotels ON reservation.hotel_id = hotels.id

    WHERE guest_nic = '$guestid';
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
	<link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/bookings.css">
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
        <h1>My Bookings</h1>

        <!--creating a table with search bar-->
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
        <div class="rooms-free-table">
            <table id="myTable">

            <tr class="header">
                <th style="width:40%;">Booking ID</th>
				        <th style="width:40%;">Hotel Name</th>
                <th style="width:40%;">Reservation status</th>
            </tr>

          <?php

            // Step 3: Fetch data and build HTML table
            if ($result2->num_rows > 0) {

            while ($row = $result2->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row['reservation_id'] . "</td>";
              echo "<td>" . $row['name'] . "</td>";
              echo "<td>" . $row['reservation_status'] . "</td>";
              echo '<td style="width:40%;"><a href="bookingsdetailsloggedin.php?guest_id='.$guestid.'&reservation_id='.$row['reservation_id'].'" id="detailButton" onclick="openForm()"> Details</a></td>';
              echo "</tr>";
            }}           
            ?>

            </table>
		 	 	
        </div>
		 </div> 	 

    </body>
</body>
<script src = "http://localhost/co226/project/customer_ui/js/bookings.js"></script>

</html>
