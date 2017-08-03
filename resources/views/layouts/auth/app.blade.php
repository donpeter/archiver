<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="description" content="Hound is a Dashboard & Admin Site Responsive Template by hencework." />
    <meta name="keywords" content="lefke, belediyesi, lefke belediyesi, dubemtech" />
    <meta name="author" content="Don Peter C. Atunalu"/>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    
    <!-- vector map CSS -->
    <link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
    
    
    
    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    @include('layouts.auth.nav')
    @yield('content')


    <!-- JavaScript -->
    
    <!-- jQuery -->
    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
    
    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>
    
    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
  </body>
</html>
