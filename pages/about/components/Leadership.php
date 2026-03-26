<?php
$base_path = isset($base_path) ? $base_path : "/ReservationJaculbeTajarros";
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$asset_base = $protocol . "://" . $host . $base_path;
?>
<section class="py-24 px-6 md:px-12 relative">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-[#1e88e5] text-sm uppercase tracking-[0.3em] mb-4">The Visionaries</h2>
          <h3 class="text-3xl md:text-4xl font-bold text-[#023e7d]">Leadership</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-4xl mx-auto">
          <div class="group relative">
            <div
              class="relative h-[360px] w-full overflow-hidden rounded-xl transition-all duration-500 bg-cover bg-top md:group-hover:scale-110"
              style="background-image: linear-gradient(to top, rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('<?php echo $asset_base; ?>/assets/banner/Ijay.png');"
            >
              <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80"></div>
              <div class="absolute bottom-0 left-0 right-0 p-8 transform translate-y-4 md:group-hover:translate-y-0 transition-transform duration-300">
                <h4 class="text-xl font-bold bg-linear-to-r from-[#1e88e5] to-[#64b5f6] bg-clip-text text-transparent mb-1">Ijay Jaculbe</h4>
                <p class="text-[#90caf9] text-xs uppercase tracking-widest">Co-Founder & Product Lead</p>
              </div>
            </div>
          </div>

          <div class="group relative">
            <div
              class="relative h-[360px] w-full overflow-hidden rounded-xl transition-all duration-500 bg-cover bg-top md:group-hover:scale-110"
              style="background-image: linear-gradient(to top, rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('<?php echo $asset_base; ?>/assets/banner/Zedrick.png');"
            >
              <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80"></div>
              <div class="absolute bottom-0 left-0 right-0 p-8 transform translate-y-4 md:group-hover:translate-y-0 transition-transform duration-300">
                <h4 class="text-xl font-bold bg-linear-to-r from-[#1e88e5] to-[#64b5f6] bg-clip-text text-transparent mb-1">Zedrick Tajarros</h4>
                <p class="text-[#90caf9] text-xs uppercase tracking-widest">Co-Founder & Experience Lead</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>