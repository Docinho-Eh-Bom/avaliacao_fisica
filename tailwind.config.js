import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                brand:{
                light: '#05668D',
                secondary: '#427AA1',
                background: '#EBF2FA',

                darkPrimary: '#679436',
                darkAccent: '#A5BE00',
                }
            }
        },
    },

    plugins: [forms],
};
