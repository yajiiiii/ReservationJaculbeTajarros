<?php
  // Handle calculation API endpoint - MUST be before any HTML output
  if (isset($_GET['action']) && $_GET['action'] === 'calculate' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/constant/constant.php';
    header('Content-Type: application/json');
    
    $days = isset($_POST['days']) ? (int)$_POST['days'] : 0;
    $roomType = isset($_POST['room_type']) ? trim($_POST['room_type']) : 'regular';
    $roomCapacity = isset($_POST['room_capacity']) ? trim($_POST['room_capacity']) : 'single';
    $paymentType = isset($_POST['payment_type']) ? trim($_POST['payment_type']) : 'cash';
    
    $result = calculateTotal($days, $roomType, $roomCapacity, $paymentType);
    echo json_encode([
      'subTotal' => round($result[0]),
      'discount' => round($result[1]),
      'additionalCharge' => round($result[2]),
      'totalBill' => round($result[3])
    ]);
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Seatwork Two - Jaculbe & Tajarros</title>
  <link rel="stylesheet" href="styles/app.css">
</head>

<body>
  <?php
    // Check which page to display based on navigation
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    
    // Only show the requested page
    if ($page === 'about') {
      include __DIR__ . '/pages/about/About.php';
    } elseif ($page === 'rooms') {
      include __DIR__ . '/pages/rooms/Rooms.php';
    } elseif ($page === 'reservation') {
      include __DIR__ . '/pages/reservation/Reservation.php';
    } else {
      // Default to home page
      include __DIR__ . '/pages/home/Home.php';
    }
  ?>

  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://cdn.jsdelivr.net/npm/vertical-timeline@2.0.0/assets/js/main.min.js"></script>
</body>

</html>