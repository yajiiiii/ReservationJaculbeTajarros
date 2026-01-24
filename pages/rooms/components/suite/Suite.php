<?php
$checkIn = isset($_GET['check_in']) ? $_GET['check_in'] : '';
$checkOut = isset($_GET['check_out']) ? $_GET['check_out'] : '';

// Include room constants
require_once __DIR__ . '/../../../../constant/constant.php';

// Get all suite room images with room details
$rooms = $SUITE_ROOMS;

$basePath = isset($base_path) ? $base_path : '/ReservationJaculbeTajarros';
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'] ?? '';
$asset_base = $host ? ($protocol . "://" . $host . $basePath) : $basePath;
?>

<div class="w-full max-w-[1800px] mx-auto">
  <div class="mb-12 text-center">
    <h1 class="text-4xl sm:text-5xl md:text-6xl font-black bg-linear-to-r from-[#1e88e5] to-[#64b5f6] bg-clip-text text-transparent tracking-tighter mb-4">
      Suite Rooms
    </h1>
    <p class="text-lg text-[#023e7d] max-w-2xl mx-auto">
      Indulge in the ultimate luxury experience with our premium suite rooms, featuring spacious accommodations and premium amenities.
    </p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
    <?php foreach ($rooms as $index => $room): ?>
    <article class="group rounded-3xl bg-white shadow-xl shadow-black/15 overflow-hidden transition-transform duration-300 hover:-translate-y-[3px] hover:shadow-2xl hover:shadow-black/20">
      <div class="relative aspect-[16/11] overflow-hidden rounded-tl-3xl rounded-tr-3xl">
        <img
          src="<?php echo $asset_base; ?>/assets/suite/<?php echo $room['image']; ?>"
          alt="<?php echo htmlspecialchars($room['name']); ?>"
          class="h-full w-full rounded-tl-3xl rounded-tr-3xl object-cover transition duration-500 group-hover:scale-110"
          loading="lazy"
        />
        <div class="absolute inset-0 rounded-tl-3xl rounded-tr-3xl bg-linear-to-t from-black/45 via-black/0 to-black/0"></div>
        <?php if ($index === 0): ?>
        <div class="absolute left-5 top-5 inline-flex items-center rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-slate-900">
          Premium
        </div>
        <?php elseif ($index === 4): ?>
        <div class="absolute left-5 top-5 inline-flex items-center rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-slate-900">
          Family Pick
        </div>
        <?php endif; ?>
      </div>
      <div class="p-6">
        <div class="flex items-start justify-between gap-4">
          <div>
            <h3 class="text-lg font-bold text-slate-900"><?php echo htmlspecialchars($room['name']); ?></h3>
            <p class="mt-1 text-sm text-slate-500"><?php echo htmlspecialchars($room['description']); ?></p>
          </div>
          <p class="text-sm font-bold text-slate-900 whitespace-nowrap">
            ₱<?php echo number_format($room['price'], 0); ?><span class="text-xs font-semibold text-slate-500">/night</span>
          </p>
        </div>
        <ul class="mt-5 grid grid-cols-2 gap-x-4 gap-y-2 text-sm text-slate-600">
          <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span><?php echo $room['capacity']; ?></li>
          <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>King bed</li>
          <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>Fast Wi‑Fi</li>
          <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-[#1e88e5]"></span>Premium TV</li>
        </ul>
        <a 
          href="<?php echo $basePath; ?>/?page=reservation&type=suite&room=<?php echo urlencode($room['name']); ?><?php echo $checkIn ? '&check_in=' . urlencode($checkIn) . '&check_out=' . urlencode($checkOut) : ''; ?>" 
          class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-[#1e88e5] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1565c0]"
        >
          Book this room
        </a>
      </div>
    </article>
    <?php endforeach; ?>
  </div>
</div>
