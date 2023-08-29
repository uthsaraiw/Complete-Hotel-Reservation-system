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

    //total reservations

    $query2 = "
    SELECT *
    FROM reservation JOIN persons ON reservation.guest_nic = persons.guest_id
    WHERE hotel_id = '$hotelid';
    ";

    //for pending reservations to approve
    $query4 = "
    SELECT *
    FROM reservation
    WHERE reservation_status = 'not approved' AND hotel_id = '$hotelid'  AND check_out_date > '$todayDate';
    ";


    $result2 = $conn->query($query2);
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
    <link rel="stylesheet" href="css/records.css">
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
          <a class="active" href="http://localhost/co226/project/office_ui/records.php?hotel_id=<?php echo $hotelid ?>">
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

    <div>

    <div class="free-room">

        <h1>Record Log</h1>

        <!--creating a table with search bar-->
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

        <div class="rooms-free-table">

            <table id="myTable">


            <tr class="header">
              <th>Reservation ID</th>
              <th>Room ID</th>
              <th>Room Type</th>
              <th>Checkin Date</th>
              <th>Checkout Date</th>
              <th>Guest Name</th>
              <th>Status</th>
              <th style="width:20px;">Description</th>
            </tr>

            <?php

            // Step 3: Fetch data and build HTML table
            if ($result2->num_rows > 0) {
            

                while ($row = $result2->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['reservation_id'] . "</td>";
                    echo "<td>" . $row['room_id'] . "</td>";
                    echo "<td>" . $row['room_type'] . "</td>";
                    echo "<td>" . $row['check_in_date'] . "</td>";
                    echo "<td>" . $row['check_out_date'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['reservation_status'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    
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
<script src = "js/records.js"></script>
</html>
