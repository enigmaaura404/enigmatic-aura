<?= $this->extend('layouts/landing') ?>
<?= $this->section('content') ?>

<!-- NAVBAR -->
<nav class="fixed w-full z-40 top-0 backdrop-blur-lg border-b border-gray-200/30 dark:border-gray-800/50 bg-white/80 dark:bg-gray-950/80 transition-colors">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
    <a href="/" class="text-xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-brand-600 to-neon-purple hover:opacity-80 transition-opacity">EnigmaticAura</a>
    <div class="hidden md:flex gap-6 items-center">
      <a href="#about" class="text-sm font-medium hover:text-brand-500 transition-colors">About</a>
      <a href="#focus" class="text-sm font-medium hover:text-brand-500 transition-colors">Focus</a>
      <a href="#skills" class="text-sm font-medium hover:text-brand-500 transition-colors">Skills</a>
      <a href="#projects" class="text-sm font-medium hover:text-brand-500 transition-colors">Projects</a>
      <button data-theme-toggle class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Toggle Theme">
        <span class="dark:hidden">🌙</span>
        <span class="hidden dark:inline">☀️</span>
      </button>
    </div>
    <!-- Mobile menu button -->
    <button class="md:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" id="mobile-menu-btn" aria-label="Menu">☰</button>
  </div>
  <!-- Mobile menu -->
  <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 px-4 py-3 space-y-2">
    <a href="#about" class="block py-2 text-sm font-medium hover:text-brand-500">About</a>
    <a href="#focus" class="block py-2 text-sm font-medium hover:text-brand-500">Focus</a>
    <a href="#skills" class="block py-2 text-sm font-medium hover:text-brand-500">Skills</a>
    <a href="#projects" class="block py-2 text-sm font-medium hover:text-brand-500">Projects</a>
    <a href="#contact" class="block py-2 text-sm font-medium hover:text-brand-500">Contact</a>
  </div>
</nav>

