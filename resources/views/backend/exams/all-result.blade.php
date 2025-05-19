<x-backend.layouts.master>
    <x-backend.layouts.partials.blocks.contentwrapper 
        :headerTitle="'All Results'"
        :prependContent="'
            <a href=\'/exams\' class=\'btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Create an Exam
            </a>
        '">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div class="d-none" id="resultNullList">
        <x-backend.layouts.partials.blocks.empty-state 
            title="You haven't added any results yet." 
            message="Start building your result list."
            buttonText="Add Result"
            buttonRoute="/exams"
        />
    </div>

    <div class="modal fade" id="detailModalCenter" tabindex="-1" role="dialog" aria-labelledby="detailModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 60%">
            <div class="modal-content" style="border-radius: 24px; height:100%">
                <div class="modal-header text-left d-flex pb-3" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                    <h5 class="modal-title" id="exampleModalLongTitle">ResultID <span id="resultCode">#SID000</span></h5>
                    <button type="button" class="close p-0 m-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="result-tab" data-toggle="tab" href="#result" role="tab" aria-controls="result" aria-selected="true">Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="performance-tab" data-toggle="tab" href="#performance" role="tab" aria-controls="performance" aria-selected="false">Performance</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="wallet-tab" data-toggle="tab" href="#wallet" role="tab" aria-controls="wallet" aria-selected="true">Wallet</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="ratings-tab" data-toggle="tab" href="#ratings" role="tab" aria-controls="ratings" aria-selected="false">Analytics</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="test-result-tab" data-toggle="tab" href="#test-result" role="tab" aria-controls="test-result" aria-selected="false">Feedbacks</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="result" role="tabpanel" aria-labelledby="result-tab">
                                <div>
                                    <h4>Result Details</h4>
                                    <table class="table">
                                        <tr>
                                          <td>Exam Name</td>
                                          <td> : <span class="exam-name"></span></td>
                                          <td>No of sections</td>
                                          <td> : <span class="no-of-section"></span></td>
                                        </tr>
                                        <tr>
                                          <td>No of questions</td>
                                          <td> : <span class="no-of-questions"></span></td>
                                          <td>Exam duration</td>
                                          <td> : <span class="exam-duration"></span></td>
                                        </tr>
                                        <tr>
                                          <td>Student Name</td>
                                          <td> : <span class="student-name"></span></td>
                                          <td>Appeared on</td>
                                        </tr>
                                        <tr>
                                          <td>TOTAL SCORE</td>
                                          <td class="total-score">80</td>
                                        </tr>
                                        <tr>
                                          <td>BEST SCORE</td>
                                          <td class="best-score">76</td>
                                        </tr>
                                        <tr>
                                          <td>AVG SCORE</td>
                                          <td class="avg-score">76</td>
                                        </tr>
                                        <tr>
                                          <td>RANKING</td>
                                          <td class="ranking">5th out of 1209</td>
                                        </tr>
                                        <tr>
                                          <td>NO OF SESSIONS</td>
                                          <td class="no-of-sessions">2</td>
                                        </tr>
                                        <tr>
                                          <td>EXAM DURATION</td>
                                          <td class="exam-duration">1 hr 30 min</td>
                                        </tr>
                                        <tr>
                                          <td>EXAM TAKEN ON</td>
                                          <td class="exam-taken-on">10:30 PM, 25 Dec 25</td>
                                        </tr>
                                        <tr>
                                          <td>TIME TAKEN</td>
                                          <td class="time-taken">1 hr 25 min</td>
                                        </tr>
                                        <tr>
                                          <td>BEST TIMING</td>
                                          <td class="best-timing">56 min</td>
                                        </tr>
                                        <tr>
                                          <td>AVG TIMING</td>
                                          <td class="avg-timing">1 hr 23 min</td>
                                        </tr>
                                        <tr>
                                          <td>FEEDBACKS</td>
                                          <td class="feedbacks">1</td>
                                        </tr>
                                        <tr>
                                          <td>IS COMPLETED</td>
                                          <td class="is-completed">YES</td>
                                        </tr>
                                        <tr>
                                          <td>TOTAL ATTENDANCE</td>
                                          <td class="total-attendance">1,204</td>
                                        </tr>
                                        <tr>
                                          <td>TOTAL COMPLETED</td>
                                          <td class="total-completed">804 (82%)</td>
                                        </tr>
                                    </table>

                                    <h4>Section wise Result</h4>
                                    <table class="table table-striped custom-table" style="border: 0px solid #EAECF0">
                                        <thead>
                                            <tr>
                                                <th>Section Name</th>
                                                <th>Type</th>
                                                <th>Timing</th>
                                                <th>Correct</th>
                                                <th>Wrong</th>
                                                <th>Skipped</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="performance" role="tabpanel" aria-labelledby="performance-tab">
                                <div>
                                    <h4>Appearing Exams</h4>
                                    <table class="table datatable-basic" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="border: 1px solid #EAECF0">
                                        <thead>
                                            <tr class="bg-light" role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending">Course</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Test/Section</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Score</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">%</th>
                                            </tr>
                                        </thead>
                                        <tbody id="performanceTableBody">
                                            <!-- AJAX Loaded Content -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="wallet" role="tabpanel" aria-labelledby="wallet-tab">
                                <div class="d-flex justify-content-center align-items-center" style="background: #F5F5F5; width:100%; height:300px">
                                    <p><b>Waiting for content</b></p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="ratings" role="tabpanel" aria-labelledby="ratings-tab">
                                <div class="d-flex justify-content-center align-items-center" style="background: #F5F5F5; width:100%; height:300px">
                                    <p><b>Waiting for content</b></p>
                                </div>   
                            </div>
                            <div class="tab-pane fade" id="test-result" role="tabpanel" aria-labelledby="test-result-tab">
                                <div class="d-flex justify-content-center align-items-center" style="background: #F5F5F5; width:100%; height:300px">
                                    <p><b>Waiting for content</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end border-top pt-3">
                    <button type="button" class="btn btn-outline-dark" style="background-color:#691D5E; border-radius: 8px; color:#fff" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="resultList">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
            <div class="card-header border-bottom d-flex justify-content-between">
                <div>
                    <input type="text" id="search" class="form-control search__input" placeholder="Search Exam" style="padding-left: 35px">
                </div>
                <div class="d-flex">
                    <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" onclick="filter(this)"><img src="{{ asset('image/icon/layer.png') }}" alt=""> Filters</button>
                    <div class="form-group mb-0">
                        <select class="form-control" id="sortSelect">
                            <option value="Latest" selected>Latest</option>
                            <option value="Oldest">Oldest</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table datatable-basic" id="resultsTable" role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead>
                        <tr>
                            <th colspan="10">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-0 p-0"><b><span id="totalResult">0</span> Result</b></h5>
                                    </div>
                                    <div class="delete-btn d-none">
                                        <button class="btn"><img src="{{ asset('image/icon') }} alt=""></button>
                                        <button class="btn result-excel-download"><img src="{{ asset('image/icon/download.png') }}" alt=""></button>
                                        <button class="btn text-danger result-delete"><i class="fas fa-trash-alt"></i></button>
                                        <button class="btn text-warning result-deactive">Inactive</button>
                                        <button class="btn send-notification-btn" data-toggle="modal" data-target="#messageModalCenter" style="background-color:#691D5E; border-radius: 8px; color:#fff"><img src="{{ asset('image/icon/message.png') }}" alt=""> <span class="ml-2">Send Notification</span></button>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr class="bg-light">
                            <th><input type="checkbox" id="selectAll"></th>
                            <th>Exam</th>
                            <th>Audience</th>
                            <th>Student</th>
                            <th>Ranking</th>
                            <th>Questions</th>
                            <th>Result</th>
                            <th>Duration</th>
                            <th>Timing</th>
                            <th>Creation</th>
                        </tr>
                    </thead>
                    <tbody id="resultsBody">
                        <!-- AJAX Loaded Content -->
                    </tbody>
                </table>
                <div id="emptyState" class="text-center d-none">
                    <p class="mt-3">No result found.</p>
                </div>
                <div>
                    <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                        <form method="GET" class="d-flex align-items-center">
                            <label for="per_page" class="fs-13 fw-medium mr-2 mt-1">Showing:</label>
                            <select name="per_page" id="per_page" class="form-select form-select-sm w-auto mr-2" onchange="fetchResults(1)" style="border:1px solid #D0D5DD; padding:5px">
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
                <button type="button" class="close-btn" id="closeSidebar">×</button>
            </div>
            <div class="sidebar-content">
                <div class="task-form">
                    <form class="form-section filter-form-section">
                        <div class="p-3">
                            <div class="d-flex justify-content-between">
                                <p style="font-size: 12px"> <span style="color: #344054"><b>Created on:</b></span> <span style="color: #475467" id="dateRangeText">Select a date range</span></p>
                                <button type="button" class="btn p-0 m-0 reset-date"><u>Reset</u></button>
                            </div>
                            <div class="mt-1 mb-2 d-flex justify-content-between">
                                <div style="width: 49%">
                                    <input type="date" class="form-control" name="create_from">
                                </div>
                                <div style="align-items: center; display: flex; width:1%">
                                    -
                                </div>
                                <div style="width: 49%">
                                    <input type="date" class="form-control" name="create_to">
                                </div>
                            </div>
                            <div class="mt-2">
                                <h6><b>Audience & Type:</b> All Result</h6>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" name="audience_type" id="All-SAT-1" value="sat-1">
                                    <label class="form-check-label" for="All-SAT-1">All SAT 1</label>
                                </div>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" name="audience_type" id="All-SAT-2" value="sat-2">
                                    <label class="form-check-label" for="All-SAT-2">All SAT 2</label>
                                </div>
                            </div>
                        </div>
                        <div class="border-top fixed-bottom-buttons">
                            <div class="d-flex justify-content-between p-3">
                                <button type="button" class="btn filter-submit-btn" style="background-color:#691D5E; border-radius: 8px; color:#fff; width:50%">Apply Filters</button>
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
                background-color: #F9FAFB;
                border-radius: 9px !important;
            }
            .nav-tabs .nav-link.active {
                color: #000;
                background-color: #fff;
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
                color: #344054 !important;
                width: 80px;
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
            .custom-radio .form-check-input:checked ~ .form-check {
                background-color: #F1E9F0;
                border-color: #A16A99;
            }
            .form-check-input:checked {
                background-color: #732066 !important;
                border-color: #732066 !important;
                margin: 2px;
            }
            .form-check-input:checked + .form-check-label {
                color: #344054;
                font-weight: 500;
            }
            .form-check:hover {
                border-color: #732066;
            }
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
            .custom-radio .form-check-input:checked + .form-check-label::before {
                border-color: #732066;
                background-color: #732066;
                box-shadow: 0 0 0 2px white, 0 0 0 4px #732066;
            }
            .status-radio .form-check-label::before {
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
            .status-radio .form-check-input:checked + .form-check-label::before {
                border-color: #732066;
                background-color: #732066;
                width: 10px;
                height: 10px;
                margin-left: 4px;
                box-shadow: 0 0 0 2px white, 0 0 0 4px #732066;
            }
            .form-check-input:checked ~ .form-check-label {
                color: #344054;
                font-weight: 500;
            }
            .custom-radio:has(.form-check-input:checked) {
                background-color: #F1E9F0;
                border-color: #A16A99;
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
            .multiselect.btn {
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
            .dropzone {
                position: relative;
                border: 2px solid rgba(0, 0, 0, 0.125);
                min-height: 9rem;
                background-color: #fff;
                padding: 0.3125rem;
                border-radius: 1.1875rem;
            }
            .dropzone .dz-default.dz-message:before {
                content: "";
                font-family: icomoon;
                font-size: 2rem;
                display: inline-block;
                position: absolute;
                top: 2rem;
                left: 50%;
                -webkit-transform: translateX(-50%);
                transform: translateX(-50%);
                line-height: 1;
                z-index: 2;
                color: #ccc;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
            .dropzone .dz-default.dz-message > span {
                font-size: 1.0625rem;
                color: #777;
                display: block;
                margin-top: 4.25rem;
            }
            .form-check-switchery .switchery {
                position: absolute;
                top: -12px;
                left: 0;
                margin-top: 0.00002rem;
            }
            .fixed-bottom-buttons {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                background-color: #fff;
                border-top: 1px solid #D0D5DD;
            }
            .floating-sidebar {
                position: fixed;
                top: 0;
                right: -400px;
                width: 400px;
                height: 100%;
                background-color: #fff;
                box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
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
            .switch {
                position: relative;
                display: inline-block;
                width: 50px;
                height: 23px;
            }
            .switch input { 
                opacity: 0;
                width: 0;
                height: 0;
            }
            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }
            .slider:before {
                position: absolute;
                content: "";
                height: 16px;
                width: 16px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }
            input:checked + .slider {
                background-color: #2196F3;
            }
            input:focus + .slider {
                box-shadow: 0 0 1px #2196F3;
            }
            input:checked + .slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }
            .slider.round {
                border-radius: 34px;
            }
            .slider.round:before {
                border-radius: 50%;
            }
        </style>
    @endpush

    @push('js')
        <!-- Theme JS files -->
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/uploaders/dropzone.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/uploader_dropzone.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/switch.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/datatables_basic.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_multiselect.js"></script>
        <!-- /theme JS files -->

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
                });
            });

            function filter(button) {
                const filter = $('.filter');
                filter.show();
                $('#taskSidebar').addClass('open');
                $('#taskSidebarOverlay').addClass('active');
            }
        </script>

        <script>
            function formatDate(dateString) {
                const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                const date = new Date(dateString);
                let day = date.getDate().toString().padStart(2, "0");
                let month = months[date.getMonth()];
                let year = date.getFullYear().toString().slice(-2);
                return `${day}-${month}-${year}`;
            }

            $('#sortSelect').on('change', function() {
                let sortOption = $(this).val();
                fetchResults(1, sortOption);
            });

            document.querySelector('.reset-date').addEventListener('click', function() {
                document.querySelector('input[name="create_from"]').value = '';
                document.querySelector('input[name="create_to"]').value = '';
                document.getElementById('dateRangeText').textContent = 'Select a date range';
                fetchResults(1);
            });

            document.addEventListener('DOMContentLoaded', () => {
                fetchResults(1);

                document.getElementById('search').addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') fetchResults(1);
                });

                document.getElementById('per_page').addEventListener('change', () => fetchResults(1));

                document.querySelector('.filter-submit-btn').addEventListener('click', () => {
                    updateDateRangeText();
                    fetchResults(1);
                });

                document.querySelector('.reset-filter').addEventListener('click', () => {
                    document.querySelector('input[name="create_from"]').value = '';
                    document.querySelector('input[name="create_to"]').value = '';
                    document.getElementById('dateRangeText').textContent = 'Select a date range';
                    document.querySelectorAll('input[name="audience_type"]').forEach(el => el.checked = false);
                    document.getElementById('search').value = '';
                    document.getElementById('sortSelect').value = 'Latest';
                    document.getElementById('per_page').value = '10';
                    fetchResults(1);
                });
            });

            function updateDateRangeText() {
                let createFrom = $('input[name="create_from"]').val();
                let createTo = $('input[name="create_to"]').val();
                if (createFrom && createTo) {
                    let fromDate = formatDate(createFrom);
                    let toDate = formatDate(createTo);
                    document.getElementById('dateRangeText').textContent = `${fromDate} - ${toDate}`;
                } else {
                    document.getElementById('dateRangeText').textContent = 'Select a date range';
                }
            }

            function fetchResults(page = 1, sort = 'Latest') {
                let search = $('#search').val();
                let perPage = $('#per_page').val();
                let createFrom = $('input[name="create_from"]').val();
                let createTo = $('input[name="create_to"]').val();
                let audienceType = $('input[name="audience_type"]:checked').map(function() { return this.value; }).get();

                let url = `/api/results?search=${encodeURIComponent(search)}&per_page=${perPage}&page=${page}` +
                    `&create_from=${encodeURIComponent(createFrom)}&create_to=${encodeURIComponent(createTo)}` +
                    `&audience_type=${encodeURIComponent(audienceType.join(','))}` +
                    `&sort=${encodeURIComponent(sort)}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('resultsBody');
                        tbody.innerHTML = '';

                        if (data.results.data.length === 0) {
                            document.getElementById('resultNullList').classList.remove('d-none');
                            document.getElementById('resultList').classList.add('d-none');
                            document.getElementById('emptyState').classList.remove('d-none');
                            document.getElementById('resultsTable').classList.add('d-none');
                            document.getElementById('pagination').classList.add('d-none');
                        } else {
                            document.getElementById('emptyState').classList.add('d-none');
                            document.getElementById('resultsTable').classList.remove('d-none');
                            document.getElementById('pagination').classList.remove('d-none');
                            document.getElementById('resultNullList').classList.add('d-none');
                            document.getElementById('resultList').classList.remove('d-none');

                            $('#totalResult').text(data.totalResult);

                            data.results.data.forEach(result => {
                                tbody.innerHTML += `
                                    <tr>
                                        <td><input type="checkbox" class="row-checkbox result-row" value="${result.uuid}"></td>
                                        <td class="openDetailModal" data-uuid="${result.uuid}" data-toggle="modal" data-target="#detailModalCenter">
                                            ${result.exam_name}
                                        </td>
                                        <td class="openDetailModal" data-uuid="${result.uuid}" data-toggle="modal" data-target="#detailModalCenter">
                                            ${result.audience}
                                        </td>
                                        <td class="openDetailModal" data-uuid="${result.uuid}" data-toggle="modal" data-target="#detailModalCenter">
                                            ${result.student_name}
                                        </td>
                                        <td class="openDetailModal" data-uuid="${result.uuid}" data-toggle="modal" data-target="#detailModalCenter">
                                            ${result.ranking}
                                        </td>
                                        <td class="openDetailModal" data-uuid="${result.uuid}" data-toggle="modal" data-target="#detailModalCenter">
                                            ${result.total_questions}
                                        </td>
                                        <td class="openDetailModal" data-uuid="${result.uuid}" data-toggle="modal" data-target="#detailModalCenter">
                                            ${result.result}
                                        </td>
                                        <td class="openDetailModal" data-uuid="${result.uuid}" data-toggle="modal" data-target="#detailModalCenter">
                                            ${result.duration}
                                        </td>
                                        <td class="openDetailModal" data-uuid="${result.uuid}" data-toggle="modal" data-target="#detailModalCenter">
                                            ${result.timing}
                                        </td>
                                        <td class="openDetailModal" data-uuid="${result.uuid}" data-toggle="modal" data-target="#detailModalCenter">
                                            ${result.created_at}
                                        </td>
                                    </tr>
                                `;
                            });

                            document.getElementById('paginationInfo').innerHTML =
                                `${data.results.from} - ${data.results.to} of ${data.results.total}`;

                            renderPagination(data.results);

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
                    })
                    .catch(error => {
                        console.error('Error fetching results:', error);
                        alert('Failed to fetch results. Please try again.');
                    });
            }

            function renderPagination(data) {
                const pagination = document.getElementById('pagination');
                pagination.innerHTML = '';

                if (data.last_page > 1) {
                    // Previous Button
                    pagination.innerHTML += `
                        <button class="btn btn-sm btn-light ${data.current_page === 1 ? 'disabled' : ''}" 
                                onclick="${data.current_page > 1 ? `fetchResults(${data.current_page - 1})` : ''}">
                            Previous
                        </button>
                    `;

                    // Page Numbers
                    let startPage = Math.max(1, data.current_page - 2);
                    let endPage = Math.min(data.last_page, data.current_page + 2);

                    for (let i = startPage; i <= endPage; i++) {
                        pagination.innerHTML += `
                            <button class="btn btn-sm ${i === data.current_page ? 'btn-primary' : 'btn-light'}" 
                                    onclick="fetchResults(${i})">${i}</button>
                        `;
                    }

                    // Next Button
                    pagination.innerHTML += `
                        <button class="btn btn-sm btn-light ${data.current_page === data.last_page ? 'disabled' : ''}" 
                                onclick="${data.current_page < data.last_page ? `fetchResults(${data.current_page + 1})` : ''}">
                            Next
                        </button>
                    `;
                }
            }

            $(document).on("click", ".openDetailModal", function () {
                var resultUuid = $(this).data("uuid");

                $.ajax({
                    url: `/api/results/${resultUuid}`,
                    type: "GET",
                    success: function (response) {
                        $("#resultCode").text("#" + response.data.result_code);
                        $("#resultName").text(": " + response.data.name);
                        $("#resultDob").text(": " + formatDate(response.data.date_of_birth));
                        $("#ResultEmail").text(": " + response.data.email);
                        $("#resultAudience").text(": " + response.data.audience);
                        $("#resultGender").text(": " + response.data.gender);
                        $("#resultStatus").text(": " + response.data.status);
                        $("#resultPhone").text(": " + response.data.phone);

                        let performanceTable = "";
                        if (response.data.performance && response.data.performance.length > 0) {
                            response.data.performance.forEach(function (exam) {
                                performanceTable += `
                                    <tr class="custom-row">
                                        <td>${exam.course || 'N/A'}</td>
                                        <td>${exam.date ? formatDate(exam.date) : 'N/A'}</td>
                                        <td>${exam.section || 'Not found'}</td>
                                        <td>${exam.score || 'N/A'}</td>
                                        <td>${exam.percentage ? exam.percentage + '%' : 'N/A'}</td>
                                    </tr>`;
                            });
                        } else {
                            performanceTable = `
                                <tr>
                                    <td colspan="5" class="text-center">No performance data available.</td>
                                </tr>`;
                        }
                        $("#performanceTableBody").html(performanceTable);

                        $("#detailModalCenter").modal("show");
                    },
                    error: function () {
                        alert("Failed to fetch result details.");
                    },
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                function getSelectedResults() {
                    return $(".row-checkbox:checked").map(function () {
                        return $(this).val();
                    }).get();
                }

                function toggleActionButtons() {
                    let selectedResults = getSelectedResults();
                    if (selectedResults.length > 0) {
                        $(".delete-btn").removeClass("d-none");
                    } else {
                        $(".delete-btn").addClass("d-none");
                    }
                }

                $(document).on("change", ".row-checkbox, #selectAll", function () {
                    toggleActionButtons();
                });
            });
        </script>
    @endpush
</x-backend.layouts.master>