<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data with error handling
    $bankID = isset($_POST['bank-id']) ? $_POST['bank-id'] : null;
    $icNumber = isset($_POST['ic-number']) ? $_POST['ic-number'] : null;
    $bloodType = isset($_POST['blood-type']) ? $_POST['blood-type'] : null;
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;

    // Print form data for debugging
    echo "<h2>Form Data Submitted:</h2>";
    echo "Bank ID: " . htmlspecialchars($bankID) . "<br>";
    echo "IC Number: " . htmlspecialchars($icNumber) . "<br>";
    echo "Blood Type: " . htmlspecialchars($bloodType) . "<br>";
    echo "Quantity: " . htmlspecialchars($quantity) . " mL<br>";
    echo "Description: " . htmlspecialchars($description) . "<br><br>";

    if ($bankID && $icNumber && $bloodType && $quantity) {
        // Database connection parameters
        session_start();
        include 'connection.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected to database.<br>";

        // Get donorID based on icNumber
        $donorIDQuery = "SELECT donorID FROM donor WHERE icNumber='$icNumber'";
        $donorIDResult = $conn->query($donorIDQuery);

        if ($donorIDResult === false) {
            echo "Error executing donor ID query: " . $conn->error . "<br>";
        } elseif ($donorIDResult->num_rows > 0) {
            $row = $donorIDResult->fetch_assoc();
            $donorID = $row['donorID'];
            echo "Donor ID found: " . $donorID . "<br>";

            // Insert data into blood_donation table
            $sql = "INSERT INTO blood_donation (donorID, bankID, bloodType, quantity, description, donationDate)
                    VALUES ('$donorID', '$bankID', '$bloodType', '$quantity', '$description', NOW())";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully<br>";
                echo "<script>window.history.back();</script>";
            } else {
                echo "Error inserting data: " . $conn->error . "<br>";
            }
        } else {
            echo "Error: Donor not found. Please register as a new donor.<br>";
        }

        $conn->close();
    } else {
        echo "Error: Missing required form data.<br>";
    }
} else {
    echo "No form data submitted.<br>";
}
?>
