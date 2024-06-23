<?php
header('Content-Type: application/json');
include 'connection.php';

$sql = "SELECT eventID, eventDate, eventName, eventDescription FROM donation_event WHERE eventDate >= CURDATE() ORDER BY eventDate ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<section class='events'>";
    echo "<h2>Upcoming Events</h2>";
    echo "<div class='event-list'>";

    // Loop through the results and generate HTML for each event
    while ($row = $result->fetch_assoc()) {
        $eventDate = date("M d", strtotime($row["eventDate"]));
        $eventName = $row["eventName"];
        $eventDescription = $row["eventDescription"];

        echo "<div class='event'>";
        echo "<p>$eventDate</p>";
        echo "<h3>$eventName</h3>";
        echo "<p>$eventDescription</p>";
        echo "<a href='#'>Read more</a>";
        echo "</div>";
    }

    echo "</div>";
    echo "</section>";
} else {
    echo "No upcoming events found.";
}

$conn->close();
?>