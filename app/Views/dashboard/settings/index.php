<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white"><?= esc($title) ?></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage application settings and configurations</p>
        </div>
        <button onclick="openCreateModal()" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-brand-500 to-brand-600 hover:from-brand-600 hover:to-brand-700 text-white font-medium rounded-xl shadow-lg shadow-brand-500/25 transition-all duration-200 transform hover:scale-105">
            <span class="text-lg">+</span>
            <span>Add Setting</span>
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
        <form method="GET" action="/admin/settings" class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1 relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
                <input type="text" name="search" value="<?= esc($filters['search']) ?>" 
                       placeholder="Search settings..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
            </div>

            <!-- Category Filter -->
            <select name="category" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= esc($cat) ?>" <?= $filters['category'] === $cat ? 'selected' : '' ?>><?= esc(ucfirst($cat)) ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Sort By -->
            <select name="sort_by" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
                <option value="sort_order" <?= $filters['sort_by'] === 'sort_order' ? 'selected' : '' ?>>Sort Order</option>
                <option value="key" <?= $filters['sort_by'] === 'key' ? 'selected' : '' ?>>Key</option>
                <option value="label" <?= $filters['sort_by'] === 'label' ? 'selected' : '' ?>>Label</option>
                <option value="type" <?= $filters['sort_by'] === 'type' ? 'selected' : '' ?>>Type</option>
                <option value="category" <?= $filters['sort_by'] === 'category' ? 'selected' : '' ?>>Category</option>
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

    <!-- Settings Table/Grid -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <?php if (empty($settings)): ?>
            <!-- Empty State -->
            <div class="p-12 text-center">
                <div class="text-6xl mb-4">⚙️</div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Settings Found</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Get started by adding your first setting</p>
                <button onclick="openCreateModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-brand-500 hover:bg-brand-600 text-white font-medium rounded-xl transition-colors">
                    <span>+</span> Add Setting
                </button>
            </div>
        <?php else: ?>
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-8">
                                <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this)" class="w-4 h-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500">
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Setting</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Value</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <?php foreach ($settings as $setting): ?>
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors group" data-id="<?= $setting['id'] ?>">
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="row-checkbox w-4 h-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500" value="<?= $setting['id'] ?>">
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white"><?= esc($setting['label']) ?></p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 font-mono"><?= esc($setting['key']) ?></p>
                                        <?php if (!empty($setting['description'])): ?>
                                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1 truncate max-w-xs"><?= esc($setting['description']) ?></p>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">
                                        <?= esc($settingTypes[$setting['type']] ?? ucfirst($setting['type'])) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400">
                                        <?= esc(ucfirst($setting['category'])) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-700 dark:text-gray-300 max-w-[200px] truncate">
                                        <?php if ($setting['type'] === 'boolean'): ?>
                                            <span class="<?= $setting['value'] ? 'text-green-500' : 'text-gray-400' ?>">
                                                <?= $setting['value'] ? '✓ Enabled' : '✗ Disabled' ?>
                                            </span>
                                        <?php elseif ($setting['type'] === 'color' && !empty($setting['value'])): ?>
                                            <div class="flex items-center gap-2">
                                                <div class="w-6 h-6 rounded border border-gray-300 dark:border-gray-600" style="background-color: <?= esc($setting['value']) ?>"></div>
                                                <span class="font-mono text-xs"><?= esc($setting['value']) ?></span>
                                            </div>
                                        <?php else: ?>
                                            <?= esc(substr($setting['value'] ?? '-', 0, 30)) ?><?= strlen($setting['value'] ?? '') > 30 ? '...' : '' ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <button onclick="toggleStatus(<?= $setting['id'] ?>)" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors <?= $setting['is_active'] ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600' ?>">
                                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform <?= $setting['is_active'] ? 'translate-x-6' : 'translate-x-1' ?>"></span>
                                    </button>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button onclick="openDetailModal(<?= $setting['id'] ?>)" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 transition-colors" title="View Details">
                                            👁️
                                        </button>
                                        <button onclick="openEditModal(<?= $setting['id'] ?>)" class="p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 text-blue-600 dark:text-blue-400 transition-colors" title="Edit">
                                            ✏️
                                        </button>
                                        <button onclick="confirmDelete(<?= $setting['id'] ?>, '<?= esc($setting['label']) ?>')" class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 dark:text-red-400 transition-colors" title="Delete">
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
                <?php foreach ($settings as $setting): ?>
                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 dark:text-white"><?= esc($setting['label']) ?></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-mono"><?= esc($setting['key']) ?></p>
                            </div>
                            <button onclick="toggleStatus(<?= $setting['id'] ?>)" class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors <?= $setting['is_active'] ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600' ?>">
                                <span class="inline-block h-3 w-3 transform rounded-full bg-white transition-transform <?= $setting['is_active'] ? 'translate-x-5' : 'translate-x-1' ?>"></span>
                            </button>
                        </div>
                        <div class="flex gap-2 mb-3">
                            <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">
                                <?= esc($settingTypes[$setting['type']] ?? ucfirst($setting['type'])) ?>
                            </span>
                            <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400">
                                <?= esc(ucfirst($setting['category'])) ?>
                            </span>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="openDetailModal(<?= $setting['id'] ?>)" class="flex-1 px-3 py-2 bg-gray-50 dark:bg-gray-700/50 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium transition-colors">
                                View
                            </button>
                            <button onclick="openEditModal(<?= $setting['id'] ?>)" class="flex-1 px-3 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg text-sm font-medium transition-colors">
                                Edit
                            </button>
                            <button onclick="confirmDelete(<?= $setting['id'] ?>, '<?= esc($setting['label']) ?>')" class="flex-1 px-3 py-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-lg text-sm font-medium transition-colors">
                                Delete
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Bulk Actions -->
            <div id="bulkActions" class="hidden px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <span id="selectedCount">0</span> setting(s) selected
                    </p>
                    <div class="flex gap-2">
                        <button onclick="bulkDelete()" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg transition-colors">
                            Delete Selected
                        </button>
                        <button onclick="clearSelection()" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors">
                            Clear
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Pagination -->
        <?php if (isset($pagination['totalPages']) && $pagination['totalPages'] > 1): ?>
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
                                   class="px-4 py-2 rounded-lg text-sm font-medium transition-colors <?= $i == $pagination['currentPage'] ? 'bg-brand-500 text-white' : 'bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' ?>">
                                    <?= $i ?>
                                </a>
                            <?php elseif ($i == $pagination['currentPage'] - 3 || $i == $pagination['currentPage'] + 3): ?>
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
// Modal Functions
function openCreateModal() {
    fetch('/admin/settings/create', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showModal(data.html, 'Add New Setting');
        }
    });
}

