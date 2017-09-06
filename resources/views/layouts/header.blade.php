  <!-- Preloader -->
  <div class="preloader-it">
    <div class="la-anim-1"></div>
  </div>
  <!-- /Preloader -->
    <div class="wrapper theme-4-active pimary-color-red">
    <!-- Top Menu Items -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
          <div class="logo-wrap">
            <a href="index.html">
              <img class="brand-img" src="{{asset('dist/img/logo.png')}}" alt="brand"/>
              <span class="brand-text">{{__('site.name')}} Peter</span>
            </a>
          </div>
        </div>  
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
      </div>
      <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
        <li><a href="{{route('logout')}}" class="text-info"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>

        <!-- Settings -->
          <li>
            <a id="open_right_sidebar" href="javascript:void(0);"><i class="zmdi zmdi-settings top-nav-icon"></i></a>
          </li>
          <!-- /Settings -->
        </ul>
      </div>  
    </nav>
    <!-- /Top Menu Items -->
    @include('layouts.leftmenu')

    @include('layouts.rightmenu')