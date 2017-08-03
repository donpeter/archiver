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

/*mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');*/
mix.styles([
  'resources/assets/css/datatable.min.css',
  ],'public/css/datatable.min.css', 'public/css');
/*mix.scripts([
  'resources/assets/js/custom/datatable/datatable.min.js',
  'resources/assets/js/custom/datatable/datatable.js',
  ],'public/js/datatable.js', 'public/js');

mix.scripts([
  'resources/assets/js/custom/editabletable/editabletable.min.js',
  'resources/assets/js/custom/editabletable/editabletable.js',
  ],'public/js/editabletable.js', 'public/js');
mix.scripts([
  'resources/assets/js/custom/datatable/datatable.min.js',
  'resources/assets/js/custom/datatable/datatable.js',
  'resources/assets/js/custom/archive.js',
  ],'public/js/archive.js', 'public/js');*/

// mix.scripts([
// 'resources/assets/bower/jquery/dist/jquery.js',
// 'resources/assets/bower/bootstrap/dist/js/bootstrap.js',
// 'resources/assets/bower/jquery-slimscroll/jquery.slimscroll.js',
// 'resources/assets/bower/switchery/dist/switchery.js',

// ],'public/js/bundle.min.js', 'public/js');
// mix.scripts([
//   'resources/assets/bower/sweetalert/dist/sweetalert.min.js',
//   'resources/assets/bower/axios/dist/axios.min.js',
//   'resources/assets/js/custom/datatable/datatable.min.js',
//   'resources/assets/js/custom/organization.js',

//   ],'public/js/organization.min.js', 'public/js');
// mix.scripts([
//   'resources/assets/bower/sweetalert/dist/sweetalert.min.js',
//   'resources/assets/bower/axios/dist/axios.min.js',
//   'resources/assets/bower/bootstrap-fileinput/js/fileinput.min.js'
//   'resources/assets/js/custom/datatable/datatable.min.js',
//   'resources/assets/js/custom/file.js',

//   ],'public/js/file.min.js', 'public/js');