<?php
session_start();
include 'connection.php';

// Fetch donors from the database
$sql = "SELECT donorID, icNumber, name, age, gender, address, phoneNumber FROM donor";
$result = $conn->query($sql);

$donors = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $donors[] = $row;
    }
}

$conn->close();

// Return donors data as JSON
header('Content-Type: application/json');
echo json_encode($donors);
?>