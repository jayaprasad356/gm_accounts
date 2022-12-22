<div id="sidebarMain" class="d-none">
    <aside
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container text-capitalize">
            <div class="navbar-vertical-footer-offset">
                <div class="navbar-brand-wrapper justify-content-between">
                    <!-- Logo -->

                    @php($restaurant_logo=\App\Model\BusinessSetting::where(['key'=>'logo'])->first()->value)
                    <a class="navbar-brand" href="{{route('admin.dashboard')}}" aria-label="Front">
                        <img class="navbar-brand-logo"
                             onerror="this.src='{{asset('public/assets/admin/img/160x160/img3.jpg')}}'"
                             src="{{asset('storage/app/public/restaurant/'.$restaurant_logo)}}"
                             alt="Logo">
                        <img class="navbar-brand-logo-mini"
                             onerror="this.src='{{asset('public/assets/admin/img/160x160/img3.jpg')}}'"
                             src="{{asset('storage/app/public/restaurant/'.$restaurant_logo)}}" alt="Logo">
                    </a>

                    <!-- End Logo -->

                    <!-- Navbar Vertical Toggle -->
                    <button type="button"
                            class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>

                <!-- Content -->
                <div class="navbar-vertical-content">
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">

                        <!-- Dashboards -->
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin')?'show':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('admin.dashboard')}}" title="{{translate('Dashboards')}}">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        {{translate('dashboard')}}
                                    </span>
                            </a>
                        </li>
                        <!-- End Dashboards -->

                        @if(Helpers::module_permission_check(MANAGEMENT_SECTION['client_management']))
                          
                          <!-- Pages -->
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/client/index')?'active':''}}">
                              <a class="js-navbar-vertical-aside-menu-link nav-link"
                                 href="{{route('admin.client.list')}}">
                                  <i class="tio-user nav-icon"></i>
                                  <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                      {{translate('Clients')}}
                                  </span>
                              </a>
                          </li>

                        
                          <!-- End Pages -->
                      @endif


                      @if(Helpers::module_permission_check(MANAGEMENT_SECTION['project_management']))
                          
                          <!-- Pages -->
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/project/index')?'active':''}}">
                              <a class="js-navbar-vertical-aside-menu-link nav-link"
                                 href="{{route('admin.project.list')}}">
                                  <i class="tio-circle nav-icon"></i>
                                  <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                      {{translate('Projects')}}
                                  </span>
                              </a>
                          </li>
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/income/index')?'active':''}}">
                              <a class="js-navbar-vertical-aside-menu-link nav-link"
                                 href="{{route('admin.income.list')}}">
                                  <i class="tio-money nav-icon"></i>
                                  <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                      {{translate('Income Details')}}
                                  </span>
                              </a>
                          </li>
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/staff/index')?'active':''}}">
                              <a class="js-navbar-vertical-aside-menu-link nav-link"
                                 href="{{route('admin.staff.list')}}">
                                  <i class="tio-user nav-icon"></i>
                                  <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                      {{translate('Staffs')}}
                                  </span>
                              </a>
                          </li>

                        
                          <!-- End Pages -->
                      @endif

                      


                        <li class="nav-item" style="padding-top: 100px">
                            <div class=""></div>
                        </li>
                    </ul>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </aside>
</div>

<div id="sidebarCompact" class="d-none">

</div>


{{--<script>
    $(document).ready(function () {
        $('.navbar-vertical-content').animate({
            scrollTop: $('#scroll-here').offset().top
        }, 'slow');
    });
</script>--}}
