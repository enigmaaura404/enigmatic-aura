<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="space-y-6">
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white"><?= esc($title) ?></h2>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your about section content</p>
    </div>
  </div>

  <!-- Flash Messages -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="flex items-center gap-3 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl text-green-700 dark:text-green-400">
      <span class="text-xl">✓</span>
      <span><?= esc(session()->getFlashdata('success')) ?></span>
      <button onclick="this.parentElement.remove()" class="ml-auto">×</button>
    </div>
  <?php endif; ?>

  <!-- About Form -->
  <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
    <form action="/admin/about/update" method="POST" class="space-y-6">
      <?= csrf_field() ?>
      
      <div class="grid md:grid-cols-2 gap-6">
        <!-- Preview Card -->
        <div class="order-2 md:order-1">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Preview</label>
          <div class="p-6 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="space-y-4">
              <span class="inline-block px-3 py-1 rounded-full bg-brand-100/50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-300 text-xs font-semibold uppercase tracking-wider">About Me</span>
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Meet <span class="text-brand-500" id="preview-name"><?= esc($about['name']) ?></span></h3>
              <p class="text-gray-600 dark:text-gray-300 leading-relaxed" id="preview-description"><?= esc($about['description']) ?></p>
              <div class="flex gap-2 flex-wrap" id="preview-roles">
                <?php foreach($about['roles'] as $role): ?>
                  <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-sm font-medium border border-gray-200 dark:border-gray-700"><?= esc($role) ?></span>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Form Fields -->
        <div class="order-1 md:order-2 space-y-5">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Name *</label>
            <input type="text" name="name" id="name" value="<?= esc($about['name']) ?>" required
                   oninput="document.getElementById('preview-name').textContent = this.value"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
          </div>

          <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Professional Title *</label>
            <input type="text" name="title" id="title" value="<?= esc($about['title']) ?>" required
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all"
                   placeholder="e.g., Frontend Developer & UI/UX Designer">
          </div>

          <div>
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description *</label>
            <textarea name="description" id="description" rows="5" required maxlength="2000"
                      oninput="document.getElementById('preview-description').textContent = this.value"
                      class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all resize-none"><?= esc($about['description']) ?></textarea>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 text-right"><span id="char-count">0</span>/2000</p>
          </div>
        </div>
      </div>

      <!-- Roles -->
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Professional Roles</label>
        <div class="flex flex-wrap gap-2" id="roles-container">
          <?php foreach($about['roles'] as $index => $role): ?>
            <div class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gray-100 dark:bg-gray-700">
              <input type="text" name="roles[]" value="<?= esc($role) ?>" class="bg-transparent border-none text-sm focus:ring-0 w-32">
              <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-red-500">×</button>
            </div>
          <?php endforeach; ?>
        </div>
        <button type="button" onclick="addRole()" class="mt-2 px-3 py-1.5 text-sm text-brand-600 dark:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/20 rounded-lg transition-colors">+ Add Role</button>
      </div>

      <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-400 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all">
          💾 Save Changes
        </button>
      </div>
    </form>
  </div>
</div>

<script>
// Character counter
const descTextarea = document.getElementById('description');
const charCount = document.getElementById('char-count');
if (descTextarea && charCount) {
  charCount.textContent = descTextarea.value.length;
  descTextarea.addEventListener('input', () => {
    charCount.textContent = descTextarea.value.length;
  });
}

function addRole() {
  const container = document.getElementById('roles-container');
  const div = document.createElement('div');
  div.className = 'inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gray-100 dark:bg-gray-700';
  div.innerHTML = `
    <input type="text" name="roles[]" placeholder="New role" class="bg-transparent border-none text-sm focus:ring-0 w-32">
    <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-red-500">×</button>
  `;
  container.appendChild(div);
}
</script>

<?= $this->endSection() ?>
