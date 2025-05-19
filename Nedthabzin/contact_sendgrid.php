<?php
// Include SendGrid's PHP library
require 'vendor/autoload.php';  // Path to Composer's autoload.php

// Get the SendGrid API key from your environment or configuration
$sendgrid_api_key = 'YOUR_SENDGRID_API_KEY';

// Collect form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Validate inputs
if (empty($name) || empty($email) || empty($message)) {
    die("Please fill in all fields.");
}

// Create the SendGrid email
$from = new SendGrid\Email("no-reply@yourdomain.com", "Contact Form");
$to = new SendGrid\Email("admin@yourdomain.com", "Admin");
$subject = "New Contact Form Submission";
$content = new SendGrid\Content("text/plain", "Name: $name\nEmail: $email\nMessage: $message");

$mail = new SendGrid\Mail($from, $subject, $to, $content);

// Send the email using SendGrid API
$sg = new SendGrid($sendgrid_api_key);
$response = $sg->client->mail()->send()->post($mail);

// Check for a successful response
if ($response->statusCode() == 202) {
    echo "Your message has been sent successfully!";
} else {
    echo "There was an error sending your message. Please try again later.";
}
?>
