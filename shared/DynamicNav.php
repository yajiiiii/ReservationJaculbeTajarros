<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$base_url = $protocol . "://" . $host . "/ReservationJaculbeTajarros/";
$base_path = "/ReservationJaculbeTajarros";

// Get current room type and dates from URL
$currentRoomType = isset($_GET['type']) ? $_GET['type'] : 'regular';
$currentCheckIn = isset($_GET['check_in']) ? $_GET['check_in'] : '';
$currentCheckOut = isset($_GET['check_out']) ? $_GET['check_out'] : '';

// Validate room type
$validTypes = ['regular', 'deluxe', 'suite'];
if (!in_array($currentRoomType, $validTypes)) {
  $currentRoomType = 'regular';
}
?>

<nav 
  id="dynamic-navbar"
  class="fixed top-0 left-0 right-0 bg-white backdrop-blur-md shadow-md z-50 transition-all duration-300"
>
  <div class="max-w-[1800px] mx-auto px-4 md:px-6 lg:px-12 xl:px-24">
    <div class="flex items-center justify-between gap-4 py-4">
      <!-- Logo -->
      <div class="flex-shrink-0">
        <a href="<?php echo $base_path; ?>/" class="uppercase text-lg font-black bg-linear-to-r from-[#1e88e5] to-[#64b5f6] bg-clip-text text-transparent">
          Pahinga
        </a>
      </div>

      <!-- Search Form -->
      <form id="dynamicSearchForm" class="flex-1 max-w-4xl mx-auto hidden lg:flex items-center gap-2 bg-white border border-slate-200 rounded-full px-2 py-1 shadow-sm hover:shadow-md transition-shadow">
        <!-- Room Type -->
        <div class="flex-1 min-w-0">
          <label class="block text-xs font-semibold text-slate-500 uppercase mb-1 px-3">Room Type</label>
          <select
            name="room_type"
            id="nav_room_type"
            class="w-full bg-transparent text-sm text-slate-900 outline-none border-none px-3 pb-1 cursor-pointer"
          >
            <option value="regular" <?php echo $currentRoomType === 'regular' ? 'selected' : ''; ?>>Regular</option>
            <option value="deluxe" <?php echo $currentRoomType === 'deluxe' ? 'selected' : ''; ?>>De Luxe</option>
            <option value="suite" <?php echo $currentRoomType === 'suite' ? 'selected' : ''; ?>>Suite</option>
          </select>
        </div>

        <div class="w-px h-8 bg-slate-200"></div>

        <!-- Check-in -->
        <div class="flex-1 min-w-0">
          <label class="block text-xs font-semibold text-slate-500 uppercase mb-1 px-3">Check-in</label>
          <div class="flex items-center px-3 pb-1">
            <svg class="h-4 w-4 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <input
              type="date"
              id="nav_check_in"
              name="check_in"
              value="<?php echo htmlspecialchars($currentCheckIn); ?>"
              class="w-full bg-transparent text-sm text-slate-900 outline-none border-none cursor-pointer"
            />
          </div>
        </div>

        <div class="w-px h-8 bg-slate-200"></div>

        <!-- Check-out -->
        <div class="flex-1 min-w-0">
          <label class="block text-xs font-semibold text-slate-500 uppercase mb-1 px-3">Check-out</label>
          <div class="flex items-center px-3 pb-1">
            <svg class="h-4 w-4 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <input
              type="date"
              id="nav_check_out"
              name="check_out"
              value="<?php echo htmlspecialchars($currentCheckOut); ?>"
              class="w-full bg-transparent text-sm text-slate-900 outline-none border-none cursor-pointer"
            />
          </div>
        </div>

        <!-- Search Button -->
        <button
          type="submit"
          class="flex-shrink-0 bg-[#1e88e5] text-white rounded-full px-6 py-2.5 text-sm font-semibold hover:bg-[#1565c0] transition-colors shadow-sm"
        >
          Search
        </button>
      </form>

      <!-- Mobile Menu Button -->
      <button
        id="mobile-menu-button"
        class="lg:hidden p-2 rounded-full hover:bg-gray-100 transition-colors"
        type="button"
        aria-label="Toggle mobile menu"
        aria-expanded="false"
      >
        <svg id="menu-icon" class="w-5 h-5 text-slate-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg id="close-icon" class="w-5 h-5 text-slate-600 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile Search Form -->
  <div id="mobile-search" class="lg:hidden hidden border-t border-slate-200 bg-white">
    <form id="mobileSearchForm" class="p-4 space-y-4">
      <div>
        <label class="block text-xs font-semibold text-slate-500 uppercase mb-2">Room Type</label>
        <select
          name="room_type"
          id="mobile_room_type"
          class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
        >
          <option value="regular" <?php echo $currentRoomType === 'regular' ? 'selected' : ''; ?>>Regular</option>
          <option value="deluxe" <?php echo $currentRoomType === 'deluxe' ? 'selected' : ''; ?>>De Luxe</option>
          <option value="suite" <?php echo $currentRoomType === 'suite' ? 'selected' : ''; ?>>Suite</option>
        </select>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-xs font-semibold text-slate-500 uppercase mb-2">Check-in</label>
          <input
            type="date"
            id="mobile_check_in"
            name="check_in"
            value="<?php echo htmlspecialchars($currentCheckIn); ?>"
            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
          />
        </div>

        <div>
          <label class="block text-xs font-semibold text-slate-500 uppercase mb-2">Check-out</label>
          <input
            type="date"
            id="mobile_check_out"
            name="check_out"
            value="<?php echo htmlspecialchars($currentCheckOut); ?>"
            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
          />
        </div>
      </div>

      <button
        type="submit"
        class="w-full bg-[#1e88e5] text-white rounded-xl px-6 py-3 text-sm font-semibold hover:bg-[#1565c0] transition-colors"
      >
        Search
      </button>
    </form>
  </div>
