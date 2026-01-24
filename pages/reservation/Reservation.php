<?php
$base_path = isset($base_path) ? $base_path : "/ReservationJaculbeTajarros";

$type = isset($_GET['type']) ? strtolower(trim($_GET['type'])) : 'regular';
$roomName = isset($_GET['room']) ? trim($_GET['room']) : '';
$checkIn = isset($_GET['check_in']) ? trim($_GET['check_in']) : '';
$checkOut = isset($_GET['check_out']) ? trim($_GET['check_out']) : '';

// Validate room type
$validTypes = ['regular', 'deluxe', 'suite'];
if (!in_array($type, $validTypes)) {
  $type = 'regular';
}

require_once __DIR__ . '/../../shared/RoomCatalog.php';
require_once __DIR__ . '/../../constant/constant.php';
$room = $roomName ? findRoom($type, $roomName) : null;

// Asset base (same style as other pages)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'] ?? '';
$asset_base = $host ? ($protocol . "://" . $host . $base_path) : $base_path;

// Nights computation
$nights = 0;
if ($checkIn && $checkOut) {
  try {
    $dtIn = new DateTime($checkIn);
    $dtOut = new DateTime($checkOut);
    $diff = $dtIn->diff($dtOut);
    $nights = (int)$diff->days;
    if ($dtOut <= $dtIn) {
      $nights = 0;
    }
  } catch (Exception $e) {
    $nights = 0;
  }
}

$selectedRoomLabel = $room ? $room['name'] : ($roomName ?: 'Select a room');
$selectedRoomPrice = $room ? (float)$room['price'] : 0.0;
?>

