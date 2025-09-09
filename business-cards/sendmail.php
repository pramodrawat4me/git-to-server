<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formfor  = $_POST['formfor'] ?? '';
    $name     = $_POST['fullName'] ?? '';
    $email    = $_POST['email'] ?? '';
    $code     = $_POST['accessCode'] ?? '';

    $to = "pramodrawat4me@gmail.com"; 
    $subject = "Investor Deck Request - $name";
    $message = "Form For: $formfor\n";
    $message .= "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "Access Code: $code\n";
    
    $headers = "From: notification@unboundxinc.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
