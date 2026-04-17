/**
 * EnigmaticAura - Main Application JavaScript
 * Handles: Theme Toggle, Modals, Toasts, Scroll Effects, Mobile Menu
 */

document.addEventListener('DOMContentLoaded', () => {
  // 🔹 Loader - Hide after page load
  const loader = document.getElementById('loader');
  if (loader) {
    window.addEventListener('load', () => {
      setTimeout(() => {
        loader.classList.add('hidden');
      }, 600);
    });
  }
  
  // 🔹 Theme Manager with localStorage persistence
  const html = document.documentElement;
  const toggleBtns = document.querySelectorAll('[data-theme-toggle]');
  
  // Check saved theme or system preference
  const savedTheme = localStorage.getItem('theme');
  const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const initialTheme = savedTheme || (systemPrefersDark ? 'dark' : 'light');
  
  // Apply initial theme
  if (initialTheme === 'dark') {
    html.classList.add('dark');
  } else {
    html.classList.remove('dark');
  }
  
  // Add click handlers to all theme toggle buttons
  toggleBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      html.classList.toggle('dark');
      const newTheme = html.classList.contains('dark') ? 'dark' : 'light';
      localStorage.setItem('theme', newTheme);
      
      // Optional: Dispatch custom event for other components to react
      window.dispatchEvent(new CustomEvent('themechange', { detail: { theme: newTheme } }));
    });
  });
  
  // 🔹 Modal System - Reusable modal component
  window.openModal = (modalId) => {
    const modal = document.getElementById(modalId);
    if (!modal) {
      console.warn(`Modal "${modalId}" not found`);
      return;
    }
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
    
    // Trigger animation
    const content = modal.querySelector('[data-modal-content]');
    if (content) {
      content.classList.remove('animate-fade-scale');
      void content.offsetWidth; // Force reflow
      content.classList.add('animate-fade-scale');
    }
    
    // Close on Escape key
    const handleEscape = (e) => {
      if (e.key === 'Escape') {
        closeModal(modalId);
        document.removeEventListener('keydown', handleEscape);
      }
    };
    document.addEventListener('keydown', handleEscape);
    
    // Close on backdrop click
    modal.addEventListener('click', function handleBackdrop(e) {
      if (e.target === modal) {
        closeModal(modalId);
        modal.removeEventListener('click', handleBackdrop);
      }
    });
  };
  
  window.closeModal = (modalId) => {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    
    const content = modal.querySelector('[data-modal-content]');
    if (content) {
      content.classList.remove('animate-fade-scale');
    }
    
    // Wait for animation to complete before hiding
    setTimeout(() => {
      modal.classList.add('hidden');
      document.body.style.overflow = '';
    }, 200);
  };
  
  // 🔹 Toast Notification System
  window.showToast = (message, type = 'success', duration = 3000) => {
    const container = document.getElementById('toast-container') || document.body;
    
    const toast = document.createElement('div');
    const colors = {
      success: 'bg-emerald-500',
      error: 'bg-rose-500',
      warning: 'bg-amber-500',
      info: 'bg-brand-500'
    };
    const icons = {
      success: '✓',
      error: '✕',
      warning: '⚠',
      info: 'ℹ'
    };
    
    toast.className = `flex items-center gap-3 px-5 py-3 rounded-xl text-white shadow-2xl transform translate-y-4 opacity-0 transition-all duration-300 ${colors[type] || colors.info}`;
    toast.innerHTML = `
      <span class="text-lg font-bold">${icons[type] || icons.info}</span>
      <p class="font-medium text-sm">${message}</p>
    `;
    
    container.appendChild(toast);
    
    // Animate in
    requestAnimationFrame(() => {
      toast.classList.remove('translate-y-4', 'opacity-0');
    });
    
    // Auto remove
    setTimeout(() => {
      toast.classList.add('translate-y-4', 'opacity-0');
      setTimeout(() => toast.remove(), 300);
    }, duration);
  };
  
  // 🔹 Scroll Reveal Animation using Intersection Observer
  const revealElements = document.querySelectorAll('[data-reveal]');
  
  if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-fade-up');
          revealObserver.unobserve(entry.target); // Only animate once
        }
      });
    }, {
      threshold: 0.15,
      rootMargin: '0px 0px -50px 0px'
    });
    
    revealElements.forEach(el => {
      el.classList.add('opacity-0'); // Hide initially
      revealObserver.observe(el);
    });
  } else {
    // Fallback for browsers without Intersection Observer
    revealElements.forEach(el => {
      el.classList.add('animate-fade-up');
    });
  }
  
  // 🔹 Smooth Scroll for Anchor Links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const href = this.getAttribute('href');
      if (href === '#') return;
      
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
        
        // Close mobile menu if open
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
          mobileMenu.classList.add('hidden');
        }
      }
    });
  });
  
  // 🔹 Mobile Menu Toggle
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  
  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  }
  
  // 🔹 Navbar Background on Scroll
  const navbar = document.querySelector('nav.fixed');
  if (navbar) {
    const handleScroll = () => {
      if (window.scrollY > 20) {
        navbar.classList.add('shadow-lg');
      } else {
        navbar.classList.remove('shadow-lg');
      }
    };
    
    window.addEventListener('scroll', handleScroll, { passive: true });
  }
  
  // 🔹 Form Validation Enhancement
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
      const requiredFields = form.querySelectorAll('[required]');
      let isValid = true;
      
      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          isValid = false;
          field.classList.add('border-rose-500');
          
          // Remove error styling on input
          field.addEventListener('input', function() {
            this.classList.remove('border-rose-500');
          }, { once: true });
        }
      });
      
      if (!isValid) {
        e.preventDefault();
        showToast('Please fill in all required fields', 'error');
      }
    });
  });
});

// 🔹 Utility Functions
window.debounce = (func, wait) => {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
};

window.throttle = (func, limit) => {
  let inThrottle;
  return function(...args) {
    if (!inThrottle) {
      func.apply(this, args);
      inThrottle = true;
      setTimeout(() => inThrottle = false, limit);
    }
  };
};
