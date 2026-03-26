<?php
/**
 * Save reservation to database
 * Replaces the email-based confirmation with a database insert
 */
header('Content-Type: application/json');

require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../constant/constant.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

$room_id = (int)($_POST['room_id'] ?? 0);
$customerName = trim($_POST['customerName'] ?? '');
$customerEmail = trim($_POST['customerEmail'] ?? '');
$customerContact = trim($_POST['customerContact'] ?? '');
$checkIn = trim($_POST['checkIn'] ?? '');
$checkOut = trim($_POST['checkOut'] ?? '');
$paymentType = trim($_POST['paymentType'] ?? 'cash');
$subtotal = floatval($_POST['base'] ?? 0);
$discount = floatval($_POST['discount'] ?? 0);
$charge = floatval($_POST['charge'] ?? 0);
$total = floatval($_POST['total'] ?? 0);

if (!$room_id || !$customerName || !$customerEmail || !$customerContact || !$checkIn || !$checkOut) {
    echo json_encode(['success' => false, 'error' => 'All fields are required']);
    exit;
}

// Calculate nights
$dtIn = new DateTime($checkIn);
$dtOut = new DateTime($checkOut);
$nights = (int)$dtIn->diff($dtOut)->days;

try {
    $db = Database::getInstance()->getConnection();

    $stmt = $db->prepare(
        "INSERT INTO reservations (room_id, customer_name, customer_email, customer_contact, check_in, check_out, nights, payment_type, subtotal, discount, additional_charge, total_bill, status)
         VALUES (:room_id, :customer_name, :customer_email, :customer_contact, :check_in, :check_out, :nights, :payment_type, :subtotal, :discount, :additional_charge, :total_bill, 'pending')"
    );
    $stmt->execute([
        ':room_id' => $room_id,
        ':customer_name' => $customerName,
        ':customer_email' => $customerEmail,
        ':customer_contact' => $customerContact,
        ':check_in' => $checkIn,
        ':check_out' => $checkOut,
        ':nights' => $nights,
        ':payment_type' => $paymentType,
        ':subtotal' => $subtotal,
        ':discount' => $discount,
        ':additional_charge' => $charge,
        ':total_bill' => $total,
    ]);

    echo json_encode(['success' => true, 'message' => 'Reservation saved successfully', 'id' => $db->lastInsertId()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}
