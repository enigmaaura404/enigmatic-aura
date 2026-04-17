document.addEventListener('DOMContentLoaded', () => {
  // 🔹 Loader
  setTimeout(() => document.getElementById('loader')?.classList.add('hidden'), 600);

  // 🔹 Theme Manager
  const html = document.documentElement;
  const toggleBtns = document.querySelectorAll('[data-theme-toggle]');
  const saved = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
  html.classList.toggle('dark', saved === 'dark');

  toggleBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      html.classList.toggle('dark');
      localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
    });
  });

  // 🔹 Mobile Sidebar Toggle
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebar-overlay');
  document.querySelectorAll('[data-sidebar-toggle]').forEach(btn => {
    btn.addEventListener('click', () => {
      sidebar?.classList.toggle('-translate-x-full');
      overlay?.classList.toggle('hidden');
    });
  });
  overlay?.addEventListener('click', () => {
    sidebar?.classList.add('-translate-x-full');
    overlay?.classList.add('hidden');
  });

  // 🔹 Modal System
  window.openModal = (id) => {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    const content = el.querySelector('[data-modal-content]');
    content?.classList.remove('animate-fade-up');
    void content.offsetWidth; // trigger reflow
    content?.classList.add('animate-fade-up');
  };
  window.closeModal = (id) => {
    const el = document.getElementById(id);
    if (!el) return;
    el.querySelector('[data-modal-content]')?.classList.remove('animate-fade-up');
    setTimeout(() => { el.classList.add('hidden'); document.body.style.overflow = ''; }, 200);
  };

  // 🔹 Toast System
  window.showToast = (msg, type = 'success') => {
    const toast = document.createElement('div');
    const colors = { success: 'bg-emerald-500', error: 'bg-rose-500', info: 'bg-brand-500' };
    toast.className = `fixed bottom-6 right-6 px-5 py-3 rounded-xl text-white shadow-2xl transform translate-y-4 opacity-0 transition-all duration-300 z-[100] ${colors[type] || colors.info}`;
    toast.innerHTML = `<p class="font-medium text-sm">${msg}</p>`;
    document.body.appendChild(toast);
    requestAnimationFrame(() => toast.classList.remove('translate-y-4', 'opacity-0'));
    setTimeout(() => { toast.classList.add('translate-y-4', 'opacity-0'); setTimeout(() => toast.remove(), 300); }, 3000);
  };

  // 🔹 Scroll Reveal
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('animate-fade-up'); observer.unobserve(e.target); }});
  }, { threshold: 0.15 });
  document.querySelectorAll('[data-reveal]').forEach(el => { el.classList.add('opacity-0'); observer.observe(el); });
});