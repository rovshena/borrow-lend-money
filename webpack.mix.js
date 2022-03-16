const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/code-mirror.js', 'public/assets/dashboard/js').version();
mix.postCss('resources/css/code-mirror.css', 'public/assets/dashboard/css').version();

mix.js('resources/js/app.js', 'public/assets/visitor/js/app.min.js')
    .vue()
    .webpackConfig({
        resolve: {
            alias: {
                'vue$': mix.inProduction() ? 'vue/dist/vue.min' : 'vue/dist/vue.js'
            }
        }
    });
