<x-backend.layouts.master>

    <x-backend.layouts.partials.blocks.contentwrapper 
        :headerTitle="'Notification'"
        :prependContent="'
            <a href=\'/notification/create\' class=\'btn btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                Create Notification
            </a>
        '">
    </x-backend.layouts.partials.blocks.contentwrapper>


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
                <table class="table datatable-basic dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead>
                        <tr>
                            <th colspan="4">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-0 p-0"><b>103 Notification</b></h5>
                                    </div>
                                    <div class="delete-btn d-none">
                                        <button class="btn text-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr class="bg-light" role="row">
                            <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Notification: activate to sort column descending">Notification</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Date</th>
                            <th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="custom-row">
                            <td><input type="checkbox" class="row-checkbox"></td>
                            <td>New Subscription - Mohammed</td>
                            <td>29 January 2025</td>
                            <td><button class="btn remove-btn btn-sm"><i class="fa-solid fa-xmark"></i></button></td>
                        </tr>
                        <tr class="custom-row">
                            <td><input type="checkbox" class="row-checkbox"></td>
                            <td>New Subscription - Ahmed</td>
                            <td>29 January 2025</td>
                            <td><button class="btn remove-btn btn-sm"><i class="fa-solid fa-xmark"></i></button></td>
                        </tr>
                        <tr class="custom-row">
                            <td><input type="checkbox" class="row-checkbox"></td>
                            <td>New Subscription - Ali</td>
                            <td>29 January 2025</td>
                            <td><button class="btn remove-btn btn-sm"><i class="fa-solid fa-xmark"></i></button></td>
                        </tr>
                    </tbody>
                </table>
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

            .nav-tabs .nav-link:hover {
                background-color: transparent !important;
                color: #333 !important;
                border-radius: 8px !important;
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
            
            .remove-btn {
                width: 36px;
                height: 36px;
                border-radius: 8px;
                border-width: 1px;
                border: 1px solid #D0D5DD;
                padding: 7px 0rem !important;
                background-color: #fff;
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