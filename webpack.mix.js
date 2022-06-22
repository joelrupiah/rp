const mix = require('laravel-mix');

mix.js('resources/js/admin.js', 'public/js')
    .js('resources/js/user.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css');
