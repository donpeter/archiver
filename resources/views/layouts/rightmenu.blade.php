<!-- Right Sidebar Menu -->
<div class="fixed-sidebar-right">
  <ul class="right-sidebar container">
    <a href="javascript:void(0);" class="right-bar-toggle">
        <i class="mdi mdi-close-circle-outline"></i>
    </a>
    <h4 class="">Settings</h4>
    <div class="setting-list nicescroll">
        <div class="row m-t-20">
            <div class="col-xs-8">
                <h5 class="m-0">Notifications</h5>
                <p class="text-muted m-b-0"><small>Do you need them?</small></p>
            </div>
            <div class="col-xs-4 text-right">
                <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small"/>
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col-xs-8">
                <h5 class="m-0">Auto Updates</h5>
                <p class="m-b-0 text-muted"><small>Keep up to date</small></p>
            </div>
            <div class="col-xs-4 text-right">
                <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small"/>
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col-xs-8">
                <h5 class="m-0">Online Status</h5>
                <p class="m-b-0 text-muted"><small>Show your status to all</small></p>
            </div>
            <div class="col-xs-4 text-right">
                <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small"/>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-xs-8" data-toggle="collapse" data-target="#app_lang">
                <h5 class="m-0">
                  <a href="javascript:void(0);">Language </a>
                </h5>
                <p class="m-b-0 text-muted" ><small>Choose Language</small></p>
                <ul id="app_lang" class="collapse collapse-level-1">
                  <li>
                    <span class="flag-icon flag-icon-gb mr-10"></span><a href="{{route('setLocale','en')}}">English</a>
                  </li>
                  <li>
                    <span class="flag-icon flag-icon-tr mr-10"></span><a href="{{route('setLocale','tr')}}">Turkish</a>
                  </li>
                </ul>
            </div>
        </div>
    </div>

  </ul>
</div>
</div>
<!-- /Right Sidebar Menu <--> 