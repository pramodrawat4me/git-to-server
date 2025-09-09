<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = htmlspecialchars($_POST['fullName']);
    $email = htmlspecialchars($_POST['email']);
    $code  = htmlspecialchars($_POST['accessCode']);

    $to = "pramodrawat4me@gmail.com";  // your email
    $subject = "New Form Submission";
    $message = "
    You have received a new form submission:\n\n
    Full Name: $name\n
    Email: $email\n
    Access Code: $code\n
    ";
    $headers = "From: noreply@yourdomain.com\r\n" .
               "Reply-To: $email\r\n" .
               "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        echo "<h2>✅ Thank you, your form has been submitted successfully!</h2>";
    } else {
        echo "<h2>❌ Sorry, something went wrong. Please try again later.</h2>";
    }
}
?>
