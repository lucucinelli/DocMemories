export default {  // plugins that are used by PostCSS in order to edit CSS files, according to this order
    plugins: {
        tailwindcss: {},  // the brackets are empty because PostCSS will use the default Tailwind CSS options
        autoprefixer: {}, // it adds vendor prefixes to CSS properties for better browser compatibility using Can I Use data
    },
};
