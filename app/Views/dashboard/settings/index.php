<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white"><?= esc($title ?? 'Settings') ?></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your account settings and preferences</p>
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

    <!-- Settings Navigation Tabs -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="flex overflow-x-auto" aria-label="Settings tabs">
                <button onclick="switchTab('profile')" data-tab="profile" class="tab-button active px-6 py-4 text-sm font-medium whitespace-nowrap border-b-2 border-blue-500 text-blue-600 dark:text-blue-400 transition-all">
                    👤 Profile Information
                </button>
                <button onclick="switchTab('security')" data-tab="security" class="tab-button px-6 py-4 text-sm font-medium whitespace-nowrap border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-all">
                    🔐 Security & Password
                </button>
                <button onclick="switchTab('recovery')" data-tab="recovery" class="tab-button px-6 py-4 text-sm font-medium whitespace-nowrap border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-all">
                    📧 Recovery Options
                </button>
                <button onclick="switchTab('2fa')" data-tab="2fa" class="tab-button px-6 py-4 text-sm font-medium whitespace-nowrap border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-all">
                    🛡️ Two-Factor Auth
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
            <!-- Profile Tab -->
            <div id="profile-tab" class="tab-content space-y-6">
                <div class="flex items-center gap-4 pb-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                        <?= strtoupper(substr($user['name'] ?? 'A', 0, 1)) ?>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white"><?= esc($user['name'] ?? 'Admin User') ?></h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400"><?= esc($user['email'] ?? 'admin@example.com') ?></p>
                        <button class="mt-2 text-sm text-blue-600 dark:text-blue-400 hover:underline font-medium">Change Avatar</button>
                    </div>
                </div>

                <form action="/admin/settings/profile" method="POST" class="space-y-5">
                    <?= csrf_field() ?>
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label for="profile-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="profile-name" value="<?= esc($user['name'] ?? '') ?>" required
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                                   placeholder="Your full name">
                        </div>
                        <div>
                            <label for="profile-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="profile-email" value="<?= esc($user['email'] ?? '') ?>" required
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                                   placeholder="your@email.com">
                        </div>
                    </div>
                    <div>
                        <label for="profile-phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            📱 Phone Number
                        </label>
                        <input type="tel" name="phone" id="profile-phone" value="<?= esc($user['phone'] ?? '') ?>"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                               placeholder="+1 (555) 123-4567">
                        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Optional. Used for account recovery.</p>
                    </div>
                    <div>
                        <label for="profile-bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            📝 Bio / About
                        </label>
                        <textarea name="bio" id="profile-bio" rows="4" maxlength="500"
                                  class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none placeholder-gray-400"
                                  placeholder="Tell us a bit about yourself..."><?= esc($user['bio'] ?? '') ?></textarea>
                        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400 text-right"><span id="bio-count">0</span>/500 characters</p>
                    </div>
                    <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all transform hover:scale-105">
                            💾 Save Profile
                        </button>
                    </div>
                </form>
            </div>

            <!-- Security Tab -->
            <div id="security-tab" class="tab-content hidden space-y-6">
                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl">
                    <div class="flex items-start gap-3">
                        <span class="text-xl">🔒</span>
                        <div>
                            <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300">Password Requirements</h4>
                            <ul class="mt-2 text-xs text-blue-700 dark:text-blue-400 space-y-1">
                                <li>• At least 8 characters long</li>
                                <li>• Include uppercase and lowercase letters</li>
                                <li>• Include at least one number</li>
                                <li>• Include at least one special character</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <form action="/admin/settings/password" method="POST" class="space-y-5">
                    <?= csrf_field() ?>
                    <div>
                        <label for="current-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Current Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="current_password" id="current-password" required
                                   class="w-full px-4 py-2.5 pr-12 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                                   placeholder="Enter current password">
                            <button type="button" onclick="togglePassword('current-password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                👁️
                            </button>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label for="new-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                New Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="password" name="new_password" id="new-password" required minlength="8"
                                       oninput="checkPasswordStrength(this.value)"
                                       class="w-full px-4 py-2.5 pr-12 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                                       placeholder="Enter new password">
                                <button type="button" onclick="togglePassword('new-password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                    👁️
                                </button>
                            </div>
                            <div id="password-strength" class="mt-2 hidden">
                                <div class="flex gap-1 h-1.5 mb-1">
                                    <div class="strength-bar flex-1 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                                    <div class="strength-bar flex-1 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                                    <div class="strength-bar flex-1 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                                    <div class="strength-bar flex-1 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400" id="strength-text">Password strength: <span class="font-medium">-</span></p>
                            </div>
                        </div>
                        <div>
                            <label for="confirm-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="password" name="confirm_password" id="confirm-password" required minlength="8"
                                       class="w-full px-4 py-2.5 pr-12 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                                       placeholder="Confirm new password">
                                <button type="button" onclick="togglePassword('confirm-password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                    👁️
                                </button>
                            </div>
                            <p id="password-match" class="mt-1.5 text-xs hidden"></p>
                        </div>
                    </div>
                    <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all transform hover:scale-105">
                            🔐 Update Password
                        </button>
                    </div>
                </form>
            </div>

            <!-- Recovery Tab -->
            <div id="recovery-tab" class="tab-content hidden space-y-6">
                <div class="p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl">
                    <div class="flex items-start gap-3">
                        <span class="text-xl">📧</span>
                        <div>
                            <h4 class="text-sm font-semibold text-amber-800 dark:text-amber-300">Recovery Email</h4>
                            <p class="mt-1 text-xs text-amber-700 dark:text-amber-400">Add a backup email address to recover your account if you lose access to your primary email.</p>
                        </div>
                    </div>
                </div>

                <form action="/admin/settings/recovery" method="POST" class="space-y-5">
                    <?= csrf_field() ?>
                    <div>
                        <label for="recovery-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            📧 Recovery Email Address
                        </label>
                        <input type="email" name="recovery_email" id="recovery-email" value="<?= esc($user['recovery_email'] ?? '') ?>"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                               placeholder="backup@email.com">
                        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">We'll send a verification code to this email.</p>
                    </div>
                    <div id="verification-section" class="hidden">
                        <label for="verification-code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            🔢 Verification Code
                        </label>
                        <div class="flex gap-3">
                            <input type="text" name="verification_code" id="verification-code" maxlength="6"
                                   class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-center text-lg tracking-widest"
                                   placeholder="000000">
                            <button type="button" onclick="sendVerificationCode()" class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                Send Code
                            </button>
                        </div>
                        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Code expires in 10 minutes.</p>
                    </div>
                    <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all transform hover:scale-105">
                            💾 Save Recovery Email
                        </button>
                    </div>
                </form>
            </div>

            <!-- 2FA Tab -->
            <div id="2fa-tab" class="tab-content hidden space-y-6">
                <div class="p-5 bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800 rounded-xl">
                    <div class="flex items-start gap-3">
                        <span class="text-2xl">🛡️</span>
                        <div>
                            <h4 class="text-base font-bold text-green-800 dark:text-green-300">Two-Factor Authentication</h4>
                            <p class="mt-1 text-sm text-green-700 dark:text-green-400">Add an extra layer of security to your account. Even if someone knows your password, they won't be able to access your account without the 2FA code.</p>
                        </div>
                    </div>
                </div>

                <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/10 to-indigo-500/10 flex items-center justify-center text-2xl">
                                📱
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">Authenticator App</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Use Google Authenticator, Authy, or similar apps</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="2fa-toggle" class="sr-only peer" onchange="toggle2FA()">
                            <div class="w-14 h-7 bg-gray-200 dark:bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                    
                    <div id="2fa-setup" class="hidden mt-5 pt-5 border-t border-gray-200 dark:border-gray-700">
                        <div class="text-center mb-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Scan this QR code with your authenticator app</p>
                            <div class="w-48 h-48 mx-auto bg-white rounded-xl p-2 shadow-lg">
                                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                    [QR Code Placeholder]
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="2fa-code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Enter 6-digit code from your app
                            </label>
                            <input type="text" name="2fa_code" id="2fa-code" maxlength="6"
                                   class="w-full max-w-xs mx-auto block px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-center text-lg tracking-widest"
                                   placeholder="000000">
                        </div>
                        <div class="mt-4 text-center">
                            <button type="button" onclick="verify2FA()" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all">
                                Verify & Enable 2FA
                            </button>
                        </div>
                    </div>
                </div>

                <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500/10 to-orange-500/10 flex items-center justify-center text-2xl">
                                🔑
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">Backup Codes</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Download backup codes for emergency access</p>
                            </div>
                        </div>
                        <button type="button" onclick="downloadBackupCodes()" class="px-4 py-2 text-sm font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors">
                            📥 Download
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Tab Switching
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Reset all tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-blue-500', 'text-blue-600', 'dark:text-blue-400');
        button.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');
    });
    
    // Show selected tab content
    document.getElementById(tabName + '-tab').classList.remove('hidden');
    
    // Activate selected tab button
    const activeButton = document.querySelector(`[data-tab="${tabName}"]`);
    activeButton.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');
    activeButton.classList.add('active', 'border-blue-500', 'text-blue-600', 'dark:text-blue-400');
}

