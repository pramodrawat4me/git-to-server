<?php
// send-form.php - very minimal example (improve for production!)
header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);
if (!$input || empty($input['email'])) {
  http_response_code(400);
  echo json_encode(['error'=>'Bad request']);
  exit;
}

$name = htmlspecialchars($input['name']);
$email = filter_var($input['email'], FILTER_VALIDATE_EMAIL);
$subject = htmlspecialchars($input['subject'] ?? 'Contact form');
$message = htmlspecialchars($input['message'] ?? '');
$to = 'pramodrawat4me@gmail.com';
$body = "Name: $name\nEmail: $email\nPhone: {$input['phone']}\n\nMessage:\n$message\n";
$headers = "From: $name <$email>";

// send (use proper mail setup in production)
if (mail($to, $subject, $body, $headers)) {
  echo json_encode(['ok'=>true]);
} else {
  http_response_code(500);
  echo json_encode(['error'=>'Mail failed']);
}
