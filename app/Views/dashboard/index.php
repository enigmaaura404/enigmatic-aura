<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>
<div class="space-y-8">
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
      <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard Overview</h2>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Welcome back! Here's what's happening with your portfolio.</p>
    </div>
    <div class="flex items-center gap-3">
      <button class="px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all shadow-sm">
        📥 Export Data
      </button>
      <button class="px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white rounded-xl text-sm font-semibold transition-all shadow-md hover:shadow-lg hover:shadow-blue-500/25">
        ⚡ Quick Actions
      </button>
    </div>
  </div>
  
  <!-- Stats Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php 
    $stats = $stats ?? [
      ['label' => 'Total Projects', 'val' => '24', 'trend' => '+12%', 'color' => 'text-green-600 dark:text-green-400', 'icon' => '📁'],
      ['label' => 'Skills', 'val' => '48', 'trend' => '+5%', 'color' => 'text-blue-600 dark:text-blue-400', 'icon' => '⚙️'],
      ['label' => 'Messages', 'val' => '12', 'trend' => '+3 new', 'color' => 'text-purple-600 dark:text-purple-400', 'icon' => '💬'],
      ['label' => 'Profile Views', 'val' => '1.2k', 'trend' => '+18%', 'color' => 'text-orange-600 dark:text-orange-400', 'icon' => '👁️'],
    ];
    foreach($stats as $c): 
    ?>
      <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-300">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/10 to-indigo-500/10 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
            <?= $c['icon'] ?>
          </div>
          <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/30 <?= esc($c['color']) ?>">
            <?= esc($c['trend']) ?>
          </span>
        </div>
        <p class="text-sm text-gray-500 dark:text-gray-400"><?= esc($c['label']) ?></p>
        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1"><?= esc($c['val']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Charts & Activity Section -->
  <div class="grid lg:grid-cols-3 gap-6">
    <!-- Traffic Chart -->
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h3 class="text-lg font-bold text-gray-900 dark:text-white">Traffic Overview</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400">Last 30 days analytics</p>
        </div>
        <select class="px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
          <option>Last 30 days</option>
          <option>Last 7 days</option>
          <option>Last 90 days</option>
        </select>
      </div>
      <div class="h-72 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 rounded-xl flex items-center justify-center text-gray-400 border border-dashed border-gray-300 dark:border-gray-600">
        <div class="text-center">
          <span class="text-5xl mb-3 block">📊</span>
          <p class="text-sm font-medium">Chart Area</p>
          <p class="text-xs mt-1">Integrate Chart.js / ApexCharts here</p>
        </div>
      </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
      <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Recent Activity</h3>
        <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View All</a>
      </div>
      <div class="space-y-4">
        <?php 
        $recentActivities = $recentActivities ?? [
          ['icon' => '📁', 'text' => 'New project "E-Commerce Platform" published', 'time' => '2 hours ago', 'color' => 'blue'],
          ['icon' => '⚙️', 'text' => 'Added 3 new skills to your profile', 'time' => '5 hours ago', 'color' => 'green'],
          ['icon' => '💬', 'text' => 'Received message from John Doe', 'time' => '1 day ago', 'color' => 'purple'],
          ['icon' => '👤', 'text' => 'Updated About section content', 'time' => '2 days ago', 'color' => 'orange'],
          ['icon' => '🎯', 'text' => 'Modified Focus Areas', 'time' => '3 days ago', 'color' => 'pink'],
        ];
        foreach($recentActivities as $act): 
          $colors = [
            'blue' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-600',
            'green' => 'bg-green-100 dark:bg-green-900/30 text-green-600',
            'purple' => 'bg-purple-100 dark:bg-purple-900/30 text-purple-600',
            'orange' => 'bg-orange-100 dark:bg-orange-900/30 text-orange-600',
            'pink' => 'bg-pink-100 dark:bg-pink-900/30 text-pink-600',
          ];
        ?>
          <div class="flex gap-3 items-start group">
            <div class="w-10 h-10 rounded-xl <?= esc($colors[$act['color']]) ?> flex items-center justify-center text-lg flex-shrink-0 group-hover:scale-110 transition-transform">
              <?= $act['icon'] ?>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm text-gray-700 dark:text-gray-300 truncate"><?= esc($act['text']) ?></p>
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5"><?= esc($act['time']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  
  <!-- Quick Actions Grid -->
  <div class="grid md:grid-cols-3 gap-6">
    <a href="/admin/projects" class="group p-6 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl text-white shadow-lg hover:shadow-xl hover:shadow-blue-500/25 transition-all duration-300 hover:-translate-y-1">
      <div class="flex items-center gap-4">
        <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">📁</div>
        <div>
          <h4 class="font-bold text-lg">Manage Projects</h4>
          <p class="text-sm text-blue-100">Add, edit or remove projects</p>
        </div>
      </div>
    </a>
    
    <a href="/admin/skills" class="group p-6 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl text-white shadow-lg hover:shadow-xl hover:shadow-indigo-500/25 transition-all duration-300 hover:-translate-y-1">
      <div class="flex items-center gap-4">
        <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">⚙️</div>
        <div>
          <h4 class="font-bold text-lg">Update Skills</h4>
          <p class="text-sm text-indigo-100">Showcase your expertise</p>
        </div>
      </div>
    </a>
    
    <a href="/admin/messages" class="group p-6 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl text-white shadow-lg hover:shadow-xl hover:shadow-purple-500/25 transition-all duration-300 hover:-translate-y-1">
      <div class="flex items-center gap-4">
        <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">💬</div>
        <div>
          <h4 class="font-bold text-lg">Check Messages</h4>
          <p class="text-sm text-purple-100">Respond to inquiries</p>
        </div>
      </div>
    </a>
  </div>
</div>
<?= $this->endSection() ?>