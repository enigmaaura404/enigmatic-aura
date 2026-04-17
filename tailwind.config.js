module.exports = {
  darkMode: 'class',
  content: [
    './app/Views/**/*.php',
    './resources/**/*.js'
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          50: '#eef5ff',
          100: '#d9ebff',
          400: '#60a5fa',
          500: '#3b82f6',
          600: '#2563eb',
          900: '#0f172a'
        },
        neon: {
          blue: '#00f0ff',
          purple: '#b026ff'
        }
      },
      fontFamily: {
        sans: ['Inter', 'ui-sans-serif', 'system-ui']
      },
      animation: {
        'fade-scale': 'fadeScale 0.3s ease-out forwards',
        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
      },
      keyframes: {
        fadeScale: {
          '0%': { opacity: 0, transform: 'scale(0.95)' },
          '100%': { opacity: 1, transform: 'scale(1)' },
        }
      }
    }
  },
  plugins: [require('@tailwindcss/forms')]
}