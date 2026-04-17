<?= $this->include('partials/header') ?>
<?= $this->include('partials/navbar') ?>

<main class="pt-20">
  <!-- HERO -->
  <section class="min-h-[90vh] flex items-center justify-center px-4 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-brand-500/10 via-transparent to-transparent dark:from-neon-blue/15"></div>
    <div class="max-w-3xl text-center z-10 space-y-6" data-reveal>
      <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-gray-900 via-brand-600 to-neon-purple dark:from-white dark:via-brand-400 dark:to-neon-blue">
        EnigmaticAura ⚡
      </h1>
      <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed">
        Crafting Interfaces, Solving Problems, Exploring the Future of the Web
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
        <a href="#projects" class="px-6 py-3 rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-medium transition-all shadow-lg shadow-brand-500/25 hover:shadow-brand-500/40">View Projects</a>
        <button onclick="openModal('project-modal')" class="px-6 py-3 rounded-xl border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all font-medium">Contact Me</button>
      </div>
    </div>
  </section>

  <!-- ABOUT -->
  <section id="about" class="py-20 px-4 max-w-5xl mx-auto" data-reveal>
    <div class="grid md:grid-cols-2 gap-12 items-center">
      <div class="space-y-4">
        <h2 class="text-3xl font-bold">Meet <span class="text-brand-500">Adi</span></h2>
        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
          I don't just write code; I architect experiences. With a hybrid background in frontend engineering and UI/UX design, I bridge the gap between how things <em>look</em> and how they <em>work</em>. 
          Whether it's troubleshooting a stubborn server or polishing micro-interactions, my approach is always user-first, performance-obsessed, and relentlessly clean.
        </p>
        <div class="flex gap-3 flex-wrap">
          <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-sm font-medium">Frontend Developer</span>
          <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-sm font-medium">UI/UX Designer</span>
          <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-sm font-medium">IT Support</span>
        </div>
      </div>
      <div class="aspect-square rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center shadow-inner">
        <span class="text-6xl">🧑‍💻</span>
      </div>
    </div>
  </section>

  <!-- CORE FOCUS -->
  <section id="projects" class="py-16 bg-gray-50 dark:bg-gray-900/50 px-4" data-reveal>
    <div class="max-w-6xl mx-auto">
      <h2 class="text-3xl font-bold text-center mb-12">Core Focus</h2>
      <div class="grid md:grid-cols-3 gap-6">
        <?php foreach([
          ['icon' => '💻', 'title' => 'Frontend Developer', 'desc' => 'Pixel-perfect UI, component architecture, SPA/SSR optimization.'],
          ['icon' => '🎨', 'title' => 'UI/UX Designer', 'desc' => 'Design systems, prototyping, accessibility-first workflows.'],
          ['icon' => '🖥️', 'title' => 'IT Support', 'desc' => 'Infrastructure, troubleshooting, system reliability & automation.']
        ] as $card): ?>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 dark:border-gray-700">
          <span class="text-4xl mb-4 block"><?= $card['icon'] ?></span>
          <h3 class="text-xl font-semibold mb-2"><?= $card['title'] ?></h3>
          <p class="text-gray-600 dark:text-gray-300 text-sm"><?= $card['desc'] ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- SKILLS -->
  <section id="skills" class="py-20 px-4 max-w-5xl mx-auto" data-reveal>
    <h2 class="text-3xl font-bold text-center mb-10">Tech Stack</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      <?php foreach([
        'React', 'Vue', 'Next.js', 'TypeScript', 'Vite', 'Git', 'Figma', 'Tailwind', 'Jest', 'CI4', 'Laravel', 'MySQL'
      ] as $skill): ?>
        <span class="flex items-center justify-center p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-brand-400 dark:hover:border-brand-500 hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-all cursor-default">
          <?= $skill ?>
        </span>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PHILOSOPHY -->
  <section class="py-24 text-center bg-gradient-to-b from-transparent to-gray-100 dark:to-gray-900" data-reveal>
    <blockquote class="text-2xl md:text-4xl font-medium italic max-w-3xl mx-auto px-4 leading-snug">
      "Good design is invisible. Great systems feel effortless."
    </blockquote>
  </section>

  <!-- CONTACT -->
  <section id="contact" class="py-20 px-4 max-w-2xl mx-auto" data-reveal>
    <h2 class="text-3xl font-bold text-center mb-8">Let's Build Something</h2>
    <form class="space-y-4" onsubmit="event.preventDefault(); showToast('Message sent successfully!', 'success'); this.reset();">
      <input type="text" placeholder="Your Name" required class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent focus:ring-2 focus:ring-brand-500 focus:outline-none transition-all">
      <input type="email" placeholder="Email" required class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent focus:ring-2 focus:ring-brand-500 focus:outline-none transition-all">
      <textarea rows="4" placeholder="Message" required class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-transparent focus:ring-2 focus:ring-brand-500 focus:outline-none transition-all"></textarea>
      <button type="submit" class="w-full py-3 rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-medium transition-all shadow-lg shadow-brand-500/20">Send Message</button>
    </form>
  </section>
</main>

<?= $this->include('partials/footer') ?>