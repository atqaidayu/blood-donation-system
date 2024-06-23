<?php
// Establish a connection to the database
include 'connection.php';

// Query to retrieve data from the blood_bank table
$sql = "SELECT * FROM blood_bank";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output data of each row
    $blood_banks = array();
    while ($row = $result->fetch_assoc()) {
        $blood_banks[] = $row;
    }
} else {
    $blood_banks = array();
}

// Close the database connection
$conn->close();

// Convert the data to JSON format
$blood_banks_json = json_encode($blood_banks);

// Output the JSON data
echo $blood_banks_json;
?>
