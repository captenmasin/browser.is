let mix = require('laravel-mix');

require('laravel-mix-tailwind');

mix
    .js('resources/js/app.js', 'public/js')
    .version()
    .sass('resources/sass/app.scss', 'public/css')
    .tailwind()
    .copyDirectory('resources/images', 'public/images')
    .copyDirectory('resources/other', 'public/');