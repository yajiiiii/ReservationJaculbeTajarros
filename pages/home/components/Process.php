<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'] ?? '';
$base_path = "/ReservationJaculbeTajarros";
$asset_base = $host ? ($protocol . "://" . $host . $base_path) : $base_path;
?>

<div class="w-full max-w-[1800px] mx-auto px-6 md:px-12 lg:px-24">
  <div class="w-full py-14 md:py-20">
    <div class="max-w-4xl mx-auto text-center">
      <p class="inline-flex items-center gap-2 rounded-full bg-[#1e88e5]/15 px-4 py-2 text-xs font-semibold tracking-wide text-[#1e88e5] backdrop-blur">
        Reservation Process
      </p>
      <h2 id="process-heading" class="mt-5 text-3xl sm:text-4xl md:text-5xl font-black tracking-tight bg-linear-to-r from-[#1e88e5] to-[#64b5f6] bg-clip-text text-transparent">
        Our Hotel Reservation Process
      </h2>
      <p class="mt-4 text-sm sm:text-base leading-7 text-[#023e7d]">
        Simple steps to secure your perfect stay—from selecting your dates to receiving confirmation, we make booking effortless.
      </p>
    </div>

    <div class="mt-12 md:mt-16 max-w-5xl mx-auto">
      <div class="relative">
        <!-- Center Line (desktop) -->
        <div class="absolute left-1/2 top-0 bottom-0 w-0.5 -translate-x-1/2 bg-gradient-to-b from-[#1e88e5] via-[#64b5f6] to-[#1e88e5] hidden md:block"></div>

        <div class="space-y-8 md:space-y-12">
          <!-- Step 1 (left) -->
          <div class="relative grid grid-cols-1 md:grid-cols-[1fr_auto_1fr] items-start gap-4 md:gap-10">
            <div class="md:pr-6">
              <div class="rounded-2xl bg-white p-6 shadow-lg shadow-black/5 border border-slate-100 hover:shadow-xl transition-shadow">
                <h3 class="text-xl font-bold text-[#1e88e5]">Choose Your Dates & Room</h3>
                <p class="mt-2 text-sm text-[#023e7d] leading-relaxed">
                  Select your check-in and check-out dates, then browse our available rooms. Pick the perfect space that matches your needs and preferences.
                </p>
              </div>
            </div>

            <div class="flex items-start justify-center md:pt-2">
              <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#1e88e5] text-white font-bold text-lg shadow-lg shadow-[#1e88e5]/30 ring-4 ring-white">
                1
              </div>
            </div>

            <div class="hidden md:block md:pl-6"></div>
          </div>

          <!-- Step 2 (right) -->
          <div class="relative grid grid-cols-1 md:grid-cols-[1fr_auto_1fr] items-start gap-4 md:gap-10">
            <div class="hidden md:block md:pr-6"></div>

            <div class="flex items-start justify-center md:pt-2">
              <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#1e88e5] text-white font-bold text-lg shadow-lg shadow-[#1e88e5]/30 ring-4 ring-white">
                2
              </div>
            </div>

            <div class="md:pl-6">
              <div class="rounded-2xl bg-white p-6 shadow-lg shadow-black/5 border border-slate-100 hover:shadow-xl transition-shadow">
                <h3 class="text-xl font-bold text-[#1e88e5]">Fill in Your Details</h3>
                <p class="mt-2 text-sm text-[#023e7d] leading-relaxed">
                  Provide your contact information, guest details, and any special requests. We'll use this to personalize your stay experience.
                </p>
              </div>
            </div>
          </div>

          <!-- Step 3 (left) -->
          <div class="relative grid grid-cols-1 md:grid-cols-[1fr_auto_1fr] items-start gap-4 md:gap-10">
            <div class="md:pr-6">
              <div class="rounded-2xl bg-white p-6 shadow-lg shadow-black/5 border border-slate-100 hover:shadow-xl transition-shadow">
                <h3 class="text-xl font-bold text-[#1e88e5]">Review & Confirm Booking</h3>
                <p class="mt-2 text-sm text-[#023e7d] leading-relaxed">
                  Double-check your reservation details, review pricing, and confirm your booking. Secure your stay with a simple click.
                </p>
              </div>
            </div>

            <div class="flex items-start justify-center md:pt-2">
              <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#1e88e5] text-white font-bold text-lg shadow-lg shadow-[#1e88e5]/30 ring-4 ring-white">
                3
              </div>
            </div>

            <div class="hidden md:block md:pl-6"></div>
          </div>

          <!-- Step 4 (right) -->
          <div class="relative grid grid-cols-1 md:grid-cols-[1fr_auto_1fr] items-start gap-4 md:gap-10">
            <div class="hidden md:block md:pr-6"></div>

            <div class="flex items-start justify-center md:pt-2">
              <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#1e88e5] text-white font-bold text-lg shadow-lg shadow-[#1e88e5]/30 ring-4 ring-white">
                4
              </div>
            </div>

            <div class="md:pl-6">
              <div class="rounded-2xl bg-white p-6 shadow-lg shadow-black/5 border border-slate-100 hover:shadow-xl transition-shadow">
                <h3 class="text-xl font-bold text-[#1e88e5]">Receive Confirmation</h3>
                <p class="mt-2 text-sm text-[#023e7d] leading-relaxed">
                  Get instant confirmation via email with all your booking details. We'll send you reminders and everything you need for a smooth check-in.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

