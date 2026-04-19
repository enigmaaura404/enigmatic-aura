<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Login') ?> - Admin Dashboard</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <style>
        @keyframes gradient { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        @keyframes float { 0%, 100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-20px) rotate(5deg); } }
        @keyframes pulse-glow { 0%, 100% { box-shadow: 0 0 20px rgba(59,130,246,0.3); } 50% { box-shadow: 0 0 40px rgba(59,130,246,0.6), 0 0 60px rgba(139,92,246,0.4); } }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideInRight { from { opacity: 0; transform: translateX(100%); } to { opacity: 1; transform: translateX(0); } }
        @keyframes slideOutRight { from { opacity: 1; transform: translateX(0); } to { opacity: 0; transform: translateX(100%); } }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); } 20%, 40%, 60%, 80% { transform: translateX(5px); } }
        
        .animate-gradient { background-size: 200% 200%; animation: gradient 15s ease infinite; }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
        .animate-fade-up { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-shake { animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97); }
        
        .glass { 
            background: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(20px); 
            -webkit-backdrop-filter: blur(20px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
        }
        .dark .glass { background: rgba(17, 24, 39, 0.7); border: 1px solid rgba(255, 255, 255, 0.08); }
        
        .input-focus:focus { box-shadow: 0 0 0 3px rgba(59,130,246,0.2); outline: none; }
        .input-error { border-color: rgb(239, 68, 68) !important; box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2) !important; }
        .input-success { border-color: rgb(34, 197, 94) !important; box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2) !important; }
        
        /* Toast Notification */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .toast {
            min-width: 320px;
            max-width: 400px;
            padding: 16px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideInRight 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            border: 1px solid;
            position: relative;
            overflow: hidden;
        }
        .toast.toast-hide { animation: slideOutRight 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .toast-success { 
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.95), rgba(22, 163, 74, 0.95)); 
            border-color: rgba(34, 197, 94, 0.3);
            color: white;
        }
        .toast-error { 
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.95), rgba(185, 28, 28, 0.95)); 
            border-color: rgba(239, 68, 68, 0.3);
            color: white;
        }
        .toast-warning { 
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.95), rgba(217, 119, 6, 0.95)); 
            border-color: rgba(245, 158, 11, 0.3);
            color: white;
        }
        .toast-info { 
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.95), rgba(37, 99, 235, 0.95)); 
            border-color: rgba(59, 130, 246, 0.3);
            color: white;
        }
        .toast-icon { font-size: 20px; flex-shrink: 0; }
        .toast-message { flex: 1; font-size: 14px; line-height: 1.4; }
        .toast-close {
            background: transparent;
            border: none;
            color: inherit;
            cursor: pointer;
            padding: 4px;
            font-size: 18px;
            opacity: 0.7;
            transition: opacity 0.2s;
            flex-shrink: 0;
        }
        .toast-close:hover { opacity: 1; }
        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: rgba(255,255,255,0.3);
            animation: progress linear forwards;
        }
        
        /* Loading Spinner */
        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        
        /* Responsive adjustments */
        @media (max-width: 640px) {
            .toast { min-width: auto; max-width: calc(100vw - 40px); margin: 0 10px; }
            .toast-container { left: 0; right: 0; align-items: center; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-950 via-gray-900 to-black min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl animate-float" style="animation-delay: -3s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-r from-blue-500/5 to-purple-500/5 rounded-full blur-3xl animate-pulse-glow"></div>
    </div>

    <!-- Grid Pattern Overlay -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0icmdiYSgyNTUsMjU1LDI1NSwwLjAzKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyaWQpIi8+PC9zdmc+')] opacity-20"></div>

    <!-- Toast Notification Container -->
    <div class="toast-container" id="toast-container"></div>

    <div class="w-full max-w-md relative z-10 animate-fade-up">
        <!-- Logo Section -->
        <div class="text-center mb-6 sm:mb-8">
            <div class="inline-flex items-center justify-center gap-3 mb-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg shadow-blue-500/25 animate-pulse-glow">⚡</div>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400">EnigmaticAura</h1>
            <p class="text-gray-400 mt-2 text-xs sm:text-sm">Admin Dashboard Login</p>
        </div>

        <!-- Login Card -->
        <div class="glass rounded-2xl sm:rounded-3xl p-5 sm:p-6 md:p-8 shadow-2xl border border-gray-800/50">
            <form action="<?= site_url('auth/login/process') ?>" method="POST" class="space-y-5 sm:space-y-6" id="login-form">
                <?= csrf_field() ?>
                
                <!-- Email -->
                <div class="group">
                    <label for="email" class="block text-xs sm:text-sm font-medium text-gray-300 mb-2 flex items-center gap-2">
                        <span>📧</span> Email Address
                    </label>
                    <div class="relative">
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="<?= old('email') ?>"
                               required
                               autocomplete="email"
                               class="w-full px-4 py-3 sm:py-3.5 bg-gray-800/50 border border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-gray-500 transition-all input-focus pr-12 text-sm sm:text-base"
                               placeholder="admin@example.com">
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-blue-400 transition-colors">✉️</div>
                    </div>
                    <?php if (session()->has('errors.email')): ?>
                        <p class="mt-1.5 text-xs text-red-400 flex items-center gap-1"><span>⚠️</span> <?= esc(session()->getError('email')) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div class="group">
                    <label for="password" class="block text-xs sm:text-sm font-medium text-gray-300 mb-2 flex items-center gap-2">
                        <span>🔒</span> Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               autocomplete="current-password"
                               class="w-full px-4 py-3 sm:py-3.5 bg-gray-800/50 border border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-gray-500 transition-all input-focus pr-12 text-sm sm:text-base"
                               placeholder="••••••••">
                        <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 transition-colors" title="Show/Hide password">👁️</button>
                    </div>
                    <?php if (session()->has('errors.password')): ?>
                        <p class="mt-1.5 text-xs text-red-400 flex items-center gap-1"><span>⚠️</span> <?= esc(session()->getError('password')) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between flex-wrap gap-2">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-700 bg-gray-800 text-blue-500 focus:ring-blue-500 focus:ring-offset-0 transition-all">
                        <span class="text-xs sm:text-sm text-gray-400 group-hover:text-gray-300 transition-colors">Remember me</span>
                    </label>
                    <a href="#" class="text-xs sm:text-sm text-blue-400 hover:text-blue-300 transition-colors font-medium">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        id="submit-btn"
                        class="w-full py-3 sm:py-3.5 px-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold rounded-xl shadow-lg shadow-blue-500/25 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-xl hover:shadow-blue-500/30 flex items-center justify-center gap-2 group text-sm sm:text-base">
                    <span>Sign In</span>
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </button>
            </form>

            <!-- Demo Credentials -->
            <div class="mt-5 sm:mt-6 pt-5 sm:pt-6 border-t border-gray-800">
                <p class="text-xs text-gray-500 text-center mb-3">Demo credentials</p>
                <div class="flex items-center justify-center gap-2 sm:gap-3 flex-wrap">
                    <code class="text-xs px-2.5 sm:px-3 py-1.5 bg-gray-800/50 border border-gray-700 rounded-lg text-blue-400">admin@example.com</code>
                    <span class="text-gray-600">/</span>
                    <code class="text-xs px-2.5 sm:px-3 py-1.5 bg-gray-800/50 border border-gray-700 rounded-lg text-blue-400">admin123</code>
                </div>
            </div>
        </div>

        <!-- Back Link -->
        <div class="text-center mt-5 sm:mt-6">
            <a href="/" class="inline-flex items-center gap-2 text-xs sm:text-sm text-gray-400 hover:text-blue-400 transition-colors group">
                <span class="group-hover:-translate-x-1 transition-transform">←</span> Back to Home
            </a>
        </div>

        <!-- Footer Text -->
        <p class="text-center text-[10px] sm:text-xs text-gray-600 mt-6 sm:mt-8">© <?= date('Y') ?> EnigmaticAura. Secure admin access.</p>
    </div>

    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script>
        // Toast Notification System
        function showToast(message, type = 'info', duration = 5000) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            
            const icons = {
                success: '✓',
                error: '⚠️',
                warning: '⚡',
                info: 'ℹ️'
            };
            
            toast.className = `toast toast-${type}`;
            toast.innerHTML = `
                <span class="toast-icon">${icons[type] || icons.info}</span>
                <span class="toast-message">${message}</span>
                <button class="toast-close" onclick="this.parentElement.remove()">×</button>
                <div class="toast-progress" style="animation-duration: ${duration}ms"></div>
            `;
            
            container.appendChild(toast);
            
            // Auto-remove after duration
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.classList.add('toast-hide');
                    setTimeout(() => toast.remove(), 300);
                }
            }, duration);
        }
        
        // Show flash messages as toasts
        <?php if (session()->getFlashdata('error')): ?>
            showToast(<?= json_encode(session()->getFlashdata('error')) ?>, 'error');
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('success')): ?>
            showToast(<?= json_encode(session()->getFlashdata('success')) ?>, 'success');
        <?php endif; ?>

        function togglePassword() {
            const input = document.getElementById('password');
            const icon = event.currentTarget;
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.textContent = input.type === 'password' ? '👁️' : '🙈';
        }

        // Form validation and submission
        document.getElementById('login-form')?.addEventListener('submit', function(e) {
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const btn = document.getElementById('submit-btn');
            let isValid = true;
            
            // Reset previous states
            email.classList.remove('input-error', 'input-success');
            password.classList.remove('input-error', 'input-success');
            
            // Validate email
            if (!email.value || !email.value.includes('@')) {
                email.classList.add('input-error');
                isValid = false;
            } else {
                email.classList.add('input-success');
            }
            
            // Validate password
            if (!password.value || password.value.length < 6) {
                password.classList.add('input-error');
                isValid = false;
            } else {
                password.classList.add('input-success');
            }
            
            if (!isValid) {
                e.preventDefault();
                showToast('Please fill in all fields correctly', 'warning');
                
                // Remove error/success states after animation
                setTimeout(() => {
                    email.classList.remove('input-error', 'input-success');
                    password.classList.remove('input-error', 'input-success');
                }, 2000);
                
                return false;
            }
            
            // Show loading state
            btn.innerHTML = '<span class="spinner"></span> Signing in...';
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
        });
        
        // Add Enter key support for form submission
        document.querySelectorAll('#login-form input').forEach(input => {
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.getElementById('login-form').requestSubmit();
                }
            });
        });
        
        // Focus first input on page load
        window.addEventListener('load', () => {
            document.getElementById('email')?.focus();
        });
    </script>
</body>
</html>
