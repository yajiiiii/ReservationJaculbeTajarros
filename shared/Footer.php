<?php
// Footer component
?>
<footer role="contentinfo" class="relative w-full text-white overflow-hidden pt-0 bg-[#1e88e5]">
  <div class="relative z-10 border-t border-white/10">
    <div class="max-w-[1800px] mx-auto px-6 md:px-12 lg:px-24 py-12 md:py-20">
      <div class="grid grid-cols-2 gap-8 md:gap-12 md:grid-cols-2 lg:grid-cols-3">
        <!-- Brand & Contact -->
        <div class="col-span-2 md:col-span-1">
          <div class="mb-6">
            <!-- Replace with your Pahinga logo if available -->
            <a href="<?php echo $base_path; ?>/" class="uppercase text-2xl font-black text-white">
              Pahinga
            </a>
          </div>
          <p class="text-[#bbdefb] leading-relaxed mb-8">
            Excellence in Every Moment of Rest.
          </p>

          <div class="space-y-4">
            <a
              href="mailto:ivauzchsolutions@gmail.com"
              class="flex items-center gap-3 text-[#bbdefb]/50 hover:text-[#bbdefb] transition-colors"
              aria-label="Send email to ivauzchsolutions@gmail.com">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-4 h-4" aria-hidden="true">
                <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"></path>
                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
              </svg>
              ivauzchsolutions@gmail.com
            </a>

            <a
              href="tel:+639455702579"
              class="flex items-center gap-3 text-[#bbdefb]/50 hover:text-[#bbdefb] transition-colors"
              aria-label="Call us at +63 9455702579">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4" aria-hidden="true">
                <path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"></path>
              </svg>
              +63 9455702579
            </a>

            <div class="flex items-center gap-3 text-[#bbdefb]">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-4 h-4" aria-hidden="true">
                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
              <span>Pasig City, Philippines</span>
            </div>
          </div>
        </div>

        <!-- Navigate -->
        <div class="hidden md:block">
          <h4 class="font-bold mb-6 text-white">Navigate</h4>
          <ul class="space-y-4">
            <li>
              <a class="group flex items-center gap-2 text-[#bbdefb]/50 hover:text-[#bbdefb] transition-colors" href="#work">
                Popular
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" aria-hidden="true">
                  <path d="M7 7h10v10"></path>
                  <path d="M7 17 17 7"></path>
                </svg>
              </a>
            </li>
            <li>
              <a class="group flex items-center gap-2 text-[#bbdefb]/50 hover:text-[#bbdefb] transition-colors" href="#work">
                Process
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" aria-hidden="true">
                  <path d="M7 7h10v10"></path>
                  <path d="M7 17 17 7"></path>
                </svg>
              </a>
            </li>
            <li>
              <a class="group flex items-center gap-2 text-[#bbdefb]/50 hover:text-[#bbdefb] transition-colors" href="#process">
                About Us
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right w-3 h-3 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" aria-hidden="true">
                  <path d="M7 7h10v10"></path>
                  <path d="M7 17 17 7"></path>
                </svg>
              </a>
            </li>
          </ul>
        </div>

        <!-- Newsletter-->
        <div class="col-span-2 md:col-span-1">
          <h4 class="font-bold mb-6 text-white">Stay Updated</h4>
          <p class="text-[#bbdefb] mb-6 text-sm leading-relaxed">
            Stay informed. Subscribe to receive updates concerning special promotions, discounts, and upcoming news.
          </p>
          <form class="flex flex-col gap-3">
            <input
              type="text"
              style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0"
              tabindex="-1"
              autocomplete="off"
              aria-hidden="true"
              name="website"
              value="">
            <input
              type="email"
              placeholder="your@email.com"
              aria-label="Email address for newsletter subscription"
              class="bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder:text-[#bbdefb] focus:outline-none focus:border-white/40 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
            <button
              type="submit"
              class="cursor-pointer bg-white text-[#023e7d] px-6 py-3 rounded-xl font-bold hover:bg-neutral-200 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
              aria-label="Subscribe to newsletter">
              Subscribe
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="relative z-10 border-t border-white/10">
    <div class="max-w-[1800px] mx-auto px-6 md:px-12 lg:px-24 py-8">
      <div class="flex flex-col md:flex-row justify-between items-center gap-6">
        <p class="text-sm text-[#bbdefb]">© 2025 Pahinga. All rights reserved.</p>
        <div class="flex items-center gap-6">
          <span class="text-sm bg-gradient-to-l from-[#e3f2fd] to-[#bbdefb] bg-clip-text text-transparent uppercase font-bold">Born from rest</span>
        </div>
      </div>
    </div>
  </div>

  <div class="absolute bottom-0 left-0 w-full overflow-hidden pointer-events-none z-0">
    <h1 class="text-[20vw] font-bold leading-none bg-gradient-to-l from-[#e3f2fd] to-[#bbdefb] bg-clip-text text-transparent opacity-10 whitespace-nowrap translate-y-1/3">
      PAHINGA
    </h1>
  </div>
</footer>