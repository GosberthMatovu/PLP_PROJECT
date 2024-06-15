<?php
// Database configuration
$servername = "localhost";  // Replace with your database server hostname
$username = "username";     // Replace with your database username
$password = "password";     // Replace with your database password
$dbname = "car_rentaldb";     // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize_data($data) {
  global $conn;
  return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  $name = sanitize_data($_POST['name']);
  $email = sanitize_data($_POST['email']);
  $rentingPeriod = sanitize_data($_POST['rentingPeriod']);
  $message = sanitize_data($_POST['message']);
  
  // SQL query to insert data into database
  $sql = "INSERT INTO rental_requests (name, email, renting_period, message) 
          VALUES ('$name', '$email', '$rentingPeriod', '$message')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Close connection
$conn->close();
?>.