<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $checkin = htmlspecialchars(trim($_POST['checkin']));
    $checkout = htmlspecialchars(trim($_POST['checkout']));
    $guests = (int) $_POST['guests']; // Ensuring guests is treated as an integer

    // Validate inputs
    if (empty($name) || empty($email) || empty($checkin) || empty($checkout) || empty($guests)) {
        die("Please fill in all fields.");
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Database connection
    $conn = new mysqli('localhost', 'username', 'password', 'database');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert booking into database using prepared statements
    $stmt = $conn->prepare("INSERT INTO bookings (name, email, checkin, checkout, guests) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $email, $checkin, $checkout, $guests);

    if ($stmt->execute()) {
        echo "Booking successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Send confirmation email to guest
    $subject = "Booking Confirmation";
    $message = "Dear $name,\n\nYour booking from $checkin to $checkout has been confirmed.\n\nThank you!";
    mail($email, $subject, $message);

    // Send notification email to admin
    $adminEmail = "admin@example.com";
    $adminSubject = "New Booking";
    $adminMessage = "New booking received:\n\nName: $name\nEmail: $email\nCheck-in: $checkin\nCheck-out: $checkout\nGuests: $guests";
    mail($adminEmail, $adminSubject, $adminMessage);
}
?>

<?php
// process-booking.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $checkin = htmlspecialchars(trim($_POST['checkin']));
    $checkout = htmlspecialchars(trim($_POST['checkout']));
    $guests = (int) $_POST['guests']; // Ensuring guests is treated as an integer

    // Validate inputs
    if (empty($name) || empty($email) || empty($checkin) || empty($checkout) || empty($guests)) {
        die("Please fill in all fields.");
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Database connection
    $conn = new mysqli('localhost', 'username', 'password', 'database');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert booking into database using prepared statements
    $stmt = $conn->prepare("INSERT INTO bookings (name, email, checkin, checkout, guests) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $email, $checkin, $checkout, $guests);

    if ($stmt->execute()) {
        // Booking was successful, handle confirmation emails
        // Send confirmation email to guest
        $subject = "Booking Confirmation";
        $message = "Dear $name,\n\nYour booking from $checkin to $checkout has been confirmed.\n\nThank you!";
        mail($email, $subject, $message);

        // Send notification email to admin
        $adminEmail = "admin@example.com";
        $adminSubject = "New Booking";
        $adminMessage = "New booking received:\n\nName: $name\nEmail: $email\nCheck-in: $checkin\nCheck-out: $checkout\nGuests: $guests";
        mail($adminEmail, $adminSubject, $adminMessage);

        echo "Booking successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

