<x-backend.layouts.master>

    <x-backend.layouts.partials.blocks.contentwrapper 
        :headerTitle="'All Roles'"
        :prependContent="'
            <a href=\'/roles/create\' class=\'btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Create Role
            </a>
        '">
    </x-backend.layouts.partials.blocks.contentwrapper>

    @if ($roles->isEmpty())
        <x-backend.layouts.partials.blocks.empty-state 
            title="You have not created any Role yet" 
            message="Let’s create a role now"
            buttonText="Create Role"
            buttonRoute="/roles/create"
        />
    @else
        <div>
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <div>
                        <input type="text" class="form-control search__input" placeholder="Search Role">
                    </div>
                </div>
                <div class="card-body p-0 m-0">
                    <table class="table datatable-basic dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="mb-0 p-0"><b>{{ $roles->total() }} Role{{ $roles->total() != 1 ? 's' : '' }}</b></h5>
                                        </div>
                                        <div class="delete-btn d-none">
                                            <button class="btn role-delete text-danger"><i class="fas fa-trash-alt"></i></button>
                                            <span>|</span>
                                            <button class="btn role-active ml-2 mr-3" style="color: #079455">Active</button>
                                            <button class="btn role-deactive" style="color: #DC6803">Inactive</button>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr class="bg-light" role="row">
                                <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                                <th>Role Name</th>
                                <th>Feature Permission</th>
                                <th>Supervisor</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)  
                            <tr class="custom-row">
                                <td><input type="checkbox" class="row-checkbox" value="{{ $role->uuid }}"></td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->permissions_count }}</td>
                                <td>{{ $role->supervisor_users_count }}</td>
                                <td>
                                    <div class="form-check form-check-switchery">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input-switchery status-switch" 
                                                   data-fouc {{ $role->status == 'active' ? 'checked' : '' }} 
                                                   data-role-uuid="{{ $role->uuid }}">
                                        </label>
                                    </div>
                                </td>
                                <td><a href="{{ route('roles.edit', $role->id) }}" class="btn edit-btn"><i class="far fa-edit"></i> Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="p-2 d-flex justify-content-end" style="border-top:1px solid #ddd">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif

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
                background-position: 10px center;
                border-radius: 50px;
                transition: all 250ms ease-in-out;
                backface-visibility: hidden;
                transform-style: preserve-3d;
                padding-left: 36px;
            }
            .search__input::placeholder {
                padding-left: 30px;
            }
            input[type='checkbox'] {
                width: 20px;
                height: 20px;
                border: 1px solid #D0D5DD !important;
                appearance: none;
                background-color: white;
                cursor: pointer;
                border-radius: 4px !important;
            }

            input[type='checkbox']:checked {
                background-color: #3F1239;
                position: relative;
            }

            input[type='checkbox']:checked::after {
                content: '✓';
                font-size: 12px;
                color: white;
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
                color: #475467 !important;
                width: 200px;
            }
        </style>
    @endpush

    @push('js')
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_multiselect.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Show SweetAlert if there's a success message in the session
            @if (session('success'))
                Swal.fire({
                    title: "Success",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                });
            @endif

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

        <!-- /Delete Notification Status Deactive -->
        <script>
            $(document).ready(function () {
                function getSelectedRoles() {
                    return $(".row-checkbox:checked").map(function () {
                        return $(this).val();
                    }).get();
                }

                function toggleActionButtons() {
                    let selectedRoles = getSelectedRoles();
                    if (selectedRoles.length > 0) {
                        $(".delete-btn").removeClass("d-none");
                    } else {
                        $(".delete-btn").addClass("d-none");
                    }
                }

                // Checkbox selection logic
                $(document).on("change", ".row-checkbox, #selectAll", function () {
                    toggleActionButtons();
                });

                // Delete Roles
                $(".role-delete").click(function () {
                    let selectedRoles = getSelectedRoles();
                    if (selectedRoles.length === 0) {
                        Swal.fire("Warning", "Please select at least one role.", "warning");
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
                                url: "/api/roles-delete",
                                type: "POST",
                                data: {
                                    roles: selectedRoles,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function (response) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Roles deleted successfully.",
                                        icon: "success",
                                        confirmButtonColor: "#3085d6",
                                        confirmButtonText: "OK"
                                    }).then(() => {
                                        window.location.reload(); // Reload the page after the alert
                                    });
                                },
                                error: function () {
                                    Swal.fire("Error", "Failed to delete role.", "error");
                                }
                            });
                        }
                    });
                });

                // Deactivate Roles
                $(".role-deactive").click(function () {
                    let selectedRoles = getSelectedRoles();
                    if (selectedRoles.length === 0) {
                        Swal.fire("Warning", "Please select at least one role.", "warning");
                        return;
                    }

                    $.ajax({
                        url: "/api/roles/deactivate",
                        type: "POST",
                        data: {
                            roles: selectedRoles,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            Swal.fire({
                                title: "Success",
                                text: "Roles deactivated successfully.",
                                icon: "success",
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "OK"
                            }).then(() => {
                                window.location.reload(); // Reload the page after the alert
                            });
                        },
                        error: function () {
                            Swal.fire("Error", "Failed to deactivate role.", "error");
                        }
                    });
                });

                // Activate Roles
                $(".role-active").click(function () {
                    let selectedRoles = getSelectedRoles();
                    if (selectedRoles.length === 0) {
                        Swal.fire("Warning", "Please select at least one role.", "warning");
                        return;
                    }

                    $.ajax({
                        url: "/api/roles/activate",
                        type: "POST",
                        data: {
                            roles: selectedRoles,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            Swal.fire({
                                title: "Success",
                                text: "Roles activated successfully.",
                                icon: "success",
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "OK"
                            }).then(() => {
                                window.location.reload(); // Reload the page after the alert
                            });
                        },
                        error: function () {
                            Swal.fire("Error", "Failed to activate role.", "error");
                        }
                    });
                });

                // Status Switch Update
                $(document).on('change', '.status-switch', function() {
                    let checkbox = $(this);
                    let status = checkbox.is(':checked') ? 'active' : 'inactive';
                    let roleUuid = checkbox.data('role-uuid');
                    
                    $.ajax({
                        url: '/api/roles/update-status',
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            uuid: roleUuid,
                            status: status
                        },
                        success: function(response) {
                            if (response.success) {
                            } else {
                                Swal.fire("Error", "Failed to update status.", "error");
                                checkbox.prop('checked', !checkbox.is(':checked'));
                            }
                        },
                        error: function() {
                            Swal.fire("Error", "Something went wrong!", "error");
                            checkbox.prop('checked', !checkbox.is(':checked'));
                        }
                    });
                });
            });
        </script>
    @endpush

</x-backend.layouts.master>