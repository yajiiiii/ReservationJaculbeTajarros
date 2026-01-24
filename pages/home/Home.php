<section class="bg-[#f8f8f8] bg-[radial-gradient(#bbdefb_1px,transparent_1px)] [background-size:16px_16px] text-white">
  <main class="flex min-h-screen flex-col items-center justify-center">
    <section class="py-12 min-h-[50rem] md:h-screen w-full flex md:items-center md:justify-center bg-transparent relative overflow-hidden pb-8 md:pb-0">
      <?php include __DIR__ . '/../../shared/Navbar.php'; ?>
      <div class="p-4 w-full max-w-[1800px] mx-auto relative z-10 pt-20 md:pt-0 px-4 md:px-6 lg:px-12 xl:px-24">
        <?php include __DIR__ . '/components/Hero.php'; ?>
      </div>
    </section>
    <section
      id="popular"
      aria-labelledby="popular-heading"
      class="w-full min-h-screen flex items-center bg-[#1e88e5] text-black -skew-y-3 my-20 overflow-hidden perspective-1000">
      <?php include __DIR__ . '/components/Popular.php'; ?>
    </section>
    <section class="min-h-screen w-full flex md:items-center md:justify-center bg-transparent relative overflow-hidden pb-8 md:pb-0">
      <?php include __DIR__ . '/components/Process.php'; ?>
    </section>
    <section class="w-full flex md:items-center md:justify-center bg-transparent relative overflow-hidden pb-8 md:pb-0">
      <?php include __DIR__ . '/../../shared/Footer.php'; ?>
    </section>
  </main>
</section>