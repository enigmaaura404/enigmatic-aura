<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/10 to-indigo-500/10 flex items-center justify-center text-2xl">📊</div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white"><?= esc($title ?? 'Analytics') ?></h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Track your portfolio performance and visitor insights</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <select class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option>Last 7 days</option>
                <option>Last 30 days</option>
                <option>Last 90 days</option>
                <option>This year</option>
            </select>
            <button class="px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all shadow-sm">
                📥 Export
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <?php 
        $analyticsStats = [
            ['label' => 'Total Visitors', 'value' => '12,847', 'trend' => '+18%', 'color' => 'bg-blue-500', 'icon' => '👥'],
            ['label' => 'Page Views', 'value' => '28,492', 'trend' => '+24%', 'color' => 'bg-purple-500', 'icon' => '📄'],
            ['label' => 'Bounce Rate', 'value' => '32.5%', 'trend' => '-8%', 'color' => 'bg-green-500', 'icon' => '📉'],
            ['label' => 'Avg. Session', 'value' => '4m 32s', 'trend' => '+15%', 'color' => 'bg-orange-500', 'icon' => '⏱️'],
        ];
        foreach($analyticsStats as $stat): 
        ?>
        <div class="group bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-300">
            <div class="flex items-start justify-between mb-3">
                <div class="w-11 h-11 rounded-xl <?= esc($stat['color']) ?> flex items-center justify-center text-xl text-white group-hover:scale-110 transition-transform shadow-lg">
                    <?= $stat['icon'] ?>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400">
                    <?= esc($stat['trend']) ?>
                </span>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400"><?= esc($stat['label']) ?></p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1"><?= esc($stat['value']) ?></p>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Charts Section -->
    <div class="grid lg:grid-cols-2 gap-5">
        <!-- Traffic Chart -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Traffic Overview</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Visitors over time</p>
                </div>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-1.5 text-xs font-medium rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">Daily</button>
                    <button class="px-3 py-1.5 text-xs font-medium rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">Weekly</button>
                </div>
            </div>
            <div class="h-64 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 rounded-xl flex items-center justify-center text-gray-400 border border-dashed border-gray-300 dark:border-gray-600">
                <div class="text-center">
                    <span class="text-4xl mb-2 block">📈</span>
                    <p class="text-sm font-medium">Chart Area</p>
                    <p class="text-xs mt-1">Integrate Chart.js / ApexCharts</p>
                </div>
            </div>
        </div>

        <!-- Device Breakdown -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Device Breakdown</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">By device type</p>
                </div>
            </div>
            <div class="space-y-4">
                <?php 
                $devices = [
                    ['name' => 'Desktop', 'percent' => 58, 'color' => 'bg-blue-500', 'icon' => '🖥️'],
                    ['name' => 'Mobile', 'percent' => 35, 'color' => 'bg-purple-500', 'icon' => '📱'],
                    ['name' => 'Tablet', 'percent' => 7, 'color' => 'bg-orange-500', 'icon' => '📲'],
                ];
                foreach($devices as $device): 
                ?>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-xl">
                        <?= $device['icon'] ?>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300"><?= esc($device['name']) ?></span>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white"><?= esc($device['percent']) ?>%</span>
                        </div>
                        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full <?= esc($device['color']) ?> rounded-full transition-all duration-500" style="width: <?= esc($device['percent']) ?>%"></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Top Pages & Sources -->
    <div class="grid lg:grid-cols-2 gap-5">
        <!-- Top Pages -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Top Pages</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Most visited pages</p>
                </div>
                <a href="#" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-medium">View All</a>
            </div>
            <div class="space-y-3">
                <?php
                $topPages = [
                    ['page' => '/', 'views' => '2,345', 'change' => '+12%'],
                    ['page' => '/projects', 'views' => '1,876', 'change' => '+8%'],
                    ['page' => '/about', 'views' => '1,234', 'change' => '+5%'],
                    ['page' => '/contact', 'views' => '987', 'change' => '+3%'],
                ];
                foreach($topPages as $index => $page):
                ?>
                <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500/10 to-indigo-500/10 flex items-center justify-center text-sm font-bold text-blue-600 dark:text-blue-400">
                            <?= $index + 1 ?>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white text-sm"><?= esc($page['page']) ?></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><?= esc($page['views']) ?> views</p>
                        </div>
                    </div>
                    <span class="text-xs font-semibold text-green-600 dark:text-green-400"><?= esc($page['change']) ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Traffic Sources -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Traffic Sources</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Where visitors come from</p>
                </div>
            </div>
            <div class="space-y-3">
                <?php
                $sources = [
                    ['name' => 'Organic Search', 'visitors' => '4,521', 'percent' => 42, 'color' => 'text-blue-600', 'bgColor' => 'bg-blue-500'],
                    ['name' => 'Direct', 'visitors' => '2,847', 'percent' => 28, 'color' => 'text-purple-600', 'bgColor' => 'bg-purple-500'],
                    ['name' => 'Social Media', 'visitors' => '1,923', 'percent' => 18, 'color' => 'text-pink-600', 'bgColor' => 'bg-pink-500'],
                    ['name' => 'Referral', 'visitors' => '1,209', 'percent' => 12, 'color' => 'text-orange-600', 'bgColor' => 'bg-orange-500'],
                ];
                foreach($sources as $source):
                ?>
                <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full <?= esc($source['bgColor']) ?>"></div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white text-sm"><?= esc($source['name']) ?></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><?= esc($source['visitors']) ?> visitors</p>
                        </div>
                    </div>
                    <span class="text-sm font-semibold text-gray-900 dark:text-white"><?= esc($source['percent']) ?>%</span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
