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
    </div>
  <?php
  }

  elseif ($menuSection === 'mobile') {
  ?>
    <!-- Mobile Menu Overlay -->
    <div
      id="mobile-menu"
      class="fixed inset-0 z-[4999] lg:hidden bg-[var(--tertiary-color)]/90 backdrop-blur-2xl flex flex-col pt-32 px-8 transition-opacity duration-300 opacity-0 pointer-events-none">
      <div class="flex flex-col space-y-6">
        <div>
          <a
            href="<?php echo $base_path; ?>/#popular"
            class="text-4xl font-bold tracking-tighter transition-colors block outline-none text-[#023e7d]/50 hover:text-[#023e7d] mobile-menu-link">
            Popular
          </a>
        </div>
        <div>
          <a
            href="<?php echo $base_path; ?>/#process"
            class="text-4xl font-bold tracking-tighter transition-colors block outline-none text-[#023e7d]/50 hover:text-[#023e7d] mobile-menu-link">
            Process
          </a>
        </div>
        <div>
          <a
            href="<?php echo $base_path; ?>/?page=about"
            class="text-4xl font-bold tracking-tighter transition-colors block outline-none text-[#023e7d]/50 hover:text-[#023e7d] mobile-menu-link">
            About Us
          </a>
        </div>
      </div>
    </div>
<?php
  }
}
?>