import defaultTheme from 'tailwindcss/defaultTheme';  // imports deafult theme from Tailwind CSS, which includes default font families and other styles (colors, spacing, etc.)
import forms from '@tailwindcss/forms';  // imports Tailwind CSS forms plugin for better form styling (inputs, selects, textarea, buttons etc.)

/** @type {import('tailwindcss').Config} */ // JSDoc directive which provides intellisense to your IDLE (suggestions, type checking, etc.)
export default {
    content: [  // files where Tailwind CSS will look for classes to generate styles. It removes styles that are not included in these files
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {  // the default theme is extended with custom styles
        extend: {
            fontFamily: { // uses sans font, first of all Figtree, otherwise loads other sans fonts (fallback)
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms], // includes Tailwind CSS plugins, in this case the forms plugin for better form styling
};
