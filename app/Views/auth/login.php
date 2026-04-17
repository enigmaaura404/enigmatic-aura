<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Login') ?></title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>
<body class="bg-gray-950 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-block text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-brand-500 to-neon-purple">
                EnigmaticAura
            </a>
            <p class="text-gray-400 mt-2">Admin Dashboard Login</p>
        </div>

        <!-- Login Card -->
        <div class="bg-gray-900/50 backdrop-blur-xl rounded-2xl p-8 border border-gray-800 shadow-2xl">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/50 rounded-lg text-red-400 text-sm">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500/50 rounded-lg text-green-400 text-sm">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('auth/login/process') ?>" method="POST" class="space-y-6">
                <?= csrf_field() ?>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="<?= old('email') ?>"
                           required
                           class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-transparent text-white placeholder-gray-500 transition-all"
                           placeholder="admin@example.com">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required
                           class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-transparent text-white placeholder-gray-500 transition-all"
                           placeholder="••••••••">
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3 px-4 bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-400 text-white font-semibold rounded-lg shadow-lg hover:shadow-brand-500/25 transition-all duration-200 transform hover:-translate-y-0.5">
                    Sign In
                </button>
            </form>

            <!-- Demo Credentials -->
            <div class="mt-6 pt-6 border-t border-gray-800">
                <p class="text-xs text-gray-500 text-center">
                    Demo credentials: <code class="text-brand-400">admin@example.com</code> / <code class="text-brand-400">admin123</code>
                </p>
            </div>
        </div>

        <!-- Back Link -->
        <div class="text-center mt-6">
            <a href="/" class="text-sm text-gray-400 hover:text-brand-400 transition-colors">
                ← Back to Home
            </a>
        </div>
    </div>

    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>
