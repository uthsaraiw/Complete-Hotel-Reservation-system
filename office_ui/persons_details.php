<?php
    // Step 1: Connect to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $hotelid = $_GET['hotel_id'];
    $personid = $_GET['person_id'];
    $todayDate = date("Y-m-d"); // Get today's date in "YYYY-MM-DD" format


    // Using MySQLi extension
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //for pending reservations to approve
    $query4 = "
    SELECT *
    FROM reservation
    WHERE reservation_status = 'not approved' AND hotel_id = '$hotelid' AND check_out_date > '$todayDate';
    ";

    $query5 = "
    SELECT *
    FROM persons
    WHERE guest_id = '$personid' ;
    ";

    //total reservations by id

    $query6 = "
    SELECT *
    FROM reservation JOIN persons ON reservation.guest_nic = persons.guest_id
    WHERE hotel_id = '$hotelid' AND guest_id = '$personid';
    ";

    $query7 = "
    SELECT *
    FROM reservation JOIN persons ON reservation.guest_nic = persons.guest_id
    WHERE hotel_id = '$hotelid' AND guest_id = '$personid' AND check_out_date > '$todayDate';
    ";

    $result4 = $conn->query($query4);
    $result5 = $conn->query($query5);
    $result6 = $conn->query($query6);
    $result7 = $conn->query($query7);
    


    if ($result4) {
        $totalPendingRequests = mysqli_num_rows($result4);
    }

    // Step 3: Fetch data and build HTML table
    if ($result5->num_rows > 0) {


        while ($row = $result5->fetch_assoc()) {

            $name = $row['name'];
            $id = $row['nic'];
            $email = $row['email'];
            $address = $row['address'];
            $other = $row['other'];

        }
        } else {
        echo "No data found";
        }

    $conn->close();
?>




<!DOCTYPE html>
<html>
<head>
    <title>office management</title>
    <script src="https://kit.fontawesome.com/4a07888b37.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/framework.css">
    <link rel="stylesheet" href="css/persons_details.css">
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
          <a class="active" href="http://localhost/co226/project/office_ui/persons.php?hotel_id=<?php echo $hotelid ?>">
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
    <body>

          <img class="avatar-image" src="images/avatar.jpg" alt="image of the person">

          <div class="avatar-details">
            <p>Name: <?php echo $name ?></p>
            <p>ID: <?php echo $id ?></p>
            <p>Email: <?php echo $email ?></p>
            <p>Address: <?php echo $address ?></p>
            <p>Other: <?php echo $other ?></p>
          </div>

        <div class="person-bookings ">
          <div class="free-room clear">

            <h1 class="clear">Current Bookings</h1>
    
            <!--creating a table with search bar-->
            <input type="text" class="myInput" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
    
            <div class="rooms-free-table">
    
                <table class="table" id="myTable">
    
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
                if ($result7->num_rows > 0) {


                    while ($row = $result7->fetch_assoc()) {
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
                    } 
                ?>
                </table>
    
            </div>
        </div>

        <div class="person-history clear">
          <div class="free-room">

            <h1>History</h1>
    
            <!--creating a table with search bar-->
            <input type="text" class="myInput" id="myInput2" onkeyup="myFunction()" placeholder="Search for names..">
    
            <div class="rooms-free-table">
    
                <table class="table" id="myTable2">
    
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
                if ($result6->num_rows > 0) {


                    while ($row = $result6->fetch_assoc()) {
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

</body>
<script src = "js/persons_details.js"></script>
</html>
