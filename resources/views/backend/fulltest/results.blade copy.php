<x-backend.layouts.student-master>
    {{-- @dd($exam.$examAttempt, $examAttemptQuestions) --}}
    <div class="mt-3">
        <h4 class="text-center score-title">Your score: <span class="scoreValue">{{ $correctAnswers }}</span></h4>
        <p class="text-center score-text">Your performance is better than <b><span class="scoreValue">{{ $betterThanPercent }}</span>% of <span class="studentName">Mubhir</span> student</b> who have <br> completed this exam</p>
        <div class="mt-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <p class="summary-text">Your Percent Correct</p>
                            <p class="summary-value"><b>{{ $percentCorrect }}%</b></p>
                            <p class="summary-description">(<span class="correct-answers">{{ $correctAnswers }}</span> of <span class="total-questions">{{ $totalQuestions }}</span>)</p>
                        </div>
                    
                        <div class="col-md-4 text-center">
                            <p class="summary-text">Your Average Pace</p>
                            <p class="summary-value"><b>{{ $averagePaceFormatted }}</b></p>
                            <p class="summary-description">(<span class="total-time">{{ $totalTimeFormatted }}</span> total)</p>
                        </div>
                    
                        <div class="col-md-4 text-center">
                            <p class="summary-text">Others' Average Pace</p>
                            <p class="summary-value"><b class="other_avg_time">0:00</b></p>
                            <p class="summary-description">(<span class="others-total-time">0:00</span> total)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4" style="height: 100vh;">
        <div class="row">
            <div class="col-md-8">

                <div>
                    <div class="questionListTableWrapper">
                        <table class="table  questionListTable">
                            <thead>
                                <tr>
                                    <td colspan="5">
                                        <h4 class="mb-0" style="font-size: 16px; color:#000000; font-weight:500">Question list</h4>
                                    </td>
                                </tr>
                                <tr style="border-top: 1px solid #ddd">
                                    <td colspan="2">
                                        <input type="text" id="search" class="form-control search__input" placeholder="Search Question" style="padding-left: 35px; margin-right:13px; width:100% !important;">
                                    </td>
                                    <td colspan="3"></td>
                                    <td class="text-right">
                                        <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px; width:95px; height: 38px;" onclick="filter(this)"><img src="{{ asset('image/icon/layer.png') }}" alt=""> Filters</button>
                                        {{-- filter side modal --}}
                                        <div class="sidebar-overlay" id="taskSidebarOverlay"></div>
                                        <div class="floating-sidebar" id="taskSidebar">
                                            <div class="filter">
                                                <div class="sidebar-header">
                                                    <div>
                                                        <h4 style="font-size: 18px;" class="p-0 m-0 text-left">Filters</h4>
                                                        <p class="p-0 m-0" style="color: #475467">Apply filters to table data.</p>
                                                    </div>
                                                    <button type="button" class="close-btn" id="closeSidebar">&times;</button>
                                                </div>
                                                <div class="filter-sidebar-content pl-0">
                                                    <div class="task-form">
                                                        <div class="pt-3 pb-3 pl-0">
                                                            <div class="mt-2 pr-3 pl-2">
                                                                <div class="d-flex justify-content-between">
                                                                    <h6><b>Question:</b> All Result</h6>
                                                                    <button class="reset-slider">Reset</button>
                                                                </div>
                                                                <div id="correctAnswer">
                                                                    <div class="filter-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input toggle-parent" type="checkbox" id="correctAnswerToggle" checked>
                                                                            <label class="form-check-label" for="correctAnswerToggle">
                                                                                Correct
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="incorrectAnswer">
                                                                    <div class="filter-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input toggle-parent" type="checkbox" id="incorrectAnswerToggle" checked>
                                                                            <label class="form-check-label" for="incorrectAnswerToggle">
                                                                                Incorrect
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-2 pr-3 pl-2">
                                                                <div class="d-flex justify-content-between">
                                                                    <h6><b>Defficulty:</b> All result</h6>
                                                                    <button class="reset-slider">Reset</button>
                                                                </div>
                                                                <div class="form-check custom-checkbox d-flex justify-center">
                                                                    <input type="checkbox" class="difficulty" value="Easy">
                                                                    <label class="form-check-label pl-1"><span class="badge badge-pill badge-easy"><b>Easy</b></span></label>
                                                                </div>
                                                                <div class="form-check custom-checkbox d-flex justify-center">
                                                                    <input type="checkbox" class="difficulty" value="Medium">
                                                                    <label class="form-check-label pl-1"><span class="badge badge-pill badge-medium"><b>Medium</b></span></label>
                                                                </div>
                                                                <div class="form-check custom-checkbox d-flex justify-center">
                                                                    <input type="checkbox" class="defficulty" value="Hard">
                                                                    <label class="form-check-label pl-1" for="gladiator"><span class="badge badge-pill badge-hard"><b>Hard</b></span></label>
                                                                </div>
                                                                <div class="form-check custom-checkbox d-flex justify-center">
                                                                    <input type="checkbox" class="difficulty" value="Very Hard">
                                                                    <label class="form-check-label pl-1" for="gladiator"><span class="badge badge-pill badge-very-hard"><b>Very Hard</b></span></label>
                                                                </div>
                                                            </div>
                                                            <div class="mt-2 pr-3 pl-2">
                                                                <div class="slider-container" style="max-width: 100% !important">
                                                                    <div class="slider-header">
                                                                        <span>Duration:</span>
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
                                                            <div class="mt-2 border-top">
                                                                <div class="d-flex justify-content-between p-3">
                                                                    <button type="button" class="btn btn-outline-dark mr-2 reset-filter-btn" style="border: 1px solid #D0D5DD; border-radius: 8px; width:50%">Reset All</button>
                                                                    <button type="button" class="btn apply-filter-btn" style="background-color:#691D5E ;border-radius: 8px; color:#fff; width:50%">Apply Filters</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-light">
                                    <th colspan="2">Question</th>
                                    <th>Section</th>
                                    <th>Difficulty</th>
                                    <th>Your Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examAttemptQuestions as $item)
                                {{-- @dd($item->question->question_title) --}}
                                    <tr>
                                        <td width="5%">
                                            <span class="{{ $item->is_correct === 1 ?  'correct-answer' : 'wrong-answer' }}"><i class="fas fa-check"></i></span>
                                        </td>
                                        <td width="20%">
                                            <span>{{ strip_tags($item->question->question_title) }}</span>
                                        </td>
                                        <td></td>
                                        <td>
                                             @php
                                                $difficulty = strtolower($item->question->difficulty);
                                                $badgeClass = match($difficulty) {
                                                    'easy' => 'badge-easy',
                                                    'medium' => 'badge-medium',
                                                    'hard' => 'badge-hard',
                                                    'very_hard' => 'badge-very-hard',
                                                    default => 'badge-default'
                                                };
                                            @endphp
                                            <span class="badge badge-pill {{ $badgeClass }}">{{ $difficulty }}</span>
                                        </td>
                                        <td>10:00</td>
                                        <td>
                                            <button type="button" class="btn view" style="background-color:#691D5E ;border-radius: 8px; color:#fff">View</button>
                                            <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;">Feedback</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item" style="color: #101828">Leaderboard</li>
                    @forelse($leadBoard as $key => $data)
                        <li class="list-group-item d-flex align-items-center leaderboard-item {{ $key === 0 ? 'auto-click' : '' }}" style="cursor: pointer;" data-user-id="{{ $data['user_id'] }}" data-exam-id="{{ $examAttempt->exam_id }}">
                            <span class="mr-3">{{ $key + 1 }}</span>
                            <img src="{{ $data['profile_image'] }}" class="rounded-circle me-3" alt="Avatar">
                            <div>
                                <p class="p-0 m-0">{{ $data['user_name'] }}</p>
                                <p>{{ $data['score'] }}%</p>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">No leaderboard data available.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    

    @push('css')
        <style>
            .score-title {
                color: #101828;
                font-size: 30px;
                font-weight: 700;
                line-height: 38px;
            }

            .summary-text {
                color: #344054;
                font-size: 16px;
                font-weight: 500;
            }

            .summary-value {
                color: #000000
                font-size: 24px;
                font-weight: 700;
            }

            .summary-description {
                color: #344054;
                font-size: 14px;
                font-weight: 400;
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

            .questionListTableWrapper {
                border: 1px solid #ddd !important;
                border-radius: 18px !important;
                overflow: hidden; /* Ensures content respects rounded corners */
            }

            .questionListTable {
                border-collapse: collapse; /* Removes gaps between cells */
                width: 100%; /* Ensures table fills the wrapper */
            }
            .table thead th {
                vertical-align: middle;
                border-bottom: 0px;
            }

            .table td {
                border: 0px solid #ddd !important;
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

            .leaderboard-item.selected {
                background-color: #F1E9F0; /* light blue */
                color: #101828; /* blue text */
            }

            .correct-answer {
                padding: 4px;
                border-radius: 6px;
                border: 1px solid #079455;
                background-color: #ECFDF3;
                margin-right: 6px;
            }

            .correct-answer i {
                color: #079455;
            }

            .wrong-answer {
                padding: 4px;
                border-radius: 6px;
                border: 1px solid #D92D20;
                background-color: #FEF3F2;
                margin-right: 6px;
            }

            .wrong-answer i {
                color: #D92D20;
            }

            tr {
                border-bottom: 1px solid #ddd;
            }

            tr:last-child {
                border-bottom: none;
            }

            /* filter section */
            .floating-sidebar {
                position: absolute;
                top: 0;
                right: -9000px;
                width: 400px;
                height: auto;
                background-color: #fff;
                box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
                z-index: 1050;
                display: flex;
                flex-direction: column;
                border-radius: 15px;
            }

            .filter-sidebar-content {
                flex-grow: 1;
                overflow-y: auto;
                padding-left: 15px;
                /* padding-bottom: 60px; */
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
        </style>
    @endpush

    @push('js')
    <script>
            $(document).ready(function() {
                $('#closeSidebar, #taskSidebarOverlay').on('click', function() {
                    $('#taskSidebar').removeClass('open');
                    $('#taskSidebarOverlay').removeClass('active');
                    $('#boardHiddenInputSection').html('');
                });

                $('.leaderboard-item').on('click', otherStudentScore);
                $('.leaderboard-item.auto-click').trigger('click');
            });

            function filter(button) {
                const filter = $('.filter');
                filter.show();
                $('#taskSidebar').addClass('open');
                $('#taskSidebarOverlay').addClass('active');
            }


            function otherStudentScore() {

                const userId = $(this).data('user-id');
                const examId = $(this).data('exam-id');

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
    @endpush
</x-backend.layouts.student-master>