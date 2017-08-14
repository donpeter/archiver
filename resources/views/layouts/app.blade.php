<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>@yield('title') - {{__('site.longName')}}</title>
    <meta name="description" content="{{config('app.desc')}}" />
    <meta name="keywords" content="belediyesi, lefke belediyesi"/>
    <meta name="author" content="hencework"/>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
     @stack('vendorStyles')
    <link href="{{asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css')}}" rel="stylesheet" type="text/css">
        
    <!-- Custom CSS -->
    <link href="{{asset('dist/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.8.0/css/flag-icon.css" rel="stylesheet" type="text/css">
    
</head>

<body>
    @include('layouts.header')
    <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid">
                
                <!-- Title -->
                <div class="row heading-bg">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-dark">@yield('pageTitle')</h5>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </div>
                    <!-- /Breadcrumb -->
                </div>
                <!-- /Title -->        
            @yield('content')
            @include('layouts.footer')

        </div>
    </div>

