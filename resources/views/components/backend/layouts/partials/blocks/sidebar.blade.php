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

            <div class="navbar-brand navbar-brand-md">
                <a href="index.html" class="d-inline-block">
                   <a href="#" class="p-0 m-0 pr-1 navbar-nav-link d-none d-md-block ml-4 legitRipple justify-content-between align-items-center" style="display: flex !important">
                      <span class="d-flex">
                         @if (isset($general->logo))
                            <img src="{{ asset('storage/' . ($general->logo)) }}" alt="Avatar" style="border-radius:50%; height: 40px">
                            @else
                            <img src="{{ asset('image/user-icon.png') }}" alt="Avatar" style="border-radius:50%; height: 40px">
                         @endif
                         <div class="ml-3">
                            <p class="text-white m-0 p-0" style="font-size:16px !important">Karim Mansouri</p>
                            <p class="text-white p-0 m-0" style="font-size:12px !important">Karim</p>
                         </div>
                      </span>
                      {{-- <i class="fa-solid fa-angles-left text-white" style="font-size:16px !important"></i> --}}
                  </a>
                </a>
             </div>

            <ul class="nav nav-sidebar" data-nav-type="accordion">
                
            
                <li class="nav-item">
                    <a href="/" title="Overview" class="nav-link legitRipple m-0 ml-2 mr-2">
                        <img src="{{ asset('image/icon/overview.png') }}" alt="" class="mr-3" style="width: 16px; height: 16px;">
                        <span>
                            Overview
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/" title="Send Notifications" class="nav-link legitRipple m-0 ml-2 mr-2">
                        <img src="{{ asset('image/icon/notification.png') }}" alt="" class="mr-3" style="width: 16px; height: 16px;">
                        <span>
                            Send Notifications
                        </span>
                    </a>
                </li>

                <hr style="border-top:1px solid #65416B; width:90%">

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" title="Manage Members" class="nav-link legitRipple m-0 ml-2 mr-2">
                        <img src="{{ asset('image/icon/manage-member.png') }}" alt="" class="mr-3" style="width: 16px; height: 16px;">
                        <span>Manage Members</span>
                    </a>
                    <ul class="nav nav-group-sub" data-submenu-title="Authorization">
                        {{-- <li class="nav-item"><a href="" title="Users" class="nav-link legitRipple m-0 ml-2 mr-2"><span>Question Bank</span></a></li> --}}
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" title="Manage Questions" class="nav-link legitRipple m-0 ml-2 mr-2">
                        <img src="{{ asset('image/icon/manage-question.png') }}" alt="" class="mr-3" style="width: 16px; height: 16px;">
                        <span>Manage Questions</span>
                    </a>
                    <ul class="nav nav-group-sub" data-submenu-title="Authorization">
                        <li class="nav-item"><a href="{{ route('question.index') }}" title="Users" class="nav-link legitRipple m-0 ml-2 mr-2 active"><span>All Questions</span></a></li>
                        <li class="nav-item"><a href="" title="Users" class="nav-link legitRipple m-0 ml-2 mr-2"><span>All Question Exams</span></a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" title="Manage Tests" class="nav-link legitRipple m-0 ml-2 mr-2">
                        <img src="{{ asset('image/icon/manage-test.png') }}" alt="" class="mr-3" style="width: 16px; height: 16px;">
                        <span>Manage Tests</span>
                    </a>
                    <ul class="nav nav-group-sub" data-submenu-title="Authorization">
                        {{-- <li class="nav-item"><a href="" title="Users" class="nav-link legitRipple m-0 ml-2 mr-2"><span>Question Bank</span></a></li> --}}
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" title="Manage Packages" class="nav-link legitRipple m-0 ml-2 mr-2">
                        <img src="{{ asset('image/icon/manage-package.png') }}" alt="" class="mr-3" style="width: 16px; height: 16px;">
                        <span>Manage Packages</span>
                    </a>
                    <ul class="nav nav-group-sub" data-submenu-title="Authorization">
                        {{-- <li class="nav-item"><a href="" title="Users" class="nav-link legitRipple m-0 ml-2 mr-2"><span>Question Bank</span></a></li> --}}
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu parent-nav-item-submenu">
                    <a href="#" title="Manage Website" class="nav-link legitRipple m-0 ml-2 mr-2">
                        <img src="{{ asset('image/icon/manage-website.png') }}" alt="" class="mr-3" style="width: 16px; height: 16px;">
                        <span>Manage Website</span>
                    </a>
                    <ul class="nav nav-group-sub" data-submenu-title="Authorization">
                        {{-- <li class="nav-item"><a href="" title="Users" class="nav-link legitRipple m-0 ml-2 mr-2"><span>Question Bank</span></a></li> --}}
                    </ul>
                </li>

                <hr style="border-top:1px solid #65416B; width:90%">

                <li class="nav-item">
                    <a href="/" title="Reviews & Ratings" class="nav-link legitRipple m-0 ml-2 mr-2">
                        <img src="{{ asset('image/icon/review.png') }}" alt="" class="mr-3" style="width: 16px; height: 16px;">
                        <span>
                            Reviews & Ratings
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/" title="Feedbacks" class="nav-link legitRipple m-0 ml-2 mr-2">
                        <img src="{{ asset('image/icon/feedback.png') }}" alt="" class="mr-3" style="width: 16px; height: 16px;">
                        <span>
                            Feedbacks
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/" title="Event Log" class="nav-link legitRipple m-0 ml-2 mr-2">
                        <img src="{{ asset('image/icon/event.png') }}" alt="" class="mr-3" style="width: 16px; height: 16px;">
                        <span>
                            Event Log
                        </span>
                    </a>
                </li>


            </ul>

            <ul class="nav nav-sidebar" data-nav-type="accordion" style="">

                <hr class="ml-2" style="border-top:1px solid #65416B; width:90%">

                <li class="nav-item">
                    <a href="{{ route('logout') }}" title="Employee" class="nav-link legitRipple m-0 ml-2" onclick="event.preventDefault(); this.closest('form').submit();">
                        <img src="{{ asset('image/icon/logout.png') }}" alt="" class="mr-3" style="width: 16px; height: 16px;">
                        <span>
                            Log out
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
