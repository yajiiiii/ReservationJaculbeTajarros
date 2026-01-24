<?php
/**
 * Shared room catalog for reservation lookups.
 *
 * Usage:
 * - $catalog = getRoomCatalog();
 * - $room = findRoom($type, $roomName);
 */

function getRoomCatalog(): array
{
  // Include room constants
  if (!defined('ROOM_CATALOG_LOADED')) {
    require_once __DIR__ . '/../constant/constant.php';
    define('ROOM_CATALOG_LOADED', true);
  }

  // Check if variables are defined
  if (!isset($GLOBALS['REGULAR_ROOMS']) || !isset($GLOBALS['DELUXE_ROOMS']) || !isset($GLOBALS['SUITE_ROOMS'])) {
    // Variables not in global scope, try to get them directly
    if (!isset($REGULAR_ROOMS)) {
      global $REGULAR_ROOMS, $DELUXE_ROOMS, $SUITE_ROOMS;
    }
  } else {
    $REGULAR_ROOMS = $GLOBALS['REGULAR_ROOMS'];
    $DELUXE_ROOMS = $GLOBALS['DELUXE_ROOMS'];
    $SUITE_ROOMS = $GLOBALS['SUITE_ROOMS'];
  }

  $common = [
    'location' => 'Manila, Philippines',
    'hosted_by' => 'Pahinga Team',
  ];

  // Additional data for each room type (offers, image_dir)
  $roomExtras = [
    'regular' => [
      'Regular Room 1' => ['image_dir' => 'regular', 'offers' => ['Comfortable bed', 'Fast Wi‑Fi', 'Air conditioning', 'Fresh towels']],
      'Regular Room 2' => ['image_dir' => 'regular', 'offers' => ['Queen bed', 'Fast Wi‑Fi', 'Air conditioning', 'Daily housekeeping']],
      'Regular Room 3' => ['image_dir' => 'regular', 'offers' => ['Single bed', 'Fast Wi‑Fi', 'Work desk', 'Hot shower']],
      'Regular Room 4' => ['image_dir' => 'regular', 'offers' => ['Queen bed', 'Fast Wi‑Fi', 'Air conditioning', 'TV']],
      'Regular Room 5' => ['image_dir' => 'regular', 'offers' => ['Family space', 'Fast Wi‑Fi', 'Air conditioning', 'Mini fridge']],
      'Regular Room 6' => ['image_dir' => 'regular', 'offers' => ['Comfortable bed', 'Fast Wi‑Fi', 'Hot shower', 'Wardrobe']],
      'Regular Room 7' => ['image_dir' => 'regular', 'offers' => ['Single bed', 'Fast Wi‑Fi', 'Air conditioning', 'Basic toiletries']],
      'Regular Room 8' => ['image_dir' => 'regular', 'offers' => ['Family space', 'Fast Wi‑Fi', 'Air conditioning', 'Extra pillows']],
    ],
    'deluxe' => [
      'De Luxe Room 1' => ['image_dir' => 'deluxe', 'offers' => ['Premium bed', 'Fast Wi‑Fi', 'Smart TV', 'Mini bar']],
      'De Luxe Room 2' => ['image_dir' => 'deluxe', 'offers' => ['Premium bed', 'Fast Wi‑Fi', 'Smart TV', 'Coffee & tea']],
      'De Luxe Room 3' => ['image_dir' => 'deluxe', 'offers' => ['Premium bed', 'Fast Wi‑Fi', 'Smart TV', 'Work desk']],
      'De Luxe Room 4' => ['image_dir' => 'deluxe', 'offers' => ['Premium bed', 'Fast Wi‑Fi', 'Smart TV', 'Balcony view']],
      'De Luxe Room 5' => ['image_dir' => 'deluxe', 'offers' => ['Family space', 'Fast Wi‑Fi', 'Smart TV', 'Mini bar']],
      'De Luxe Room 6' => ['image_dir' => 'deluxe', 'offers' => ['Premium bed', 'Fast Wi‑Fi', 'Smart TV', 'Rain shower']],
      'De Luxe Room 7' => ['image_dir' => 'deluxe', 'offers' => ['Premium bed', 'Fast Wi‑Fi', 'Smart TV', 'Blackout curtains']],
      'De Luxe Room 8' => ['image_dir' => 'deluxe', 'offers' => ['Family space', 'Fast Wi‑Fi', 'Smart TV', 'Mini fridge']],
    ],
    'suite' => [
      'Suite Room 1' => ['image_dir' => 'suite', 'offers' => ['King bed', 'Fast Wi‑Fi', 'Premium TV', 'Living area']],
      'Suite Room 2' => ['image_dir' => 'suite', 'offers' => ['King bed', 'Fast Wi‑Fi', 'Premium TV', 'Coffee & tea']],
      'Suite Room 3' => ['image_dir' => 'suite', 'offers' => ['King bed', 'Fast Wi‑Fi', 'Premium TV', 'Balcony view']],
      'Suite Room 4' => ['image_dir' => 'suite', 'offers' => ['King bed', 'Fast Wi‑Fi', 'Premium TV', 'Living area']],
      'Suite Room 5' => ['image_dir' => 'suite', 'offers' => ['Family space', 'Fast Wi‑Fi', 'Premium TV', 'Kitchenette']],
      'Suite Room 6' => ['image_dir' => 'suite', 'offers' => ['King bed', 'Fast Wi‑Fi', 'Premium TV', 'Rain shower']],
      'Suite Room 7' => ['image_dir' => 'suite', 'offers' => ['King bed', 'Fast Wi‑Fi', 'Premium TV', 'Blackout curtains']],
      'Suite Room 8' => ['image_dir' => 'suite', 'offers' => ['Family space', 'Fast Wi‑Fi', 'Premium TV', 'Kitchenette']],
    ],
  ];

  // Build catalog from constants
  $catalog = [];
  
  // Process regular rooms
  if (isset($REGULAR_ROOMS) && is_array($REGULAR_ROOMS)) {
    foreach ($REGULAR_ROOMS as $room) {
      $name = $room['name'];
      $extras = $roomExtras['regular'][$name] ?? [];
      $catalog['regular'][] = array_merge($room, $extras, $common);
    }
  }

  // Process deluxe rooms
  if (isset($DELUXE_ROOMS) && is_array($DELUXE_ROOMS)) {
    foreach ($DELUXE_ROOMS as $room) {
      $name = $room['name'];
      $extras = $roomExtras['deluxe'][$name] ?? [];
      $catalog['deluxe'][] = array_merge($room, $extras, $common);
    }
  }

  // Process suite rooms
  if (isset($SUITE_ROOMS) && is_array($SUITE_ROOMS)) {
    foreach ($SUITE_ROOMS as $room) {
      $name = $room['name'];
      $extras = $roomExtras['suite'][$name] ?? [];
      $catalog['suite'][] = array_merge($room, $extras, $common);
    }
  }

  return $catalog;
}

function findRoom(string $type, string $roomName): ?array
{
  $type = strtolower(trim($type));
  $roomName = trim($roomName);

  $catalog = getRoomCatalog();
  if (!isset($catalog[$type])) {
    return null;
  }

  foreach ($catalog[$type] as $room) {
    if (isset($room['name']) && $room['name'] === $roomName) {
      return $room;
    }
  }

  return null;
}


