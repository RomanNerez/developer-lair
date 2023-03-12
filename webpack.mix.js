const mix = require('laravel-mix');

require('laravel-mix-alias');

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

 mix.alias({
   '$utils': '/resources/js/utils',
 });

mix.sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/admin.scss', 'public/css')
   .sass('resources/sass/image/image.scss', 'public/css/image')
   .sass('resources/sass/image/image-builder.scss', 'public/css/image')
   .sass('resources/sass/html-banner/html-banner.scss', 'public/css/html-banner')

mix.js('resources/js/common.js', 'public/js')
   .js('resources/js/admin/admin.js', 'public/js')
   .js('resources/js/pages/image/builder/builder.js', 'public/js/image')
   .js('resources/js/pages/image/rotate/rotate.js', 'public/js/image')
   .js('resources/js/pages/image/resize/resize.js', 'public/js/image')
   .js('resources/js/pages/image/generate_meme/generate-meme.js', 'public/js/image')
   .js('resources/js/pages/image/crop/crop.js', 'public/js/image')
   .js('resources/js/pages/html-banner/html-banner.js', 'public/js/html-banner');
