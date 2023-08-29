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

  // for all the existing rooms
  $query1 = "
  SELECT room.room_number, room.occupancy_limit, room.room_type_id, room.price_per_night,room.status,
  room_type.type, room_type.description 
  FROM room 
  JOIN room_type ON room.room_type_id = room_type.id
  WHERE room.hotel_id = '$hotelid';

  ";
      //for pending reservations to approve
  $query4 = "
  SELECT *
  FROM reservation
  WHERE reservation_status = 'not approved' AND hotel_id = '$hotelid' AND check_out_date > '$todayDate';
  ";


  $result = $conn->query($query1);
  $result4 = $conn->query($query4);

  if ($result4) {
      $totalPendingRequests = mysqli_num_rows($result4);
  }

  $conn->close();
?>



<!DOCTYPE html>
<html>
<head>
    <title>office management</title>
    <script src="https://kit.fontawesome.com/4a07888b37.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/framework.css">
    <link rel="stylesheet" href="css/all-rooms.css">
</head>
<body>
    <nav>
        <a href="http://localhost/co226/project/office_ui/home.php?hotel_id=<?php echo $hotelid ?>">
            <p>Home</p>
          </a>
          <a href="http://localhost/co226/project/office_ui/bookings.php?hotel_id=<?php echo $hotelid ?>">
            <p>Bookings</p>
            <p class="badge bookings"><?php echo ($totalPendingRequests) ?></p>
          </a>
          <a href="http://localhost/co226/project/office_ui/records.php?hotel_id=<?php echo $hotelid ?>">
            <p>Records</p>
          </a>
          <a href="http://localhost/co226/project/office_ui/persons.php?hotel_id=<?php echo $hotelid ?>">
            <p>Persons</p>
          </a>
          <a class="active" href="http://localhost/co226/project/office_ui/all_rooms.php?hotel_id=<?php echo $hotelid ?>">
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

    <div>

    <div class="free-room">

        <h1>All The Available Rooms</h1>

        <!--creating a table with search bar-->
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by room number...">

        <div class="rooms-free-table">

            <table id="myTable">

            <tr class="header">
                <th >Room Number</th>
                <th >Occupancy Limit</th>
                <th >Room Type</th>
                <th >Description</th>
                <th >Price Per Night</th>
                <th >Status</th>
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
                  echo "<td>" . $row['status'] . "</td>";
                  echo "</tr>";
              }
              } else {
                echo "No data found";
                }
            ?>

            </table>

        </div>
    </div>

</body>
<script src = "js/all-rooms.js"></script>
</html>