<main class="pt-20">
  <!-- HERO SECTION -->
  <section class="min-h-[90vh] flex items-center justify-center px-4 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-brand-500/10 via-transparent to-transparent dark:from-neon-blue/15 animate-pulse-slow"></div>
    <div class="max-w-4xl text-center z-10 space-y-6" data-reveal>
      <span class="inline-block px-3 py-1 rounded-full bg-brand-100/50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-300 text-xs font-semibold tracking-wider uppercase animate-fade-up">Available for Hire</span>
      <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-gray-900 via-brand-600 to-neon-purple dark:from-white dark:via-brand-400 dark:to-neon-blue leading-tight animate-fade-up" style="animation-delay: 0.1s">
        EnigmaticAura ⚡
      </h1>
      <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed animate-fade-up" style="animation-delay: 0.2s">
        Crafting Interfaces, Solving Problems, Exploring the Future of the Web
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8 animate-fade-up" style="animation-delay: 0.3s">
        <a href="#projects" class="px-6 py-3 rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-medium transition-all shadow-lg shadow-brand-500/25 hover:shadow-brand-500/40 hover:-translate-y-1">View Projects</a>
        <button onclick="openModal('contact-modal')" class="px-6 py-3 rounded-xl border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all font-medium hover:-translate-y-1">Contact Me</button>
      </div>
    </div>
  </section>

  <!-- ABOUT SECTION -->
  <section id="about" class="py-20 px-4 max-w-6xl mx-auto">
    <div class="grid md:grid-cols-2 gap-12 items-center" data-reveal>
      <div class="space-y-5">
        <span class="text-brand-500 font-semibold text-sm uppercase tracking-wider">About Me</span>
        <h2 class="text-3xl md:text-4xl font-bold">Meet <span class="text-brand-500">Adi</span></h2>
        <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
          I don't just write code; I architect experiences. With a hybrid background in frontend engineering and UI/UX design, I bridge the gap between how things <em class="text-brand-500 not-italic">look</em> and how they <em class="text-brand-500 not-italic">work</em>.
        </p>
        <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
          Whether it's troubleshooting a stubborn server or polishing micro-interactions, my approach is always user-first, performance-obsessed, and relentlessly clean. I believe that great technology should feel invisible—effortless, intuitive, and empowering.
        </p>
        <div class="flex gap-3 flex-wrap pt-2">
          <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-sm font-medium border border-gray-200 dark:border-gray-700">Frontend Developer</span>
          <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-sm font-medium border border-gray-200 dark:border-gray-700">UI/UX Designer</span>
          <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-sm font-medium border border-gray-200 dark:border-gray-700">IT Support</span>
        </div>
      </div>
      <div class="aspect-[4/3] rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center shadow-2xl border border-gray-200 dark:border-gray-700 relative overflow-hidden group">
        <div class="absolute inset-0 bg-gradient-to-br from-brand-500/10 to-neon-purple/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <span class="text-7xl drop-shadow-lg relative z-10">🧑‍💻</span>
      </div>
    </div>
  </section>

  <!-- CORE FOCUS SECTION -->
  <section id="focus" class="py-20 bg-gray-50 dark:bg-gray-900/40 px-4">
    <div class="max-w-6xl mx-auto" data-reveal>
      <div class="text-center mb-12">
        <span class="text-brand-500 font-semibold text-sm uppercase tracking-wider">What I Do</span>
        <h2 class="text-3xl md:text-4xl font-bold mt-2">Core Focus</h2>
      </div>
      <div class="grid md:grid-cols-3 gap-6">
        <?php foreach([
          ['icon' => '💻', 'title' => 'Frontend Developer', 'desc' => 'Building pixel-perfect, responsive interfaces with modern frameworks. Specialized in React, Vue, and component-driven architecture.'],
          ['icon' => '🎨', 'title' => 'UI/UX Designer', 'desc' => 'Creating intuitive, accessible designs that users love. Expert in Figma, design systems, and user-centered workflows.'],
          ['icon' => '🖥️', 'title' => 'IT Support', 'desc' => 'Ensuring systems run smoothly. From infrastructure management to troubleshooting, I keep everything reliable and secure.']
        ] as $card): ?>
        <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 hover:border-brand-400 dark:hover:border-brand-500 hover:shadow-xl transition-all duration-300 cursor-default">
          <div class="w-14 h-14 rounded-xl bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
            <?= $card['icon'] ?>
          </div>
          <h3 class="text-xl font-bold mb-2"><?= $card['title'] ?></h3>
          <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed"><?= $card['desc'] ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- SKILLS SECTION -->
  <section id="skills" class="py-20 px-4 max-w-6xl mx-auto">
    <div class="text-center mb-12" data-reveal>
      <span class="text-brand-500 font-semibold text-sm uppercase tracking-wider">Tech Stack</span>
      <h2 class="text-3xl md:text-4xl font-bold mt-2">Skills & Technologies</h2>
    </div>
    
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6" data-reveal>
      <!-- Frontend -->
      <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700">
        <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
          <span class="text-brand-500">⚡</span> Frontend
        </h3>
        <div class="flex flex-wrap gap-2">
          <?php foreach(['React', 'Vue.js', 'Next.js', 'TypeScript', 'JavaScript', 'HTML5', 'CSS3'] as $skill): ?>
            <span class="px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-700 text-sm font-medium hover:bg-brand-100 dark:hover:bg-brand-900/30 hover:text-brand-600 dark:hover:text-brand-300 transition-colors cursor-default"><?= $skill ?></span>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Tools -->
      <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700">
        <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
          <span class="text-purple-500">🔧</span> Tools
        </h3>
        <div class="flex flex-wrap gap-2">
          <?php foreach(['Vite', 'Git', 'Docker', 'VS Code', 'npm/yarn', 'Webpack', 'CI/CD'] as $skill): ?>
            <span class="px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-700 text-sm font-medium hover:bg-purple-100 dark:hover:bg-purple-900/30 hover:text-purple-600 dark:hover:text-purple-300 transition-colors cursor-default"><?= $skill ?></span>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- UI/UX -->
      <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700">
        <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
          <span class="text-pink-500">🎨</span> UI/UX
        </h3>
        <div class="flex flex-wrap gap-2">
          <?php foreach(['Figma', 'Adobe XD', 'Tailwind CSS', 'Design Systems', 'Prototyping', 'Wireframing'] as $skill): ?>
            <span class="px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-700 text-sm font-medium hover:bg-pink-100 dark:hover:bg-pink-900/30 hover:text-pink-600 dark:hover:text-pink-300 transition-colors cursor-default"><?= $skill ?></span>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Backend & QA -->
      <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700">
        <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
          <span class="text-emerald-500">🔒</span> Backend & QA
        </h3>
        <div class="flex flex-wrap gap-2">
          <?php foreach(['CodeIgniter 4', 'Node.js', 'MySQL', 'Jest', 'Testing', 'REST API'] as $skill): ?>
            <span class="px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-700 text-sm font-medium hover:bg-emerald-100 dark:hover:bg-emerald-900/30 hover:text-emerald-600 dark:hover:text-emerald-300 transition-colors cursor-default"><?= $skill ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- TECH PHILOSOPHY -->
  <section class="py-24 px-4 bg-gradient-to-b from-transparent via-gray-50 dark:via-gray-900/30 to-transparent">
    <div class="max-w-4xl mx-auto text-center" data-reveal>
      <blockquote class="text-2xl md:text-4xl font-medium italic text-gray-700 dark:text-gray-300 leading-snug">
        "Good design is invisible. Great systems feel effortless."
      </blockquote>
      <p class="mt-6 text-gray-500 dark:text-gray-400">— My Philosophy</p>
    </div>
  </section>

  <!-- WHAT I BUILD / PROJECTS -->
  <section id="projects" class="py-20 px-4 max-w-6xl mx-auto">
    <div class="text-center mb-12" data-reveal>
      <span class="text-brand-500 font-semibold text-sm uppercase tracking-wider">Portfolio</span>
      <h2 class="text-3xl md:text-4xl font-bold mt-2">What I Build</h2>
      <p class="text-gray-500 dark:text-gray-400 mt-3 max-w-xl mx-auto">Real-world solutions designed for scale, accessibility, and performance.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-6" data-reveal>
      <?php foreach([
        ['title' => 'UI Modern Systems', 'desc' => 'Component-driven architecture with design tokens, strict accessibility (WCAG 2.1), and seamless dark mode support.', 'tag' => 'Design System', 'color' => 'brand'],
        ['title' => 'Web Applications', 'desc' => 'Full-stack SPA/SSR applications with state management, routing, API integration, and optimized performance.', 'tag' => 'Fullstack', 'color' => 'purple'],
        ['title' => 'Developer Documentation', 'desc' => 'Technical documentation portals, API references, onboarding guides with search and versioning.', 'tag' => 'Content', 'color' => 'blue'],
        ['title' => 'Community Platform', 'desc' => 'Forum systems with real-time chat, role-based access control, moderation tools, and engagement features.', 'tag' => 'Platform', 'color' => 'emerald']
      ] as $proj): ?>
        <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer" onclick="showProjectModal('<?= $proj['title'] ?>', '<?= addslashes($proj['desc']) ?>', '<?= $proj['tag'] ?>')">
          <div class="flex justify-between items-start mb-3">
            <span class="px-3 py-1 rounded-full bg-<?= $proj['color'] ?>-100 dark:bg-<?= $proj['color'] ?>-900/30 text-<?= $proj['color'] ?>-600 dark:text-<?= $proj['color'] ?>-300 text-xs font-semibold"><?= $proj['tag'] ?></span>
            <span class="text-gray-400 group-hover:text-brand-500 transition-colors transform group-hover:translate-x-1">→</span>
          </div>
          <h3 class="text-xl font-bold mb-2 group-hover:text-brand-500 transition-colors"><?= $proj['title'] ?></h3>
          <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed"><?= $proj['desc'] ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- CONTACT SECTION -->
  <section id="contact" class="py-20 px-4 max-w-2xl mx-auto">
    <div class="text-center mb-8" data-reveal>
      <span class="text-brand-500 font-semibold text-sm uppercase tracking-wider">Get In Touch</span>
      <h2 class="text-3xl md:text-4xl font-bold mt-2">Let's Build Something</h2>
      <p class="text-gray-500 dark:text-gray-400 mt-3">Have a project in mind? Drop a message. I reply within 24h.</p>
    </div>
    
    <form class="space-y-4 bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm" data-reveal onsubmit="handleContact(event)">
      <div class="grid md:grid-cols-2 gap-4">
        <div>
          <label for="name" class="sr-only">Your Name</label>
          <input type="text" id="name" name="name" placeholder="Your Name" required class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none transition-all">
        </div>
        <div>
          <label for="email" class="sr-only">Email Address</label>
          <input type="email" id="email" name="email" placeholder="Email Address" required class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none transition-all">
        </div>
      </div>
      <div>
        <label for="subject" class="sr-only">Subject</label>
        <input type="text" id="subject" name="subject" placeholder="Subject" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none transition-all">
      </div>
      <div>
        <label for="message" class="sr-only">Message</label>
        <textarea id="message" name="message" rows="5" placeholder="Tell me about your project..." required class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none transition-all resize-none"></textarea>
      </div>
      <button type="submit" class="w-full py-3 rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-medium transition-all shadow-lg shadow-brand-500/20 hover:shadow-brand-500/40 flex items-center justify-center gap-2">
        <span>Send Message</span>
        <span>→</span>
      </button>
    </form>

    <div class="mt-8 text-center" data-reveal>
      <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Or reach out directly:</p>
      <div class="flex justify-center gap-4">
        <a href="mailto:adi@enigmaticaura.com" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors text-sm">📧 Email</a>
        <a href="#" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors text-sm">💼 LinkedIn</a>
        <a href="#" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors text-sm">🐙 GitHub</a>
      </div>
    </div>
  </section>
