<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white"><?= esc($title ?? 'About Section') ?></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your personal information and introduction</p>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div id="flash-success" class="flex items-center gap-3 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl text-green-700 dark:text-green-400 animate-fade-up">
            <span class="text-xl">✓</span>
            <span><?= esc(session()->getFlashdata('success')) ?></span>
            <button onclick="this.parentElement.remove()" class="ml-auto text-green-500 hover:text-green-700">×</button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div id="flash-error" class="flex items-center gap-3 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl text-red-700 dark:text-red-400 animate-fade-up">
            <span class="text-xl">⚠</span>
            <span><?= esc(session()->getFlashdata('error')) ?></span>
            <button onclick="this.parentElement.remove()" class="ml-auto text-red-500 hover:text-red-700">×</button>
        </div>
    <?php endif; ?>

    <!-- About Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <!-- Card Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500/10 to-indigo-500/10 flex items-center justify-center text-2xl">👤</div>
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Profile Information</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Update your personal details and introduction</p>
                </div>
            </div>
        </div>

        <form action="/admin/about/update" method="POST" class="p-6 space-y-6">
            <?= csrf_field() ?>
            
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Preview Card -->
                <div class="lg:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
                        <span>👁️</span> Live Preview
                    </label>
                    <div class="p-5 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 border border-gray-200 dark:border-gray-700 shadow-inner">
                        <div class="space-y-4">
                            <span class="inline-block px-3 py-1 rounded-full bg-blue-100/50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 text-xs font-semibold uppercase tracking-wider">About Me</span>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Meet <span class="text-blue-500" id="preview-name"><?= esc($about['name']) ?></span></h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed" id="preview-description"><?= esc($about['description']) ?></p>
                            <div class="flex flex-wrap gap-2" id="preview-roles">
                                <?php foreach($about['roles'] as $role): ?>
                                    <span class="px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-800 text-xs font-medium border border-gray-200 dark:border-gray-700"><?= esc($role) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Tips -->
                    <div class="mt-4 p-4 rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
                        <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-2">💡 Tips</h4>
                        <ul class="text-xs text-blue-700 dark:text-blue-400 space-y-1">
                            <li>• Keep description concise (under 2000 chars)</li>
                            <li>• Use clear, professional language</li>
                            <li>• Add relevant professional roles</li>
                        </ul>
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="lg:col-span-2 space-y-5">
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Your Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="<?= esc($about['name']) ?>" required
                                   oninput="document.getElementById('preview-name').textContent = this.value"
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                                   placeholder="e.g., John Doe">
                        </div>

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Professional Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="<?= esc($about['title']) ?>" required
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                                   placeholder="e.g., Frontend Developer & UI/UX Designer">
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="6" required maxlength="2000"
                                  oninput="updatePreviewAndCount(this)"
                                  class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none placeholder-gray-400"
                                  placeholder="Write a compelling introduction about yourself, your experience, and what you're passionate about..."><?= esc($about['description']) ?></textarea>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Tell visitors who you are and what you do</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><span id="char-count">0</span>/2000 characters</p>
                        </div>
                    </div>

                    <!-- Roles Section -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Professional Roles</label>
                        <div class="flex flex-wrap gap-2" id="roles-container">
                            <?php foreach($about['roles'] as $index => $role): ?>
                                <div class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 group">
                                    <input type="text" name="roles[]" value="<?= esc($role) ?>" class="bg-transparent border-none text-sm focus:ring-0 w-32 px-0" placeholder="Role">
                                    <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-red-500 transition-colors">×</button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" onclick="addRole()" class="mt-3 inline-flex items-center gap-2 px-4 py-2 text-sm text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors font-medium">
                            <span>+</span> Add Role
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end pt-6 border-t border-gray-200 dark:border-gray-700">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all transform hover:scale-105">
                    <span>💾</span> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Initialize character counter
const descTextarea = document.getElementById('description');
const charCount = document.getElementById('char-count');

function updatePreviewAndCount(textarea) {
    const previewDesc = document.getElementById('preview-description');
    if (previewDesc && textarea) {
        previewDesc.textContent = textarea.value || 'Your description will appear here...';
    }
    if (charCount && textarea) {
        charCount.textContent = textarea.value.length;
    }
}

// Initialize on page load
if (descTextarea && charCount) {
    charCount.textContent = descTextarea.value.length;
    descTextarea.addEventListener('input', () => updatePreviewAndCount(descTextarea));
}

function addRole() {
    const container = document.getElementById('roles-container');
    const div = document.createElement('div');
    div.className = 'inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600';
    div.innerHTML = `
        <input type="text" name="roles[]" placeholder="New role" class="bg-transparent border-none text-sm focus:ring-0 w-32 px-0">
        <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-red-500 transition-colors">×</button>
    `;
    container.appendChild(div);
}

// Auto-hide flash messages after 5 seconds
setTimeout(() => {
    document.getElementById('flash-success')?.remove();
    document.getElementById('flash-error')?.remove();
}, 5000);
</script>

<style>
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-up {
    animation: fadeUp 0.3s ease-out forwards;
}
</style>

<?= $this->endSection() ?>
