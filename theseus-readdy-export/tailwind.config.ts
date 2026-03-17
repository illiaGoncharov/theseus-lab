import type { Config } from 'tailwindcss';

export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        dark: {
          bg: '#0C0C0C',
          surface: '#111111',
          card: '#161616',
          border: '#222222',
          muted: '#2a2a2a',
        },
        light: {
          bg: '#F8F8F5',
          surface: '#F2F2EE',
          card: '#FFFFFF',
          border: '#E4E4DC',
          muted: '#D8D8D0',
        },
        accent: {
          lime: '#E8FF47',
          'lime-dark': '#B8CC00',
          cyan: '#00F0FF',
          purple: '#8B5CF6',
          blue: '#3B82F6',
        },
      },
      fontFamily: {
        display: ['Syne', 'sans-serif'],
        sans: ['Inter', 'sans-serif'],
      },
      animation: {
        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
        'float': 'float 8s ease-in-out infinite',
        'spin-slow': 'spin 20s linear infinite',
        'flow-right': 'flow-right 2.5s ease-in-out infinite',
        'flow-down': 'flow-down 2.5s ease-in-out infinite',
        'scan': 'scan-line 3s linear infinite',
        'fade-up': 'fadeUp 0.6s ease forwards',
      },
      keyframes: {
        float: {
          '0%, 100%': { transform: 'translateY(0px)' },
          '50%': { transform: 'translateY(-16px)' },
        },
        fadeUp: {
          '0%': { opacity: '0', transform: 'translateY(24px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
      },
    },
  },
  plugins: [],
} satisfies Config;
