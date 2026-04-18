<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white"><?= esc($title) ?></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your technical skills and expertise</p>
        </div>
        <button onclick="openCreateModal()" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-brand-500 to-brand-600 hover:from-brand-600 hover:to-brand-700 text-white font-medium rounded-xl shadow-lg shadow-brand-500/25 transition-all duration-200 transform hover:scale-105">
            <span class="text-lg">+</span>
            <span>Add Skill</span>
        </button>
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

    <!-- Filters & Search -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 shadow-sm">
        <form method="GET" action="/admin/skills" class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1 relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
                <input type="text" name="search" value="<?= esc($filters['search']) ?>" 
                       placeholder="Search skills..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
            </div>

            <!-- Category Filter -->
            <select name="category" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= esc($cat) ?>" <?= $filters['category'] === $cat ? 'selected' : '' ?>><?= esc($cat) ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Sort By -->
            <select name="sort_by" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
                <option value="name" <?= $filters['sort_by'] === 'name' ? 'selected' : '' ?>>Name</option>
                <option value="category" <?= $filters['sort_by'] === 'category' ? 'selected' : '' ?>>Category</option>
                <option value="level" <?= $filters['sort_by'] === 'level' ? 'selected' : '' ?>>Level</option>
                <option value="created_at" <?= $filters['sort_by'] === 'created_at' ? 'selected' : '' ?>>Created</option>
            </select>

            <!-- Sort Order -->
            <select name="sort_order" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
                <option value="asc" <?= $filters['sort_order'] === 'asc' ? 'selected' : '' ?>>↑ Ascending</option>
                <option value="desc" <?= $filters['sort_order'] === 'desc' ? 'selected' : '' ?>>↓ Descending</option>
            </select>

            <!-- Submit Button -->
            <button type="submit" class="px-6 py-2.5 bg-brand-500 hover:bg-brand-600 text-white font-medium rounded-xl transition-colors">
                Filter
            </button>
        </form>
    </div>

    <!-- Skills Table/Grid -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <?php if (empty($skills)): ?>
            <!-- Empty State -->
            <div class="p-12 text-center">
                <div class="text-6xl mb-4">📚</div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Skills Found</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Get started by adding your first skill</p>
                <button onclick="openCreateModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-brand-500 hover:bg-brand-600 text-white font-medium rounded-xl transition-colors">
                    <span>+</span> Add Skill
                </button>
            </div>
        <?php else: ?>
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Skill</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Level</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <?php foreach ($skills as $skill): ?>
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500/10 to-brand-500/5 flex items-center justify-center text-2xl">
                                            <?= !empty($skill['icon']) ? esc($skill['icon']) : '⚡' ?>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900 dark:text-white"><?= esc($skill['name']) ?></p>
                                            <?php if (!empty($skill['description'])): ?>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-xs"><?= esc($skill['description']) ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-400">
                                        <?= esc($skill['category']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-1 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden max-w-[120px]">
                                            <div class="h-full rounded-full transition-all duration-500 <?= getLevelColor($skill['level']) ?>" style="width: <?= esc($skill['level']) ?>%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 min-w-[35px]"><?= esc($skill['level']) ?>%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <button onclick="toggleStatus(<?= $skill['id'] ?>)" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors <?= $skill['is_active'] ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600' ?>">
                                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform <?= $skill['is_active'] ? 'translate-x-6' : 'translate-x-1' ?>"></span>
                                    </button>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button onclick="openEditModal(<?= $skill['id'] ?>)" class="p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 text-blue-600 dark:text-blue-400 transition-colors" title="Edit">
                                            ✏️
                                        </button>
                                        <button onclick="confirmDelete(<?= $skill['id'] ?>, '<?= esc($skill['name']) ?>')" class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 dark:text-red-400 transition-colors" title="Delete">
                                            🗑️
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
                <?php foreach ($skills as $skill): ?>
                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500/10 to-brand-500/5 flex items-center justify-center text-2xl">
                                    <?= !empty($skill['icon']) ? esc($skill['icon']) : '⚡' ?>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white"><?= esc($skill['name']) ?></p>
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-400">
                                        <?= esc($skill['category']) ?>
                                    </span>
                                </div>
                            </div>
                            <button onclick="toggleStatus(<?= $skill['id'] ?>)" class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors <?= $skill['is_active'] ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600' ?>">
                                <span class="inline-block h-3 w-3 transform rounded-full bg-white transition-transform <?= $skill['is_active'] ? 'translate-x-5' : 'translate-x-1' ?>"></span>
                            </button>
                        </div>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="flex-1 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-500 <?= getLevelColor($skill['level']) ?>" style="width: <?= esc($skill['level']) ?>%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300"><?= esc($skill['level']) ?>%</span>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="openEditModal(<?= $skill['id'] ?>)" class="flex-1 px-3 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg text-sm font-medium transition-colors">
                                Edit
                            </button>
                            <button onclick="confirmDelete(<?= $skill['id'] ?>, '<?= esc($skill['name']) ?>')" class="flex-1 px-3 py-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-lg text-sm font-medium transition-colors">
                                Delete
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Pagination -->
        <?php if ($pagination['totalPages'] > 1): ?>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Showing <span class="font-medium"><?= esc(($pagination['currentPage'] - 1) * $pagination['perPage'] + 1) ?></span> to 
                        <span class="font-medium"><?= esc(min($pagination['currentPage'] * $pagination['perPage'], $pagination['total'])) ?></span> of 
                        <span class="font-medium"><?= esc($pagination['total']) ?></span> results
                    </p>
                    <div class="flex gap-2">
                        <?php if ($pagination['currentPage'] > 1): ?>
                            <a href="?page=<?= $pagination['currentPage'] - 1 ?>&search=<?= urlencode($filters['search']) ?>&category=<?= urlencode($filters['category']) ?>&sort_by=<?= urlencode($filters['sort_by']) ?>&sort_order=<?= urlencode($filters['sort_order']) ?>" 
                               class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                Previous
                            </a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                            <?php if ($i == 1 || $i == $pagination['totalPages'] || abs($i - $pagination['currentPage']) <= 2): ?>
                                <a href="?page=<?= $i ?>&search=<?= urlencode($filters['search']) ?>&category=<?= urlencode($filters['category']) ?>&sort_by=<?= urlencode($filters['sort_by']) ?>&sort_order=<?= urlencode($filters['sort_order']) ?>" 
                                   class="px-4 py-2 rounded-lg text-sm font-medium transition-colors <?= $i == $pagination['currentPage'] ? 'bg-brand-500 text-white' : 'bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700' ?>">
                                    <?= $i ?>
                                </a>
                            <?php elseif (abs($i - $pagination['currentPage']) == 3): ?>
                                <span class="px-2 text-gray-400">...</span>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($pagination['currentPage'] < $pagination['totalPages']): ?>
                            <a href="?page=<?= $pagination['currentPage'] + 1 ?>&search=<?= urlencode($filters['search']) ?>&category=<?= urlencode($filters['category']) ?>&sort_by=<?= urlencode($filters['sort_by']) ?>&sort_order=<?= urlencode($filters['sort_order']) ?>" 
                               class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                Next
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Container -->
<div id="modal-container" class="fixed inset-0 z-50 hidden"></div>

<script>
// Helper function for level colors
function getLevelColor(level) {
    if (level >= 80) return 'bg-green-500';
    if (level >= 60) return 'bg-blue-500';
    if (level >= 40) return 'bg-yellow-500';
    return 'bg-red-500';
}

// Open Create Modal
async function openCreateModal() {
    const modalContainer = document.getElementById('modal-container');
    modalContainer.classList.remove('hidden');
    modalContainer.innerHTML = `
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-lg transform transition-all scale-95 opacity-0" id="modal-content">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Add New Skill</h3>
                        <button onclick="closeModal()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">×</button>
                    </div>
                    <div id="modal-body" class="space-y-4">
                        <div class="animate-pulse space-y-4">
                            <div class="h-10 bg-gray-200 dark:bg-gray-700 rounded-lg"></div>
                            <div class="h-10 bg-gray-200 dark:bg-gray-700 rounded-lg"></div>
                            <div class="h-10 bg-gray-200 dark:bg-gray-700 rounded-lg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    try {
        const response = await fetch('/admin/skills/create', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const data = await response.json();
        
        if (data.success) {
            document.getElementById('modal-body').innerHTML = data.html;
            setTimeout(() => {
                document.getElementById('modal-content').classList.remove('scale-95', 'opacity-0');
            }, 10);
        }
    } catch (error) {
        console.error('Error loading form:', error);
        document.getElementById('modal-body').innerHTML = '<p class="text-red-500">Failed to load form. Please try again.</p>';
    }
}

// Open Edit Modal
async function openEditModal(skillId) {
    const modalContainer = document.getElementById('modal-container');
    modalContainer.classList.remove('hidden');
    modalContainer.innerHTML = `
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-lg transform transition-all scale-95 opacity-0" id="modal-content">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Edit Skill</h3>
                        <button onclick="closeModal()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">×</button>
                    </div>
                    <div id="modal-body" class="space-y-4">
                        <div class="animate-pulse space-y-4">
                            <div class="h-10 bg-gray-200 dark:bg-gray-700 rounded-lg"></div>
                            <div class="h-10 bg-gray-200 dark:bg-gray-700 rounded-lg"></div>
                            <div class="h-10 bg-gray-200 dark:bg-gray-700 rounded-lg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    try {
        const response = await fetch(`/admin/skills/${skillId}/edit`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const data = await response.json();
        
        if (data.success) {
            document.getElementById('modal-body').innerHTML = data.html;
            setTimeout(() => {
                document.getElementById('modal-content').classList.remove('scale-95', 'opacity-0');
            }, 10);
        }
    } catch (error) {
        console.error('Error loading form:', error);
        document.getElementById('modal-body').innerHTML = '<p class="text-red-500">Failed to load form. Please try again.</p>';
    }
}

// Close Modal
function closeModal() {
    const modalContainer = document.getElementById('modal-container');
    modalContainer.classList.add('hidden');
    modalContainer.innerHTML = '';
}

// Submit Form (AJAX)
async function submitSkillForm(formElement, isEdit = false, skillId = null) {
    const formData = new FormData(formElement);
    const url = isEdit ? `/admin/skills/${skillId}` : '/admin/skills';
    const method = isEdit ? 'PUT' : 'POST';

    // Show loading state
    const submitBtn = formElement.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="animate-spin">⏳</span> Saving...';

    try {
        const response = await fetch(url, {
            method: method,
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const data = await response.json();

        if (data.success) {
            closeModal();
            // Show success message
            showFlashMessage('success', data.message);
            // Reload page after short delay
            setTimeout(() => location.reload(), 500);
        } else {
            // Show validation errors
            if (data.errors) {
                Object.keys(data.errors).forEach(field => {
                    const errorDiv = document.getElementById(`${field}-error`);
                    if (errorDiv) errorDiv.textContent = data.errors[field];
                });
            } else {
                showFlashMessage('error', data.message || 'Operation failed');
            }
        }
    } catch (error) {
        console.error('Error:', error);
        showFlashMessage('error', 'An error occurred. Please try again.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
}

// Toggle Status
async function toggleStatus(skillId) {
    try {
        const response = await fetch(`/admin/skills/${skillId}/toggle-status`, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const data = await response.json();

        if (data.success) {
            showFlashMessage('success', data.message);
            setTimeout(() => location.reload(), 500);
        } else {
            showFlashMessage('error', data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        showFlashMessage('error', 'Failed to update status');
    }
}

// Confirm Delete
function confirmDelete(skillId, skillName) {
    if (!confirm(`Are you sure you want to delete "${skillName}"? This action cannot be undone.`)) {
        return;
    }
    deleteSkill(skillId);
}

// Delete Skill
async function deleteSkill(skillId) {
    try {
        const response = await fetch(`/admin/skills/${skillId}`, {
            method: 'DELETE',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const data = await response.json();

        if (data.success) {
            showFlashMessage('success', data.message);
            setTimeout(() => location.reload(), 500);
        } else {
            showFlashMessage('error', data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        showFlashMessage('error', 'Failed to delete skill');
    }
}

// Show Flash Message
function showFlashMessage(type, message) {
    const flashContainer = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800 text-green-700 dark:text-green-400' : 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800 text-red-700 dark:text-red-400';
    const icon = type === 'success' ? '✓' : '⚠';
    
    flashContainer.className = `fixed top-4 right-4 z-50 flex items-center gap-3 p-4 ${bgColor} border rounded-xl shadow-lg animate-fade-up`;
    flashContainer.innerHTML = `
        <span class="text-xl">${icon}</span>
        <span>${message}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto hover:opacity-70">×</button>
    `;
    
    document.body.appendChild(flashContainer);
    setTimeout(() => flashContainer.remove(), 5000);
}

// Auto-hide flash messages
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
