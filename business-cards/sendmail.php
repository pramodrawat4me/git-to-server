<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $code  = $_POST['accessCode'] ?? '';

    $to = "pramodrawat4me@gmail.com"; // your email
    $subject = "Investor Deck Request - $name";
    $message = "Name: $name\nEmail: $email\nAccess Code: $code";
    $headers = "From: noreply@yourdomain.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
