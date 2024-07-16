<?php
// Database connection parameters
$servername = "localhost";    // Your database server address, often 'localhost'
$username = "root";  // Your database username
$password = "";  // Your database password
$dbname = "project_pweb"; // Your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    // If there is an error with the connection, output an error message
    die("Connection failed: " . $conn->connect_error);
}
?>
