<?php
// Database connection
$conn = new mysqli('localhost', 'username', 'password', 'lethunathi_booking');

// Check for database connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch bookings from the database
$query = "SELECT checkin, checkout FROM bookings";
$result = $conn->query($query);

$bookedDates = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $start = new DateTime($row['checkin']);
        $end = new DateTime($row['checkout']);
        $interval = new DateInterval('P1D');
        $range = new DatePeriod($start, $interval, $end);

        foreach ($range as $date) {
            $bookedDates[] = $date->format("Y-m-d");
        }
    }
} else {
    // Handle query error
    die("Error executing query: " . $conn->error);
}

// Close the database connection
$conn->close();

// Return the unique booked dates in JSON format
header('Content-Type: application/json');
echo json_encode(array_unique($bookedDates));
?>
