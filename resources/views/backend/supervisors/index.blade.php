<x-backend.layouts.master>

    <x-backend.layouts.partials.blocks.contentwrapper 
        :headerTitle="'All Supervisors'"
        :prependContent="'
            <a href=\'/supervisors/create\' data-toggle=\'modal\' data-target=\'#exampleModalCenter\' class=\'btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Create Supervisor
            </a>
        '">
    </x-backend.layouts.partials.blocks.contentwrapper>

    {{-- <x-backend.layouts.partials.blocks.empty-state 
        title="You haven't added any supervisor yet." 
        message="Let’s add your first exam now"
        buttonText="Create Supervisor"
        buttonRoute="/supervisors/create"
    /> --}}

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 24px; height:65vh">
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
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Block">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Block
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Unblock">
                                        <label class="form-check-label" for="exampleRadios2">
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
                    <button type="button" class="btn" style="background-color:#F1E9F0 ;border-radius: 8px; color:#BF98B9">Create Supervisor</button>
                </div>
            </div>
        </div>
  </div>

    <div>
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
            <div class="card-header border-bottom d-flex justify-content-between">
                <div>
                    <input type="text" class="form-control search__input" placeholder="Search Notification">
                </div>

                <div>
                    <!-- Options with divider -->
                    <div class="form-group">
                        <select class="form-control multiselect" multiple="multiple" data-fouc>
                            <option value="All">All</option>
                            <option value="Unread">Unread</option>
                            <option value="Audience">Audience</option>
                            <option data-role="divider"></option>
                            <option value="Latest">Latest</option>
                            <option value="Oldest">Oldest</option>
                        </select>
                    </div>
                    <!-- /options with divider -->
                </div>
            </div>
            <div class="card-body p-0 m-0">
                <table class="table datatable-basic" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead>
                        <tr>
                            <th colspan="8">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-0 p-0"><b>1 Supervisor</b></h5>
                                    </div>
                                    <div class="delete-btn d-none">
                                        <button class="btn text-danger"><i class="fas fa-trash-alt"></i></button>
                                        {{-- <span>|</span>

                                        <span class="ml-2 mr-3" style="color: #079455">Make 1 Active</span>
                                        <span style="color: #DC6803">Make 1 Inacitve</span> --}}
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr class="bg-light" role="row">
                            <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Notification: activate to sort column descending">Supervisor Name</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Phone No.</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Role</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Qus. Created</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Ex. Created</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Status</th>
                            <th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Actions">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="custom-row">
                            <td><input type="checkbox" class="row-checkbox"></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <a href="#" class="btn bg-secondary rounded-round btn-icon btn-sm">
                                            <span class="letter-icon"></span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="#" class="text-default font-weight-semibold letter-icon-title">Hassan Ali</a>
                                        <div class="text-muted font-size-sm">ali@gmail.com </div>
                                    </div>
                                </div>
                            </td>
                            <td>1111111</td>
                            <td>Website management</td>
                            <td>232</td>
                            <td>28</td>
                            <td><span class="badge badge-flat badge-pill border-success text-success-600"><b>Unblock</b></span></td>
                            <td class="text-center"><button class="btn edit-btn"><i class="far fa-edit"></i> Edit</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('css')
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
            <!-- Theme JS files -->
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/switch.min.js"></script>
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
            .form-check-input:checked ~ .form-check {
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

            .form-check-label::before {
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
            .form-check-input:checked + .form-check-label::before {
                border-color: #732066;  /* Outer border color */
                background-color: #732066;
                box-shadow: 0 0 0 2px white, 0 0 0 4px #732066; /* White gap (2px) and outer blue border (2px) */
            }

            .form-check-input:checked ~ .form-check-label {
                color: #344054;
                font-weight: 500;
            }

            /* Change parent background when checked */
            .form-check:has(.form-check-input:checked) {
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
        </style>
    @endpush
    @push('js')
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
    @endpush

</x-backend.layouts.master>