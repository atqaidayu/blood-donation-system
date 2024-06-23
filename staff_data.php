<?php
session_start();
include 'connection.php';

// Check if staff ID is set in the session
if (isset($_SESSION['staffID'])) {
    // Retrieve staff data from the database using staffID
    $staffID = $_SESSION['staffID'];
   
    // Prepare and execute SQL query to fetch staff data based on staffID
    $stmt = $conn->prepare("SELECT * FROM staff WHERE staffID = ?");
    $stmt->bind_param('i', $staffID); // 'i' indicates that staffID is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch staff data
        $row = $result->fetch_assoc();

        // Extract staff information
        $staffName = $row['staffName'];
        $staffRole = $row['staffRole'];
        $staffUsername = $row['staffUsername'];
        $staffEmail = $row['staffEmail'];

        // Return an array with staff data
        $staffData = array(
            'staffName' => $staffName,
            'staffRole' => $staffRole,
            'staffUsername' => $staffUsername,
            'staffEmail' => $staffEmail
        );

        // Convert array to JSON and output
        echo json_encode($staffData);
    } else {
        // If no staff data found for the given staffID, return an error
        echo json_encode(array('error' => 'Staff data not found.'));
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // If staff ID is not set in the session, return an error
    echo json_encode(array('error' => 'Staff ID not found in session.'));
}
?>
