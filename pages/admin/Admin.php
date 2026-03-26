<?php
$base_path = isset($base_path) ? $base_path : "/ReservationJaculbeTajarros";
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$asset_base = $protocol . "://" . $host . $base_path;
$api_base = $base_path . "/admin/api.php";

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'dashboard';
?>

<div class="min-h-screen bg-[#f8f8f8]">
  <!-- Admin Navbar -->
  <nav class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
    <div class="max-w-[1800px] mx-auto px-4 md:px-6 lg:px-12 xl:px-24">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center gap-4">
          <a href="<?php echo $base_path; ?>/" class="uppercase text-lg font-black bg-linear-to-r from-[#1e88e5] to-[#64b5f6] bg-clip-text text-transparent">
            Pahinga
          </a>
          <span class="hidden sm:inline-flex items-center rounded-full bg-[#1e88e5]/10 px-3 py-1 text-xs font-bold text-[#1e88e5] uppercase tracking-wider">Admin</span>
        </div>
        <a href="<?php echo $base_path; ?>/" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-[#023e7d] hover:bg-slate-50 transition">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
          Back to Site
        </a>
      </div>
    </div>
  </nav>

  <!-- Tab Navigation -->
  <div class="bg-white border-b border-slate-200">
    <div class="max-w-[1800px] mx-auto px-4 md:px-6 lg:px-12 xl:px-24">
      <div class="flex gap-1 overflow-x-auto">
        <a href="<?php echo $base_path; ?>/?page=admin&tab=dashboard"
           class="px-5 py-4 text-sm font-semibold border-b-2 transition whitespace-nowrap <?php echo $tab === 'dashboard' ? 'border-[#1e88e5] text-[#1e88e5]' : 'border-transparent text-[#023e7d]/60 hover:text-[#023e7d] hover:border-slate-300'; ?>">
          Dashboard
        </a>
        <a href="<?php echo $base_path; ?>/?page=admin&tab=rooms"
           class="px-5 py-4 text-sm font-semibold border-b-2 transition whitespace-nowrap <?php echo $tab === 'rooms' ? 'border-[#1e88e5] text-[#1e88e5]' : 'border-transparent text-[#023e7d]/60 hover:text-[#023e7d] hover:border-slate-300'; ?>">
          Rooms
        </a>
        <a href="<?php echo $base_path; ?>/?page=admin&tab=reservations"
           class="px-5 py-4 text-sm font-semibold border-b-2 transition whitespace-nowrap <?php echo $tab === 'reservations' ? 'border-[#1e88e5] text-[#1e88e5]' : 'border-transparent text-[#023e7d]/60 hover:text-[#023e7d] hover:border-slate-300'; ?>">
          Reservations
        </a>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="max-w-[1800px] mx-auto px-4 md:px-6 lg:px-12 xl:px-24 py-8">

    <!-- ═══ DASHBOARD TAB ═══ -->
    <?php if ($tab === 'dashboard'): ?>
    <div id="dashboard-tab">
      <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-black text-[#023e7d] tracking-tight">Dashboard</h1>
        <p class="text-sm text-[#023e7d]/60 mt-1">Overview of your hotel operations</p>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" id="stats-grid">
        <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-[#1e88e5]/10">
              <svg class="w-5 h-5 text-[#1e88e5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </span>
          </div>
          <p class="text-2xl font-black text-[#023e7d]" id="stat-total-rooms">--</p>
          <p class="text-xs font-semibold text-[#023e7d]/50 uppercase tracking-wider mt-1">Total Rooms</p>
        </div>
        <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-500/10">
              <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </span>
          </div>
          <p class="text-2xl font-black text-[#023e7d]" id="stat-available-rooms">--</p>
          <p class="text-xs font-semibold text-[#023e7d]/50 uppercase tracking-wider mt-1">Available Rooms</p>
        </div>
        <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-amber-500/10">
              <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </span>
          </div>
          <p class="text-2xl font-black text-[#023e7d]" id="stat-total-reservations">--</p>
          <p class="text-xs font-semibold text-[#023e7d]/50 uppercase tracking-wider mt-1">Reservations</p>
        </div>
        <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-[#1e88e5]/10">
              <svg class="w-5 h-5 text-[#1e88e5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </span>
          </div>
          <p class="text-2xl font-black text-[#023e7d]" id="stat-revenue">--</p>
          <p class="text-xs font-semibold text-[#023e7d]/50 uppercase tracking-wider mt-1">Total Revenue</p>
        </div>
      </div>

      <!-- Recent Reservations -->
      <div class="rounded-2xl bg-white border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100">
          <h3 class="text-lg font-black text-[#1e88e5]">Recent Reservations</h3>
          <p class="text-sm text-[#023e7d]/60 mt-1">Latest 5 bookings</p>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead class="bg-slate-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Room</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Check-in</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Total</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Status</th>
              </tr>
            </thead>
            <tbody id="recent-reservations-body" class="divide-y divide-slate-100">
              <tr><td colspan="5" class="px-6 py-8 text-center text-[#023e7d]/40">Loading...</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <!-- ═══ ROOMS TAB ═══ -->
    <?php if ($tab === 'rooms'): ?>
    <div id="rooms-tab">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
          <h1 class="text-3xl md:text-4xl font-black text-[#023e7d] tracking-tight">Rooms</h1>
          <p class="text-sm text-[#023e7d]/60 mt-1">Manage all hotel rooms</p>
        </div>
        <button onclick="openRoomModal()" class="inline-flex items-center gap-2 rounded-2xl bg-[#1e88e5] px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-[#1565c0] cursor-pointer">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          Add Room
        </button>
      </div>

      <!-- Filters -->
      <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <select id="rooms-filter-type" onchange="loadRooms()" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20">
          <option value="">All Types</option>
          <option value="regular">Regular</option>
          <option value="deluxe">Deluxe</option>
          <option value="suite">Suite</option>
        </select>
        <input id="rooms-search" type="text" placeholder="Search rooms..." onkeyup="loadRooms()" class="flex-1 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20" />
      </div>

      <!-- Rooms Table -->
      <div class="rounded-2xl bg-white border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead class="bg-slate-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Room</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Capacity</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Price/Night</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody id="rooms-table-body" class="divide-y divide-slate-100">
              <tr><td colspan="7" class="px-6 py-8 text-center text-[#023e7d]/40">Loading...</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Room Modal -->
    <div id="room-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
      <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
          <h3 id="room-modal-title" class="text-xl font-black text-[#1e88e5]">Add Room</h3>
          <button onclick="closeRoomModal()" class="p-2 rounded-full hover:bg-slate-100 transition cursor-pointer">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>
        <form id="room-form" onsubmit="saveRoom(event)" class="p-6 space-y-4">
          <input type="hidden" id="room-id" value="">

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Room Name *</label>
              <input id="room-name" type="text" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20" placeholder="e.g. Regular Room 9" />
            </div>
            <div>
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Room Type *</label>
              <select id="room-type" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20">
                <option value="regular">Regular</option>
                <option value="deluxe">Deluxe</option>
                <option value="suite">Suite</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Short Description *</label>
            <input id="room-description" type="text" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20" placeholder="Brief description" />
          </div>

          <div>
            <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Detailed Description</label>
            <textarea id="room-detailed-description" rows="3" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20 resize-none" placeholder="Full room description"></textarea>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Capacity *</label>
              <select id="room-capacity" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20">
                <option value="1 guest">1 Guest (Single)</option>
                <option value="2 guests">2 Guests (Double)</option>
                <option value="4 guests">4 Guests (Family)</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Price per Night (₱) *</label>
              <input id="room-price" type="number" step="0.01" min="1" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20" placeholder="0.00" />
            </div>
            <div>
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Status</label>
              <select id="room-status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20">
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
                <option value="maintenance">Maintenance</option>
              </select>
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Image Filename</label>
              <input id="room-image" type="text" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20" placeholder="e.g. regular-room-one.webp" />
            </div>
            <div>
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Image Directory</label>
              <input id="room-image-dir" type="text" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20" placeholder="e.g. regular" />
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Offers / Amenities</label>
            <input id="room-offers" type="text" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20" placeholder="Comma-separated: Fast Wi-Fi,Air conditioning,TV" />
          </div>

          <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
            <button type="button" onclick="closeRoomModal()" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-[#023e7d] hover:bg-slate-50 transition cursor-pointer">Cancel</button>
            <button type="submit" class="rounded-2xl bg-[#1e88e5] px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-[#1565c0] transition cursor-pointer">Save Room</button>
          </div>
        </form>
      </div>
    </div>
    <?php endif; ?>

    <!-- ═══ RESERVATIONS TAB ═══ -->
    <?php if ($tab === 'reservations'): ?>
    <div id="reservations-tab">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
          <h1 class="text-3xl md:text-4xl font-black text-[#023e7d] tracking-tight">Reservations</h1>
          <p class="text-sm text-[#023e7d]/60 mt-1">Manage all guest reservations</p>
        </div>
        <button onclick="openReservationModal()" class="inline-flex items-center gap-2 rounded-2xl bg-[#1e88e5] px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-[#1565c0] cursor-pointer">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          Add Reservation
        </button>
      </div>

      <!-- Filters -->
      <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <select id="reservations-filter-status" onchange="loadReservations()" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20">
          <option value="">All Statuses</option>
          <option value="pending">Pending</option>
          <option value="confirmed">Confirmed</option>
          <option value="checked_in">Checked In</option>
          <option value="checked_out">Checked Out</option>
          <option value="cancelled">Cancelled</option>
        </select>
        <input id="reservations-search" type="text" placeholder="Search by name, email, or room..." onkeyup="loadReservations()" class="flex-1 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20" />
      </div>

      <!-- Reservations Table -->
      <div class="rounded-2xl bg-white border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead class="bg-slate-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Room</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Dates</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Payment</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Total</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-bold text-[#023e7d]/60 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody id="reservations-table-body" class="divide-y divide-slate-100">
              <tr><td colspan="8" class="px-6 py-8 text-center text-[#023e7d]/40">Loading...</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Reservation Modal -->
    <div id="reservation-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
      <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
          <h3 class="text-xl font-black text-[#1e88e5]">Add Reservation</h3>
          <button onclick="closeReservationModal()" class="p-2 rounded-full hover:bg-slate-100 transition cursor-pointer">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>
        <form id="reservation-form" onsubmit="saveReservation(event)" class="p-6 space-y-4">
          <div>
            <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Room *</label>
            <select id="res-room-id" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20">
              <option value="">Select a room...</option>
            </select>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Customer Name *</label>
              <input id="res-name" type="text" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20" placeholder="Juan Dela Cruz" />
            </div>
            <div>
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Email *</label>
              <input id="res-email" type="email" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20" placeholder="juan@example.com" />
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Contact Number *</label>
              <input id="res-contact" type="tel" required maxlength="11" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20" placeholder="09123456789" />
            </div>
            <div>
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Payment Type *</label>
              <select id="res-payment" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20">
                <option value="cash">Cash</option>
                <option value="cheque">Cheque (+5%)</option>
                <option value="credit">Credit Card (+10%)</option>
              </select>
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Check-in *</label>
              <input id="res-checkin" type="date" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20" />
            </div>
            <div>
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Check-out *</label>
              <input id="res-checkout" type="date" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20" />
            </div>
          </div>

          <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
            <button type="button" onclick="closeReservationModal()" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-[#023e7d] hover:bg-slate-50 transition cursor-pointer">Cancel</button>
            <button type="submit" class="rounded-2xl bg-[#1e88e5] px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-[#1565c0] transition cursor-pointer">Save Reservation</button>
          </div>
        </form>
      </div>
    </div>

    <!-- View Reservation Detail Modal -->
    <div id="reservation-detail-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
      <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
          <h3 class="text-xl font-black text-[#1e88e5]">Reservation Details</h3>
          <button onclick="closeDetailModal()" class="p-2 rounded-full hover:bg-slate-100 transition cursor-pointer">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>
        <div id="reservation-detail-content" class="p-6 space-y-4"></div>
      </div>
    </div>
    <?php endif; ?>

  </div>

  <!-- Toast notification -->
  <div id="admin-toast" class="fixed bottom-6 right-6 z-[200] hidden">
    <div class="rounded-2xl bg-[#023e7d] text-white px-6 py-4 shadow-xl text-sm font-semibold flex items-center gap-3">
      <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      <span id="admin-toast-message">Success</span>
    </div>
  </div>
</div>

<script>
const API_BASE = '<?php echo $api_base; ?>';
const ASSET_BASE = '<?php echo $asset_base; ?>';
const CURRENT_TAB = '<?php echo $tab; ?>';
</script>
<script src="<?php echo $base_path; ?>/admin/admin.js"></script>
