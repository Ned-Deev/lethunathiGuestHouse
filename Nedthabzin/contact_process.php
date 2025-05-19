<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        die("Please complete the form and provide a valid email.");
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'your-email@example.com'; 
        $mail->Password = 'your-password';
        $mail->Port = 587;


        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('info@lethunathiguesthouse.co.za', 'Lethunathi Guesthouse');

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'New Contact Message from ' . $name;
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();
        echo "Thank you for your message. We’ll get back to you shortly!";
    } catch (Exception $e) {
        echo "Error sending email. Please try again. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
