document.addEventListener('DOMContentLoaded', () => {
  // 🔹 Dark/Light Mode
  const html = document.documentElement;
  const themeToggle = document.getElementById('theme-toggle');
  const savedTheme = localStorage.getItem('theme') || 'dark';
  html.classList.toggle('dark', savedTheme === 'dark');

  themeToggle?.addEventListener('click', () => {
    html.classList.toggle('dark');
    localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
  });

  // 🔹 Modal Manager
  window.openModal = (id) => {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.remove('hidden');
    requestAnimationFrame(() => modal.querySelector('[data-modal-content]').classList.add('animate-fade-scale'));
    document.body.classList.add('overflow-hidden');
  };

  window.closeModal = (id) => {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.querySelector('[data-modal-content]').classList.remove('animate-fade-scale');
    setTimeout(() => {
      modal.classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }, 200);
  };

  // 🔹 Toast Notification
  window.showToast = (message, type = 'success') => {
    const toast = document.createElement('div');
    const colors = { success: 'bg-green-500', error: 'bg-red-500', info: 'bg-blue-500' };
    toast.className = `fixed bottom-6 right-6 px-5 py-3 rounded-xl text-white shadow-lg transform translate-y-4 opacity-0 transition-all duration-300 z-50 ${colors[type] || colors.info}`;
    toast.innerHTML = `<p class="font-medium">${message}</p>`;
    document.body.appendChild(toast);
    requestAnimationFrame(() => {
      toast.classList.remove('translate-y-4', 'opacity-0');
    });
    setTimeout(() => {
      toast.classList.add('translate-y-4', 'opacity-0');
      setTimeout(() => toast.remove(), 300);
    }, 3000);
  };

  // 🔹 Scroll Reveal (Intersection Observer)
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('opacity-100', 'translate-y-0');
        entry.target.classList.remove('opacity-0', 'translate-y-8');
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('[data-reveal]').forEach(el => {
    el.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-700');
    observer.observe(el);
  });
});