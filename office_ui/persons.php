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


    //for pending reservations to approve
    $query4 = "
    SELECT *
    FROM reservation
    WHERE reservation_status = 'not approved' AND hotel_id = '$hotelid' AND check_out_date > '$todayDate';
    ";

    //for all the persons details
    $query5 = "
    SELECT *
    FROM persons JOIN reservation ON reservation.guest_nic = persons.guest_id
    WHERE hotel_id = '$hotelid';
    ";


    $result4 = $conn->query($query4);
    $result5 = $conn->query($query5);


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
    <link rel="stylesheet" href="css/persons.css">
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

    <div>

    <div class="free-room">

        <h1>Person details (currently booked)</h1>

        <!--creating a table with search bar-->
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

        <div class="rooms-free-table">

            <table id="myTable">

            <tr class="header">
                <th>Guest NIC</th>
                <th>Guest Name</th>
                <th>Guest Phone</th>
                <th>Guest Email</th>
                <th>Other Details</th>
            </tr>
            
            <?php

            // Step 3: Fetch data and build HTML table
            if ($result5->num_rows > 0) {

                

                while ($row = $result5->fetch_assoc()) {
                    $personid = $row['guest_id'];
                    echo "<tr>";
                    echo "<td> <a href='http://localhost/co226/project/office_ui/persons_details.php?hotel_id=".$hotelid." & person_id=".$personid."'> ". $row['nic'] . "</a></td>";
                    echo "<td> <a href='http://localhost/co226/project/office_ui/persons_details.php?hotel_id=".$hotelid." & person_id=".$personid."'> ". $row['name'] . "</a></td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['other'] . "</td>";
                    echo "</tr>";
                }
                } 
            ?>

            </table>

        </div>
    </div>

</body>
<script src = "js/persons.js"></script>
</html>
