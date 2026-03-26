<?php
/**
 * Admin CRUD API Endpoints
 * Handles all admin operations for rooms and reservations
 */
header('Content-Type: application/json');

require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../constant/constant.php';

$db = Database::getInstance()->getConnection();
$action = isset($_GET['action']) ? $_GET['action'] : '';
$method = $_SERVER['REQUEST_METHOD'];

$response = ['success' => false, 'message' => 'Invalid action'];

switch ($action) {

    // ─── ROOMS ──────────────────────────────────────────

    case 'get_rooms':
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $sql = "SELECT * FROM rooms WHERE 1=1";
        $params = [];

        if ($type && in_array($type, ['regular', 'deluxe', 'suite'])) {
            $sql .= " AND type = :type";
            $params[':type'] = $type;
        }
        if ($search) {
            $sql .= " AND (name LIKE :search OR description LIKE :search2)";
            $params[':search'] = "%$search%";
            $params[':search2'] = "%$search%";
        }

        $sql .= " ORDER BY type, id";
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $rooms = $stmt->fetchAll();

        $response = ['success' => true, 'data' => $rooms];
        break;

    case 'get_room':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $stmt = $db->prepare("SELECT * FROM rooms WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $room = $stmt->fetch();

        if ($room) {
            $response = ['success' => true, 'data' => $room];
        } else {
            $response = ['success' => false, 'message' => 'Room not found'];
        }
        break;

    case 'create_room':
        if ($method !== 'POST') break;

        $name = trim($_POST['name'] ?? '');
        $type = trim($_POST['type'] ?? 'regular');
        $description = trim($_POST['description'] ?? '');
        $detailed_description = trim($_POST['detailed_description'] ?? '');
        $capacity = trim($_POST['capacity'] ?? '1 guest');
        $price = floatval($_POST['price'] ?? 0);
        $image = trim($_POST['image'] ?? '');
        $image_dir = trim($_POST['image_dir'] ?? $type);
        $offers = trim($_POST['offers'] ?? '');
        $status = trim($_POST['status'] ?? 'available');

        if (!$name || !$type || !$description || $price <= 0) {
            $response = ['success' => false, 'message' => 'Name, type, description, and valid price are required'];
            break;
        }

        $stmt = $db->prepare(
            "INSERT INTO rooms (name, type, description, detailed_description, capacity, price, image, image_dir, offers, status)
             VALUES (:name, :type, :description, :detailed_description, :capacity, :price, :image, :image_dir, :offers, :status)"
        );
        $stmt->execute([
            ':name' => $name,
            ':type' => $type,
            ':description' => $description,
            ':detailed_description' => $detailed_description,
            ':capacity' => $capacity,
            ':price' => $price,
            ':image' => $image,
            ':image_dir' => $image_dir,
            ':offers' => $offers,
            ':status' => $status,
        ]);

        $response = ['success' => true, 'message' => 'Room created successfully', 'id' => $db->lastInsertId()];
        break;

    case 'update_room':
        if ($method !== 'POST') break;

        $id = (int)($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $type = trim($_POST['type'] ?? 'regular');
        $description = trim($_POST['description'] ?? '');
        $detailed_description = trim($_POST['detailed_description'] ?? '');
        $capacity = trim($_POST['capacity'] ?? '1 guest');
        $price = floatval($_POST['price'] ?? 0);
        $image = trim($_POST['image'] ?? '');
        $image_dir = trim($_POST['image_dir'] ?? $type);
        $offers = trim($_POST['offers'] ?? '');
        $status = trim($_POST['status'] ?? 'available');

        if (!$id || !$name || !$type || !$description || $price <= 0) {
            $response = ['success' => false, 'message' => 'All required fields must be filled'];
            break;
        }

        $stmt = $db->prepare(
            "UPDATE rooms SET name=:name, type=:type, description=:description, detailed_description=:detailed_description,
             capacity=:capacity, price=:price, image=:image, image_dir=:image_dir, offers=:offers, status=:status
             WHERE id=:id"
        );
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':type' => $type,
            ':description' => $description,
            ':detailed_description' => $detailed_description,
            ':capacity' => $capacity,
            ':price' => $price,
            ':image' => $image,
            ':image_dir' => $image_dir,
            ':offers' => $offers,
            ':status' => $status,
        ]);

        $response = ['success' => true, 'message' => 'Room updated successfully'];
        break;

    case 'delete_room':
        if ($method !== 'POST') break;

        $id = (int)($_POST['id'] ?? 0);
        if (!$id) {
            $response = ['success' => false, 'message' => 'Room ID required'];
            break;
        }

        $stmt = $db->prepare("DELETE FROM rooms WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $response = ['success' => true, 'message' => 'Room deleted successfully'];
        break;

    // ─── RESERVATIONS ───────────────────────────────────

    case 'get_reservations':
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $sql = "SELECT r.*, rm.name as room_name, rm.type as room_type, rm.image, rm.image_dir
                FROM reservations r
                JOIN rooms rm ON r.room_id = rm.id
                WHERE 1=1";
        $params = [];

        if ($status && in_array($status, ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])) {
            $sql .= " AND r.status = :status";
            $params[':status'] = $status;
        }
        if ($search) {
            $sql .= " AND (r.customer_name LIKE :search OR r.customer_email LIKE :search2 OR rm.name LIKE :search3)";
            $params[':search'] = "%$search%";
            $params[':search2'] = "%$search%";
            $params[':search3'] = "%$search%";
        }

        $sql .= " ORDER BY r.created_at DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $reservations = $stmt->fetchAll();

        $response = ['success' => true, 'data' => $reservations];
        break;

    case 'get_reservation':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $stmt = $db->prepare(
            "SELECT r.*, rm.name as room_name, rm.type as room_type, rm.image, rm.image_dir
             FROM reservations r
             JOIN rooms rm ON r.room_id = rm.id
             WHERE r.id = :id"
        );
        $stmt->execute([':id' => $id]);
        $reservation = $stmt->fetch();

        if ($reservation) {
            $response = ['success' => true, 'data' => $reservation];
        } else {
            $response = ['success' => false, 'message' => 'Reservation not found'];
        }
        break;

    case 'create_reservation':
        if ($method !== 'POST') break;

        $room_id = (int)($_POST['room_id'] ?? 0);
        $customer_name = trim($_POST['customer_name'] ?? '');
        $customer_email = trim($_POST['customer_email'] ?? '');
        $customer_contact = trim($_POST['customer_contact'] ?? '');
        $check_in = trim($_POST['check_in'] ?? '');
        $check_out = trim($_POST['check_out'] ?? '');
        $payment_type = trim($_POST['payment_type'] ?? 'cash');

        if (!$room_id || !$customer_name || !$customer_email || !$customer_contact || !$check_in || !$check_out) {
            $response = ['success' => false, 'message' => 'All fields are required'];
            break;
        }

        // Get room info for calculation
        $stmt = $db->prepare("SELECT * FROM rooms WHERE id = :id");
        $stmt->execute([':id' => $room_id]);
        $room = $stmt->fetch();

        if (!$room) {
            $response = ['success' => false, 'message' => 'Room not found'];
            break;
        }

        $dtIn = new DateTime($check_in);
        $dtOut = new DateTime($check_out);
        $nights = (int)$dtIn->diff($dtOut)->days;

        $capacityType = getCapacityType($room['capacity']);
        $calc = calculateTotal($nights, $room['type'], $capacityType, $payment_type);

        $stmt = $db->prepare(
            "INSERT INTO reservations (room_id, customer_name, customer_email, customer_contact, check_in, check_out, nights, payment_type, subtotal, discount, additional_charge, total_bill, status)
             VALUES (:room_id, :customer_name, :customer_email, :customer_contact, :check_in, :check_out, :nights, :payment_type, :subtotal, :discount, :additional_charge, :total_bill, 'pending')"
        );
        $stmt->execute([
            ':room_id' => $room_id,
            ':customer_name' => $customer_name,
            ':customer_email' => $customer_email,
            ':customer_contact' => $customer_contact,
            ':check_in' => $check_in,
            ':check_out' => $check_out,
            ':nights' => $nights,
            ':payment_type' => $payment_type,
            ':subtotal' => round($calc[0], 2),
            ':discount' => round($calc[1], 2),
            ':additional_charge' => round($calc[2], 2),
            ':total_bill' => round($calc[3], 2),
        ]);

        $response = ['success' => true, 'message' => 'Reservation created successfully', 'id' => $db->lastInsertId()];
        break;

    case 'update_reservation_status':
        if ($method !== 'POST') break;

        $id = (int)($_POST['id'] ?? 0);
        $status = trim($_POST['status'] ?? '');

        $validStatuses = ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'];
        if (!$id || !in_array($status, $validStatuses)) {
            $response = ['success' => false, 'message' => 'Valid reservation ID and status required'];
            break;
        }

        $stmt = $db->prepare("UPDATE reservations SET status = :status WHERE id = :id");
        $stmt->execute([':status' => $status, ':id' => $id]);

        $response = ['success' => true, 'message' => 'Reservation status updated'];
        break;

    case 'delete_reservation':
        if ($method !== 'POST') break;

        $id = (int)($_POST['id'] ?? 0);
        if (!$id) {
            $response = ['success' => false, 'message' => 'Reservation ID required'];
            break;
        }

        $stmt = $db->prepare("DELETE FROM reservations WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $response = ['success' => true, 'message' => 'Reservation deleted successfully'];
        break;

    // ─── DASHBOARD STATS ────────────────────────────────

    case 'get_stats':
        $totalRooms = $db->query("SELECT COUNT(*) FROM rooms")->fetchColumn();
        $availableRooms = $db->query("SELECT COUNT(*) FROM rooms WHERE status = 'available'")->fetchColumn();
        $totalReservations = $db->query("SELECT COUNT(*) FROM reservations")->fetchColumn();
        $pendingReservations = $db->query("SELECT COUNT(*) FROM reservations WHERE status = 'pending'")->fetchColumn();
        $confirmedReservations = $db->query("SELECT COUNT(*) FROM reservations WHERE status = 'confirmed'")->fetchColumn();
        $totalRevenue = $db->query("SELECT COALESCE(SUM(total_bill), 0) FROM reservations WHERE status IN ('confirmed', 'checked_in', 'checked_out')")->fetchColumn();

        $recentReservations = $db->query(
            "SELECT r.*, rm.name as room_name, rm.type as room_type
             FROM reservations r JOIN rooms rm ON r.room_id = rm.id
             ORDER BY r.created_at DESC LIMIT 5"
        )->fetchAll();

        $response = [
            'success' => true,
            'data' => [
                'total_rooms' => (int)$totalRooms,
                'available_rooms' => (int)$availableRooms,
                'total_reservations' => (int)$totalReservations,
                'pending_reservations' => (int)$pendingReservations,
                'confirmed_reservations' => (int)$confirmedReservations,
                'total_revenue' => (float)$totalRevenue,
                'recent_reservations' => $recentReservations,
            ]
        ];
        break;
}

echo json_encode($response);
