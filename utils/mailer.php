<?php
header('Content-Type: application/json');

// Load environment variables
$brevoApiKey = getenv('BREVO_API') ?: (isset($_ENV['BREVO_API']) ? $_ENV['BREVO_API'] : null);
$senderEmail = getenv('BREVO_SENDER_EMAIL') ?: (isset($_ENV['BREVO_SENDER_EMAIL']) ? $_ENV['BREVO_SENDER_EMAIL'] : null);
$senderName = getenv('BREVO_SENDER_NAME') ?: (isset($_ENV['BREVO_SENDER_NAME']) ? $_ENV['BREVO_SENDER_NAME'] : null);

// Validate required environment variables
if (empty($brevoApiKey)) {
  http_response_code(500);
  echo json_encode(['success' => false, 'error' => 'BREVO_API environment variable is not set']);
  exit;
}

if (empty($senderEmail)) {
  http_response_code(500);
  echo json_encode(['success' => false, 'error' => 'BREVO_SENDER_EMAIL environment variable is not set']);
  exit;
}

if (empty($senderName)) {
  http_response_code(500);
  echo json_encode(['success' => false, 'error' => 'BREVO_SENDER_NAME environment variable is not set']);
  exit;
}

$requiredFields = ['customerName', 'customerEmail', 'customerContact', 'roomName', 'checkIn', 'checkOut', 'nights', 'dateReserved', 'paymentType', 'base', 'discount', 'charge', 'total'];

foreach ($requiredFields as $field) {
  if (!isset($_POST[$field])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => "Missing required field: $field"]);
    exit;
  }
  
  $value = trim($_POST[$field]);
  if ($value === '' && !in_array($field, ['discount', 'charge'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => "Missing required field: $field"]);
    exit;
  }
  
  if ($value === '' && in_array($field, ['discount', 'charge'])) {
    $_POST[$field] = '0';
  }
}


$customerName = trim($_POST['customerName']);
$customerEmail = trim($_POST['customerEmail']);
$customerContact = trim($_POST['customerContact']);
$roomName = trim($_POST['roomName']);
$checkIn = trim($_POST['checkIn']);
$checkOut = trim($_POST['checkOut']);
$nights = trim($_POST['nights']);
$dateReserved = trim($_POST['dateReserved']);
$paymentType = trim($_POST['paymentType']);
$base = trim($_POST['base']);
$discount = trim($_POST['discount']);
$charge = trim($_POST['charge']);
$total = trim($_POST['total']);


if (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo json_encode(['success' => false, 'error' => 'Invalid email address']);
  exit;
}


$receiptHtml = generateReceiptHtml([
  'customerName' => $customerName,
  'customerEmail' => $customerEmail,
  'customerContact' => $customerContact,
  'roomName' => $roomName,
  'checkIn' => $checkIn,
  'checkOut' => $checkOut,
  'nights' => $nights,
  'dateReserved' => $dateReserved,
  'paymentType' => $paymentType,
  'base' => $base,
  'discount' => $discount,
  'charge' => $charge,
  'total' => $total
]);


$result = sendEmailViaBrevo($customerEmail, $customerName, $receiptHtml);

if ($result['success']) {
  http_response_code(200);
  echo json_encode(['success' => true, 'message' => 'Reservation confirmation email sent successfully']);
} else {
  http_response_code(500);
  echo json_encode(['success' => false, 'error' => $result['error']]);
}

