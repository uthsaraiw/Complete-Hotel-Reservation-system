
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
$name = $_POST['name'];
$phone = $_POST['phone'];
$nic = $_POST['nic'];
$email = $_POST['email'];
$address = $_POST['address'];
$other = $_POST['other'];
$password = $_POST['psw'];



$query2 = "
INSERT INTO persons (nic, name, phone, email, address, other, password)
VALUES ('$nic', '$name', '$phone', '$email', '$address', '$other', '$password');
";



// Execute the query
$result2 = mysqli_query($connection, $query2);

// Check if the query was successful
if ($result2) 
{    
    // Redirecting to the login website
    $redirectUrl = "login.html";
    header("Location: " . $redirectUrl);
    exit;
}

// Close the database connection
mysqli_close($connection);
?>