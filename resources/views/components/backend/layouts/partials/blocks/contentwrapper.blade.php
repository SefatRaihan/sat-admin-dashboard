<x-slot name="contentWrapper">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title p-3 d-flex">
                <h4>
                    <span class="font-weight-semibold header-title">
                        {!! $headerTitle ?? 'Default Title' !!}  
                    </span>
                </h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none">

                <div class="d-flex justify-content-end notification-section">
                    
                    {{-- এখানে নতুন কন্টেন্ট অ্যাপেন্ড করুন --}}
                    {!! $prependContent ?? '' !!}  

                    <div class="position-relative">
                        <!-- Notification Icon -->
                        <div id="notification-icon" class="d-flex align-items-center justify-content-center"
                            style="height: 40px; width:40px; border:1px solid #EAECF0; border-radius:20px; background-color: #F9FAFB; cursor: pointer;">
                            <img src="{{ asset('image/icon/notification-2.png') }}" alt="">
                        </div>
                    
                        <!-- Notification Badge -->
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    
                        <!-- Notification Dropdown -->
                        <ul id="notification-dropdown" class="position-absolute mt-2 bg-white shadow p-2 rounded d-none"
                            style="width: 250px; right: 0; z-index:100">
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                @foreach(auth()->user()->unreadNotifications as $notification)
                                    <li class="border-bottom" style="list-style-type: none">
                                        <a class="dropdown-item d-flex justify-content-between align-items-center p-2 hover:bg-gray-100"
                                            href="{{ route('markAsRead', $notification->id) }}">
                                            <span class="notification-message text-dark">{{ $notification->data['message'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li style="list-style-type: none"><a class="dropdown-item p-2 text-gray-500" href="#">No new notifications</a></li>
                            @endif
                        </ul>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let notificationIcon = document.getElementById("notification-icon");
            let notificationDropdown = document.getElementById("notification-dropdown");
    
            // Notification icon এ click করলে dropdown show/hide হবে
            notificationIcon.addEventListener("click", function (event) {
                event.stopPropagation();
                notificationDropdown.classList.toggle("d-none");
            });
    
            // Body-তে click করলে dropdown hide হবে
            document.addEventListener("click", function (event) {
                if (!notificationDropdown.contains(event.target) && !notificationIcon.contains(event.target)) {
                    notificationDropdown.classList.add("d-none");
                }
            });
        });
    </script>
    
</x-slot>
