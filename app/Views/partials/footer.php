<footer class="py-8 text-center text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-800 mt-16">
  &copy; <?= date('Y') ?> EnigmaticAura. Built with precision.
</footer>

<!-- Modal Container -->
<div id="project-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
  <div data-modal-content class="bg-white dark:bg-gray-900 rounded-2xl w-full max-w-2xl p-6 shadow-2xl relative">
    <button onclick="closeModal('project-modal')" class="absolute top-4 right-4 p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-800">✕</button>
    <h2 id="modal-title" class="text-2xl font-bold mb-2"></h2>
    <div id="modal-body" class="text-gray-600 dark:text-gray-300 leading-relaxed"></div>
  </div>
</div>

<script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>