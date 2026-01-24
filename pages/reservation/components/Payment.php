<?php
require_once __DIR__ . '/../../../constant/constant.php';

// Expected vars from Reservation.php
$room = isset($reservation_room) ? $reservation_room : null;
$roomName = isset($reservation_room_name) ? $reservation_room_name : '—';
$roomType = isset($reservation_type) ? $reservation_type : 'regular';
$capacityType = isset($reservation_capacity_type) ? $reservation_capacity_type : 'single';
$checkIn = isset($reservation_check_in) ? $reservation_check_in : '';
$checkOut = isset($reservation_check_out) ? $reservation_check_out : '';
$nights = isset($reservation_nights) ? (int)$reservation_nights : 0;

// Calculate for default payment (cash) using PHP
$calculations = calculateTotal($nights, $roomType, $capacityType, 'cash');
$baseSubtotal = $calculations[0];
$defaultDiscount = $calculations[1];
$defaultCharge = $calculations[2];
$defaultTotal = $calculations[3];

$base_path = isset($base_path) ? $base_path : "/ReservationJaculbeTajarros";
?>

<div
  class="rounded-3xl bg-white shadow-xl shadow-black/10 border border-slate-100 overflow-hidden sticky top-24"
  data-room-type="<?php echo htmlspecialchars($roomType); ?>"
  data-capacity-type="<?php echo htmlspecialchars($capacityType); ?>"
  data-nights="<?php echo htmlspecialchars((string)$nights); ?>"
  data-base-path="<?php echo htmlspecialchars($base_path); ?>"
>
  <div class="p-6 border-b border-slate-100">
    <h3 class="text-lg font-black text-[#1e88e5]">Billing statement</h3>
    <p class="text-sm text-[#023e7d] mt-1">Fill in customer details and select a payment type.</p>
  </div>

  <div class="p-6 space-y-6">
    <!-- Customer -->
    <div>
      <h4 class="text-sm font-black text-[#1e88e5]">Customer</h4>
      <div class="mt-3 space-y-3">
        <div>
          <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Customer name</label>
          <input
            id="cust_name"
            type="text"
            placeholder="Juan Dela Cruz"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
          />
          <p class="text-xs text-slate-400 mt-1">Letters and spaces only</p>
        </div>
        <div>
          <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Email</label>
          <input
            id="cust_email"
            type="email"
            placeholder="juan.delacruz@example.com"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
          />
        </div>
        <div>
          <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Contact number</label>
          <input
            id="cust_contact"
            type="tel"
            placeholder="09123456789"
            maxlength="11"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
          />
          <p class="text-xs text-slate-400 mt-1">11 digits only</p>
        </div>
      </div>
    </div>

    <!-- Payment type -->
    <div>
      <h4 class="text-sm font-black text-[#1e88e5]">Payment type</h4>
      <div class="mt-3">
        <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Select payment</label>
        <select
          id="payment_type"
          class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
        >
          <option value="cash" selected>Cash (no additional charge)</option>
          <option value="cheque">Cheque (+5%)</option>
          <option value="credit">Credit Card (+10%)</option>
        </select>
      </div>

      <!-- Credit card fields -->
      <div id="credit_fields" class="mt-4 hidden">
        <div class="grid grid-cols-1 gap-3">
          <div>
            <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Card number</label>
            <input
              id="card_number"
              inputmode="numeric"
              placeholder="1234 5678 9012 3456"
              class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
            />
          </div>
          <div class="grid grid-cols-3 gap-3">
            <div class="col-span-1">
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Exp.</label>
              <input
                id="card_exp"
                placeholder="MM/YY"
                maxlength="5"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
              />
              <p class="text-xs text-slate-400 mt-1">Numbers and / only</p>
            </div>
            <div class="col-span-1">
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">CVC</label>
              <input
                id="card_cvc"
                inputmode="numeric"
                placeholder="123"
                maxlength="4"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
              />
              <p class="text-xs text-slate-400 mt-1">Numbers only</p>
            </div>
            <div class="col-span-1">
              <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">ZIP</label>
              <input
                id="card_zip"
                inputmode="numeric"
                placeholder="1000"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
              />
            </div>
          </div>
        </div>
      </div>

      <!-- Cheque fields -->
      <div id="cheque_fields" class="mt-4 hidden">
        <label class="block text-xs font-semibold text-[#023e7d] uppercase mb-2">Cheque number</label>
        <input
          id="cheque_number"
          inputmode="numeric"
          placeholder="000000"
          class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-[#023e7d] outline-none focus:border-[#1e88e5] focus:ring-2 focus:ring-[#1e88e5]/20"
        />
        <p class="text-xs text-slate-400 mt-1">Numbers only</p>
      </div>
    </div>

    <p class="text-xs text-[#023e7d] leading-relaxed">
      Click <span class="font-semibold text-[#023e7d]">Next</span> to preview your booking/reservation summary.
      Rules: Cheque +5%, Credit Card +10%. Cash has discount: 10% for 3–5 nights, 15% for 6+ nights.
    </p>

    <!-- Hidden computed values (populated by PHP, updated by JS via PHP API) -->
    <div class="hidden" aria-hidden="true">
      <span id="sum_nights"><?php echo $nights ? htmlspecialchars((string)$nights) : '—'; ?></span>
      <span id="sum_customer">—</span>
      <span id="sum_email">—</span>
      <span id="sum_contact">—</span>
      <span id="sum_payment">Cash</span>
      <span id="sum_base"><?php echo number_format($baseSubtotal, 0); ?></span>
      <span id="sum_discount"><?php echo number_format($defaultDiscount, 0); ?></span>
      <span id="sum_charge"><?php echo number_format($defaultCharge, 0); ?></span>
      <span id="sum_total"><?php echo number_format($defaultTotal, 0); ?></span>
    </div>

    <button
      id="open_reservation_summary"
      type="button"
      disabled
      class="w-full inline-flex items-center justify-center rounded-2xl bg-slate-300 px-5 py-3 text-sm font-semibold text-white transition cursor-not-allowed hover:bg-slate-300"
    >
      Next
    </button>
  </div>
</div>

<script src="<?php echo $base_path; ?>/utils/interactive.js"></script>
