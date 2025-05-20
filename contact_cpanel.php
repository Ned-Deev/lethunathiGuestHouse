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
        $mail->isSMTP();
        $mail->Host       = 'mail.lethunathiguesthouse.co.za'; // Your domain
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@lethunathiguesthouse.co.za'; // Your cPanel email
        $mail->Password   = 'your_email_password'; // Set in cPanel
        $mail->SMTPSecure = 'ssl'; // Or 'tls' with Port 587
        $mail->Port       = 465;

        $mail->setFrom('info@lethunathiguesthouse.co.za', 'Lethunathi Guesthouse');
        $mail->addAddress('info@lethunathiguesthouse.co.za');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(false);
        $mail->Subject = "New Contact Message from $name";
        $mail->Body    = "Name: $name\nEmail: $email\n\n$message";

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>
