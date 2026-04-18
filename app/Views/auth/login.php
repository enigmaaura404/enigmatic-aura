<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Login') ?> - Admin Dashboard</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <style>
        @keyframes gradient { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        @keyframes pulse-glow { 0%, 100% { box-shadow: 0 0 20px rgba(59,130,246,0.3); } 50% { box-shadow: 0 0 40px rgba(59,130,246,0.6), 0 0 60px rgba(139,92,246,0.4); } }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .animate-gradient { background-size: 200% 200%; animation: gradient 15s ease infinite; }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
        .animate-fade-up { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .glass { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .dark .glass { background: rgba(17, 24, 39, 0.7); border: 1px solid rgba(255, 255, 255, 0.08); }
        .input-focus:focus { box-shadow: 0 0 0 3px rgba(59,130,246,0.2); }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-950 via-gray-900 to-black min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl animate-float" style="animation-delay: -3s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-r from-blue-500/5 to-purple-500/5 rounded-full blur-3xl animate-pulse-glow"></div>
    </div>

    <!-- Grid Pattern Overlay -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0icmdiYSgyNTUsMjU1LDI1NSwwLjAzKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyaWQpIi8+PC9zdmc+')] opacity-20"></div>

    <div class="w-full max-w-md relative z-10 animate-fade-up">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center gap-3 mb-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg shadow-blue-500/25 animate-pulse-glow">⚡</div>
            </div>
            <h1 class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400">EnigmaticAura</h1>
            <p class="text-gray-400 mt-2 text-sm">Admin Dashboard Login</p>
        </div>

        <!-- Login Card -->
        <div class="glass rounded-3xl p-8 shadow-2xl border border-gray-800/50">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/50 rounded-xl text-red-400 text-sm flex items-center gap-3 animate-fade-up">
                    <span class="text-lg">⚠️</span>
                    <span><?= esc(session()->getFlashdata('error')) ?></span>
                    <button onclick="this.parentElement.remove()" class="ml-auto hover:text-red-300 transition-colors">×</button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500/50 rounded-xl text-green-400 text-sm flex items-center gap-3 animate-fade-up">
                    <span class="text-lg">✓</span>
                    <span><?= esc(session()->getFlashdata('success')) ?></span>
                    <button onclick="this.parentElement.remove()" class="ml-auto hover:text-green-300 transition-colors">×</button>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('auth/login/process') ?>" method="POST" class="space-y-6" id="login-form">
                <?= csrf_field() ?>
                
                <!-- Email -->
                <div class="group">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2 flex items-center gap-2">
                        <span>📧</span> Email Address
                    </label>
                    <div class="relative">
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="<?= old('email') ?>"
                               required
                               autocomplete="email"
                               class="w-full px-4 py-3.5 bg-gray-800/50 border border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-gray-500 transition-all input-focus pr-12"
                               placeholder="admin@example.com">
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-blue-400 transition-colors">✉️</div>
                    </div>
                    <?php if (session()->has('errors.email')): ?>
                        <p class="mt-1.5 text-xs text-red-400 flex items-center gap-1"><span>⚠️</span> <?= esc(session()->getError('email')) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div class="group">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2 flex items-center gap-2">
                        <span>🔒</span> Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               autocomplete="current-password"
                               class="w-full px-4 py-3.5 bg-gray-800/50 border border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-gray-500 transition-all input-focus pr-12"
                               placeholder="••••••••">
                        <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 transition-colors" title="Show/Hide password">👁️</button>
                    </div>
                    <?php if (session()->has('errors.password')): ?>
                        <p class="mt-1.5 text-xs text-red-400 flex items-center gap-1"><span>⚠️</span> <?= esc(session()->getError('password')) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-700 bg-gray-800 text-blue-500 focus:ring-blue-500 focus:ring-offset-0 transition-all">
                        <span class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-blue-400 hover:text-blue-300 transition-colors font-medium">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        id="submit-btn"
                        class="w-full py-3.5 px-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold rounded-xl shadow-lg shadow-blue-500/25 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-xl hover:shadow-blue-500/30 flex items-center justify-center gap-2 group">
                    <span>Sign In</span>
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </button>
            </form>

            <!-- Demo Credentials -->
            <div class="mt-6 pt-6 border-t border-gray-800">
                <p class="text-xs text-gray-500 text-center mb-3">Demo credentials</p>
                <div class="flex items-center justify-center gap-3">
                    <code class="text-xs px-3 py-1.5 bg-gray-800/50 border border-gray-700 rounded-lg text-blue-400">admin@example.com</code>
                    <span class="text-gray-600">/</span>
                    <code class="text-xs px-3 py-1.5 bg-gray-800/50 border border-gray-700 rounded-lg text-blue-400">admin123</code>
                </div>
            </div>
        </div>

        <!-- Back Link -->
        <div class="text-center mt-6">
            <a href="/" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-blue-400 transition-colors group">
                <span class="group-hover:-translate-x-1 transition-transform">←</span> Back to Home
            </a>
        </div>

        <!-- Footer Text -->
        <p class="text-center text-xs text-gray-600 mt-8">© <?= date('Y') ?> EnigmaticAura. Secure admin access.</p>
    </div>

    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        // Form submission loading state
        document.getElementById('login-form')?.addEventListener('submit', function(e) {
            const btn = document.getElementById('submit-btn');
            btn.innerHTML = '<span class="animate-spin">⏳</span> Signing in...';
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
        });

        // Auto-hide flash messages
        setTimeout(() => {
            document.querySelectorAll('[onclick*="remove"]').forEach(el => {
                el.closest('.bg-red-500\\/10, .bg-green-500\\/10')?.remove();
            });
        }, 5000);
    </script>
</body>
</html>
