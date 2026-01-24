<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$base_url = $protocol . "://" . $host . "/ReservationJaculbeTajarros/";
$base_path = "/ReservationJaculbeTajarros";
?>

<nav 
  id="main-navbar"
  class="fixed top-4 left-1/2 -translate-x-1/2 w-[95%] bg-white backdrop-blur-md rounded-full shadow-md z-50 transition-all duration-300 translate-y-0 opacity-100 navbar-visible"
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
          class="md:hidden p-2 rounded-full hover:bg-gray-100 transition-colors"
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
  </div>
</nav>

<?php 
$menuSection = 'mobile';
include __DIR__ . '/Menu.php'; 
?>
<div class="h-12 md:hidden"></div>

<script>
(function() {
  const navbar = document.getElementById('main-navbar');
  let lastScrollY = 0;
  let isVisible = true;

  const handleScroll = () => {
    const currentScrollY = window.scrollY;
    
    if (currentScrollY > lastScrollY && currentScrollY > 50) {
      // Scrolling down - hide navbar
      if (isVisible) {
        navbar.classList.remove('translate-y-0', 'opacity-100', 'navbar-visible');
        navbar.classList.add('-translate-y-24', 'opacity-0', 'navbar-hidden');
        isVisible = false;
      }
    } else {
      // Scrolling up - show navbar
      if (!isVisible) {
        navbar.classList.remove('-translate-y-24', 'opacity-0', 'navbar-hidden');
        navbar.classList.add('translate-y-0', 'opacity-100', 'navbar-visible');
        isVisible = true;
      }
    }
    
    lastScrollY = currentScrollY;
  };

  window.addEventListener('scroll', handleScroll, { passive: true });

  // Function to close mobile menu
  const closeMobileMenu = () => {
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');
    const menuItems = document.querySelectorAll('.mobile-menu-item');
    const menuFooter = document.querySelector('.mobile-menu-footer');
    
    if (mobileMenu) {
      mobileMenu.classList.add('opacity-0', 'pointer-events-none');
      mobileMenu.classList.remove('opacity-100');
      if (menuIcon) menuIcon.classList.remove('hidden');
      if (closeIcon) closeIcon.classList.add('hidden');
      document.body.style.overflow = '';
      
      // Reset menu items
      menuItems.forEach((item) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
      });
      
      if (menuFooter) {
        menuFooter.style.opacity = '0';
      }
    }
  };

  // Function to open mobile menu
  const openMobileMenu = () => {
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');
    const menuItems = document.querySelectorAll('.mobile-menu-item');
    const menuFooter = document.querySelector('.mobile-menu-footer');
    
    if (mobileMenu) {
      mobileMenu.classList.remove('opacity-0', 'pointer-events-none');
      mobileMenu.classList.add('opacity-100');
      if (menuIcon) menuIcon.classList.add('hidden');
      if (closeIcon) closeIcon.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
      
      // Animate menu items
      menuItems.forEach((item, index) => {
        setTimeout(() => {
          item.style.opacity = '1';
          item.style.transform = 'none';
          item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        }, index * 50);
      });
      
      // Animate footer
      if (menuFooter) {
        setTimeout(() => {
          menuFooter.style.opacity = '1';
          menuFooter.style.transition = 'opacity 0.3s ease';
        }, menuItems.length * 50);
      }
    }
  };

  // Mobile menu toggle
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileMenuClose = document.getElementById('mobile-menu-close');

  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', function() {
      const isHidden = mobileMenu.classList.contains('opacity-0') || mobileMenu.classList.contains('pointer-events-none');
      
      if (isHidden) {
        openMobileMenu();
      } else {
        closeMobileMenu();
      }
    });
  }

  // Close button inside menu
  if (mobileMenuClose) {
    mobileMenuClose.addEventListener('click', closeMobileMenu);
  }

  // Close menu when clicking on a link
  if (mobileMenu) {
    const menuLinks = mobileMenu.querySelectorAll('a');
    menuLinks.forEach(link => {
      link.addEventListener('click', closeMobileMenu);
    });
  }
})();
</script>