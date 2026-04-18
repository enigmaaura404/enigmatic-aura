<!DOCTYPE html>
<html lang="en" class="dark scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Adi - Frontend Developer & UI/UX Designer crafting exceptional digital experiences with modern technologies and user-centered design.">
  <meta name="keywords" content="Frontend Developer, UI/UX Designer, React, Vue, TypeScript, Web Development">
  <meta name="author" content="Adi">
  <meta name="theme-color" content="#3b82f6">
  
  <!-- Open Graph / Social Media -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="EnigmaticAura ⚡ | Adi - Frontend Developer & UI/UX Designer">
  <meta property="og:description" content="Crafting Interfaces, Solving Problems, Exploring the Future of the Web">
  
  <title>EnigmaticAura ⚡ | Adi - Frontend Developer & UI/UX Designer</title>
  
  <!-- Preconnect for performance -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <!-- Stylesheets -->
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
  
  <!-- Critical CSS -->
  <style>
    /* Loader Styles */
    #loader { 
      position: fixed; 
      inset: 0; 
      background: linear-gradient(135deg, #0b1120 0%, #1a1f35 100%); 
      display: flex; 
      align-items: center; 
      justify-content: center; 
      z-index: 9999; 
      transition: opacity 0.5s ease, visibility 0.5s ease; 
    }
    #loader.hidden { 
      opacity: 0; 
      visibility: hidden; 
      pointer-events: none; 
    }
    .spinner { 
      width: 56px; 
      height: 56px; 
      border: 3px solid rgba(59,130,246,0.15); 
      border-top-color: #3b82f6; 
      border-right-color: #8b5cf6;
      border-radius: 50%; 
      animation: spin 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite; 
    }
    
    /* Animations */
    @keyframes spin { to { transform: rotate(360deg); } }
    @keyframes fadeUp { 0% { opacity: 0; transform: translateY(30px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes fadeScale { 0% { opacity: 0; transform: scale(0.92); } 100% { opacity: 1; transform: scale(1); } }
    @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
    @keyframes shimmer { 0% { background-position: -1000px 0; } 100% { background-position: 1000px 0; } }
    @keyframes glow { 0%, 100% { box-shadow: 0 0 20px rgba(59,130,246,0.3); } 50% { box-shadow: 0 0 40px rgba(59,130,246,0.6), 0 0 60px rgba(139,92,246,0.4); } }
    
    .animate-fade-up { animation: fadeUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-fade-scale { animation: fadeScale 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-shimmer { background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent); background-size: 1000px 100%; animation: shimmer 2s infinite; }
    .animate-glow { animation: glow 3s ease-in-out infinite; }
    
    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 10px; }
    ::-webkit-scrollbar-track { background: #1a1f35; }
    ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #3b82f6, #8b5cf6); border-radius: 5px; }
    ::-webkit-scrollbar-thumb:hover { background: linear-gradient(180deg, #2563eb, #7c3aed); }
    
    /* Selection */
    ::selection { background: rgba(59,130,246,0.3); color: inherit; }
    
    /* Focus visible for accessibility */
    :focus-visible { outline: 2px solid #3b82f6; outline-offset: 2px; border-radius: 4px; }
    
    /* Gradient text utility */
    .gradient-text { background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 50%, #a855f7 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    
    /* Glass morphism effect */
    .glass { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
    .dark .glass { background: rgba(17, 24, 39, 0.7); border: 1px solid rgba(255, 255, 255, 0.08); }
  </style>
</head>
<body class="font-sans antialiased overflow-x-hidden bg-gradient-to-b from-gray-50 via-white to-gray-100 dark:from-gray-950 dark:via-gray-900 dark:to-black text-gray-900 dark:text-gray-100 selection:bg-brand-500/30 selection:text-brand-100">
  <!-- Loading Screen -->
  <div id="loader" role="status" aria-label="Loading"><div class="spinner"></div></div>
  
  <!-- Skip to main content for accessibility -->
  <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-brand-500 focus:text-white focus:rounded-lg focus:shadow-lg">Skip to main content</a>
  
  <!-- Main Content -->
  <div id="main-content"><?= $this->renderSection('content') ?></div>

  <!-- Universal Modal -->
  <div id="universal-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/70 backdrop-blur-md p-4 sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div data-modal-content class="bg-white dark:bg-gray-900 rounded-2xl sm:rounded-3xl w-full max-w-2xl p-6 sm:p-8 shadow-2xl relative border border-gray-200 dark:border-gray-800 max-h-[90vh] overflow-y-auto transform transition-all">
      <button onclick="closeModal('universal-modal')" class="absolute top-4 right-4 sm:top-6 sm:right-6 p-2.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-300 hover:rotate-90" aria-label="Close modal">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
      <h2 id="modal-title" class="text-2xl sm:text-3xl font-bold mb-4 gradient-text"></h2>
      <div id="modal-body" class="text-gray-600 dark:text-gray-300 leading-relaxed space-y-4"></div>
    </div>
  </div>
  
  <!-- Toast Container -->
  <div id="toast-container" class="fixed bottom-4 sm:bottom-6 right-4 sm:right-6 z-[100] space-y-2 sm:space-y-3 max-w-sm w-full" role="alert" aria-live="polite"></div>

  <!-- Scripts -->
  <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>
