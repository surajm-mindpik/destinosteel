<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Your email address
    $to = "info@destinosteel.com";

    // Sanitize input
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validation
    if (
        empty($name) ||
        empty($email) ||
        empty($subject) ||
        empty($message)
    ) {
        die("Please fill in all fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address.");
    }

    // Email content
    $email_subject = "Website Contact: " . $subject;

    $email_body = "You have received a new message.\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Subject: $subject\n\n";
    $email_body .= "Message:\n$message\n";

    // Headers
    $headers = "From: Website Contact <no-reply@yourdomain.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send mail
    if (mail($to, $email_subject, $email_body, $headers)) {

        echo "<script>
                alert('Message sent successfully!');
                window.location.href='index.php';
              </script>";

    } else {

        echo "<script>
                alert('Failed to send message.');
                window.history.back();
              </script>";
    }

} else {
    header("Location: index.php");
    exit();
}
?>