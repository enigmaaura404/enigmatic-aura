<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
  <?php foreach([
    ['label' => 'Total Projects', 'value' => '24', 'change' => '+12%'],
    ['label' => 'Active Users', 'value' => '1.2k', 'change' => '+5%'],
    ['label' => 'Page Views', 'value' => '8.4k', 'change' => '+18%']
  ] as $card): ?>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
      <p class="text-sm text-gray-500 dark:text-gray-400"><?= $card['label'] ?></p>
      <div class="flex items-end gap-2 mt-1">
        <span class="text-3xl font-bold"><?= $card['value'] ?></span>
        <span class="text-sm text-green-500 font-medium"><?= $card['change'] ?></span>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
  <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
    <h3 class="font-semibold">Recent Projects</h3>
    <button onclick="showToast('Create form coming soon', 'info')" class="px-3 py-1 bg-brand-600 text-white text-sm rounded hover:bg-brand-500">+ Add</button>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-sm text-left">
      <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
        <tr><th class="p-4">Name</th><th class="p-4">Tech</th><th class="p-4">Status</th><th class="p-4">Actions</th></tr>
      </thead>
      <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
        <?php foreach([
          ['E-Commerce UI', 'React + Tailwind', 'Live'],
          ['Portfolio v3', 'CI4 + Alpine', 'Draft'],
          ['SaaS Dashboard', 'Next.js', 'Testing']
        ] as $p): ?>
          <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
            <td class="p-4 font-medium"><?= $p[0] ?></td>
            <td class="p-4"><?= $p[1] ?></td>
            <td class="p-4"><span class="px-2 py-1 rounded bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs"><?= $p[2] ?></span></td>
            <td class="p-4 space-x-2">
              <button class="text-brand-600 hover:underline">Edit</button>
              <button onclick="showToast('Item deleted', 'error')" class="text-red-500 hover:underline">Delete</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?= $this->endSection() ?>