<?= $this->extend('layouts/landing') ?>
<?= $this->section('content') ?>
<div class="min-h-screen flex bg-gray-50 dark:bg-gray-900">
  <!-- Mobile Overlay -->
  <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity opacity-0" onclick="toggleSidebar()"></div>
  
  <!-- Sidebar (Modern Design) -->
  <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-72 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out flex flex-col shadow-2xl lg:shadow-none">
    <!-- Logo Section -->
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
      <div class="flex items-center justify-between">
        <a href="/admin" class="flex items-center gap-3 group">
          <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-lg group-hover:shadow-blue-500/25 transition-all group-hover:scale-105">⚡</div>
          <div>
            <h1 class="text-lg font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">Admin Panel</h1>
            <p class="text-xs text-gray-500 dark:text-gray-400">EnigmaticAura</p>
          </div>
        </a>
        <button class="lg:hidden p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" onclick="toggleSidebar()">✕</button>
      </div>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
      <p class="px-3 py-2 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Main Menu</p>
      
      <a href="/admin" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin' ? 'bg-gradient-to-r from-blue-500/10 to-blue-500/5 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' ?> transition-all">
        <span class="text-lg">📊</span>
        <span class="font-medium">Dashboard</span>
        <?php if(uri_string() === 'admin'): ?><span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-500"></span><?php endif; ?>
      </a>
      
      <a href="/admin/projects" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin/projects' ? 'bg-gradient-to-r from-blue-500/10 to-blue-500/5 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' ?> transition-all">
        <span class="text-lg">📁</span>
        <span class="font-medium">Projects</span>
        <?php if(uri_string() === 'admin/projects'): ?><span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-500"></span><?php endif; ?>
      </a>
      
      <a href="/admin/skills" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin/skills' ? 'bg-gradient-to-r from-blue-500/10 to-blue-500/5 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' ?> transition-all">
        <span class="text-lg">⚙️</span>
        <span class="font-medium">Skills</span>
        <?php if(uri_string() === 'admin/skills'): ?><span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-500"></span><?php endif; ?>
      </a>
      
      <a href="/admin/about" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin/about' ? 'bg-gradient-to-r from-blue-500/10 to-blue-500/5 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' ?> transition-all">
        <span class="text-lg">👤</span>
        <span class="font-medium">About</span>
        <?php if(uri_string() === 'admin/about'): ?><span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-500"></span><?php endif; ?>
      </a>
      
      <a href="/admin/focus" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin/focus' ? 'bg-gradient-to-r from-blue-500/10 to-blue-500/5 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' ?> transition-all">
        <span class="text-lg">🎯</span>
        <span class="font-medium">Focus Areas</span>
        <?php if(uri_string() === 'admin/focus'): ?><span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-500"></span><?php endif; ?>
      </a>
      
      <a href="/admin/messages" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin/messages' ? 'bg-gradient-to-r from-blue-500/10 to-blue-500/5 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' ?> transition-all">
        <span class="text-lg">💬</span>
        <span class="font-medium">Messages</span>
        <?php if(uri_string() === 'admin/messages'): ?><span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-500"></span><?php endif; ?>
      </a>
      
      <div class="pt-4 pb-2"><p class="px-3 py-2 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Settings</p></div>
      
      <a href="/admin/settings" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin/settings' ? 'bg-gradient-to-r from-blue-500/10 to-blue-500/5 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50' ?> transition-all">
        <span class="text-lg">🔧</span>
        <span class="font-medium">Settings</span>
        <?php if(uri_string() === 'admin/settings'): ?><span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-500"></span><?php endif; ?>
      </a>
      
      <a href="/" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-all">
        <span class="text-lg">🏠</span>
        <span class="font-medium">Back to Site</span>
      </a>
    </nav>
    
    <!-- User Profile & Logout -->
    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
      <div class="flex items-center gap-3 p-3 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 border border-gray-200 dark:border-gray-700 mb-3">
        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold shadow-md">A</div>
        <div class="flex-1 min-w-0">
          <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">Admin</p>
          <p class="text-xs text-gray-500 dark:text-gray-400 truncate">admin@enigmaticaura.com</p>
        </div>
      </div>
    </div>
  </aside>
  
  <!-- Main Area -->
  <div class="flex-1 flex flex-col min-w-0">
    <!-- Top Header -->
    <header class="h-16 lg:h-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between px-4 lg:px-8 sticky top-0 z-30 shadow-sm">
      <div class="flex items-center gap-4">
        <button class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" onclick="toggleSidebar()">☰</button>
        <div class="hidden md:block relative">
          <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
          <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 w-64 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none transition-all">
        </div>
      </div>
      
      <div class="flex items-center gap-3">
        <button class="relative p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" title="Notifications">
          🔔
          <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white dark:ring-gray-800 animate-pulse"></span>
        </button>
        <button data-theme-toggle class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" title="Toggle theme">🌓</button>
        <div class="hidden sm:flex items-center gap-2 pl-3 border-l border-gray-200 dark:border-gray-700">
          <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-md cursor-pointer">A</div>
        </div>
      </div>
    </header>
    
    <!-- Page Content -->
    <main class="flex-1 p-4 lg:p-8 overflow-y-auto">
      <?= $this->renderSection('content') ?>
    </main>
    
    <!-- Footer -->
    <footer class="p-4 lg:p-8 text-center text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
      &copy; <?= date('Y') ?> EnigmaticAura. Built with precision and care.
    </footer>
  </div>
</div>

<script>
function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebar-overlay');
  const isClosed = sidebar.classList.contains('-translate-x-full');
  
  if (isClosed) {
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
    setTimeout(() => overlay.classList.remove('opacity-0'), 10);
  } else {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('opacity-0');
    setTimeout(() => overlay.classList.add('hidden'), 300);
  }
}

// Close sidebar on escape key
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    const sidebar = document.getElementById('sidebar');
    if (!sidebar.classList.contains('-translate-x-full')) {
      toggleSidebar();
    }
  }
});
</script>
<?= $this->endSection() ?>
