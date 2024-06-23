<?php
// Establish a connection to the database
include 'connection.php';

// Query to count the total number of donors
$sql = "SELECT COUNT(*) AS total_donors FROM donor";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    // Get the total number of donors
    $total_donors = $row['total_donors'];
} else {
    // Set total donors to 0 if there's an error
    $total_donors = 0;
}

// Close the database connection
$conn->close();

// Return the total number of donors as JSON
echo json_encode(['total_donors' => $total_donors]);
?>
