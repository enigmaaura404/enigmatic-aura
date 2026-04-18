<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="space-y-6">
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white"><?= esc($title ?? 'Messages') ?></h2>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">View and manage contact form submissions</p>
    </div>
    <div class="flex items-center gap-3">
      <button onclick="markAllAsRead()" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
        ✓ Mark All Read
      </button>
      <button onclick="deleteSelected()" class="px-4 py-2.5 text-sm font-medium text-red-600 dark:text-red-400 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
        🗑️ Delete Selected
      </button>
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

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
      <p class="text-sm text-gray-500 dark:text-gray-400">Total Messages</p>
      <div class="flex items-end gap-2 mt-1">
        <span class="text-3xl font-bold text-gray-900 dark:text-white"><?= count($messages ?? []) ?></span>
      </div>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-l-4 border-l-blue-500 dark:border-gray-700 shadow-sm">
      <p class="text-sm text-gray-500 dark:text-gray-400">Unread</p>
      <div class="flex items-end gap-2 mt-1">
        <span class="text-3xl font-bold text-blue-600 dark:text-blue-400"><?= count(array_filter($messages ?? [], fn($m) => !$m['is_read'])) ?></span>
      </div>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
      <p class="text-sm text-gray-500 dark:text-gray-400">This Week</p>
      <div class="flex items-end gap-2 mt-1">
        <span class="text-3xl font-bold text-gray-900 dark:text-white">12</span>
      </div>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
      <p class="text-sm text-gray-500 dark:text-gray-400">Response Rate</p>
      <div class="flex items-end gap-2 mt-1">
        <span class="text-3xl font-bold text-green-600 dark:text-green-400">94%</span>
      </div>
    </div>
  </div>

  <!-- Filters & Search -->
  <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 shadow-sm">
    <div class="flex flex-col lg:flex-row gap-4">
      <div class="flex-1 relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
        <input type="text" id="search-messages" placeholder="Search messages..." onkeyup="filterMessages()" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent focus:outline-none transition-all">
      </div>
      <select id="filter-status" onchange="filterMessages()" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none transition-all">
        <option value="">All Status</option>
        <option value="unread">Unread</option>
        <option value="read">Read</option>
      </select>
      <select id="sort-by" onchange="filterMessages()" class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none transition-all">
        <option value="newest">Newest First</option>
        <option value="oldest">Oldest First</option>
        <option value="name">By Name</option>
      </select>
    </div>
  </div>

  <!-- Messages List -->
  <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
    <?php if (empty($messages)): ?>
      <!-- Empty State -->
      <div class="p-12 text-center">
        <div class="text-6xl mb-4">📭</div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Messages Yet</h3>
        <p class="text-gray-500 dark:text-gray-400">When someone contacts you through the landing page, their message will appear here.</p>
      </div>
    <?php else: ?>
      <div class="divide-y divide-gray-200 dark:divide-gray-700">
        <?php foreach ($messages as $msg): ?>
          <div class="message-item group hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors <?= !$msg['is_read'] ? 'bg-blue-50/50 dark:bg-blue-900/10' : '' ?>" data-message-id="<?= $msg['id'] ?>" data-read="<?= $msg['is_read'] ?>">
            <div class="flex items-start gap-4 p-4 lg:p-6">
              <input type="checkbox" class="mt-1.5 w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500" data-message-checkbox="<?= $msg['id'] ?>">
              
              <div class="w-10 h-10 rounded-full bg-gradient-to-br from-brand-400 to-neon-purple flex items-center justify-center text-white font-bold flex-shrink-0">
                <?= strtoupper(substr($msg['name'], 0, 1)) ?>
              </div>
              
              <div class="flex-1 min-w-0 cursor-pointer" onclick="viewMessage(<?= $msg['id'] ?>)">
                <div class="flex items-start justify-between gap-4 mb-1">
                  <div class="flex items-center gap-2">
                    <h4 class="font-semibold text-gray-900 dark:text-white <?= !$msg['is_read'] ? 'font-bold' : '' ?>"><?= esc($msg['name']) ?></h4>
                    <?php if (!$msg['is_read']): ?>
                      <span class="px-2 py-0.5 bg-blue-500 text-white text-xs rounded-full">New</span>
                    <?php endif; ?>
                  </div>
                  <span class="text-xs text-gray-500 dark:text-gray-400 flex-shrink-0"><?= date('M d, Y H:i', strtotime($msg['created_at'])) ?></span>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1"><?= esc($msg['email']) ?></p>
                <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-2"><?= esc($msg['message']) ?></p>
              </div>
              
              <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <button onclick="viewMessage(<?= $msg['id'] ?>)" class="p-2 text-brand-600 hover:text-brand-500 hover:bg-brand-50 dark:hover:bg-brand-900/30 rounded-lg transition-colors" title="View">
                  👁️
                </button>
                <button onclick="replyToMessage('<?= esc($msg['email']) ?>')" class="p-2 text-green-600 hover:text-green-500 hover:bg-green-50 dark:hover:bg-green-900/30 rounded-lg transition-colors" title="Reply">
                  ↩️
                </button>
                <button onclick="confirmDeleteMessage(<?= $msg['id'] ?>)" class="p-2 text-red-500 hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors" title="Delete">
                  🗑️
                </button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- Message Detail Modal -->
