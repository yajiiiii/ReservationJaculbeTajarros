<?php
$base_path = isset($base_path) ? $base_path : "/ReservationJaculbeTajarros";
$roomType = isset($_GET['type']) ? $_GET['type'] : 'regular';
$checkIn = isset($_GET['check_in']) ? $_GET['check_in'] : '';
$checkOut = isset($_GET['check_out']) ? $_GET['check_out'] : '';

// Validate room type
$validTypes = ['regular', 'deluxe', 'suite'];
if (!in_array($roomType, $validTypes)) {
  $roomType = 'regular';
}
?>

<section class="bg-[#f8f8f8] bg-[radial-gradient(#bbdefb_1px,transparent_1px)] [background-size:16px_16px] text-white">
  <main class="flex min-h-screen flex-col items-center justify-center">
    <section class="py-12 min-h-screen w-full flex md:items-center md:justify-center bg-transparent relative overflow-hidden pb-8 md:pb-0">
      <?php include __DIR__ . '/../../shared/DynamicNav.php'; ?>
      <div class="p-4 w-full max-w-[1800px] mx-auto relative z-10 p-4 md:p-6 lg:p-12 xl:p-24">
        <?php
          // Include the appropriate room component
          if ($roomType === 'regular') {
            include __DIR__ . '/components/regular/Regular.php';
          } elseif ($roomType === 'deluxe') {
            include __DIR__ . '/components/deluxe/Deluxe.php';
          } elseif ($roomType === 'suite') {
            include __DIR__ . '/components/suite/Suite.php';
          }
        ?>
      </div>
    </section>
  </main>
</section>

