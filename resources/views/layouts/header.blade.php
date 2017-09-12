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
              <span class="brand-text">{{__('site.name')}}</span>
            </a>
          </div>
        </div>  
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
      </div>
      <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
        <li class="dropdown hidden-xs">
          @if (App::isLocale('en'))
              <a data-toggle="dropdown" class="dropdown-toggle menu-item" href="#" aria-expanded="false"><span class="flag-icon flag-icon-gb"></span> English<span class="caret"></span></a>
            <ul role="menu" class="dropdown-menu">
                <li>
                  <a href="{{route('setLocale','tr')}}"><span class="flag-icon flag-icon-tr"></span> Türkçe</a>
                </li>
            </ul>
          @endif
          @if (App::isLocale('tr'))
              <a data-toggle="dropdown" class="dropdown-toggle menu-item" href="#" aria-expanded="false"><span class="flag-icon flag-icon-tr"></span> Türkçe<span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                <li>
                 <a href="{{route('setLocale','en')}}"><span class="flag-icon flag-icon-gb"></span> English</a>
                </li>            
              </ul>
          @endif
            
        </li>
        <li><a href="{{route('logout')}}" class="text-info"><span class="glyphicon glyphicon-log-out"></span> {{__('common.logout')}}</a></li>

        {{-- <!-- Settings -->
          <li>
            <a id="open_right_sidebar" href="javascript:void(0);"><i class="zmdi zmdi-settings top-nav-icon"></i></a>
          </li>
          <!-- /Settings --> --}}
        </ul>
      </div>  
    </nav>
    <!-- /Top Menu Items -->
    @include('layouts.leftmenu')

