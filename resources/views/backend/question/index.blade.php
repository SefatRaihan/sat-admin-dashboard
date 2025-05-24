<x-backend.layouts.master>
    @php
        $prependHtml = '
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                 <a  href="/questions/upload" data-toggle="modal" data-target="#uploadQuestion" class="btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 btn-sm" style="padding: 5px 15px; border:2px solid #D0D5DD; border-radius:10px; background-color: #FFFFFF; color:#344054; font-size: 12px">
                    <i class="fa-solid fa-cloud-arrow-up mt-1 pr-1"></i> Upload Question
                </a>

            </div>
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                <a href=\'/questions/create\' data-toggle=\'modal\' data-target=\'#questionModal\' class=\'btn d-flex btn-link create-btn btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                    <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Add Question
                </a>
            </div>
        ';
    @endphp

    <x-backend.layouts.partials.blocks.contentwrapper :headerTitle="'All Questions'" :prependContent="$prependHtml">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div class="d-none" id="questionNullList">
        <x-backend.layouts.partials.blocks.empty-state
            title="You have not created any Question yet"
            message="Let’s create a new question"
            buttonText="Add Question"
            buttonRoute="#questionModal"
        />
    </div>

    <section>
        <div id="questionList">
            <div class="card"
                style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <div>
                        <input type="text" id="search" class="form-control search_input" placeholder="Search Questions" style="padding-left: 40px">
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
                        <h4><strong id="total-questions"></strong></h4>
                        <div class="delete-btn d-none">
                            <button class="btn"><img src="{{ asset('image/icon/download.png') }}"
                                    alt=""></button>
                            <button class="btn text-danger question-delete"><i class="fas fa-trash-alt"></i></button>
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
                                    <th data-order="asc" data-name="Question" data-column="question" class="sortable text-center">Question</th>
                                    <th data-order="asc" data-name="Audience" data-column="audience" class="sortable text-center">Audience</th>
                                    <th data-order="asc" data-name="Question Type" data-column="question_type" class="sortable text-center">Q. Type</th>
                                    <th data-order="asc" data-name="Exam" data-column="exam" class="sortable text-center">Exam</th>
                                    <th data-order="asc" data-name="Difficulty" data-column="difficulty" class="sortable text-center">Difficulty</th>
                                    <th data-order="asc" data-name="AVGTime" data-column="avg_time" class="sortable text-center">Avg. Time</th>
                                    <th data-order="asc" data-name="Created" data-column="created_at" class="sortable text-center">Created</th>
                                    <th data-order="asc" data-name="State" class="text-center">State</th>
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
                            <div id="filter-status">
                                <div class="d-flex justify-content-between">
                                    <h6><b>Status:</b> Active Only</h6>
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
                                    <input type="text" class="form-control question_search_input w-100 pl-4" placeholder="Search Questions">
                                </div>
                                {{-- <div class="filter-group">
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
                                </div> --}}
                            </div>
                            <div class="mt-2">
                                <div class="d-flex justify-content-between">
                                    <h6><b>Defficulty:</b> All result</h6>
                                </div>
                                <div class="form-check custom-checkbox d-flex justify-center">
                                    <input type="checkbox" class="difficulty" value="Easy">
                                    <label class="form-check-label pl-1"><span
                                            class="badge badge-pill badge-easy"><b>Easy</b></span></label>
                                </div>
                                <div class="form-check custom-checkbox d-flex justify-center">
                                    <input type="checkbox" class="difficulty" value="Medium">
                                    <label class="form-check-label pl-1"><span
                                            class="badge badge-pill badge-medium"><b>Medium</b></span></label>
                                </div>
                                <div class="form-check custom-checkbox d-flex justify-center">
                                    <input type="checkbox" class="defficulty" value="Hard">
                                    <label class="form-check-label pl-1" for="gladiator"><span
                                            class="badge badge-pill badge-hard"><b>Hard</b></span></label>
                                </div>
                                <div class="form-check custom-checkbox d-flex justify-center">
                                    <input type="checkbox" class="difficulty" value="Very Hard">
                                    <label class="form-check-label pl-1" for="gladiator"><span
                                            class="badge badge-pill badge-very-hard"><b>Very Hard</b></span></label>
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
                            <div class="mt-2">
                                <h6><b>Created By:</b></h6>
                                @foreach ($exams as $exam)
                                <div class="form-check custom-checkbox d-flex justify-center">
                                    <input type="checkbox" class="created_by" value="{{ $exam->createdBy->id }}">
                                    <label class="form-check-label pl-1">{{ $exam->createdBy->full_name }}</label>
                                </div>
                                @endforeach
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
    <section>
        <div class="modal fade" id="detailModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="detailModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 60%">
                <div class="modal-content" style="border-radius: 24px; height:100%">
                    <div class="modal-header text-left d-flex pb-3" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                        <h5 class="modal-title" id="exampleModalLongTitle">QuestionID <span id="questionCode">#SID000</span></h5>
                        <button type="button" class="close p-0 m-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
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
                                <div class="tab-pane fade show active" id="question" role="tabpanel" aria-labelledby="question-tab">
                                    <div>
                                        <div id="question-show-card" style="border: 1px solid #D0D5DD; border-radius:8px; padding:10px; background:#F9FAFB">
                                            <span id="question_description"></span>
                                            <p class="mb-0 mt-1">
                                                <strong>Question:</strong>
                                            </p>
                                            <p id="question_text" class="pt-0 mt-0"></p>
                                        </div>
                                        <div class="mt-3">
                                            <h5><strong>Options:</strong></h5>
                                            <div id="question-options" class="row mt-2" style="margin-left: 3px"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="explanation" role="tabpanel" aria-labelledby="explanation-tab">
                                    <div>
                                        <span id="explanation"></span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                                    <h4>Question Details</h4>
                                    <table class="table table-striped custom-table question-details-table" style="border: 1px solid #EAECF0">
                                        <tr>
                                            <td style="width: 25%">Audience</td>
                                            <td class="font-weight-bold audience" style="width: 25%">: </td>

                                            <td style="width: 25%">Question Type</td>
                                            <td class="font-weight-bold question-type" style="width: 25%">: </td>
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
                                                <td>I think this question is not appropriate for the SAT 1 exam. Can you look into it?</td>
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
                            style="border: 1px solid #D0D5DD; border-radius: 8px;" data-toggle="modal" data-target="#questionModal">Edit Question</button>
                        <button type="button" class="btn btn-outline-dark show-modal-close"
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
                        <h4 class="text-center font-weight-bold question-modal-heading">Create a Question</h4>
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
                        <input type="hidden" name="" id="questionCorrectAnswer" value="{{null}}">
                        <input type="hidden" name="" id="questionId" value="{{null}}">
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
                                style="border: 1px solid #D0D5DD; border-radius:8px; padding:10px; background:#F9FAFB; overflow: scroll;">
                            </div>
                            <div class="mt-3">
                                <h5><strong>5. Select the Right Answer</h5>
                            </div>
                            <div id="show-options" class="row mt-2" style="margin-left: 3px"></div>
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
                        <div class="d-flex w-100 justify-content-end align-items-center">
                            <!-- Left side: Placeholder wrapper to maintain spacing -->
                            {{-- <div class="left-placeholder">
                                <button type="button" class="btn new-question d-none">Save & Create Another</button>
                            </div> --}}

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
                <div class="modal-content question-create-section" style="border-radius: 24px; height:100%">
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
                        <button type="button" class="btn save-question"
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
        {{-- <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/datatables_basic.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
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
                    $('#questionModal').find('input[type="radio"]').prop('checked', false);
                    $('#context .ql-editor').html(''),
                    $('#mcq_question .ql-editor').html(''),
                    $('#explanation .ql-editor').html(''),
                    $('#explanation').html('');
                    $('#option-container').empty(); // Clear options
                    $('.step').addClass('d-none').filter('.step-1').removeClass('d-none'); // Reset to step 1
                    $('.step-circle').removeClass('active').first().addClass('active'); // Reset progress
                    $('.question-modal-heading').text('Create New Question');
                    $('#questionId').val(null);

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
                });
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

            $('.show-edit-btn').click(function (e) {
                e.preventDefault();
                $('.show-modal-close').trigger('click');
            });

            $(".feedback-btn").on("click", function() {
                $(".feedback-btn").removeClass("active")
                $(this).addClass("active");
            });

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
                $(document).on('click', '.save-question', store);

                // start datatable code
                let currentPage = 1;
                let perPage = $('#rowsPerPage').val();

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

                $('#sortSelect').on('change', function() {
                    let sortOption = $(this).val();
                    fetchQuestions(1, perPage, sortOption);
                });

                //end datatable code

                $(document).on('change', '.toggle-status', updateState);

                $(document).on("change", ".row-checkbox", function() {
                    $(this).closest("tr").toggleClass("selected", this.checked);
                    updateActiveInactiveCount();
                });

                $(document).on('click', '.question-delete', destroy);

                $("#selectAll").on("change", function() {
                    let isChecked = this.checked;
                    $(".row-checkbox").prop("checked", isChecked).closest("tr").toggleClass("selected",
                        isChecked);
                    updateActiveInactiveCount();
                });

                $(document).on('click', '.edit-btn', show);

                $('.search_input, .multiselect').on('input click', function() {
                    fetchQuestions();
                });

                let searchTimeout;
                $('.search_input').on('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        fetchQuestions(1, $('#rowsPerPage').val());
                    }, 300); // 300ms debounce
                });

                // Apply filters button click
                $('.apply-filter-btn').on('click', function() {
                    fetchQuestions(1, $('#rowsPerPage').val());
                });

                // Reset filters button click
                $('.reset-filter-btn').on('click', function() {
                    // Reset all filter inputs
                    $('.search_input').val('');
                    $('input[name="crated_start_at"]').val('');
                    $('input[name="crated_end_at"]').val('');
                    $('.question_search_input').val('');

                    $('input[name="status"][value="All"]').prop('checked', true);
                    $('.filter-group input:checkbox').prop('checked', false);
                    $('.custom-checkbox input:checkbox').prop('checked', false);
                    $('.multiselect').val([]).trigger('change');


                    // Fetch with reset filters
                    fetchQuestions(1, $('#rowsPerPage').val());
                });

                $(document).on("click", ".openDetailModal", detailModal);
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
                let context = $("#context .ql-editor").html();
                let mcq_question = $("#mcq_question .ql-editor").text();

                $('#question-container').html(
                    `
                        <p>${context}</p>
                        <div>
                            <p><strong>Question:</strong></p>
                            <p style="padding:0">${$("#mcq_question .ql-editor").html()}</p>
                        </div>
                    `
                );
                let optionsHtml = ``;

                let correctAnswer = $('#questionCorrectAnswer').val(); // Get the correct answer from the hidden input


                $("#option-container .option-block .parent-editor").each(function(index) {
                    let optionText = $(this).find(".ql-editor").html(); // Get raw HTML content
                    let optionPlainText = $(this).find(".ql-editor").text();
                    let isCorrect = (optionPlainText == correctAnswer); // Compare with correct answer

                    optionsHtml += `
                        <div class="form-check col-md-6 row" style="margin-left:3px">
                            <label class="radio-container col-md-12" style="padding-top:2px" for="option-${index}">
                                <input class="form-check-input" type="radio" name="mcq_options" value="${optionText}" id="option-${index}" style="display: inline-block; visibility: visible;" ${isCorrect ? 'checked' : ''}>
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

            function store(e){
                e.preventDefault();

                // Get the submit button
                const submitButton = $('button[type="submit"]'); // Adjust selector based on your HTML

                // Change button text to "Processing" and disable it
                submitButton.text('Processing').prop('disabled', true);

                let formData = {
                    audience: $('input[name="audience"]:checked').val(),
                    sat_type: $('input[name="audience"]:checked').val() === 'SAT 2' ? 'SAT 2' : 'SAT 1',
                    sat_question_type: $('input[name="question_type"]:checked').val() || $('input[name="subjects"]:checked').val(),
                    question_title: $('#mcq_question .ql-editor').html(),
                    question_description: $('#context .ql-editor').html(),
                    question_text: $('#mcq_question .ql-editor').html(),
                    question_type: 'MCQ',
                    options: JSON.stringify(getOptions()),
                    correct_answer: $('input[name="mcq_options"]:checked').val(),
                    difficulty: $('input[name="difficulty"]:checked').val(),
                    explanation: $('#explanation .ql-editor').html(),
                    status: $('input[name="question_status"]:checked').val(),
                    questionId: $('#questionId').val(),
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
                            Swal.fire("Success", response.message, "success");
                            $('#questionModal').find('input[type="radio"]').prop('checked', false);
                            $('#context .ql-editor').html('');
                            $('#mcq_question .ql-editor').html('');
                            $('#explanation .ql-editor').html('');
                            $('#explanation').html('');
                            $('#option-container').empty();
                            $('.step').addClass('d-none').filter('.step-1').removeClass('d-none');
                            $('.step-circle').removeClass('active').first().addClass('active');
                            $('.question-modal-heading').text('Create New Question');
                            $('.close').trigger('click');
                            fetchQuestions(1, $('#rowsPerPage').val());

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

                                $('#questionModal').attr('dynamic-id', questionId);
                                resetModalData();
                            }
                        } else {
                            Swal.fire("Error", "Failed to created successfully!", "error");
                            checkbox.prop('checked', !checkbox.is(':checked'));
                        }
                        // Reset button text and enable it
                        submitButton.text('Save Question').prop('disabled', false);
                    },
                    error: function(error) {
                        console.log(error.responseJSON.errors);
                        // Reset button text and enable it on error
                        submitButton.text('Save Question').prop('disabled', false);
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
            // get all questions
            function fetchQuestions(page = 1, perPage = 10, sortColumn, sortOrder, sort = 'Latest') {
                let filters = {
                    search: $('.search_input').val() || '', // Search input value, default to empty string if undefined
                    difficulty: $('.difficulty:checked').map((_, el) => el.value).get(), // Get all checked difficulty levels
                    crated_start_at: $('input[name="crated_start_at"]').val() || '', // Start date, default to empty string
                    crated_end_at: $('input[name="crated_end_at"]').val() || '', // End date, default to empty string
                    status: $('input[name="status"]:checked').val() || 'All', // Selected status, default to 'All'
                    audience: $('#all_sat_type_1 .nested-options input:checked').map((_, el) => el.value).get(), // Checked SAT 1 options
                    audienceSat: $('#all_sat_type_2 #allSet2Toggle:checked').map((_, el) => el.value).get(), // Checked SAT 2 options
                    questionSearch: $('.question_search_input').val() || '',
                    created_by: $('.custom-checkbox .created_by:checked').map((_, el) => el.value).get(), // Checked created_by values
                    average_time: {
                        min: $('#min-range').val() || 1, // Minimum time from slider
                        max: $('#max-range').val() || 120 // Maximum time from slider
                    },
                    sort: sort,
                };

                $.ajax({
                    url: "/api/questions?page=" + page + "&per_page=" + perPage,
                    type: "GET",
                    data: filters,
                    success: function(response) {

                        let questionList = $('#questionList');
                        let questionNullList = $('#questionNullList');
                        let tableBody = $("#question-table-body");

                        console.log(response.data.length);
                        

                        if (response.data.length == 0) {
                            questionNullList.removeClass('d-none');
                            questionList.addClass('d-none');
                        } else {
                            questionNullList.addClass('d-none');
                            questionList.removeClass('d-none');
                            tableBody.html("");

                            let rows = '';
                            $.each(response.data, function(index, question) {
                                let difficultyColor = getDifficultyColor(question.difficulty);
                                let statusChecked = question.status ? "checked" : "";

                                // <td><span class="badge badge-pill badge-hard">Hard</span><p class="text-center"><span>9/10</span>(70%)</p></td>
                                rows += `<tr>
                                    <td><input type="checkbox" class="row-checkbox question-row" value="${question.uuid}"></td>
                                    <td class="openDetailModal text-center" data-toggle="modal" data-target="#detailModalCenter" data-id="${question.id}">${question.question_title}</td>
                                    <td class="openDetailModal text-center" data-toggle="modal" data-target="#detailModalCenter" data-id="${question.id}">${question.audience}</td>
                                    <td class="openDetailModal text-center" data-toggle="modal" data-target="#detailModalCenter" data-id="${question.id}">${question.sat_question_type}</td>
                                    <td class="openDetailModal text-center" data-toggle="modal" data-target="#detailModalCenter" data-id="${question.id}">${question.exam || ''}</td>
                                    <td class="openDetailModal text-center" data-toggle="modal" data-target="#detailModalCenter" data-id="${question.id}"><span class="badge badge-pill ${difficultyColor}">${question.difficulty}</span></td>
                                    <td class="openDetailModal text-center" data-toggle="modal" data-target="#detailModalCenter" data-id="${question.id}">${question.avg_time || '00:00'} min</td>
                                    <td class="openDetailModal text-center" data-toggle="modal" data-target="#detailModalCenter" data-id="${question.id}">${formatDate(question.created_at)} ${question.created_by.full_name}</td>
                                    <td class="text-center">
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-status" data-id="${question.id}" ${question.status === 'active' ? 'checked' : '' }>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                         <button data-toggle="modal" data-id="${question.id}" data-target="#questionModal" class="btn edit-btn"><i class="far fa-edit"></i>Edit</button>
                                    </td>
                                </tr>`;
                            });
                            tableBody.html(rows);
                            updatePagination(response, page);
                        }

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
            // end datatable code

            function formatDate(dateString) {
                let date = new Date(dateString);
                let options = { day: '2-digit', month: 'short', year: 'numeric' };
                return date.toLocaleDateString('en-GB', options); // "24 Mar 2025"
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

            function getSelectedQuestions() {
                return $(".row-checkbox:checked").map(function () {
                    return $(this).val();
                }).get();
            }

            function destroy() {
                let selectedQuestions = getSelectedQuestions();
                if (selectedQuestions.length === 0) {
                    Swal.fire("Warning", "Please select at least one question.", "warning");
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
                            url: "/api/questions-delete",
                            type: "POST",
                            data: {
                                questions: selectedQuestions,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                Swal.fire("Deleted!", "Questions deleted successfully.", "success");
                                fetchQuestions(1);
                                $('#active-count').text('')
                                $('#inactive-count').text('')
                            },
                            error: function () {
                                Swal.fire("Error", "Failed to delete questions.", "error");
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
                    $('.question-modal-heading').text('Edit Question');

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
                    // $('#question_description').val(response.question_description);
                    // $('#question_text').val(response.question_text);
                    $('#difficulty').val(response.difficulty);
                    $('#question_type').val(response.question_type);
                    // $('#audience').val(response.audience);
                    $('#context .ql-editor').html(response.question_description),
                    $('#mcq_question .ql-editor').html(response.question_text),
                    $('#explanation .ql-editor').html(response.explanation);

                    initializeQuill('#context', response.question_description);
                    initializeQuill('#mcq_question', response.question_title);

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
                        initializeQuill(`#option-editor-${index}`);
                    });


                    $('#questionCorrectAnswer').val(response.correct_answer);
                    $('#questionId').val(response.id);
                    $('#questionModal').modal('show');

                    // $('#audience').val(response.audience);
                    // $('#question_type').val(response.question_type);
                    // $('#question_title').val(response.question_title);

                    // $('#question_description').val(response.question_description);
                });
            }

            function detailModal() {
                var questionid = $(this).data("id"); // Button er data-id theke Student ID pabo

                $.ajax({
                    url: `/api/questions/${questionid}`, // Backend route jekhane data fetch hobe
                    type: "GET",
                    success: function (response) {
                        // Modal er ID update
                        $("#questionCode").text("#" + response.question_code);
                        $("#question_description").html(response.question_description);
                        $("#question_text").html(response.question_text);
                        $("#explanation").html(response.explanation);

                        let options = JSON.parse(response.options);
                        $('#question-options').html('');
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

                            $('#question-options').append(newOptionHtml);
                        });


                        $(".audience").text(response.audience);
                        $(".question-type").text(response.sat_question_type);
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
                        alert("Failed to fetch question details.");
                    },
                });
            }
        </script>

        <!-- Resources -->
        <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

        <!-- Chart code -->
        <script>
            am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
            am5themes_Animated.new(root)
            ]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
            var chart = root.container.children.push(am5percent.PieChart.new(root, {
            radius: am5.percent(90),
            innerRadius: am5.percent(50),
            layout: root.horizontalLayout
            }));

            // Create series
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
            var series = chart.series.push(am5percent.PieSeries.new(root, {
            name: "Series",
            valueField: "sales",
            categoryField: "country"
            }));

            // Set data
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
            series.data.setAll([{
            country: "All appearances",
            sales: 501.9
            }, {
            country: "Correct answer",
            sales: 301.9
            }, {
            country: "Wrong answer",
            sales: 201.1
            }, {
            country: "Unanswered",
            sales: 165.8
            }, {
            country: "Feedbacks",
            sales: 139.9
            }]);

            // Disabling labels and ticks
            series.labels.template.set("visible", false);
            series.ticks.template.set("visible", false);

            // Adding gradients
            series.slices.template.set("strokeOpacity", 0);
            series.slices.template.set("fillGradient", am5.RadialGradient.new(root, {
            stops: [{
                brighten: -0.8
            }, {
                brighten: -0.8
            }, {
                brighten: -0.5
            }, {
                brighten: 0
            }, {
                brighten: -0.5
            }]
            }));

            // Create legend
            // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
            var legend = chart.children.push(am5.Legend.new(root, {
            centerY: am5.percent(50),
            y: am5.percent(50),
            layout: root.verticalLayout
            }));
            // set value labels align to right
            legend.valueLabels.template.setAll({ textAlign: "right" })
            // set width and max width of labels
            legend.labels.template.setAll({
            maxWidth: 140,
            width: 140,
            oversizedBehavior: "wrap"
            });

            legend.data.setAll(series.dataItems);


            // Play initial series animation
            // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
            series.appear(1000, 100);

            }); // end am5.ready()
        </script>

        <!-- Resources -->
        <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Responsive.js"></script>

        <!-- Chart code -->
        <script>
            am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("areaChartdiv");

            const myTheme = am5.Theme.new(root);

            myTheme.rule("AxisLabel", ["minor"]).setAll({
            dy:1
            });

            myTheme.rule("AxisLabel").setAll({
            fontSize:"0.9em"
            });


            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
            am5themes_Animated.new(root),
            myTheme,
            am5themes_Responsive.new(root)
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX: true,
            paddingLeft: 0
            }));


            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
            behavior: "none"
            }));
            cursor.lineY.set("visible", false);


            // Generate random data
            var date = new Date();
            date.setHours(0, 0, 0, 0);
            var value = 100;

            function generateData() {
            value = Math.round((Math.random() * 10 - 5) + value);
            am5.time.add(date, "day", 1);
            return {
                date: date.getTime(),
                value: value
            };
            }

            function generateDatas(count) {
            var data = [];
            for (var i = 0; i < count; ++i) {
                data.push(generateData());
            }
            return data;
            }


            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
            maxDeviation: 0.2,
            baseInterval: {
                timeUnit: "day",
                count: 1
            },
            renderer: am5xy.AxisRendererX.new(root, {
                minorGridEnabled: true,
                minorLabelsEnabled: true
            }),
            tooltip: am5.Tooltip.new(root, {})
            }));

            xAxis.set("minorDateFormats", {
            "day":"dd",
            "month":"MMM"
            });

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, {
                pan: "zoom"
            })
            }));


            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var series = chart.series.push(am5xy.LineSeries.new(root, {
            name: "Series",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "value",
            valueXField: "date",
            tooltip: am5.Tooltip.new(root, {
                labelText: "{valueY}"
            })
            }));

            series.bullets.push(function() {
            var graphics = am5.Circle.new(root, {
                radius: 4,
                interactive: true,
                cursorOverStyle: "ns-resize",
                stroke: series.get("stroke"),
                fill: am5.color(0xffffff)
            });

            return am5.Bullet.new(root, {
                sprite: graphics
            });
            });

            // Add scrollbar
            // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
            chart.set("scrollbarX", am5.Scrollbar.new(root, {
            orientation: "horizontal"
            }));

            // manipulating with mouse code
            var isDown = false;

            // register down
            chart.plotContainer.events.on("pointerdown", function() {
            isDown = true;
            })
            // register up
            chart.plotContainer.events.on("globalpointerup", function() {
            isDown = false;
            })

            chart.plotContainer.events.on("globalpointermove", function(e) {
            // if pointer is down
            if (isDown) {
                // get tooltip data item
                var tooltipDataItem = series.get("tooltipDataItem");
                if (tooltipDataItem) {
                if (e.originalEvent) {

                    var position = yAxis.coordinateToPosition(chart.plotContainer.toLocal(e.point).y);
                    var value = yAxis.positionToValue(position);
                    // need to set bot working and original value
                    tooltipDataItem.set("valueY", value);
                    tooltipDataItem.set("valueYWorking", value);
                }
                }
            }
            })

            chart.plotContainer.children.push(am5.Label.new(root, {
            x: am5.p100,
            centerX: am5.p100,
            text: "Click and move mouse anywhere on plot area to change the graph"
            }))

            // Set data
            var data = generateDatas(40);
            series.data.setAll(data);


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear(1000);
            chart.appear(1000, 100);

            }); // end am5.ready()
        </script>
    @endpush

</x-backend.layouts.master>
