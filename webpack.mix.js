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

mix.sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/image/image.scss', 'public/css/image')
   .sass('resources/sass/image/image-builder.scss', 'public/css/image')

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/pages/image/image.js', 'public/js')
   .js('resources/js/pages/image/image-rotate.js', 'public/js/image');
