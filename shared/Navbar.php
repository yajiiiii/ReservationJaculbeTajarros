<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$base_url = $protocol . "://" . $host . "/ReservationJaculbeTajarros/";
$base_path = "/ReservationJaculbeTajarros";
?>

<nav 
  id="main-navbar"
  class="fixed top-4 left-1/2 -translate-x-1/2 w-[95%] bg-white backdrop-blur-md rounded-full shadow-md z-50 transition-all duration-300 translate-y-0 opacity-100"
>
  <div class="py-4 px-6">
    <div class="flex items-center justify-between gap-4">
      <!-- Logo -->
      <div class="flex-shrink-0">
        <a href="<?php echo $base_path; ?>/" class="uppercase text-lg font-black bg-linear-to-r from-[#1e88e5] to-[#64b5f6] bg-clip-text text-transparent">
          Pahinga
        </a>
      </div>

      <?php 
      $menuSection = 'desktop';
      include __DIR__ . '/Menu.php'; 
      ?>

      <div class="flex items-center gap-3 flex-shrink-0">
        <a
          href="<?php echo $base_path; ?>/#contact"
          class="hidden lg:inline-flex items-center rounded-full bg-[#1e88e5] px-6 py-2.5 text-sm font-semibold text-white shadow-md transition hover:bg-[#1565c0]"
        >
          Facebook Page
        </a>

        <!-- Mobile Menu Button -->
        <button
          id="mobile-menu-button"
          class="lg:hidden p-2 rounded-full hover:bg-gray-800 transition-colors"
          type="button"
          aria-label="Toggle mobile menu"
          aria-expanded="false"
        >
          <svg id="menu-icon" class="w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg id="close-icon" class="w-5 h-5 text-gray-300 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</nav>

<?php 
$menuSection = 'mobile';
include __DIR__ . '/Menu.php'; 
?>
<div class="h-12 md:hidden"></div>