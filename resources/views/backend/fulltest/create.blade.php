<x-backend.layouts.student-master>
    <div>
        <div class="d-flex justify-content-between">
            <div class="exam-tab-section p-2">
                <ul class="nav nav-tabs mb-0" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="exam-all-tab" data-toggle="tab" href="#exam-all" role="tab" aria-controls="exam-all" aria-selected="true">Exam All (<span class="examAll">{{ $allExamCount }}</span>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="unattempted-tab" data-toggle="tab" href="#unattempted" role="tab" aria-controls="unattempted" aria-selected="false">Unattempted (<span class="unattempted">{{ $unattemptedCount }}</span>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="attempted-tab" data-toggle="tab" href="#attempted" role="tab" aria-controls="attempted" aria-selected="false">Attempted (<span class="attempted">{{ $attemptedCount }}</span>)</a>
                        </li>
                </ul>
            </div>
            <div class="d-flex align-items-center">
                <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px; width:150px; height: 44px;" onclick="filter(this)"><img src="{{ asset('image/icon/layer.png') }}" alt=""> Filters</button>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="exam-all" role="tabpanel" aria-labelledby="exam-all-tab">
                <div class="pt-2">
                    <div class="row">
                        @foreach ($exams as $exam)
                        <div class="col-md-3 exam-card">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $exam->title }}</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><i class="fas fa-th-large"></i> Section <span class="card-text-value">{{ $exam->sections->count() }}</span></p>
                                    <p class="card-text"><i class="fas fa-file-alt"></i> Question <span class="card-text-value">{{ $exam->questions->count()  }}</span></p>
                                    <p class="card-text"><i class="fas fa-clock"></i> Duration <span class="card-text-value">{{ $exam->formatted_duration }}</span></p>
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="{{ route('student-exam.open', $exam->id) }}" class="btn btn-start" style="width:{{ $exam->userAttempt && $exam->userAttempt->status ? '50%' : '100%' }}">{{ $exam->userAttempt && $exam->userAttempt->status ? 'Re-take Exam' : 'Start Exam' }}</a>
                                        @if ($exam->userAttempt && $exam->userAttempt?->status)
                                        <button class="btn btn-details" data-toggle="modal" data-exam="{{ $exam->id }}" data-target="#detailsModelCenter">Details</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="unattempted" role="tabpanel" aria-labelledby="unattempted-tab">
                <div class="p-3">
                    <div class="row">
                        @foreach ($unattemptedExams as $exam)
                        <div class="col-md-3 exam-card">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $exam->title }}</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><i class="fas fa-th-large"></i> Section <span class="card-text-value">{{ $exam->sections->count() }}</span></p>
                                    <p class="card-text"><i class="fas fa-file-alt"></i> Question <span class="card-text-value">{{ $exam->questions->count()  }}</span></p>
                                    <p class="card-text"><i class="fas fa-clock"></i> Duration <span class="card-text-value">{{ $exam->formatted_duration }}</span></p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('student-exam.open', $exam->id) }}" class="btn btn-start" style="width:{{ $exam->userAttempt && $exam->userAttempt->status ? '50%' : '100%' }}">{{ $exam->userAttempt && $exam->userAttempt->status ? 'Re-take Exam' : 'Start Exam' }}</a>
                                        @if ($exam->userAttempt && $exam->userAttempt?->status)
                                        <button class="btn btn-details" data-toggle="modal" data-exam="{{ $exam->id }}" data-target="#detailsModelCenter">Details</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="attempted" role="tabpanel" aria-labelledby="attempted-tab">
                <div class="p-3">
                    <div class="row">
                        @foreach ($attemptedExams as $exam)
                        <div class="col-md-3 exam-card">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $exam->title }}</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><i class="fas fa-th-large"></i> Section <span class="card-text-value">{{ $exam->sections->count() }}</span></p>
                                    <p class="card-text"><i class="fas fa-file-alt"></i> Question <span class="card-text-value">{{ $exam->questions->count()  }}</span></p>
                                    <p class="card-text"><i class="fas fa-clock"></i> Duration <span class="card-text-value">{{ $exam->formatted_duration }}</span></p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('student-exam.open', $exam->id) }}" class="btn btn-start" style="width:{{ $exam->userAttempt && $exam->userAttempt->status ? '50%' : '100%' }}">{{ $exam->userAttempt && $exam->userAttempt->status ? 'Re-take Exam' : 'Start Exam' }}</a>
                                        @if ($exam->userAttempt && $exam->userAttempt?->status)
                                        <button class="btn btn-details" data-toggle="modal" data-exam="{{ $exam->id }}" data-target="#detailsModelCenter">Details</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
                <button type="button" class="close-btn" id="closeSidebar">&times;</button>
            </div>
            <div class="filter-sidebar-content">
                <div class="task-form">
                    <div class="pr-3 pb-3 pl-0">
                        <div class="mt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6><b>Exam:</b> <span id="exam-title">All Result</span></h6>
                                <span class="reset-btn" style="display: none; cursor: pointer; color: #101828; text-decoration: underline; font-weight: bold; margin-right: 10px;" onclick="resetExam()">Reset</span>
                            </div>
                            <div id="all_sat_type_1">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="form-check-input toggle-parent" type="checkbox" id="attempted" value="attempted" checked>
                                        <label class="form-check-label" for="attempted">Attempted</label>
                                    </div>
                                </div>
                            </div>
                            <div id="all_sat_type_2">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="form-check-input toggle-parent" type="checkbox" id="unattempted" value="unattempted" checked>
                                        <label class="form-check-label" for="unattempted">Unattempted</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6><b>Section:</b> <span id="section-title">All Result</span></h6>
                                <span class="reset-btn" style="display: none; cursor: pointer; color: #101828; text-decoration: underline; font-weight: bold; margin-right: 10px;" onclick="resetSection()">Reset</span>
                            </div>
                            <div class="mb-1">
                                <input type="text" class="form-control seaction-search search_input w-100 pl-4" placeholder="Section number" id="section-input">
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6><b>Question:</b> <span id="question-title">All Result</span></h6>
                                <span class="reset-btn" style="display: none; cursor: pointer; color: #101828; text-decoration: underline; font-weight: bold; margin-right: 10px;" onclick="resetQuestion()">Reset</span>
                            </div>
                            <div class="mb-1">
                                <input type="text" class="form-control question-search search_input w-100 pl-4" placeholder="Question number" id="question-input">
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="slider-container" style="max-width: 100% !important;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="slider-header">
                                        <span><b>Exam Duration:</b> <span id="range-title">All Result</span></span>
                                    </div>
                                    <span class="reset-btn" style="display: none; cursor: pointer; color: #101828; text-decoration: underline; font-weight: bold; margin-right: 10px;" onclick="resetRange()">Reset</span>
                                </div>
                                <div class="range-slider">
                                    <div class="track-active"></div>
                                    <input type="range" min="1" max="120" value="1" id="min-range">
                                    <input type="range" min="1" max="120" value="120" id="max-range">
                                    <div class="thumb-value" id="min-value">1</div>
                                    <div class="thumb-value" id="max-value">120</div>
                                    {{-- <div class="range-distance">Distance: <span id="distance-value">119</span> minutes</div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top fixed-bottom-buttons">
                <div class="d-flex justify-content-between p-3">
                    <button type="button" class="btn btn-outline-dark reset-filter-btn" style="border: 1px solid #D0D5DD; border-radius: 8px; width:50%">Reset All</button>
                    <button type="button" class="btn apply-filter-btn ml-2" style="background-color:#691D5E ;border-radius: 8px; color:#fff; width:50%">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Exam Detail Modal -->
    <div class="modal fade" id="detailsModelCenter" tabindex="-1" role="dialog" aria-labelledby="detailsModelCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 43%;">
            <div class="modal-content student-create-section" style="border-radius: 24px; height:100%">
                <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                    <h5 class="" id="exampleModalLongTitle"><b>Exam Name</b></h5>
                    <div class="heading-summary d-flex justify-content-center">
                        <ul class="pl-4 m-0">
                            <li id="audience" style="list-style: none"></li>
                            <li id="total-section"></li>
                            <li id="total-question"></li>
                        </ul>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mt-3">
                                <h4 class="text-center score-title">Your score: <span class="scoreValue">0</span></h4>
                                <p class="text-center score-text">Your performance is better than <b><span class="betterPercent">0</span>% of <span class="studentName">Mubhir</span> student</b> who have <br> completed this exam</p>
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <p class="summary-text">Your Percent Correct</p>
                                                    <p class="summary-value"><b id="correct_percent">0%</b></p>
                                                    <p class="summary-description">(<span class="correct-answers">0</span> of <span class="total-questions">3</span>)</p>
                                                </div>

                                                <div class="col-md-12 text-center">
                                                    <p class="summary-text">Your Average Pace</p>
                                                    <p class="summary-value"><b id="avg_pace_time">0:00</b></p>
                                                    <p class="summary-description">(<span class="total-time">0:00</span> total)</p>
                                                </div>

                                                <div class="col-md-12 text-center">
                                                    <p class="summary-text">Others' Average Pace</p>
                                                    <p class="summary-value"><b class="other_avg_time">0:00</b></p>
                                                    <p class="summary-description">(<span class="others-total-time">0:00</span> total)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="list-group">
                                <li class="list-group-item" style="color: #101828">Leaderboard</li>
                                <li class="list-group-item text-center text-muted">No leaderboard data available.</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <main>
                            </main>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-outline-dark" id="cancel" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                    <form method="POST" id="start-exam-form" action="">
                        @csrf
                        <button type="submit" class="btn" style="width: 108px; height: 44px; border-radius: 8px; background: #691D5E; color: #FFFF; padding: 11px .875rem !important;">Start Exam</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            .leaderboard-item.selected {
                background-color: #F1E9F0; /* light blue */
                color: #101828; /* blue text */
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

            .exam-tab-section .nav-tabs {
                border: 1px solid #ddd;
                border-radius: 25px !important;
                display: inline-flex;
                width: auto;
                background-color: #F9FAFB;
                border: 1px solid #EAECF0;
            }

            .exam-tab-section .nav-tabs .nav-link {
                color: #667085;
                font-size: 16px;
                font-weight: 600;
            }

            .exam-tab-section .nav-tabs .nav-link.active {
                color: #fff;
                background-color: #732066;
                border-color: #fff #fff #fff;
                padding: 8px;
                margin-top: 3px;
                margin-left: 3px !important;
                border-radius: 25px !important;
                font-weight: 600;
                font-size: 16px;
                padding-left: 30px;
                padding-right: 30px;
            }

            .exam-tab-section .nav-tabs .nav-link:hover {
                color: #344054;
                border: 1px solid #732066;
                background-color: #FFFFFF;
                padding: 8px;
                margin-top: 3px;
                margin-left: 3px !important;
                border-radius: 25px !important;
                font-weight: 600;
                font-size: 16px;
            }

            /* exam card section */
            .exam-card .card {
                border-radius: 15px;
                border: 1px solid #EAECF0;
                box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
                background-color: #efebff;
            }
            .exam-card .card .card-body {
                background-color: #fff;
                border-radius: 14px;
                padding-top: 14px !important;
            }
            .exam-card .card-title {
                font-size: 18px;
                font-weight: 600;
                margin-bottom: 0px;
                color:#101828;
            }
            .exam-card .card-text {
                font-size: 14px;
                font-weight: 400;
                color: #475467;
                margin-bottom: 10px;
            }
            .exam-card .card-text i {
                color: #A16A99;
                margin-right: 10px;
            }

            .card-text-value{
                color: #475467;
                font-size: 14px;
                font-weight: 600;
            }

            .exam-card .btn-start {
                background-color: #691D5E;
                border: 1px solid #691D5E;
                color: white;
                border: none;
                border-radius: 25px;
                padding: 10px 20px;
                font-weight: bold;
                width: 50%;
                margin-right: 4px;
            }
            .exam-card .btn-details {
                background-color: white;
                color: #6c757d;
                border: 1px solid #ced4da;
                border-radius: 25px;
                padding: 10px 20px;
                font-weight: bold;
                width: 50%;
                margin-left: 4px;
            }
            .exam-card .btn-details:hover {
                background-color: #f8f9fa;
            }

            /* filter section */
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
                height: calc(95vh - 60px - 60px);
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
            .close-btn {
                background: none;
                border: none;
                font-size: 24px;
                cursor: pointer;
            }
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
                height: 30px;
            }

            .range-slider input {
                -webkit-appearance: none;
                width: 100%;
                position: absolute;
                background: transparent;
                pointer-events: none;
                margin: 0;
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
                z-index: 4;
            }

            .track-active {
                position: absolute;
                height: 4px;
                background: #69275C;
                z-index: 1;
                pointer-events: none;
            }

            .thumb-value {
                position: absolute;
                top: 20px;
                font-size: 12px;
                color: #101828;
                z-index: 5;
                transform: translateX(-50%);
            }

            .range-distance {
                position: absolute;
                top: 40px;
                width: 100%;
                text-align: center;
                font-size: 12px;
                color: #101828;
            }

            .slider-labels {
                display: flex;
                background: white;
                justify-content: space-between;
                font-size: 14px;
                margin-top: 8px;
            }

            /* avg time slider end */
            /* filter section end */

            /* Timeline vertical line */

            main {
                counter-reset: section;
                max-width: 500px;
                margin: auto;
                padding-left: 17px;
                position: relative;
            }

            /* vertical line */
            main::before {
                content: "";
                position: absolute;
                left: 16px; /* aligns with circle center */
                top: 40px;  /* start below top */
                bottom: 40px; /* end above bottom */
                width: 3px;
                background-color: #EAECF0;
                z-index: 0;
            }

            /* Each timeline item */
            main p {
                position: relative;
                padding: 10px 0 10px 30px;
                margin: 0;
                font-size: 1em;
                color: #34435e;
            }

            /* Circle number */
            main p::before {
                margin-top:15px;
                counter-increment: section;
                content: counter(section);
                position: absolute;
                left: -14px;
                top: 0;
                width: 2.25em;
                height: 2.25em;
                background-color: #F1E9F0;
                border-radius: 50%;
                text-align: center;
                line-height: 2.25em;
                color: #667085;
                font-size: 1em;
                border: 1px solid #A16A99;
                z-index: 1;
            }
            main{
                counter-reset: section;
            }
            .summary-text {
                color:#344054;
                font-size: 14px;
                font-weight: 500;
            }
        </style>
        <style>
            .list-group {
                border-radius: 12px;
            }
            .list-group-item {
                border-bottom: 1px solid #ddd;
            }
            .list-group-item:last-child {
                border-bottom: none;
            }
            .list-group-item img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                margin-right: 12px;
            }
            .heading-summary ul {
                display: flex;
                gap: 25px;
            }
            .heading-summary li {
                color: #667085;
                font-size: 14px;
            }
        </style>
    @endpush

    @push('js')
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_multiselect.js"></script>
        <script>
            $(document).ready(function() {
                $('#closeSidebar, #taskSidebarOverlay').on('click', function() {
                    $('#taskSidebar').removeClass('open');
                    $('#taskSidebarOverlay').removeClass('active');
                    $('#boardHiddenInputSection').html('');
                });

                $(document).on('click', '.btn-details', detailModalData);
                $(document).on('click', '.view_details', viewDetails);


            });

            function filter(button) {
                const filter = $('.filter');
                filter.show();
                $('#taskSidebar').addClass('open');
                $('#taskSidebarOverlay').addClass('active');
            }

            function detailModalData()
            {
                let examId = $(this).data('exam');
                $('main').html(' ');
                $('#start-exam-form').attr('action', `/student-exam/start/${examId}`);

                $.ajax({
                    url: `/exams/${examId}/details`,
                    method: 'GET',
                    success: function(response) {
                        console.log(response);

                        // Assuming response is JSON with needed exam info
                        populateDetailsModal(response);

                        $(document).on('click', '.leaderboard-item', otherStudentScore);
                        $('.leaderboard-item.auto-click').trigger('click');
                    },
                    error: function(err) {
                        console.error('Error fetching exam details:', err);
                        Swal.fire("Sorry", "Record Not Found", "warning");
                    }
                });

            }

            function populateDetailsModal(data) {

                $('#detailsModelCenter h5#exampleModalLongTitle').text(data.exam.title);
                $('#audience').text(data.exam.audience || 'Hi School');
                $('#total-section').text(data.exam.section ? data.exam.section + ' sections' : '');
                $('#total-question').text(data.totalQuestions ? data.totalQuestions + ' Questions' : '');

                $('.scoreValue').text(data.examAttempt.score || '0');
                $('.betterPercent').text(data.betterThanPercent || '0');
                $('.studentName').text(data.student_name || 'Student');
                $('.correct-answers').text(data.correctAnswers || '0');
                $('.total-questions').text(data.totalQuestions || '0');
                $('#correct_percent').text(data.percentCorrect || '0%');
                $('#avg_pace_time').text(data.averagePaceFormatted || '0%');
                $('.total-time').text(data.totalTimeFormatted || '0:00');
                // $('.others-total-time').text(data.others_average_time || '0:00');

                // Fill leaderboard (clear existing first)
                const leaderboardList = $('#detailsModelCenter .list-group').empty();

                if (data.leadBoard && data.leadBoard.length) {
                    leaderboardList.append(`<li class="list-group-item" style="color: #101828">Leaderboard</li>`);
                    data.leadBoard.forEach(function(item, idx) {
                        // Base URL (Blade থেকে domain আনা)
                        let baseUrl = "{{ url('') }}"; 
                        let profileImage = item.profile_image 
                            ? `${baseUrl}/${item.profile_image}` 
                            : `{{ asset('image/default-avatar.png') }}`;

                        leaderboardList.append(`
                            <li class="list-group-item d-flex align-items-center leaderboard-item ${idx === 0 ? 'auto-click' : ''}" 
                                style="cursor: pointer;" 
                                data-user-id="${item.user_id}" 
                                data-exam-id="${data.examAttempt.exam_id}">
                                
                                <span class="mr-3">${idx + 1}</span>
                                <img src="${profileImage}" class="rounded-circle me-3" alt="Avatar">
                                <div>
                                    <p class="p-0 m-0">${item.user_name}</p>
                                    <p>${item.score}%</p>
                                </div>
                            </li>
                        `);
                    });
                }

                const main = $('main');

                if (data.previousAttempts.length > 0) {
                    data.previousAttempts.forEach((item, index) => {
                        const dateOnly = item.start_time.split('T')[0];

                        const $p = $('<p></p>').html(`
                            ${dateOnly}<br>
                            <b data-id="${item.id}" data-examId="${item.exam_id}" class="view_details" style="color:#521749; cursor:pointer;"><u>View detail</u></b>
                        `);

                        main.append($p);
                    });
                }
            }

            function viewDetails()
            {
                let attemptId = $(this).data('id');

                $.ajax({
                    url: `/view-details/${attemptId}`,
                    method: 'GET',
                    success: function(response) {
                        console.log(response, 'hhhh');
                        $('.scoreValue').text(response.examAttempt.score || '0');
                        $('.betterPercent').text(response.betterThanPercent || '0');
                        $('.studentName').text(response.student_name || 'Student');
                        $('.correct-answers').text(response.correctAnswers || '0');
                        $('.total-questions').text(response.totalQuestions || '0');
                        $('#correct_percent').text(response.percentCorrect || '0%');
                        $('#avg_pace_time').text(response.averagePaceFormatted || '0%');
                        $('.total-time').text(response.totalTimeFormatted || '0:00');

                    },
                    error: function(err) {
                        console.error('Error fetching exam details:', err);
                        alert('Failed to load exam details.');
                    }
                });

            }

            function otherStudentScore()
            {
                const userId = $(this).data('user-id');
                const examId = $(this).data('exam-id');
                console.log(userId, examId, 'jii');

                // Remove previous selection
                $('.leaderboard-item').removeClass('selected');

                // Highlight the clicked one
                $(this).addClass('selected');

                // Send AJAX request
                $.ajax({
                    url: '/other-student-score',
                    type: 'GET',
                    data: {
                        user_id: userId,
                        exam_id: examId
                    },
                    success: function(response) {
                        $('.other_avg_time').text(response.averagePaceFormatted)
                        $('.others-total-time').text(response.totalTimeFormatted)


                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            }

        </script>
        <script>
            const minRange = document.getElementById('min-range');
            const maxRange = document.getElementById('max-range');
            const trackActive = document.querySelector('.track-active');
            const minValue = document.getElementById('min-value');
            const maxValue = document.getElementById('max-value');
            const sectionInput = document.getElementById('section-input');
            const questionInput = document.getElementById('question-input');
            const examTitle = document.getElementById('exam-title');
            const sectionTitle = document.getElementById('section-title');
            const questionTitle = document.getElementById('question-title');
            const rangeTitle = document.getElementById('range-title');
            const resetButtons = document.querySelectorAll('.reset-btn');
            const attemptedCheckbox = document.getElementById('attempted');
            const unattemptedCheckbox = document.getElementById('unattempted');
            const resetAllButton = document.querySelector('.reset-filter-btn');

            function updateTrack() {
                const min = Number(minRange.value);
                const max = Number(maxRange.value);
                const minPercent = ((min - minRange.min) / (minRange.max - minRange.min)) * 100;
                const maxPercent = ((max - maxRange.min) / (maxRange.max - maxRange.min)) * 100;

                // Update active track
                trackActive.style.left = `${minPercent}%`;
                trackActive.style.width = `${maxPercent - minPercent}%`;

                // Update thumb values
                minValue.textContent = min;
                maxValue.textContent = max;
                minValue.style.left = `${minPercent}%`;
                maxValue.style.left = `${maxPercent}%`;

                // Update range title
                rangeTitle.textContent = (min !== 1 || max !== 120) ? `${min}-${max}` : 'All Result';

                // Show reset button for range
                resetButtons[3].style.display = (min !== 1 || max !== 120) ? 'inline' : 'none';
            }

            // Update section title and reset button
            function updateSection() {
                const value = sectionInput.value.trim();
                sectionTitle.textContent = value || 'All Result';
                resetButtons[1].style.display = value ? 'inline' : 'none';
            }

            // Update question title and reset button
            function updateQuestion() {
                const value = questionInput.value.trim();
                questionTitle.textContent = value || 'All Result';
                resetButtons[2].style.display = value ? 'inline' : 'none';
            }

            // Update exam title and reset button
            function updateExam() {
                const attempted = attemptedCheckbox.checked;
                const unattempted = unattemptedCheckbox.checked;
                let title = 'All Result';
                if (attempted && !unattempted) title = 'Attempted';
                else if (!attempted && unattempted) title = 'Unattempted';
                else if (attempted && unattempted) title = 'Attempted, Unattempted';
                examTitle.textContent = title;
                resetButtons[0].style.display = (attempted && unattempted) ? 'none' : 'inline';
            }

            // Reset functions
            function resetExam() {
                attemptedCheckbox.checked = true;
                unattemptedCheckbox.checked = true;
                updateExam();
            }

            function resetSection() {
                sectionInput.value = '';
                updateSection();
            }

            function resetQuestion() {
                questionInput.value = '';
                updateQuestion();
            }

            function resetRange() {
                minRange.value = 1;
                maxRange.value = 120;
                updateTrack();
            }

            // Reset all filters
            function resetAll() {
                resetExam();
                resetSection();
                resetQuestion();
                resetRange();
            }

            // Event listeners
            minRange.addEventListener('input', updateTrack);
            maxRange.addEventListener('input', updateTrack);
            sectionInput.addEventListener('input', updateSection);
            questionInput.addEventListener('input', updateQuestion);
            attemptedCheckbox.addEventListener('change', updateExam);
            unattemptedCheckbox.addEventListener('change', updateExam);
            resetAllButton.addEventListener('click', resetAll);

            // Initial updates
            updateTrack();
            updateSection();
            updateQuestion();
            updateExam();
        </script>
    @endpush
</x-backend.layouts.student-master>
