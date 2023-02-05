const defaultTheme = require('tailwindcss/defaultTheme')

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
		        'background': '#0a0a2a',
		        'prussian': {
			        '50': '#3d3d47',
			        '100': '#383847',
			        '200': '#2c2c47',
			        '300': '#272747',
			        '400': '#212147',
			        '500': '#1b1b47',
			        '600': '#151547',
			        '700': '#101048',
			        '800': '#090947',
			        '900': '#040447',
		        },
		        'offwhite': '#f2eae8'
	        }
        },
    },

	plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('tailwindcss-opentype')],
};
