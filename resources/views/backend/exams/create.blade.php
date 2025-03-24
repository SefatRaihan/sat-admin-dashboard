<x-backend.layouts.master>
    <x-backend.layouts.partials.blocks.contentwrapper
        :headerTitle="'
            <a href=\'\roles\' class=\'text-dark\'>
                <i class=\'fa-solid fa-angle-left mr-2\'></i> Create Exam : Add Question to Section <span class=\'section_order\'></span>
            </a>

            <div class=\'heading-summary\'>
                <ul class=\'pl-4 m-0\'>
                    <li id=\'audience\' style=\'list-style: none\'>Hi School</li>
                    <li id=\'total-section\'>4 sections</li>
                    <li id=\'total-question\'>40 Questions</li>
                    <li id=\'total-time\'>1h 30m</li>
                </ul>
            </div>
        '"
        :prependContent="'

        '">
    </x-backend.layouts.partials.blocks.contentwrapper>
{{-- @dd($exam->sections->sum('num_of_question')) --}}
    <div>
        <div class="row">
            <div class="col-md-9" style="background-color:#fff; padding: 16px; padding-left: 45px !important; border-bottom:1px solid #EAECF0">
                <div class="d-flex justify-content-between">
                    <div>
                        <input type="text" id="search" class="form-control search_input" placeholder="Search Question" style="padding-left: 35px">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" onclick="filter(this)"><img src="{{ asset('image/icon/layer.png') }}" alt=""> Filters</button>
                        <div class="form-group mb-0">
                            <select class="form-control multiselect" multiple="multiple" data-fouc>
                                <option value="All">All</option>
                                <option value="Unread">Unread</option>
                                <option value="Audience">Audience</option>
                                <option data-role="divider"></option>
                                <option value="Latest">Latest</option>
                                <option value="Oldest">Oldest</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="background-color: #F2F4F7">
                <div class="d-flex justify-content-between pt-1">
                    <div>
                        <ul class="p-0" style="display: flex; gap:20px">
                            <li id="section_type" style="list-style: none">N/A</li>
                            <li id="section_duration">00 min</li>
                        </ul>
                    </div>
                    <div>
                        <button class="btn p-0 clear-exam-section" id="clear-all" style="font-size: 12px"><u>Clear All</u></button>
                    </div>
                </div>
                <h6><b>Section <span class="section_order"></span>: Extreme Section</b></h6>
            </div>
        </div>
        <div class="row h-100">
            <div class="col-md-9" style="height: 82vh; background-color:#fff; border-right:1px solid #D0D5DD; padding-left:50px; overflow-y: auto;">
                <h5 style="color: #101828; font-size:16px"><span id="totalQuestion">0</span> Questions</h5>
                <div class="row" id="question-container" style="height:100%"></div>
            </div>
            <div class="col-md-3 p-0 m-0" style="background-color:#fff; height: 82vh; position: relative;">
                <div class="exam-question-summary p-2" style="overflow-y: auto; height: calc(80vh - 60px);">
                    <div class="d-flex justify-content-between">
                        <p style="color: #333333; font-size:14px"><b>Total : <span class="exam-question-count">0</span>/<span class="section-total-question">20</span> </b></p>
                        <div>
                            @for ($i = 0; $i < $exam->section; $i++)
                            <span class="badge badge-flat badge-pill border-secondary text-secondary-600"><span class="dot"></span> 0{{++$i}}</span>
                            @endfor
                        </div>
                    </div>
                    <div id="exam-section" class="row exam-question-section" style="padding: 8px; height:100%"></div>
                </div>

                <!-- Fixed Footer Button -->
                <div class="fixed-footer d-flex justify-content-center" style="border-top: 1px solid #D0D5DD; padding: 10px">
                    <button type="button" class="btn btn-sm btn-block next-step" style="background:#691D5E; color: #EAECF0; border-radius: 8px; font-size:1rem">
                        Save Changes & Continue <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="publishExamModal" tabindex="-1" aria-labelledby="publishExamLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Save and make Active?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            This exam is currently inactive for the students. Do you want to make any changes?
            <div class="mt-3">
                <div class="form-check">
                <input class="form-check-input" type="radio" name="publishStatus" id="makeActive" value="active" checked>
                <label class="form-check-label" for="makeActive">Make it Active</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="publishStatus" id="keepInactive" value="inactive">
                <label class="form-check-label" for="keepInactive">Keep Inactive for now</label>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px;">Cancel</button>
                <button type="button" class="btn btn-primary" id="publishExamBtn" style="background:#691D5E; color:#EAECF0;  border-radius: 8px;">Save & Publish Exam</button>
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
                <button type="button" class="close-btn" id="closeSidebar">&times;</button>
            </div>
            <div class="filter-sidebar-content">
                <div class="task-form">
                    <div class="pt-3 pr-3 pb-3 pl-0">
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
                                            <input class="form-check-input" type="checkbox" id="exam1" value="Hight School: Verbal">
                                            <label class="form-check-label" for="exam1">Hight School :
                                                Verbal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="exam2" value="Hight School: Quant">
                                            <label class="form-check-label" for="exam2">Hight School :
                                                Quant</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="exam3" value="College: Verbal">
                                            <label class="form-check-label" for="exam3">College :
                                                Verbal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="exam3" value="College: Quant">
                                            <label class="form-check-label" for="exam3">College :
                                                Quant</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="exam3" value="Graduate: Verbal">
                                            <label class="form-check-label" for="exam3">Graduate :
                                                Verbal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="exam3" value="Graduate: Quant">
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
                                            <input class="form-check-input" type="checkbox" id="exam1" value="Physics">
                                            <label class="form-check-label" for="exam1">Physics</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="exam2" value="Chemistry">
                                            <label class="form-check-label" for="exam2">Chemistry</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="exam2" value="Math">
                                            <label class="form-check-label" for="exam2">Math</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="exam2" value="Biology">
                                            <label class="form-check-label" for="exam2">Biology</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="d-flex justify-content-between">
                                <h6><b>Exam Appearance:</b> 2 Selected</h6>
                            </div>
                            <div class="mb-1">
                                <input type="text" class="form-control search_input w-100 pl-4"
                                    placeholder="Search Exams">
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
                                <h6><b>Defficulty Level:</b> All Result</h6>
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
                        <div class="mt-4">
                            <div class="slider-container" style="max-width: 100% !important;">
                                <div class="slider-header">
                                    <span>Correct Percentage: All Result</span>
                                </div>
                                <div class="range-slider">
                                    <input type="range" min="1" max="120" value="1"
                                        id="min-range">
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="slider-container" style="max-width: 100% !important;">
                                <div class="slider-header">
                                    <span>Average Time: All Result</span>
                                </div>
                                <div class="range-slider">
                                    <input type="range" min="1" max="120" value="1"
                                        id="min-range">
                                    <input type="range" min="1" max="120" value="120"
                                        id="max-range">
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


    @push('css')
        <style>
            .dot {
                display: inline-block;
                width: 8px;
                height: 8px;
                background-color: #9333ea;
                border-radius: 50%;
            }
            .heading-summary li {
                color: #667085;
                font-size: 14px;
            }
            .heading-summary ul {
                display: flex;
                gap: 25px;
            }
            .content {
                padding: 0px !important;
                margin-top: 6px;
                background-color: #F2F4F7 !important;
            }
            .multiselect-native-select {
                position: relative;
                border: 1px solid #ddd;
                border-radius: 8px;
                min-width: 125px;
            }
            .multiselect.btn {
                padding: 8px .875rem !important;
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
                padding-left: 20px;
            }
            .question-checkbox {
                height: 20px;
                width: 20px;
                border-radius: 6px;
            }
            .question-title {
                font-size: 14px;
                color: #101828;
            }
            .question-card {
                transition: all 0.5s ease;
                cursor: move;
                background-color: transparent !important; /* Ensure parent is transparent */
            }
            /* When dragging, enforce transparency */
            .question-card.dragging {
                background-color: transparent !important;
                opacity: 0.8; /* Optional: slight opacity to indicate dragging */
            }
            .question-card .card {
                background-color: #F2F4F7; /* Default background for card */
                transition: all 0.5s ease;
            }
            .question-card.dragging .card {
                background-color: transparent !important; /* Transparent when dragging */
            }
            .exam-question-section .card {
                border-left: 3px solid #22C55E;
                margin-bottom: 15px;
                width: 100%;
                background-color: #F2F4F7;
                border-radius: 8px;
            }
            .exam-question-section .question-checkbox {
                display: none;
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

        </style>
    @endpush

    @push('js')
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/uploaders/dropzone.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/uploader_dropzone.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/datatables_basic.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_multiselect.js"></script>
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

            // resetButton.addEventListener("click", () => {
            //     minRange.value = 90; // Reset to full range
            //     maxRange.value = 120;
            //     updateSlider();
            // });

            // Ensure initial full length is displayed
            // updateSlider();
        </script>
        <script>
            let exam =  @JSON($exam);
            let totalQuestion =  @JSON($exam->sections->sum('num_of_question'));
            console.log(exam);
            let sections = exam.sections; // Use sections directly from Blade
            let currentSectionIndex = 0


            $(document).ready(function() {

                // Drag and Drop functionality
                let draggedCard = null;

                // Handle drag start
                $(document).on('dragstart', '.question-card', function(e) {
                    draggedCard = this;
                    $(this).addClass('dragging');
                    e.originalEvent.dataTransfer.effectAllowed = 'move';
                });

                // Handle drag end
                $(document).on('dragend', '.question-card', function() {
                    $(this).removeClass('dragging');
                    draggedCard = null;
                });

                // Exam section drag events
                const $examSection = $('#exam-section');

                $examSection.on('dragover', function(e) {
                    e.preventDefault();
                    $(this).addClass('drag-over');
                    e.originalEvent.dataTransfer.dropEffect = 'move';
                });

                $examSection.on('dragleave', function() {
                    $(this).removeClass('drag-over');
                });

                $examSection.on('drop', function(e) {
                    e.preventDefault();
                    $(this).removeClass('drag-over');

                    if (draggedCard) {

                        let totalExamQuestions = $('#exam-section .question-card').length;
                        let totalQuestions = $('.section-total-question').text();

                        $('.exam-question-count').text(totalExamQuestions+1)

                        if (totalQuestions <= totalExamQuestions) {
                            alert(`Total questions limit exceeded! You can add up to ${totalQuestions} questions.`);
                            return;
                        }

                        const $card = $(draggedCard);
                        $card.find('.question-card-header, .question-card-footer').addClass('d-none');

                        // Adjust column width
                        $card.removeClass('col-md-4').addClass('col-md-12');

                        // Add to exam section
                        $(this).append($card);
                    }
                });

                // Question container drag events (for dragging back)
                const $questionContainer = $('#question-container');

                $questionContainer.on('dragover', function(e) {
                    e.preventDefault();
                    $(this).addClass('drag-over');
                    e.originalEvent.dataTransfer.dropEffect = 'move';
                });

                $questionContainer.on('dragleave', function() {
                    $(this).removeClass('drag-over');
                });

                $questionContainer.on('drop', function(e) {
                    e.preventDefault();
                    $(this).removeClass('drag-over');

                    if (draggedCard) {

                        let totalExamQuestions = $('#exam-section .question-card').length;

                        $('.exam-question-count').text(totalExamQuestions-1)

                        const $card = $(draggedCard);
                        // Restore card for question section
                        $card.find('.question-card-header').removeClass('d-none');
                        $card.find('.question-card-footer').removeClass('d-none');
                        $card.removeClass('col-md-12');
                        $card.addClass('col-md-4');

                        // Add back to question container
                        $(this).prepend($card);

                    }
                });

                $('#clear-all').on('click', function() {
                    let $examSection = $('#exam-section');
                    let $questionContainer = $('#question-container');

                    // Move all question cards back to question container
                    $examSection.find('.question-card').each(function() {
                        let $card = $(this);

                        // Restore header and footer
                        $card.find('.question-card-header').removeClass('d-none');
                        $card.find('.question-card-footer').removeClass('d-none');

                        // Restore original column size
                        $card.removeClass('col-md-12').addClass('col-md-4');

                        // Append back to the question container
                        $questionContainer.prepend($card);
                    });

                    // Reset the exam section question count
                    $('.exam-question-count').text(0);
                });

                getQuestionAndSection();
                $(document).on('click', '.next-step', saveQuestions)
            });

            let searchTimeout;
            $('.search_input').on('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    getQuestionAndSection();
                }, 300); // 300ms debounce
            });

            // Apply filters button click
            $('.apply-filter-btn').on('click', function() {
                getQuestionAndSection();
            });

            // Reset filters button click
            $('.reset-filter-btn').on('click', function() {
                // Reset all filter inputs
                $('.search_input').val('');
                $('input[name="crated_start_at"]').val('');
                $('input[name="crated_end_at"]').val('');
                $('input[name="status"][value="All"]').prop('checked', true);
                $('.filter-group input:checkbox').prop('checked', false);
                $('.custom-checkbox input:checkbox').prop('checked', false);
                $('.multiselect').val([]).trigger('change');

                // Fetch with reset filters
                getQuestionAndSection();
            });

            function getQuestionAndSection() {
                if (currentSectionIndex >= sections.length) {
                    Swal.fire("Success", "All sections have been processed!", "success");
                    return;
                }

                let currentSection = sections[currentSectionIndex];
                $('.section-total-question').text(currentSection.num_of_question);
                $('.section_order').text(currentSection.section_order)
                $('#section_duration').text(formatDuration(currentSection.duration))
                $('#section_type').text(currentSection.section_type)
                $('#audience').text(currentSection.audience)
                $('#total-question').text(totalQuestion + ' Questions')
                $('#total-section').text(exam.section + ' Sections')
                $('#total-time').text(formatDuration(exam.duration))

                let filters = {
                    search: $('.search_input').val() || '', // Search input value, default to empty string if undefined
                    difficulty: $('.difficulty:checked').map((_, el) => el.value).get(), // Get all checked difficulty levels
                    crated_start_at: $('input[name="crated_start_at"]').val() || '', // Start date, default to empty string
                    crated_end_at: $('input[name="crated_end_at"]').val() || '', // End date, default to empty string
                    status: $('input[name="status"]:checked').val() || 'All', // Selected status, default to 'All'
                    audience: $('#all_sat_type_1 .nested-options input:checked').map((_, el) => el.value).get(), // Checked SAT 1 options
                    sat_type: $('#all_sat_type_2 .nested-options input:checked').map((_, el) => el.value).get(), // Checked SAT 2 options
                    exam_appearance: $('.filter-group .nested-options input:checked').map((_, el) => el.value).get(), // Checked exam appearance options
                    created_by: $('.custom-checkbox .created_by:checked').map((_, el) => el.value).get(), // Checked created_by values
                    average_time: {
                        min: $('#min-range').val() || 1, // Minimum time from slider
                        max: $('#max-range').val() || 120 // Maximum time from slider
                    },
                    section_type: currentSection.section_type ,
                    audience: currentSection.audience,
                    exam_id: currentSection.exam_id
                };

                console.log(filters);

                $.ajax({
                    type: "GET",
                    url: "/api/exams/questions",
                    data: filters,
                    success: function (response) {
                        console.log(response);

                        $('#question-container').html('');
                        $('#totalQuestion').text(response.data.length);
                        response.data.forEach(element => {
                            let difficultyColor = getDifficultyColor(element.difficulty);
                            let html = `
                                     <div class="col-md-4 p-2 question-card" data-id="${element.id}" draggable="true" style="border-radius:8px; background-color:transparent !important">
                                         <div class="card card-body m-0" style="border-left:3px solid ${difficultyColor}; background-color:#F2F4F7; border-radius:8px">
                                             <input type="hidden" class="question-id" value="${element.id}">
                                             <div class="question-card-header">
                                                 <div class="d-flex justify-content-between">
                                                     <div>
                                                         <ul class="p-0" style="display: flex; gap:20px; color:#475467">
                                                             <li style="list-style: none">${element.audience}</li>
                                                             <li>${element.sat_question_type}</li>
                                                             <li>Details</li>
                                                         </ul>
                                                     </div>
                                                 </div>
                                             </div>
                                             <p class="question-title">${element.question_title}</p>
                                             <div class="question-card-footer">
                                                 <ul class="p-0 m-0" style="display: flex; gap:20px; color:#475467">
                                                     <li style="list-style: none"><u>0 Exams</u></li>
                                                     <li>0%</li>
                                                     <li>0m 0s</li>
                                                 </ul>
                                             </div>
                                         </div>
                                     </div>
                            `;
                            $('#question-container').append(html);
                        });

                    }
                });
            }

            function getDifficultyColor(difficulty) {
                switch (difficulty.toLowerCase()) {
                    case "easy":
                        return "#28a745";
                    case "medium":
                        return "#17a2b8";
                    case "hard":
                        return "#fab905";
                    case "very hard":
                        return "#dc3545";
                    default:
                        return "bg-secondary text-white";
                }
            }

            function formatDuration(minutes) {
                if (minutes >= 60) {
                    let hours = Math.floor(minutes / 60);
                    let remainingMinutes = minutes % 60;
                    return hours + "hr" + (remainingMinutes > 0 ? " " + remainingMinutes + "min" : "");
                }
                return minutes + "min";
            }

            function saveQuestions() {
                let currentSection = sections[currentSectionIndex]; // Get current section
                let questionIds = [];
                $('#exam-section .question-card').each(function (index, value) {
                     let questionId = $(this).data('id');
                     questionIds.push(questionId)

                });

                Swal.fire({
                    title: "Are you sure?",
                    text: `Save questions for ${currentSection.section_type}?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, Save it!",
                }).then((result) => {

                    if (result.isConfirmed) {
                        let postData = {
                            exam_id: exam.id,
                            section_id: currentSection.id,
                            questions: questionIds, // Assuming questions are included in `sections`
                            _token: $('meta[name="csrf-token"]').attr("content"), // For Laravel CSRF protection
                        };

                        // Send data to API
                        $.ajax({
                            url: "/api/exams/exam-section-questions", // Adjust API route
                            type: "POST",
                            data: JSON.stringify(postData),
                            contentType: "application/json",
                            success: function (response) {
                                Swal.fire("Success", `Questions for ${currentSection.section_type} saved!`, "success");

                                // Remove the current section
                                sections.splice(currentSectionIndex, 1);

                                // Clear UI and move to the next section
                                $("#question-container").empty();
                                $(".exam-question-section").empty();
                                // $("#save-section-btn").hide();
                                // $("#section-title").text("");

                                if (sections.length === 0) {
                                    showPublishModal(); // Show modal if all done
                                } else {
                                    getQuestionAndSection(); // Load next section
                                }

                                // getQuestionAndSection(); // Load next section
                            },
                            error: function (error) {
                                Swal.fire("Error", "Failed to save section!", "error");
                            },
                        });
                    }
                });
            }

            function showPublishModal() {
                let modal = new bootstrap.Modal(document.getElementById('publishExamModal'));
                modal.show();

                $('#publishExamBtn').off('click').on('click', function () {
                    let status = $('input[name="publishStatus"]:checked').val();

                    $.ajax({
                        url: `/api/exams/${exam.id}/update-status`,
                        type: "PATCH",
                        data: {
                            status: status
                        },
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        // contentType: 'application/json',
                        success: function () {
                            modal.hide();
                            Swal.fire("Success", "Exam has been published!", "success").then(() => {
                                window.location.href = "/exams"; // Redirect to exams page
                            });

                        },
                        error: function () {
                            Swal.fire("Error", "Failed to publish exam!", "error");
                        }
                    });
                });
            }

        </script>
    @endpush
</x-backend.layouts.master>