</nav>

<script>
(function() {
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileSearch = document.getElementById('mobile-search');
  const menuIcon = document.getElementById('menu-icon');
  const closeIcon = document.getElementById('close-icon');
  const dynamicForm = document.getElementById('dynamicSearchForm');
  const mobileForm = document.getElementById('mobileSearchForm');
  const checkInInput = document.getElementById('nav_check_in');
  const checkOutInput = document.getElementById('nav_check_out');
  const mobileCheckIn = document.getElementById('mobile_check_in');
  const mobileCheckOut = document.getElementById('mobile_check_out');

  // Mobile menu toggle
  if (mobileMenuButton) {
    mobileMenuButton.addEventListener('click', function() {
      const isHidden = mobileSearch.classList.contains('hidden');
      mobileSearch.classList.toggle('hidden');
      menuIcon.classList.toggle('hidden');
      closeIcon.classList.toggle('hidden');
    });
  }

  // Set date constraints
  const today = new Date();
  const oneYearFromNow = new Date();
  oneYearFromNow.setFullYear(today.getFullYear() + 1);

  const formatDate = (date) => {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
  };

  const minDate = formatDate(today);
  const maxDate = formatDate(oneYearFromNow);

  // Set min and max for desktop inputs
  if (checkInInput && checkOutInput) {
    checkInInput.setAttribute('min', minDate);
    checkInInput.setAttribute('max', maxDate);
    
    checkInInput.addEventListener('change', function() {
      const checkInDate = new Date(this.value);
      const minCheckOut = new Date(checkInDate);
      minCheckOut.setDate(minCheckOut.getDate() + 1);
      checkOutInput.setAttribute('min', formatDate(minCheckOut));
    });
  }

  if (checkOutInput) {
    checkOutInput.setAttribute('min', minDate);
    checkOutInput.setAttribute('max', maxDate);
  }

  // Set min and max for mobile inputs
  if (mobileCheckIn) {
    mobileCheckIn.setAttribute('min', minDate);
    mobileCheckIn.setAttribute('max', maxDate);
    
    mobileCheckIn.addEventListener('change', function() {
      const checkInDate = new Date(this.value);
      const minCheckOut = new Date(checkInDate);
      minCheckOut.setDate(minCheckOut.getDate() + 1);
      if (mobileCheckOut) {
        mobileCheckOut.setAttribute('min', formatDate(minCheckOut));
      }
    });
  }

  if (mobileCheckOut) {
    mobileCheckOut.setAttribute('min', minDate);
    mobileCheckOut.setAttribute('max', maxDate);
  }

  // Form submission handlers
  const handleSubmit = (form, roomTypeInput, checkInInput, checkOutInput) => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const roomType = roomTypeInput.value;
      const checkIn = checkInInput.value;
      const checkOut = checkOutInput.value;

      if (!checkIn || !checkOut) {
        alert('Please select both check-in and check-out dates');
        return;
      }

      const checkInDate = new Date(checkIn);
      const checkOutDate = new Date(checkOut);
      const minCheckOut = new Date(checkInDate);
      minCheckOut.setDate(minCheckOut.getDate() + 1);

      if (checkOutDate <= checkInDate) {
        alert('Check-out must be at least one day after check-in');
        return;
      }

      const basePath = '<?php echo $base_path; ?>';
      const url = `${basePath}/?page=rooms&type=${roomType}&check_in=${checkIn}&check_out=${checkOut}`;
      window.location.href = url;
    });
  };

  if (dynamicForm) {
    handleSubmit(dynamicForm, document.getElementById('nav_room_type'), checkInInput, checkOutInput);
  }

  if (mobileForm) {
    handleSubmit(mobileForm, document.getElementById('mobile_room_type'), mobileCheckIn, mobileCheckOut);
  }
})();
</script>

<div class="h-20 lg:h-16"></div>

