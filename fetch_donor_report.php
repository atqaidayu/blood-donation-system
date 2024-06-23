<?php
include 'connection.php';

$donorID = $_GET['donorID'];

$sql = "SELECT d.name, d.icNumber, d.age, d.gender, d.address, d.phoneNumber, bd.donationDate, bd.quantity, bd.description, bd.bloodType
        FROM donor d
        LEFT JOIN blood_donation bd ON d.donorID = bd.donorID
        WHERE d.donorID = $donorID";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $donorInfo = null;
    $donations = [];
    $lastDonationDate = null;

    while ($row = mysqli_fetch_assoc($result)) {
        // Assign donor information once
        if ($donorInfo === null) {
            $donorInfo = [
                'name' => $row['name'],
                'icNumber' => $row['icNumber'],
                'age' => $row['age'],
                'gender' => $row['gender'],
                'address' => $row['address'],
                'phoneNumber' => $row['phoneNumber'],
                'bloodType' => $row['bloodType']
            ];
        }

        // Collect donation records
        if ($row['donationDate'] !== null) {
            $donations[] = [
                'donationDate' => $row['donationDate'],
                'quantity' => $row['quantity'],
                'description' => $row['description']
            ];
            
            // Determine the last donation date
            if ($lastDonationDate === null || $row['donationDate'] > $lastDonationDate) {
                $lastDonationDate = $row['donationDate'];
            }
        }
    }

    // Calculate time difference in months for the last donation date
    if ($lastDonationDate !== null) {
        $lastDonationDateTime = new DateTime($lastDonationDate);
        $currentDateTime = new DateTime();
        $interval = $lastDonationDateTime->diff($currentDateTime);
        $monthsDiff = $interval->m + ($interval->y * 12);

        // Determine donation status and set color
        $donationStatus = '';
        $statusColor = '';
        if ($monthsDiff >= 3) {
            $donationStatus = 'Ready to Donate';
            $statusColor = 'green';
        } else {
            $donationStatus = 'Not Allowed to Donate';
            $statusColor = 'red';
        }
    } else {
        $donationStatus = 'No Donations Yet';
        $statusColor = 'grey';
    }

    // Output the donor report JSON including donation status and color
    $donorReport = array_merge($donorInfo, [
        'lastDonationDate' => $lastDonationDate,
        'donationStatus' => $donationStatus,
        'statusColor' => $statusColor,
        'donations' => $donations
    ]);

    header('Content-Type: application/json');
    echo json_encode($donorReport);
} else {
    // Handle if donor information is not found
    echo json_encode(['error' => 'Donor information not found']);
}

mysqli_close($conn);
?>
