<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="space-y-6">
  <!-- Enhanced Page Header -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6 border-b border-gray-200 dark:border-gray-700">
    <div class="flex items-center gap-3">
      <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/10 to-indigo-500/10 flex items-center justify-center text-2xl">🎯</div>
      <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white"><?= esc($title) ?></h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage your core focus areas and specializations</p>
      </div>
    </div>
    <button onclick="openCreateModal()" class="group px-5 py-2.5 bg-gradient-to-r from-brand-600 via-brand-500 to-brand-600 hover:from-brand-500 hover:via-brand-400 hover:to-brand-500 text-white rounded-xl text-sm font-semibold transition-all duration-300 shadow-lg shadow-brand-500/25 hover:shadow-xl hover:shadow-brand-500/30 flex items-center gap-2 transform hover:scale-105">
      <span class="text-lg group-hover:rotate-90 transition-transform duration-300">+</span> Add Focus Area
    </button>
  </div>

  <!-- Stats Overview -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 dark:text-gray-400">Total Focus Areas</p>
          <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1"><?= count($focusItems ?? []) ?></p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/10 to-blue-500/5 flex items-center justify-center text-2xl">📊</div>
      </div>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-l-4 border-l-emerald-500 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 dark:text-gray-400">Active</p>
          <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mt-1"><?= count($focusItems ?? []) ?></p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500/10 to-emerald-500/5 flex items-center justify-center text-2xl">✓</div>
      </div>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-l-4 border-l-purple-500 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 dark:text-gray-400">Categories</p>
          <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 mt-1">3</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/10 to-purple-500/5 flex items-center justify-center text-2xl">🏷️</div>
      </div>
    </div>
  </div>

  <!-- Flash Messages -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="flex items-center gap-3 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl text-green-700 dark:text-green-400 animate-fade-up">
      <span class="text-xl">✓</span>
      <span><?= esc(session()->getFlashdata('success')) ?></span>
      <button onclick="this.parentElement.remove()" class="ml-auto text-green-500 hover:text-green-700">×</button>
    </div>
  <?php endif; ?>

  <!-- Focus Cards Grid -->
  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($focusItems as $index => $item): ?>
      <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 hover:border-brand-400 dark:hover:border-brand-500 hover:shadow-xl hover:shadow-brand-500/10 transition-all duration-300 relative overflow-hidden">
        <!-- Gradient Background on Hover -->
        <div class="absolute inset-0 bg-gradient-to-br from-brand-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        
        <!-- Actions -->
        <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity z-10">
          <button onclick="editFocus(<?= $item['id'] ?>)" class="group/btn p-2.5 text-brand-600 hover:text-brand-500 hover:bg-brand-50 dark:hover:bg-brand-900/30 rounded-lg transition-all" title="Edit Focus Area">
            <span class="group-hover/btn:scale-110 inline-block">✏️</span>
          </button>
          <button onclick="confirmDelete(<?= $item['id'] ?>)" class="group/btn p-2.5 text-red-500 hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-all" title="Delete Focus Area">
            <span class="group-hover/btn:scale-110 inline-block">🗑️</span>
          </button>
        </div>

        <!-- Icon with Animation -->
        <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-br from-brand-100 to-brand-50 dark:from-brand-900/30 dark:to-brand-800/20 flex items-center justify-center text-3xl mb-5 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-md">
          <?= esc($item['icon']) ?>
        </div>

        <!-- Content -->
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors"><?= esc($item['title']) ?></h3>
        <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed line-clamp-3"><?= esc($item['description']) ?></p>
        
        <!-- Decorative Bottom Border -->
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-brand-500 to-brand-300 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
      </div>
    <?php endforeach; ?>
    
    <!-- Add New Card Placeholder -->
    <button onclick="openCreateModal()" class="group bg-gray-50 dark:bg-gray-800/50 p-6 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700 hover:border-brand-400 dark:hover:border-brand-500 hover:bg-brand-50 dark:hover:bg-brand-900/10 transition-all duration-300 flex flex-col items-center justify-center min-h-[200px]">
      <div class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-gray-700 group-hover:bg-brand-100 dark:group-hover:bg-brand-900/30 flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition-transform">
        <span class="text-gray-400 group-hover:text-brand-600 dark:group-hover:text-brand-400">+</span>
      </div>
      <p class="text-sm font-medium text-gray-500 dark:text-gray-400 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">Add New Focus Area</p>
    </button>
  </div>
</div>

<!-- Create/Edit Modal -->
<div id="focus-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
  <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal()"></div>
  <div class="relative bg-white dark:bg-gray-900 rounded-2xl w-full max-w-lg mx-4 shadow-2xl transform transition-all">
    <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-100 to-brand-50 dark:from-brand-900/30 dark:to-brand-800/20 flex items-center justify-center text-xl">🎯</div>
        <div>
          <h3 class="text-xl font-bold text-gray-900 dark:text-white" id="modal-title">Add Focus Area</h3>
          <p class="text-xs text-gray-500 dark:text-gray-400">Fill in the details below</p>
        </div>
      </div>
      <button onclick="closeModal()" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors">✕</button>
    </div>
    
    <form id="focus-form" class="p-6 space-y-5">
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Icon (Emoji)</label>
        <input type="text" name="icon" id="icon" required maxlength="10" placeholder="e.g., 💻 🎨 🖥️"
               class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all text-center text-3xl">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title *</label>
        <input type="text" name="title" id="title" required maxlength="100" placeholder="e.g., Frontend Developer"
               class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description *</label>
        <textarea name="description" id="description" rows="4" required maxlength="500"
                  placeholder="Describe this focus area and what makes it special..."
                  class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all resize-none"></textarea>
      </div>

      <div class="flex gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <button type="button" onclick="closeModal()" class="flex-1 px-4 py-3 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">Cancel</button>
        <button type="submit" class="flex-1 px-4 py-3 bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-400 text-white font-semibold rounded-xl shadow-md transition-all">Save Focus Area</button>
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
  if (confirm('Are you sure you want to delete this focus area? This action cannot be undone.')) {
    // In production, send delete request
    showToast('Focus area deleted successfully!', 'success');
  }
}

document.getElementById('focus-form').addEventListener('submit', function(e) {
  e.preventDefault();
  // In production, send form data via AJAX
  closeModal();
  showToast('Focus area saved successfully!', 'success');
});
</script>

<?= $this->endSection() ?>
