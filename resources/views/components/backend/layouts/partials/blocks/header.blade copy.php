<div class="navbar navbar-expand-md navbar-dark bg-teal-800">
    <div class="navbar-brand wmin-0 p-0 m-0 mt-2 mr-1"></div>
    <div class="d-md-none">
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
       <i class="icon-circle-down2"></i>
       </button>
       <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
       <i class="icon-circle-left2"></i>
       </button>
       <button class="navbar-toggler sidebar-mobile-right-toggle" type="button">
       <i class="icon-circle-right2"></i>
       </button>
    </div>
    <div class="collapse navbar-collapse ml-lg-5 ml-1" id="navbar-mobile">
       <ul class="navbar-nav">
          
       </ul>
       <ul class="navbar-nav ml-md-auto">
       </ul>
       <ul class="navbar-nav ml-md-auto">
       </ul>
       <ul class="navbar-nav ml-md-auto">
          <a href="#" class="navbar-nav-link dropdown-toggle caret-0 legitRipple" title="Logout" data-target="#headerLogoutDropdown" data-toggle="dropdown" aria-expanded="false">
          <i class="icon-switch2"></i>
          <span class="d-md-none ml-2">Logout</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350t" id="headerLogoutDropdown">
             <a href="/profile" class="dropdown-item"><i class="icon-user-lock"></i> Profile</a>
             <form method="POST" action="https://dev.sentineltechno.com/logout">
                <input type="hidden" name="_token" value="axGGMptSzew1lbDhLBi44VO1t3WYm35tKUjJbxZ0" autocomplete="off">
                <a href="route('logout')" class="dropdown-item" onclick="event.preventDefault();
                   this.closest('form').submit();">
                <i class="icon-logout"></i>
                Log out
                </a>
             </form>
          </div>
       </ul>
    </div>
 </div>