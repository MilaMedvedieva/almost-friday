const mix = require('laravel-mix');

mix.js('src/js/app.js', 'dist/js')
    .sass('src/scss/app.scss', 'dist/css')
    .copy('src/images', 'dist/images')
    .copy('src/fonts', 'dist/fonts')
    .options({
        processCssUrls: false
    })

mix.config.fileLoaderDirs.fonts = 'dist/fonts';
mix.config.fileLoaderDirs.images = 'dist/images';

