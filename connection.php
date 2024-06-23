<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "student_b032110244";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//echo "Successfully connected!";
?>