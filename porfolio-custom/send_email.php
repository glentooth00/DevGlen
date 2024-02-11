<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Set up email
    $to = "glendonnalpasan1@gmail.com"; // Change this to your email address
    $subject = "New message from your website";
    $body = "Email: $email\n\nMessage:\n$message";

    // Send email
    if (mail($to, $subject, $body)) {
        echo "Message sent successfully!";
    } else {
        echo "Error: Message could not be sent.";
    }
}

