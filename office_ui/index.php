
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
$emaillogin = $_POST['email'];
$passwordlogin = $_POST['psw'];

// Construct the query
$query = "SELECT * FROM officer_signup WHERE email = '$emaillogin' AND password = '$passwordlogin'";

// Execute the query
$result = mysqli_query($connection, $query);

// Check if the query was successful
if ($result) 
{
    
    // Process the retrieved data
    if ($row = mysqli_fetch_assoc($result)) {
      $hotelid = $row['hotel_id'];

      // Access individual fields using $row['field_name']
      //$workerid = $row['workerid'];

        // Redirecting to the home website
        $redirectUrl = "http://localhost/co226/project/office_ui/home.php?hotel_id=$hotelid";
        header("Location: " . $redirectUrl);
        exit;

    } else {
        // Redirecting to the login website
        $redirectUrl = "index.html";
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