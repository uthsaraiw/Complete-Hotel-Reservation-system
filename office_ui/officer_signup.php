
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
$namesignup = $_POST['name'];
$emailsignup = $_POST['email'];
$idsignup = $_POST['id'];
$pswsignup = $_POST['psw'];

// Construct the query
$query = "
INSERT INTO officer_signup (name, email, hotel_id, password) VALUES ('$namesignup', '$emailsignup', '$idsignup', '$pswsignup')
";

// Execute the query
$result = mysqli_query($connection, $query);

// Check if the query was successful
if ($result) 
{
    
    // Process the retrieved data
    if ($result) {

        $redirectUrl = "index.html";
        header("Location: " . $redirectUrl);
        exit;

    } else {
        // Redirecting to the login website
        $redirectUrl = "officer_signup.html";
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