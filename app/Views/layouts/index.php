<?= $this->extend('layouts/landing') ?>
<?= $this->section('content') ?>

<!-- NAVBAR -->
<nav class="fixed w-full z-40 top-0 backdrop-blur-lg border-b border-gray-200/30 dark:border-gray-800/50 bg-white/80 dark:bg-gray-950/80">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
    <a href="/" class="text-xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-brand-600 to-neon-purple">EnigmaticAura</a>
    <div class="hidden md:flex gap-6 items-center">
      <a href="#about" class="text-sm font-medium hover:text-brand-500 transition-colors">About</a>
      <a href="#skills" class="text-sm font-medium hover:text-brand-500 transition-colors">Skills</a>
      <a href="#projects" class="text-sm font-medium hover:text-brand-500 transition-colors">Projects</a>
      <button data-theme-toggle class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Toggle Theme">🌓</button>
    </div>
  </div>
</nav>

<main class="pt-20">
  <!-- HERO -->
  <section class="min-h-[90vh] flex items-center justify-center px-4 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-brand-500/10 via-transparent to-transparent dark:from-neon-blue/15 animate-pulse-slow"></div>
    <div class="max-w-4xl text-center z-10 space-y-6" data-reveal>
      <span class="inline-block px-3 py-1 rounded-full bg-brand-100/50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-300 text-xs font-semibold tracking-wider uppercase">Available for Hire</span>
      <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-gray-900 via-brand-600 to-neon-purple dark:from-white dark:via-brand-400 dark:to-neon-blue leading-tight">
        EnigmaticAura ⚡
      </h1>
      <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed">
        Crafting Interfaces, Solving Problems, Exploring the Future of the Web
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
        <a href="#projects" class="px-6 py-3 rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-medium transition-all shadow-lg shadow-brand-500/25 hover:shadow-brand-500/40 hover:-translate-y-1">View Projects</a>
        <button onclick="openModal('universal-modal')" class="px-6 py-3 rounded-xl border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all font-medium hover:-translate-y-1">Contact Me</button>
      </div>
    </div>
  </section>

  <!-- ABOUT -->
  <section id="about" class="py-20 px-4 max-w-6xl mx-auto">
    <div class="grid md:grid-cols-2 gap-12 items-center" data-reveal>
      <div class="space-y-5">
        <h2 class="text-3xl md:text-4xl font-bold">Meet <span class="text-brand-500">Adi</span></h2>
        <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
          I don't just write code; I architect experiences. With a hybrid background in frontend engineering and UI/UX design, I bridge the gap between how things <em class="text-brand-500">look</em> and how they <em class="text-brand-500">work</em>. Whether it's troubleshooting a stubborn server or polishing micro-interactions, my approach is always user-first, performance-obsessed, and relentlessly clean.
        </p>
        <div class="flex gap-3 flex-wrap pt-2">
          <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-sm font-medium border border-gray-200 dark:border-gray-700">Frontend Developer</span>
          <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-sm font-medium border border-gray-200 dark:border-gray-700">UI/UX Designer</span>
          <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-sm font-medium border border-gray-200 dark:border-gray-700">IT Support</span>
        </div>
      </div>
      <div class="aspect-[4/3] rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center shadow-2xl border border-gray-200 dark:border-gray-700">
        <span class="text-7xl drop-shadow-lg">🧑‍💻</span>
      </div>
    </div>
  </section>

  <!-- SKILLS -->
  <section id="skills" class="py-20 bg-gray-50 dark:bg-gray-900/40 px-4">
    <div class="max-w-6xl mx-auto" data-reveal>
      <h2 class="text-3xl font-bold text-center mb-10">Tech Stack</h2>
      <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <?php foreach(['React', 'Vue', 'Next.js', 'TypeScript', 'CI4', 'Tailwind', 'Figma', 'Vite', 'Git', 'Docker', 'MySQL', 'AWS'] as $skill): ?>
          <span class="flex items-center justify-center p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:border-brand-400 dark:hover:border-brand-500 hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all cursor-default font-medium text-sm shadow-sm">
            <?= $skill ?>
          </span>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- PROJECTS -->
  <section id="projects" class="py-20 px-4 max-w-6xl mx-auto" data-reveal>
    <h2 class="text-3xl font-bold text-center mb-4">What I Build</h2>
    <p class="text-center text-gray-500 dark:text-gray-400 mb-10 max-w-xl mx-auto">Real-world solutions designed for scale, accessibility, and performance.</p>
    <div class="grid md:grid-cols-2 gap-6">
      <?php foreach([
        ['title' => 'UI Modern Systems', 'desc' => 'Component-driven architecture with design tokens & strict accessibility.', 'tag' => 'Design System'],
        ['title' => 'Web Applications', 'desc' => 'Full-stack SPA/SSR with state management, routing & API integration.', 'tag' => 'Fullstack'],
        ['title' => 'Developer Docs', 'desc' => 'Technical documentation, API references & onboarding portals.', 'tag' => 'Content'],
        ['title' => 'Community Platform', 'desc' => 'Forum, real-time chat & role-based access control.', 'tag' => 'Platform']
      ] as $proj): ?>
        <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 hover:shadow-xl hover:-translate-y-1 transition-all cursor-pointer" onclick="openModal('universal-modal')">
          <div class="flex justify-between items-start mb-3">
            <span class="px-2 py-1 rounded bg-brand-100 dark:bg-brand-900/30 text-brand-600 dark:text-brand-300 text-xs font-semibold"><?= $proj['tag'] ?></span>
            <span class="text-gray-400 group-hover:text-brand-500 transition-colors">→</span>
          </div>
          <h3 class="text-xl font-bold mb-2"><?= $proj['title'] ?></h3>
          <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed"><?= $proj['desc'] ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact" class="py-20 px-4 max-w-2xl mx-auto" data-reveal>
    <h2 class="text-3xl font-bold text-center mb-2">Let's Build Something</h2>
    <p class="text-center text-gray-500 dark:text-gray-400 mb-8">Drop a message. I reply within 24h.</p>
    <form class="space-y-4 bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm" onsubmit="event.preventDefault(); showToast('Message sent successfully!', 'success'); this.reset();">
      <div class="grid md:grid-cols-2 gap-4">
        <input type="text" placeholder="Your Name" required class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent focus:ring-2 focus:ring-brand-500 focus:outline-none transition-all">
        <input type="email" placeholder="Email Address" required class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent focus:ring-2 focus:ring-brand-500 focus:outline-none transition-all">
      </div>
      <textarea rows="4" placeholder="Tell me about your project..." required class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent focus:ring-2 focus:ring-brand-500 focus:outline-none transition-all"></textarea>
      <button type="submit" class="w-full py-3 rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-medium transition-all shadow-lg shadow-brand-500/20 hover:shadow-brand-500/40">Send Message</button>
    </form>
  </section>
</main>

<footer class="py-8 text-center text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-800 mt-8">
  &copy; <?= date('Y') ?> EnigmaticAura. Crafted with precision.
</footer>
<?= $this->endSection() ?>