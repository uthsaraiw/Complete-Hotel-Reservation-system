
<?php
$hostname = "localhost";   
$username = "root"; 
$password = ""; 
$database = "project"; 


// Establish a database connection
$connection = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
// Retrieve data from POST
$roomnumber = $_POST['roomno'];
$hotelid = $_POST['hotel_id'];
$roomtypeid = $_POST['roomtypeid'];
$pricepernight = $_POST['price'];
$occupancylimit = $_POST['selectedNumber'];
echo 'fuck';

// Construct the query
$query = "
INSERT INTO room (room_number, hotel_id, room_type_id, occupancy_limit, price_per_night, status) VALUES ('$roomnumber', '$hotelid', '$roomtypeid', '$occupancylimit', '$pricepernight', 'free');
";

// Execute the query
$result = mysqli_query($connection, $query);

// Check if the query was successful
    
// Process the retrieved data
if ($result) {

  $redirectUrl = "http://localhost/co226/project/office_ui/home.php?hotel_id=".$hotelid;
  header("Location: " . $redirectUrl);
  exit;
}
else 
{
    // Query failed
    echo "Error: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>