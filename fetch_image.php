<?php
include 'connection.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT eventImage FROM donation_event WHERE eventID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($eventImage);
    $stmt->fetch();
    if ($stmt->num_rows == 1) {
        // Check if the value starts with 'http://' or 'https://'
        if (preg_match('/^https?:\/\//', $eventImage)) {
            // It's a URL, fetch the image data
            $imageData = file_get_contents($eventImage);
            $imageInfo = getimagesizefromstring($imageData);
            $imageMimeType = $imageInfo['mime'];
            header("Content-Type: " . $imageMimeType);
            echo $imageData;
        } else {
            // It's image data, assume JPEG
            header("Content-Type: image/jpeg");
            echo $eventImage;
        }
    } else {
        echo "Image not found.";
    }
    $stmt->close();
} else {
    echo "Invalid request.";
}
$conn->close();
?>