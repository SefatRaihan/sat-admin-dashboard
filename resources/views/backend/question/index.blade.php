<x-backend.layouts.master>
    @php
        $prependHtml = '
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                 <a  href="/students/upload" data-toggle="modal" data-target="#uploadQuestion" class="btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 btn-sm" style="padding: 5px 15px; border:2px solid #D0D5DD; border-radius:10px; background-color: #FFFFFF; color:#344054; font-size: 12px">
                    <i class="fa-solid fa-cloud-arrow-up mt-1 pr-1"></i> Upload Question
                </a>

            </div>
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                <a href=\'/students/create\' data-toggle=\'modal\' data-target=\'#questionModal\' class=\'btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                    <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Add Question
                </a>
            </div>
        ';
    @endphp

    <x-backend.layouts.partials.blocks.contentwrapper :headerTitle="'All Question'" :prependContent="$prependHtml">
    </x-backend.layouts.partials.blocks.contentwrapper>

    {{-- <x-backend.layouts.partials.blocks.empty-state
        title="You have not created any Question yet"
        message="Let’s create a new question"
        buttonText="Add Question"
        buttonText="Add Question"
        data-toggle="modal"
        data-target="#questionModal"
        buttonRoute="/button/create"
        /> --}}

    <section>

       
        <div>
            <div class="card"
                style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <div>
                        <input type="text" class="form-control search_input" placeholder="Search Questions">
                    </div>

                    <div class="d-flex">
                        <button type="button" class="btn pt-0 pb-0 mr-2"
                            style="border: 1px solid #D0D5DD; border-radius: 8px;" onclick="filter(this)"><img
                                src="{{ asset('image/icon/layer.png') }}" alt=""> Filters</button>

                        <div class="form-group mb-0">
                            <select class="form-control multiselect" multiple="multiple" data-fouc>
                                <option value="All">All</option>
                                <option value="Unread">Unread</option>
                                <option value="Audience">Audience</option>
                                <option value="Audience">Question Type</option>
                                <option value="Audience">Difficulty</option>
                                <option data-role="divider"></option>
                                <option value="Latest">Latest</option>
                                <option value="Oldest">Oldest</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 m-0 table-responsive">
                    <!-- Filters & Pagination Controls -->
                    <div class="d-flex justify-content-between align-items-center mt-3 p-2">
                        <h4><strong id="total-questions"></strong></h4>
                        <div class="delete-btn d-none">
                            <button class="btn"><img src="{{ asset('image/icon/download.png') }}"
                                    alt=""></button>
                            <button class="btn text-danger"><i class="fas fa-trash-alt"></i></button>
                            <button class="btn text-success"><strong>Make <span id="active-count"></span>
                                    Active</strong></button>
                            <button class="btn text-warning"><strong>Make <span id="inactive-count"></span>
                                    Inactive</strong></button>
                        </div>
                    </div>

                    <!-- Questions Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr align="center">
                                    <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                                    <th data-column="question" class="sortable">Question</th>
                                    <th data-column="audience" class="sortable">Audience</th>
                                    <th data-column="question_type" class="sortable">Q. Type</th>
                                    <th data-column="exam" class="sortable">Exam</th>
                                    <th data-column="difficulty" class="sortable">Difficulty</th>
                                    <th data-column="avg_time" class="sortable">Avg. Time</th>
                                    <th data-column="created_at" class="sortable">Created</th>
                                    <th>State</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="question-table-body">
                                <tr>
                                    <td colspan="9" class="text-center">Loading...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-2 p-2"
                        style="border-top: 1px solid #D0D5DD; background:#F9FAFB">
                        <div id="pagination-info"></div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center mr-2">
                                <span class="me-2 pr-2">Rows per page</span>
                                <select id="rowsPerPage" class="form-control form-select-sm" style="width: 60px;">
                                    <option value="10" selected>10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <nav>
                                <ul class="pagination pagination-sm" id="pagination-links">
                                    <!-- Pagination links will be inserted here -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- filter side modal --}}
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
                <div class="filter-sidebar-content">
                    <div class="task-form">
                        <div class="p-3 ">
                            <div class="d-flex justify-content-between">
                                <p style="font-size: 12px"> <span style="color: #344054"><b>Created on:</b></span> <span
                                        style="color: #475467">06 Jan 25 - 12 Jan 25</span></p>
                                <button class="reset-slider"><u>Reset</u></button>
                            </div>
                            <div class="mt-1 mb-2 d-flex justify-content-between">
                                <div style="width: 49%">
                                    <input type="date" class="form-control" name="crated_start_at">
                                </div>
                                <div style="align-items: center; display: flex; width:1%">
                                    -
                                </div>
                                <div style="width: 49%">
                                    <input type="date" class="form-control" name="crated_end_at">
                                </div>
                            </div>
                            <div id="filter-status">
                                <div class="d-flex justify-content-between">
                                    <h6><b>Status:</b> Active Only</h6>
                                    <button class="reset-slider"><u>Reset</u></button>
                                </div>
                                <div class="form-check status-radio">
                                    <input class="form-check-input" type="radio" name="status" id="all"
                                        value="All" checked>
                                    <label class="form-check-label" for="all">
                                        All
                                    </label>
                                </div>
                                <div class="form-check status-radio">
                                    <input class="form-check-input" type="radio" name="status" id="activeonly"
                                        value="Active only">
                                    <label class="form-check-label" for="activeonly">
                                        Active only
                                    </label>
                                </div>
                                <div class="form-check status-radio">
                                    <input class="form-check-input" type="radio" name="status" id="inactiveonly"
                                        value="Inactive only">
                                    <label class="form-check-label" for="inactiveonly">
                                        Inactive only
                                    </label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="d-flex justify-content-between">
                                    <h6><b>Audience & Type:</b> All Result</h6>
                                    <button class="reset-slider"><u>Reset</u></button>
                                </div>
                                <div id="all_sat_type_1">
                                    <div class="filter-group">
                                        <div class="form-check">
                                            <input class="form-check-input toggle-parent" type="checkbox"
                                                id="allSet1Toggle">
                                            <label class="form-check-label" for="allSet1Toggle">
                                                All SAT 1
                                            </label>
                                            <span class="toggle-icon" data-target="allSet1"><i
                                                    class="fas fa-chevron-down"></i></span>
                                        </div>
                                        <div class="nested-options collapse" id="allSet1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="exam1">
                                                <label class="form-check-label" for="exam1">Hight School :
                                                    Verbal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="exam2">
                                                <label class="form-check-label" for="exam2">Hight School :
                                                    Quant</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="exam3">
                                                <label class="form-check-label" for="exam3">College :
                                                    Verbal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="exam3">
                                                <label class="form-check-label" for="exam3">College :
                                                    Verbal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="exam3">
                                                <label class="form-check-label" for="exam3">Graduate :
                                                    Verbal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="exam3">
                                                <label class="form-check-label" for="exam3">Graduate :
                                                    Quant</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="all_sat_type_2">
                                    <div class="filter-group">
                                        <div class="form-check">
                                            <input class="form-check-input toggle-parent" type="checkbox"
                                                id="allSet2Toggle">
                                            <label class="form-check-label" for="allSet2Toggle">
                                                All SAT 2
                                            </label>
                                            <span class="toggle-icon" data-target="allSet2"><i
                                                    class="fas fa-chevron-down"></i></span>
                                        </div>
                                        <div class="nested-options collapse" id="allSet2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="exam1">
                                                <label class="form-check-label" for="exam1">Verbal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="exam2">
                                                <label class="form-check-label" for="exam2">Quant</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="d-flex justify-content-between">
                                    <h6><b>Exam Appearance:</b> 2 Selected</h6>
                                    <button class="reset-slider"><u>Reset</u></button>
                                </div>
                                <div class="mb-1">
                                    <input type="text" class="form-control search_input w-100"
                                        placeholder="Search Questions">
                                </div>
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="form-check-input toggle-parent" type="checkbox"
                                            id="highSchoolToggle">
                                        <label class="form-check-label" for="highSchoolToggle">
                                            View all High School Exams
                                        </label>
                                        <span class="toggle-icon" data-target="highSchoolOptions"><i
                                                class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="nested-options collapse" id="highSchoolOptions">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="exam1">
                                            <label class="form-check-label" for="exam1">High School Verbal Exam
                                                1</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="exam2">
                                            <label class="form-check-label" for="exam2">High School Verbal Exam
                                                2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="exam3">
                                            <label class="form-check-label" for="exam3">High School Verbal Exam
                                                3</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="form-check-input toggle-parent" type="checkbox"
                                            id="collegeToggle">
                                        <label class="form-check-label" for="collegeToggle">
                                            View all College Exams
                                        </label>
                                        <span class="toggle-icon" data-target="collegeOptions"><i
                                                class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="nested-options collapse" id="collegeOptions">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="college1">
                                            <label class="form-check-label" for="college1">College Verbal Exam</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="college2">
                                            <label class="form-check-label" for="college2">College Quant Exam</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="d-flex justify-content-between">
                                    <h6><b>Exam Appearance:</b> 2 Selected</h6>
                                    <button class="reset-slider"><u>Reset</u></button>
                                </div>
                                <div class="form-check custom-checkbox d-flex justify-center">
                                    <input type="checkbox" id="super-man">
                                    <label class="form-check-label pl-1" for="super-man"><span
                                            class="badge badge-pill badge-easy"><b>Easy</b></span></label>
                                </div>
                                <div class="form-check custom-checkbox d-flex justify-center">
                                    <input type="checkbox" id="avenger">
                                    <label class="form-check-label pl-1" for="avenger"><span
                                            class="badge badge-pill badge-medium"><b>Medium</b></span></label>
                                </div>
                                <div class="form-check custom-checkbox d-flex justify-center">
                                    <input type="checkbox" id="gladiator">
                                    <label class="form-check-label pl-1" for="gladiator"><span
                                            class="badge badge-pill badge-hard"><b>Hard</b></span></label>
                                </div>
                                <div class="form-check custom-checkbox d-flex justify-center">
                                    <input type="checkbox" id="gladiator">
                                    <label class="form-check-label pl-1" for="gladiator"><span
                                            class="badge badge-pill badge-very-hard"><b>Very Hard</b></span></label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="slider-container">
                                    <div class="slider-header">
                                        <span>Average Time:</span>
                                        <span id="slider-value">1m 00s - 2m 00s</span>
                                        <button class="reset-slider" id="reset-slider">Reset</button>
                                    </div>
                                    <div class="range-slider">
                                        <input type="range" min="1" max="120" value="1"
                                            id="min-range">
                                        <input type="range" min="1" max="120" value="120"
                                            id="max-range">
                                    </div>
                                    <div class="slider-labels">
                                        <span id="min-label">1m 00s</span>
                                        <span id="max-label">2m 00s</span>
                                    </div>
                                </div>

                            </div>
                            <div class="mt-2">
                                <h6><b>Created By:</b></h6>
                                <div class="form-check custom-checkbox d-flex justify-center">
                                    <input type="checkbox" id="monthly">
                                    <label class="form-check-label pl-1" for="monthly">Admin</label>
                                </div>
                                <div class="form-check custom-checkbox d-flex justify-center">
                                    <input type="checkbox" id="annual">
                                    <label class="form-check-label pl-1" for="annual">Sefat</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="border-top fixed-bottom-buttons">
                    <div class="d-flex justify-content-between p-3">
                        <button type="button" class="btn"
                            style="background-color:#691D5E ;border-radius: 8px; color:#fff; width:50%">Apply
                            Filters</button>
                        <button type="button" class="btn btn-outline-dark ml-2"
                            style="border: 1px solid #D0D5DD; border-radius: 8px; width:50%">Reset All</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- show details modal --}}
    <section>
        <div class="modal fade" id="detailModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="detailModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border-radius: 24px; height:100%">
                    <div class="modal-header text-left"
                        style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                        <h5 class="modal-title" id="exampleModalLongTitle">StudentID <span>#SID6386</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="question-tab" data-toggle="tab" href="#question"
                                        role="tab" aria-controls="question" aria-selected="true">Question</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="performance-tab" data-toggle="tab" href="#performance"
                                        role="tab" aria-controls="performance"
                                        aria-selected="false">Explanation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="wallet-tab" data-toggle="tab" href="#wallet"
                                        role="tab" aria-controls="wallet" aria-selected="false">Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ratings-tab" data-toggle="tab" href="#ratings"
                                        role="tab" aria-controls="ratings" aria-selected="false">Analytics</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="test-result-tab" data-toggle="tab" href="#test-result"
                                        role="tab" aria-controls="test-result"
                                        aria-selected="false">Feedbacks</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="question" role="tabpanel"
                                    aria-labelledby="question-tab">
                                    <div>
                                        <div id="question-show-card"
                                            style="border: 1px solid #D0D5DD; border-radius:8px; padding:10px; background:#F9FAFB">
                                            Lorem Ipsum est simplement du faux texte employé dans la composition et la
                                            mise en page avant impression. Le Lorem Ipsum est le faux texte standard de
                                            l'imprimerie depuis les
                                            <p class="mb-0 mt-1">
                                                <strong>Question:</strong>
                                            </p>
                                            <p class="pt-0 mt-0">The Lorem ipsum text is derived from sections 1.10.32
                                                and 1.10.33 of Cicero's De finibus bonorum et malorum.</p>
                                        </div>
                                        <div class="mt-3">
                                            <h5><strong><strong>Options:</strong></h5>
                                        </div>
                                        {{-- <div id="option-show-in-view"class="row mt-2" style="margin-left: 3px">
                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    <input type="radio" name="audience" value="High School" class="form-check-input sat_1" id="high_school">
                                                    <label class="radio-container form-check-label" for="high_school" >
                                                        High School
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input type="radio" name="audience" value="Graduation" class="form-check-input sat_1" id="graduation">
                                                    <label class="radio-container form-check-label" for="graduation">
                                                        Graduation
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    <input type="radio" name="audience" value="College" class="form-check-input sat_1" id="college">
                                                    <label class="radio-container form-check-label" for="college">
                                                        College
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input type="radio" name="audience" value="SAT 2" class="form-check-input sat_2" id="sat_2">
                                                    <label class="radio-container form-check-label" for="sat_2">
                                                        SAT 2
                                                    </label>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="performance" role="tabpanel"
                                    aria-labelledby="performance-tab">
                                    <div>
                                        <h4>Appearing Exams</h4>
                                        <table class="table datatable-basic" id="DataTables_Table_0" role="grid"
                                            aria-describedby="DataTables_Table_0_info"
                                            style="border: 1px solid #EAECF0">
                                            <thead>
                                                <tr class="bg-light" role="row">
                                                    <th class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1"
                                                        colspan="1" aria-sort="ascending"
                                                        aria-label="Notification: activate to sort column descending">
                                                        Course</th>
                                                    <th class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Date: activate to sort column ascending">Date</th>
                                                    <th class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Date: activate to sort column ascending">
                                                        Test/Section</th>
                                                    <th class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Date: activate to sort column ascending">Score</th>
                                                    <th class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Date: activate to sort column ascending">%</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="custom-row">
                                                    <td>Chemistry</td>
                                                    <td>27-09-25</td>
                                                    <td>Not found</td>
                                                    <td>45.9</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr class="custom-row">
                                                    <td>Chemistry</td>
                                                    <td>27-09-25</td>
                                                    <td>Not found</td>
                                                    <td>45.9</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr class="custom-row">
                                                    <td>Chemistry</td>
                                                    <td>27-09-25</td>
                                                    <td>Not found</td>
                                                    <td>45.9</td>
                                                    <td>100%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="wallet" role="tabpanel"
                                    aria-labelledby="wallet-tab">
                                    <div class="d-flex justify-content-center align-items-center"
                                        style="background: #F5F5F5; width:100%; height:300px">
                                        <p><b>Waiting for content</b></p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="ratings" role="tabpanel"
                                    aria-labelledby="ratings-tab">
                                    <div class="d-flex justify-content-center align-items-center"
                                        style="background: #F5F5F5; width:100%; height:300px">
                                        <p><b>Waiting for content</b></p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="test-result" role="tabpanel"
                                    aria-labelledby="test-result-tab">
                                    <div class="d-flex justify-content-center align-items-center"
                                        style="background: #F5F5F5; width:100%; height:300px">
                                        <p><b>Waiting for content</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between border-top pt-3">
                        <button type="button" class="btn"
                            style="border: 1px solid #D0D5DD; border-radius: 8px;">Edit Question</button>
                        <button type="button" class="btn btn-outline-dark"
                            style="background-color:#691D5E ;border-radius: 8px; color:#fff"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- create modal --}}
    <section>
        <div class="modal fade" id="questionModal" tabindex="-1" role="dialog"
            aria-labelledby="questionModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border-radius: 24px; height:100%">
                    <div style="background: #F9FAFB;  border-bottom:1px solid #D0D5DD ">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <h4 class="text-center font-weight-bold">Create a Question</h4>
                        <p class="text-center text-muted step-title"></p>
                        <div class="d-flex justify-content-center align-items-center mb-4 step-container">
                            <div class="step-group">
                                <div class="step-circle active" data-step="1"><i
                                        class="fa-solid fa-check d-none"></i><span class="circle-count">1</span></div>
                            </div>
                            <div class="step-group">
                                <div class="step-line"></div>
                                <div class="step-circle m-0" data-step="2"><i
                                        class="fa-solid fa-check d-none"></i><span class="circle-count">2</span></div>
                            </div>
                            <div class="step-group">
                                <div class="step-line"></div>
                                <div class="step-circle m-0" data-step="3"><i
                                        class="fa-solid fa-check d-none"></i><span class="circle-count">3</span></div>
                            </div>
                            <div class="step-group">
                                <div class="step-line"></div>
                                <div class="step-circle m-0" data-step="4"><i
                                        class="fa-solid fa-check d-none"></i><span class="circle-count">4</span></div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-body" style="padding: 10px 40px">
                        {{-- Form Start --}}
                        <div class="step step-1">
                            <h5><strong>1. Select the Audience</strong></h5>
                            <div class="row" style="margin-left: 3px">
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input type="radio" name="audience" value="High School"
                                            class="form-check-input sat_1" id="high_school">
                                        <label class="radio-container form-check-label" for="high_school">
                                            High School
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" name="audience" value="Graduation"
                                            class="form-check-input sat_1" id="graduation">
                                        <label class="radio-container form-check-label" for="graduation">
                                            Graduation
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input type="radio" name="audience" value="College"
                                            class="form-check-input sat_1" id="college">
                                        <label class="radio-container form-check-label" for="college">
                                            College
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" name="audience" value="SAT 2"
                                            class="form-check-input sat_2" id="sat_2">
                                        <label class="radio-container form-check-label" for="sat_2">
                                            SAT 2
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="sat_type_1" class="d-none">
                                <h5 class="mt-3"><strong>2. Select the Question Type</strong></h5>
                                <div class="row" style="margin-left: 3px">
                                    <div class="col-md-12 row" style="margin-left: 3px">
                                        <div class="form-check col-md-6 mb-2">
                                            <input type="radio" class="form-check-input" name="question_type"
                                                value="Verbal" id="verbal">
                                            <label class="radio-container form-check-label" for="verbal">
                                                Verbal
                                            </label>
                                        </div>
                                        <div class="form-check col-md-6 mb-2">
                                            <input type="radio" class="form-check-input" name="question_type"
                                                value="Quant" id="quant">
                                            <label class="radio-container form-check-label" for="quant">
                                                Quant
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="sat_type_2" class="d-none">
                                <h5 class="mt-3"><strong>2. Select the Question Subject</strong></h5>
                                <div class="row" style="margin-left: 3px">
                                    <div class="col-md-6">
                                        <div class="form-check mb-2">
                                            <input type="radio" name="subjects" value="Physics"
                                                class="form-check-input" id="physics">
                                            <label class="form-check-label radio-container" for="physics">
                                                Physics
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="radio" name="subjects" value="Chemistry"
                                                class="form-check-input" id="chemistry">
                                            <label class="form-check-label radio-container" for="chemistry">
                                                Chemistry
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check mb-2">
                                            <input type="radio" name="subjects" value="Biology"
                                                class="form-check-input" id="biology">
                                            <label class="form-check-label radio-container" for="biology">
                                                Biology
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="radio" name="subjects" value="Math"
                                                class="form-check-input" id="math">
                                            <label class="form-check-label radio-container" for="math">
                                                Math
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Placeholder for future steps --}}
                        <div class="step step-2 d-none">
                            <div>
                                <h5><strong>3. Provide the verbal Context*</strong></h5>
                                <div id="editor-container">
                                    <div class="editor mb-3" id="context"></div>
                                </div>
                            </div>
                            <div>
                                <h5><strong>4. Write Question & Provide Options*</strong></h5>
                                <div id="editor-container">
                                    <div class="editor mb-3" id="mcq_question"></div>
                                </div>
                                <div class="option-block mt-2 " id="option-container" style="margin-left: 3px">

                                </div>
                                <a type="button" class="mt-2 add-options" style="color: #691D5E">
                                    <b>+ Add Option</b>
                                </a>
                            </div>
                        </div>

                        <div class="step step-3 d-none">
                            <div id="question-container"
                                style="border: 1px solid #D0D5DD; border-radius:8px; padding:10px; background:#F9FAFB">
                            </div>
                            <div class="mt-3">
                                <h5><strong>5. Select the Right Answer</h5>
                            </div>
                            <div id="show-options"class="row mt-2" style="margin-left: 3px"></div>
                            <div>
                                <h5 class="mt-3"><strong>6. How difficult is this Question?</strong></h5>
                            </div>
                            <div class="row" style="margin-left: 3px">
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="difficulty"
                                            id="easy" value="Easy">
                                        <label class="form-check-label" for="easy">
                                            <span class="badge badge-pill badge-easy">Easy</span>
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="difficulty"
                                            id="hard" value="Hard">
                                        <label class="form-check-label" for="hard">
                                            <span class="badge badge-pill badge-hard">Hard</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="difficulty"
                                            id="medium" value="Medium">
                                        <label class="form-check-label" for="medium">
                                            <span class="badge badge-pill badge-medium">Medium</span>
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="difficulty"
                                            id="very-hard" value="Very Hard">
                                        <label class="form-check-label" for="very-hard">
                                            <span class="badge badge-pill badge-very-hard">Very Hard</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="step step-4 d-none">
                            <h5><strong>7. Provide the Explanation</strong></h5>
                            <div id="editor-container">
                                <div class="editor mb-3" id="explanation"></div>
                            </div>
                            <h5 class="mt-3"><strong>8. Want to Active this Question upon saving</strong></h5>
                            <div class="row" style="margin-left: 3px">
                                <div class="col-md-12 row" style="margin-left: 3px">
                                    <div class="form-check col-md-6 mb-2">
                                        <input type="radio" class="form-check-input" name="question_status"
                                            value="active" id="active">
                                        <label class="radio-container form-check-label" for="active">
                                            Make it Active
                                        </label>
                                    </div>
                                    <div class="form-check col-md-6 mb-2">
                                        <input type="radio" class="form-check-input" name="question_status"
                                            value="inactive" id="inactive">
                                        <label class="radio-container form-check-label" for="inactive">
                                            Keep Inactive for now
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-2" style="border-top: 1px solid #D0D5DD">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <!-- Left side: Placeholder wrapper to maintain spacing -->
                            <div class="left-placeholder">
                                <button type="button" class="btn new-question d-none">Save & Create Another</button>
                            </div>

                            <!-- Right side: Navigation buttons -->
                            <div class="d-flex">
                                <button type="button"
                                    class="btn back-btn btn-outline-secondary cancel mr-2">Cancel</button>
                                <button type="button"
                                    class="btn back-btn btn-outline-secondary prev-step mr-2 d-none">Back</button>
                                <button type="button" class="btn next-step">Next</button>
                                <button type="submit" class="btn save-question d-none"
                                    style="background:#691D5E; color: #EAECF0; border-radius: 8px;">Save
                                    Question</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Question upload modal --}}
    <section>
        <div class="modal fade" id="uploadQuestion" tabindex="-1" role="dialog" aria-labelledby="uploadQuestion"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content student-create-section" style="border-radius: 24px; height:100%">
                    <div class="modal-header text-center"
                        style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                        <h3 class="" id="exampleModalLongTitle"><b>Upload CSV</b></h3>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2">
                            <x-input-label for="photo" :value="__('Photo')" />
                            {{-- <form action="#" class="dropzone" id="dropzone_single"></form> --}}
                            <div class="photosection" ondragover="allowDrop(event)" ondrop="dropImage(event)">
                                <!-- Profile Image Preview -->
                                <img id="previewImage" src="">

                                <!-- Upload Area -->
                                <label for="profileImage" style="cursor: pointer; position: relative;">
                                    <div class="upload-icon">
                                        <img src="{{ asset('image/icon/image-upload.png') }}" alt="Upload Icon"
                                            style="width: 16.67px; height: 15px;">
                                    </div>
                                    <h5 style="font-size: 14px;">
                                        <span style="color: #521749">Click to upload</span>
                                        <span style="color: #475467"> or drag and drop</span>
                                    </h5>
                                </label>

                                <!-- Hidden File Input -->
                                <input type="file" id="profileImage" name="profile_image" accept="image/*"
                                    style="display: none;" onchange="previewImage(event)">
                            </div>

                        </div>
                        <div class="mt-2">
                            <label for="question-url">Or upload from URL</label>
                            <input type="text" class="form-control" id="question-url"
                                placeholder="Enter Url here" styele="border-radius:8px; border:1px solid #D0D5DD; ">
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-3">
                        <button type="button" class="btn btn-outline-dark"
                            style="border: 1px solid #D0D5DD; border-radius: 8px;"
                            data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn save-student"
                            style="background-color:#A16A99 ;border-radius: 8px; color:#fff">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('css')
        <!-- DataTables -->
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">

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

            .search_input {
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

            .search_input::placeholder {
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

            /* Checked state */
            input[type='checkbox']:checked {
                background-color: #3F1239;
                position: relative;
            }

            /* Adding a custom checkmark */
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

            .custom-checkbox input[type='checkbox'] {
                margin-top: 3px;
            }

            .dataTable tbody>tr.selected,
            .dataTable tbody>tr>.selected {
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

            .dropdown-item.active {
                background-color: #575756 !important;
                padding: 0px;
                margin: 0px;
                border-radius: 0px;
            }

            .datatable-footer,
            .datatable-header {
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

            .dropzone .dz-default.dz-message>span {
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
                border-top: 1px solid #D0D5DD;
                background-color: #fff;
                padding: 10px;
                position: sticky;
                bottom: 0;
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
                box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
                transition: right 0.3s ease-in-out;
                z-index: 1050;
                display: flex;
                flex-direction: column;
            }

            .filter-sidebar-content {
                flex-grow: 1;
                height: calc(100vh - 60px - 60px);
                overflow-y: auto;
                padding-left: 15px;
                padding-bottom: 60px;
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
                border-bottom: 1px solid #D0D5DD;
            }

            .floating-sidebar.open {
                right: 0;
            }

            .sidebar-overlay.active {
                display: block;
            }

            /* filter sidebar every dropdown start */
            .filter-group {
                margin-bottom: 10px;
            }

            .form-check {
                display: flex;
                align-items: center;
                justify-content: flex-start;
                gap: 8px;
                cursor: pointer;
            }

            .nested-options {
                margin-left: 24px;
                display: none;
            }

            .toggle-icon {
                cursor: pointer;
                font-size: 14px;
                transition: transform 0.3s ease-in-out;
                margin-left: auto;
            }

            .toggle-icon.open {
                transform: rotate(180deg);
            }

            .form-check-input {
                width: 18px;
                height: 18px;
                accent-color: #4B1D3F;
            }

            .form-check-label {
                font-size: 14px;
                color: #333;
            }

            /* filter sidebar every dropdown end */

            /* filter avg time slider start  */
            .slider-container {
                width: 100%;
                max-width: 300px;
                font-family: Arial, sans-serif;
            }

            .slider-header {
                display: flex;
                justify-content: space-between;
                font-size: 14px;
                margin-bottom: 10px;
            }

            .reset-slider {
                background: none;
                border: none;
                color: black;
                cursor: pointer;
                font-size: 12px;
                font-weight: bold;
                text-decoration: #000 underline;
            }

            .range-slider {
                position: relative;
                display: flex;
                align-items: center;
                width: 100%;
            }

            .range-slider input {
                -webkit-appearance: none;
                width: 100%;
                position: absolute;
                background: transparent;
                pointer-events: none;
            }

            .range-slider input::-webkit-slider-runnable-track {
                background: #E0E0E0;
                height: 4px;
                border-radius: 2px;
            }

            .range-slider input::-webkit-slider-thumb {
                -webkit-appearance: none;
                width: 16px;
                height: 16px;
                background: white;
                border: 3px solid #69275C;
                border-radius: 50%;
                cursor: pointer;
                pointer-events: auto;
                margin-top: -6px;
            }

            .slider-labels {
                display: flex;
                background: white;
                justify-content: space-between;
                font-size: 14px;
                margin-top: 8px;
            }

            /* avg time slider end */

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

            .upload-icon {
                position: absolute;
                bottom: 50px;
                left: 50%;
                transform: translateX(-50%);
                width: 40px;
                height: 40px;
                border: 1px solid #EAECF0;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .photosection {
                height: 120px;
                border: 2px solid #A16A99;
                border-radius: 8px;
                align-items: end;
                display: flex;
                justify-content: center;
                border-style: dashed;
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

            #previewImage {
                height: 104px;
                position: absolute;
                top: 24%;
                left: 17px;
            }
        </style>
        <style>
            input[type="radio"] {
                accent-color: #691D5E;
            }

            label {
                padding-top: 2px;
            }

            .new-question {
                border: 1px solid #691D5E;
                background: #FFFFFF;
                color: #691D5E;
                border-radius: 8px;
            }

            .next-step {
                background: #691D5E;
                color: #EAECF0;
                border-radius: 8px;
            }

            .back-btn {
                border: 1px solid #D0D5DD;
                background: #FFFFFF;
                color: #344054;
                border-radius: 8px;
            }

            .modal-content {
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
            }

            .step-container {
                display: flex;
                align-items: center;
                position: relative;
            }

            .step-group {
                display: flex;
                align-items: center;
            }

            .step-line {
                width: 50px;
                height: 3px;
                background: #D0D5DD;
            }

            .step-group:first-child .step-line {
                display: none;
            }

            .step-circle {
                width: 40px;
                height: 40px;
                border: 3px solid #D0D5DD;
                border-radius: 50%;
                background: #FFFFFF;
                color: black;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                position: relative;
                z-index: 2;
                transition: 0.3s ease-in-out;
            }

            /* Active step */
            .step-circle.active {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: #691D5E;
                color: white;
                border-color: #691D5E;
            }

            /* Completed step */
            .step-circle.completed {
                background: #12B76A;
                color: white;
                border-color: #12B76A;
                position: relative;
            }

            .step-circle.completed::before {
                color: white;
                font-size: 18px;
            }

            .border-left {
                border-left: 3px solid #6c757d;
                /* Left border when options exist */
                padding-left: 10px;
                /* Spacing to avoid text touching the border */
            }


            .badge-pill {
                border-radius: 50px;
                padding: 5px 15px;
                font-size: 14px;
            }

            .badge-easy {
                background-color: #d4edda;
                color: #28a745;
                border: 1px solid #28a745;
            }

            .badge-medium {
                background-color: #d1ecf1;
                color: #17a2b8;
                border: 1px solid #17a2b8;
            }

            .badge-hard {
                background-color: #fff3cd;
                color: #fab905;
                border: 1px solid #fab905;
            }

            .badge-very-hard {
                background-color: #f8d7da;
                color: #dc3545;
                border: 1px solid #dc3545;
            }

            .form-check-input:checked {
                background-color: #6f42c1;
                border-color: #6f42c1;
            }
        </style>

        {{-- /* Switch Button Styles */ --}}
        <style>
            .switch {
                position: relative;
                display: inline-block;
                width: 40px;
                height: 22px;
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
                transition: .4s;
                border-radius: 22px;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 16px;
                width: 16px;
                left: 3px;
                bottom: 3px;
                background-color: white;
                transition: .4s;
                border-radius: 50%;
            }

            input:checked+.slider {
                background-color: #22c55e;
            }

            input:checked+.slider:before {
                transform: translateX(18px);
            }

            .sortable {
                cursor: pointer;
            }

            .asc::after {
                content: "🔼";
            }

            .desc::after {
                content: "🔽";
            }
        </style>
    @endpush

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <!-- Theme JS files -->
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/uploaders/dropzone.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/uploader_dropzone.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_multiselect.js"></script>
        <!-- /theme JS files -->

        <script>
            // toggle delete checkboxes
            $(document).ready(function() {
                function toggleDeleteButton() {
                    let anyChecked = $(".row-checkbox:checked").length > 0;

                    if (anyChecked) {
                        $(".delete-btn").removeClass("d-none");
                    } else {
                        $(".delete-btn").addClass("d-none");
                    }
                }

                $(document).on("change", ".row-checkbox", function() {

                    $(this).closest("tr").toggleClass("selected", this.checked);
                    toggleDeleteButton();
                });


                $("#selectAll").on("change", function() {
                    let isChecked = this.checked;
                    $(".row-checkbox").prop("checked", isChecked).closest("tr").toggleClass("selected",
                        isChecked);
                    toggleDeleteButton();
                });

                // Ensure button state is set correctly on page load
                toggleDeleteButton();
            });
        </script>
        <script>
            $(document).ready(function() {
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

            // Allow drop
            function allowDrop(event) {
                event.preventDefault();
                document.querySelector('.photosection').classList.add('dragover');
            }

            // Remove dragover style on leave
            document.querySelector('.photosection').addEventListener('dragleave', function() {
                this.classList.remove('dragover');
            });

            // Handle dropped image
            function dropImage(event) {
                event.preventDefault();
                document.querySelector('.photosection').classList.remove('dragover');
                const file = event.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    previewFile(file);
                }
            }

            // Handle click upload
            function previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    previewFile(file);
                }
            }

            // Preview image
            function previewFile(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('previewImage');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }

            // filter every dropdown in sidebar
            document.querySelectorAll(".toggle-icon").forEach(icon => {
                icon.addEventListener("click", function() {
                    const target = document.getElementById(this.dataset.target);
                    target.classList.toggle("collapse");
                    this.classList.toggle("open");
                    target.style.display = target.classList.contains("collapse") ? "none" : "block";
                });
            });

            document.querySelectorAll(".toggle-parent").forEach(parentCheckbox => {
                parentCheckbox.addEventListener("change", function() {
                    let targetDiv = document.getElementById(this.nextElementSibling.nextElementSibling.dataset
                        .target);
                    let checkboxes = targetDiv.querySelectorAll("input[type='checkbox']");
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });
            });

            // avg time filter slider
            const minRange = document.getElementById("min-range");
            const maxRange = document.getElementById("max-range");
            const minLabel = document.getElementById("min-label");
            const maxLabel = document.getElementById("max-label");
            const sliderValue = document.getElementById("slider-value");
            const resetButton = document.getElementById("reset-slider");

            function updateSlider() {
                let minValue = parseInt(minRange.value);
                let maxValue = parseInt(maxRange.value);

                if (maxValue - minValue < 10) {
                    minRange.value = maxValue - 10;
                    maxRange.value = minValue + 10;
                }

                minLabel.innerText = `${Math.floor(minRange.value / 60)}m ${minRange.value % 60}s`;
                maxLabel.innerText = `${Math.floor(maxRange.value / 60)}m ${maxRange.value % 60}s`;

                sliderValue.innerText = `${minLabel.innerText} - ${maxLabel.innerText}`;
            }

            minRange.addEventListener("input", updateSlider);
            maxRange.addEventListener("input", updateSlider);

            resetButton.addEventListener("click", () => {
                minRange.value = 90; // Reset to full range
                maxRange.value = 120;
                updateSlider();
            });

            // Ensure initial full length is displayed
            updateSlider();
        </script>
        <script>
            let currentStep = 1;
            let optionCount = 1;
            const totalSteps = $(".step").length;

            $(document).ready(function() {
                initializeQuill(".editor")

                $(".sat_2").change(function() {
                    $('#sat_type_1').find('input').prop('checked', false);
                    $("#sat_type_2").removeClass("d-none");
                    $("#sat_type_1").addClass("d-none");
                });

                $(".sat_1").change(function() {
                    $('#sat_type_2').find('input').prop('checked', false);
                    $("#sat_type_1").removeClass("d-none");
                    $("#sat_type_2").addClass("d-none");
                });


                $(".next-step").click(function() {
                    if (currentStep < totalSteps) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });

                $(".prev-step").click(function() {
                    if (currentStep > 1) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });

                $(".cancel").click(function() {
                    $("#questionModal").modal("hide"); // Hide modal on cancel (replace ID)
                });

                $(document).on("click", ".add-options", addOption);

                // Event Listener for Removing an Option
                $(document).on("click", ".remove-option", removeOption);

                showStep(currentStep);


                //store and edit section
                let currentPage = 1;
                let perPage = $('#rowsPerPage').val();

                $(document).on('click', '.save-question', store);
                fetchQuestions(currentPage, perPage);

                // Handle pagination clicks
                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    let page = $(this).data('page');
                    if (page) {
                        currentPage = page;
                        fetchQuestions(currentPage, perPage);
                    }
                });

                // Handle "Rows per page" change
                $('#rowsPerPage').change(function() {
                    perPage = $(this).val();
                    fetchQuestions(1, perPage);
                });

                $('.search_input, .multiselect').on('input click', function() {
                    fetchQuestions();
                });

                $(document).on('change', '.toggle-status', updateState);

                $(document).on("change", ".row-checkbox", function() {
                    $(this).closest("tr").toggleClass("selected", this.checked);
                    updateActiveInactiveCount();
                });

                $("#selectAll").on("change", function() {
                    let isChecked = this.checked;
                    $(".row-checkbox").prop("checked", isChecked).closest("tr").toggleClass("selected",
                        isChecked);
                    updateActiveInactiveCount();
                });

                $(document).on('click', '.edit-btn', show);

                // $(document).on('click', '#questionModal' , function() {
                //     // Reset radio buttons and checkboxes (but keep default values)
                //     $("input[name='audience']").prop('checked', false);  
                //     $("input[name='subjects']").prop('checked', false);  
                //     $("input[name='question_type']").prop('checked', false); 

                //     // Hide SAT sections initially
                //     $('#sat_type_1, #sat_type_2').addClass('d-none');

                //     // Clear options container
                //     $('#option-container').html('');
                //     $('#questionModal').modal('show');
                // });
            });

            function updateButtons() {
                if (currentStep === 1) {
                    $(".cancel").removeClass("d-none"); // Show "Cancel"
                    $(".prev-step").addClass("d-none"); // Hide "Back"
                } else {
                    $(".cancel").addClass("d-none"); // Hide "Cancel"
                    $(".prev-step").removeClass("d-none"); // Show "Back"
                }

                if (currentStep === totalSteps) {
                    $(".new-question").removeClass("d-none"); // show "Next" on last step
                    $(".next-step").addClass("d-none"); // Hide "Next" on last step
                    $(".save-question").removeClass("d-none"); // Show "Save"
                } else {
                    $(".new-question").addClass("d-none"); // Hide "Next" on last step
                    $(".next-step").removeClass("d-none"); // Show "Next"
                    $(".save-question").addClass("d-none"); // Hide "Save" before last step
                }
            }
            
            function showStep(step) {

                $(".step").addClass("d-none");
                $(".step-" + step).removeClass("d-none");

                // Step progress indicator
                $(".step-circle").removeClass("active completed");
                $(".step-line").css("background", "#D0D5DD");
                $(".step-circle i").addClass("d-none");
                $(".step-circle .circle-count").removeClass("d-none");

                for (let i = 1; i < step; i++) {
                    $(".step-circle[data-step=" + i + "]").addClass("completed");
                    $(".step-circle[data-step=" + i + "] i").removeClass("d-none");
                    $(".step-circle[data-step=" + i + "] .circle-count").addClass("d-none");
                    $(".step-circle[data-step=" + i + "]").parent().next(".step-group").find(".step-line").css(
                        "background", "#12B76A");
                }

                $(".step-circle[data-step=" + step + "]").addClass("active");

                initializeQuill(); // Reinitialize Quill editor if needed

                updateButtons(); // Ensure button visibility updates

                if (step === 1) {
                    $('.step-title').text('Step 1: Select Audience & Question Type');

                } else if (step === 2) {
                    $('.step-title').text('Step 2: Input Context, Question & Options');
                } else if (step === 3) {
                    $('.step-title').text('Step 3: Select right anwser & choose difficulty level');
                    updateStep3Content();
                } else if (step === 4) {
                    $('.step-title').text('Step 4: Provide explanation & Confirm');
                }
            }

            function addOption() {  
                optionCount++;
                let newOptionId = `option-${optionCount}`;

                let newOptionHtml = `
                    <div class="option-block mt-2" id="${newOptionId}">
                        <div class="parent-editor mb-3" id="option-editor-${optionCount}"></div>
                        <a type="button" class="remove-option" data-option="${newOptionId}"  style="color: red">
                            <b>Remove Option</b>
                        </a>
                    </div>
                `;

                $('#option-container').append(newOptionHtml);
                initializeQuill(`#option-editor-${optionCount}`);

                updateOptionContainerBorder();
            }

            function removeOption() {
                let optionId = $(this).data("option");
                $(`#${optionId}`).remove();
                updateOptionContainerBorder();
            }

             // Function to Add/Remove Border Dynamically
             function updateOptionContainerBorder() {
                if ($('#option-container').children().length > 0) {
                    $('#option-container').addClass('border-left');
                } else {
                    $('#option-container').removeClass('border-left');
                }
            }

             // Function to Copy Step 2 Data into Step 3
             function updateStep3Content() {
                let context = $("#context .ql-editor").text();
                let mcq_question = $("#mcq_question .ql-editor").text();

                // if (context === "" || mcq_question === "") {
                //     alert('Please fill all the fields');
                //     // $('.step-3').html('');
                // }
                $('#question-container').html(
                    `
                        <p>${context}</p>
                        <div>
                            <p><strong>Question:</strong></p>
                            <p style="padding:0">${mcq_question}</p>
                        </div>
                    `
                );
                let optionsHtml = ``;

                // Loop through options and create radio button inputs
                $("#option-container .option-block .parent-editor").each(function(index) {
                    let optionText = $(this).find(".ql-editor p").html(); // Get option content
                    optionsHtml += `
                        <div class="form-check col-md-6 row" style="margin-left:3px">
                            <label class="radio-container col-md-12" style="padding-top:2px" for="option-${index}">
                                <input class="form-check-input" type="radio" name="mcq_options" value="${optionText}" id="option-${index}" style="display: inline-block; visibility: visible;">
                                ${optionText}
                            </label>
                        </div>
                    `;
                });

                $('#show-options').html(optionsHtml);
            }

            function initializeQuill(selector, content = null) {
                // console.log('Received content inside initializeQuill:', content);

                $(selector).each(function() {
                    if (!$(this).hasClass("ql-container")) {
                        new Quill(this, {
                            modules: {
                                toolbar: [
                                    ['bold', 'italic', 'underline', 'strike'],
                                    ['blockquote', 'code-block'],
                                    ['link', 'image', 'video', 'formula'],
                                    [{
                                        'header': 1
                                    }, {
                                        'header': 2
                                    }],
                                    [{
                                        'list': 'ordered'
                                    }, {
                                        'list': 'bullet'
                                    }],
                                    [{
                                        'script': 'sub'
                                    }, {
                                        'script': 'super'
                                    }],
                                    [{
                                        'direction': 'rtl'
                                    }],
                                    [{
                                        'size': ['small', false, 'large', 'huge']
                                    }],
                                    [{
                                        'header': [1, 2, 3, 4, 5, 6, false]
                                    }],
                                    [{
                                        'color': []
                                    }, {
                                        'background': []
                                    }],
                                    [{
                                        'font': []
                                    }],
                                    [{
                                        'align': []
                                    }]
                                ]
                            },
                            placeholder: 'Compose an epic...',
                            theme: 'snow'
                        });
                        // console.log('Before condition check: content.trim() is', content);

                        if (content !== null && content.trim() !== '') {
                            // console.log('Content being set: ', content);
                            quill.root.innerHTML = content; // Set the content as HTML
                        } else {
                            // console.log('No content to set or content is empty.');
                        }
                    }
                });
            }



            const store = (e) => {
                e.preventDefault();

                let formData = {
                    audience: $('input[name="audience"]:checked').val(),
                    sat_type: $('input[name="audience"]:checked').val() === 'SAT 2' ? 'SAT 2' : 'SAT 1',
                    sat_question_type: $('input[name="question_type"]:checked').val() || $(
                        'input[name="subjects"]:checked').val(),
                    question_title: $('#mcq_question').text().trim(),
                    question_description: $('#context').text().trim(),
                    question_text: $('#mcq_question').text().trim(),
                    question_type: 'MCQ',
                    options: JSON.stringify(getOptions()),
                    correct_answer: $('input[name="mcq_options"]:checked').val(),
                    difficulty: $('input[name="difficulty"]:checked').val(),
                    explanation: $('#explanation').text().trim(),
                    status: $('input[name="question_status"]:checked').val(),
                };

                $.ajax({
                    url: '/api/questions',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire("Success", "Question created successfully!", "success");
                            location.reload();
                        } else {
                            Swal.fire("Error", "Failed to created successfully!", "error");
                            checkbox.prop('checked', !checkbox.is(':checked'));
                        }
                    },
                    error: function() {
                        Swal.fire("Error", "Something went wrong!", "error");
                        checkbox.prop('checked', !checkbox.is(':checked'));
                    }

                });
            }

            // Function to collect options from the UI
            function getOptions() {
                let options = [];
                $(".option-block .parent-editor").each(function() {
                    let optionText = $(this).find(".ql-editor").text().trim(); // Get option text properly
                    if (optionText) {
                        options.push(optionText);
                    }
                });
                return options;
            }

            // get all questions
            function fetchQuestions(page = 1, perPage = 10) {
                let filters = {
                    search: $('.search_input').val(),
                    difficulty: $('.multiselect').val(),
                };

                $.ajax({
                    url: "/api/questions?page=" + page + "&per_page=" + perPage,
                    type: "GET",
                    data: filters,
                    success: function(response) {
                        let rows = '';
                        $.each(response.data, function(index, question) {
                            let difficultyColor = getDifficultyColor(question.difficulty);
                            let statusChecked = question.status ? "checked" : "";

                            // <td><span class="badge badge-pill badge-hard">Hard</span><p class="text-center"><span>9/10</span>(70%)</p></td>
                            rows += `<tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" >${question.question_title}</td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" >${question.audience}</td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" >${question.question_type}</td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" >${question.exam || ''}</td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" ><span class="badge badge-pill ${difficultyColor}">${question.difficulty}</span></td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" >${question.avg_time || '00:00'} min</td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" >${question.created_at}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-status" data-id="${question.id}" ${question.status === 'active' ? 'checked' : '' }>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                     <td class="text-center"><button data-toggle="modal" data-id="${question.id}" data-target="#questionModal" class="btn edit-btn"><i class="far fa-edit"></i>Edit</button></td>
                                </td>
                            </tr>`;
                        });
                        $("#question-table-body").html(rows);
                        updatePagination(response, page);
                    },
                    error: function() {
                        alert("Error fetching questions.");
                    }
                });
            }

            function updatePagination(response, currentPage) {
                let totalResults = response.total;
                let perPage = response.per_page;
                let totalPages = response.last_page;
                let start = (response.from || 0);
                let end = (response.to || 0);

                $('#pagination-info').text(`Showing ${start}-${end} out of ${totalResults} results`);
                $('#total-questions').text(`${totalResults} Questions`);

                let paginationHtml = '';

                // First & Previous
                paginationHtml += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="1">«</a></li>`;
                paginationHtml += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="${currentPage - 1}">‹</a></li>`;

                // Page Numbers
                if (currentPage > 2) {
                    paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`;
                    paginationHtml += `<li class="page-item disabled"><a class="page-link" href="#">...</a></li>`;
                }

                for (let i = Math.max(1, currentPage - 1); i <= Math.min(totalPages, currentPage + 1); i++) {
                    paginationHtml += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                                            <a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                }

                if (currentPage < totalPages - 1) {
                    paginationHtml += `<li class="page-item disabled"><a class="page-link" href="#">...</a></li>`;
                    paginationHtml +=
                        `<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a></li>`;
                }

                // Next & Last
                paginationHtml += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="${currentPage + 1}">›</a></li>`;
                paginationHtml += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="${totalPages}">»</a></li>`;

                $('#pagination-links').html(paginationHtml);
            }

            function getDifficultyColor(difficulty) {
                switch (difficulty.toLowerCase()) {
                    case "easy":
                        return "badge-easy";
                    case "medium":
                        return "badge-medium";
                    case "hard":
                        return "badge-hard";
                    case "very hard":
                        return "badge-very-hard";
                    default:
                        return "bg-secondary text-white";
                }
            }

            // Toggle status (on/off)
            function updateState() {
                let questionId = $(this).data('id');

                let newStatus = $(this).is(':checked') ? 'active' : 'inactive';

                $.ajax({
                    url: `/api/questions/${questionId}/update-status`,
                    type: "PATCH",
                    data: {
                        status: newStatus
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire("Success", "Status updated successfully!", "success");
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
            }

            function updateActiveInactiveCount() {
                let selectedRows = $(".row-checkbox:checked").closest("tr");

                let activeCount = selectedRows.find(".toggle-status:checked").length;
                let inactiveCount = selectedRows.length - activeCount;

                // Update UI
                $("#active-count").text(activeCount);
                $("#inactive-count").text(inactiveCount);
            }

            function resetModalData() {
                // Reset all form inputs, text areas, and select elements
                $('#question_id').val('');
                $('#question_title').val('');
                $('#question_description').val('');
                $('#question_text').val('');
                $('#explanation').val('');
                $('#difficulty').val('');
                $('#correct_answer').val('');
                $('#question_type').val('');

                // Reset all radio buttons
                $("input[type='radio']").prop('checked', false);

                // Reset all Quill editors
                $('.quill-editor').each(function() {
                    // Assuming your Quill editors have class 'quill-editor'
                    $(this).html('');
                });

                // Reset the options container
                $('#option-container').html('');
                $('#show-options').html('');

                // Hide sat-type options by default
                $('#sat_type_1').removeClass('d-none');
                $('#sat_type_2').addClass('d-none');
                $('#sat_type_1').find('input').prop('checked', false);
                $('#sat_type_2').find('input').prop('checked', false);
                
            }

            function show() {
                let questionId = $(this).data('id');
                let dynamicModalId = $('#questionModal').attr('dynamic-id', 1);

                if (dynamicModalId != questionId) {
                    if (currentStep > 1) {
                        let stepIndex = currentStep;
                        let stepBackInterval = setInterval(function() {
                            if (stepIndex > 1) {
                                stepIndex--;
                                showStep(stepIndex);
                            } else {
                                clearInterval(stepBackInterval);
                                currentStep = 1; // Ensure currentStep is set to 1 after loop
                                showStep(currentStep); // Show step 1
                                console.log('Current Step After Reset:', currentStep);
                            }
                        }, 5);
                    }

                    if (currentStep === 1) {
                        $(".cancel").removeClass("d-none"); // Show "Cancel"
                        $(".prev-step").addClass("d-none"); // Hide "Back"
                    } else {
                        $(".cancel").addClass("d-none"); // Hide "Cancel"
                        $(".prev-step").removeClass("d-none"); // Show "Back"
                    }

                    $('#questionModal').attr('dynamic-id', questionId)
                    resetModalData();
                }

                $.get(`/api/questions/${questionId}`, function(response) {
                    console.log(response);

                    // Set values in the modal
                    $("input[name='audience'][value='" + response.audience + "']").prop('checked', true);

                    if (response.sat_type === 'SAT 2') {
                        $('#sat_type_1').addClass('d-none');
                        $('#sat_type_2').removeClass('d-none');
                        $('#sat_type_1').find('input').prop('checked', false);

                        $("input[name='subjects'][value='" + response.sat_question_type + "']").prop('checked', true);
                    } else if ((response.sat_type === 'SAT 1')) {
                        $('#sat_type_2').addClass('d-none');
                        $('#sat_type_1').removeClass('d-none');
                        $('#sat_type_2').find('input').prop('checked', false);

                        $("input[name='question_type'][value='" + response.sat_question_type + "']").prop('checked', true);
                    }
                    $("input[name='question_status'][value='" + response.status + "']").prop('checked', true);
                    $("input[name='difficulty'][value='" + response.difficulty + "']").prop('checked', true);

                    $('#mcq_question').text();
                    $('#question_id').val(response.id);
                    $('#modalTitle').text('Edit Question'); // Change modal title
                    $('#question_title').val(response.question_title);
                    $('#question_description').val(response.question_description);
                    $('#question_text').val(response.question_text);
                    $('#explanation').val(response.explanation);
                    $('#difficulty').val(response.difficulty);
                    $('#correct_answer').val(response.correct_answer);
                    // $('#audience').val(response.audience);
                    $('#question_type').val(response.question_type);

                    initializeQuill('#context', response.question_description);
                    initializeQuill('#mcq_question', response.question_title);

                    // Parse and set options
                    let options = JSON.parse(response.options);
                    let optionsHtml = ``;
                    // $('#option-container').html('');
                    options.forEach(function(optionText, index) {

                        let newOptionHtml = `
                            <div class="option-block mt-2" id="option-${index}">
                                <div class="parent-editor mb-3" id="option-editor-${index}">${optionText}</div>
                                <a type="button" class="remove-option" data-option="option-${index}"  style="color: red">
                                    <b>Remove Option</b>
                                </a>
                            </div>
                        `;

                        $('#option-container').append(newOptionHtml);
                        initializeQuill(`#option-editor-${index}`);
                    });

                    $('#show-options').html(optionsHtml);
                    // console.log(initialStep, 'jhdbfjhsf');

                    // Show modal
                    $('#questionModal').modal('show');

                    // $('#audience').val(response.audience);
                    // $('#question_type').val(response.question_type);
                    // $('#question_title').val(response.question_title);

                    // $('#question_description').val(response.question_description);
                });
            }

            function edit() {

            }

        </script>
    @endpush

</x-backend.layouts.master>
