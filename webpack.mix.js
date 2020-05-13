const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin.js', 'public/js')
    .sass('resources/sass/rtl.scss', 'public/css')
    .sass('resources/sass/ltr.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')

if (mix.inProduction()) {
    mix.version();
}
