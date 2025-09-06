<?php
// send-form.php
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
if (!$input || empty($input['email'])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid data"]);
    exit;
}

$name = htmlspecialchars($input['name'] ?? '');
$email = filter_var($input['email'], FILTER_VALIDATE_EMAIL);
$phone = htmlspecialchars($input['phone'] ?? '');
$subject = htmlspecialchars($input['subject'] ?? 'Contact Form');
$message = htmlspecialchars($input['message'] ?? '');

$to = "pramodrawat4me@gmail.com";  // 👈 your email
$body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message\n";
$headers = "From: $name <$email>\r\nReply-To: $email\r\n";

// Try sending
if (mail($to, $subject, $body, $headers)) {
    echo json_encode(["ok" => true]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Mail failed"]);
}
