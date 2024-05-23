 <?php
// Database connection
$servername = "localhost";
$username = "fred"; // Replace with your MySQL username
$password = "1234"; // Replace with your MySQL password
$dbname = "literacy_courses"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Other PHP code or database operations can go here...

// Close connection

?>