</main>

<!-- Footer -->
<footer class="py-8 text-center text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-800 mt-8">
  <p>&copy; <?= date('Y') ?> EnigmaticAura. Crafted with precision & passion.</p>
</footer>

<!-- Contact Modal -->
<div id="contact-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" role="dialog" aria-modal="true">
  <div data-modal-content class="bg-white dark:bg-gray-900 rounded-2xl w-full max-w-lg p-6 shadow-2xl relative border border-gray-200 dark:border-gray-800">
    <button onclick="closeModal('contact-modal')" class="absolute top-4 right-4 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Close modal">✕</button>
    <h2 class="text-2xl font-bold mb-4">Get In Touch</h2>
    <p class="text-gray-600 dark:text-gray-300 mb-6">Ready to start your next project? Let's talk about how I can help bring your ideas to life.</p>
    <div class="space-y-3">
      <a href="mailto:adi@enigmaticaura.com" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <span class="text-xl">📧</span>
        <span class="text-sm font-medium">adi@enigmaticaura.com</span>
      </a>
      <a href="#" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <span class="text-xl">💼</span>
        <span class="text-sm font-medium">LinkedIn Profile</span>
      </a>
      <a href="#" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <span class="text-xl">🐙</span>
        <span class="text-sm font-medium">GitHub Profile</span>
      </a>
    </div>
  </div>
