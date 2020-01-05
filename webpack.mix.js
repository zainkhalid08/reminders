const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.scripts([
	'resources/js/vendors/jquery.js',
	'resources/js/vendors/bootstrap.js',
	'resources/js/vendors/cleanblog.js',
], 'public/js/vendor.js');

mix.js('resources/js/app.js', 'public/js') // has vue components, might need to extend so kept separate
   .sass('resources/sass/app.scss', 'public/css');