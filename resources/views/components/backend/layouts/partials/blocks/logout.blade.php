<a href="#" class="navbar-nav-link dropdown-toggle caret-0" title={{__('Logout')}} data-target="#headerLogoutDropdown" data-toggle="dropdown" aria-expanded="false">
    <i class="icon-switch2"></i>
    <span class="d-md-none ml-2">Logout</span>
</a>

<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350t" id="headerLogoutDropdown" >
    <a href="/profile" class="dropdown-item"><i class="icon-user-lock"></i> Profile</a>
    <form method="POST" action="{{ Route::has('logout') ? route('logout') : "#" }}">
        @csrf

        <a href="route('logout')" class="dropdown-item"
        onclick="event.preventDefault();
                            this.closest('form').submit();"
        >
            <i class="icon-logout"></i>
            {{ __('Log out') }}
        </a>
    </form>
</div>
