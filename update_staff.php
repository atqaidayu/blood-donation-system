<?php
session_start(); // Start the session

$staffID = $_SESSION['staffID'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $staffName = $_POST['staff-name'];
    $staffRole = $_POST['staff-role'];
    $staffUsername = $_POST['username'];
    $staffPassword = $_POST['password']; 
    $staffEmail = $_POST['email']; 
    // Retrieve staffID from session
   
    // Establish database connection (replace with your database credentials)
    include 'connection.php';

    // Prepare and execute SQL query to update staff data
    $sql = "UPDATE staff SET staffName=?, staffRole=?, staffUsername=?, staffPassword=?, staffEmail=? WHERE staffID=?"; // Assuming staffID is the primary key
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $staffName, $staffRole, $staffUsername, $staffPassword, $staffEmail, $staffID);
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->affected_rows > 0) {
        $_SESSION['update_success'] = true;
        echo "<script>alert('Staff data updated successfully.'); window.location.href = document.referrer;</script>";
    } else {
        echo "Error updating staff data: " . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();

}
?>
