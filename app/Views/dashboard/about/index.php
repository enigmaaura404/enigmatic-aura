<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="space-y-6">
  <!-- Enhanced Page Header -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6 border-b border-gray-200 dark:border-gray-700">
    <div class="flex items-center gap-3">
      <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/10 to-indigo-500/10 flex items-center justify-center text-2xl">👤</div>
      <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white"><?= esc($title ?? 'About Section') ?></h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage your personal information and bio</p>
      </div>
    </div>
    <button onclick="saveAbout()" class="group px-5 py-2.5 bg-gradient-to-r from-brand-600 via-brand-500 to-brand-600 hover:from-brand-500 hover:via-brand-400 hover:to-brand-500 text-white rounded-xl text-sm font-semibold transition-all duration-300 shadow-lg shadow-brand-500/25 hover:shadow-xl hover:shadow-brand-500/30 flex items-center gap-2 transform hover:scale-105">
      <span>💾</span> Save Changes
    </button>
  </div>

  <!-- Stats Overview -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 dark:text-gray-400">Profile Views</p>
          <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">2,847</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/10 to-blue-500/5 flex items-center justify-center text-2xl">👁️</div>
      </div>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-l-4 border-l-emerald-500 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 dark:text-gray-400">Completion</p>
          <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">95%</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500/10 to-emerald-500/5 flex items-center justify-center text-2xl">✓</div>
      </div>
    </div>
    <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-l-4 border-l-purple-500 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 dark:text-gray-400">Last Updated</p>
          <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 mt-1">2d ago</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/10 to-purple-500/5 flex items-center justify-center text-2xl">📅</div>
      </div>
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

  <!-- Profile Form Grid -->
  <div class="grid lg:grid-cols-3 gap-6">
    <!-- Left Column - Profile Image -->
    <div class="lg:col-span-1">
      <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-6 sticky top-6">
        <div class="text-center">
          <div class="relative inline-block group">
            <div class="w-32 h-32 mx-auto rounded-full bg-gradient-to-br from-brand-400 to-neon-purple p-1 shadow-xl group-hover:shadow-2xl transition-shadow">
              <img src="<?= esc($about['image'] ?? '/uploads/profile.jpg') ?>" alt="Profile" class="w-full h-full rounded-full object-cover bg-gray-100">
            </div>
            <label for="profile-upload" class="absolute bottom-0 right-0 w-10 h-10 bg-brand-500 hover:bg-brand-600 text-white rounded-full flex items-center justify-center cursor-pointer shadow-lg transform group-hover:scale-110 transition-all">
              📷
            </label>
            <input type="file" id="profile-upload" accept="image/*" class="hidden" onchange="previewImage(this)">
          </div>
          
          <h3 class="mt-4 text-lg font-bold text-gray-900 dark:text-white"><?= esc($about['name'] ?? 'Your Name') ?></h3>
          <p class="text-sm text-gray-500 dark:text-gray-400 mt-1"><?= esc($about['title'] ?? 'Your Title') ?></p>
          
          <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex justify-center gap-3">
              <a href="#" class="p-2.5 text-gray-500 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/20 rounded-lg transition-all">📘</a>
              <a href="#" class="p-2.5 text-gray-500 hover:text-sky-500 dark:hover:text-sky-400 hover:bg-sky-50 dark:hover:bg-sky-900/20 rounded-lg transition-all">🐦</a>
              <a href="#" class="p-2.5 text-gray-500 hover:text-pink-600 dark:hover:text-pink-400 hover:bg-pink-50 dark:hover:bg-pink-900/20 rounded-lg transition-all">📸</a>
              <a href="#" class="p-2.5 text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all">💼</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Column - Form Fields -->
    <div class="lg:col-span-2 space-y-6">
      <!-- Basic Information -->
      <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-5 flex items-center gap-2">
          <span>👤</span> Basic Information
        </h3>
        <div class="grid md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name *</label>
            <input type="text" name="name" value="<?= esc($about['name'] ?? '') ?>" required
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Professional Title *</label>
            <input type="text" name="title" value="<?= esc($about['title'] ?? '') ?>" required
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address *</label>
            <input type="email" name="email" value="<?= esc($about['email'] ?? '') ?>" required
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
            <input type="tel" name="phone" value="<?= esc($about['phone'] ?? '') ?>"
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Location</label>
            <input type="text" name="location" value="<?= esc($about['location'] ?? '') ?>" placeholder="e.g., Jakarta, Indonesia"
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Website</label>
            <input type="url" name="website" value="<?= esc($about['website'] ?? '') ?>" placeholder="https://yourwebsite.com"
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
          </div>
        </div>
      </div>

      <!-- Bio Section -->
      <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-5 flex items-center gap-2">
          <span>📝</span> Professional Bio
        </h3>
        <div class="space-y-5">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Short Bio *</label>
            <textarea name="short_bio" rows="3" required maxlength="200"
                      placeholder="A brief introduction about yourself..."
                      class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all resize-none"><?= esc($about['short_bio'] ?? '') ?></textarea>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5 text-right"><span id="short-bio-count">0</span>/200 characters</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Bio *</label>
            <textarea name="full_bio" rows="6" required maxlength="1000"
                      placeholder="Tell your complete story, experience, and what makes you unique..."
                      class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all resize-none"><?= esc($about['full_bio'] ?? '') ?></textarea>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5 text-right"><span id="full-bio-count">0</span>/1000 characters</p>
          </div>
        </div>
      </div>

      <!-- Social Links -->
      <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-5 flex items-center gap-2">
          <span>🔗</span> Social Media Links
        </h3>
        <div class="grid md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
              <span>📘</span> Facebook
            </label>
            <input type="url" name="facebook" value="<?= esc($about['facebook'] ?? '') ?>" placeholder="https://facebook.com/yourprofile"
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
              <span>🐦</span> Twitter/X
            </label>
            <input type="url" name="twitter" value="<?= esc($about['twitter'] ?? '') ?>" placeholder="https://twitter.com/yourhandle"
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
              <span>📸</span> Instagram
            </label>
            <input type="url" name="instagram" value="<?= esc($about['instagram'] ?? '') ?>" placeholder="https://instagram.com/yourhandle"
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
              <span>💼</span> LinkedIn
            </label>
            <input type="url" name="linkedin" value="<?= esc($about['linkedin'] ?? '') ?>" placeholder="https://linkedin.com/in/yourprofile"
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
              <span>🐙</span> GitHub
            </label>
            <input type="url" name="github" value="<?= esc($about['github'] ?? '') ?>" placeholder="https://github.com/yourusername"
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
              <span>🎨</span> Dribbble
            </label>
            <input type="url" name="dribbble" value="<?= esc($about['dribbble'] ?? '') ?>" placeholder="https://dribbble.com/yourprofile"
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Character counters
document.querySelectorAll('textarea').forEach(textarea => {
  textarea.addEventListener('input', function() {
    const countSpan = document.getElementById(this.name + '-count');
    if (countSpan) {
      countSpan.textContent = this.value.length;
    }
  });
  
  // Initialize counters
  const countSpan = document.getElementById(textarea.name + '-count');
  if (countSpan) {
    countSpan.textContent = textarea.value.length;
  }
});

function previewImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      input.previousElementSibling.querySelector('img').src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
    showToast('Image selected! Click Save to upload.', 'info');
  }
}

function saveAbout() {
  // In production, collect form data and send via AJAX
  showToast('Profile updated successfully!', 'success');
}
</script>

<?= $this->endSection() ?>
