/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#e8f0f7',
          100: '#d1e1ef',
          200: '#a3c3df',
          300: '#75a5cf',
          400: '#4787bf',
          500: '#1e3a5f', // Primary color
          600: '#182e4c',
          700: '#122339',
          800: '#0c1726',
          900: '#060b13',
        },
        accent: {
          50: '#fffbeb',
          100: '#fef3c7',
          200: '#fde68a',
          300: '#fcd34d',
          400: '#fbbf24',
          500: '#f59e0b', // Accent color (Amber/Orange)
          600: '#d97706',
          700: '#b45309',
          800: '#92400e',
          900: '#78350f',
        },
        neutral: {
          50: '#f8f9fa',
          100: '#f1f3f5',
          200: '#e9ecef',
          300: '#dee2e6',
          400: '#ced4da',
          500: '#adb5bd',
          600: '#6b7280',
          700: '#495057',
          800: '#343a40',
          900: '#1f2937',
        },
      },
      fontFamily: {
        'heading': ['Tajawal', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        'body': ['Tajawal', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      spacing: {
        '18': '4.5rem',
        '88': '22rem',
      },
      transitionProperty: {
        'height': 'height',
        'spacing': 'margin, padding',
      },
    },
  },
  plugins: [],
}

