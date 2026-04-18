<?php
$setting = $setting ?? null;

if (!$setting): ?>
    <div class="text-center py-12">
        <p class="text-gray-500 dark:text-gray-400">Setting not found</p>
    </div>
<?php else: 
    // Decode options if exists
    $options = !empty($setting['options']) ? json_decode($setting['options'], true) : [];
    
    $typeLabels = [
        'text' => 'Text Input',
        'textarea' => 'Text Area',
        'number' => 'Number',
        'boolean' => 'Toggle/Switch',
        'select' => 'Dropdown Select',
        'email' => 'Email',
        'url' => 'URL',
        'color' => 'Color Picker',
        'file' => 'File Upload'
    ];
?>

<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex items-start justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-brand-500/10 to-brand-500/5 flex items-center justify-center text-3xl">
                ⚙️
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white"><?= esc($setting['label']) ?></h3>
                <p class="text-sm font-mono text-gray-500 dark:text-gray-400"><?= esc($setting['key']) ?></p>
            </div>
        </div>
        <span class="inline-flex px-3 py-1.5 rounded-full text-xs font-medium <?= $setting['is_active'] ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400' ?>">
            <?= $setting['is_active'] ? '✓ Active' : '✗ Inactive' ?>
        </span>
    </div>

    <!-- Description -->
    <?php if (!empty($setting['description'])): ?>
    <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
        <p class="text-sm text-gray-600 dark:text-gray-400"><?= nl2br(esc($setting['description'])) ?></p>
    </div>
    <?php endif; ?>

    <!-- Detail Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Type -->
        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Type</p>
            <p class="font-medium text-gray-900 dark:text-white"><?= esc($typeLabels[$setting['type']] ?? ucfirst($setting['type'])) ?></p>
        </div>

        <!-- Category -->
        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Category</p>
            <p class="font-medium text-gray-900 dark:text-white"><?= esc(ucfirst($setting['category'])) ?></p>
        </div>

        <!-- Current Value -->
        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Current Value</p>
            <div class="font-medium text-gray-900 dark:text-white break-all">
                <?php if ($setting['type'] === 'boolean'): ?>
                    <span class="<?= $setting['value'] ? 'text-green-500' : 'text-gray-400' ?>">
                        <?= $setting['value'] ? '✓ Enabled' : '✗ Disabled' ?>
                    </span>
                <?php elseif ($setting['type'] === 'color' && !empty($setting['value'])): ?>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded border border-gray-300 dark:border-gray-600" style="background-color: <?= esc($setting['value']) ?>"></div>
                        <span class="font-mono text-sm"><?= esc($setting['value']) ?></span>
                    </div>
                <?php elseif (!empty($setting['value'])): ?>
                    <span class="font-mono text-sm"><?= esc($setting['value']) ?></span>
                <?php else: ?>
                    <span class="text-gray-400 italic">Not set</span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Default Value -->
        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Default Value</p>
            <p class="font-medium text-gray-900 dark:text-white font-mono text-sm"><?= !empty($setting['default_value']) ? esc($setting['default_value']) : '<span class="text-gray-400 italic">None</span>' ?></p>
        </div>

        <!-- Sort Order -->
        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Sort Order</p>
            <p class="font-medium text-gray-900 dark:text-white"><?= esc($setting['sort_order']) ?></p>
        </div>

        <!-- Created At -->
        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Created</p>
            <p class="font-medium text-gray-900 dark:text-white"><?= date('M d, Y H:i', strtotime($setting['created_at'])) ?></p>
        </div>
    </div>

    <!-- Options (for select type) -->
    <?php if (!empty($options)): ?>
    <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl">
        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Select Options</p>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
            <?php foreach ($options as $key => $value): ?>
            <div class="px-3 py-2 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                <p class="text-xs text-gray-500 dark:text-gray-400 font-mono"><?= esc($key) ?></p>
                <p class="text-sm font-medium text-gray-900 dark:text-white"><?= esc($value) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Updated At -->
    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
        <p class="text-xs text-gray-500 dark:text-gray-400">Last updated: <?= date('M d, Y H:i', strtotime($setting['updated_at'])) ?></p>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <button onclick="closeModal()" 
                class="flex-1 px-4 py-2.5 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
            Close
        </button>
        <button onclick="closeModal(); setTimeout(() => openEditModal(<?= $setting['id'] ?>), 200);" 
                class="flex-1 px-4 py-2.5 bg-gradient-to-r from-brand-500 to-brand-600 hover:from-brand-600 hover:to-brand-700 text-white font-medium rounded-xl shadow-lg shadow-brand-500/25 transition-all transform hover:scale-105">
            ✏️ Edit Setting
        </button>
    </div>
</div>

<?php endif; ?>
