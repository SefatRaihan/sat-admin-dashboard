<!-- User menu -->
<div class="sidebar-user-material p-0 m-0">
    <div class="sidebar-user-material-body p-0 m-0" style="background: url({{asset($bg)}}) center center no-repeat;background-size: cover;">
        <div class="card-body text-center p-0 m-0">
            <a href="#">
                <img src="{{$userAvatar}}" class="img-fluid rounded-circle shadow-1 p-0 mt-1" width="70" height="70" alt="">
            </a>
            <h6 class="p-0 m-0 text-white text-shadow-dark">{{auth()->user()->name}}</h6>
            <span class="p-0 m-0 font-size-sm text-white text-shadow-dark" >Dhaka, Bangladesh</span>
        </div>
                                    
        <div class="sidebar-user-material-footer">
            <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>My account</span></a>
        </div>
    </div>

    <div class="collapse p-0 m-0" id="user-nav">
        <ul class="nav nav-sidebar">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="icon-user-plus"></i>
                    <span>My profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="icon-cog5"></i>
                    <span>Account settings</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- /user menu -->
