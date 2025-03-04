<x-backend.layouts.master>

    <x-backend.layouts.partials.blocks.contentwrapper 
    :headerTitle="'
        <a href=\'\roles\' class=\'text-dark\'>
            <i class=\'fa-solid fa-angle-left mr-2\'></i> Create Role
        </a>
    '"
    :prependContent="'
        
    '">
</x-backend.layouts.partials.blocks.contentwrapper>

<div>
    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
        <div class="card-body">
            <form action="">
                <div class="text-right">
                    <button type="submit" class="btn ml-2 text-white" style="background-color:#732066;  border-radius:8px">
                        Submit
                    </button>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <label for="">Role Name</label>
                        <input type="text" class="form-control role-name" value="">
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <div>
                        <h4><b>Features (7 Selected)</b></h4>
                    </div>
                    <div>
                        <input type="checkbox" class="all-checkbox all-select" checked>  <span style="color: #121926; font-size:16px">All Permissions</span>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                            <div class="card-header" style="background-color: #EAECF0">
                                <input type="checkbox" class="checkbox individual-all-select" checked>  <span style="color: #121926; font-size:16px">General Setting</span>
                            </div>
                            <div class="card-body pt-3 table-responsive" style="height:300px">
                                <p class="mb-3"><input type="checkbox" class="checkbox" checked>  <span style="color: #121926; font-size:16px">Users</span></p>
                                <p class="mb-3"><input type="checkbox" class="checkbox" checked>  <span style="color: #121926; font-size:16px">View user complaints</span></p>
                                <p class="mb-3"><input type="checkbox" class="checkbox" checked>  <span style="color: #121926; font-size:16px">Add User</span></p>
                                <p class="mb-3"><input type="checkbox" class="checkbox" checked>  <span style="color: #121926; font-size:16px">Delete User</span></p>
                                <p class="mb-3"><input type="checkbox" class="checkbox" checked>  <span style="color: #121926; font-size:16px">Add Member Page</span></p>
                                <p class="mb-3"><input type="checkbox" class="checkbox" checked>  <span style="color: #121926; font-size:16px">Block user</span></p>
                                <p class="mb-3"><input type="checkbox" class="checkbox" checked>  <span style="color: #121926; font-size:16px">Supervisors</span></p>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                            <div class="card-header" style="background-color: #EAECF0">
                                <input type="checkbox" class="checkbox individual-all-select">  <span style="color: #121926; font-size:16px">Notification</span>
                            </div>
                            <div class="card-body pt-3 table-responsive" style="height:300px">
                                <p class="mb-3"><input type="checkbox" class="checkbox">  <span style="color: #121926; font-size:16px">Users</span></p>
                                <p class="mb-3"><input type="checkbox" class="checkbox">  <span style="color: #121926; font-size:16px">View user complaints</span></p>
                                <p class="mb-3"><input type="checkbox" class="checkbox">  <span style="color: #121926; font-size:16px">Add User</span></p>
                                <p class="mb-3"><input type="checkbox" class="checkbox" checked>  <span style="color: #121926; font-size:16px">Delete User</span></p>
                                <p class="mb-3"><input type="checkbox" class="checkbox">  <span style="color: #121926; font-size:16px">Add Member Page</span></p>
                                <p class="mb-3"><input type="checkbox" class="checkbox">  <span style="color: #121926; font-size:16px">Block user</span></p>
                                <p class="mb-3"><input type="checkbox" class="checkbox">  <span style="color: #121926; font-size:16px">Supervisors</span></p>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('css')
    <style>
        .all-checkbox {
            width: 20px;
            height: 20px;
            border: 1px solid #D0D5DD !important;
            appearance: none; /* Removes default checkbox styling */
            background-color: white;
            cursor: pointer;
            border-radius: 4px !important; /* Optional: for rounded corners */
        }

        /* Checked state */
        .all-checkbox:checked {
            background-color: #3F1239; /* Change the background color when checked */
            position: relative;
        }

        /* Adding a custom checkmark */
        .all-checkbox:checked::after {
            content: '-'; /* Unicode checkmark */
            font-size: 12px;
            color: white; /* Checkmark color */
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .checkbox {
            width: 20px;
            height: 20px;
            border: 1px solid #D0D5DD !important;
            appearance: none; /* Removes default checkbox styling */
            background-color: white;
            cursor: pointer;
            border-radius: 4px !important; /* Optional: for rounded corners */
        }

        /* Checked state */
        .checkbox:checked {
            background-color: #3F1239; /* Change the background color when checked */
            position: relative;
        }

        /* Adding a custom checkmark */
        .checkbox:checked::after {
            content: '✓'; /* Unicode checkmark */
            font-size: 12px;
            color: white; /* Checkmark color */
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }
    </style>
@endpush

@push('js')
@endpush


</x-backend.layouts.master>