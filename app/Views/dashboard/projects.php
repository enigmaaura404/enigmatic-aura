<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="space-y-6">
  <!-- Page Header with Enhanced Design -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6 border-b border-gray-200 dark:border-gray-700">
    <div>
      <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/10 to-indigo-500/10 flex items-center justify-center text-2xl">📁</div>
        <div>
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white"><?= esc($title ?? 'Manage Projects') ?></h2>
          <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Create, edit, and showcase your amazing projects</p>
        </div>
      </div>
    </div>
    <button onclick="openModal('project-modal')" class="group px-5 py-2.5 bg-gradient-to-r from-brand-600 via-brand-500 to-brand-600 hover:from-brand-500 hover:via-brand-400 hover:to-brand-500 text-white rounded-xl text-sm font-semibold transition-all duration-300 shadow-lg shadow-brand-500/25 hover:shadow-xl hover:shadow-brand-500/30 flex items-center gap-2 transform hover:scale-105">
      <span class="text-lg group-hover:rotate-90 transition-transform duration-300">+</span> 
      <span>New Project</span>
    </button>
  </div>
  
  <!-- Stats Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 dark:text-gray-400">Total Projects</p>
          <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">24</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/10 to-blue-500/5 flex items-center justify-center text-2xl">📊</div>
      </div>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-l-4 border-l-emerald-500 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 dark:text-gray-400">Published</p>
          <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">18</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500/10 to-emerald-500/5 flex items-center justify-center text-2xl">✓</div>
      </div>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-l-4 border-l-amber-500 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 dark:text-gray-400">Drafts</p>
          <p class="text-3xl font-bold text-amber-600 dark:text-amber-400 mt-1">4</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500/10 to-amber-500/5 flex items-center justify-center text-2xl">⏳</div>
      </div>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-l-4 border-l-purple-500 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 dark:text-gray-400">Archived</p>
          <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 mt-1">2</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/10 to-purple-500/5 flex items-center justify-center text-2xl">📦</div>
      </div>
    </div>
  </div>
  
  <!-- Filters & Search with Enhanced Design -->
  <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
    <div class="flex flex-col lg:flex-row gap-4">
      <div class="flex-1 relative group">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-brand-500 transition-colors">🔍</span>
        <input type="text" placeholder="Search projects by name, tech stack..." class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent focus:outline-none transition-all placeholder-gray-400">
      </div>
      <div class="flex flex-wrap gap-3">
        <select class="px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none transition-all cursor-pointer">
          <option value="">All Status</option>
          <option value="published">Published</option>
          <option value="draft">Draft</option>
          <option value="archived">Archived</option>
        </select>
        <select class="px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none transition-all cursor-pointer">
          <option value="">Sort By</option>
          <option value="newest">Newest First</option>
          <option value="oldest">Oldest First</option>
          <option value="name">Name A-Z</option>
        </select>
        <button class="px-5 py-3 bg-brand-500 hover:bg-brand-600 text-white font-medium rounded-xl transition-all shadow-md hover:shadow-lg flex items-center gap-2">
          <span>Filter</span>
        </button>
      </div>
    </div>
  </div>
  
  <!-- Projects Table -->
  <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
          <tr>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
              <input type="checkbox" class="rounded border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500">
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Project Name</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tech Stack</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Created</th>
            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
          <?php 
          $projects = $projects ?? [
            ['id' => 1, 'name' => 'E-Commerce Platform', 'status' => 'published', 'tech_stack' => ['React', 'Node.js', 'PostgreSQL'], 'created_at' => '2024-01-15'],
            ['id' => 2, 'name' => 'Portfolio Website', 'status' => 'published', 'tech_stack' => ['Tailwind CSS', 'Alpine.js'], 'created_at' => '2024-02-20'],
            ['id' => 3, 'name' => 'Task Management App', 'status' => 'draft', 'tech_stack' => ['Vue.js', 'Firebase'], 'created_at' => '2024-03-10'],
            ['id' => 4, 'name' => 'Analytics Dashboard', 'status' => 'archived', 'tech_stack' => ['Next.js', 'Supabase'], 'created_at' => '2024-01-05'],
          ];
          foreach($projects as $p): 
            $statusStyles = [
              'published' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300',
              'draft' => 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300',
              'archived' => 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300'
            ];
            $statusLabels = [
              'published' => '✓ Published',
              'draft' => '⏳ Draft',
              'archived' => '📦 Archived'
            ];
          ?>
            <tr class="group hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
              <td class="px-6 py-4">
                <input type="checkbox" class="rounded border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500">
              </td>
              <td class="px-6 py-4">
                <div class="font-semibold text-gray-900 dark:text-white group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors"><?= esc($p['name']) ?></div>
              </td>
              <td class="px-6 py-4">
                <div class="flex flex-wrap gap-1.5">
                  <?php foreach(array_slice($p['tech_stack'], 0, 3) as $tech): ?>
                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-md text-xs font-medium"><?= esc($tech) ?></span>
                  <?php endforeach; ?>
                  <?php if(count($p['tech_stack']) > 3): ?>
                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 rounded-md text-xs font-medium">+<?= count($p['tech_stack']) - 3 ?></span>
                  <?php endif; ?>
                </div>
              </td>
              <td class="px-6 py-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold <?= esc($statusStyles[$p['status']]) ?>">
                  <?= esc($statusLabels[$p['status']]) ?>
                </span>
              </td>
              <td class="px-6 py-4 text-gray-500 dark:text-gray-400"><?= date('M d, Y', strtotime($p['created_at'])) ?></td>
              <td class="px-6 py-4 text-right">
                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                  <button onclick="editProject(<?= $p['id'] ?>)" class="p-2 text-brand-600 hover:text-brand-500 hover:bg-brand-50 dark:hover:bg-brand-900/30 rounded-lg transition-colors" title="Edit">
                    ✏️
                  </button>
                  <button onclick="viewProject(<?= $p['id'] ?>)" class="p-2 text-purple-600 hover:text-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/30 rounded-lg transition-colors" title="View">
                    👁️
                  </button>
                  <button onclick="confirmDelete(<?= $p['id'] ?>)" class="p-2 text-rose-500 hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/30 rounded-lg transition-colors" title="Delete">
                    🗑️
                  </button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    
    <!-- Enhanced Pagination -->
    <div class="px-6 py-5 border-t border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
      <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-3">
          <p class="text-sm text-gray-600 dark:text-gray-400">Showing <span class="font-semibold text-gray-900 dark:text-white">1-4</span> of <span class="font-semibold text-gray-900 dark:text-white">24</span> projects</p>
          <span class="px-3 py-1 bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-400 rounded-full text-xs font-medium">Page 1 of 6</span>
        </div>
        <div class="flex items-center gap-2">
          <button class="group px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all shadow-sm hover:shadow-md" disabled>
            <span class="group-hover:-translate-x-0.5 inline-block transition-transform">←</span> Previous
          </button>
          <div class="hidden sm:flex items-center gap-1.5">
            <button class="w-10 h-10 flex items-center justify-center text-sm font-semibold bg-gradient-to-r from-brand-600 to-brand-500 text-white rounded-xl shadow-md">1</button>
            <button class="w-10 h-10 flex items-center justify-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-xl transition-all border border-transparent hover:border-gray-200 dark:hover:border-gray-600">2</button>
            <button class="w-10 h-10 flex items-center justify-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-xl transition-all border border-transparent hover:border-gray-200 dark:hover:border-gray-600">3</button>
            <span class="px-2 text-gray-400">...</span>
            <button class="w-10 h-10 flex items-center justify-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-xl transition-all border border-transparent hover:border-gray-200 dark:hover:border-gray-600">6</button>
          </div>
          <button class="group px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all shadow-sm hover:shadow-md">
            Next <span class="group-hover:translate-x-0.5 inline-block transition-transform">→</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Create/Edit Project Modal -->
