<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$base_path = "/ReservationJaculbeTajarros";

if (isset($menuSection)) {

  if ($menuSection === 'desktop') {
?>
    <!-- Desktop Menu -->
    <div class="hidden lg:flex flex-1 items-center justify-center space-x-12">
      <a href="<?php echo $base_path; ?>/#popular"
        class="text-sm text-[#023e7d]/50 hover:text-[#023e7d] transition-colors font-medium px-2">
        Popular
      </a>
      <a href="<?php echo $base_path; ?>/#process"
        class="text-sm text-[#023e7d]/50 hover:text-[#023e7d] transition-colors font-medium px-2">
        Process
      </a>
      <a href="<?php echo $base_path; ?>/?page=about"
        class="text-sm text-[#023e7d]/50 hover:text-[#023e7d] transition-colors font-medium px-2">
        About Us
      </a>
      <a href="<?php echo $base_path; ?>/?page=admin"
        class="text-sm text-[#023e7d]/50 hover:text-[#023e7d] transition-colors font-medium px-2">
        Admin
      </a>
    </div>
  <?php
  }

  elseif ($menuSection === 'mobile') {
    // Determine current page for active state
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
    $isHome = $currentPage === 'home' || $currentPage === '';
  ?>
    <!-- Mobile Menu Overlay -->
    <div
      id="mobile-menu"
      class="fixed inset-0 z-[4999] md:hidden bg-black/90 backdrop-blur-2xl flex flex-col pt-32 px-8 transition-opacity duration-300 opacity-0 pointer-events-none">
      <!-- Close Button -->
      <button
        id="mobile-menu-close"
        class="absolute top-8 right-8 p-2 rounded-full hover:bg-white/10 transition-colors z-50"
        type="button"
        aria-label="Close mobile menu"
      >
        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      <div class="flex flex-col space-y-6">
        <div class="mobile-menu-item" style="opacity: 0; transform: translateY(20px);">
          <a
            href="<?php echo $base_path; ?>/"
            class="text-4xl font-bold tracking-tighter transition-colors block outline-none focus-visible:text-cyan-300 <?php echo $isHome ? 'text-cyan-400' : 'text-white hover:text-cyan-200'; ?>"
            <?php echo $isHome ? 'aria-current="page"' : ''; ?>>
            Home
          </a>
        </div>
        <div class="mobile-menu-item" style="opacity: 0; transform: translateY(20px);">
          <a
            href="<?php echo $base_path; ?>/#popular"
            class="text-4xl font-bold tracking-tighter transition-colors block outline-none focus-visible:text-cyan-300 text-white hover:text-cyan-200">
            Popular
          </a>
        </div>
        <div class="mobile-menu-item" style="opacity: 0; transform: translateY(20px);">
          <a
            href="<?php echo $base_path; ?>/#process"
            class="text-4xl font-bold tracking-tighter transition-colors block outline-none focus-visible:text-cyan-300 text-white hover:text-cyan-200">
            Process
          </a>
        </div>
        <div class="mobile-menu-item" style="opacity: 0; transform: translateY(20px);">
          <a
            href="<?php echo $base_path; ?>/?page=about"
            class="text-4xl font-bold tracking-tighter transition-colors block outline-none focus-visible:text-cyan-300 text-white hover:text-cyan-200">
            About Us
          </a>
        </div>
        <div class="mobile-menu-item" style="opacity: 0; transform: translateY(20px);">
          <a
            href="<?php echo $base_path; ?>/#contact"
            class="text-4xl font-bold tracking-tighter transition-colors block outline-none focus-visible:text-cyan-300 text-white hover:text-cyan-200">
            Contact
          </a>
        </div>
        <div class="mobile-menu-item" style="opacity: 0; transform: translateY(20px);">
          <a
            href="<?php echo $base_path; ?>/?page=admin"
            class="text-4xl font-bold tracking-tighter transition-colors block outline-none focus-visible:text-cyan-300 text-white hover:text-cyan-200">
            Admin
          </a>
        </div>
      </div>
      <div class="mt-auto pb-12 mobile-menu-footer" style="opacity: 0;">
        <p class="text-neutral-500 text-sm mb-2">Get in touch</p>
        <a href="mailto:hello@pahinga.com" class="text-white text-lg block mb-6" aria-label="Send email to hello@pahinga.com">hello@pahinga.com</a>
        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-neutral-500 font-medium">
          <a class="hover:text-white transition-colors" href="<?php echo $base_path; ?>/privacy">Privacy Policy</a>
          <span class="opacity-30">|</span>
          <a class="hover:text-white transition-colors" href="<?php echo $base_path; ?>/terms">Terms of Service</a>
          <span class="opacity-30">|</span>
          <a class="hover:text-white transition-colors" href="<?php echo $base_path; ?>/cookies">Cookie Policy</a>
        </div>
      </div>
    </div>
<?php
  }
}
?>