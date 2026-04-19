<?= $this->extend('layouts/landing') ?>
<?= $this->section('content') ?>
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'Dashboard') ?> - EnigmaticAura Admin</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <style>
        /* Custom scrollbar for webkit browsers */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { @apply bg-transparent; }
        ::-webkit-scrollbar-thumb { @apply bg-gray-300 dark:bg-gray-700 rounded-full; }
        ::-webkit-scrollbar-thumb:hover { @apply bg-gray-400 dark:bg-gray-600; }
        
        /* Smooth transitions */
        .sidebar-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        
        /* Glass effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .dark .glass-effect {
            background: rgba(31, 41, 55, 0.95);
        }
        
        /* Gradient animations */
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .gradient-animated {
            background-size: 200% 200%;
            animation: gradient-shift 15s ease infinite;
        }
        
        /* Pulse glow effect */
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59,130,246,0.3); }
            50% { box-shadow: 0 0 40px rgba(59,130,246,0.5), 0 0 60px rgba(139,92,246,0.3); }
        }
        .pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
        
        /* Modal animations */
        @keyframes modal-fade-in {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .modal-animate { animation: modal-fade-in 0.2s ease-out forwards; }
        
        /* Table row hover effect */
        .table-row-hover:hover td {
            background: linear-gradient(90deg, rgba(59,130,246,0.05) 0%, transparent 100%);
        }
        
        /* Loading spinner */
        .spinner {
            border: 2px solid rgba(59,130,246,0.1);
            border-top-color: rgb(59,130,246);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
<div class="min-h-screen flex">
    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity duration-300 opacity-0" onclick="toggleSidebar()"></div>
    
    <!-- Sidebar (Enhanced Modern Design) -->
    <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-72 glass-effect border-r border-gray-200 dark:border-gray-800 transform -translate-x-full lg:translate-x-0 sidebar-transition flex flex-col shadow-xl lg:shadow-none">
        <!-- Logo Section -->
        <div class="p-6 border-b border-gray-200 dark:border-gray-800">
            <div class="flex items-center justify-between">
                <a href="/admin" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600 flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-blue-500/25 group-hover:shadow-blue-500/40 transition-all group-hover:scale-105 gradient-animated">⚡</div>
                    <div>
                        <h1 class="text-base font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">Admin Panel</h1>
                        <p class="text-xs text-gray-500 dark:text-gray-400">EnigmaticAura</p>
                    </div>
                </a>
                <button class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-500" onclick="toggleSidebar()">✕</button>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <p class="px-3 py-2 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">Main Menu</p>
            
            <a href="/admin" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin' ? 'bg-gradient-to-r from-blue-500/15 to-indigo-500/10 text-blue-600 dark:text-blue-400 border border-blue-200/50 dark:border-blue-800/50 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50' ?> transition-all duration-200">
                <span class="text-lg">📊</span>
                <span class="font-medium">Dashboard</span>
                <?php if(uri_string() === 'admin'): ?><span class="ml-auto w-2 h-2 rounded-full bg-blue-500"></span><?php endif; ?>
            </a>
            
            <a href="/admin/projects" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin/projects' ? 'bg-gradient-to-r from-blue-500/15 to-indigo-500/10 text-blue-600 dark:text-blue-400 border border-blue-200/50 dark:border-blue-800/50 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50' ?> transition-all duration-200">
                <span class="text-lg">📁</span>
                <span class="font-medium">Projects</span>
                <?php if(uri_string() === 'admin/projects'): ?><span class="ml-auto w-2 h-2 rounded-full bg-blue-500"></span><?php endif; ?>
            </a>
            
            <a href="/admin/skills" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin/skills' ? 'bg-gradient-to-r from-blue-500/15 to-indigo-500/10 text-blue-600 dark:text-blue-400 border border-blue-200/50 dark:border-blue-800/50 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50' ?> transition-all duration-200">
                <span class="text-lg">⚙️</span>
                <span class="font-medium">Skills</span>
                <?php if(uri_string() === 'admin/skills'): ?><span class="ml-auto w-2 h-2 rounded-full bg-blue-500"></span><?php endif; ?>
            </a>
            
            <a href="/admin/about" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin/about' ? 'bg-gradient-to-r from-blue-500/15 to-indigo-500/10 text-blue-600 dark:text-blue-400 border border-blue-200/50 dark:border-blue-800/50 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50' ?> transition-all duration-200">
                <span class="text-lg">👤</span>
                <span class="font-medium">About</span>
                <?php if(uri_string() === 'admin/about'): ?><span class="ml-auto w-2 h-2 rounded-full bg-blue-500"></span><?php endif; ?>
            </a>
            
            <a href="/admin/focus" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin/focus' ? 'bg-gradient-to-r from-blue-500/15 to-indigo-500/10 text-blue-600 dark:text-blue-400 border border-blue-200/50 dark:border-blue-800/50 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50' ?> transition-all duration-200">
                <span class="text-lg">🎯</span>
                <span class="font-medium">Focus Areas</span>
                <?php if(uri_string() === 'admin/focus'): ?><span class="ml-auto w-2 h-2 rounded-full bg-blue-500"></span><?php endif; ?>
            </a>
            
            <a href="/admin/messages" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin/messages' ? 'bg-gradient-to-r from-blue-500/15 to-indigo-500/10 text-blue-600 dark:text-blue-400 border border-blue-200/50 dark:border-blue-800/50 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50' ?> transition-all duration-200">
                <span class="text-lg">💬</span>
                <span class="font-medium">Messages</span>
                <?php if(uri_string() === 'admin/messages'): ?>
                    <span class="ml-auto flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                    </span>
                <?php endif; ?>
            </a>
            
            <div class="pt-4 pb-2"><p class="px-3 py-2 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Account</p></div>
            
            <a href="/admin/settings" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl <?= uri_string() === 'admin/settings' ? 'bg-gradient-to-r from-blue-500/15 to-indigo-500/10 text-blue-600 dark:text-blue-400 border border-blue-200/50 dark:border-blue-800/50 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50' ?> transition-all duration-200">
                <span class="text-lg">🔧</span>
                <span class="font-medium">Settings</span>
                <?php if(uri_string() === 'admin/settings'): ?><span class="ml-auto w-2 h-2 rounded-full bg-blue-500"></span><?php endif; ?>
            </a>
            
            <a href="/" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800/50 transition-all duration-200">
                <span class="text-lg">🏠</span>
                <span class="font-medium">Back to Site</span>
            </a>
        </nav>
        
        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-gray-200 dark:border-gray-800">
            <div class="flex items-center gap-3 p-3 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-800/50 border border-gray-200 dark:border-gray-700 mb-3 hover:border-blue-300 dark:hover:border-blue-700 transition-colors cursor-pointer group">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold shadow-md group-hover:shadow-lg transition-all">A</div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">Admin User</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">admin@enigmaticaura.com</p>
                </div>
                <span class="text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors">⋮</span>
            </div>
            <a href="/auth/logout" class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 hover:border-red-200 dark:hover:border-red-800 transition-all duration-200 text-sm font-medium">
                <span>🚪</span> Logout
            </a>
        </div>
    </aside>
    
    <!-- Main Area -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Top Header -->
        <header class="h-16 lg:h-20 glass-effect border-b border-gray-200 dark:border-gray-800 flex items-center justify-between px-4 lg:px-8 sticky top-0 z-30 shadow-sm">
            <div class="flex items-center gap-4">
                <button class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-500" onclick="toggleSidebar()">☰</button>
                <div class="hidden md:block relative group">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors">🔍</span>
                    <input type="text" placeholder="Search anything..." class="pl-10 pr-4 py-2.5 w-72 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none transition-all placeholder-gray-400">
                </div>
            </div>
            
            <div class="flex items-center gap-2 sm:gap-3">
                <button class="relative p-2.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-500 hover:text-blue-600 dark:hover:text-blue-400" title="Notifications">
                    🔔
                    <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 rounded-full ring-2 ring-white dark:ring-gray-900 animate-pulse"></span>
                </button>
                <button data-theme-toggle class="p-2.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-500 hover:text-blue-600 dark:hover:text-blue-400" title="Toggle theme">🌓</button>
                <div class="hidden sm:flex items-center gap-2 pl-3 border-l border-gray-200 dark:border-gray-700">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-md cursor-pointer hover:shadow-lg transition-all">A</div>
                </div>
            </div>
        </header>
        
        <!-- Page Content -->
        <main class="flex-1 p-4 lg:p-8 overflow-y-auto">
            <?= $this->renderSection('content') ?>
        </main>
        
        <!-- Footer -->
        <footer class="p-4 lg:p-8 text-center text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-800 glass-effect">
            &copy; <?= date('Y') ?> EnigmaticAura. Built with precision and care.
        </footer>
    </div>
</div>

<!-- Toast Container -->
<div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-2"></div>

<script src="<?= base_url('assets/js/app.js') ?>"></script>
<script>
// Sidebar toggle function
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const isClosed = sidebar.classList.contains('-translate-x-full');
    
    if (isClosed) {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        setTimeout(() => overlay.classList.remove('opacity-0'), 10);
    } else {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('opacity-0');
        setTimeout(() => overlay.classList.add('hidden'), 300);
    }
}

// Close sidebar on escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const sidebar = document.getElementById('sidebar');
        if (!sidebar.classList.contains('-translate-x-full')) {
            toggleSidebar();
        }
        // Also close any open modals
        document.querySelectorAll('[id$="-modal"]:not(.hidden)').forEach(modal => {
            closeModal(modal.id);
        });
    }
});

// Enhanced modal functions
window.openModal = (modalId) => {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    const content = modal.querySelector('[data-modal-content]');
    if (content) {
        content.classList.remove('modal-animate');
        void content.offsetWidth;
        content.classList.add('modal-animate');
    }
};

window.closeModal = (modalId) => {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    
    modal.classList.add('hidden');
    document.body.style.overflow = '';
};

// Show loading state on forms
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn && !submitBtn.disabled) {
            const originalContent = submitBtn.innerHTML;
            submitBtn.dataset.original = originalContent;
            submitBtn.innerHTML = '<span class="spinner w-4 h-4 inline-block mr-2"></span> Processing...';
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
        }
    });
});
</script>
<?= $this->endSection() ?>
</html>
