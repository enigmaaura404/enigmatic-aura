<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EnigmaticAura ⚡ | Adi - Frontend Developer & UI/UX Designer</title>
  <meta name="description" content="Crafting Interfaces, Solving Problems, Exploring the Future of the Web">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
  <style>
    /* Critical CSS for loader */
    #loader { position: fixed; inset: 0; background: #0b1120; display: flex; align-items: center; justify-content: center; z-index: 9999; transition: opacity 0.4s ease; }
    #loader.hidden { opacity: 0; pointer-events: none; }
    .spinner { width: 50px; height: 50px; border: 3px solid rgba(59,130,246,0.2); border-top-color: #3b82f6; border-radius: 50%; animation: spin 0.8s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }
    @keyframes fadeUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes fadeScale { 0% { opacity: 0; transform: scale(0.95); } 100% { opacity: 1; transform: scale(1); } }
    .animate-fade-up { animation: fadeUp 0.6s ease-out forwards; }
    .animate-fade-scale { animation: fadeScale 0.3s ease-out forwards; }
  </style>
</head>
<body class="font-sans overflow-x-hidden bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100">
  <div id="loader"><div class="spinner"></div></div>
  
  <?= $this->renderSection('content') ?>

  <!-- Universal Modal -->
  <div id="universal-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" role="dialog" aria-modal="true">
    <div data-modal-content class="bg-white dark:bg-gray-900 rounded-2xl w-full max-w-2xl p-6 shadow-2xl relative border border-gray-200 dark:border-gray-800 max-h-[90vh] overflow-y-auto">
      <button onclick="closeModal('universal-modal')" class="absolute top-4 right-4 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Close modal">✕</button>
      <h2 id="modal-title" class="text-2xl font-bold mb-3 bg-clip-text text-transparent bg-gradient-to-r from-brand-500 to-neon-purple"></h2>
      <div id="modal-body" class="text-gray-600 dark:text-gray-300 leading-relaxed space-y-4"></div>
    </div>
  </div>

  <!-- Toast Container -->
  <div id="toast-container" class="fixed bottom-6 right-6 z-[100] space-y-2"></div>

  <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>