const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
			fontFamily: {
				serif: ['"EB Garamond 12"', ...defaultTheme.fontFamily.serif]
			},
	        colors: {
				nsusf: {
					50: '#807378',
					100: '#806670',
					200: '#805968',
					300: '#804d60',
					400: '#804058',
					500: '#80334f',
					600: '#802648',
					700: '#801941',
					800: '#800d39',
					900: '#800032',
				}
	        }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
