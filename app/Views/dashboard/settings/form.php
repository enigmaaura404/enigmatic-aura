<?php
$setting = $setting ?? null;
$isEdit = $setting !== null;
$settingTypes = $settingTypes ?? [
    'text' => 'Text Input',
    'textarea' => 'Text Area',
    'number' => 'Number',
    'boolean' => 'Toggle/Switch',
    'select' => 'Dropdown Select',
    'email' => 'Email',
    'url' => 'URL',
    'color' => 'Color Picker',
    'file' => 'File Upload'
];
$categories = $categories ?? [
    'general' => 'General',
    'email' => 'Email',
    'social' => 'Social Media',
    'seo' => 'SEO',
    'analytics' => 'Analytics',
    'api' => 'API Keys',
    'security' => 'Security',
    'appearance' => 'Appearance',
    'other' => 'Other'
];
?>

<form id="setting-form" onsubmit="event.preventDefault(); submitSettingForm(this, <?= $isEdit ? 'true, ' . $setting['id'] : 'false' ?>);" class="space-y-5">
    <!-- Key Field -->
    <div>
        <label for="key" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Setting Key <span class="text-red-500">*</span>
        </label>
        <input type="text" name="key" id="key" value="<?= esc($setting['key'] ?? '') ?>" 
               placeholder="e.g., site_name, contact_email"
               <?= $isEdit ? '' : 'required' ?> minlength="2" maxlength="100" pattern="[a-zA-Z0-9_]+"
               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all font-mono text-sm"
               <?= $isEdit ? 'readonly' : '' ?>>
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Unique identifier (letters, numbers, underscores only). <?= $isEdit ? 'Cannot be changed.' : '' ?></p>
        <p id="key-error" class="mt-1 text-xs text-red-500"></p>
    </div>

    <!-- Label Field -->
    <div>
        <label for="label" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Display Label <span class="text-red-500">*</span>
        </label>
        <input type="text" name="label" id="label" value="<?= esc($setting['label'] ?? '') ?>" 
               placeholder="e.g., Site Name, Contact Email"
               required minlength="2" maxlength="255"
               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Human-readable name shown in the settings panel</p>
        <p id="label-error" class="mt-1 text-xs text-red-500"></p>
    </div>

    <!-- Type Field -->
    <div>
        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Input Type <span class="text-red-500">*</span>
        </label>
        <select name="type" id="type" required onchange="handleTypeChange(this.value)"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
            <option value="">Select a type</option>
            <?php foreach ($settingTypes as $value => $label): ?>
                <option value="<?= esc($value) ?>" <?= ($setting['type'] ?? '') === $value ? 'selected' : '' ?>><?= esc($label) ?></option>
            <?php endforeach; ?>
        </select>
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Determines the input field type for this setting</p>
        <p id="type-error" class="mt-1 text-xs text-red-500"></p>
    </div>

    <!-- Description Field -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Description
        </label>
        <textarea name="description" id="description" rows="3" maxlength="1000"
                  placeholder="Explain what this setting controls..."
                  class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all resize-none"><?= esc($setting['description'] ?? '') ?></textarea>
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 text-right"><span id="desc-count">0</span>/1000</p>
        <p id="description-error" class="mt-1 text-xs text-red-500"></p>
    </div>

    <!-- Category Field -->
    <div>
        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Category
        </label>
        <select name="category" id="category"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
            <?php foreach ($categories as $value => $label): ?>
                <option value="<?= esc($value) ?>" <?= ($setting['category'] ?? 'general') === $value ? 'selected' : '' ?>><?= esc($label) ?></option>
            <?php endforeach; ?>
        </select>
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Group settings by category for better organization</p>
        <p id="category-error" class="mt-1 text-xs text-red-500"></p>
    </div>

    <!-- Value Field (Dynamic based on type) -->
    <div id="value-field-container">
        <label for="value" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Current Value
        </label>
        <div id="value-input-wrapper">
            <input type="text" name="value" id="value" value="<?= esc($setting['value'] ?? '') ?>" 
                   placeholder="Enter setting value"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
        </div>
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">The actual value stored for this setting</p>
        <p id="value-error" class="mt-1 text-xs text-red-500"></p>
    </div>

    <!-- Options Field (for select type) -->
    <div id="options-field-container" class="hidden">
        <label for="options" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Select Options (JSON)
        </label>
        <textarea name="options" id="options" rows="4"
                  placeholder='{"option1": "Option 1", "option2": "Option 2"}'
                  class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all resize-none font-mono text-sm"><?= !empty($setting['options']) && is_array($setting['options']) ? json_encode($setting['options'], JSON_PRETTY_PRINT) : '' ?></textarea>
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">JSON object with key-value pairs for dropdown options</p>
        <p id="options-error" class="mt-1 text-xs text-red-500"></p>
    </div>

    <!-- Default Value Field -->
    <div>
        <label for="default_value" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            Default Value
        </label>
        <input type="text" name="default_value" id="default_value" value="<?= esc($setting['default_value'] ?? '') ?>" 
               placeholder="Default value if not set"
               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Fallback value when no value is set</p>
        <p id="default_value-error" class="mt-1 text-xs text-red-500"></p>
    </div>

    <!-- Sort Order & Active Status Row -->
    <div class="grid grid-cols-2 gap-4">
        <!-- Sort Order -->
        <div>
            <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                Sort Order
            </label>
            <input type="number" name="sort_order" id="sort_order" value="<?= esc($setting['sort_order'] ?? 0) ?>" 
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
                <input type="checkbox" name="is_active" value="1" <?= ($setting['is_active'] ?? 1) ? 'checked' : '' ?>
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
            <?= $isEdit ? '💾 Update Setting' : '✨ Create Setting' ?>
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

