<nav class="fixed w-full z-40 top-0 transition-all duration-300 glass border-b border-gray-200/30 dark:border-gray-800/50" role="navigation" aria-label="Main navigation">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16 sm:h-20">
      <!-- Logo -->
      <a href="/" class="group flex items-center gap-2 text-xl sm:text-2xl font-extrabold tracking-tight gradient-text transition-transform hover:scale-105" aria-label="Home">
        <span class="text-2xl sm:text-3xl animate-float">⚡</span>
        <span class="bg-clip-text text-transparent bg-gradient-to-r from-brand-500 via-purple-500 to-pink-500 group-hover:from-brand-400 group-hover:via-purple-400 group-hover:to-pink-400">EnigmaticAura</span>
      </a>
      
      <!-- Desktop Navigation -->
      <div class="hidden md:flex items-center space-x-1 lg:space-x-2">
        <a href="#about" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-300">About</a>
        <a href="#skills" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-300">Skills</a>
        <a href="#projects" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-300">Projects</a>
        <a href="#contact" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all duration-300">Contact</a>
      </div>
      
      <!-- Right Side Actions -->
      <div class="flex items-center gap-2 sm:gap-3">
        <!-- Theme Toggle -->
        <button id="theme-toggle" data-theme-toggle class="relative p-2.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-300 hover:rotate-12 hover:scale-110" aria-label="Toggle theme" title="Toggle light/dark mode">
          <span class="block dark:hidden transition-transform" aria-hidden="true">🌙</span>
          <span class="hidden dark:block transition-transform" aria-hidden="true">☀️</span>
        </button>
        
        <!-- CTA Button (Desktop) -->
        <a href="#contact" class="hidden sm:inline-flex px-4 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-purple-600 hover:from-brand-500 hover:to-purple-500 text-white text-sm font-semibold shadow-lg shadow-brand-500/25 hover:shadow-brand-500/40 transition-all duration-300 hover:scale-105">
          Let's Talk
        </a>
        
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="md:hidden p-2.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-all" aria-label="Toggle mobile menu" aria-expanded="false" aria-controls="mobile-menu">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
    </div>
  </div>
  
  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 right-0 glass border-t border-gray-200/30 dark:border-gray-800/50 backdrop-blur-xl" role="menu">
    <div class="px-4 py-6 space-y-2">
      <a href="#about" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all">About</a>
      <a href="#skills" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all">Skills</a>
      <a href="#projects" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all">Projects</a>
      <a href="#contact" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all">Contact</a>
      <a href="#contact" class="block mt-4 px-4 py-3 rounded-xl text-center font-semibold bg-gradient-to-r from-brand-600 to-purple-600 text-white shadow-lg">Let's Talk</a>
    </div>
  </div>
</nav>