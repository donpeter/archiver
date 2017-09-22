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
            <a href="{{route('home')}}">
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
                <a data-toggle="dropdown" class="dropdown-toggle menu-item" href="#" aria-expanded="false"><span class="flag-icon flag-icon-gb mr-5"></span>English <span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                  <li>
                    <a href="{{route('setLocale','tr')}}"><span class="flag-icon flag-icon-tr"></span> Türkçe</a>
                  </li>
              </ul>
            @endif
            @if (App::isLocale('tr'))
                <a data-toggle="dropdown" class="dropdown-toggle menu-item" href="#" aria-expanded="false"><span class="flag-icon flag-icon-tr mr-5"></span>Türkçe <span class="caret"></span></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                   <a href="{{route('setLocale','en')}}"><span class="flag-icon flag-icon-gb"></span> English</a>
                  </li>            
                </ul>
            @endif
              
          </li>
          <li>
            <a href="{{route('user.profile')}}"><i class="zmdi zmdi-account mr-10"></i><span>Profile</span></a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="{{route('logout')}}"><i class="zmdi zmdi-power mr-10"></i><span>{{__('common.logout')}}</span></a>
          </li>
        </ul>
      </div>  
    </nav>
    <!-- /Top Menu Items -->
    @include('layouts.leftmenu')

