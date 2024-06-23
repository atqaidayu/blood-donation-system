<?php
// Include database connection file
include('connection.php');

// SQL query to fetch all donors
$sql = "SELECT * FROM donor";
$result = $conn->query($sql);

$donors = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $donors[] = $row;
    }
} else {
    echo json_encode([]);
    exit();
}

// Close the connection
$conn->close();

// Return donors as JSON
echo json_encode($donors);
?>
