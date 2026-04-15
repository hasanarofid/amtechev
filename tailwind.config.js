import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'amtech-green': 'var(--accent)',
                'amtech-blue': '#1e2a5e',
                'ev-green': 'var(--accent)',
                'ev-dark': 'var(--bg-color)',
                'ev-card': 'var(--bg-card)',
                'accent': 'var(--accent)',
                'main': 'var(--text-main)',
                'text-muted': 'var(--text-muted)',
                'glass-border': 'var(--glass-border)',
                'glass': 'var(--glass)',
                'glass-bg': 'var(--glass)',
            },
        },
    },

    plugins: [forms, typography],
};