<div id="project-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
  <!-- Backdrop -->
  <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('project-modal')"></div>
  
  <!-- Modal Content -->
  <div data-modal-content class="relative bg-white dark:bg-gray-900 rounded-2xl w-full max-w-2xl mx-4 shadow-2xl transform transition-all">
    <!-- Header -->
    <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
      <div>
        <h3 id="modal-title" class="text-xl font-bold text-gray-900 dark:text-white">Create New Project</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Fill in the details below</p>
      </div>
      <button onclick="closeModal('project-modal')" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors">
        ✕
      </button>
    </div>
    
    <!-- Body -->
    <form id="project-form" class="p-6 space-y-5">
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Project Name *</label>
        <input type="text" name="name" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-brand-500 focus:border-transparent focus:outline-none transition-all" placeholder="e.g., E-Commerce Platform">
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
        <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-brand-500 focus:border-transparent focus:outline-none transition-all resize-none" placeholder="Brief description of the project..."></textarea>
      </div>
      
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status *</label>
          <select name="status" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-brand-500 focus:outline-none transition-all">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
            <option value="archived">Archived</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
          <select name="category" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-brand-500 focus:outline-none transition-all">
            <option value="web">Web Development</option>
            <option value="mobile">Mobile App</option>
            <option value="design">UI/UX Design</option>
            <option value="other">Other</option>
          </select>
        </div>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tech Stack</label>
        <input type="text" name="tech_stack" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-brand-500 focus:border-transparent focus:outline-none transition-all" placeholder="React, Node.js, PostgreSQL (comma separated)">
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Project URL</label>
        <input type="url" name="url" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-brand-500 focus:border-transparent focus:outline-none transition-all" placeholder="https://example.com">
      </div>
    </form>
    
    <!-- Footer -->
    <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 rounded-b-2xl">
      <button type="button" onclick="closeModal('project-modal')" class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">Cancel</button>
      <button type="submit" form="project-form" class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-400 rounded-xl shadow-md hover:shadow-lg transition-all">Save Project</button>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
  <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('delete-modal')"></div>
  <div data-modal-content class="relative bg-white dark:bg-gray-900 rounded-2xl w-full max-w-md mx-4 p-6 shadow-2xl">
    <div class="text-center">
      <div class="w-16 h-16 mx-auto mb-4 bg-rose-100 dark:bg-rose-900/30 rounded-full flex items-center justify-center">
        <span class="text-3xl">⚠️</span>
      </div>
      <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Delete Project?</h3>
      <p class="text-gray-500 dark:text-gray-400 mb-6">This action cannot be undone. The project will be permanently deleted.</p>
      <div class="flex gap-3">
        <button onclick="closeModal('delete-modal')" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">Cancel</button>
        <button onclick="deleteProject()" class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-500 rounded-xl shadow-md transition-all">Delete</button>
      </div>
    </div>
  </div>
</div>

<script>
// Modal functions
function editProject(id) {
  document.getElementById('modal-title').textContent = 'Edit Project';
  openModal('project-modal');
}

function viewProject(id) {
  showToast('View functionality coming soon!', 'info');
}

let deleteId = null;
function confirmDelete(id) {
  deleteId = id;
  openModal('delete-modal');
}

function deleteProject() {
  if (deleteId) {
    closeModal('delete-modal');
    showToast('Project deleted successfully!', 'success');
    deleteId = null;
  }
}

// Form submission
document.getElementById('project-form')?.addEventListener('submit', function(e) {
  e.preventDefault();
  closeModal('project-modal');
  showToast('Project saved successfully!', 'success');
});
</script>
<?= $this->endSection() ?>
