<!-- Left Sidebar Menu -->
    <div class="fixed-sidebar-left">
      <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
          <span>Main</span> 
          <i class="zmdi zmdi-more"></i>
        </li>
        <li>
          <a class="{{currentPage() ? 'active' :''}}" href="/"><div class="pull-left"><i class=" ti-layout-grid2 mr-20"></i><span class="right-nav-text">{{trans_choice('navbar.dashboard',2)}}</span></div><div class="clearfix"></div></a>
        </li>
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><div class="pull-left"><i class=" ti-archive mr-20"></i><span class="right-nav-text">{{trans_choice('navbar.document',2)}}</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
          <ul id="ecom_dr" class="collapse collapse-level-1">
            <li>
              <a href="{{route('document.index')}}">Document List</a>
            </li>
            <li>
              <a href="{{route('document.create')}}">Manage</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr"><div class="pull-left"><i class="pe-7s-photo mr-20"></i><span class="right-nav-text">{{trans_choice('navbar.file',1)}}</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
          <ul id="app_dr" class="collapse collapse-level-1">
            <li>
              <a href="{{route('file.index')}}">Add</a>
            </li>
            <li>
              <a href="{{route('file.create')}}">Manage</a>
            </li>
          </ul>
        </li>
        <li>
          <a class="{{currentPage('archive') ? 'active' :''}} " href="javascript:void(0);" data-toggle="collapse" data-target="#app_cat"><div class="pull-left"><i class="icon-folder-alt mr-20"></i><span class="right-nav-text">{{trans_choice('navbar.archive',2)}} </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
          <ul id="app_cat" class="collapse collapse-level-1">
            <li>
              <a href="{{route('archive.index')}}">Archive List</a>
            </li>
            <li>
              <a href="{{route('archive.create')}}">Manage</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" class="{{currentPage('organization') ? 'active' :''}}" data-toggle="collapse" data-target="#app_org"><div class="pull-left"><i class="pe-7s-culture mr-20"></i><span class="right-nav-text">{{trans_choice('navbar.organization',2)}} </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
          <ul id="app_org" class="collapse collapse-level-1">
            <li>
              <a href="{{route('organization.index')}}">List</a>
            </li>
            <li>
              <a href="{{route('organization.create')}}">Add</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="widgets.html"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">widgets</span></div><div class="pull-right"><span class="label label-warning">8</span></div><div class="clearfix"></div></a>
        </li>
        <li><hr class="light-grey-hr mb-10"/></li>
        <li class="navigation-header">
          <span>Settings</span> 
          <i class="zmdi zmdi-more"></i>
        </li>
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr"><div class="pull-left"><i class="icon-people mr-20"></i><span class="right-nav-text">{{trans_choice('navbar.user',2)}}</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
          <ul id="ui_dr" class="collapse collapse-level-1 two-col-list">
            <li>
              <a href="panels-wells.html"<i class="pe-7s-add-user mr-20"></i> <span class="right-nav-text">Add</span></a>
            </li>
            <li>
              <a href="modals.html">Modals</a>
            </li>
            
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#form_dr"><div class="pull-left"><i class="ti-settings mr-20"></i><span class="right-nav-text">{{trans_choice('navbar.setting',2)}}</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
          <ul id="form_dr" class="collapse collapse-level-1 two-col-list">
            <li>
              <a href="form-element.html">Basic Forms</a>
            </li>
            <li>
              <a href="form-layout.html">form Layout</a>
            </li>
            <li>
              <a href="form-advanced.html">Form Advanced</a>
            </li>
            
          </ul>
        </li>
       
        <li><hr class="light-grey-hr mb-10"/></li>
       
      </ul>
    </div>
    <!-- /Left Sidebar Menu -->