<section class="bg-[#f8f8f8] text-white">
  <main class="flex min-h-screen flex-col items-center justify-center">
    <section class="py-12 lg:py-0 min-h-screen w-full flex md:items-center md:justify-center bg-transparent relative overflow-hidden pb-8 md:pb-0">
      <div class="w-full max-w-[1800px] mx-auto relative z-10 lg:py-12 md:pt-0 px-4 md:px-6 lg:px-12 xl:px-24">
        <div class="mb-6">
          <a
            href="<?php echo $base_path; ?>/?page=rooms&type=<?php echo urlencode($type); ?><?php echo ($checkIn && $checkOut) ? '&check_in=' . urlencode($checkIn) . '&check_out=' . urlencode($checkOut) : ''; ?>"
            class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-50"
          >
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Rooms
          </a>
        </div>

        <?php if (!$room): ?>
          <div class="mb-8 rounded-3xl border border-amber-200 bg-amber-50 p-6 text-amber-900 shadow-sm">
            <p class="font-semibold">Room not found.</p>
            <p class="text-sm mt-1">Please go back to Rooms and click “Book this room” again.</p>
            <div class="mt-4">
              <a
                class="inline-flex items-center justify-center rounded-2xl bg-[#1e88e5] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1565c0]"
                href="<?php echo $base_path; ?>/?page=rooms&type=<?php echo urlencode($type); ?><?php echo ($checkIn && $checkOut) ? '&check_in=' . urlencode($checkIn) . '&check_out=' . urlencode($checkOut) : ''; ?>"
              >
                Back to Rooms
              </a>
            </div>
          </div>
        <?php endif; ?>

        <!-- Full-width image -->
        <div class="rounded-3xl overflow-hidden">
          <div class="relative w-full overflow-hidden">
            <?php if ($room): ?>
              <img
                src="<?php echo $asset_base; ?>/assets/<?php echo htmlspecialchars($room['image_dir']); ?>/<?php echo htmlspecialchars($room['image']); ?>"
                alt="<?php echo htmlspecialchars($room['name']); ?>"
                class="w-full h-[50vh] object-cover"
                loading="lazy"
              />
            <?php else: ?>
              <div class="w-full h-[50vh] bg-slate-100"></div>
            <?php endif; ?>
            <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/10 to-black/0"></div>

            <div class="absolute left-6 right-6 bottom-6">
              <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                  <p class="text-xs font-semibold text-[#90caf9] uppercase tracking-wider">
                    <?php echo strtoupper(htmlspecialchars($type)); ?>
                  </p>
                  <h2 class="text-2xl md:text-4xl font-black text-[#90caf9] tracking-tight">
                    <?php echo htmlspecialchars($selectedRoomLabel); ?>
                  </h2>
                  <p class="text-sm text-[#90caf9] mt-1">
                    <?php echo $room ? htmlspecialchars($room['location']) : '—'; ?>
                  </p>
                </div>
                <div class="rounded-2xl bg-white/95 px-4 py-3 text-[#023e7d] shadow-sm">
                  <p class="text-xs font-semibold text-[#023e7d]">Price</p>
                  <p class="text-lg font-black text-[#1e88e5]">
                    ₱<?php echo number_format($selectedRoomPrice, 0); ?>
                    <span class="text-xs font-semibold text-[#023e7d]">/night</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Below image: 2-column (Airbnb-ish) -->
        <div class="mt-10 grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-10 items-start">
          <!-- Left: Calendar + Room description -->
          <div class="lg:col-span-2">
            <div class="space-y-8">
              <!-- Calendar card -->
              <div class="rounded-3xl border border-slate-200 bg-white p-6 md:p-8">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                  <div>
                    <h3 class="text-xl font-black text-[#1e88e5]">Your stay</h3>
                    <p class="text-sm text-[#023e7d] mt-1">Select check‑in and check‑out dates to update nights and billing.</p>
                  </div>  
                  <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-semibold text-[#1e88e5]">
                      Hosted by: <span class="ml-1 text-[#1e88e5]"><?php echo $room ? htmlspecialchars($room['hosted_by']) : '—'; ?></span>
                    </span>
                    <span class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-semibold text-[#1e88e5]">
                      Capacity: <span class="ml-1 text-[#1e88e5]"><?php echo $room ? htmlspecialchars($room['capacity']) : '—'; ?></span>
                    </span>
                  </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                  <div>
                    <label for="check_in_input" class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Check‑in</label>
                    <input
                      id="check_in_input"
                      type="date"
                      value="<?php echo $checkIn ? htmlspecialchars($checkIn) : ''; ?>"
                      class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
                    />
                  </div>
                  <div>
                    <label for="check_out_input" class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Check‑out</label>
                    <input
                      id="check_out_input"
                      type="date"
                      value="<?php echo $checkOut ? htmlspecialchars($checkOut) : ''; ?>"
                      class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
                    />
                  </div>
                  <div>
                    <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Nights</label>
                    <div class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#023e7d]">
                      <span id="ui_nights" class="font-black"><?php echo $nights ? htmlspecialchars((string)$nights) : '—'; ?></span>
                      <span class="text-[#023e7d] font-semibold ml-1">night(s)</span>
                    </div>
                    <div id="date_warning" class="hidden mt-2 rounded-2xl border border-amber-200 bg-amber-50 p-3 text-[#023e7d]">
                      <p class="text-xs font-semibold">Check‑out must be after check‑in.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- About (no background) -->
              <div class="border-t border-slate-200 pt-6">
                <h3 class="text-lg font-black text-[#1e88e5]">About this room</h3>
                <p class="mt-2 text-base text-[#023e7d] leading-relaxed">
                  <?php echo $room && isset($room['detailed_description']) ? htmlspecialchars($room['detailed_description']) : ($room ? htmlspecialchars($room['description']) : 'Choose a room from the Rooms page to view details.'); ?>
                </p>
              </div>

              <div class="border-t border-slate-200 pt-6">
                <h4 class="text-base font-black text-[#1e88e5]">What this place offers</h4>
                <ul class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2 text-base text-[#023e7d]">
                  <?php if ($room && isset($room['offers']) && is_array($room['offers'])): ?>
                    <?php foreach ($room['offers'] as $offer): ?>
                      <li class="flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-[#1e88e5]"></span>
                        <?php echo htmlspecialchars($offer); ?>
                      </li>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <li class="text-[#023e7d]">—</li>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
          </div>

          <!-- Right: Billing statement -->
          <div class="lg:col-span-1">
            <?php
              // Variables expected by Payment.php
              $reservation_room = $room;
              $reservation_type = $type;
              $reservation_room_name = $selectedRoomLabel;
              $reservation_price_per_night = $selectedRoomPrice;
              $reservation_check_in = $checkIn;
              $reservation_check_out = $checkOut;
              $reservation_nights = $nights;
              $reservation_capacity_type = $room ? getCapacityType($room['capacity']) : 'single';
            ?>
            <?php include __DIR__ . '/components/Payment.php'; ?>
          </div>
        </div>

        <?php
          // Modal component (opened via Payment "Next")
          include __DIR__ . '/components/Modal.php';
        ?>
      </div>
    </section>
  </main>
</section>

<script>
(function() {
  const checkInInput = document.getElementById('check_in_input');
  const checkOutInput = document.getElementById('check_out_input');
  const dateWarning = document.getElementById('date_warning');
  const uiNights = document.getElementById('ui_nights');

  if (!checkInInput || !checkOutInput) return;

  // Set date constraints - normalize to midnight for proper date-only comparison
  const today = new Date();
  today.setHours(0, 0, 0, 0);
  const oneYearFromNow = new Date(today);
  oneYearFromNow.setFullYear(today.getFullYear() + 1);

  const formatDate = (date) => {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
  };

  // Set min and max dates
  const minDate = formatDate(today);
  const maxDate = formatDate(oneYearFromNow);

  checkInInput.setAttribute('min', minDate);
  checkInInput.setAttribute('max', maxDate);
  checkOutInput.setAttribute('min', minDate);
  checkOutInput.setAttribute('max', maxDate);

  // Update check-out min date when check-in changes
  checkInInput.addEventListener('change', function() {
    const checkInDate = new Date(this.value);
    checkInDate.setHours(0, 0, 0, 0);
    const minCheckOut = new Date(checkInDate);
    minCheckOut.setDate(minCheckOut.getDate() + 1);
    
    const minCheckOutStr = formatDate(minCheckOut);
    checkOutInput.setAttribute('min', minCheckOutStr);
    
    // If current check-out is before new minimum, update it
    if (checkOutInput.value) {
      const currentCheckOut = new Date(checkOutInput.value);
      currentCheckOut.setHours(0, 0, 0, 0);
      if (currentCheckOut <= checkInDate) {
        checkOutInput.value = minCheckOutStr;
      }
    }
    
    updateNightsAndWarning();
  });

  // Validate check-out when it changes
  checkOutInput.addEventListener('change', function() {
    updateNightsAndWarning();
  });

  function updateNightsAndWarning() {
    const checkInVal = checkInInput.value;
    const checkOutVal = checkOutInput.value;

    if (!checkInVal || !checkOutVal) {
      if (uiNights) uiNights.textContent = '—';
      if (dateWarning) dateWarning.classList.add('hidden');
      return;
    }

    const checkInDate = new Date(checkInVal);
    checkInDate.setHours(0, 0, 0, 0);
    const checkOutDate = new Date(checkOutVal);
    checkOutDate.setHours(0, 0, 0, 0);

    if (checkOutDate <= checkInDate) {
      if (uiNights) uiNights.textContent = '—';
      if (dateWarning) dateWarning.classList.remove('hidden');
    } else {
      const diffMs = checkOutDate.getTime() - checkInDate.getTime();
      const nights = Math.floor(diffMs / (1000 * 60 * 60 * 24));
      if (uiNights) uiNights.textContent = String(nights);
      if (dateWarning) dateWarning.classList.add('hidden');
      
      // Update URL parameters to reflect new dates
      updateUrlParams();
    }
  }

  function updateUrlParams() {
    const checkInVal = checkInInput.value;
    const checkOutVal = checkOutInput.value;
    
    if (checkInVal && checkOutVal) {
      const url = new URL(window.location.href);
      url.searchParams.set('check_in', checkInVal);
      url.searchParams.set('check_out', checkOutVal);
      window.history.replaceState({}, '', url);
    }
  }

  // Initialize on page load
  updateNightsAndWarning();
})();
</script>