function generateReceiptHtml($data) {
  $paymentTypeLabel = ucfirst($data['paymentType']);
  if ($data['paymentType'] === 'credit') {
    $paymentTypeLabel = 'Credit Card';
  }

  $html = '
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservation Receipt</title>
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      line-height: 1.6;
      color: #334155;
      background-color: #f8fafc;
      margin: 0;
      padding: 20px;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .header {
      background: linear-gradient(135deg, #1e88e5 0%, #1565c0 100%);
      color: white;
      padding: 30px;
      text-align: center;
    }
    .header h1 {
      margin: 0;
      font-size: 24px;
      font-weight: 700;
    }
    .content {
      padding: 30px;
    }
    .section {
      margin-bottom: 25px;
      padding: 20px;
      background-color: #f8fafc;
      border-radius: 8px;
      border: 1px solid #e2e8f0;
    }
    .section h2 {
      margin: 0 0 15px 0;
      font-size: 16px;
      font-weight: 700;
      color: #1e293b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .info-row {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px solid #e2e8f0;
    }
    .info-row:last-child {
      border-bottom: none;
    }
    .info-label {
      color: #64748b;
      font-size: 14px;
    }
    .info-value {
      color: #1e293b;
      font-size: 14px;
      font-weight: 600;
      text-align: right;
    }
    .total-row {
      display: flex;
      justify-content: space-between;
      padding: 15px 0;
      margin-top: 15px;
      border-top: 2px solid #1e88e5;
      font-size: 18px;
      font-weight: 700;
      color: #1e293b;
    }
    .footer {
      padding: 20px 30px;
      background-color: #f8fafc;
      text-align: center;
      color: #64748b;
      font-size: 12px;
      border-top: 1px solid #e2e8f0;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Reservation Confirmation</h1>
      <p style="margin: 10px 0 0 0; opacity: 0.9;">Thank you for your reservation!</p>
    </div>
    
    <div class="content">
      <div class="section">
        <h2>Customer Information</h2>
        <div class="info-row">
          <span class="info-label">Name:</span>
          <span class="info-value">' . htmlspecialchars($data['customerName']) . '</span>
        </div>
        <div class="info-row">
          <span class="info-label">Email:</span>
          <span class="info-value">' . htmlspecialchars($data['customerEmail']) . '</span>
        </div>
        <div class="info-row">
          <span class="info-label">Contact:</span>
          <span class="info-value">' . htmlspecialchars($data['customerContact']) . '</span>
        </div>
      </div>

      <div class="section">
        <h2>Reservation Details</h2>
        <div class="info-row">
          <span class="info-label">Room:</span>
          <span class="info-value">' . htmlspecialchars($data['roomName']) . '</span>
        </div>
        <div class="info-row">
          <span class="info-label">Date Reserved:</span>
          <span class="info-value">' . htmlspecialchars($data['dateReserved']) . '</span>
        </div>
        <div class="info-row">
          <span class="info-label">Check-in:</span>
          <span class="info-value">' . htmlspecialchars($data['checkIn']) . '</span>
        </div>
        <div class="info-row">
          <span class="info-label">Check-out:</span>
          <span class="info-value">' . htmlspecialchars($data['checkOut']) . '</span>
        </div>
        <div class="info-row">
          <span class="info-label">Nights:</span>
          <span class="info-value">' . htmlspecialchars($data['nights']) . '</span>
        </div>
        <div class="info-row">
          <span class="info-label">Payment Type:</span>
          <span class="info-value">' . htmlspecialchars($paymentTypeLabel) . '</span>
        </div>
      </div>

      <div class="section">
        <h2>Billing Summary</h2>
        <div class="info-row">
          <span class="info-label">Base Amount:</span>
          <span class="info-value">₱' . number_format((float)str_replace(',', '', $data['base']), 2) . '</span>
        </div>
        <div class="info-row">
          <span class="info-label">Cash Discount:</span>
          <span class="info-value">- ₱' . number_format((float)str_replace(',', '', $data['discount']), 2) . '</span>
        </div>
        <div class="info-row">
          <span class="info-label">Additional Charge:</span>
          <span class="info-value">+ ₱' . number_format((float)str_replace(',', '', $data['charge']), 2) . '</span>
        </div>
        <div class="total-row">
          <span>Total Amount:</span>
          <span>₱' . number_format((float)str_replace(',', '', $data['total']), 2) . '</span>
        </div>
      </div>
    </div>

    <div class="footer">
      <p>This is an automated confirmation email. Please keep this receipt for your records.</p>
      <p style="margin-top: 10px;">If you have any questions, please contact our support team.</p>
    </div>
  </div>
</body>
</html>';

  return $html;
}

function sendEmailViaBrevo($toEmail, $toName, $htmlContent) {
  global $brevoApiKey;
  
  if (empty($brevoApiKey)) {
    return [
      'success' => false,
      'error' => 'Brevo API key not configured. Please set BREVO_API environment variable.'
    ];
  }

  $url = 'https://api.brevo.com/v3/smtp/email';

  global $senderEmail, $senderName;
  
  $emailData = [
    'sender' => [
      'name' => $senderName,
      'email' => $senderEmail
    ],
    'to' => [
      [
        'name' => $toName,
        'email' => $toEmail
      ]
    ],
    'subject' => 'Reservation Confirmation - ' . date('Y-m-d'),
    'htmlContent' => $htmlContent
  ];

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($emailData));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Content-Type: application/json',
    'api-key: ' . $brevoApiKey
  ]);

  $response = curl_exec($ch);
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $error = curl_error($ch);
  curl_close($ch);

  if ($error) {
    return [
      'success' => false,
      'error' => 'cURL error: ' . $error
    ];
  }

  if ($httpCode >= 200 && $httpCode < 300) {
    return [
      'success' => true,
      'message' => 'Email sent successfully'
    ];
  } else {
    $errorData = json_decode($response, true);
    $errorMessage = isset($errorData['message']) ? $errorData['message'] : 'Unknown error';
    return [
      'success' => false,
      'error' => 'Brevo API error (' . $httpCode . '): ' . $errorMessage
    ];
  }
}
?>

