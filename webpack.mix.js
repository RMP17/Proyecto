let mix = require('laravel-mix');

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
mix.options({
    purifyCss: true
});

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
   // .sass('resources/assets/sass/style2.scss', 'public/css');

mix.browserSync({
    proxy:'127.0.0.1/Proyecto/public',
    files: [
        'resources/views/**/*.php',
        'public/js/**/*.js',
        'public/css/**/*.css'
    ],
});