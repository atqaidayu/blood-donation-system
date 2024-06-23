<?php
session_start();
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $eventName = $_POST['event-name'];
    $eventLocation = $_POST['location'];
    $eventDate = $_POST['date'];
    $eventTime = $_POST['time'];
    $eventDescription = $_POST['description'];
    
    // Handle file upload
    if ($_FILES['image-file']['error'] == 0) {
        $image = file_get_contents($_FILES['image-file']['tmp_name']);
    } else {
        $image = null;
    }

    // Get staff ID from session or set it manually for testing
    $staffID = isset($_SESSION['staffID']) ? $_SESSION['staffID'] : 1001; // Replace with actual staff ID for testing

    // Insert data into donation_event table
    $stmt = $conn->prepare("INSERT INTO donation_event (staffID, eventName, eventLocation, eventDate, eventTime, eventDescription, eventImage) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $staffID, $eventName, $eventLocation, $eventDate, $eventTime, $eventDescription, $image);

    if ($stmt->execute()) {
        echo "New event added successfully";
        // Redirect to a confirmation page or the manage events page
        header("Location: manageevent.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
