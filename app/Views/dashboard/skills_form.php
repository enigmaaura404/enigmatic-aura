<?php
// Helper function for skill level colors
if (!function_exists('getLevelColor')) {
    function getLevelColor($level) {
        if ($level >= 80) return 'bg-green-500';
        if ($level >= 60) return 'bg-blue-500';
        if ($level >= 40) return 'bg-yellow-500';
        return 'bg-red-500';
    }
}

$skill = $skill ?? null;
$isEdit = $skill !== null;
$categories = $categories ?? ['Frontend', 'Backend', 'CSS', 'Language', 'Database', 'DevOps', 'Tools', 'Other'];
?>

<form id="skill-form" onsubmit="event.preventDefault(); submitSkillForm(this, <?= $isEdit ? 'true, ' . $skill['id'] : 'false' ?>);" class="space-y-4">
    <!-- Name Field -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Skill Name <span class="text-red-500">*</span>
        </label>
        <input type="text" name="name" id="name" value="<?= esc($skill['name'] ?? '') ?>" 
               placeholder="e.g., React, TypeScript, Node.js"
               required minlength="2" maxlength="100"
               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
        <p id="name-error" class="mt-1 text-xs text-red-500"></p>
    </div>

    <!-- Category Field -->
    <div>
        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Category <span class="text-red-500">*</span>
        </label>
        <select name="category" id="category" required
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
            <option value="">Select a category</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= esc($cat) ?>" <?= ($skill['category'] ?? '') === $cat ? 'selected' : '' ?>><?= esc($cat) ?></option>
            <?php endforeach; ?>
        </select>
        <p id="category-error" class="mt-1 text-xs text-red-500"></p>
    </div>

    <!-- Level Field -->
    <div>
        <label for="level" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Proficiency Level <span class="text-red-500">*</span>
        </label>
        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-500 dark:text-gray-400">Beginner</span>
                <span class="text-xs text-gray-500 dark:text-gray-400">Expert</span>
            </div>
            <div class="flex items-center gap-4">
                <input type="range" name="level" id="level" min="0" max="100" value="<?= esc($skill['level'] ?? 50) ?>" 
                       oninput="document.getElementById('level-value').textContent = this.value"
                       class="flex-1 h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-brand-500">
                <div class="w-14 h-10 flex items-center justify-center rounded-lg bg-brand-50 dark:bg-brand-900/20 border border-brand-200 dark:border-brand-800">
                    <span id="level-value" class="text-lg font-bold text-brand-600 dark:text-brand-400"><?= esc($skill['level'] ?? 50) ?></span>
                </div>
            </div>
        </div>
        <p id="level-error" class="mt-1 text-xs text-red-500"></p>
    </div>

    <!-- Icon Field -->
    <div>
        <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Icon (Emoji or Class)
        </label>
        <input type="text" name="icon" id="icon" value="<?= esc($skill['icon'] ?? '') ?>" 
               placeholder="e.g., ⚛️ or fa-react"
               maxlength="50"
               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Optional - displays in the skills list</p>
        <p id="icon-error" class="mt-1 text-xs text-red-500"></p>
    </div>

    <!-- Description Field -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Description
        </label>
        <textarea name="description" id="description" rows="3" maxlength="500"
                  placeholder="Brief description of your experience with this skill..."
                  class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all resize-none"><?= esc($skill['description'] ?? '') ?></textarea>
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 text-right"><span id="desc-count">0</span>/500</p>
        <p id="description-error" class="mt-1 text-xs text-red-500"></p>
    </div>

    <!-- Sort Order & Active Status Row -->
    <div class="grid grid-cols-2 gap-4">
        <!-- Sort Order -->
        <div>
            <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                Sort Order
            </label>
            <input type="number" name="sort_order" id="sort_order" value="<?= esc($skill['sort_order'] ?? 0) ?>" 
                   min="0" placeholder="0"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Lower numbers appear first</p>
            <p id="sort_order-error" class="mt-1 text-xs text-red-500"></p>
        </div>

        <!-- Active Status -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                Status
            </label>
            <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                <input type="checkbox" name="is_active" value="1" <?= ($skill['is_active'] ?? 1) ? 'checked' : '' ?>
                       class="w-5 h-5 rounded border-gray-300 text-brand-500 focus:ring-brand-500">
                <span class="text-sm text-gray-700 dark:text-gray-300">Active / Visible</span>
            </label>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="flex gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <button type="button" onclick="closeModal()" 
                class="flex-1 px-4 py-2.5 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
            Cancel
        </button>
        <button type="submit" 
                class="flex-1 px-4 py-2.5 bg-gradient-to-r from-brand-500 to-brand-600 hover:from-brand-600 hover:to-brand-700 text-white font-medium rounded-xl shadow-lg shadow-brand-500/25 transition-all transform hover:scale-105">
            <?= $isEdit ? '💾 Update Skill' : '✨ Create Skill' ?>
        </button>
    </div>
</form>

<script>
// Character counter for description
const descTextarea = document.getElementById('description');
const descCount = document.getElementById('desc-count');
if (descTextarea && descCount) {
    descCount.textContent = descTextarea.value.length;
    descTextarea.addEventListener('input', () => {
        descCount.textContent = descTextarea.value.length;
    });
}

// Level slider color update
const levelSlider = document.getElementById('level');
if (levelSlider) {
    function updateSliderColor() {
        const value = parseInt(levelSlider.value);
        const percentage = (value - levelSlider.min) / (levelSlider.max - levelSlider.min) * 100;
        levelSlider.style.background = `linear-gradient(to right, #3b82f6 0%, #3b82f6 ${percentage}%, #e5e7eb ${percentage}%, #e5e7eb 100%)`;
    }
    updateSliderColor();
    levelSlider.addEventListener('input', updateSliderColor);
}
</script>
