<!--Preloader-->
<div class="preloader-it">
  <div class="la-anim-1"></div>
</div>
<!--/Preloader-->

<div class="wrapper pa-0">
  <header class="sp-header">
    <div class="sp-logo-wrap pull-left">
      <a href="index.html">
        <img class="brand-img mr-10" src="dist/img/logo.png" alt="brand"/>
        <span class="brand-text">{{config('app.longName')}}</span>
      </a>
    </div>
    @if(activePath('login'))
      <div class="form-group mb-0 pull-right">
        <span class="inline-block pr-10">Don't have an account?</span>
        <a class="inline-block btn btn-info btn-rounded btn-outline" href="{{route('register')}}">Sign Up</a>
      </div>
    @else
      <div class="form-group mb-0 pull-right">
        <span class="inline-block pr-10">Already have an account?</span>
        <a class="inline-block btn btn-info btn-rounded btn-outline" href="{{route('login')}}">Sign In</a>
      </div>
    @endif

    <div class="clearfix"></div>
  </header>
  