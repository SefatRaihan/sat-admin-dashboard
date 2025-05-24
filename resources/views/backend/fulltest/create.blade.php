<x-backend.layouts.student-master>
    <div>
        <div class="card">
            <div class="card-body">
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
                                        <h5 class="card-title">{{ $exam->title }}</h5>
                                        <p class="card-text"><i class="fas fa-th-large"></i> Section <span class="card-text-value">{{ $exam->sections->count() }}</span></p>
                                        <p class="card-text"><i class="fas fa-file-alt"></i> Question <span class="card-text-value">{{ $exam->questions->count()  }}</span></p>
                                        <p class="card-text"><i class="fas fa-clock"></i> Duration <span class="card-text-value">{{ $exam->formatted_duration }}</span></p>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('student-exam.open', $exam->id) }}" class="btn btn-start">{{ $exam->userAttempt && $exam->userAttempt->status ? 'Re-take Exam' : 'Start Exam' }}</a>
                                            <button class="btn btn-details" data-toggle="modal" data-exam="{{ $exam->id }}" data-target="#detailsModelCenter">Details</button>
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
                                        <h5 class="card-title">{{ $exam->title }}</h5>
                                        <p class="card-text"><i class="fas fa-th-large"></i> Section <span class="card-text-value">{{ $exam->sections->count() }}</span></p>
                                        <p class="card-text"><i class="fas fa-file-alt"></i> Question <span class="card-text-value">{{ $exam->questions->count()  }}</span></p>
                                        <p class="card-text"><i class="fas fa-clock"></i> Duration <span class="card-text-value">{{ $exam->duration }}</span></p>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('student-exam.open', $exam->id) }}" class="btn btn-start">{{ 'Start Exam' }}</a>
                                            <button class="btn btn-details" data-toggle="modal" data-exam="{{ $exam->id }}" data-target="#detailsModelCenter">Details</button>
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
                                        <h5 class="card-title">{{ $exam->title }}</h5>
                                        <p class="card-text"><i class="fas fa-th-large"></i> Section <span class="card-text-value">{{ $exam->sections->count() }}</span></p>
                                        <p class="card-text"><i class="fas fa-file-alt"></i> Question <span class="card-text-value">{{ $exam->questions->count()  }}</span></p>
                                        <p class="card-text"><i class="fas fa-clock"></i> Duration <span class="card-text-value">{{ $exam->duration }}</span></p>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('student-exam.open', $exam->id) }}" class="btn btn-start">{{ 'Re-take Exam' }}</a>
                                            <button class="btn btn-details" data-toggle="modal" data-exam="{{ $exam->id }}" data-target="#detailsModelCenter">Details</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
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
                <button type="button" class="close-btn" id="closeSidebar">&times;</button>
            </div>
            <div class="filter-sidebar-content">
                <div class="task-form">
                    <div class="pr-3 pb-3 pl-0">
                        <div class="mt-2">
                            <div class="d-flex justify-content-between">
                                <h6><b>Exam:</b> All Result</h6>
                                <a href="" style="color: #101828"><u><b>Reset</b></u></a>
                            </div>
                            <div id="all_sat_type_1">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="form-check-input toggle-parent" type="checkbox" id="attempted" value="attempted" checked>
                                        <label class="form-check-label" for="attempted">
                                            Attempted
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="all_sat_type_2">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="form-check-input toggle-parent" type="checkbox" id="unattempted" value="unattempted" checked>
                                        <label class="form-check-label" for="unattempted">
                                            Unattempted
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between">
                                <h6><b>Section:</b> All Result</h6>
                            </div>
                            <div class="mb-1">
                                <input type="text" class="form-control seaction-search search_input w-100 pl-4" placeholder="Section number">
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between">
                                <h6><b>Question::</b> All Result</h6>
                            </div>
                            <div class="mb-1">
                                <input type="text" class="form-control question-search search_input w-100 pl-4" placeholder="Question number">
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="slider-container" style="max-width: 100% !important;">
                                <div class="slider-header">
                                    <span>Exam Duration:: All Result</span>
                                </div>
                                <div class="range-slider">
                                    <input type="range" min="1" max="120" value="1" id="min-range">
                                    <input type="range" min="1" max="120" value="120" id="max-range">
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
                            <li id="audience" style="list-style: none">Hi School</li>
                            <li id="total-section">4 sections</li>
                            <li id="total-question">80 Questions</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mt-3">
                                <h4 class="text-center score-title">Your score: <span class="scoreValue">75</span></h4>
                                <p class="text-center score-text">Your performance is better than <b><span class="scoreValue">75</span>% of <span class="studentName">Mubhir</span> student</b> who have <br> completed this exam</p>
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <p class="summary-text">Your Percent Correct</p>
                                                    <p class="summary-value"><b>0%</b></p>
                                                    <p class="summary-description">(<span class="correct-answers">0</span> of <span class="total-questions">3</span>)</p>
                                                </div>

                                                <div class="col-md-12 text-center">
                                                    <p class="summary-text">Your Average Pace</p>
                                                    <p class="summary-value"><b>0:03</b></p>
                                                    <p class="summary-description">(<span class="total-time">0:10</span> total)</p>
                                                </div>

                                                <div class="col-md-12 text-center">
                                                    <p class="summary-text">Others' Average Pace</p>
                                                    <p class="summary-value"><b>0:45</b></p>
                                                    <p class="summary-description">(<span class="others-total-time">2:16</span> total)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="list-group">
                                <li class="list-group-item" style="color: #101828">Leaderboard</li>
                                <li class="list-group-item d-flex align-items-center">
                                    <span class="mr-3">1</span>
                                    <img src="{{ asset('image/profile.jpeg') }}" class="rounded-circle me-3" alt="Avatar">
                                    <div>
                                        <p class="p-0 m-0">Andi Lane</p>
                                        <p>75%</p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <span class="mr-3">2</span>
                                    <img src="{{ asset('image/profile.jpeg') }}" class="rounded-circle me-3" alt="Avatar">
                                    <div>
                                        <p class="p-0 m-0">Andi Lane</p>
                                        <p>75%</p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <span class="mr-3">3</span>
                                    <img src="{{ asset('image/profile.jpeg') }}" class="rounded-circle me-3" alt="Avatar">
                                    <div>
                                        <p class="p-0 m-0">Andi Lane</p>
                                        <p>75%</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <main>
                                <p>
                                    10-05-2025
                                    <br>
                                    <a href="" style="color:#521749"><u>View detail</u></a>
                                </p>
                                <p>
                                    10-05-2025
                                    <br>
                                    <a href="" style="color:#521749"><u>View detail</u></a>
                                </p>
                            </main>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn start-exam" style="background-color:#691D5E ;border-radius: 8px; color:#fff">Start Exam</button>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
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
                border-radius: 9px !important;
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
                color: #344054;
                background-color: #FFFFFF;
                border-color: #fff #fff #fff;
                padding: 8px;
                margin-top: 3px;
                margin-left: 3px !important;
                border-radius: 7px !important;
                font-weight: 600;
                font-size: 16px;
            }

            .exam-tab-section .nav-tabs .nav-link:hover {
                color: #344054;
                background-color: #FFFFFF;
                border-color: #fff #fff #fff;
                padding: 8px;
                margin-top: 3px;
                margin-left: 3px !important;
                border-radius: 7px !important;
                font-weight: 600;
                font-size: 16px;
            }

            /* exam card section */
            .exam-card .card {
                border-radius: 15px;
                border: 1px solid #EAECF0;
                box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
                padding: 20px;
            }
            .exam-card .card-title {
                font-size: 18px;
                font-weight: 600;
                margin-bottom: 20px;
                color:#101828;
            }
            .exam-card .card-text {
                font-size: 14px;
                font-weight: 400;
                color: #475467;
                margin-bottom: 10px;
            }
            .exam-card .card-text i {
                color: #6c757d;
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
                border-radius: 8px;
                padding: 10px 20px;
                font-weight: bold;
                width: 50%;
                margin-right: 4px;
            }
            .exam-card .btn-details {
                background-color: white;
                color: #6c757d;
                border: 1px solid #ced4da;
                border-radius: 8px;
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
            /* filter section end */

            /* timeline */

            main {
                min-width: 300px;
                max-width: 500px;
                margin: auto;
            }
            main p {
                font-size: 1em;
                line-height: 1.75em;
                border-image: linear-gradient(to right, #EAECF0 0%, #EAECF0 100%);
                border-image-slice: 1;
                border-width: 3px;
                margin: 0;
                padding: 40px;
                counter-increment: section;
                position: relative;
                color: #34435e;
            }
            main p:before {
                content: counter(section);
                position: absolute;
                border-radius: 50%;
                padding: 6px;
                height: 2.25em;
                width: 2.25em;
                background-color: #F1E9F0;
                text-align: center;
                line-height: 1.25em;
                color: #667085;
                font-size: 1em;
                border: 1px solid #A16A99;
            }
            main p:nth-child(odd) {
                border-left: 3px solid;
                padding-right: 0;
                padding-top: 0px;
            }
            main p:nth-child(odd):before {
                right: 100%;
                margin-right: -14px;
            }
            main p:nth-child(even) {
                border-left: 3px solid;
                padding-right: 0;
            }
            main p:nth-child(even):before {
                right: 100%;
                margin-right: -14px;
            }
            main p:first-child {
                border-top: 0;
                border-top-right-radius: 0;
                border-top-left-radius: 0;
            }
            main p:last-child {
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
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

                $(document).on('click', '.btn-details', detailModalData)

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
                console.log(examId);

                $.ajax({
                    url: `/exams/${examId}/details`,
                    method: 'GET',
                    success: function(response) {
                        // Assuming response is JSON with needed exam info
                        populateDetailsModal(response.data);
                    },
                    error: function(err) {
                        console.error('Error fetching exam details:', err);
                        alert('Failed to load exam details.');
                    }
                });

            }

            function populateDetailsModal(data) {
                $('#detailsModelCenter h5#exampleModalLongTitle').text(data.title || 'Exam Name');
                $('#audience').text(data.audience || 'Hi School');
                $('#total-section').text(data.sections_count ? data.sections_count + ' sections' : '');
                $('#total-question').text(data.total_questions ? data.total_questions + ' Questions' : '');

                $('.scoreValue').text(data.score || '0');
                $('.studentName').text(data.student_name || 'Student');
                $('.correct-answers').text(data.correct_answers || '0');
                $('.total-questions').text(data.total_questions || '0');
                $('.summary-value b').first().text(data.percent_correct || '0%');
                $('.total-time').text(data.total_time || '0:00');
                $('.others-total-time').text(data.others_average_time || '0:00');

                // Fill leaderboard (clear existing first)
                const leaderboardList = $('#detailsModelCenter .list-group').empty();

                if(data.leaderboard && data.leaderboard.length) {
                    leaderboardList.append(`<li class="list-group-item" style="color: #101828">Leaderboard</li>`);
                    data.leaderboard.forEach(function(item, idx) {
                        leaderboardList.append(`
                            <li class="list-group-item d-flex align-items-center">
                                <span class="mr-3">${idx + 1}</span>
                                <img src="${item.avatar_url}" class="rounded-circle me-3" alt="Avatar">
                                <div>
                                    <p class="p-0 m-0">${item.name}</p>
                                    <p>${item.score}%</p>
                                </div>
                            </li>
                        `);
                    });
                }

                // Fill any other dynamic info as needed
            }


        </script>
    @endpush
</x-backend.layouts.student-master>
