<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title p-3 d-flex align-items-center">
            @php
                $general = \App\Models\General::latest()->first();
            @endphp
            <img src="{{ asset('storage/'.$general->logo) }}" alt="" style="height:36px">
            <h4>
                <span class="font-weight-semibold header-title ml-2" style="color: #28235B; font-size: 29px;">
                    Mubhir
                </span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="student-navbar">
            <ul class="nav justify-content-center">
                <li class="nav-item"><a class="nav-link active" href="/">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/full-tests">All Exams</a></li>
                <li class="nav-item"><a class="nav-link" href="/student/course">Courses</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Custom Exam</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Leaderboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">AI</a></li>
              </ul>
        </div>

        <div class="header-elements d-none">
            <div class="d-flex justify-content-end notification-section">
                <div class="position-relative d-flex">
                    <!-- Notification Icon -->
                    <div id="notification-icon" class="d-flex align-items-center justify-content-center"
                        style="height: 40px; width:40px; border:1px solid #EAECF0; border-radius:20px; background-color: #F9FAFB; cursor: pointer;">
                        <img src="{{ asset('image/icon/notification-2.png') }}" alt="">
                    </div>

                    <!-- Notification Badge -->
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger counter">
                    </span>

                    <!-- Notification Dropdown -->
                    <ul id="notification-dropdown" class="position-absolute mt-2 bg-white shadow p-2 rounded d-none"
                        style="width: 250px; right: 0; z-index:100; margin-top: 64px !important;">
                      
                    </ul>

                    <!-- Profile Image and Dropdown -->
                    <div class="ml-2 position-relative">
                        <!-- Profile Image -->
                        <div id="profile-icon" style="cursor: pointer;">
                            <img src="{{ auth()->user()->student->image ? asset(auth()->user()->student->image) : asset('image/default-avatar.png') }}" alt="Avatar" style="height: 40px; width:40px; border-radius:50%; object-fit: cover;">
                        </div>

                        <!-- Profile Dropdown -->
                        <ul id="profile-dropdown" class="position-absolute mt-2 bg-white shadow p-2 rounded d-none" style="width: 150px; right: 0; z-index:100; margin-top: 24px !important; padding: 0px !important;">
                            <li style="list-style-type: none;">
                                <a class="dropdown-item p-2 text-dark hover:bg-gray-100" href="/student-profile"><i class="fas fa-user"></i> Profile</a>
                            </li>
                            <li style="list-style-type: none;">
                                <a class="dropdown-item p-2 text-dark hover:bg-gray-100" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i> Logout</a>
                            </li>
                        </ul>

                        <!-- Logout Form (Hidden) -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .student-navbar .nav-item .nav-link {
        font-weight: 500;
        font-size: 16px;
        line-height: 24px;
        letter-spacing: 0%;
        color: #344054;
    }

    .student-navbar .nav-item .nav-link.active {
        color: #fff;
        font-weight: 700;
        border-radius: 25px;
        background-color: #691D5E;
    }

    .student-navbar .nav-item .nav-link:hover {
        border:1px solid #732066;
        background: #fff;
        border-radius: 25px;
        font-weight: 700;
        color: #000;
    }
    .notification-message {
        display: block;        /* ensures the span takes full width */
        white-space: normal;   /* allow wrapping */
        word-wrap: break-word; /* break long words if needed */
    }
    .notification-item,
    .dropdown-item {
        height: auto;          /* important */
        min-height: 50px;      /* optional, ensures spacing */
    }

</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Function to toggle notification dropdown
        function toggleNotificationDropdown() {
            $('#notification-dropdown').toggleClass('d-none');
            $('#profile-dropdown').addClass('d-none'); // Hide profile dropdown
        }

        // Function to toggle profile dropdown
        function toggleProfileDropdown() {
            $('#profile-dropdown').toggleClass('d-none');
            $('#notification-dropdown').addClass('d-none'); // Hide notification dropdown
        }

        // Function to hide both dropdowns on outside click
        function hideDropdownsOnOutsideClick() {
            $(document).on('click', function (event) {
                if (!$(event.target).closest('#notification-icon, #notification-dropdown').length) {
                    $('#notification-dropdown').addClass('d-none');
                }
                if (!$(event.target).closest('#profile-icon, #profile-dropdown').length) {
                    $('#profile-dropdown').addClass('d-none');
                }
            });
        }

        // Initialize event listeners
        function initDropdowns() {
            $('#notification-icon').on('click', function (event) {
                event.stopPropagation();
                toggleNotificationDropdown();
            });

            $('#profile-icon').on('click', function (event) {
                event.stopPropagation();
                toggleProfileDropdown();
            });

            hideDropdownsOnOutsideClick();
        }

        // Call initialization function
        initDropdowns();
    });
</script>
<script>
    // Current page URL path
    const currentPath = window.location.pathname;

    // All nav links
    document.querySelectorAll('.student-navbar .nav-link').forEach(link => {
        // যদি href এর path currentPath এর সাথে মিলে যায় তাহলে active করব
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
</script>
 <script>

    // Run once DOM is fully ready
    $(document).ready(function () {
        // Initial fetch
        fetchNotifications();

        // Fetch every 5 seconds
        // setInterval(fetchNotifications, 10000);

        // Notification click -> mark as read
        $(document).on('click', '.notification-item', function () {
            const id = $(this).data('id');

            $.ajax({
                url: `/api/notifications/${id}/read`,
                type: 'patch',
                 headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function () {
                    fetchNotifications();
                },
                error: function () {
                    console.error("Failed to mark notification as read.");
                }
            });
        });
    });

    // Fetch notifications from API
    function fetchNotifications() {
        $.get('/api/notifications', function (data) {
            const dropdown = $('#notification-dropdown');
            dropdown.empty();

            if (data.length > 0) {
                data.forEach(function (notification) {
                    dropdown.append(`
                        <li class="border-bottom notification-item" data-id="${notification.id}" style="list-style-type: none; cursor:pointer;">
                            <a class="dropdown-item d-flex justify-content-between align-items-center p-2 hover:bg-gray-100">
                                <span class="notification-message text-dark">${notification.data.message}</span>
                            </a>
                        </li>
                    `);
                });
            } else {
                dropdown.append(`
                    <li style="list-style-type: none">
                        <a class="dropdown-item p-2 text-gray-500" href="#">No new notifications</a>
                    </li>
                `);
            }

            // Update badge
            updateNotificationBadge(data.length);
        });
    }

    // Update badge count
    function updateNotificationBadge(count) {
        let badge = $('.position-absolute.badge.bg-danger');
        if (count > 0) {
            if (badge.length) {
                badge.text(count);
            } else {
                $('.counter').text(count);
            }
        } else {
            badge.remove();
        }
    }
</script>
