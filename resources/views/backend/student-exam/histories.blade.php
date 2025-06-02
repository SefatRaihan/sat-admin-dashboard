<x-backend.layouts.student-master>

    <section>
        <div id="questionList">
            <div class="card"
                style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <div>
                        <input type="text" id="search" class="form-control search_input" placeholder="Search" style="padding-left: 40px">
                    </div>

                    <div class="d-flex">
                        <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" onclick="filter(this)"><img src="{{ asset('image/icon/layer.png') }}" alt=""> Filters</button>
                    </div>
                </div>
                <div class="card-body p-0 m-0 table-responsive">
                    <!-- Filters & Pagination Controls -->
                    <div class="d-flex justify-content-between align-items-center mt-3 p-2">
                        <h4><strong id="total-questions">297 Exams</strong></h4>
                    </div>

                    <!-- Questions Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr class="bg-light" style="border-top: 1px solid #D0D5DD;">
                                    <th class="text-center">Exam Name</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Total Section</th>
                                    <th class="text-center">Total Question</th>
                                    <th class="text-center">Score</th>
                                    <th class="text-center">Duration</th>
                                    <th class="text-center">Leaderboard</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="question-table-body">
                               
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
                                <p style="font-size: 12px"> <span style="color: #344054"><b>Date:</b></span> <span style="color: #475467">06 Jan 25 - 12 Jan 25</span></p>
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
                            <div class="mt-4">
                                <div class="d-flex justify-content-between">
                                    <h6><b>Section:</b> All Result</h6>
                                </div>
                                <div class="mb-1">
                                    <input type="text" class="form-control section-search w-100 pl-2" placeholder="Section number">
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="d-flex justify-content-between">
                                    <h6><b>Question:</b> All Result</h6>
                                </div>
                                <div class="mb-1">
                                    <input type="text" class="form-control question-search w-100 pl-2" placeholder="Question number">
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="slider-container" style="max-width: 100% !important;">
                                    <div class="slider-header">
                                        <span>Correct Percentage: All Result</span>
                                    </div>
                                    <div class="range-slider">
                                        <input type="range" class="correcct-percentage" min="1" max="100" value="1" id="min-range">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="slider-container" style="max-width: 100% !important;">
                                    <div class="slider-header">
                                        <span>Duration: All Result</span>
                                    </div>
                                    <div class="range-slider">
                                        <input type="range" min="1" max="120" value="1" id="duration-min-range">
                                        <input type="range" min="1" max="120" value="120" id="duration-max-range">
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
                    <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
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
                background-position: 10px center; /* Adjusted to position the icon to the left */
                border-radius: 50px;
                transition: all 250ms ease-in-out;
                backface-visibility: hidden;
                transform-style: preserve-3d;
                padding-left: 36px; /* Ensures the placeholder doesn't overlap with the icon */
            }

            .search_input::placeholder {
                padding-left: 30px;
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


             .btn-start {
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
            .btn-details {
                background-color: white;
                color: #6c757d;
                border: 1px solid #ced4da;
                border-radius: 8px;
                padding: 10px 20px;
                font-weight: bold;
                width: 50%;
                margin-left: 4px;
            }
            .btn-details:hover {
                background-color: #f8f9fa;
            }

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

            .leaderboard-item.selected {
                background-color: #F1E9F0; /* light blue */
                color: #101828; /* blue text */
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
        <script>
            $(document).ready(function() {
                $('#closeSidebar, #taskSidebarOverlay').on('click', function() {
                    $('#taskSidebar').removeClass('open');
                    $('#taskSidebarOverlay').removeClass('active');
                    $('#boardHiddenInputSection').html('');
                });


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


                $(document).on('click', '.btn-details', detailModalData);
                $(document).on('click', '.view_details', viewDetails);

            });

            function filter(button) {
                const filter = $('.filter');
                filter.show();
                $('#taskSidebar').addClass('open');
                $('#taskSidebarOverlay').addClass('active');
            }

            // start datatable code
            // get all questions
            function fetchQuestions(page = 1, perPage = 10, sortColumn, sortOrder, sort = 'Latest') {
                let filters = {
                    crated_start_at: $('input[name="crated_start_at"]').val() || '', // Start date, default to empty string
                    crated_end_at: $('input[name="crated_end_at"]').val() || '', // End date, default to empty string
                    sectionSearch: $('.section-search').val() || '',
                    questionSearch: $('.question-search').val() || '',
                    correct_percentage: $('.correcct-percentage').val() || '', // Duration, default to empty string
                    duration: {
                        min: $('#duration-min-range').val() || 1, // Minimum percentage from slider
                        max: $('#duration-max-range').val() || 100 // Maximum percentage from slider
                    },
                };

                $.ajax({
                    url: "/student-history?page=" + page + "&per_page=" + perPage,
                    type: "GET",
                    data: filters,
                    success: function(response) {
                        console.log(response);

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
                            $.each(response.data, function(index, attemptExam) {
                                rows += `<tr>
                                    <td class="text-left">${attemptExam.title}</td>
                                    <td class="text-center">${attemptExam.start_time}</td>
                                    <td class="text-center">${attemptExam.section}</td>
                                    <td class="text-center">${attemptExam.total_questions}</td>
                                    <td class="text-center">${attemptExam.score || 0}%</td>
                                    <td class="text-center">${attemptExam.duration}</td>
                                    <td class="text-center">${attemptExam.total_user_attempts}</td>
                                    <td class="text-center d-flex justify-content-between">
                                        <a href="/student-open-exam/${attemptExam.exam_id}"  target="_blank" class="btn btn-start">{{ 'Re-take Exam' }}</a>
                                        <button class="btn btn-details" data-toggle="modal" data-exam="${attemptExam.exam_id}" data-target="#detailsModelCenter">Details</button>
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
                let totalResults = response.meta.total;
                let perPage = response.meta.per_page;
                let totalPages = response.meta.last_page;
                let start = (response.meta.from || 0);
                let end = (response.meta.to || 0);

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
                        alert('Failed to load exam details.');
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

                if(data.leadBoard && data.leadBoard.length) {
                    leaderboardList.append(`<li class="list-group-item" style="color: #101828">Leaderboard</li>`);
                    data.leadBoard.forEach(function(item, idx) {
                        leaderboardList.append(`
                            <li class="list-group-item d-flex align-items-center leaderboard-item ${idx === 0 ? 'auto-click' : ''}" style="cursor: pointer;" data-user-id="${item.user_id}" data-exam-id="${ data.examAttempt.exam_id }">
                                <span class="mr-3">${idx + 1}</span>
                                <img src="${item.profile_image}" class="rounded-circle me-3" alt="Avatar">
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
                    url: `/view-details/${attemptId}/`,
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
    @endpush

</x-backend.layouts.student-master>