// Toggle Password Visibility
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    input.type = input.type === 'password' ? 'text' : 'password';
}

// Password Strength Checker
function checkPasswordStrength(password) {
    const strengthDiv = document.getElementById('password-strength');
    const bars = strengthDiv.querySelectorAll('.strength-bar');
    const strengthText = document.getElementById('strength-text');
    
    let strength = 0;
    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
    if (/\d/.test(password)) strength++;
    if (/[^a-zA-Z0-9]/.test(password)) strength++;
    
    strengthDiv.classList.remove('hidden');
    
    const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-green-500'];
    const texts = ['Weak', 'Fair', 'Good', 'Strong'];
    
    bars.forEach((bar, index) => {
        bar.classList.remove('bg-gray-200', 'dark:bg-gray-700', ...colors);
        if (index < strength) {
            bar.classList.add(colors[Math.min(index, 3)]);
        } else {
            bar.classList.add('bg-gray-200', 'dark:bg-gray-700');
        }
    });
    
    strengthText.innerHTML = `Password strength: <span class="font-medium ${strength <= 2 ? 'text-red-500' : 'text-green-500'}">${texts[strength - 1] || '-'}</span>`;
    
    // Check password match
    const confirmPassword = document.getElementById('confirm-password').value;
    checkPasswordMatch(password, confirmPassword);
}

