
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
$hotelname = $_POST['name'];
$streetaddress = $_POST['streetaddr'];
$city = $_POST['city'];
$phonenumber = $_POST['phone_num'];
$zip = $_POST['zip'];
$province = $_POST['province'];

// Construct the query
$query = "
INSERT INTO hotels (name, street_address, city, province, zip_code, phone_number) VALUES ('$hotelname', '$streetaddress', '$city', '$phonenumber', '$zip', '$province');
";

// Execute the query
$result = mysqli_query($connection, $query);
    
// Process the retrieved data
if ($result) {

  $redirectUrl = "index.html";
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