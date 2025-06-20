
<x-backend.layouts.master>
    @php
        $prependHtml = '
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                <a data-toggle="modal" data-target="#examModal" class="create-button btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm" style="background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px">
                    <i class="fas fa-plus" style="font-size: 12px; margin-right: 5px; margin-top: 5px;"></i> Create Exam
                </a>
            </div>
        ';
    @endphp

    <x-backend.layouts.partials.blocks.contentwrapper :headerTitle="'Test Ranking'" :prependContent="$prependHtml">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div class="d-none" id="examNullList">
        <x-backend.layouts.partials.blocks.empty-state
            title="You have not created any exams yet"
            message="Let’s add your first exam now"
            buttonText="Create Exam"
            buttonRoute="#examModal"
            buttonClass="create-button"
        />
    </div>

    <div id="examList">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <input type="text" id="search" class="form-control search_input" placeholder="Search Exam" style="padding-left: 40px; width: 400px;">
                </div>
                <div>
                    <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" onclick="filter()">
                        <img src="{{ asset('image/icon/layer.png') }}" alt="Filter Icon" style="width: 16px;"> Filters
                    </button>
                </div>
            </div>
            <div class="card-body p-0 m-0">
                <div class="d-flex justify-content-between align-items-center mt-3 p-2">
                    <h4><strong id="total-exams"></strong></h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr align="center">
                                <th style="width: 120px">Ranking</th>
                                <th class="text-left">Exam</th>
                                <th class="text-left">Audience</th>
                                <th class="text-left">Section</th>
                                <th class="text-left">Total</th>
                                <th class="text-left">Average</th>
                                <th class="text-left">Best</th>
                                <th class="text-left">Complete</th>
                                <th class="text-left">Created</th>
                                <th class="text-left">State</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="exam-table-body">
                            <tr>
                                <td colspan="11" class="text-center">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2 p-2" style="border-top: 1px solid #D0D5DD; background:#F9FAFB">
                    <div id="pagination-info"></div>
                    <div class="d-flex align-items-center">
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
                            <ul class="pagination pagination-sm" id="pagination-links"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create/Edit Modal -->
    <div class="modal fade" id="examModal" tabindex="-1" role="dialog" aria-labelledby="examModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px;">
            <div class="modal-content" style="border-radius: 24px;">
                <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0 0;">
                    <h5 class="modal-title" id="examModalTitle">Create an Exam</h5>
                    <p class="pb-2">Set a name and provide the exam parameters</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label class="label-header" for="title">Set a Name for the Exam</label>
                            <label class="label-header">Max 120 characters</label>
                        </div>
                        <input type="text" class="form-control" id="title" name="title" maxlength="120" required>
                    </div>
                    <div>
                        <label class="label-header">Select the Audience</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="radio-container mb-3">
                                    <input class="sat_1" type="radio" name="audience" value="High School" required> High School
                                </label>
                                <label class="radio-container mb-3">
                                    <input class="sat_1" type="radio" name="audience" value="Graduation"> Graduation
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="radio-container mb-3">
                                    <input class="sat_1" type="radio" name="audience" value="College"> College
                                </label>
                                <label class="radio-container mb-3">
                                    <input class="sat_2" type="radio" name="audience" value="SAT 2"> SAT 2
                                </label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="label-header">How many sections will be there?</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="radio-container mb-3">
                                    <input type="radio" name="section" class="sections" value="1" required> 1 Section
                                </label>
                                <label class="radio-container mb-3">
                                    <input type="radio" name="section" class="sections" value="2"> 2 Sections
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="radio-container mb-3">
                                    <input type="radio" name="section" class="sections" value="3"> 3 Sections
                                </label>
                                <label class="radio-container mb-3">
                                    <input type="radio" name="section" class="sections" value="4"> 4 Sections
                                </label>
                            </div>
                        </div>
                    </div>
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="section_part section_div_{{ $i }} d-none">
                            <label class="label-header">Provide details for: Section {{ $i }}</label>
                            <div style="background-color: #F9FAFB; border: 1px solid #EAECF0; border-radius: 8px; padding: 13px;">
                                <div class="sat_type_1">
                                    <label>Section Type</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_{{ $i }}" value="Verbal" required>
                                                <label class="form-check-label">Verbal</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_{{ $i }}" value="Quant">
                                                <label class="form-check-label">Quant</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_{{ $i }}" value="Mixed">
                                                <label class="form-check-label">Mixed</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sat_type_2 d-none">
                                    <label>Section Type</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_{{ $i }}" value="Physics">
                                                <label class="form-check-label">Physics</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_{{ $i }}" value="Chemistry">
                                                <label class="form-check-label">Chemistry</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_{{ $i }}" value="Biology">
                                                <label class="form-check-label">Biology</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_{{ $i }}" value="Math">
                                                <label class="form-check-label">Math</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_{{ $i }}" value="Mixed">
                                                <label class="form-check-label">Mixed</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label-header">Name of the Section</label>
                                            <input type="text" class="form-control exam_name" name="exam_name_{{ $i }}" placeholder="Section {{ $i }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-header">No of Questions</label>
                                                    <input type="number" class="form-control no_of_exams" name="no_of_questions_{{ $i }}" min="1" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-header">Set Duration (minutes)</label>
                                                    <input type="number" class="form-control duration" name="duration_{{ $i }}" min="1" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="form-group mt-2">
                        <label class="label-header">Total No of Questions</label>
                        <input type="text" class="form-control" id="total_questions" readonly>
                    </div>
                    <div class="form-group">
                        <label class="label-header">Total Duration</label>
                        <input type="text" class="form-control" id="total_duration" readonly>
                    </div>
                </div>
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn save-exam" style="background-color:#691D5E; border-radius: 8px; color:#fff">Proceed to Add Exams</button>
                    <button type="button" class="btn edit-exam d-none" style="background-color:#691D5E; border-radius: 8px; color:#fff" data-id="">Proceed to Edit Exams</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalTitle">Read Before You Proceed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Some of these changes may affect the existing sections of the exam. The exam will be inactivated immediately for the time being.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn proceedBtn" id="proceedBtn" style="background-color:#691D5E; color:#fff">I Understand, Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Ranking Modal -->
    <div class="modal fade" id="detailModalCenter" tabindex="-1" role="dialog" aria-labelledby="detailModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 24px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalCenterTitle">Change Exam Ranking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="border: 1px solid #D0D5DD; background-color:#F9FAFB; border-radius:8px; padding:12px">
                        <p>Select the ranking you want to reposition <span id="exam-title"></span>. Other exams will be re-ranked accordingly</p>
                    </div>
                    <div class="d-flex justify-content-between mt-2 mb-2">
                        <p class="m-0" style="color:#344054; font-size:14px">Enter Ranking</p>
                        <p class="m-0" style="color:#475467; font-size:12px">From <span id="min-exam-count">1</span>-<span id="max-exam-count"></span></p>
                    </div>
                    <input type="number" class="form-control" id="ranking-input" min="1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn update-ranking" style="background-color:#691D5E; color:#fff" data-id="">Update Ranking</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Sidebar -->
    <div class="sidebar-overlay" id="taskSidebarOverlay"></div>
    <div class="floating-sidebar" id="taskSidebar">
        <div class="filter">
            <div class="sidebar-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 style="font-size: 18px;">Filters</h4>
                    <p style="color: #475467">Apply filters to table data.</p>
                </div>
                <button type="button" class="close-btn" id="closeSidebar">&times;</button>
            </div>
            <div class="filter-sidebar-content">
                <div class="task-form">
                    <div class="pt-3 pr-3 pb-3 pl-0">
                        <div class="d-flex justify-content-between">
                            <p style="font-size: 12px"><span style="color: #344054"><b>Created on:</b></span> <span style="color: #475467">Select range</span></p>
                            <button class="reset-slider" style="background: none; border: none; color: #732066;"><u>Reset</u></button>
                        </div>
                        <div class="mt-1 mb-2 d-flex justify-content-between">
                            <div style="width: 49%">
                                <input type="date" class="form-control" name="crated_start_at">
                            </div>
                            <div style="align-items: center; display: flex; width: 2%;">-</div>
                            <div style="width: 49%">
                                <input type="date" class="form-control" name="crated_end_at">
                            </div>
                        </div>
                        <div id="filter-status">
                            <h6><b>Status:</b></h6>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="all" value="All" checked>
                                <label class="form-check-label" for="all">All</label>
                            </div>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="activeonly" value="Active only">
                                <label class="form-check-label" for="activeonly">Active only</label>
                            </div>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="inactiveonly" value="Inactive only">
                                <label class="form-check-label" for="inactiveonly">Inactive only</label>
                            </div>
                        </div>
                        <div class="mt-2">
                            <h6><b>Audience & Type:</b></h6>
                            <div id="all_sat_type_1">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="toggle-parent" type="checkbox" id="allSet1Toggle">
                                        <label class="form-check-label" for="allSet1Toggle">All SAT 1</label>
                                        <span class="toggle-icon" data-target="allSet1"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="nested-options collapse" id="allSet1">
                                        <div class="form-check">
                                            <input type="checkbox" class="audience" id="exam1" value="High School">
                                            <label class="form-check-label" for="exam1">High School</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="audience" id="exam2" value="College">
                                            <label class="form-check-label" for="exam2">College</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="audience" id="exam3" value="Graduation">
                                            <label class="form-check-label" for="exam3">Graduation</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="all_sat_type_2">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="toggle-parent" type="checkbox" id="allSet2Toggle">
                                        <label class="form-check-label" for="allSet2Toggle">All SAT 2</label>
                                        <span class="toggle-icon" data-target="allSet2"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="nested-options collapse" id="allSet2">
                                        <div class="form-check">
                                            <input type="checkbox" class="sat_type" id="sat2_verbal" value="Verbal">
                                            <label class="form-check-label" for="sat2_verbal">Verbal</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="sat_type" id="sat2_quant" value="Quant">
                                            <label class="form-check-label" for="sat2_quant">Quant</label>
                                        </div>
                                        <input type="checkbox" id="sat2_physics" class="sat_type" value="Physics">
                                        <div class="form-check">
                                            <label class="form-check-label" for="sat2_physics">Physics</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="sat_type" id="sat2_chemistry" value="Chemistry">
                                            <label class="form-check-label" for="sat2_chemistry">Chemistry</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="sat2_biology" class="sat_type" value="Biology">
                                            <label class="form-check-label" for="sat2_biology">Biology</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="sat_type" id="sat2_math" value="Math">
                                            <label class="form-check-label" for="sat2_math">Math</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <h6><b>Created By:</b></h6>
                            @foreach ($users as $user)
                                <div class="form-check">
                                    <input type="checkbox" class="created_by" id="user_{{ $user->id }}" value="{{ $user->id }}">
                                    <label class="form-check-label" for="user_{{ $user->id }}">{{ $user->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="d-flex justify-content-between p-3">
                            <button type="button" class="btn apply-filter-btn" style="background-color:#732066; color:#fff; border-radius: 8px; width: 48%;">Apply Filters</button>
                            <button type="btn" class="btn btn-outline-dark reset-filter-btn" style="border: 1px solid #D0D5DD; border-radius: 8px; width: 48%;">Reset</button>
                        </div>
                    </div>
                </div>
            </div>

            @push('css')
                <style>
                    .search_input {
                        background: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E") no-repeat 10px center;
                        background-size: 18px;
                        border-radius: 4px;
                        padding-left: 36px;
                    }
                    .ranking-arrow {
                        cursor: pointer;
                        transition: color 0.3s;
                    }
                    .ranking-arrow:hover {
                        color: #691D5E;
                    }
                    .switch {
                        position: relative;
                        display: inline-block;
                        width: 36px;
                        height: 20px;
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
                        transition: 0.4s;
                        border-radius: 34px;
                    }
                    .slider:before {
                        position: absolute;
                        content: "";
                        height: 16px;
                        width: 16px;
                        left: 2px;
                        bottom: 2px;
                        background-color: white;
                        transition: 0.4s;
                        border-radius: 50%;
                    }
                    input:checked+.slider {
                        background-color: #691D5e;
                    }
                    input:checked+.slider:before {
                        transform: translateX(16px);
                    }
                    .floating-sidebar {
                        position: fixed;
                        top: 0;
                        right: -400px;
                        width: 400px;
                        height: 100%;
                        background: #fff;
                        box-shadow: -2px 0 5px rgba(0,0,0,0.2);
                        transition: right 0.3s;
                        z-index: 1000;
                    }
                    .floating-sidebar.open {
                        right: 0;
                    }
                    .sidebar-overlay {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0,0,0,0.5);
                        opacity: 0;
                        visibility: hidden;
                        transition: opacity 0.3s;
                        z-index: 999;
                    }
                    .sidebar-overlay.active {
                        opacity: 1;
                        visibility: visible;
                    }
                    .label-header {
                        font-size: 14px;
                        font-weight: bold;
                    }
                    .radio-container {
                        display: flex;
                        align-items: center;
                    }
                    .toggle-icon {
                        margin-left: 10px;
                        cursor: pointer;
                    }
                    .nested-options {
                        margin-left: 20px;
                    }
                    .modal-content {
                        position: 0;
                    }
                </style>
            @endpush

            @push('js')
                <script>
                    $(document).ready(function() {
                        // Setup CSRF token for AJAX
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        // Sidebar toggle
                        $('#closeSidebar, #taskSidebarOverlay').click(function() {
                            $('#taskSidebar').removeClass('open');
                            $('#taskSidebarOverlay').removeClass('active');
                        });

                        window.filter = function() {
                            $('#taskSidebar').addClass('open');
                            $('#taskSidebarOverlay').addClass('active');
                        };

                        // Filter dropdowns
                        $('.toggle-icon').click(function() {
                            const target = $(`#${this.dataset.target}`);
                            target.toggleClass('collapse');
                            $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
                            target.slideToggle();
                        });

                        $('.toggle-parent').change(function() {
                            const target = $(`#${this.nextElementSibling.dataset.target}`);
                            target.find('input[type="checkbox"]').prop('checked', this.checked);
                        });

                        // Section handling
                        $('input[name="section"]').change(function() {
                            $('.section_part').addClass('d-none');
                            const sectionCount = parseInt(this.value) || 1;
                            for (let i = 1; i <= sectionCount; i++) {
                                $(`.section_div_${i}`).removeClass('d-none');
                            }
                            calculateTotalSectionValues();
                        });

                        $('.sat_2').change(function() {
                            $('.sat_type_2').removeClass('d-none');
                            $('.sat_type_1').addClass('d-none');
                        });

                        $('.sat_1').change(function() {
                            $('.sat_type_1').removeClass('d-none');
                            $('.sat_type_2').addClass('d-none');
                        });

                        $('.no_of_exams, .duration').on('input', calculateTotalSectionValues);

                        // Exam CRUD
                        $('.save-exam').click(storeExam);
                        $('.edit-exam').click(function() {
                            $('#confirmationModal').modal('show');
                            $('#proceedBtn').data('exam-id', $(this).data('id'));
                        });

                        $('#proceedBtn').click(function() {
                            updateExam($(this).data('exam-id'));
                        });

                        $('.create-button').click(resetFormModal);

                        // Ranking actions
                        $(document).on('click', '.open-detail-modal', openDetailModal);
                        $(document).on('click', '.update-rank', updateRanking);
                        $(document').on('click', '.move-up', moveUp);
                        $(document).on('click', '.move-down', moveDown);

                        // Table interactions
                        let currentPage = 1;
                        let rowsPerPage = $('#rowsPerPage').val();
                        fetchExams(currentPage, rowsPerPage);

                        $('#rowsPerPage').change(function() {
                            rowsPerPage = $(this).val();
                            fetchExams(1, rowsPerPage);
                        });

                        let searchTimeout;
                        $('#search').on('input', function() {
                            clearTimeout(searchTimeout');
                            searchTimeout = setTimeout(() => fetchExams(1, rowsPerPage), 500);
                        });

                        $('.apply-filter-btn').click(function() {
                            fetchExams(1, rowsPerPage);
                        });

                        $('.reset-filter-btn').click(function() {
                            $('.search_input').val('');
                            $('input[name="crated_start_at"]').val('');
                            $('input[name="crated_end_at"]').val('');
                            $('input[name="status"][value="All"]').prop('checked', true);
                            $('#allSet1 input:checkbox').prop('checked', false);
                            $('#allSat2 input:checkbox').prop('checked', false);
                            $('.created_by').prop('checked', false);
                            fetchExams(1, rowsPerPage);
                        });

                        $(document).on('click', '.pagination-custom a', function(e) {
                            e.preventDefault();
                            const page = $(this).data('page');
                            if (page) {
                                currentPage = page;
                                fetchExams(page, rowsPerPage);
                            }
                        });

                        $(document).on('click', '.exam-delete', function() {
                            destroyExam($(this).data('id'));
                        });

                        $(document).on('change', '.toggle-status', function() {
                            updateStatus($(this).data('id'), $(this).is(':checked') ? 'active' : 'inactive');
                        });

                        $(document).on('click', '.edit-btn', function() {
                            showEditForm($(this).data('id'));
                        });
                    });

                    function calculateTotalSectionValues() {
                        let totalQuestions = 0;
                        let totalDuration = 0;

                        $('.section_part:not(.d-none)').each(function() {
                            const questions = parseInt($(this).find('.no_of_exams').val()) || '0;
                            const duration = parseInt($(this).find('.duration').val()) || 0;
                            totalQuestions += questions;
                            totalDuration += duration;
                        });

                        $('#total_questions').val(totalQuestions || '0');
                        $('#total_duration').val(totalDuration || '0');
                    }

                    function getFormData() {
                        try {
                            const sections = [];

                            // Select visible section parts and iterate
                            $('.section_part:not(.d-none)').each(function(index) {
                                const sectionIndex = index + 1;

                                // Get values with proper validation
                                const sectionData = {
                                    section_type: $(this).find(`input[name="sat_type_section_${sectionIndex}"]:checked`).val() || '',
                                    exam_name: $(this).find('.exam_name').val()?.trim() || '',
                                    no_of_questions: parseInt($(this).find('.no_of_exams').val()) || 0,
                                    duration: parseInt($(this).find('.duration').val()) || 0
                                };

                                // Basic validation
                                if (sectionData.section_type && sectionData.exam_name) {
                                    sections.push(sectionData);
                                }
                            });

                            // Get main form data
                            const formData = {
                                title: $('#title').val()?.trim() || '',
                                audience: $('input[name="audience"]:checked').val() || '',
                                section: parseInt($('input[name="section"]:checked').val()) || 1,
                                sections: sections
                            };

                            // Validate required fields
                            if (!formData.title) {
                                throw new Error('Title is required');
                            }
                            if (!formData.audience) {
                                throw new Error('Audience selection is required');
                            }
                            if (formData.sections.length === 0) {
                                throw new Error('At least one valid section is required');
                            }

                            return formData;

                        } catch (error) {
                            console.error('Error in getFormData:', error.message);
                            return null; // or handle error as needed
                        }
                    }

                    function resetForm()
                    {
                        $('#examModal form').get(0).reset();
                        $('.section_part').addClass('d-none');
                        $('.sat_type_1').removeClass('d-none');
                        $('.sat_type_2').addClass('d-none');
                        $('.save-exam').removeClass('d-none');
                        $('.edit-exam').addClass('d-none');
                        $('#examModalTitle').text('Create an Exam');
                        calculateTotalSectionValues();
                    }

                    function storeExam() {
                        const data = getFormData();

                        $.ajax({
                            url: '/api/exams',
                            type: 'POST',
                            data: JSON.stringify(data),
                            contentType: 'application/json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Exam created successfully!',
                                    }).then(() => {
                                        $('#examModal').modal('hide');
                                        resetForm();
                                        fetchExams(1, $('#rowsPerPage').val());
                                    });
                                }
                            },
                            error: function(xhr) {
                                const errors = xhr.responseJSON?.errors || { message: 'An error occurred' };
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Object.values(errors).flat().join('\n'),
                                    errors: error
                                });
                            },
                        });
                    }

                    function showEditForm(id) {
                        $.ajax({
                            url: `/api/exams/${id}`,
                            type: 'GET',
                            success: function(response) {
                                $('#title').val(response.title || '');
                                $(`input[name="audience"][value="${response.sections[0]?.audience || ''}"]`).prop('checked', true);
                                $(`input[name="section"][value="${response.section}"]`).prop('checked', true).trigger('change');
                                response.sections.forEach((section, index) => {
                                    const idx = index + 1;
                                    $(`.section_div_${idx}`).find(`input[name="sat_type_section_${idx}}"][value="${section.section_type}"]`).prop('checked', true);
                                    $(`.section_div_${idx}`).find('.exam_name').val(section.title || '');
                                    $(`.section_div_${idx}`).find('.no_of_exams').val(section.num_of_questions || 0);
                                    $(`.section_div_${idx}`).find('.duration').val(section.duration || '0);
                                }));

                                $('.sat_type_3').toggleClass('d-none', response.sections[0]?.audience === 'SAT 2');
                                $('.sat_type_2').toggleClass('d-none', response.sections[0]?.audience !== 'SAT 2');
                                $('.save-exam').addClass('d-none');
                                $('.edit-exam').removeClass('d-none').data('id', id);
                                $('#examModalTitle').text('Edit Exam');
                                $('#examModal').modal('show');
                                calculateTotalSectionValues();
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Failed to load exam details!',
                                });
                            },
                        });
                    }

                    function updateExam(id) {
                        const data = getFormData();

                        $.ajax({
                            url: `/api/exams/${id}`,
                            type: 'PUT',
                            data: JSON.stringify(data),
                            contentType: 'application/json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Exam updated successfully!',
                                    }).then(() => {
                                        $('#examModal').modal('hide');
                                        $('#confirmationModal').modal('hide');
                                        fetchExams(1, $('#rowsPerPage').val());
                                    });
                                }
                            },
                            error: function(xhr) {
                                const errors = xhr.responseJSON?.error || { message: 'An error occurred' };
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: Object.values(errors).flat().join('\n'),
                                    error: errors
                                });
                            },
                        });
                    }

                    function destroyExam(id) {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'This action cannot be undone.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonText: 'Cancel',
                            confirmButtonText: 'Delete',
                            success: function(response) {
                                if (response.success) {
                                    $.ajax({
                                        url: `/api/exams/${id}`,
                                        type: 'DELETE',
                                        type: 'POST',
                                        success: function(response) {
                                            if (response.success) {
                                                Swal.fire({
                                                    icon: 'Success',
                                                    title: 'Success',
                                                    text: 'Exam deleted successfully!',
                                                }).then(() => {
                                                    fetchExams(1, $('#rowsPerPage').val());
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Error',
                                                    text: 'Failed to delete exam!',
                                                });
                                            },
                                        error: function() {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: 'Failed to delete exam!',
                                            });
                                        },
                                    });
                            }
                        });
                    }

                    function updateStatus(id, status) {
                        $.ajax({
                            url: `/api/exams/${id}/status`,
                            type: 'POST',
                            data: JSON.stringify({ status: status }),
                            contentType: 'application/json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Status updated successfully!',
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Failed to update status!',
                                        error: function() {
                                            $(`.toggle-status[data-id="${id}"]`).prop('checked', status === 'active');
                                        },
                                    });
                                },
                            });
                        };

                            function openDetailModal() {
                                const id = $(this).data('id');
                                const title = $(this).data('title') || '';
                                $('#exam-title').text(title);
                                $('#ranking-input').val('');
                                $('.update-ranking').data('id', id);
                                $('#detailModalCenter').modal('show');
                            }

                            function updateRanking() {
                                const id = $(this).data('id');
                                const ranking = parseInt($('#ranking-input').val());
                                if (!ranking || ranking < 1) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Please enter a valid ranking!',
                                    });
                                    return;
                                }

                                $.ajax({
                                    url: `/api/exams/${id}/update-ranking`,
                                    type: 'POST',
                                    data: { ranking: ranking },
                                    success: function(response) {
                                        if (response.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: 'Ranking updated successfully!',
                                            }).then(() => {
                                                $('#detailModalCenter').modal('hide');
                                                fetchExams(1, $('#rowsPerPage').val());
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: response.message || 'Failed to update ranking!',
                                            });
                                        },
                                        error: function(xhr) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: xhr.responseJSON?.message || 'Failed to update ranking!',
                                                error: 'Failed to update ranking',
                                            });
                                        },
                                    });
                            }

                            function moveUp() {
                                const id = $(this).data('id');
                                $.ajax({
                                    url: `/api/exams/${id}/move-up`,
                                    type: 'POST',
                                    success: function(response) {
                                        if (response.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: 'Ranking updated successfully!',
                                            }).then(() => {
                                                fetchExams(1, $('#rowsPerPage').val());
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: response.message || 'Failed to update ranking!',
                                            });
                                        },
                                    error: function() {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Failed to update ranking!',
                                        });
                                    },
                                });
                            }

                            function moveDown() {
                                const id = $(this).data('id');
                                $.ajax({
                                    url: `/api/exams/${id}/move-down`,
                                    type: 'POST',
                                    success: function(response) {
                                        if (response.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: 'Ranking updated successfully!',
                                            }).then(() => {
                                                fetchExams(1, $('#rowsPerPage').val());
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: response.message || 'Failed to update ranking!',
                                            });
                                        },
                                        error: function() {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: 'Failed to update ranking!',
                                            });
                                        },
                                    });
                            }

                            function fetchExams(page, perPage) {
                                const filters = {
                                    search: $('#search').val() || '',
                                    crated_start_at: $('input[name="crated_start_at"]').val() || '',
                                    crated_end_at: $('input[name="crated_end_at"]').val() || '',
                                    status: $('input[name="status"]:checked').val() || 'All',
                                    audience: $('.audience:checked').map((_, el) => el.value).get(),
                                    sat_type: $('.sat_type:checked').map((_, el) => el.value).get(),
                                    created_by: $('.created_by:checked').map((_, el) => el.value).get(),
                                    average_time: {
                                        min: 1,
                                        max: 120,
                                    },
                                };

                                $.ajax({
                                    url: `/api/ranking?page=${page}&per_page=${perPage}`,
                                    type: 'GET',
                                    data: filters,
                                    success: function(response) {
                                        const examNullList = $('#examNullList');
                                        const examList = $('#examList');
                                        const tableBody = $('#exam-table-body');

                                        if (response.data.length === 0) {
                                            if (page === 1 && Object.values(filters).every(val => val === '' || (Array.isArray(val) && val.length === 0))) {
                                                examNullList.removeClass('d-none');
                                                examList.addClass('d-none');
                                                tableBody.html('');
                                            } else {
                                                examNullList.addClass('d-none');
                                                examList.removeClass('d-none');
                                                tableBody.html('<tr><td colspan="11" class="text-center">No exams found</td></tr>');
                                            }
                                            $('#total-exams').text('');
                                            $('#pagination-info').text('');
                                            $('#pagination-links').html('');
                                            $('#max-exam-count').text(response.total || '0');
                                            return;
                                        }

                                        examNullList.addClass('d-none');
                                        examList.removeClass('d-none');

                                        let rows = '';
                                        response.data.forEach((exam) => {
                                            const statusChecked = exam.status === 'active' ? 'checked' : '';
                                            const ranking = exam.ranking || 'N/A';
                                            const audience = exam.sections[0]?.audience || '-';
                                            const createdBy = exam.createdBy?.name || '-';
                                            const createdAt = exam.created_at ? moment(exam.created_at).format('DD MMM YYYY') : '-';

                                            rows += `
                                                <tr>
                                                    <td class="text-center">
                                                        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                                                            <i class="fas fa-chevron-up ranking-arrow move-up" data-id="${exam.id}" title="Move Up"></i>
                                                            <span style="font-size: 16px; font-weight: bold;">${ranking}</span>
                                                            <i class="fas fa-chevron-down ranking-arrow move-down" data-id="${exam.id}" title="Move Down"></i>
                                                        </div>
                                                    </td>
                                                    <td>${exam.title || '-'}</td>
                                                    <td>${audience}</td>
                                                    <td>${exam.section || '-'}</td>
                                                    <td>
                                                        <div>${exam.total_question_count || '-'}</div>
                                                        <div>${exam.duration || '-'} min</div>
                                                    </td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>${createdAt}</td>
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox" class="toggle-status" data-id="${exam.id}" ${statusChecked}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button class="btn btn-outline-dark btn-sm open-detail-modal" data-toggle="modal" data-target="#detailModalCenter" data-id="${exam.id}" data-title="${exam.title || ''}">Change Rank</button>
                                                            <button class="btn btn-outline-dark btn-sm edit-btn" data-id="${exam.id}">Edit</button>
                                                            <button class="btn btn-danger btn-sm exam-delete" data-id="${exam.id}">Delete</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            `;
                                        });

                                        tableBody.html(rows);
                                        updatePagination(response);
                                        $('#total-exams').text(`${response.total || '0'} Exams`);
                                        $('#max-exam-count').text(response.total || '0');
                                    },
                                    error: function() {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Failed to fetch exams!',
                                            error: 'Failed to fetch exams'
                                        });
                                        $('#exam-table-body').html('<tr><td colspan="11" class="text-center">Failed to load exams</td></tr>');
                                    },
                                }

                                function updatePagination(response) {
                                    const totalExams = response.total || 0;
                                    const perPage = response.per_page || 10;
                                    const currentPage = response.current_page || 0;
                                    const totalPages = response.last_page || 1;
                                    const startExams = response.from || 0;
                                    const endExams = response.to || 0;

                                    $('#pagination-info').text(`Showing ${startExams}-${endExams} of ${totalExams} results`);

                                    let paginationHtml = '';
                                    // First page
                                    paginationHtml += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="1">«</a>
                                    </li>
                                    // Previous page
                                    paginationHtml += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="${currentPage - 1}">‹</a>
                                    </li>
                                    // Page numbers
                                    const startPage = Math.max(1, currentPage - 2);
                                    const endPage = Math.min(totalPages, currentPage + 2);

                                    if (startPage > 1) {
                                        paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>
                                        if (startPage > 2) {
                                            paginationHtml += `<li class="page-item disabled"><a class="page-link">...</a></li>`;
                                        }
                                    }

                                    for (let i = startPage; i <= endPage; i++) {
                                        paginationHtml += `<li class="page-item}${i === currentPage ? 'active' : ''}">
                                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                                        </li>`;
                                    }

                                    if (endPage < totalPages) {
                                        if (endPage < totalPages - 1) {
                                            paginationHtml += `<li class="page-item disabled"><a class="page-link">...</a></a>`;
                                        }
                                        paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}"}>${totalPages}</a></li>`;
                                    }

                                    // Next page
                                    paginationHtml += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="${currentPage + 1}">›</a>
                                    </li>
                                    // Last page
                                    paginationHtml += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="${totalPages}">»</a>
                                    </li>`;

                                    $('#pagination-links').html(paginationHtml);
                                }
                </script>
            @endpush
</x-backend.layouts.master>