// Password Match Checker
function checkPasswordMatch(password, confirmPassword) {
    const matchText = document.getElementById('password-match');
    if (confirmPassword) {
        matchText.classList.remove('hidden');
        if (password === confirmPassword) {
            matchText.textContent = '✓ Passwords match';
            matchText.className = 'mt-1.5 text-xs text-green-600 dark:text-green-400';
        } else {
            matchText.textContent = '✗ Passwords do not match';
            matchText.className = 'mt-1.5 text-xs text-red-600 dark:text-red-400';
        }
    } else {
        matchText.classList.add('hidden');
    }
}

document.getElementById('confirm-password')?.addEventListener('input', function() {
    const newPassword = document.getElementById('new-password').value;
    checkPasswordMatch(newPassword, this.value);
});

// Bio Character Counter
const bioTextarea = document.getElementById('profile-bio');
const bioCount = document.getElementById('bio-count');
if (bioTextarea && bioCount) {
    bioCount.textContent = bioTextarea.value.length;
    bioTextarea.addEventListener('input', () => {
        bioCount.textContent = bioTextarea.value.length;
    });
}

// Toggle 2FA Setup
function toggle2FA() {
    const toggle = document.getElementById('2fa-toggle');
    const setupDiv = document.getElementById('2fa-setup');
    setupDiv.classList.toggle('hidden', !toggle.checked);
}

// Send Verification Code
function sendVerificationCode() {
    showFlashMessage('info', 'Verification code sent to your email!');
}

// Verify 2FA
function verify2FA() {
    showFlashMessage('success', '2FA enabled successfully!');
}

// Download Backup Codes
function downloadBackupCodes() {
    showFlashMessage('info', 'Backup codes downloaded!');
}

// Show Flash Message
function showFlashMessage(type, message) {
    const flashContainer = document.createElement('div');
    const bgColors = {
        success: 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800 text-green-700 dark:text-green-400',
        error: 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800 text-red-700 dark:text-red-400',
        info: 'bg-blue-50 dark:bg-blue-900/20 border-blue-200 dark:border-blue-800 text-blue-700 dark:text-blue-400'
    };
    const icons = { success: '✓', error: '⚠', info: 'ℹ' };
    
    flashContainer.className = `fixed top-4 right-4 z-50 flex items-center gap-3 p-4 ${bgColors[type]} border rounded-xl shadow-lg animate-fade-up`;
    flashContainer.innerHTML = `
        <span class="text-xl">${icons[type]}</span>
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
