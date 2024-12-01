import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary-dark': '#1f2937',
                'primary-red': '#fb503b',
                'secondary-red': '#ff6b5b',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
};
