<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EnigmaticAura ⚡ | Adi</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>
<body class="font-sans overflow-x-hidden">
  <div id="loader"><div class="spinner"></div></div>
  
  <?= $this->renderSection('content') ?>

  <!-- Universal Modal -->
  <div id="universal-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
    <div data-modal-content class="bg-white dark:bg-gray-900 rounded-2xl w-full max-w-2xl p-6 shadow-2xl relative border border-gray-200 dark:border-gray-800">
      <button onclick="closeModal('universal-modal')" class="absolute top-4 right-4 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">✕</button>
      <h2 id="modal-title" class="text-2xl font-bold mb-3 bg-clip-text text-transparent bg-gradient-to-r from-brand-500 to-neon-purple"></h2>
      <div id="modal-body" class="text-gray-600 dark:text-gray-300 leading-relaxed space-y-4"></div>
    </div>
  </div>

  <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>