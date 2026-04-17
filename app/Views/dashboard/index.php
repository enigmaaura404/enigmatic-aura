<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>
<div class="space-y-6">
  <h2 class="text-2xl font-bold"><?= esc($title ?? 'Dashboard Overview') ?></h2>
  
  <!-- Stats Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <?php foreach($stats as $c): ?>
      <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
        <p class="text-sm text-gray-500 dark:text-gray-400"><?= esc($c['label']) ?></p>
        <div class="flex items-end gap-2 mt-1">
          <span class="text-3xl font-bold"><?= esc($c['val']) ?></span>
          <span class="text-xs font-medium <?= esc($c['color']) ?>"><?= esc($c['trend']) ?></span>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Chart Placeholder & Activity -->
  <div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
      <h3 class="font-semibold mb-4">Traffic Overview</h3>
      <div class="h-64 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-400">📊 Chart Area (Integrate Chart.js / ApexCharts here)</div>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
      <h3 class="font-semibold mb-4">Recent Activity</h3>
      <ul class="space-y-4 text-sm">
        <?php foreach($recentActivities as $act): ?>
          <li class="flex gap-3 items-start">
            <span class="w-2 h-2 mt-1.5 rounded-full bg-brand-500 flex-shrink-0"></span>
            <span class="text-gray-600 dark:text-gray-300"><?= esc($act) ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
<?= $this->endSection() ?>