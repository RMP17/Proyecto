let mix = require('laravel-mix');
require('laravel-mix-purgecss');

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

mix.js('resources/assets/js/app.js', 'public/js')
   // .sass('resources/assets/sass/app.scss', 'public/css').purgeCss();
   .sass('resources/assets/sass/style.css', 'public/css').purgeCss();

mix.browserSync({
    proxy:'127.0.0.1/Proyecto/public',
    files: [
        'resources/views/**/*.php',
        'public/js/**/*.js',
        'public/css/**/*.css'
    ],
});