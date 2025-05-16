<x-backend.layouts.student-master>
    @dd();
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
                                    <th class="text-left">Exam Name</th>
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
                                {{-- <tr>
                                    <td colspan="9" class="text-center">Loading...</td>
                                </tr> --}}
                                <tr>
                                    <td>Stress Endurance Test for SAT 2</td>
                                    <td class="text-center">12-12-2025</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">80</td>
                                    <td class="text-center">73%</td>
                                    <td class="text-center">1 hr 28 min</td>
                                    <td class="text-center">25</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Detail</button>
                                        <button type="button" class="btn start-exam" style="background-color:#691D5E ;border-radius: 8px; color:#fff">Re-take Exam</button>
                                    </td>
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
                                    <input type="text" class="form-control seaction-search w-100 pl-2" placeholder="Section number">
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
                                        <input type="range" min="1" max="100" value="1" id="min-range">
                                    </div>
                                </div>
                            </div> 
                            <div class="mt-4">
                                <div class="slider-container" style="max-width: 100% !important;">
                                    <div class="slider-header">
                                        <span>Duration: All Result</span>
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

            });

            function filter(button) {
                const filter = $('.filter');
                filter.show();
                $('#taskSidebar').addClass('open');
                $('#taskSidebarOverlay').addClass('active');
            }

        </script>
    @endpush

</x-backend.layouts.student-master>