const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management - KenyaeTIMS Module
 |--------------------------------------------------------------------------
 */

mix.js(__dirname + '/Resources/assets/js/app.js', 'public/modules/kenyaetims/js')
   .sass(__dirname + '/Resources/assets/sass/app.scss', 'public/modules/kenyaetims/css');
