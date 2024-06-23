<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM staff WHERE staffUsername='$username' AND staffPassword='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['staffID'] = $row['staffID']; // Store staffID in session
        echo $row['staffID'];
        header("Location: homepage-admin.html"); // Redirect to dashboard or another page
        exit(); // Ensure script stops executing after redirect
    } else {
        // Login failed
        echo "Invalid username or password.";
    }
}

$conn->close();
?>
