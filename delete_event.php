<?php
include 'connection.php';

// Get the JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['eventID'])) {
    $eventID = intval($data['eventID']);

    // Prepare the SQL statement to delete the event
    $stmt = $conn->prepare("DELETE FROM donation_event WHERE eventID = ?");
    $stmt->bind_param("i", $eventID);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Event deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete event']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

$conn->close();
?>
