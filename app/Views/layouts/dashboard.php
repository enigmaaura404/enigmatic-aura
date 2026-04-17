<?= $this->extend('layouts/landing') ?>
<?= $this->section('content') ?>
<div class="min-h-screen flex bg-gray-50 dark:bg-gray-900">
  <!-- Mobile Overlay -->
  <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

  <!-- Sidebar (TailAdmin Style) -->
  <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col">
    <div class="p-5 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
      <h1 class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-brand-500 to-neon-purple">Admin Panel</h1>
      <button class="lg:hidden p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700" data-sidebar-toggle>✕</button>
    </div>
    <nav class="flex-1 p-3 space-y-1 overflow-y-auto">
      <a href="/admin" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-brand-50 dark:bg-brand-900/20 text-brand-700 dark:text-brand-300 font-medium">📊 Dashboard</a>
      <a href="/admin/projects" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors">📁 Projects</a>
      <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors">👥 Users</a>
      <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors">⚙️ Settings</a>
    </nav>
    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
      <a href="/" class="flex items-center gap-2 text-sm text-gray-500 hover:text-brand-500 transition-colors">← Back to Site</a>
    </div>
  </aside>

  <!-- Main Area -->
  <div class="flex-1 flex flex-col min-w-0">
    <header class="h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between px-4 lg:px-6">
      <button class="lg:hidden p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700" data-sidebar-toggle>☰</button>
      <div class="flex items-center gap-3 ml-auto">
        <button data-theme-toggle class="p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">🌓</button>
        <div class="h-8 w-8 rounded-full bg-gradient-to-br from-brand-400 to-neon-purple flex items-center justify-center text-white font-bold text-sm">A</div>
      </div>
    </header>

    <main class="flex-1 p-4 lg:p-6 overflow-y-auto">
      <?= $this->renderSection('content') ?>
    </main>
  </div>
</div>
<?= $this->endSection() ?>