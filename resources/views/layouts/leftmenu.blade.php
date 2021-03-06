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
      <a href="javascript:void(0);" class="{{activePath('document') ? 'active' :''}}" data-toggle="collapse" data-target="#nav_document">
        <div class="pull-left">
          <i class=" ti-archive mr-20"></i>
          <span class="right-nav-text">{{__('navbar.documents')}} </span>
        </div>
        <div class="pull-right">
          <i class="zmdi zmdi-caret-down"></i>
        </div>
        <div class="clearfix"></div>
      </a>
      <ul id="nav_document" class="collapse collapse-level-1">
        <li>
          <a href="{{route('document.index')}}" class="{{activePage('document') ? 'active-page' :''}}">
            {{__('navbar.manage').' '.__('navbar.documents') }}
          </a>
        </li>
        <li>
          <a href="{{route('document.create')}}" class="{{activePage('document/create') ? 'active-page' :''}}">
            {{__('common.add').' '.trans_choice('navbar.document', 1) }}
          </a>
        </li>
        <li>
          <a href="{{route('document.trash')}}" class="{{activePage('documents/trash') ? 'active-page' :''}}">
            {{trans_choice('navbar.trash', 1) }}
          </a>
        </li>
      </ul>
    </li>
    <li>
      <a href="javascript:void(0);" class="{{activePath('organization') ? 'active' :''}}" data-toggle="collapse" data-target="#nav_organization"><div class="pull-left"><i class="pe-7s-culture mr-20"></i><span class="right-nav-text">{{__('navbar.organizations')}} </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
      <ul id="nav_organization" class="collapse collapse-level-1">
        <li>
          <a href="{{route('organization.index')}}" class="{{activePage('organization') ? 'active-page' :''}}">
            {{__('navbar.manage').' '.__('navbar.organizations') }}
          </a>
        </li>
        <li>
          <a href="{{route('organization.trash')}}" class="{{activePage('organizations/trash') ? 'active-page' :''}}">
            {{__('navbar.trash')}}
          </a>
        </li>
        
      </ul>
      
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
      <a class="{{activePath('folder') ? 'active' :''}} " href="javascript:void(0);" data-toggle="collapse" data-target="#nav_folder"><div class="pull-left"><i class="icon-folder-alt mr-20"></i><span class="right-nav-text">{{__('navbar.folders')}} </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
      <ul id="nav_folder" class="collapse collapse-level-1">
        <li>
          <a href="{{route('folder.index')}}" class="{{activePage('folder') ? 'active-page' :''}}">
            {{__('navbar.manage').' '.__('navbar.folders') }}
          </a>
        </li>
        <li>
          <a href="{{route('folder.trash')}}" class="{{activePage('folders/trash') ? 'active-page' :''}}">
            {{__('navbar.trash') }}
          </a>
        </li>
        
      </ul>
    </li>
    
    @if(Auth::user()->role === 'admin')
    <li><hr class="light-grey-hr mb-10"/></li>
    <li class="navigation-header">
      <span>{{__('navbar.settings')}}</span> 
      <i class="zmdi zmdi-more"></i>
    </li>
    <li>
      <a href="javascript:void(0);" class="{{activePath('user') ? 'active' :''}}" data-toggle="collapse" data-target="#nav_user"><div class="pull-left"><i class="icon-people mr-20"></i><span class="right-nav-text">{{__('navbar.users')}}</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
      <ul id="nav_user" class="collapse collapse-level-1">
        <li>
          <a href="{{route('user.index')}}" class="{{activePage('user') ? 'active-page' :''}}">
            {{__('navbar.manage').' '.__('navbar.users') }}
          </a>
        </li>
        <li>
          <a href="{{route('user.trash')}}" class="{{activePage('users/trash') ? 'active-page' :''}}">
            {{__('navbar.trash') }}
          </a>
        </li>
        
      </ul>
    </li>
   
    <li><hr class="light-grey-hr mb-10"/></li>
    @endif
   
  </ul>
</div>
<!-- /Left Sidebar Menu -->