</div>

<script>
// Project Modal Handler
function showProjectModal(title, desc, tag) {
  document.getElementById('modal-title').textContent = title;
  document.getElementById('modal-body').innerHTML = `
    <div class="mb-4"><span class="px-3 py-1 rounded-full bg-brand-100 dark:bg-brand-900/30 text-brand-600 dark:text-brand-300 text-xs font-semibold">${tag}</span></div>
    <p>${desc}</p>
    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
      <button onclick="closeModal('universal-modal'); openModal('contact-modal');" class="px-6 py-2 rounded-lg bg-brand-600 hover:bg-brand-500 text-white text-sm font-medium transition-colors">Interested? Get In Touch</button>
    </div>
  `;
  openModal('universal-modal');
}

// Contact Form Handler
function handleContact(e) {
  e.preventDefault();
  const form = e.target;
  const formData = new FormData(form);
  
  // Simulate form submission
  const btn = form.querySelector('button[type="submit"]');
  const originalText = btn.innerHTML;
  btn.innerHTML = '<span>Sending...</span>';
  btn.disabled = true;
  
  setTimeout(() => {
    showToast('Message sent successfully! I\'ll get back to you soon.', 'success');
    form.reset();
    btn.innerHTML = originalText;
    btn.disabled = false;
  }, 1500);
}

// Mobile Menu Toggle
document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
  const menu = document.getElementById('mobile-menu');
  menu.classList.toggle('hidden');
});
</script>

<?= $this->endSection() ?>