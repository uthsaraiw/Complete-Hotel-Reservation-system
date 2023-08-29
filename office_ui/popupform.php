
<?php
$hostname = "localhost";   
$username = "root"; 
$password = ""; 
$database = "project"; 
$hotelid = $_GET['hotel_id'];
$reservationid = $_GET['reservation_id'];

// Establish a database connection
$connection = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}

?>

<?php
// Retrieve data from GET
$roomid = $_GET['popup_room_id'];
$description = $_GET['popup_reservation_detail'];

// Construct the query
$query = "
UPDATE reservation
SET room_id = '$roomid', description = '$description', reservation_status = 'approved'
WHERE reservation_id = '$reservationid';
";

$query2 = "
UPDATE room
SET status = 'reserved'
WHERE room_number = '$roomid';
";

// Execute the query
$result = mysqli_query($connection, $query);
$result2 = mysqli_query($connection, $query2);


if ($result){
  $redirectUrl = "http://localhost/co226/project/office_ui/bookings.php?hotel_id=$hotelid";
  header("Location: " . $redirectUrl);
  exit;
} else {
  $redirectUrl = "http://localhost/co226/project/office_ui/bookings.php?hotel_id=$hotelid";
  header("Location: " . $redirectUrl);
  exit;
}

// Close the database connection
mysqli_close($connection);
?>