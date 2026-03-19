import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
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
                'amtech-green': '#00a651',
                'amtech-blue': '#1e2a5e',
                'ev-green': '#00a651',
                'ev-dark': '#0a0a0a',
                'ev-card': '#1a1a1a',
                'accent': '#00a651',
                'main': '#ffffff',
                'text-muted': '#888888',
                'glass-border': 'rgba(255, 255, 255, 0.1)',
            },
        },
    },

    plugins: [forms],
};
