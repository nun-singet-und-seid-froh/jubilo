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
				background: '#0a0a2a',
				prussian: {
					50: '#262629',
					100: '#242429',
					200: '#1c1c29',
					300: '#181829',
					400: '#141429',
					500: '#111129',
					600: '#0d0d29',
					700: '#0a0a2a',
					800: '#060629',
					900: '#020229',
				},
		        offwhite: '#f2eae8'
	        }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('tailwindcss-opentype')],
};
