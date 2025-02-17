<div class="sidebar sidebar-light sidebar-main sidebar-expand-md" style="background-color: #3F1239; color:#fff !important; font-size:20px !important;">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">Navigation</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">
        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">

            <ul class="nav nav-sidebar" data-nav-type="accordion">
            
                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" class="nav-link legitRipple"><i class="fa-solid fa-chart-simple"></i><span>User Management</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Authorization">
                        @if( auth()->user()->active_role_id == 1)
                        <li class="nav-item"><a href="{{ route('roles.index') }}" title="Roles" class="nav-link legitRipple"><i class="fas fa-user-tag"></i> <span>Roles</span></a></li>
                        @endif
                        <li class="nav-item"><a href="{{ route('users.index') }}" title="Users" class="nav-link legitRipple"><i class="fas fa-keyboard"></i> <span>System Users</span></a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/employees" title="Employee" class="nav-link legitRipple">
                        <i class="fa-solid fa-chart-simple"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" class="nav-link legitRipple"><i class="fa-solid fa-chart-simple"></i><span>User</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Authorization">
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" class="nav-link legitRipple"><i class="fa-solid fa-chart-simple"></i><span>Exam</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Authorization">
                        <li class="nav-item"><a href="" title="Users" class="nav-link legitRipple"><i class="fa-solid fa-circle" style="font-size: 12px; padding-top: 10px !important; color:#f2a0de"></i> <span>Question Bank</span></a></li>
                        <li class="nav-item"><a href="" title="Users" class="nav-link legitRipple"><i class="fa-solid fa-circle" style="font-size: 12px; padding-top: 10px !important; color:#f2a0de"></i> <span>SAT</span></a></li>
                        <li class="nav-item"><a href="" title="Users" class="nav-link legitRipple"><i class="fa-solid fa-circle" style="font-size: 12px; padding-top: 10px !important; color:#f2a0de"></i> <span>Test</span></a></li>
                        <li class="nav-item"><a href="" title="Users" class="nav-link legitRipple"><i class="fa-solid fa-circle" style="font-size: 12px; padding-top: 10px !important; color:#f2a0de"></i> <span>Result</span></a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" class="nav-link legitRipple"><i class="fa-solid fa-chart-simple"></i><span>Discount</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Authorization">
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" class="nav-link legitRipple"><i class="fa-solid fa-chart-simple"></i><span>Subscrition</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Authorization">
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" class="nav-link legitRipple"><i class="fa-solid fa-chart-simple"></i><span>Message</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Authorization">
                    </ul>
                </li>

            </ul>

            <ul class="nav nav-sidebar" data-nav-type="accordion" style="position: fixed; bottom:0">
                <li class="nav-item" style="padding-left: 14px">
                    <a href="#" title="Employee" class="nav-link legitRipple" style="background-color: transparent">
                        <i class="fa-solid fa-gear" style="padding-top: 5px !important;"></i>
                        <span>
                            Website setting
                        </span>
                    </a>
                </li>
            </ul>


        </div>
        <!-- /main navigation -->
    </div>
    <!-- /sidebar content -->

</div>

<style>

</style>
