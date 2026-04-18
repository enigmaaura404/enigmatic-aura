<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="space-y-6">
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white"><?= esc($title) ?></h2>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your core focus areas</p>
    </div>
    <button onclick="openCreateModal()" class="px-5 py-2.5 bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-400 text-white rounded-xl text-sm font-semibold transition-all shadow-md hover:shadow-lg flex items-center gap-2">
      <span class="text-lg">+</span> Add Focus Area
    </button>
  </div>

  <!-- Flash Messages -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="flex items-center gap-3 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl text-green-700 dark:text-green-400">
      <span class="text-xl">✓</span>
      <span><?= esc(session()->getFlashdata('success')) ?></span>
      <button onclick="this.parentElement.remove()" class="ml-auto">×</button>
    </div>
  <?php endif; ?>

  <!-- Focus Cards Grid -->
  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($focusItems as $item): ?>
      <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 hover:border-brand-400 dark:hover:border-brand-500 hover:shadow-xl transition-all duration-300 relative">
        <!-- Actions -->
        <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
          <button onclick="editFocus(<?= $item['id'] ?>)" class="p-2 text-brand-600 hover:text-brand-500 hover:bg-brand-50 dark:hover:bg-brand-900/30 rounded-lg transition-colors" title="Edit">✏️</button>
          <button onclick="confirmDelete(<?= $item['id'] ?>)" class="p-2 text-red-500 hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors" title="Delete">🗑️</button>
        </div>

        <!-- Icon -->
        <div class="w-14 h-14 rounded-xl bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
          <?= esc($item['icon']) ?>
        </div>

        <!-- Content -->
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2"><?= esc($item['title']) ?></h3>
        <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed"><?= esc($item['description']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Create/Edit Modal -->
<div id="focus-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
  <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal()"></div>
  <div class="relative bg-white dark:bg-gray-900 rounded-2xl w-full max-w-lg mx-4 shadow-2xl">
    <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
      <h3 class="text-xl font-bold text-gray-900 dark:text-white" id="modal-title">Add Focus Area</h3>
      <button onclick="closeModal()" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors">✕</button>
    </div>
    
    <form id="focus-form" class="p-6 space-y-5">
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Icon (Emoji)</label>
        <input type="text" name="icon" id="icon" required maxlength="10" placeholder="e.g., 💻 🎨 🖥️"
               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all text-center text-2xl">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title *</label>
        <input type="text" name="title" id="title" required maxlength="100" placeholder="e.g., Frontend Developer"
               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description *</label>
        <textarea name="description" id="description" rows="4" required maxlength="500"
                  placeholder="Describe this focus area..."
                  class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all resize-none"></textarea>
      </div>

      <div class="flex gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <button type="button" onclick="closeModal()" class="flex-1 px-4 py-2.5 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">Cancel</button>
        <button type="submit" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-400 text-white font-medium rounded-xl shadow-md transition-all">Save Focus Area</button>
      </div>
    </form>
  </div>
</div>

<script>
function openCreateModal() {
  document.getElementById('modal-title').textContent = 'Add Focus Area';
  document.getElementById('focus-form').reset();
  document.getElementById('focus-modal').classList.remove('hidden');
}

function editFocus(id) {
  document.getElementById('modal-title').textContent = 'Edit Focus Area';
  // In production, fetch data and populate form
  document.getElementById('focus-modal').classList.remove('hidden');
}

function closeModal() {
  document.getElementById('focus-modal').classList.add('hidden');
}

function confirmDelete(id) {
  if (confirm('Are you sure you want to delete this focus area?')) {
    // In production, send delete request
    location.reload();
  }
}

document.getElementById('focus-form').addEventListener('submit', function(e) {
  e.preventDefault();
  // In production, send form data via AJAX
  alert('Focus area saved! (Demo only)');
  closeModal();
});
</script>

<?= $this->endSection() ?>
