<?php
    // Step 1: Connect to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";
    $hotelid = $_GET['hotel_id'];
    $todayDate = date("Y-m-d"); // Get today's date in "YYYY-MM-DD" format


    // Using MySQLi extension
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // for free rooms
    $query1 = "
    SELECT room.room_number, room.occupancy_limit, room.room_type_id, room.price_per_night,room.status,
    room_type.type, room_type.description 
    FROM room 
    JOIN room_type ON room.room_type_id = room_type.id
    WHERE room.hotel_id = '$hotelid' AND room.status = 'free';
    ";
    //total reservations

    $query2 = "
    SELECT *
    FROM reservation
    WHERE hotel_id = '$hotelid' AND check_out_date > '$todayDate';
    ";

    //for pending luxury rooms
    $query3 = "
    SELECT *
    FROM reservation
    WHERE reservation_status = 'not approved' AND room_type = 'luxury' AND hotel_id = '$hotelid' AND check_out_date > '$todayDate';
    ";

    //for pending reservations to approve
    $query4 = "
    SELECT *
    FROM reservation JOIN persons ON reservation.guest_nic = persons.guest_id
    WHERE reservation_status = 'not approved' AND hotel_id = '$hotelid' AND check_out_date > '$todayDate';
    ";

    //for total luxury reservations
    $query5 = "
    SELECT *
    FROM reservation
    WHERE room_type = 'luxury' AND hotel_id = '$hotelid' AND check_out_date > '$todayDate';
    ";

    //for approved reservations
    $query6 = "
    SELECT *
    FROM reservation JOIN persons ON reservation.guest_nic = persons.guest_id
    WHERE reservation_status = 'approved' AND hotel_id = '$hotelid' AND check_out_date > '$todayDate';
    ";

    $result = $conn->query($query1);
    $result2 = $conn->query($query2);
    $result3 = $conn->query($query3);
    $result4 = $conn->query($query4);
    $result5 = $conn->query($query5);
    $result6 = $conn->query($query6);


    if ($result2) {
        $totalReservations = mysqli_num_rows($result2);
    }

    if ($result3) {
        $totalPendingLuxuryRooms = mysqli_num_rows($result3);
    }
    if ($result4) {
        $totalPendingRequests = mysqli_num_rows($result4);
    }
    if ($result5) {
      $totalLuxuryReservations = mysqli_num_rows($result5);
    }


    $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>office management</title>
    <script src="https://kit.fontawesome.com/4a07888b37.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/framework.css">
    <link rel="stylesheet" href="css/bookings.css">
