<!-- Left Sidebar Menu -->
<div class="fixed-sidebar-left">
  <ul class="nav navbar-nav side-nav nicescroll-bar">
    <li class="navigation-header">
      <span>Main</span> 
      <i class="zmdi zmdi-more"></i>
    </li>
    <li>
      <a class="{{activePath('/') ? 'active' :''}}" href="/"><div class="pull-left"><i class=" ti-layout-grid2 mr-20"></i><span class="right-nav-text">{{trans_choice('navbar.dashboard',2)}}</span></div><div class="clearfix"></div></a>
    </li>
    <li>
      <a href="javascript:void(0);" class="{{activePath('document') ? 'active' :''}}" data-toggle="collapse" data-target="#ecom_dr">
        <div class="pull-left">
          <i class=" ti-archive mr-20"></i>
          <span class="right-nav-text">{{trans_choice('navbar.document',2)}} </span>
        </div>
        <div class="pull-right">
          <i class="zmdi zmdi-caret-down"></i>
        </div>
        <div class="clearfix"></div>
      </a>
      <ul id="ecom_dr" class="collapse collapse-level-1">
        <li>
          <a href="{{route('document.index')}}" class="{{activePage('document') ? 'active-page' :''}}">
            {{__('navbar.all').' '.trans_choice('navbar.document', 2) }}
          </a>
        </li>
        <li>
          <a href="{{route('document.create')}}" class="{{activePage('document/create') ? 'active-page' :''}}">
            {{__('navbar.manage').' '.trans_choice('navbar.document', 2) }}
          </a>
        </li>
      </ul>
    </li>
    <li>
      <a href="{{route('organization.index')}}" class="{{activePath('organization') ? 'active' :''}}" data-toggle="collapse" data-target="#app_org"><div class="pull-left"><i class="pe-7s-culture mr-20"></i><span class="right-nav-text">{{trans_choice('navbar.organization',2)}} </span></div><div class="clearfix"></div></a>
      
    </li>
    {{-- <li>
      <a href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr"><div class="pull-left"><i class="pe-7s-photo mr-20"></i><span class="right-nav-text">{{trans_choice('navbar.file',1)}}</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
      <ul id="app_dr" class="collapse collapse-level-1">
        <li>
          <a href="{{route('file.index')}}" class="{{activePage('file') ? 'active-page' :''}}">
            {{__('navbar.all').' '.trans_choice('navbar.file', 2) }}
          </a>
        </li>
        <li>
          <a href="{{route('file.create')}}" class="{{activePage('file/create') ? 'active-page' :''}}">
            {{__('navbar.manage').' '.trans_choice('navbar.file', 2) }}

          </a>
        </li>
      </ul>
    </li> --}}
    <li>
      <a class="{{activePath('folder') ? 'active' :''}} " href="javascript:void(0);" data-toggle="collapse" data-target="#app_cat"><div class="pull-left"><i class="icon-folder-alt mr-20"></i><span class="right-nav-text">{{trans_choice('navbar.folder',2)}} </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
      <ul id="app_cat" class="collapse collapse-level-1">
        <li>
          <a href="{{route('folder.index')}}" class="{{activePage('folder/create') ? 'active-page' :''}}">
            {{__('navbar.all').' '.trans_choice('navbar.folder', 2) }}
          </a>
        </li>
        <li>
          <a href="{{route('folder.create')}}" class="{{activePage('folder/create') ? 'active-page' :''}}">
            {{__('navbar.manage').' '.trans_choice('navbar.folder', 2) }}
          </a>
        </li>
      </ul>
    </li>
    
    @if(Auth::user()->role === 'admin')
    <li><hr class="light-grey-hr mb-10"/></li>
    <li class="navigation-header">
      <span>Settings</span> 
      <i class="zmdi zmdi-more"></i>
    </li>
    <li>
      <a href="{{route('user.index')}}" class="{{activePath('user') ? 'active' :''}} data-toggle="collapse" data-target="#ui_dr"><div class="pull-left"><i class="icon-people mr-20"></i><span class="right-nav-text">{{trans_choice('navbar.user',2)}}</span></div> <div class="clearfix"></div></a>
    </li>
    <li>
      <a href="javascript:void(0);" data-toggle="collapse" data-target="#form_dr"><div class="pull-left"><i class="ti-settings mr-20"></i><span class="right-nav-text">{{trans_choice('navbar.setting',2)}}</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
      <ul id="form_dr" class="collapse collapse-level-1 two-col-list">
        <li>
          <a href="">Basic Forms</a>
        </li>
        <li>
          <a href="">form Layout</a>
        </li>
      </ul>
    </li>
   
    <li><hr class="light-grey-hr mb-10"/></li>
    @endif
   
  </ul>
</div>
<!-- /Left Sidebar Menu -->