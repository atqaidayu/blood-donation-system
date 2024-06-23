<?php
// Include database connection file
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get donor ID from POST request
    $donorID = $_POST['donorID'];
    
    // Prepare the SQL delete statement
    $sql = "DELETE FROM donor WHERE donorID = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $donorID);
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "Donor deleted successfully.";
        } else {
            echo "Error: Could not execute the query: $stmt->error";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: Could not prepare the query: $conn->error";
    }

    // Close the connection
    $conn->close();
}
?>
