<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>
<div class="space-y-6">
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard Overview</h2>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Welcome back! Here's what's happening with your portfolio.</p>
    </div>
    <div class="flex items-center gap-3">
      <button class="px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all shadow-sm">
        📥 Export
      </button>
      <button class="px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white rounded-xl text-sm font-semibold transition-all shadow-md hover:shadow-lg hover:shadow-blue-500/25">
        ⚡ Actions
      </button>
    </div>
  </div>
  
  <!-- Stats Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    <?php 
    foreach($stats as $c): 
    ?>
      <div class="group bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-300">
        <div class="flex items-start justify-between mb-3">
          <div class="w-11 h-11 rounded-xl <?= esc($c['bgColor']) ?> flex items-center justify-center text-xl text-white group-hover:scale-110 transition-transform shadow-lg">
            <?= $c['icon'] ?>
          </div>
          <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400">
            <?= esc($c['trend']) ?>
          </span>
        </div>
        <p class="text-sm text-gray-500 dark:text-gray-400"><?= esc($c['label']) ?></p>
        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1"><?= esc($c['val']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Charts & Activity Section -->
  <div class="grid lg:grid-cols-3 gap-5">
    <!-- Traffic Chart -->
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
      <div class="flex items-center justify-between mb-5">
        <div>
          <h3 class="text-base font-bold text-gray-900 dark:text-white">Traffic Overview</h3>
          <p class="text-xs text-gray-500 dark:text-gray-400">Last 30 days analytics</p>
        </div>
        <select class="px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
          <option>Last 30 days</option>
          <option>Last 7 days</option>
          <option>Last 90 days</option>
        </select>
      </div>
      <div class="h-64 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 rounded-xl flex items-center justify-center text-gray-400 border border-dashed border-gray-300 dark:border-gray-600">
        <div class="text-center">
          <span class="text-4xl mb-2 block">📊</span>
          <p class="text-sm font-medium">Chart Area</p>
          <p class="text-xs mt-1">Integrate Chart.js / ApexCharts</p>
        </div>
      </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
      <div class="flex items-center justify-between mb-5">
        <h3 class="text-base font-bold text-gray-900 dark:text-white">Recent Activity</h3>
        <a href="#" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-medium">View All</a>
      </div>
      <div class="space-y-3">
        <?php 
        $colors = [
          'blue' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-600',
          'green' => 'bg-green-100 dark:bg-green-900/30 text-green-600',
          'purple' => 'bg-purple-100 dark:bg-purple-900/30 text-purple-600',
          'orange' => 'bg-orange-100 dark:bg-orange-900/30 text-orange-600',
          'pink' => 'bg-pink-100 dark:bg-pink-900/30 text-pink-600',
          'red' => 'bg-red-100 dark:bg-red-900/30 text-red-600',
        ];
        foreach($recentActivities as $act): 
          // Ensure $act is an array and has required keys
          if (!is_array($act) || !isset($act['color'])) {
            continue;
          }
          $colorKey = is_string($act['color']) ? $act['color'] : 'blue';
          $colorClass = $colors[$colorKey] ?? $colors['blue'];
        ?>
          <div class="flex gap-3 items-start group">
            <div class="w-9 h-9 rounded-xl <?= esc($colorClass) ?> flex items-center justify-center text-base flex-shrink-0 group-hover:scale-110 transition-transform">
              <?= esc($act['icon'] ?? '📌') ?>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm text-gray-700 dark:text-gray-300 truncate"><?= esc($act['text'] ?? 'Activity') ?></p>
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5"><?= esc($act['time'] ?? 'Recently') ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  
  <!-- Quick Actions Grid -->
  <div class="grid md:grid-cols-3 gap-5">
    <a href="/admin/projects" class="group p-5 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl text-white shadow-lg hover:shadow-xl hover:shadow-blue-500/25 transition-all duration-300 hover:-translate-y-1">
      <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">📁</div>
        <div>
          <h4 class="font-bold text-base">Manage Projects</h4>
          <p class="text-xs text-blue-100">Add, edit or remove projects</p>
        </div>
      </div>
    </a>
    
    <a href="/admin/skills" class="group p-5 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl text-white shadow-lg hover:shadow-xl hover:shadow-indigo-500/25 transition-all duration-300 hover:-translate-y-1">
      <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">⚙️</div>
        <div>
          <h4 class="font-bold text-base">Update Skills</h4>
          <p class="text-xs text-indigo-100">Showcase your expertise</p>
        </div>
      </div>
    </a>
    
    <a href="/admin/messages" class="group p-5 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl text-white shadow-lg hover:shadow-xl hover:shadow-purple-500/25 transition-all duration-300 hover:-translate-y-1">
      <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">💬</div>
        <div>
          <h4 class="font-bold text-base">Check Messages</h4>
          <p class="text-xs text-purple-100">Respond to inquiries</p>
        </div>
      </div>
    </a>
  </div>
</div>
<?= $this->endSection() ?>