<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <?php foreach($stats ?? [] as $stat): ?>
    <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400"><?= esc($stat['label']) ?></p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1"><?= esc($stat['value']) ?></p>
            </div>
            <div class="<?= esc($stat['color']) ?> w-12 h-12 rounded-lg flex items-center justify-center text-xl">
                <?= $stat['icon'] ?>
            </div>
        </div>
        <?php if(isset($stat['trend'])): ?>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-emerald-500 font-medium"><?= esc($stat['trend']) ?></span>
            <span class="text-gray-500 dark:text-gray-400 ml-2">from last month</span>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>

<div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Traffic Overview -->
    <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Traffic Overview</h3>
        <div class="h-64 flex items-center justify-center text-gray-500 dark:text-gray-400">
            <p>Chart placeholder - Integrate with analytics service</p>
        </div>
    </div>

    <!-- Top Pages -->
    <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Top Pages</h3>
        <div class="space-y-4">
            <?php 
            $topPages = [
                ['page' => '/', 'views' => '2,345', 'change' => '+12%'],
                ['page' => '/projects', 'views' => '1,876', 'change' => '+8%'],
                ['page' => '/about', 'views' => '1,234', 'change' => '+5%'],
                ['page' => '/contact', 'views' => '987', 'change' => '+3%'],
            ];
            foreach($topPages as $page): 
            ?>
            <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700 last:border-0">
                <div>
                    <p class="font-medium text-gray-900 dark:text-white"><?= esc($page['page']) ?></p>
                    <p class="text-sm text-gray-500 dark:text-gray-400"><?= esc($page['views']) ?> views</p>
                </div>
                <span class="text-emerald-500 text-sm font-medium"><?= esc($page['change']) ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="mt-8 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Activity</h3>
    <div class="space-y-4">
        <?php 
        $activities = [
            ['action' => 'New user registered', 'time' => '5 minutes ago', 'icon' => '👤'],
            ['action' => 'Project updated: Modern Dashboard', 'time' => '1 hour ago', 'icon' => '📁'],
            ['action' => 'Contact form submission', 'time' => '2 hours ago', 'icon' => '✉️'],
            ['action' => 'Skills section updated', 'time' => '1 day ago', 'icon' => '⚡'],
        ];
        foreach($activities as $activity): 
        ?>
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-xl">
                <?= $activity['icon'] ?>
            </div>
            <div class="flex-1">
                <p class="text-gray-900 dark:text-white font-medium"><?= esc($activity['action']) ?></p>
                <p class="text-sm text-gray-500 dark:text-gray-400"><?= esc($activity['time']) ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
