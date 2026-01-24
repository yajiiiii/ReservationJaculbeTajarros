<?php
$roomName = isset($reservation_room_name) ? $reservation_room_name : '—';
$checkIn = isset($reservation_check_in) ? $reservation_check_in : '';
$checkOut = isset($reservation_check_out) ? $reservation_check_out : '';
$nights = isset($reservation_nights) ? (int)$reservation_nights : 0;
$dateReserved = date('Y-m-d');
?>

<div id="reservation_summary_modal" class="hidden fixed inset-0 z-[6000]" role="dialog" aria-modal="true">
  <div id="reservation_summary_backdrop" class="absolute inset-0 bg-black/55 backdrop-blur-sm"></div>
  <div class="relative min-h-screen w-full flex items-center justify-center p-4">
    <div class="w-full max-w-md rounded-2xl bg-white shadow-2xl overflow-hidden">
      <div class="p-4 border-b border-slate-100 flex items-center justify-between">
        <h3 class="text-lg font-black text-slate-900">Reservation Summary</h3>
        <button id="reservation_summary_close" type="button" class="h-8 w-8 rounded-lg border border-slate-200 hover:bg-slate-50 transition">✕</button>
      </div>

      <div class="p-4 space-y-3">
        <!-- First row: Customer (1 column) -->
        <div class="rounded-xl border border-slate-200 bg-white p-3">
          <h4 class="text-xs font-black text-slate-900 mb-2">Customer</h4>
          <div class="text-xs space-y-1">
            <div class="flex justify-between"><span class="text-slate-500">Name:</span> <span class="font-semibold text-slate-900" id="modal_customer">—</span></div>
            <div class="flex justify-between"><span class="text-slate-500">Email:</span> <span class="font-semibold text-slate-900" id="modal_email">—</span></div>
            <div class="flex justify-between"><span class="text-slate-500">Contact:</span> <span class="font-semibold text-slate-900" id="modal_contact">—</span></div>
          </div>
        </div>

        <!-- Second row: Reservation (1 column) -->
        <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
          <h4 class="text-xs font-black text-slate-900 mb-2">Reservation</h4>
          <div class="text-xs space-y-1">
            <div class="flex justify-between"><span class="text-slate-500">Room:</span> <span class="font-semibold text-slate-900" id="modal_room"><?php echo htmlspecialchars($roomName); ?></span></div>
            <div class="flex justify-between"><span class="text-slate-500">Date reserved:</span> <span class="font-semibold text-slate-900" id="modal_date_reserved"><?php echo htmlspecialchars($dateReserved); ?></span></div>
            <div class="flex justify-between"><span class="text-slate-500">Check in:</span> <span class="font-semibold text-slate-900" id="modal_check_in"><?php echo $checkIn ? htmlspecialchars($checkIn) : '—'; ?></span></div>
            <div class="flex justify-between"><span class="text-slate-500">Check out:</span> <span class="font-semibold text-slate-900" id="modal_check_out"><?php echo $checkOut ? htmlspecialchars($checkOut) : '—'; ?></span></div>
            <div class="flex justify-between"><span class="text-slate-500">Nights:</span> <span class="font-semibold text-slate-900" id="modal_nights"><?php echo $nights ? htmlspecialchars((string)$nights) : '—'; ?></span></div>
          </div>
        </div>

        <!-- Third row: Billing (1 column) -->
        <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
          <h4 class="text-xs font-black text-slate-900 mb-2">Billing</h4>
          <div class="text-xs space-y-1">
            <div class="flex justify-between"><span class="text-slate-500">Base:</span> <span class="font-semibold text-slate-900">₱<span id="modal_base">0</span></span></div>
            <div class="flex justify-between"><span class="text-slate-500">Cash discount:</span> <span class="font-semibold text-slate-900">- ₱<span id="modal_discount">0</span></span></div>
            <div class="flex justify-between"><span class="text-slate-500">Additional charge:</span> <span class="font-semibold text-slate-900">+ ₱<span id="modal_charge">0</span></span></div>
            <div class="h-px bg-slate-200 my-1"></div>
            <div class="flex justify-between"><span class="text-slate-900 font-black">Total:</span> <span class="font-black text-slate-900">₱<span id="modal_total">0</span></span></div>
          </div>
        </div>
      </div>

      <div class="p-4 border-t border-slate-100 flex gap-2 justify-end">
        <button id="reservation_summary_back" type="button" class="px-4 py-2 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-900 hover:bg-slate-50 transition">Back</button>
        <button id="reservation_summary_confirm" type="button" class="px-4 py-2 rounded-xl bg-[#1e88e5] text-sm font-semibold text-white hover:bg-[#1565c0] transition">Confirm</button>
      </div>
    </div>
  </div>
</div>
