<div class="navbar navbar-expand-md navbar-light">

   <!-- Header with logos -->
   @php
      $general = \App\Models\General::latest()->first();
   @endphp
   <div class="navbar-header d-none d-md-flex align-items-md-center" style="background-color: #3F1239;">
      <div class="navbar-brand navbar-brand-md">
         <a href="index.html" class="d-inline-block">
            <a href="#" class="p-0 m-0 pr-1 navbar-nav-link d-none d-md-block legitRipple justify-content-between align-items-center" style="display: flex !important">
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
      
      {{-- <div class="navbar-brand navbar-brand-xs">
         <a href="index.html" class="d-inline-block">
            <a href="#" class="p-0 m-0 pl-3 navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block legitRipple justify-content-between align-items-center" style="display: flex !important">
               <i class="fa-solid fa-angles-right text-white" style="font-size16px !important"></i>
           </a>
         </a>
      </div> --}}
   </div>
   <!-- /header with logos -->


   <!-- Mobile controls -->
   <div class="d-flex flex-1 d-md-none">
      <div class="navbar-brand mr-auto">
         <a href="index.html" class="d-inline-block">
            <a href="#" class="p-0 m-0 pr-1 navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block legitRipple justify-content-between align-items-center" style="display: flex !important">
               <span>
                  @if (isset($general->logo))
                     <img src="{{ asset('storage/' . ($general->logo)) }}" alt="Avatar" style="border-radius:50%; height: 40px">
                  @else
                     <img src="{{ asset('image/user-icon.png') }}" alt="Avatar" style="border-radius:50%; height: 40px">
                  @endif
               </span>
               <i class="fa-solid fa-angles-left text-white" style="font-size16px !important"></i>
           </a>
         </a>
      </div>	

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
         <i class="icon-tree5"></i>
      </button>

      <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
         <i class="icon-paragraph-justify3"></i>
      </button>
   </div>
   <!-- /mobile controls -->


   <!-- Navbar content -->
   <div class="collapse navbar-collapse" id="navbar-mobile">

      <ul class="navbar-nav ml-md-auto">
         <a href="#" class="navbar-nav-link dropdown-toggle caret-0 legitRipple" title="Logout" data-target="#headerLogoutDropdown" data-toggle="dropdown" aria-expanded="false">
         <i class="icon-switch2"></i>
         <span class="d-md-none ml-2">Logout</span>
         </a>
         <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350t" id="headerLogoutDropdown">
            <a href="/profile" class="dropdown-item"><i class="icon-user-lock"></i> Profile</a>
            <form method="POST" action="">
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
   <!-- /navbar content -->
   
</div>