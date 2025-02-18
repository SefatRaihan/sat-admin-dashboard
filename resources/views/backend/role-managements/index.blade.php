<x-backend.layouts.master>

    <x-backend.layouts.partials.blocks.contentwrapper 
    :headerTitle="'All Roles'"
    :prependContent="'
        <a href=\'/roles/create\' class=\'btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
            <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Create Role
        </a>
    '">
</x-backend.layouts.partials.blocks.contentwrapper>

{{-- <div class="flex flex-col items-center align-content-center justify-center min-h-screen" style="height: 90vh">
    <div class="text-center" style="position: relative">
        <img src="{{ asset('image/loading.png') }}" alt="Loading Image" class="mb-4" style="opacity: 0.4">
        <div class="text-section">
            <h2 class="text-xl font-semibold" style="font-size: 24px; font-weight:900px"><b>You have not created any Role yet</b></h2>
            <p style="color: #475467; font-size:16px">Let’s create a role now</p>
            <a href="/roles/create" 
            class="btn text-default ml-2 text-white" 
            style="background-color:#732066; font-size: 12px; border-radius: 8px;">
                <i class="fas fa-plus" style="font-size: 12px;"></i> Create Role
            </a>

        </div>
    </div>
</div> --}}

{{-- @push('css')
    <style>
        .text-section {
            position: absolute;
            top: 54%;
            left: 38%;
        }
    </style>
@endpush --}}

<div>
    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
        <div class="card-header border-bottom d-flex justify-content-between">
            <div>
                <input type="text" class="form-control search__input" placeholder="Search Notification">
            </div>
        </div>
        <div class="card-body p-0 m-0">
            <table class="table datatable-basic dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                <thead>
                    <tr>
                        <th colspan="6">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="mb-0 p-0"><b>5 Role</b></h5>
                                </div>
                                <div class="delete-btn d-none">
                                    <button class="btn text-danger"><i class="fas fa-trash-alt"></i></button>
                                    <span>|</span>

                                    <span class="ml-2 mr-3" style="color: #079455">Make 1 Active</span>
                                    <span style="color: #DC6803">Make 1 Inacitve</span>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr class="bg-light" role="row">
                        <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Notification: activate to sort column descending">Role Name</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Feature Permission</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Supervisor</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Status</th>
                        <th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="custom-row">
                        <td><input type="checkbox" class="row-checkbox"></td>
                        <td>Website Management</td>
                        <td>232</td>
                        <td>28</td>
                        <td>
                            <div class="form-check form-check-switchery">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input-switchery" checked data-fouc>
                                </label>
                            </div>
                        </td>
                        <td><button class="btn edit-btn"><i class="far fa-edit"></i> Edit</button></td>
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
            color: #475467 !important;
            width: 200px;
        }
    </style>
@endpush
@push('js')
<script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_multiselect.js"></script>
<script>
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