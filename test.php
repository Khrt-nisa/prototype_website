<?php
// db.php (directly integrated into test.php)

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "happydaycare"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connection successful!";
}
?>
