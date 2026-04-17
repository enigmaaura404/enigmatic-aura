<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>
<div class="space-y-6">
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <h2 class="text-2xl font-bold">Manage Projects</h2>
    <button onclick="openModal('universal-modal')" class="px-4 py-2 bg-brand-600 hover:bg-brand-500 text-white rounded-lg text-sm font-medium transition-colors shadow-md">+ New Project</button>
  </div>

  <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row gap-3">
      <input type="text" placeholder="Search projects..." class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-transparent text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none flex-1">
      <select class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-transparent text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
        <option>All Status</option><option>Live</option><option>Draft</option><option>Testing</option>
      </select>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase tracking-wider text-xs">
          <tr><th class="p-4">Project Name</th><th class="p-4">Tech Stack</th><th class="p-4">Status</th><th class="p-4 text-right">Actions</th></tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
          <?php foreach([
            ['E-Commerce UI', 'React + Tailwind', 'Live'],
            ['Portfolio v3', 'CI4 + Alpine', 'Draft'],
            ['SaaS Dashboard', 'Next.js', 'Testing']
          ] as $p): ?>
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
              <td class="p-4 font-medium"><?= $p[0] ?></td>
              <td class="p-4 text-gray-500 dark:text-gray-400"><?= $p[1] ?></td>
              <td class="p-4"><span class="px-2 py-1 rounded-full text-xs font-medium <?= $p[2]=='Live' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300' : ($p[2]=='Testing' ? 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300') ?>"><?= $p[2] ?></span></td>
              <td class="p-4 text-right space-x-2">
                <button class="text-brand-600 hover:text-brand-500 font-medium">Edit</button>
                <button onclick="showToast('Project deleted', 'error')" class="text-rose-500 hover:text-rose-400 font-medium">Delete</button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center text-sm text-gray-500">
      <span>Showing 3 of 24 projects</span>
      <div class="flex gap-2">
        <button class="px-3 py-1 rounded border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50" disabled>Prev</button>
        <button class="px-3 py-1 rounded border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">Next</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>