function openEditModal(id) {
    fetch(`/admin/settings/edit/${id}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showModal(data.html, 'Edit Setting');
        }
    });
}

function openDetailModal(id) {
    fetch(`/admin/settings/show/${id}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showModal(data.html, 'Setting Detail', true);
        }
    });
}

function showModal(html, title, isDetail = false) {
    const container = document.getElementById('modal-container');
    container.innerHTML = `
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4" onclick="closeModal(event)">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto animate-fade-up">
                <div class="sticky top-0 z-10 flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">${title}</h3>
                    <button onclick="closeModal()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-gray-500">✕</button>
                </div>
                <div class="p-6">${html}</div>
            </div>
        </div>
    `;
    container.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal(event) {
    if (event && event.target !== event.currentTarget) return;
    const container = document.getElementById('modal-container');
    container.classList.add('hidden');
    container.innerHTML = '';
    document.body.style.overflow = '';
}

function closeFormModal() {
    closeModal();
}

// Form Submission
function submitSettingForm(form, isEdit, id = null) {
    const formData = new FormData(form);
    const url = isEdit ? `/admin/settings/update/${id}` : '/admin/settings/store';
    
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            closeModal();
            setTimeout(() => location.reload(), 500);
        } else {
            displayErrors(data.errors);
        }
    })
    .catch(error => {
        showToast('An error occurred. Please try again.', 'error');
    });
}

function displayErrors(errors) {
    // Clear previous errors
    document.querySelectorAll('.error-message').forEach(el => el.remove());
    document.querySelectorAll('[class*="-error"]').forEach(el => el.textContent = '');
    
    for (const [field, message] of Object.entries(errors)) {
        const input = document.querySelector(`[name="${field}"]`);
        if (input) {
            const errorDiv = document.createElement('p');
            errorDiv.className = 'mt-1 text-xs text-red-500 error-message';
            errorDiv.textContent = message;
            input.parentElement.appendChild(errorDiv);
            input.classList.add('border-red-500');
        }
    }
}

// Toggle Status
function toggleStatus(id) {
    fetch(`/admin/settings/toggle-status/${id}`, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => location.reload(), 500);
        }
    });
}

// Delete Confirmation
function confirmDelete(id, name) {
    if (confirm(`Are you sure you want to delete "${name}"? This action cannot be undone.`)) {
        deleteSetting(id);
    }
}

function deleteSetting(id) {
    fetch(`/admin/settings/delete/${id}`, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => location.reload(), 500);
        }
    });
}

// Bulk Selection
function toggleSelectAll(checkbox) {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    checkboxes.forEach(cb => cb.checked = checkbox.checked);
    updateBulkActions();
}

document.addEventListener('change', function(e) {
    if (e.target.classList.contains('row-checkbox')) {
        updateBulkActions();
    }
});

function updateBulkActions() {
    const checked = document.querySelectorAll('.row-checkbox:checked').length;
    const bulkActions = document.getElementById('bulkActions');
    const selectAll = document.getElementById('selectAll');
    
    document.getElementById('selectedCount').textContent = checked;
    
    if (checked > 0) {
        bulkActions.classList.remove('hidden');
    } else {
        bulkActions.classList.add('hidden');
        selectAll.checked = false;
    }
}

function clearSelection() {
    document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = false);
    document.getElementById('selectAll').checked = false;
    updateBulkActions();
}

function bulkDelete() {
    const ids = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);
    
    if (ids.length === 0) {
        showToast('Please select at least one setting', 'error');
        return;
    }
    
    if (confirm(`Are you sure you want to delete ${ids.length} setting(s)?`)) {
        fetch('/admin/settings/bulk-delete', {
            method: 'POST',
            body: JSON.stringify({ ids }),
            headers: { 
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                setTimeout(() => location.reload(), 500);
            }
        });
    }
}

// Toast Notification
function showToast(message, type = 'success') {
    const colors = {
        success: 'bg-green-500',
        error: 'bg-red-500',
        info: 'bg-blue-500'
    };
    
    const toast = document.createElement('div');
    toast.className = `fixed bottom-6 right-6 ${colors[type]} text-white px-6 py-3 rounded-xl shadow-lg animate-fade-up z-50`;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transition = 'opacity 0.3s';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Auto-hide flash messages
setTimeout(() => {
    document.getElementById('flash-success')?.remove();
    document.getElementById('flash-error')?.remove();
}, 5000);
</script>

<?= $this->endSection() ?>
