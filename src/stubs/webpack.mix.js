let mix = require('laravel-mix')
require('laravel-mix-tailwind')
require('laravel-mix-purgecss')

mix.js('resources/assets/js/app.js', 'js')
   .less('resources/assets/less/app.less', 'css')
   .tailwind()
   .purgeCss()
