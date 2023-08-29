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
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="CSS/add_rooms.css">
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
          <a href="http://localhost/co226/project/office_ui/all_rooms.php?hotel_id=<?php echo $hotelid ?>">
            <p>All Rooms</p>
          </a>
          <a href="http://localhost/co226/project/office_ui/help.php?hotel_id=<?php echo $hotelid ?>">
            <p>Help</p>
          </a>

          <a id='logout' href="http://localhost/co226/project/office_ui/index.html">
            <p>Logout</p>
          </a>
          <a class='add-rooms active' id='logout' href="add_rooms.php?hotel_id=<?php echo $hotelid ?>">
            <p>+ Rooms</p>
          </a>

          
    </nav>
    <form action="add_rooms_form.php"  method="post" style="border:1px solid #ccc">
            <div class="container">
              <h1></h1>
              <p>Please fill the form To Add New Rooms</p>
              <hr>

              <input type="hidden" name="hotel_id" value='<?php echo $hotelid ?>'>
              
              <label for="roomno"><b>Room Number</b></label>
              <input type="text" placeholder="Enter Room Number" name="roomno" required>

              <label for="roomtypeid"><b>Room Type ID</b></label>
              <input type="text" placeholder="Enter Room Type ID" name="roomtypeid" required>

              <label for="price"><b>Price Per Night</b></label>
              <input type="text" placeholder="Enter The Price Per Night" name="price" required>

              <label for="occupancylimit"><b>Occupancy Limit</b></label>
              <select id="numberSelect" name="selectedNumber">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
          
            <div class="clearfix">
              <button type="submit" class="addlbtn">ADD</button>

            </div>
          </form>


</body>
<script src = "js/home.js"></script>
</html>
