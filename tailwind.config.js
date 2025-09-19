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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'academic': {
                    'blue-dark': '#1a237e',
                    'blue-light': '#e8eaf6',
                    'indigo': '#3f51b5',
                    'indigo-dark': '#303f9f',
                    'bg': '#f0f4f8',
                }
            }
        },
    },

    plugins: [forms],
};