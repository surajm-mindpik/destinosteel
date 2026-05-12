<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Receiver Email
    $to = "info@destinosteel.com";

    // Email Subject
    $mail_subject = "New Contact Form Message: " . $subject;

    // Email Body
    $body = "
    You have received a new message from your website contact form.

    Name: $name
    Email: $email
    Subject: $subject

    Message:
    $message
    ";

    // Headers
    $headers = "From: $email" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";

    // Send Mail
    if (mail($to, $mail_subject, $body, $headers)) {

        echo "
        <script>
            alert('Message sent successfully!');
            window.location.href='contact.html';
        </script>
        ";

    } else {

        echo "
        <script>
            alert('Failed to send message!');
            window.location.href='contact.html';
        </script>
        ";
    }
}
?>