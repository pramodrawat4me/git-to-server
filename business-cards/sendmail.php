<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

$formfor  = $_POST['formfor'] ?? '';
$name     = $_POST['fullName'] ?? '';
$email    = $_POST['email'] ?? '';
$code     = $_POST['accessCode'] ?? '';

$EXPECTED_CODE = 'UBX20205!';

// Server-side validation of access code
if ($code !== $EXPECTED_CODE) {
    echo json_encode([
        'status' => 'error',
        'field'  => 'accessCode',
        'message'=> 'Access code is incorrect.'
    ]);
    exit;
}

// prepare email
$to = "pramodrawat4me@gmail.com";
$subject = "Investor Deck Request - " . ($name ?: 'No name provided');
$message = "Form For: $formfor\n";
$message .= "Name: $name\n";
$message .= "Email: $email\n";
$message .= "Access Code: $code\n";

$from = "notification@unboundxinc.com"; // <-- Replace with a real email address on your domain
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: " . (filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : $from) . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// send mail
$sent = mail($to, $subject, $message, $headers);

if ($sent) {
    echo json_encode(['status' => 'success']);
} else {
    // don't expose internal details to the client
    echo json_encode(['status' => 'error', 'message' => 'Failed to send email.']);
}
?>
