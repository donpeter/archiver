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

// mix.js([
//     'resources/assets/js/app.js',
//     'resources/assets/js/custom/document.js'
//   ], 'public/js');
  // .sass('resources/assets/sass/app.scss', 'public/css');
// mix.styles([
//   'resources/assets/css/datatable.min.css',
//   ],'public/css/datatable.min.css', 'public/css');
/*mix.scripts([
  'resources/assets/js/custom/datatable/datatable.min.js',
  'resources/assets/js/custom/datatable/datatable.js',
  ],'public/js/datatable.js', 'public/js');

mix.scripts([
  'resources/assets/js/custom/editabletable/editabletable.min.js',
  'resources/assets/js/custom/editabletable/editabletable.js',
  ],'public/js/editabletable.js', 'public/js');*/


/*mix.scripts([
  'resources/assets/js/custom/datatable/datatable.min.js',
  'resources/assets/js/custom/datatable/datatable.js',
  'resources/assets/bower/axios/dist/axios.min.js',
  'resources/assets/bower/sweetalert/dist/sweetalert.min.js',
  'resources/assets/js/custom/folder.js',
  ],'public/js/folder.js', 'public/js');*/

// mix.scripts([
// 'resources/assets/bower/jquery/dist/jquery.min.js',
// 'resources/assets/bower/bootstrap/dist/js/bootstrap.min.js',
// 'resources/assets/bower/jquery-slimscroll/jquery.slimscroll.min.js',

// ],'public/js/bundle.min.js', 'public/js');

/*mix.scripts([
  'resources/assets/bower/sweetalert/dist/sweetalert.min.js',
  'resources/assets/bower/axios/dist/axios.min.js',
  'resources/assets/js/custom/datatable/datatable.min.js',
  'resources/assets/js/custom/organization.js',

  ],'public/js/organization.min.js', 'public/js');*/



/*mix.scripts([
  'resources/assets/bower/axios/dist/axios.min.js',
  'resources/assets/bower/bootstrap-fileinput/js/fileinput.min.js',
  'resources/assets/js/custom/datatable/datatable.min.js',
  'resources/assets/bower/sweetalert/dist/sweetalert.min.js',
  //'resources/assets/bower/moment/min/moment-with-locales.min.js'
  'node_modules/lightbox2/dist/js/lightbox.min.js',
  'resources/assets/bower/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js',
  'resources/assets/js/custom/document-create.js',
  ],'public/js/document.min.js', 'public/js')
  .styles([
    'resources/assets/bower/bootstrap-fileinput/css/fileinput.min.css',
    'resources/assets/bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
    'resources/assets/bower/sweetalert/dist/sweetalert.css',
    'node_modules/lightbox2/dist/css/lightbox.min.css',
    ],'public/css/document.min.css' );*/

  //   mix.js([
  //   'resources/assets/js/custom/document.js'
  // ], 'public/js/documents');


  mix.scripts([
    'resources/assets/bower/sweetalert/dist/sweetalert.min.js',
    'resources/assets/bower/axios/dist/axios.min.js',
    'resources/assets/js/custom/datatable/datatable.min.js',
    'resources/assets/js/custom/user.js',

    ],'public/js/user.min.js', 'public/js');