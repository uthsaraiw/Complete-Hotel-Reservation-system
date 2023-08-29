<?php
$guestid = $_GET['guest_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Reservation</title>
    <script src="https://kit.fontawesome.com/4a07888b37.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/framework.css">	
	<link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/bookings.css">
	<link rel="stylesheet" href="http://localhost/co226/project/customer_ui/css/about.css">
</head>
<body>
    <nav>
        <a href="http://localhost/co226/project/customer_ui/loggedin/indexloggedin.php?guest_id=<?php echo $guestid ?>">
            <p>Home</p>
          </a>
          <a href="http://localhost/co226/project/customer_ui/loggedin/bookingsloggedin.php?guest_id=<?php echo $guestid ?>">
            <p>My Bookings</p>
          </a>
          
          <a href="http://localhost/co226/project/customer_ui/loggedin/helploggedin.php?guest_id=<?php echo $guestid ?>">
            <p>Help</p>
          </a>
          <a class="active" href="http://localhost/co226/project/customer_ui/loggedin/aboutloggedin.php?guest_id=<?php echo $guestid ?>">
            <p>About</p>
          </a>

          <div class="login-signup-customer">
            <a href="http://localhost/co226/project/customer_ui/loggedout/index.html">
              <p>Logout</p>
            </a>
          </div>
    </nav>
    <div class="about-section">
  <h1>About Us - Welcome</h1>
  <p>
At [Your Hotel Reservation System's Name], we are committed to redefining the way you experience travel and accommodation. 
With a passion for hospitality and a dedication to innovation, we have created a seamless online platform that caters to all your travel needs.
Whether you're embarking on a leisurely vacation, a business trip, or a spontaneous getaway, our user-friendly system is designed to make your hotel 
reservation experience effortless and enjoyable.</p>
<p>
<h3>Our Mission</h3>
Our mission is to empower travelers by providing them with a comprehensive, convenient, and reliable platform to book accommodations around the world. 
We aim to simplify the reservation process, offering a wide range of choices and personalized options that suit every budget and preference. 
By harnessing the latest technology and a deep understanding of the travel industry, we strive to create a valuable and memorable booking experience for our 
users.

</p>

<h3>Our Vision</h3>
<p>our vision is to continue refining and expanding our services, embracing emerging technologies, and adapting to the evolving needs of 
travelers. We aspire to become your go-to platform for all things travel-related, offering not only accommodation reservations but also a range of 
complementary services that simplify every aspect of your journey.</p>
  
  <p>
  Thank you for choosing [Your Hotel Reservation System's Name] to be your hotel reservation partner. We are excited to be part of your adventures and to help you 
  create lasting memories wherever your travels may take you.</p>
  </div>

<h2 style="text-align:center">Our Team</h2>
<div class="row">
  <div class="column">
    <div class="card">
      <img src="http://localhost/co226/project/customer_ui/images/bg6.jpeg" alt="Uthsara" style="width:100%">
      <div class="container">
        <h2>Uthsara</h2>
        <p class="title">Computer Engineering Undergraduate at University of Peradeniya</p>
         <p>e19432@eng.pdn.ac.lk</p>
           </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
       <img src="http://localhost/co226/project/customer_ui/images/bg8.jpeg" alt="Pasan" style="width:100%">
      <div class="container">
        <h2>Pasan</h2>
        <p class="title">Computer Engineering Undergraduate at University of Peradeniya</p>
        <p>e19091@eng.pdn.ac.lk</p>
       
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
	<img src="http://localhost/co226/project/customer_ui/images/bg7.jpeg" alt="Kasuni" style="width:105%">
     
      <div class="container">
        <h2>Kasuni</h2>
        <p class="title">Computer Engineering Undergraduate at University of Peradeniya</p>
        <p>e19131@eng.pdn.ac.lk</p>
         </div>
    </div>
  </div>
</div>
</body>
</body>
</html>
