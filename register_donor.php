<?php
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $name = $_POST['name'];
    $icNumber = $_POST['ic-number'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phone-number'];

    // Insert data into donor table
    $stmt = $conn->prepare("INSERT INTO donor (icNumber, name, age, gender, address, phoneNumber) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $icNumber, $name, $age, $gender, $address, $phoneNumber);

    if ($stmt->execute()) {
        echo "New donor registered successfully";
        // Redirect to a confirmation page or the donor list page
        header("Location: donorlist.html");
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
