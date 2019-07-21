const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
.js('resources/js/uikit/uikit.js', 'public/js/uikit')
    .sass('resources/sass/app.scss', 'public/css');
