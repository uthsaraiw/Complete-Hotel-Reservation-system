
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
$guestid = $_POST['guest_id'];
$hotelid = $_POST['hotel_id'];
$roomtype = $_POST['room_type'];
$checkindate = $_POST['check_in_date'];
$checkoutdate = $_POST['check_out_date'];
$occupancy = $_POST['occupancy'];
$other = $_POST['other'];

// Construct the query
$query = "
INSERT INTO reservation (hotel_id, room_type,  check_in_date, check_out_date, guest_nic, occupancy_limit, description, reservation_status) VALUES ('$hotelid', '$roomtype', '$checkindate', '$checkoutdate', '$guestid', '$occupancy', '$other', 'not approved')
";

// Execute the query
$result = mysqli_query($connection, $query);

// Check if the query was successful
if ($result) 
{
    
    // Process the retrieved data
    if ($result) {

        $redirectUrl = "http://localhost/co226/project/customer_ui/loggedin/bookingsloggedin.php?guest_id=". $guestid;
        header("Location: " . $redirectUrl);
        exit;

    } else {
        // Redirecting to the login website
        $redirectUrl = "http://localhost/co226/project/customer_ui/loggedout/customer_reservation_form.php";
        header("Location: " . $redirectUrl);
        exit;
    }
}
else 
{
    // Query failed
    echo "Error: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>