<?= $this->include('partials/header') ?>
<div class="min-h-screen flex bg-gray-50 dark:bg-gray-900">
  <!-- Sidebar -->
  <aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 hidden md:flex flex-col">
    <div class="p-5 border-b border-gray-200 dark:border-gray-700">
      <h1 class="text-xl font-bold text-brand-600 dark:text-brand-400">Admin Panel</h1>
    </div>
    <nav class="flex-1 p-4 space-y-2">
      <a href="/admin" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 font-medium">📊 Dashboard</a>
      <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">📁 Projects</a>
      <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">⚙️ Skills</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">
    <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 h-16 flex items-center justify-between px-6">
      <h2 class="text-lg font-semibold">Welcome back, Adi</h2>
      <button id="theme-toggle" class="p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">🌓</button>
    </header>
    <main class="p-6">
      <?= $this->renderSection('content') ?>
    </main>
  </div>
</div>
<?= $this->include('partials/footer') ?>