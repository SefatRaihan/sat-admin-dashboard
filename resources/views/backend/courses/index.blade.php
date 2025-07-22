<x-backend.layouts.master>
    @php
        $prependHtml = '
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                <a href=\'/courses/create\' data-toggle=\'modal\' data-target=\'#courseModal\' class=\'btn d-flex btn-link create-btn btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                    <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Add Course
                </a>
            </div>
        ';
    @endphp

    <x-backend.layouts.partials.blocks.contentwrapper :headerTitle="'All Courses'" :prependContent="$prependHtml">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div class="d-none" id="courseNullList">
        <x-backend.layouts.partials.blocks.empty-state
            title="You have not created any Course yet"
            message="Let’s create a new course"
            buttonText="Create Course"
            buttonRoute="#courseModal"
        />
    </div>

    <section>
        <div id="courseList">
            <div class="card"
                style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <div>
                        <input type="text" id="search" class="form-control search_input" placeholder="Search Courses" style="padding-left: 40px">
                    </div>

                    <div class="d-flex">
                        <button type="button" class="btn pt-0 pb-0 mr-2"
                            style="border: 1px solid #D0D5DD; border-radius: 8px;" onclick="filter(this)"><img
                                src="{{ asset('image/icon/layer.png') }}" alt=""> Filters</button>

                        <div class="form-group mb-0">
                            <select class="form-control" id="sortSelect">
                                <option value="Latest" selected>Latest</option>
                                <option value="Oldest">Oldest</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 m-0 table-responsive">
                    <!-- Filters & Pagination Controls -->
                    <div class="d-flex justify-content-between align-items-center mt-3 p-2">
                        <h4><strong id="total-courses"></strong></h4>
                        <div class="delete-btn d-none">
                            <button class="btn"><img src="{{ asset('image/icon/download.png') }}"
                                    alt=""></button>
                            <button class="btn text-danger course-delete"><i class="fas fa-trash-alt"></i></button>
                            <button class="btn text-success"><strong>Make <span id="active-count"></span>
                                    Active</strong></button>
                            <button class="btn text-warning"><strong>Make <span id="inactive-count"></span>
                                    Inactive</strong></button>
                        </div>
                    </div>

                    <!-- Courses Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr class="bg-light">
                                    <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                                    <th>Courses</th>
                                    <th>Audience</th>
                                    <th>Chapter No</th>
                                    <th>Lessons No</th>
                                    <th>Duration</th>
                                    <th>Created</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="course-table-body">
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
                        <div class="pt-3 pr-3 pb-3 pl-0">
                            <div class="d-flex justify-content-between">
                                <p style="font-size: 12px"> <span style="color: #344054"><b>Created on:</b></span> <span
                                        style="color: #475467">06 Jan 25 - 12 Jan 25</span></p>
                                <button class="reset-slider reset-filter-btn"><u>Reset</u></button>
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
                            <div class="mt-2">
                                <div class="d-flex justify-content-between">
                                    <h6><b>Audience & Type:</b> All Result</h6>
                                </div>
                                <div id="all_sat_type_1">
                                    <div class="filter-group">
                                        <div class="form-check">
                                            <input class="form-check-input toggle-parent" type="checkbox" class="All SAT 1" id="allSet1Toggle">
                                            <label class="form-check-label" for="allSet1Toggle">
                                                All SAT 1
                                            </label>
                                            <span class="toggle-icon" data-target="allSet1"><i class="fas fa-chevron-down"></i></span>
                                        </div>
                                        <div class="nested-options collapse" id="allSet1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="High School-Verbal" id="exam1">
                                                <label class="form-check-label" for="exam1">High School : Verbal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="High School-Quant" id="exam2">
                                                <label class="form-check-label" for="exam2">High School : Quant</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="College-Verbal" id="exam3">
                                                <label class="form-check-label" for="exam3">College : Verbal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="College-Verbal" id="exam3">
                                                <label class="form-check-label" for="exam3">College : Verbal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Graduate-Verbal" id="exam3">
                                                <label class="form-check-label" for="exam3">Graduate : Verbal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Graduate-Quant" id="exam3">
                                                <label class="form-check-label" for="exam3">Graduate : Quant</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="all_sat_type_2">
                                    <div class="filter-group">
                                        <div class="form-check">
                                            <input class="form-check-input toggle-parent" type="checkbox" value="All SAT 2" id="allSet2Toggle">
                                            <label class="form-check-label" for="allSet2Toggle">
                                                All SAT 2
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="d-flex justify-content-between">
                                    <h6><b>Exam Appearance:</b> All Result</h6>
                                </div>
                                <div class="mb-1">
                                    <input type="text" class="form-control course_search_input w-100 pl-4" placeholder="Search Courses">
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="slider-container" style="max-width: 100% !important">
                                    <div class="slider-header">
                                        <span>Average Time:</span>
                                        <span id="slider-value">1m 00s - 2m 00s</span>
                                        <button class="reset-slider reset-filter-btn" id="reset-slider">Reset</button>
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

                        </div>
                    </div>
                </div>
                <div class="border-top fixed-bottom-buttons">
                    <div class="d-flex justify-content-between p-3">
                        <button type="button" class="btn apply-filter-btn"
                            style="background-color:#691D5E ;border-radius: 8px; color:#fff; width:50%">Apply
                            Filters</button>
                        <button type="button" class="btn btn-outline-dark ml-2 reset-filter-btn"
                            style="border: 1px solid #D0D5DD; border-radius: 8px; width:50%">Reset All</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- show details modal --}}
    {{-- <section>
        <div class="modal fade" id="detailModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="detailModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 60%">
                <div class="modal-content" style="border-radius: 24px; height:100%">
                    <div class="modal-header text-left d-flex pb-3" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                        <h5 class="modal-title" id="exampleModalLongTitle">CourseID <span id="courseCode">#SID000</span></h5>
                        <button type="button" class="close p-0 m-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="course-tab" data-toggle="tab" href="#course"
                                        role="tab" aria-controls="course" aria-selected="true">Course</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="explanation-tab" data-toggle="tab" href="#explanation"
                                        role="tab" aria-controls="explanation" aria-selected="false">Explanation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="details-tab" data-toggle="tab" href="#details"
                                        role="tab" aria-controls="details" aria-selected="false">Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="analytics-tab" data-toggle="tab" href="#analytics"
                                        role="tab" aria-controls="analytics" aria-selected="false">Analytics</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="feedbacks-tab" data-toggle="tab" href="#feedbacks"
                                        role="tab" aria-controls="feedbacks" aria-selected="false">Feedbacks</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="course" role="tabpanel" aria-labelledby="course-tab">
                                    <div>
                                        <div id="course-show-card" style="border: 1px solid #D0D5DD; border-radius:8px; padding:10px; background:#F9FAFB">
                                            <span id="course_description"></span>
                                            <p class="mb-0 mt-1">
                                                <strong>Course:</strong>
                                            </p>
                                            <p id="course_text" class="pt-0 mt-0"></p>
                                        </div>
                                        <div class="mt-3">
                                            <h5><strong>Options:</strong></h5>
                                            <div id="course-options" class="row mt-2" style="margin-left: 3px"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="explanation" role="tabpanel" aria-labelledby="explanation-tab">
                                    <div>
                                        <span id="explanation"></span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                                    <h4>Course Details</h4>
                                    <table class="table table-striped custom-table course-details-table" style="border: 1px solid #EAECF0">
                                        <tr>
                                            <td style="width: 25%">Audience</td>
                                            <td class="font-weight-bold audience" style="width: 25%">: </td>

                                            <td style="width: 25%">Course Type</td>
                                            <td class="font-weight-bold course-type" style="width: 25%">: </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 25%">Created By</td>
                                            <td class="font-weight-bold created-by" style="width: 25%">: </td>

                                            <td style="width: 25%">Created on</td>
                                            <td class="font-weight-bold created-on" style="width: 25%">: </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 25%">Appearing exams</td>
                                            <td class="font-weight-bold apperaing-exam" style="width: 25%">: </td>

                                            <td style="width: 25%">Total appearance</td>
                                            <td class="font-weight-bold total-appearance" style="width: 25%">: </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 25%">Correct percentage</td>
                                            <td class="font-weight-bold correct-percentage" style="width: 25%">: </td>

                                            <td style="width: 25%">Average time</td>
                                            <td class="font-weight-bold average-time" style="width: 25%">: </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 25%">Difficulty level</td>
                                            <td class="font-weight-bold defficulty-level" style="width: 25%">: </td>

                                            <td style="width: 25%">Feedbacks</td>
                                            <td class="font-weight-bold feedbacks" style="width: 25%">: </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 25%">Last updated by</td>
                                            <td class="font-weight-bold last-updated-by" style="width: 25%">: </td>

                                            <td style="width: 25%">Last updated on</td>
                                            <td class="font-weight-bold last-updated-on" style="width: 25%">: </td>
                                        </tr>
                                    </table>

                                    <h4 class="mt-3">Appearing Exams</h4>
                                    <table class="table datatable-basic" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info"  style="border: 1px solid #EAECF0">
                                        <thead>
                                            <tr class="bg-light" role="row">
                                                <th>Exam</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Total App</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Correct</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Wrong</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">N/A</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Avg. Time</th>
                                            </tr>
                                        </thead>
                                        <tbody id="exam-details">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="analytics" role="tabpanel" aria-labelledby="analytics-tab">
                                    <h4>Result Analysis</h4>
                                    <div id="chartdiv"></div>
                                    <h4>Result Analysis</h4>
                                    <div id="areaChartdiv"></div>
                                    <h4 class="mt-3">All Appearances</h4>
                                    <table class="table datatable-basic" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info"  style="border: 1px solid #EAECF0">
                                        <thead>
                                            <tr class="bg-light" role="row">
                                                <th>Exam</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Student</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">App. Type</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Time</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Created</th>
                                            </tr>
                                        </thead>
                                        <tbody id="all-appearances">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="feedbacks" role="tabpanel" aria-labelledby="feedbacks-tab">
                                    <div>
                                        <button class="btn ml-0 feedback-btn active">Pending <span class="feedback-btn-count">4</span></button>
                                        <button class="btn feedback-btn">Pending <span class="feedback-btn-count">2</span></button>
                                        <button class="btn feedback-btn">Pending <span class="feedback-btn-count">0</span></button>
                                    </div>

                                    <h4 class="mt-3">4 Pending Feedbacks</h4>
                                    <table class="table datatable-basic" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info"  style="border: 1px solid #EAECF0">
                                        <thead>
                                            <tr class="bg-light" role="row">
                                                <th><input type="checkbox" class="select-all-feedback"></th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Feedback</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Student</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Created</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="all-appearances">
                                            <tr>
                                                <td><input type="checkbox" class="row-checkbox student-row""></td>
                                                <td>I think this course is not appropriate for the SAT 1 exam. Can you look into it?</td>
                                                <td>Sani</td>
                                                <td>22 Mar, 2025</td>
                                                <td class="d-flex">
                                                    <button class="btn btn-sm" style="border: 1px solid #EAECF0; border-radius: 7px;">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm ml-2" style="border: 1px solid #EAECF0; border-radius: 7px;">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-between border-top pt-3">
                        <button type="button" class="btn show-edit-btn"
                            style="border: 1px solid #D0D5DD; border-radius: 8px;" data-toggle="modal" data-target="#courseModal">Edit Course</button>
                        <button type="button" class="btn btn-outline-dark show-modal-close"
                            style="background-color:#691D5E ;border-radius: 8px; color:#fff"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- create modal --}}
    <section>
        <div class="modal fade" id="courseModal" tabindex="-1" role="dialog"
            aria-labelledby="courseModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 80%">
                <div class="modal-content" style="border-radius: 24px; height:100%">
                    <div style="background: #F9FAFB;  border-bottom:1px solid #D0D5DD ">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <h4 class="text-center font-weight-bold course-modal-heading">Create a Course</h4>
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
                        <input type="hidden" name="" id="courseCorrectAnswer" value="{{null}}">
                        <input type="hidden" name="" id="courseId" value="{{null}}">
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
                                <h5 class="mt-3"><strong>2. Select the Course Type</strong></h5>
                                <div class="row" style="margin-left: 3px">
                                    <div class="col-md-12 row" style="margin-left: 3px">
                                        <div class="form-check col-md-6 mb-2">
                                            <input type="radio" class="form-check-input" name="course_type"
                                                value="Verbal" id="verbal">
                                            <label class="radio-container form-check-label" for="verbal">
                                                Verbal
                                            </label>
                                        </div>
                                        <div class="form-check col-md-6 mb-2">
                                            <input type="radio" class="form-check-input" name="course_type"
                                                value="Quant" id="quant">
                                            <label class="radio-container form-check-label" for="quant">
                                                Quant
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="sat_type_2" class="d-none">
                                <h5 class="mt-3"><strong>2. Select the Course Subject</strong></h5>
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
                            <div>
                                <div class="form-group">
                                    <div style="display: flex; justify-content: space-between;">
                                        <h5 class="mt-3"><strong>3. Course Title</strong></h5>
                                    </div>
                                    <input type="text" class="form-control" max="" id="title" name="title" placeholder="">
                                </div>
                            </div>

                            <div>
                                <div class="form-group">
                                    <div style="display: flex; justify-content: space-between;">
                                        <h5 class="mt-3"><strong>4. Course Description</strong></h5>
                                    </div>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="5" max="500"></textarea>
                                    <p class="text-right" style="color: #475467">429 /500 character Maximum </p>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">5. Course Thumbnail</label>

                                <div id="thumbnail-upload-box" class="upload-box text-center p-4 border border-dashed rounded">
                                    <input type="file" id="thumbnail" name="thumbnail" class="d-none" accept="image/jpeg, image/png" />

                                    <div id="upload-preview" class="mb-2">
                                        <img src="#" id="preview-image" alt="Preview" class="img-fluid d-none" style="max-height: 200px;" />
                                    </div>

                                    <label for="thumbnail" class="upload-label mt-3">
                                        <div class="upload-icon mb-2">
                                                <img src="{{ asset('image/icon/image-upload.png') }}" alt="Upload Icon" style="width: 16.67px; height: 15px;">
                                        </div>
                                        <span class="d-block fw-semibold text-primary">Click to upload</span>
                                        <span class="text-muted small">or drag and drop</span><br>
                                        <span class="text-muted small">JPEG, PNG formats</span><br>
                                        <span class="text-muted small">[Max: 10MB]</span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        {{-- Placeholder for future steps --}}
                        <div class="step step-2 d-none">
                            <div>
                                <h5><strong>Chapter Options</strong></h5>
                                <div>
                                    <select name="chapter" class="form-control " id="chapter" multiple></select>
                                </div>
                            </div>
                        </div>

                        <div class="step step-3 d-none">
                            <div>
                                <h5><strong>Lesson</strong></h5>
                                <div class="form-group lessonSelectBox">

                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <h5><strong>Is Exam Create</strong></h5>
                                <div>
                                    <input type="checkbox" class="form-control" name="isExamCreate" id="isExamCreate">
                                </div>
                            </div>

                            <div class="mt-2 exam-section" style="display: none;">
                                <h5><strong>Select from existing exam</strong></h5>
                                <div>
                                    <select name="exam" class="form-control exam" id="exam"></select>
                                </div>
                            </div>
                        </div>

                        <div class="step step-4 d-none">
                            <div class="course-page-container">
                                <div class="main-content">
                                    <div class="video-player-section">
                                        <video id="lesson-player" controls width="100%" height="auto" poster="https://via.placeholder.com/800x450/4A67ED/FFFFFF?text=Course+Video+Placeholder">
                                            <source id="videoSource" src="" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>

                                    <div class="course-meta">
                                        <div class="tags">
                                            <span id="lastAudience"></span>
                                            <span id="total-lessons"></span>
                                            <span id="total-chapters"></span>
                                            <span id="total-duration"></span>
                                        </div>
                                        <h1 id="show_title"></h1>
                                        <p id="show_description"></p>
                                    </div>
                                </div>

                                <div class="sidebar2">
                                    <div class="student-profile-card">
                                        <div class="profile-avatar">
                                            <img src="https://via.placeholder.com/50/4A67ED/FFFFFF?text=MS" alt="Img">
                                        </div>
                                        <div class="profile-info">
                                            <div class="name">Mubhir Student</div>
                                            <div class="role">SAT Student</div>
                                        </div>
                                        <div class="progress-info">
                                            <div style="display: flex; justify-content: space-between;">
                                                <div class="progress-label">In Progress</div>
                                                <div class="progress-percentage">67%</div>
                                            </div>
                                            <div class="progress-bar-container">
                                                <div class="progress-bar" style="width: 67%;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="course-lessons-list" id="courseLessonsList"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-2" style="border-top: 1px solid #D0D5DD">
                        <div class="d-flex w-100 justify-content-end align-items-center">
                            <!-- Left side: Placeholder wrapper to maintain spacing -->

                            <!-- Right side: Navigation buttons -->
                            <div class="d-flex">
                                <button type="button"
                                    class="btn back-btn btn-outline-secondary cancel mr-2">Cancel</button>
                                <button type="button"
                                    class="btn back-btn btn-outline-secondary prev-step mr-2 d-none">Back</button>
                                <button type="button" class="btn next-step">Next</button>
                                <button type="submit" class="btn save-course d-none"
                                    style="background:#691D5E; color: #EAECF0; border-radius: 8px;">Save
                                    Course</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('css')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('css/courses.css') }}">

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

            .datatable-footer, .datatable-header {
                padding: 0.25rem 0.25rem 0 0.25rem;
                margin-left: 0px;
                margin-right: 0px;
                margin-bottom: 14px;
            }

            /* thumbnail upload */
            .upload-box {
                border: 2px dashed #d1c4e9;
                background-color: #fdfdff;
                cursor: pointer;
                transition: border-color 0.3s ease;
            }
            .upload-box:hover {
                border-color: #7e57c2;
            }
            .upload-label {
                display: block;
                cursor: pointer;
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
                bottom: 150px;
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

            .new-course {
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
            #chartdiv {
                width: 100%;
                height: 300px;
            }

            #areaChartdiv {
                width: 100%;
                max-width:100%;
                height: 500px;
            }
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
        <style>
            .exam-section {
                display: none;
            }
            .feedback-btn-count {
                border: 1px solid #EAECF0;
                border-radius: 50%;
                padding: 3px;
                padding-left: 6px;
                padding-right: 6px;
                font-size: 11px;
                background-color: #F9FAFB;
                margin-left: 5px;
            }

            .feedback-btn.active{
                color: #521749 !important   ;
                border: 1px solid #F1E9F0 !important;
                background-color: #F1E9F0 !important;
            }

            .feedback-btn.active .feedback-btn-count {
                border: 1px solid #521749 !important;
                background-color: #F1E9F0 !important;
            }
        </style>

    @endpush

    @push('js')
        <!-- Theme JS files -->
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/uploaders/dropzone.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/uploader_dropzone.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_multiselect.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
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
                    var row = $(this).closest('tr'); // Get the closest <tr> element
                    if ($(this).prop('checked')) {
                        row.css('background-color', '#F1E9F0'); // Change background color
                    } else {
                        row.css('background-color', ''); // Reset background color
                    }

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

                $('.create-btn').on('click', function() {
                    $('#courseModal').find('input[type="radio"]').prop('checked', false);
                    $('#context .ql-editor').html(''),
                    $('#mcq_course .ql-editor').html(''),
                    $('#explanation .ql-editor').html(''),
                    $('#explanation').html('');
                    $('#option-container').empty(); // Clear options
                    $('.step').addClass('d-none').filter('.step-1').removeClass('d-none'); // Reset to step 1
                    $('.step-circle').removeClass('active').first().addClass('active'); // Reset progress
                    $('.course-modal-heading').text('Create Course');
                    $('#courseId').val(null);

                    let courseId = $(this).data('id');
                    let dynamicModalId = $('#courseModal').attr('dynamic-id', 1);
                    if (dynamicModalId != courseId) {
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

                        $('#courseModal').attr('dynamic-id', courseId)
                        resetModalData();
                    }
                });
            });
        </script>
        <script>
            const appUrl = @json(config('app.url'));
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
            // document.querySelector('.photosection').addEventListener('dragleave', function() {
            //     this.classList.remove('dragover');
            // });

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

            $('.show-edit-btn').click(function (e) {
                e.preventDefault();
                $('.show-modal-close').trigger('click');
            });

            $(".feedback-btn").on("click", function() {
                $(".feedback-btn").removeClass("active")
                $(this).addClass("active");
            });

            $(document).ready(function() {

                $(document).on('click', '.create-btn',selectChapter);
                $(document).on('click', '.create-btn',selectLesson);
                $(document).on('click', '.create-btn',selectExam);


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
                    $("#courseModal").modal("hide"); // Hide modal on cancel (replace ID)
                });


                // Event Listener for Removing an Option

                showStep(currentStep);

                //store and edit section
                $(document).on('click', '.save-course', store);

                // start datatable code
                let currentPage = 1;
                let perPage = $('#rowsPerPage').val();

                fetchCourses(currentPage, perPage);

                // Handle pagination clicks
                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    let page = $(this).data('page');
                    if (page) {
                        currentPage = page;
                        fetchCourses(currentPage, perPage);
                    }
                });

                // Handle "Rows per page" change
                $('#rowsPerPage').change(function() {
                    perPage = $(this).val();
                    fetchCourses(1, perPage);
                });

                $('#sortSelect').on('change', function() {
                    let sortOption = $(this).val();
                    fetchCourses(1, perPage, sortOption);
                });

                //end datatable code


                $(document).on("change", ".row-checkbox", function() {
                    $(this).closest("tr").toggleClass("selected", this.checked);
                    updateActiveInactiveCount();
                });

                $(document).on('click', '.course-delete', destroy);

                $("#selectAll").on("change", function() {
                    let isChecked = this.checked;
                    $(".row-checkbox").prop("checked", isChecked).closest("tr").toggleClass("selected",
                        isChecked);
                    updateActiveInactiveCount();
                });

                $(document).on('click', '.edit-btn', show);

                $('.search_input, .multiselect').on('input click', function() {
                    fetchCourses();
                });

                let searchTimeout;
                $('.search_input').on('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        fetchCourses(1, $('#rowsPerPage').val());
                    }, 300); // 300ms debounce
                });

                // Apply filters button click
                $('.apply-filter-btn').on('click', function() {
                    fetchCourses(1, $('#rowsPerPage').val());
                });

                // Reset filters button click
                $('.reset-filter-btn').on('click', function() {
                    // Reset all filter inputs
                    $('.search_input').val('');
                    $('input[name="crated_start_at"]').val('');
                    $('input[name="crated_end_at"]').val('');
                    $('.course_search_input').val('');

                    $('input[name="status"][value="All"]').prop('checked', true);
                    $('.filter-group input:checkbox').prop('checked', false);
                    $('.custom-checkbox input:checkbox').prop('checked', false);
                    $('.multiselect').val([]).trigger('change');


                    // Fetch with reset filters
                    fetchCourses(1, $('#rowsPerPage').val());
                });

                $(document).on("click", ".openDetailModal", detailModal);


                // course view

                $('#isExamCreate').change(function() {
                    if ($(this).is(':checked')) {
                        $('.exam-section').show(); // Show the section if checked
                    } else {
                        $('.exam-section').hide(); // Hide the section if unchecked
                    }
                });

                // --- Function to Collect Course Data from Selections ---
                const $courseLessonsList = $('#courseLessonsList');


                // Toggle chapter expansion
                $courseLessonsList.on('click', '.chapter-header', chapterHeaderToggle);
                $(document).on('click change', '.lesson-name', selectedVideo);

                // Handle lesson item click (simulated active lesson)
                $courseLessonsList.on('click', '.lesson-item', function() {
                    // Remove active class from all lessons first
                    $('.lesson-item').removeClass('active');
                    // Add active class to the clicked lesson
                    $(this).addClass('active');

                });

                // This could be calculated based on completed lessons in a real app
                const overallProgress = 67; // Hardcoded for this example
                $('.student-profile-card .progress-bar').css('width', `${overallProgress}%`);
            });

            function selectChapter(selectedVal = null) {
                let chapterSelect = $('#chapter');
                const lessonContainer = $('.lessonSelectBox');

                $.get('/api/get-chapter', function(data){
                    chapterSelect.empty();
                    chapterSelect.select2({
                        data: data,
                        placeholder: "Select Chapter",
                        allowClear: true,
                        width: '100%',
                    }).val(selectedVal).trigger('change');

                    chapterSelect.on('change').on('change', function () {
                        const selectedChapters = $(this).val(); // array of selected chapter IDs
                        lessonContainer.empty(); // Clear previous selections

                        if (selectedChapters && selectedChapters.length) {
                            selectedChapters.forEach((chapterId) => {
                                const chapter = data.find(c => c.id == chapterId);
                                const chapterTitle = chapter ? chapter.text : 'Unnamed Chapter';

                                const lessonSelectHTML = `
                                    <div class="mb-3">
                                        <label class="form-label"><strong>${chapterTitle}</strong></label>
                                        <select name="lessons[${chapterId}][]" id="lesson_${chapterId}" class="form-control lesson" multiple></select>
                                    </div>
                                `;

                                const wrapper = $(lessonSelectHTML);
                                selectLesson('#lesson_' + chapterId);


                                lessonContainer.append(wrapper);
                            });
                        }
                    });
                });
            }

            function selectLesson(lessonId, selectedVal = null) {

                $.get('/api/get-lesson', function(data){
                   $(`${lessonId}`).empty();
                    $(`${lessonId}`).select2({
                        data: data,
                        placeholder: "Select Lesson",
                        allowClear: true,
                        width: '100%',
                    }).val(selectedVal).trigger('change');
                });


            }
            function selectExam(selectedVal = null) {
                let examSelect = $('#exam');

                $.get('/api/get-exam', function(data){
                    examSelect.empty();
                    examSelect.select2({
                        data: data,
                        placeholder: "Select Exam",
                        allowClear: true,
                        width: '100%',
                    }).val(selectedVal).trigger('change');
                });
            }

            function updateButtons() {
                if (currentStep === 1) {
                    $(".cancel").removeClass("d-none"); // Show "Cancel"
                    $(".prev-step").addClass("d-none"); // Hide "Back"
                } else {
                    $(".cancel").addClass("d-none"); // Hide "Cancel"
                    $(".prev-step").removeClass("d-none"); // Show "Back"
                }

                if (currentStep === totalSteps) {
                    $(".new-course").removeClass("d-none"); // show "Next" on last step
                    $(".next-step").addClass("d-none"); // Hide "Next" on last step
                    $(".save-course").removeClass("d-none"); // Show "Save"
                } else {
                    $(".new-course").addClass("d-none"); // Hide "Next" on last step
                    $(".next-step").removeClass("d-none"); // Show "Next"
                    $(".save-course").addClass("d-none"); // Hide "Save" before last step
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


                updateButtons(); // Ensure button visibility updates

                if (step === 1) {
                    $('.step-title').text('Step 1 : Select Audience, Subject, Course Title and Description.');

                } else if (step === 2) {
                    $('.step-title').text('Step 2 : Add New Chapter or Add from existing Chapters');
                } else if (step === 3) {
                    $('.step-title').text('Step 3 : Add from existing lessons');
                    updateStep3Content();
                } else if (step === 4) {
                    renderCourseContent();

                    $('.step-title').text('Step 4 :  Publish and Preview');
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
                let context = $("#context .ql-editor").html();
                let mcq_course = $("#mcq_course .ql-editor").text();

                $('#course-container').html(
                    `
                        <p>${context}</p>
                        <div>
                            <p><strong>Course:</strong></p>
                            <p style="padding:0">${$("#mcq_course .ql-editor").html()}</p>
                        </div>
                    `
                );
                let optionsHtml = ``;

                let correctAnswer = $('#courseCorrectAnswer').val(); // Get the correct answer from the hidden input


                $("#option-container .option-block .parent-editor").each(function(index) {
                    let optionText = $(this).find(".ql-editor").html(); // Get raw HTML content
                    let optionPlainText = $(this).find(".ql-editor").text();
                    let isCorrect = (optionPlainText == correctAnswer); // Compare with correct answer

                    optionsHtml += `
                        <div class="form-check col-md-6 row" style="margin-left:3px">
                            <label class="radio-container col-md-12" style="padding-top:2px" for="option-${index}">
                                <input class="form-check-input" type="radio" name="mcq_options" value="${optionText}" id="option-${index}" style="margin-top: 0px;display: inline-block; visibility: visible;" ${isCorrect ? 'checked' : ''}>
                                ${optionText}
                            </label>
                        </div>
                    `;
                });

                $('#show-options').html(optionsHtml);
            }

            function store(e){
                e.preventDefault();

                const submitButton = $('button[type="submit"]');
                submitButton.text('Processing').prop('disabled', true);

                // Create a real FormData object to handle file uploads
                let formData = new FormData();

                // Append normal fields
                formData.append('audience', $('input[name="audience"]:checked').val());
                formData.append('title', $('input[name="title"]').val());
                formData.append('description', $('textarea[name="description"]').val());
                formData.append('exam', $('#exam').val());
                formData.append('total_duration', $('#total-duration').data('duration'));
                formData.append('total_chapter', $('#total-chapters').data('chapter'));
                formData.append('total_lesson', $('#total-lessons').data('lesson'));
                formData.append('exam_checked', $('input[name="isExamCreate"]:checked').val());

                let courseType = $('input[name="course_type"]:checked').val() || $('input[name="subjects"]:checked').val();
                formData.append('sat_course_type', courseType);

                // Append thumbnail file (if selected)
                let thumbnail = $('#thumbnail')[0].files[0];
                if (thumbnail) {
                    formData.append('thumbnail', thumbnail);
                }

                // Append chapters
                let chapters = $('#chapter').val() || [];
                chapters.forEach((chapterId, index) => {
                    formData.append(`chapters[${index}]`, chapterId);

                    // Append lessons for each chapter
                    const selectedLessons = $(`select[name="lessons[${chapterId}][]"]`).val() || [];
                    selectedLessons.forEach((lessonId, lessonIndex) => {
                        formData.append(`lessons[${chapterId}][${lessonIndex}]`, lessonId);
                    });
                });


                $.ajax({
                    url: '/api/course',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire("Success", response.message, "success");
                            $('#courseModal').find('input[type="radio"]').prop('checked', false);
                            $('#option-container').empty();
                            $('.step').addClass('d-none').filter('.step-1').removeClass('d-none');
                            $('.step-circle').removeClass('active').first().addClass('active');
                            $('.course-modal-heading').text('Create Course');
                            $('.close').trigger('click');
                            fetchCourses(1, $('#rowsPerPage').val());

                            let courseId = $(this).data('id');
                            let dynamicModalId = $('#courseModal').attr('dynamic-id', 1);

                            if (dynamicModalId != courseId) {
                                if (currentStep > 1) {
                                    let stepIndex = currentStep;
                                    let stepBackInterval = setInterval(function() {
                                        if (stepIndex > 1) {
                                            stepIndex--;
                                            showStep(stepIndex);
                                        } else {
                                            clearInterval(stepBackInterval);
                                            currentStep = 1;
                                            showStep(currentStep);
                                        }
                                    }, 5);
                                }

                                if (currentStep === 1) {
                                    $(".cancel").removeClass("d-none");
                                    $(".prev-step").addClass("d-none");
                                } else {
                                    $(".cancel").addClass("d-none");
                                    $(".prev-step").removeClass("d-none");
                                }

                                $('#courseModal').attr('dynamic-id', courseId);
                                resetModalData();
                            }
                        } else {
                            Swal.fire("Error", "Failed to created successfully!", "error");
                            checkbox.prop('checked', !checkbox.is(':checked'));
                        }
                        // Reset button text and enable it
                        submitButton.text('Save Course').prop('disabled', false);
                    },
                    error: function(error) {
                        // console.log(error.responseJSON.errors);
                        // Reset button text and enable it on error
                        submitButton.text('Save Course').prop('disabled', false);
                        let errors = error.responseJSON.errors;
                        let errorMessage = "";

                        if (errors && typeof errors === 'object') {
                            errorMessage = Object.keys(errors)
                                .map(field => {
                                    return `${field.replace('_', ' ')}: ${errors[field].join(', ')}`;
                                })
                                .join('\n');
                        } else {
                            errorMessage = "An unexpected error occurred.";
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: errorMessage,
                            footer: 'Please correct the errors and try again.'
                        });

                        checkbox.prop('checked', !checkbox.is(':checked'));

                    }
                });
            };

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

            // start datatable code
            // get all courses
            function fetchCourses(page = 1, perPage = 10, sortColumn, sortOrder, sort = 'Latest') {
                let filters = {
                    search: $('.search_input').val() || '', // Search input value, default to empty string if undefined
                    difficulty: $('.difficulty:checked').map((_, el) => el.value).get(), // Get all checked difficulty levels
                    crated_start_at: $('input[name="crated_start_at"]').val() || '', // Start date, default to empty string
                    crated_end_at: $('input[name="crated_end_at"]').val() || '', // End date, default to empty string
                    status: $('input[name="status"]:checked').val() || 'All', // Selected status, default to 'All'
                    audience: $('#all_sat_type_1 .nested-options input:checked').map((_, el) => el.value).get(), // Checked SAT 1 options
                    audienceSat: $('#all_sat_type_2 #allSet2Toggle:checked').map((_, el) => el.value).get(), // Checked SAT 2 options
                    courseSearch: $('.course_search_input').val() || '',
                    created_by: $('.custom-checkbox .created_by:checked').map((_, el) => el.value).get(), // Checked created_by values
                    average_time: {
                        min: $('#min-range').val() || 1, // Minimum time from slider
                        max: $('#max-range').val() || 120 // Maximum time from slider
                    },
                    sort: sort,
                };

                $.ajax({
                    url: "/api/course?page=" + page + "&per_page=" + perPage,
                    type: "GET",
                    data: filters,
                    success: function(response) {

                        let courseList = $('#courseList');
                        let courseNullList = $('#courseNullList');
                        let tableBody = $("#course-table-body");

                        // console.log(response.data.length);


                        if (response.data.length == 0) {
                            courseNullList.removeClass('d-none');
                            courseList.addClass('d-none');
                        } else {
                            courseNullList.addClass('d-none');
                            courseList.removeClass('d-none');
                            tableBody.html("");

                            let rows = '';
                            $.each(response.data, function(index, course) {
                                console.log(course);
                                let statusChecked = course.status ? "checked" : "";

                                // <td><span class="badge badge-pill badge-hard">Hard</span><p class="text-center"><span>9/10</span>(70%)</p></td>
                                rows += `<tr>
                                    <td><input type="checkbox" class="row-checkbox course-row" value="${course.uuid}"></td>
                                    <td>${course.title}</td>
                                    <td>${course.audience}</td>
                                    <td>${course.total_chpater}</td>
                                    <td>${course.total_chapter}</td>
                                    <td>${formatDuration(course.total_duration)}</td>
                                    <td>${formatDate(course.created_at)}</td>

                                    <td class="text-center">
                                         <button data-toggle="modal" data-id="${course.id}" data-target="#courseModal" class="btn edit-btn"><i class="far fa-edit"></i>Edit</button>
                                    </td>
                                </tr>`;
                            });
                            tableBody.html(rows);
                            updatePagination(response, page);
                        }

                    },
                    error: function() {
                        alert("Error fetching courses.");
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
                $('#total-courses').text(`${totalResults} Courses`);

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
            // end datatable code

            function formatDate(dateString) {
                let date = new Date(dateString);
                let options = { day: '2-digit', month: 'short', year: 'numeric' };
                return date.toLocaleDateString('en-GB', options); // "24 Mar 2025"
            }

            function formatDuration(second) {
                // const totalSeconds = Math.round(minutes * 60);
                const hours = Math.floor(second / 3600);
                const remainingSeconds = second % 3600;
                const mins = Math.floor(remainingSeconds / 60);
                const secs = remainingSeconds % 60;

                let result = '';
                if (hours > 0) result += hours + "hr ";
                if (mins > 0) result += mins + "min ";
                if (secs > 0) result += secs + "sec";
                return result.trim();
            }


            function getSelectedCourses() {
                return $(".row-checkbox:checked").map(function () {
                    return $(this).val();
                }).get();
            }

            function destroy() {
                let selectedCourses = getSelectedCourses();
                if (selectedCourses.length === 0) {
                    Swal.fire("Warning", "Please select at least one course.", "warning");
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
                            url: "/api/courses-delete",
                            type: "POST",
                            data: {
                                courses: selectedCourses,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                Swal.fire("Deleted!", "Courses deleted successfully.", "success");
                                fetchCourses(1);
                                $('#active-count').text('')
                                $('#inactive-count').text('')
                            },
                            error: function () {
                                Swal.fire("Error", "Failed to delete courses.", "error");
                            }
                        });
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
                $('#course_id').val('');
                $('#course_title').val('');
                $('#course_description').val('');
                $('#course_text').val('');
                $('#explanation').val('');
                $('#difficulty').val('');
                $('#correct_answer').val('');
                $('#course_type').val('');

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
                let courseId = $(this).data('id');
                let dynamicModalId = $('#courseModal').attr('dynamic-id', 1);

                if (dynamicModalId != courseId) {
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

                    $('#courseModal').attr('dynamic-id', courseId)
                    resetModalData();
                }

                $.get(`/api/courses/${courseId}`, function(response) {
                    $('.course-modal-heading').text('Edit Course');

                    // Set values in the modal
                    $("input[name='audience'][value='" + response.audience + "']").prop('checked', true);

                    if (response.sat_type === 'SAT 2') {
                        $('#sat_type_1').addClass('d-none');
                        $('#sat_type_2').removeClass('d-none');
                        $('#sat_type_1').find('input').prop('checked', false);

                        $("input[name='subjects'][value='" + response.sat_course_type + "']").prop('checked', true);
                    } else if ((response.sat_type === 'SAT 1')) {
                        $('#sat_type_2').addClass('d-none');
                        $('#sat_type_1').removeClass('d-none');
                        $('#sat_type_2').find('input').prop('checked', false);

                        $("input[name='course_type'][value='" + response.sat_course_type + "']").prop('checked', true);
                    }
                    $("input[name='course_status'][value='" + response.status + "']").prop('checked', true);
                    $("input[name='difficulty'][value='" + response.difficulty + "']").prop('checked', true);

                    $('#mcq_course').text();
                    $('#course_id').val(response.id);
                    $('#modalTitle').text('Edit Course'); // Change modal title
                    $('#course_title').val(response.course_title);
                    // $('#course_description').val(response.course_description);
                    // $('#course_text').val(response.course_text);
                    $('#difficulty').val(response.difficulty);
                    $('#course_type').val(response.course_type);
                    // $('#audience').val(response.audience);
                    $('#context .ql-editor').html(response.course_description),
                    $('#mcq_course .ql-editor').html(response.course_text),
                    $('#explanation .ql-editor').html(response.explanation);
                    selectTopic(response.topic_id);

                    // Parse and set options
                    let options = JSON.parse(response.options);
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
                    });


                    $('#courseCorrectAnswer').val(response.correct_answer);
                    $('#courseId').val(response.id);
                    $('#courseModal').modal('show');

                    // $('#audience').val(response.audience);
                    // $('#course_type').val(response.course_type);
                    // $('#course_title').val(response.course_title);

                    // $('#course_description').val(response.course_description);
                });
            }

            function detailModal() {
                var courseid = $(this).data("id"); // Button er data-id theke Student ID pabo

                $.ajax({
                    url: `/api/courses/${courseid}`, // Backend route jekhane data fetch hobe
                    type: "GET",
                    success: function (response) {
                        // Modal er ID update
                        $("#courseCode").text("#" + response.course_code);
                        $("#course_description").html(response.course_description);
                        $("#course_text").html(response.course_text);
                        $("#explanation").html(response.explanation);

                        let options = JSON.parse(response.options);
                        $('#course-options').html('');
                        let optionsHtml = ``;
                        // $('#option-container').html('');
                        options.forEach(function(optionText, index) {

                            let newOptionHtml = `
                                <div class="col-md-6 pl-0">
                                    <div class="form-check mb-2">
                                        <input type="radio" name="subjects" value="${optionText}"
                                            class="form-check-input" id="${optionText}" ${response.correct_answer == optionText ? 'checked' : '' }>
                                        <label class="form-check-label radio-container" for="${optionText}">
                                            ${optionText}
                                        </label>
                                    </div>
                                </div>
                            `;

                            $('#course-options').append(newOptionHtml);
                        });


                        $(".audience").text(response.audience);
                        $(".course-type").text(response.sat_course_type);
                        $(".created-by").text(response.created_by.full_name);
                        $(".created-on").text(moment(response.created_at).format("hh:mm A, D MMM YY"));
                        $(".apperaing-exam").text(response.apperaing_exam ?? 'N/A');
                        $(".total-appearance").text(response.appearance ?? 'N/A');
                        $(".correct-percentage").text(response.correct_percentage ?? 'N/A');
                        $(".average-time").text(response.average_time ?? 'N/A');
                        $(".defficulty-level").text(
                            response.difficulty.charAt(0).toUpperCase() + response.difficulty.slice(1).toLowerCase()
                        );
                        $(".feedbacks").text(response.feedbacks ?? 'N/A');
                        $(".last-updated-by").text(
                            response.updated_by && response.updated_by.full_name ? response.updated_by.full_name : 'N/A'
                        );
                        $(".last-updated-on").text(moment(response.updated_at).format("hh:mm A, D MMM YY"));
                        console.log(response.exams.length);

                        if (response.exams.length == 0) {
                            $("#exam-details").html('<p>No exam details found.</p>');
                            $("#all-appearances").html('<p>No data found.</p>');
                        }else{
                            $("#exam-details").html('');
                            $.each(response.exams, function (indexInArray, valueOfElement) {
                                console.log(valueOfElement);

                                $("#exam-details").append(`
                                <tr class="custom-row">
                                    <td>
                                        <b>${valueOfElement.sections[0].audience}</b>
                                        <br>
                                        <p style="color:#475467; font-size:10px">${valueOfElement.sections[0].section_type}</P>

                                    </td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                `);
                            });

                            $("#all-appearances").html('');
                            $.each(response.exams, function (indexInArray, valueOfElement) {
                                console.log(valueOfElement);

                                $("#all-appearances").append(`
                                <tr class="custom-row">
                                    <td>
                                        <b>${valueOfElement.sections[0].audience}</b>
                                        <br>
                                        <p style="color:#475467; font-size:10px">${valueOfElement.sections[0].section_type}</P>

                                    </td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>${moment(valueOfElement.created_at).format("hh:mm A, D MMM YY")}</td>
                                </tr>
                                `);
                            });
                        }


                        // Modal show
                        $("#detailModalCenter").modal("show");
                    },
                    error: function () {
                        alert("Failed to fetch course details.");
                    },
                });
            }



            // --- Function to Render Course Sections and Lessons ---
            async function renderCourseContent() {
                $('#courseLessonsList').empty(); // Clear existing content

                const courseData = await collectCourseDataFromSelections();
                courseData.forEach((chapter, index) => {
                    let lessonsHtml = '';
                    chapter.lessons.forEach(lesson => {

                        const iconClass = lesson.type === 'Video' ? 'fa-play' : 'fa-file-pdf';
                        const statusHtml = lesson.completed ? '<i class="fas fa-check-circle"></i>' :
                                        (lesson.progress > 0 && lesson.progress < 100 ?
                                            `<div class="progress-bar-tiny"><div style="width: ${lesson.progress}%;"></div></div><span class="progress-percentage-small">${lesson.progress}%</span>` :
                                            ''); // Empty if 0% progress

                        lessonsHtml += `
                            <div class="lesson-item ${lesson.completed ? 'completed' : ''} ${lesson.progress > 0 && !lesson.completed ? 'in-progress' : ''}" data-lesson-id="${lesson.id}">
                                <div class="lesson-item-icon">
                                    <i class="fas ${iconClass}"></i>
                                </div>
                                <div class="lesson-details">
                                    <div class="lesson-name" data-lesson-id="${lesson.id}" data-lesson-path="${lesson.file_path}">${lesson.name}</div>
                                    <div class="lesson-duration">${lesson.duration}</div>
                                </div>
                                <div class="lesson-status">
                                    ${statusHtml}
                                </div>
                            </div>
                        `;
                    });

                    const chapterClass = index === 0 ? 'expanded' : '';
                    const chapterHeaderActiveClass = index === 0 ? 'active' : '';

                    const chapterHtml = `
                        <div class="chapter-section ${chapterClass}" data-chapter-id="${chapter.id}">
                            <div class="chapter-header ${chapterHeaderActiveClass}">
                                <div class="chapter-title">
                                    <i class="fas fa-chevron-right chapter-toggle-icon"></i>
                                    <span>${chapter.title}</span>
                                </div>
                                <div class="chapter-meta">
                                    <span>${chapter.lessonsCount} Lessons</span>
                                    <span>${chapter.duration}</span>
                                </div>
                            </div>
                            <div class="chapter-content" ${index === 0 ? 'style="display: block;"' : ''}>
                                ${lessonsHtml}
                            </div>
                        </div>
                    `;
                    $('#courseLessonsList').append(chapterHtml);
                });

                // Set initial toggle icon rotation for expanded chapters
                $('.chapter-section.expanded .chapter-toggle-icon').css('transform', 'rotate(90deg)');
            }

            async function collectCourseDataFromSelections() {
                const chapterSelect = $('#chapter');
                let chapterOptions = [];

                if (chapterSelect.hasClass('select2-hidden-accessible')) {
                    chapterOptions = chapterSelect.select2('data');
                } else {
                    chapterOptions = chapterSelect.find('option:selected').map(function () {
                        return {
                            id: $(this).val(),
                            text: $(this).text()
                        };
                    }).get();
                }

                const courseData = [];

                for (const chapter of chapterOptions) {
                    const chapterId = chapter.id;
                    const chapterTitle = chapter.text;
                    const lessonSelect = $(`select[name="lessons[${chapterId}][]"]`);
                    const selectedLessonIds = lessonSelect.val() || [];

                    if (selectedLessonIds.length === 0) continue;
                    // Fetch lesson data for the selected lesson IDs
                    const lessonData = await $.get('/api/lessons-by-id', { ids: selectedLessonIds });

                    const lessonObjects = lessonData.map(lesson => ({
                        id: lesson.id,
                        name: lesson.file_name,
                        file_path: lesson.file_path || 'video',
                        type: lesson.file_type || 'video',
                        duration: lesson.total_length || '10m',
                        completed: lesson.completed || false,
                        progress: lesson.progress || 0
                    }));

                    const totalSeconds = lessonObjects.reduce((sum, lesson) => {
                        return sum + timeStringToSeconds(lesson.duration);
                    }, 0);

                    const totalDuration = secondsToTimeString(totalSeconds);

                    courseData.push({
                        id: chapterId,
                        title: chapterTitle,
                        lessonsCount: lessonObjects.length,
                        duration: totalDuration,
                        expanded: true,
                        lessons: lessonObjects
                    });
                }

                const filePath = 'storage/' + courseData[0].lessons[0].file_path;
                const fullUrl = `${appUrl}${filePath}`;

                $('#videoSource').attr('src', fullUrl);
                $('#lesson-player')[0].load();

                const totalChapters = courseData.length;

                // ✅ Total lessons count
                const totalLessons = courseData.reduce((sum, chapter) => sum + chapter.lessons.length, 0);

                // ✅ Total duration in seconds
                const totalCourseSeconds = courseData.reduce((sum, chapter) => {
                    return sum + timeStringToSeconds(chapter.duration);
                }, 0);

                const totalCourseDuration = secondsToTimeString(totalCourseSeconds);
                const $totalChapters = $('#total-chapters');
                const chapterLabel = totalChapters === 1 ? 'Chapter' : 'Chapters';
                $totalChapters.text(`${totalChapters} ${chapterLabel}`).attr('data-chapter', totalChapters);

                const $totalLessons = $('#total-lessons');
                const lessonLabel = totalLessons === 1 ? 'Lesson' : 'Lessons';
                $totalLessons.text(`${totalLessons} ${lessonLabel}`).attr('data-lesson', totalLessons);

                $('#total-duration').text(totalCourseDuration + ' Duration').attr('data-duration', totalCourseSeconds);
                $('#lastAudience').text($('input[name="audience"]:checked').val());
                $('#show_title').text($('input[name="title"]').val());
                $('#show_description').text($('textarea[name="description"]').val());
                return courseData;
            }



            function timeStringToSeconds(timeStr) {
                const [hours, minutes, seconds] = timeStr.split(':').map(Number);
                return hours * 3600 + minutes * 60 + seconds;
            }

            // Converts seconds to "HH:MM:SS"
            function secondsToTimeString(totalSeconds) {
                const hours = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
                const minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
                const seconds = String(totalSeconds % 60).padStart(2, '0');
                return `${hours}:${minutes}:${seconds}`;
            }

            function chapterHeaderToggle() {
                const $header = $(this);
                const $chapterSection = $header.closest('.chapter-section');
                const $chapterContent = $chapterSection.find('.chapter-content');
                const $toggleIcon = $header.find('.chapter-toggle-icon');

                $chapterContent.slideToggle(300, function () {
                    $chapterSection.toggleClass('expanded');

                    if ($chapterSection.hasClass('expanded')) {
                        $toggleIcon.css('transform', 'rotate(90deg)');
                        $header.addClass('active');
                    } else {
                        $toggleIcon.css('transform', 'rotate(0deg)');
                        $header.removeClass('active');
                    }
                });
            }

            function selectedVideo() {
                const $lessonItem = $(this);
                const lessonId = $lessonItem.data('lesson-id');
                const filePath = 'storage/'+$lessonItem.data('lesson-path');

                if (filePath) {
                    const fullUrl = `${appUrl}${filePath}`;
                    $('#videoSource').attr('src', fullUrl);
                    $('#lesson-player')[0].load();
                    const video = $('#lesson-player')[0];
                    video.load();
                    video.play()
                } else {
                    console.error('File path is not available for this lesson.');
                }
            }


        </script>

        {{-- thumbnail upload --}}
        <script>
            $(document).ready(function () {
                $('#thumbnail').on('change', function () {
                    const file = this.files[0];
                    if (file) {
                        const fileSizeMB = file.size / 1024 / 1024;
                        if (fileSizeMB > 10) {
                            alert("File size exceeds 10MB.");
                            this.value = ""; // Clear file input
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function (e) {
                            $('#preview-image').attr('src', e.target.result).removeClass('d-none');
                        }
                        reader.readAsDataURL(file);
                    }
                });

                // Optional drag & drop
                $('#thumbnail-upload-box').on('dragover', function (e) {
                    e.preventDefault();
                    $(this).addClass('border-primary');
                }).on('dragleave drop', function (e) {
                    e.preventDefault();
                    $(this).removeClass('border-primary');
                }).on('drop', function (e) {
                    const droppedFile = e.originalEvent.dataTransfer.files[0];
                    $('#thumbnail')[0].files = e.originalEvent.dataTransfer.files;
                    $('#thumbnail').trigger('change');
                });
            });
        </script>


    @endpush

</x-backend.layouts.master>
