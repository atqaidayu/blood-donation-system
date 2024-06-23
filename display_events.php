<?php
include 'connection.php'; // Include the database connection file

// SQL query to fetch upcoming events with image paths
$sql = "SELECT * FROM donation_event WHERE eventDate >= CURDATE() ORDER BY eventDate ASC";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="event">';
        echo '<p>' . date("M d", strtotime($row["eventDate"])) . '</p>';
        echo '<h3>' . $row["eventName"] . '</h3>';
        echo '<p>' . $row["eventDescription"] . '</p>';
        echo '<img src="' . $row["eventImage"] . '" alt="' . $row["eventName"] . '">';
        echo '<a href="#">Read more</a>';
        echo '</div>';
    }
} else {
    echo 'No upcoming events';
}

mysqli_close($conn);
?>