</head>
<body>
    <nav>
        <a href="http://localhost/co226/project/office_ui/home.php?hotel_id=<?php echo $hotelid ?>">
            <p>Home</p>
          </a>
          <a class="active" href="http://localhost/co226/project/office_ui/bookings.php?hotel_id=<?php echo $hotelid ?>">
            <p>Bookings</p>
          </a>
          <a href="http://localhost/co226/project/office_ui/records.php?hotel_id=<?php echo $hotelid ?>">
            <p>Records</p>
          </a>
          <a href="http://localhost/co226/project/office_ui/persons.php?hotel_id=<?php echo $hotelid ?>">
            <p>Persons</p>
          </a>
          <a href="http://localhost/co226/project/office_ui/all_rooms.php?hotel_id=<?php echo $hotelid ?>">
            <p>All Rooms</p>
          </a>
          <a href="http://localhost/co226/project/office_ui/help.php?hotel_id=<?php echo $hotelid ?>">
            <p>Help</p>
          </a>
          <a id='logout' href="http://localhost/co226/project/office_ui/index.html">
            <p>Logout</p>
          </a>
          <a class='add-rooms' id='logout' href="add_rooms.php?hotel_id=<?php echo $hotelid ?>">
            <p>+ Rooms</p>
          </a>
    </nav>

    <div class="free-room test">

        <h1>Not Approved Requests</h1>

        <a href="http://localhost/co226/project/office_ui/bookings.php?hotel_id=<?php echo $hotelid ?>" class="notification">
          <span>Pendings To Accept</span>
          <span class="badge"><?php echo ($totalPendingRequests) ?></span>
        </a>

        <div class="summary pending clear">
          <P>No. of Pending: <?php echo ($totalPendingRequests) ?></P>
          <P>No. of luxury rooms Pending: <?php echo ($totalPendingLuxuryRooms) ?></P>
          <P>No. of semi luxury rooms Pending: <?php echo ($totalPendingRequests - $totalPendingLuxuryRooms) ?></P>
        </div>

        <!--creating a table with search bar-->
        <input type="text" class="myInput" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

        <div class="rooms-free-table">

            <table id="myTable" class="table">

            <tr class="header">
              <th>Reservation ID</th>
              <th>Room Type</th>
              <th>Checkin Date</th>
              <th>Checkout Date</th>
              <th>Guest Name</th>
              <th>Occupancy Limit</th>
              <th style="width:5%;"></th>
            </tr>

            <?php

            // Step 3: Fetch data and build HTML table
            if ($result4->num_rows > 0) {
            

                while ($row = $result4->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['reservation_id'] . "</td>";
                    echo "<td>" . $row['room_type'] . "</td>";
                    echo "<td>" . $row['check_in_date'] . "</td>";
                    echo "<td>" . $row['check_out_date'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['occupancy_limit'] . "</td>";
                    echo "<td><a href='#' onclick=\"openForm('{$row['reservation_id']}', '{$row['room_type']}', '{$row['check_in_date']}', '{$hotelid}', '{$row['occupancy_limit']}')\" id='approve'>Approve</a></td>";
                    echo "</tr>";
                }
                }
            ?>

            </table>

        </div>
    </div>


    <!-- The popup form -->
    <div class="form-popup" id="myForm">
      <form action="popupform.php" method="GET" class="form-container">
        <p id= '1'> </p>
        <p id= '2'> </p>
        <p id= '3'> </p>
        <p id= '4'> </p>

        <input id='hotelid' type="hidden" name="hotel_id">
        <input id='reservationid' type="hidden" name="reservation_id">

        <label for="popup_room_id"><b>Room_id</b></label>
        <input type="text" placeholder="Enter Room ID" name="popup_room_id" required>

        <label for="popup_reservation_detail"><b>Description</b></label>
        <input type="text" placeholder="Enter Reservation Details" name="popup_reservation_detail" required>

        <button type="submit" class="btn">Approve</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
      </form>
    </div>
    <!-- End of The popup form -->


    <div class="free-room">

      <h1>Approved Requests</h1>

      <div class="summary Approved clear">
          <P>No. of Approved: <?php echo ($totalReservations - $totalPendingRequests) ?></P>
          <P>No. of luxury rooms Approved: <?php echo ($totalLuxuryReservations - $totalPendingLuxuryRooms) ?></P>
          <P>No. of semi luxury rooms Approved: <?php echo ($totalReservations - $totalPendingRequests) - ($totalLuxuryReservations - $totalPendingLuxuryRooms) ?></P>
      </div>

      <!--creating a table with search bar-->
      <input type="text" class="myInput" id="myInput2" onkeyup="myFunction()" placeholder="Search for names..">

      <div class="rooms-free-table">

          <table id="myTable2" class="table">

          <tr class="header">
              <th>Reservation ID</th>
              <th>Room ID</th>
              <th>Checkin Date</th>
              <th>Checkout Date</th>
              <th>Guest Name</th>
              <th>Occupancy Limit</th>
          </tr>
          <?php

          // Step 3: Fetch data and build HTML table
          if ($result6->num_rows > 0) {


              while ($row = $result6->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row['reservation_id'] . "</td>";
                  echo "<td>" . $row['room_id'] . "</td>";  
                  echo "<td>" . $row['check_in_date'] . "</td>";
                  echo "<td>" . $row['check_out_date'] . "</td>";
                  echo "<td>" . $row['name'] . "</td>";
                  echo "<td>" . $row['occupancy_limit'] . "</td>";
                  echo "</tr>";
              }
              } else
          ?>
          </table>

      </div>
  </div>

  <div class="free-room bottom">
        <h1>Table Free Rooms</h1>

        <!--creating a table with search bar-->
        <input type="text" id="myInput3" class="myInput" onkeyup="myFunction()" placeholder="Search by room number ...">
        <div class="rooms-free-table">
            <table id="myTable3" class="table">

            <tr class="header">
            <th >Room Number</th>
                <th >Occupancy Limit</th>
                <th >Room Type</th>
                <th >Description</th>
                <th >Price Per Night</th>
            </tr>

            <?php

            // Step 3: Fetch data and build HTML table
            if ($result->num_rows > 0) {
            

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['room_number'] . "</td>";
                    echo "<td>" . $row['occupancy_limit'] . "</td>";
                    echo "<td>" . $row['type'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" ."Rs. ". $row['price_per_night'] . "</td>";
                    echo "</tr>";
                }
                }
            ?>

            </table>

        </div>
    </div>

</body>
<script src = "js/bookings.js"></script>
</html>
