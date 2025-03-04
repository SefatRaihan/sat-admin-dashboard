<x-backend.layouts.master>

    <x-backend.layouts.partials.blocks.contentwrapper 
        :headerTitle="'All Supervisors'"
        :prependContent="'
            <a href=\'/supervisors/create\' data-toggle=\'modal\' data-target=\'#createModalCenter\' class=\'btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Create Supervisor
            </a>
        '">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div class="d-none" id="supervisorNullList">
        <x-backend.layouts.partials.blocks.empty-state 
            title="You haven't added any supervisor yet." 
            message="Let’s add your first exam now"
            buttonText="Create Supervisor"
            buttonRoute="#createModalCenter"
        />
    </div>


    <!-- Create Modal -->
    <div class="modal fade" id="createModalCenter" tabindex="-1" role="dialog" aria-labelledby="createModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content supervisor-create-section" style="border-radius: 24px; height:65vh">
                <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                    <h5 class="" id="exampleModalLongTitle"><b>Create Supervisor</b></h5>
                    <p>Create Supervisor Enter the necessary details to create a supervisor</p>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="col-md-6 mt-2">
                            <x-input-label for="password" :value="__('Password')" />
                            <div class="position-relative">
                                <x-text-input id="password" name="password" type="password"  class="form-control mt-1 block w-full pr-10" autocomplete="password" />
                                <span class="toggle-password" toggle="#password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Role</label>
                            <select name="role" class="form-control">
                                <option value="" disabled>Choose a user role</option>
                                <option value="website-management">Website Management</option>
                                <option value="data-entry">Data entry</option>
                                <option value="editor">Editor</option>
                                <option value="ux-writer">Ux writer</option>
                                <option value="viewer">Viewer</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Block Status</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="status" id="status1" value="Block">
                                        <label class="form-check-label" for="status1">
                                            Block
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="status" id="status2" value="Unblock">
                                        <label class="form-check-label" for="status2">
                                          Unblock
                                        </label>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn create-btn" style="background-color:#691D5E ;border-radius: 8px; color:#fff">Create Supervisor</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content supervisor-edit-section" style="border-radius: 24px; height:65vh">
                <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                    <h5 class="" id="exampleModalLongTitle"><b>Edit Supervisor</b></h5>
                    <p>Edit Supervisor Enter the necessary details to edit a supervisor</p>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" class="supervisor_uuid" name="supervisor_uuid">
                        <div class="col-md-6 mt-2">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Role</label>
                            <select name="role" class="form-control">
                                <option value="" disabled>Choose a user role</option>
                                <option value="website-management">Website Management</option>
                                <option value="data-entry">Data entry</option>
                                <option value="editor">Editor</option>
                                <option value="ux-writer">Ux writer</option>
                                <option value="viewer">Viewer</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Block Status</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="status" id="editstatus1" value="Block">
                                        <label class="form-check-label" for="editstatus1">
                                            Block
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="status" id="editstatus2" value="Unblock">
                                        <label class="form-check-label" for="editstatus2">
                                            Unblock
                                        </label>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn update-btn" style="background-color:#691D5E ;border-radius: 8px; color:#fff">Update Supervisor</button>
                </div>
            </div>
        </div>
    </div>

    <div id="supervisorList">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
            <div class="card-header border-bottom d-flex justify-content-between">
                <div>
                    <input type="text" id="search" class="form-control search__input" placeholder="Search Notification" style="padding-left: 35px">
                </div>

                <div class="d-flex">
                    <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" onclick="filter(this)"><img src="{{ asset('image/icon/layer.png') }}" alt=""> Filters</button>

                    <div class="form-group mb-0">
                        <select class="form-control multiselect" multiple="multiple" data-fouc>
                            <option value="All">All</option>
                            <option value="Unread">Unread</option>
                            <option value="Audience">Audience</option>
                            <option data-role="divider"></option>
                            <option value="Latest">Latest</option>
                            <option value="Oldest">Oldest</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="supervisorTable">
                    <thead>
                        <tr>
                            <th colspan="8">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-0 p-0"><b><span id="totalSupervisor"></span> Supervisor</b></h5>
                                    </div>
                                    <div class="delete-btn d-none">
                                        <button class="btn text-danger supervisor-delete"><i class="fas fa-trash-alt"></i></button>
                                        {{-- <span>|</span>

                                        <span class="ml-2 mr-3" style="color: #079455">Make 1 Active</span>
                                        <span style="color: #DC6803">Make 1 Inacitve</span> --}}
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr class="bg-light" role="row">
                            <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                            <th>Supervisor Name</th>
                            <th>Phone No.</th>
                            <th>Role</th>
                            <th>Qus. Created</th>
                            <th style="min-width: 150px">Ex. Created</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="supervisorsBody">
                    </tbody>
                </table>
                <!-- Empty State -->
                <div id="emptyState" class="text-center d-none">
                    <p class="mt-3">No supervisor found.</p>
                </div>
                <div>
                    <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                        <form method="GET" class="d-flex align-items-center">
                            <label for="per_page" class="fs-13 fw-medium mr-2 mt-1">Showing:</label>
                            <select name="per_page" id="per_page" class="form-select form-select-sm w-auto mr-2" onchange="fetchSupervisors(1)" style="border:1px solid #D0D5DD; padding:5px">
                                @foreach([5, 10, 20, 50, 100] as $size)
                                    <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                        {{ $size }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    
                        <div class="d-flex align-items-center">
                            <span class="fs-13 fw-medium me-2" id="paginationInfo">
                                <!-- Pagination info will be dynamically updated here -->
                            </span>
                            <div id="pagination">
                                <!-- Pagination buttons will be dynamically updated here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
            </div>
        </div>
    </div>

    <div class="sidebar-overlay" id="taskSidebarOverlay"></div>
    <div class="floating-sidebar" id="taskSidebar">
        <div class="filter">
            <div class="sidebar-header">
                <div>
                    <h4 style="font-size: 18px;" class="p-0 m-0">Filters</h4>
                    <p class="p-0 m-0" style="color: #475467">Apply filters to table data.</p>
                </div>
                <button type="button" class="close-btn" id="closeSidebar">&times;</button>
            </div>
            <div class="sidebar-content">
                <div class="task-form">
                    <form class="form-section filter-form-section">
                        <div class="p-3">
                            <div>
                                <h6><b>Role:</b> All Result</h6>
                                <div class="form-check status-radio">
                                        <input type="checkbox" name="role" id="website-management" value="Website Management">
                                        <label class="form-check-label" for="website-management">
                                            Website Management
                                        </label>
                                  </div>
                                  <div class="form-check status-radio">
                                        <input type="checkbox" name="role" id="ux-writer" value="UX Writer">
                                        <label class="form-check-label" for="ux-writer">
                                            UX Writer
                                        </label>
                                  </div>
                                  <div class="form-check status-radio">
                                        <input type="checkbox" name="role" id="ui-designer" value="UI Designer">
                                        <label class="form-check-label" for="ui-designer">
                                            UI Designer
                                        </label>
                                  </div>
                                  <div class="form-check status-radio">
                                        <input type="checkbox" name="role" id="data-analyst" value="Data Analyst">
                                        <label class="form-check-label" for="data-analyst">
                                            Data Analyst
                                        </label>
                                </div>
                                <div class="form-check status-radio">
                                    <input type="checkbox" name="role" id="social-media-manager" value="Social Media Manager">
                                    <label class="form-check-label" for="social-media-manager">
                                        Social Media Manager
                                    </label>
                                </div>
                                <div class="form-check status-radio">
                                    <input type="checkbox" name="role" id="admin" value="Admin">
                                    <label class="form-check-label" for="admin">
                                        Admin
                                    </label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h6><b>Status:</b> All Result</h6>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" name="filter_status" value="blocked" id="Block">
                                    <label class="form-check-label" for="blocked">Blocked</label>
                                </div>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" name="filter_status" value="unblocked" id="Unblock">
                                    <label class="form-check-label" for="unblocked">Unblocked</label>
                                </div>
                            </div>
                        </div>

                        <div class="border-top fixed-bottom-buttons">
                            <div class="d-flex justify-content-between p-3">
                                <button type="button" class="btn filter-submit-btn" style="background-color:#691D5E ;border-radius: 8px; color:#fff; width:50%">Apply Filters</button>
                                <button type="button" class="btn btn-outline-dark ml-2 reset-filter" style="border: 1px solid #D0D5DD; border-radius: 8px; width:50%">Reset All</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            .nav-tabs {
                border: 1px solid #ddd;
                border-radius: 9px !important;
            }

            .nav-tabs .nav-link.active {
                color: #333;
                background-color: #F9FAFB;
                border-color: #fff #fff #fff;
                padding: 8px;
                margin-top: 3px;
                margin-left: 3px !important;
                border-radius: 7px !important;
                font-weight: bold;
            }

            .search__input {
                width: 400px;
                padding: 12px 24px;
                background-color: transparent;
                transition: transform 250ms ease-in-out;
                font-size: 14px;
                line-height: 18px;
                color: #575756;
                background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-size: 18px 18px;
                background-position: 10px center; /* Adjusted to position the icon to the left */
                border-radius: 50px;
                transition: all 250ms ease-in-out;
                backface-visibility: hidden;
                transform-style: preserve-3d;
                padding-left: 36px; /* Ensures the placeholder doesn't overlap with the icon */
            }
            .search__input::placeholder {
                padding-left: 30px;
            }
            input[type='checkbox'] {
                width: 20px;
                height: 20px;
                border: 1px solid #D0D5DD !important;
                appearance: none; /* Removes default checkbox styling */
                background-color: white;
                cursor: pointer;
                border-radius: 4px !important; /* Optional: for rounded corners */
            }

            /* Checked state */
            input[type='checkbox']:checked {
                background-color: #3F1239; /* Change the background color when checked */
                position: relative;
            }

            /* Adding a custom checkmark */
            input[type='checkbox']:checked::after {
                content: '✓'; /* Unicode checkmark */
                font-size: 12px;
                color: white; /* Checkmark color */
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100%;
            }
            .dataTable tbody > tr.selected, .dataTable tbody > tr > .selected {
                background-color: #F1E9F0 !important;
            }

            .edit-btn {
                color: #344054 !important;
                width: 80px;
                border: 1px solid #D0D5DD;
                background-color: #FFFFFF;
                border-radius: 8px;
                font-weight: bold;
            }

            .position-relative {
                position: relative;
            }

            .toggle-password {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                font-size: 16px;
                color: #888;
            }

            .toggle-password:hover {
                color: #333;
            }

            .modal .form-check {
                border: 1px solid #D0D5DD;
                border-radius: 8px;
                height: 44px;
                display: flex;
                align-items: center;
                padding-left: 46px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            /* Change background and border when checked */
            .custom-radio .form-check-input:checked ~ .form-check {
                background-color: #F1E9F0; /* Light purple */
                border-color: #A16A99; /* Darker purple */
            }

            .form-check-input:checked {
                background-color: #732066 !important; /* Dark purple for radio */
                border-color: #732066 !important;
                margin: 2px;
            }

            .form-check-input:checked + .form-check-label {
                color: #344054; /* Keeping text dark */
                font-weight: 500;
            }

            /* Hover effect */
            .form-check:hover {
                border-color: #732066;
            }

            /* Hide default radio circle and use custom */
            .form-check-input {
                position: absolute;
                opacity: 0;
            }

            .form-check-label {
                position: relative;
                cursor: pointer;
            }

            .custom-radio .form-check-label::before {
                content: "";
                position: absolute;
                left: -30px;
                top: 50%;
                transform: translateY(-50%);
                width: 18px;
                height: 18px;
                border: 2px solid #D0D5DD;
                border-radius: 50%;
                background-color: #fff;
                transition: all 0.3s ease;
            }

            /* Custom radio circle when checked */
            .custom-radio .form-check-input:checked + .form-check-label::before {
                border-color: #732066;  /* Outer border color */
                background-color: #732066;
                box-shadow: 0 0 0 2px white, 0 0 0 4px #732066; /* White gap (2px) and outer blue border (2px) */
            }

            .custom-radio .form-check-input:checked ~ .form-check-label {
                color: #344054;
                font-weight: 500;
            }

            /* Change parent background when checked */
            ..custom-radio:has(.form-check-input:checked) {
                background-color: #F1E9F0; /* Light purple */
                border-color: #A16A99; /* Darker purple */
            }

            .multiselect-native-select {
                position: relative;
                border: 1px solid #ddd;
                border-radius: 8px;
                min-width: 125px;
            }

            .multiselect:after {
                position: absolute;
                top: 50%;
                right: 2px !important;
            }

            .multiselect.btn-light {
                background-color: transparent;
                border-width: 0px 0 !important;
                border-color: #fff !important;
                border-top-color: transparent;
                border-radius: 0;
            }
            .multiselect.btn{
                padding: 8px .875rem !important;
            }
            .multiselect-container {
                max-height: 280px;
                overflow-y: auto;
                width: 200px;
            }

            .dropdown-item.active {
                background-color: #575756 !important;
                padding: 0px;
                margin: 0px;
                border-radius: 0px;
            }

            .datatable-footer, .datatable-header {
                padding: 1.25rem 1.25rem 0 1.25rem;
                margin-left: 17px;
                margin-right: 17px;
                margin-bottom: 17px;
            }
            .datatable-header {
                border-bottom: 1px solid #ddd;
                display: none;
            }
            .fixed-bottom-buttons {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%; /* Full width of parent */
                background-color: #fff;
                border-top: 1px solid #D0D5DD;
            }
        </style>
        <style>
            .floating-sidebar {
                position: fixed;
                top: 0;
                right: -400px;
                width: 400px;
                height: 100%;
                background-color: #fff;
                box-: -2px 0 5px rgba(0, 0, 0, 0.2);
                transition: right 0.3s ease-in-out;
                z-index: 1050;
                overflow-y: auto;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1040;
            }

            .sidebar-header {
                padding: 18px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .floating-sidebar.open {
                right: 0;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .close-btn {
                background: none;
                border: none;
                font-size: 24px;
                cursor: pointer;
            }

            .task-form .form-control {
                border: 1px solid #ddd !important;
                padding-left: 4px;
                padding-right: 4px;
            }

            .task-form .select2-selection--single {
                padding-left: 4px;
                padding-right: 4px;
            }

            .task-form .select2-selection--single .select2-selection__arrow:after {
                right: 7px !important;
            }

            .task-form .select2-container {
                border: 1px solid #ddd;
            }

        </style>
    @endpush
    @push('js')
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
        <!-- Theme JS files -->
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/switch.min.js"></script>
    	<!-- Theme JS files -->
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/datatables_basic.js"></script>
        <!-- /theme JS files -->

        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_multiselect.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".toggle-password").forEach(function(element) {
                    element.addEventListener("click", function() {
                        let input = document.querySelector(this.getAttribute("toggle"));
                        let icon = this.querySelector("i");
            
                        if (input.type === "password") {
                            input.type = "text";
                            icon.classList.remove("fa-eye");
                            icon.classList.add("fa-eye-slash");
                        } else {
                            input.type = "password";
                            icon.classList.remove("fa-eye-slash");
                            icon.classList.add("fa-eye");
                        }
                    });
                });
            });

            function toggleDeleteButton() {
                let anyChecked = document.querySelectorAll(".row-checkbox:checked").length > 0;
                document.querySelector(".delete-btn").classList.toggle("d-none", !anyChecked);
            }

            document.querySelectorAll(".row-checkbox").forEach(checkbox => {
                checkbox.addEventListener("change", function() {
                    this.closest("tr").classList.toggle("selected", this.checked);
                    toggleDeleteButton();
                });
            });

            document.getElementById("selectAll").addEventListener("change", function() {
                let isChecked = this.checked;
                document.querySelectorAll(".row-checkbox").forEach(checkbox => {
                    checkbox.checked = isChecked;
                    checkbox.closest("tr").classList.toggle("selected", isChecked);
                });
                toggleDeleteButton();
            });

            // Initial check on page load
            toggleDeleteButton();
        </script>
        <script>
            $(document).ready(function () {
                $(".custom-radio").click(function() {
                    $(this).find("input[type='radio']").prop("checked", true);
                });

                $('#closeSidebar, #taskSidebarOverlay').on('click', function() {
                    $('#taskSidebar').removeClass('open');
                    $('#taskSidebarOverlay').removeClass('active');
                    $('#boardHiddenInputSection').html('');
                });
            });
            function filter(button) {
                const filter = $('.filter');
                filter.show();
                $('#taskSidebar').addClass('open');
                $('#taskSidebarOverlay').addClass('active');
            }

        </script>

        <!-- /Fetch Data -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                fetchSupervisors(1); // Initial Load

                // Search on Enter key
                document.getElementById('search').addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') fetchSupervisors(1);
                });

                // Per page change
                document.getElementById('per_page').addEventListener('change', () => fetchSupervisors(1));

                // Apply filters on form submit
                document.querySelector('.filter-submit-btn').addEventListener('click', () => fetchSupervisors(1));

                // Reset filters
                
                document.querySelector('.reset-filter').addEventListener('click', () => {
                    document.querySelectorAll('input[name="role"]').forEach(el => el.checked = false);
                    document.querySelectorAll('input[name="filter_status"]').forEach(el => el.checked = false);
                    fetchSupervisors(1);
                });
            });

            function fetchSupervisors(page = 1) {
                const search = document.getElementById('search').value;
                const perPage = document.getElementById('per_page').value;

                const role = Array.from(document.querySelectorAll('input[name="role"]:checked')).map(el => el.id);
                const status = Array.from(document.querySelectorAll('input[name="filter_status"]:checked')).map(el => el.id);

                // Construct the URL with filter parameters
                const url = `/api/supervisors?search=${search}&per_page=${perPage}&page=${page}` +
                    `&role=${role.join(',')}` +
                    `&status=${status.join(',')}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('supervisorsBody');
                        tbody.innerHTML = '';

                        $('#totalSupervisor').text(data.totalSupervisor);

                        if (data.supervisors.data.length === 0) {
                            document.getElementById('supervisorNullList').classList.remove('d-none');
                            document.getElementById('supervisorList').classList.add('d-none');
                            document.getElementById('emptyState').classList.remove('d-none');
                            document.getElementById('supervisorTable').classList.add('d-none');
                            document.getElementById('pagination').classList.add('d-none');
                        } else {
                            document.getElementById('emptyState').classList.add('d-none');
                            document.getElementById('supervisorTable').classList.remove('d-none');
                            document.getElementById('pagination').classList.remove('d-none');
                            document.getElementById('supervisorNullList').classList.add('d-none');
                            document.getElementById('supervisorList').classList.remove('d-none');

                            data.supervisors.data.forEach(supervisor => {
                                const firstWord = supervisor.name.trim().split(/\s+/)[0];
                                const firstLetter = firstWord.replace(/\W/g, '').charAt(0);
                                
                                tbody.innerHTML += `
                                    <tr>

                                        <td><input type="checkbox" class="row-checkbox supervisor-row" value="${supervisor.uuid}"></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <a href="#" class="btn bg-secondary rounded-round btn-icon btn-sm">
                                                        <span class="letter-icon">${firstLetter}</span>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="#" class="text-default font-weight-semibold letter-icon-title">${supervisor.name}</a>
                                                    <div class="text-muted font-size-sm">${supervisor.email}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>${supervisor.phone}</td>
                                        <td>${supervisor.role_name ? supervisor.role_name.replace(/\s+/g, ' ').toLowerCase().replace(/^./, str => str.toUpperCase()) : ' '}</td>
                                        <td></td>
                                        <td></td>
                                        <td><span class="badge badge-flat badge-pill border-${supervisor.status == 'block' ? 'danger' : 'success'} text-${supervisor.status == 'block' ? 'danger' : 'success'}-600"><b>${supervisor.status.replace(/\s+/g, '').toUpperCase()}</b></span></td>

                                        <td class="text-center">
                                            <button data-uuid="${supervisor.uuid}" class="btn btn-sm edit-supervisor-btn"  data-toggle="modal" data-target="#editModalCenter">
                                                <i class="far fa-edit"></i> Edit
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            });

                            // Update Pagination Info
                            document.getElementById('paginationInfo').innerHTML = `
                                ${data.supervisors.from} - ${data.supervisors.to} of ${data.supervisors.total}
                            `;

                            // Render Pagination Buttons
                            renderPagination(data.supervisors);
                            document.querySelectorAll(".row-checkbox").forEach(checkbox => {
                                checkbox.addEventListener("change", function() {
                                    this.closest("tr").classList.toggle("selected", this.checked);
                                    toggleDeleteButton();
                                });
                            });

                            document.getElementById("selectAll").addEventListener("change", function() {
                                let isChecked = this.checked;
                                document.querySelectorAll(".row-checkbox").forEach(checkbox => {
                                    checkbox.checked = isChecked;
                                    checkbox.closest("tr").classList.toggle("selected", isChecked);
                                });
                                toggleDeleteButton();
                            });
                        }
                    });
            }

            function renderPagination(data) {
                const pagination = document.getElementById('pagination');
                pagination.innerHTML = '';

                if (data.last_page > 1) {
                    for (let i = 1; i <= data.last_page; i++) {
                        pagination.innerHTML += `
                            <button class="btn btn-sm ${i === data.current_page ? 'btn-primary' : 'btn-light'}" onclick="fetchSupervisors(${i})">${i}</button>
                        `;
                    }
                }
            }
        </script>

        <!-- /Craete, Edit, Update -->
        <script>
            $(document).ready(function () {
                $(document).on('click', '.create-btn', function () {
                    let $button = $(this);
                    $button.prop('disabled', true).html('Processing...');

                    let formData = new FormData();

                    // Collect form data
                    const name = $('.supervisor-create-section').find('input[name="name"]').val();
                    const email = $('.supervisor-create-section').find('input[name="email"]').val();
                    const phone = $('.supervisor-create-section').find('input[name="phone"]').val();
                    const password = $('.supervisor-create-section').find('input[name="password"]').val();
                    const role = $('.supervisor-create-section').find('select[name="role"]').val();
                    const status = $('.supervisor-create-section').find('input[name="status"]:checked').val();

                    // Validate required fields
                    if (!name || !email || !phone || !password || !role || !status) {
                        let missingFields = [];

                        if (!name) missingFields.push('Name');
                        if (!email) missingFields.push('Email');
                        if (!phone) missingFields.push('Phone');
                        if (!password) missingFields.push('Password');
                        if (!role) missingFields.push('Role');
                        if (!status) missingFields.push('Status');

                        Swal.fire({
                            icon: 'warning',
                            title: 'Missing Fields',
                            html: 'Please fill in the following fields:<br><strong>' + missingFields.join(', ') + '</strong>',
                        });
                        $button.prop('disabled', false).html('Save'); // Re-enable button
                        return;
                    }

                    // Append data to FormData
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // CSRF token
                    formData.append('name', name);
                    formData.append('email', email);
                    formData.append('phone', phone);
                    formData.append('password', password);
                    formData.append('role', role);
                    formData.append('status', status);

                    // AJAX Request
                    $.ajax({
                        url: '/api/supervisors',  // Adjust the route as per your Laravel API
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Supervisor Added',
                                    text: response.message,
                                }).then(() => {
                                    $('#createModalCenter').modal('hide');
                                    fetchSupervisors(1);

                                    $('#createModalCenter').find('input[name="name"], input[name="email"], input[name="password"], input[name="phone"], select[name="role"]').val('');
                                    $('#profileImage').val('');

                                    $('#createModalCenter').find('input[name="status"]').prop('checked', false);

                                    $('#createModalCenter').find('select').each(function () {
                                        $(this).prop('selectedIndex', 0);
                                    });
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.error || 'Something went wrong!',
                                });
                            }
                        },
                        error: function (xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                let errorMsg = '';
                                $.each(errors, function (key, value) {
                                    errorMsg += value[0] + '<br>';
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validation Error',
                                    html: errorMsg,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Unexpected Error',
                                    text: 'An unexpected error occurred. Please try again.',
                                });
                            }
                        },
                        complete: function () {
                            $button.prop('disabled', false).html('Create Supervisor'); // Re-enable button after request completes
                        }
                    });
                });

                $(document).on('click', '.edit-supervisor-btn', function () {
                    let uuid = $(this).data("uuid");

                    $.ajax({
                        url: "/api/supervisors/" + uuid,  // Adjust the route as per your Laravel API
                        type: "GET",
                        success: function (response) {
                            // Populate modal fields with fetched data
                            $('.supervisor-edit-section').find("input[name='supervisor_uuid']").val(response.data.uuid);
                            $('.supervisor-edit-section').find("input[name='name']").val(response.data.name);
                            $('.supervisor-edit-section').find("input[name='email']").val(response.data.email);
                            $('.supervisor-edit-section').find("input[name='phone']").val(response.data.phone);
                            
                            // Set status radio button
                            $('.supervisor-edit-section').find("input[name='status'][value='" + response.data.status + "']").prop("checked", true);

                            // Set package and duration dropdowns
                            $('.supervisor-edit-section').find("select[name='role']").val(response.data.role_name);
                        },
                        error: function () {
                            alert("Failed to fetch student details!");
                        }
                    });
                });

                $(document).on('click', '.update-btn', function () {
                    let $button = $(this);
                    $button.prop('disabled', true).html('Processing...');

                    let formData = new FormData();

                    // Collect form data
                    
                    // Collect form data
                    const supervisor_uuid = $('.supervisor-edit-section').find('input[name="supervisor_uuid"]').val();
                    const name = $('.supervisor-edit-section').find('input[name="name"]').val();
                    const email = $('.supervisor-edit-section').find('input[name="email"]').val();
                    const phone = $('.supervisor-edit-section').find('input[name="phone"]').val();
                    const role = $('.supervisor-edit-section').find('select[name="role"]').val();
                    const status = $('.supervisor-edit-section').find('input[name="status"]:checked').val();

                    // Validate required fields
                    if (!name || !email || !phone || !role || !status) {
                        let missingFields = [];

                        if (!name) missingFields.push('Name');
                        if (!email) missingFields.push('Email');
                        if (!phone) missingFields.push('Phone');
                        if (!role) missingFields.push('Role');
                        if (!status) missingFields.push('Status');

                        Swal.fire({
                            icon: 'warning',
                            title: 'Missing Fields',
                            html: 'Please fill in the following fields:<br><strong>' + missingFields.join(', ') + '</strong>',
                        });
                        $button.prop('disabled', false).html('Save'); // Re-enable button
                        return;
                    }

                    // Append data to FormData
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // CSRF token
                    formData.append('name', name);
                    formData.append('email', email);
                    formData.append('phone', phone);
                    formData.append('role', role);
                    formData.append('status', status);

                    // AJAX Request
                    $.ajax({
                        url: `/api/supervisors/${supervisor_uuid}/update`,
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Student Update',
                                    text: response.message,
                                }).then(() => {
                                    $('#editModalCenter').modal('hide');
                                    fetchSupervisors(1);

                                    $('#editModalCenter').find('input[name="name"], input[name="email"], input[name="password"], input[name="phone"], select[name="role"]').val('');
                                    $('#profileImage').val('');

                                    $('#editModalCenter').find('input[name="status"]').prop('checked', false);

                                    $('#editModalCenter').find('select').each(function () {
                                        $(this).prop('selectedIndex', 0);
                                    });
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.error || 'Something went wrong!',
                                });
                            }
                        },
                        error: function (xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                let errorMsg = '';
                                $.each(errors, function (key, value) {
                                    errorMsg += value[0] + '<br>';
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validation Error',
                                    html: errorMsg,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Unexpected Error',
                                    text: 'An unexpected error occurred. Please try again.',
                                });
                            }
                        },
                        complete: function () {
                            $button.prop('disabled', false).html('Update Supervisor'); // Re-enable button after request completes
                        }
                    });
                });

            });
        </script>

        <!-- /Delete -->
        <script>
            $(document).ready(function () {

                function getSelectedSupervisors() {
                    return $(".row-checkbox:checked").map(function () {
                        return $(this).val();
                    }).get();
                }

                function toggleActionButtons() {
                    let selectedSupervisors = getSelectedSupervisors();
                    if (selectedSupervisors.length > 0) {
                        $(".delete-btn").removeClass("d-none");
                    } else {
                        $(".delete-btn").addClass("d-none");
                    }
                }

                // Checkbox selection logic
                $(document).on("change", ".row-checkbox, #selectAll", function () {
                    toggleActionButtons();
                });

                // Delete Supervisors
                $(".supervisor-delete").click(function () {
                    let selectedSupervisors = getSelectedSupervisors();
                    if (selectedSupervisors.length === 0) {
                        Swal.fire("Warning", "Please select at least one supervisor.", "warning");
                        return;
                    }

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "/api/supervisors-delete",
                                type: "POST",
                                data: {
                                    supervisors: selectedSupervisors,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function (response) {
                                    Swal.fire("Deleted!", "Supervisor deleted successfully.", "success");
                                    fetchSupervisors(1);
                                },
                                error: function () {
                                    Swal.fire("Error", "Failed to delete supervisor.", "error");
                                }
                            });
                        }
                    });
                });

            });
        </script>
    @endpush

</x-backend.layouts.master>