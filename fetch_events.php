<?php
header('Content-Type: application/json');
include 'connection.php';

$sql = "SELECT eventID, eventName, eventDate, eventTime, eventLocation, eventDescription FROM donation_event";
$result = $conn->query($sql);

$events = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['eventImage'] = "fetch_image.php?id=" . $row['eventID'];
        $events[] = $row;
    }
}

$conn->close();

echo json_encode($events);
?>
