<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'] ?? '';
$base_path = "/ReservationJaculbeTajarros";
$asset_base = $host ? ($protocol . "://" . $host . $base_path) : $base_path;
?>

<div class="w-full max-w-[1800px] mx-auto px-6 md:px-12 lg:px-24 skew-y-3">
  <div class="w-full py-14 md:py-20">
    <div class="max-w-4xl mx-auto text-center">
      <p class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-2 text-xs font-semibold tracking-wide text-white backdrop-blur">
        Popular rooms
      </p>
      <h2 id="popular-heading" class="mt-5 text-3xl sm:text-4xl md:text-5xl font-black tracking-tight text-white">
        Your next favorite stay starts here.
      </h2>
      <p class="mt-4 text-sm sm:text-base leading-7 text-white/85">
        Explore our most-booked rooms—designed for comfort, curated for style, and ready for your next getaway.
      </p>
    </div>

    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
      <article class="group rounded-3xl bg-white shadow-xl shadow-black/15 overflow-hidden transition-transform duration-300 hover:-translate-y-[3px] hover:shadow-2xl hover:shadow-black/20">
        <div class="relative aspect-[16/11] overflow-hidden rounded-tl-3xl rounded-tr-3xl">
          <img
            src="<?php echo $asset_base; ?>/assets/popular/Celestial.webp"
            alt="Celestial Suite room preview"
            class="h-full w-full rounded-tl-3xl rounded-tr-3xl object-cover transition duration-500"
            loading="lazy"
          />
          <div class="absolute inset-0 rounded-tl-3xl rounded-tr-3xl bg-linear-to-t from-black/45 via-black/0 to-black/0"></div>
          <div class="absolute left-5 top-5 inline-flex items-center rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-[#1e88e5]">
            Best Seller
          </div>
        </div>
        <div class="p-6">
          <div class="flex items-start justify-between gap-4">
            <div>
              <h3 class="text-lg font-bold text-[#1e88e5]">Celestial Suite</h3>
              <p class="mt-1 text-sm text-[#023e7d]">A premium suite with a calm, airy vibe.</p>
            </div>
            <p class="text-sm font-bold text-[#1e88e5]">
              ₱3,499<span class="text-xs font-semibold text-[#023e7d]/50">/night</span>
            </p>
          </div>
          <ul class="mt-5 grid grid-cols-2 gap-x-4 gap-y-2 text-sm text-[#023e7d]">
            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>2 guests</li>
            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>Queen bed</li>
            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>Fast Wi‑Fi</li>
            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>Breakfast</li>
          </ul>
          <a href="<?php echo $base_path; ?>/#contact" class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-[#1e88e5] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1565c0]">
            Book this room
          </a>
        </div>
      </article>

      <article class="group rounded-3xl bg-white shadow-xl shadow-black/15 ring-1 ring-black/5 overflow-hidden transition-transform duration-300 hover:-translate-y-[3px] hover:shadow-2xl hover:shadow-black/20">
        <div class="relative aspect-[16/11] overflow-hidden rounded-tl-3xl rounded-tr-3xl">
          <img
            src="<?php echo $asset_base; ?>/assets/popular/Horizon.webp"
            alt="Horizon Deluxe room preview"
            class="h-full w-full rounded-tl-3xl rounded-tr-3xl object-cover"
            loading="lazy"
          />
          <div class="absolute inset-0 rounded-3xl bg-linear-to-t from-black/45 via-black/0 to-black/0"></div>
          <div class="absolute left-5 top-5 inline-flex items-center rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-[#1e88e5]">
            Great Value
          </div>
        </div>
        <div class="p-6">
          <div class="flex items-start justify-between gap-4">
            <div>
              <h3 class="text-lg font-bold text-[#1e88e5]">Horizon Deluxe</h3>
              <p class="mt-1 text-sm text-[#023e7d]">Spacious comfort with modern amenities.</p>
            </div>
            <p class="text-sm font-bold text-[#1e88e5]">
              ₱2,499<span class="text-xs font-semibold text-[#023e7d]/50">/night</span>
            </p>
          </div>
          <ul class="mt-5 grid grid-cols-2 gap-x-4 gap-y-2 text-sm text-[#023e7d]">
            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>3 guests</li>
            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>2 beds</li>
            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>Aircon</li>
            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>Hot shower</li>
          </ul>
          <a href="<?php echo $base_path; ?>/#contact" class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-[#1e88e5] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1565c0]">
            Book this room
          </a>
        </div>
      </article>

      <article class="group rounded-3xl bg-white shadow-xl shadow-black/15 ring-1 ring-black/5 overflow-hidden transition-transform duration-300 hover:-translate-y-[3px] hover:shadow-2xl hover:shadow-black/20">
        <div class="relative aspect-[16/11] overflow-hidden rounded-tl-3xl rounded-tr-3xl">
          <img
            src="<?php echo $asset_base; ?>/assets/popular/Majestic.webp"
            alt="Majestic Family room preview"
            class="h-full w-full rounded-tl-3xl rounded-tr-3xl object-cover"
            loading="lazy"
          />
          <div class="absolute inset-0 rounded-3xl bg-linear-to-t from-black/45 via-black/0 to-black/0"></div>
          <div class="absolute left-5 top-5 inline-flex items-center rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-[#1e88e5]">
            Family Pick
          </div>
        </div>
        <div class="p-6">
          <div class="flex items-start justify-between gap-4">
            <div>
              <h3 class="text-lg font-bold text-[#1e88e5]">Majestic Family</h3>
              <p class="mt-1 text-sm text-[#023e7d]">Perfect for groups who want extra space.</p>
            </div>
            <p class="text-sm font-bold text-[#1e88e5]">
              ₱3,099<span class="text-xs font-semibold text-[#023e7d]/50">/night</span>
            </p>
          </div>
          <ul class="mt-5 grid grid-cols-2 gap-x-4 gap-y-2 text-sm text-[#023e7d]">
            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>5 guests</li>
            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>3 beds</li>
            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>Kitchenette</li>
            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>Smart TV</li>
          </ul>
          <a href="<?php echo $base_path; ?>/#contact" class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-[#1e88e5] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1565c0]">
            Book this room
          </a>
        </div>
      </article>
    </div>
  </div>
</div>
