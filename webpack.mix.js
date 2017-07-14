const { mix } = require('laravel-mix');

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

// Copy main css files to assets folder as sass file extension or laravel-mix won't work
// var fs = require('fs');
// var exists = fs.existsSync('resources/assets/sass/materialize.scss');
// if(exists == false)
  mix.copy('public/materialize-css/css/materialize.css', 'resources/assets/sass/materialize.scss');

// var exists = fs.existsSync('resources/assets/sass/materialize-xl.scss');
// if(exists == false)
  mix.copy('public/css/materialize-xl.css', 'resources/assets/sass/materialize-xl.scss');

// var exists = fs.existsSync('resources/assets/sass/style.scss');
// if(exists == false)
  mix.copy('public/css/style.css', 'resources/assets/sass/style.scss');



mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');


mix.browserSync(process.env.MIX_APP_URL);