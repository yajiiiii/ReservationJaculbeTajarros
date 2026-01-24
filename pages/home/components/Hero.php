<?php
$base_path = isset($base_path) ? $base_path : "/ReservationJaculbeTajarros";
?>
<div class="grid lg:grid-cols-2 gap-8 md:gap-12 items-center">
  <div class="flex flex-col items-center md:items-start justify-center text-left w-full px-2 md:px-0 relative z-20">
    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black bg-linear-to-r from-[#1e88e5] to-[#64b5f6] bg-clip-text text-transparent tracking-tighter py-2 md:py-4 leading-tight w-full">
      Relax, Stay and Experience Comfort.
    </h1>
    <p class="mt-4 text-base sm:text-lg text-[#023e7d] max-w-xl tracking-wide leading-10">
      Book your perfect getaway in just a few clicks and choose your stay dates and room type to get started. Let's make your rest unforgettable.
    </p>
  </div>

  <div class="w-full flex justify-center lg:justify-center">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-6 sm:p-8">
      <div class="mb-6">
        <h2 class="text-2xl font-bold leading-tight bg-linear-to-r from-[#1e88e5] to-[#64b5f6] bg-clip-text text-transparent mb-4">
          Quick Search Hotel Room
        </h2>
        <p class="mt-1 text-sm text-[#023e7d] leading-relaxed">
          Select your dates and preferences to check availability.
        </p>
      </div>

      <form id="reservationForm" class="space-y-4" novalidate>
        <fieldset class="space-y-2">
          <legend class="block text-xs font-semibold text-[#1e88e5] uppercase">
            Room type
          </legend>

          <div class="grid grid-cols-3 gap-3">
            <label class="group cursor-pointer">
              <input type="radio" name="room_type" value="regular" class="sr-only peer" checked />
              <div class="flex flex-col items-center justify-center gap-2 rounded-2xl border border-[#023e7d]/20 bg-white px-3 py-4 text-center transition peer-checked:border-[#023e7d]">
                <svg class="h-7 w-7 text-[#023e7d]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                  <path d="M4 10.5V19a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-8.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                  <path d="M3 11l9-7 9 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M9.5 20v-6.25A1.75 1.75 0 0 1 11.25 12h1.5A1.75 1.75 0 0 1 14.5 13.75V20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
                <span class="text-xs font-semibold text-[#023e7d]">Regular</span>
              </div>
            </label>

            <label class="group cursor-pointer">
              <input type="radio" name="room_type" value="deluxe" class="sr-only peer" />
              <div class="flex flex-col items-center justify-center gap-2 rounded-2xl border border-[#023e7d]/20 bg-white px-3 py-4 text-center transition peer-checked:border-[#023e7d]">
                <svg class="h-7 w-7 text-[#023e7d]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                  <path d="M7 10h10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                  <path d="M6 10V7.75A2.75 2.75 0 0 1 8.75 5h6.5A2.75 2.75 0 0 1 18 7.75V10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                  <path d="M4 14.5V12.25A2.25 2.25 0 0 1 6.25 10h11.5A2.25 2.25 0 0 1 20 12.25v2.25" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                  <path d="M5 20v-2.5a3 3 0 0 1 3-3h8a3 3 0 0 1 3 3V20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
                <span class="text-xs font-semibold text-[#023e7d]">De Luxe</span>
              </div>
            </label>

            <label class="group cursor-pointer">
              <input type="radio" name="room_type" value="suite" class="sr-only peer" />
              <div class="flex flex-col items-center justify-center gap-2 rounded-2xl border border-[#023e7d]/20 bg-white px-3 py-4 text-center transition peer-checked:border-[#023e7d]">
                <svg class="h-7 w-7 text-[#023e7d]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                  <path d="M4 18h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                  <path d="M6 18v-7.25A2.75 2.75 0 0 1 8.75 8h6.5A2.75 2.75 0 0 1 18 10.75V18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                  <path d="M9 12.5h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                  <path d="M12 8V6.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                  <path d="M10.75 6.5h2.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
                <span class="text-xs font-semibold text-[#023e7d]">Suite</span>
              </div>
            </label>
          </div>
        </fieldset>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-semibold text-[#1e88e5] uppercase mb-1">
              Check-in
            </label>
            <div class="relative">
              <div class="flex items-center justify-between rounded-2xl border border-[#023e7d]/20 bg-white px-4 py-3 focus-within:border-[#1e88e5] focus-within:ring-2 focus-within:ring-[#1e88e5]/20 transition">
                <input
                  type="date"
                  id="check_in"
                  name="check_in"
                  class="w-full bg-transparent text-sm text-[#023e7d] outline-none cursor-pointer"
                  placeholder="Check in Date"
                  required
                />
              </div>
              <p id="check_in_error" class="mt-1 text-xs text-red-500 hidden"></p>
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold text-[#1e88e5] uppercase mb-1">
              Check-out
            </label>
            <div class="relative">
              <div class="flex items-center justify-between rounded-2xl border border-[#023e7d]/20 bg-white px-4 py-3 focus-within:border-[#1e88e5] focus-within:ring-2 focus-within:ring-[#1e88e5]/20 transition">
                <input
                  type="date"
                  id="check_out"
                  name="check_out"
                  class="w-full bg-transparent text-sm text-[#023e7d] outline-none cursor-pointer"
                  placeholder="Check out Date"
                  required
                />
              </div>
              <p id="check_out_error" class="mt-1 text-xs text-red-500 hidden"></p>
            </div>
          </div>
        </div>

        <button
          type="submit"
          class="mt-2 inline-flex w-full items-center justify-center rounded-2xl bg-[#1e88e5] px-6 py-3 text-sm font-semibold text-white hover:bg-[#1565c0] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#1e88e5] focus-visible:ring-offset-2 focus-visible:ring-offset-white transition"
        >
          Search
        </button>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo $base_path; ?>/utils/dateValidation.js"></script>
<script>
(function() {
  const form = document.getElementById('reservationForm');
  const checkInInput = document.getElementById('check_in');
  const checkOutInput = document.getElementById('check_out');
  const checkInError = document.getElementById('check_in_error');
  const checkOutError = document.getElementById('check_out_error');

  // Initialize date inputs with constraints and defaults
  DateValidation.initializeDateInputs(checkInInput, checkOutInput);

  // Update check-out min date when check-in changes
  checkInInput.addEventListener('change', function() {
    DateValidation.handleCheckInChange(checkInInput, checkOutInput, checkInError, checkOutError);
  });

  // Validate check-out when it changes
  checkOutInput.addEventListener('change', function() {
    DateValidation.handleCheckOutChange(checkInInput, checkOutInput, checkOutError);
  });

  // Form submission
  form.addEventListener('submit', function(e) {
    e.preventDefault();

    // Validate dates
    const isValid = DateValidation.validateFormDates(checkInInput, checkOutInput, checkInError, checkOutError);

    if (!isValid) {
      return;
    }

    // Get form data
    const formData = new FormData(form);
    const roomType = formData.get('room_type');
    const checkIn = formData.get('check_in');
    const checkOut = formData.get('check_out');

    // Navigate to rooms page with parameters
    const basePath = '<?php echo $base_path; ?>';
    const url = `${basePath}/?page=rooms&type=${roomType}&check_in=${checkIn}&check_out=${checkOut}`;
    window.location.href = url;
  });
})();
</script>