<div id="message-detail-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
  <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeMessageModal()"></div>
  <div class="relative bg-white dark:bg-gray-900 rounded-2xl w-full max-w-2xl mx-4 shadow-2xl max-h-[90vh] overflow-y-auto">
    <div class="sticky top-0 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 p-6 flex items-start justify-between">
      <div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Message Details</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">From <span id="modal-sender-name" class="font-semibold"></span></p>
      </div>
      <button onclick="closeMessageModal()" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors">✕</button>
    </div>
    
    <div class="p-6 space-y-4">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</p>
          <p id="modal-email" class="text-sm font-medium text-gray-900 dark:text-white"></p>
        </div>
        <div>
          <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</p>
          <p id="modal-date" class="text-sm font-medium text-gray-900 dark:text-white"></p>
        </div>
      </div>
      
      <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Message</p>
        <div id="modal-message-content" class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap"></div>
      </div>
    </div>
    
    <div class="sticky bottom-0 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700 p-6 flex gap-3 rounded-b-2xl">
      <button onclick="markAsReadFromModal()" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
        ✓ Mark as Read
      </button>
      <a id="modal-reply-link" href="#" class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-400 rounded-xl text-center transition-all">
        ✉️ Reply via Email
      </a>
    </div>
  </div>
</div>

<script>
let currentMessageId = null;

function filterMessages() {
  const search = document.getElementById('search-messages').value.toLowerCase();
  const status = document.getElementById('filter-status').value;
  const sortBy = document.getElementById('sort-by').value;
  
  document.querySelectorAll('.message-item').forEach(item => {
    const name = item.querySelector('h4').textContent.toLowerCase();
    const email = item.querySelector('p').textContent.toLowerCase();
    const isRead = item.dataset.read === '1';
    
    let matchesSearch = name.includes(search) || email.includes(search);
    let matchesStatus = true;
    
    if (status === 'unread') matchesStatus = !isRead;
    if (status === 'read') matchesStatus = isRead;
    
    item.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
  });
}

function viewMessage(id) {
  currentMessageId = id;
  const item = document.querySelector(`[data-message-id="${id}"]`);
  
  // Update modal content
  document.getElementById('modal-sender-name').textContent = item.querySelector('h4').textContent;
  document.getElementById('modal-email').textContent = item.querySelectorAll('p')[0].textContent;
  document.getElementById('modal-date').textContent = item.querySelector('.flex-shrink-0').textContent;
  document.getElementById('modal-message-content').textContent = item.querySelectorAll('p')[2]?.textContent || '';
  document.getElementById('modal-reply-link').href = `mailto:${item.querySelectorAll('p')[0].textContent}`;
  
  document.getElementById('message-detail-modal').classList.remove('hidden');
  
  // Mark as read via AJAX
  fetch(`/admin/messages/${id}/read`, { method: 'POST' })
    .then(() => {
      item.dataset.read = '1';
      item.classList.remove('bg-blue-50/50', 'dark:bg-blue-900/10');
      item.querySelector('.bg-blue-500')?.remove();
    });
}

function closeMessageModal() {
  document.getElementById('message-detail-modal').classList.add('hidden');
  currentMessageId = null;
}

function markAsReadFromModal() {
  if (currentMessageId) {
    fetch(`/admin/messages/${currentMessageId}/read`, { method: 'POST' })
      .then(() => {
        const item = document.querySelector(`[data-message-id="${currentMessageId}"]`);
        item.dataset.read = '1';
        item.classList.remove('bg-blue-50/50', 'dark:bg-blue-900/10');
        item.querySelector('.bg-blue-500')?.remove();
        closeMessageModal();
      });
  }
}

function markAllAsRead() {
  fetch('/admin/messages/mark-all-read', { method: 'POST' })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        document.querySelectorAll('[data-read="0"]').forEach(item => {
          item.dataset.read = '1';
          item.classList.remove('bg-blue-50/50', 'dark:bg-blue-900/10');
          item.querySelector('.bg-blue-500')?.remove();
        });
      }
    });
}

function replyToMessage(email) {
  window.location.href = `mailto:${email}`;
}

function confirmDeleteMessage(id) {
  if (confirm('Are you sure you want to delete this message? This action cannot be undone.')) {
    deleteMessage(id);
  }
}

function deleteMessage(id) {
  fetch(`/admin/messages/${id}`, { method: 'DELETE' })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        document.querySelector(`[data-message-id="${id}"]`)?.remove();
      }
    });
}

function deleteSelected() {
  const checkboxes = document.querySelectorAll('[data-message-checkbox]:checked');
  if (checkboxes.length === 0) {
    alert('Please select at least one message to delete.');
    return;
  }
  
  if (confirm(`Are you sure you want to delete ${checkboxes.length} message(s)?`)) {
    checkboxes.forEach(cb => {
      const id = cb.dataset.messageCheckbox;
      deleteMessage(id);
    });
  }
}
</script>

<?= $this->endSection() ?>