// Handle type change - update value input type
function handleTypeChange(type) {
    const wrapper = document.getElementById('value-input-wrapper');
    const optionsContainer = document.getElementById('options-field-container');
    const currentValue = document.getElementById('value')?.value || '';
    
    let html = '';
    
    switch(type) {
        case 'textarea':
            html = `<textarea name="value" id="value" rows="4" placeholder="Enter text value"
                      class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all resize-none">${currentValue}</textarea>`;
            break;
        case 'number':
            html = `<input type="number" name="value" id="value" value="${currentValue}" 
                      placeholder="Enter number" step="any"
                      class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">`;
            break;
        case 'boolean':
            html = `<label class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <input type="checkbox" name="value" id="value" value="1" ${currentValue ? 'checked' : ''}
                           class="w-6 h-6 rounded border-gray-300 text-brand-500 focus:ring-brand-500">
                    <span class="text-sm text-gray-700 dark:text-gray-300">Enabled</span>
                    </label>`;
            break;
        case 'email':
            html = `<input type="email" name="value" id="value" value="${currentValue}" 
                      placeholder="email@example.com"
                      class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">`;
            break;
        case 'url':
            html = `<input type="url" name="value" id="value" value="${currentValue}" 
                      placeholder="https://example.com"
                      class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">`;
            break;
        case 'color':
            html = `<div class="flex gap-3">
                    <input type="color" name="value_color_picker" id="value_color_picker" value="${currentValue || '#3b82f6'}" 
                           onchange="document.getElementById('value').value = this.value"
                           class="w-16 h-12 rounded-lg border border-gray-200 dark:border-gray-700 cursor-pointer">
                    <input type="text" name="value" id="value" value="${currentValue}" 
                           placeholder="#3b82f6"
                           class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all font-mono">
                    </div>`;
            break;
        case 'select':
            optionsContainer.classList.remove('hidden');
            // Keep existing select options or create empty one
            html = `<select name="value" id="value" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
                    <option value="">Select an option</option>
                    </select>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Options will be loaded from JSON above</p>`;
            break;
        default:
            html = `<input type="text" name="value" id="value" value="${currentValue}" 
                      placeholder="Enter value"
                      class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">`;
    }
    
    wrapper.innerHTML = html;
    
    // Show/hide options field
    if (type !== 'select') {
        optionsContainer.classList.add('hidden');
    }
}

// Initialize on load if editing
<?php if ($isEdit): ?>
document.addEventListener('DOMContentLoaded', function() {
    handleTypeChange('<?= esc($setting['type'] ?? 'text') ?>');
});
<?php endif; ?>
</script>
