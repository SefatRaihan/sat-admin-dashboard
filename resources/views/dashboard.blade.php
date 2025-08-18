<x-backend.layouts.master>
    <x-slot name="page_title">
        Admin Dashboard
    </x-slot>

    <div class="dashboard-container">
        <div class="header">
            <h1>Admin Dashboard</h1>
            <div class="header-controls">
                <div class="time-frame-toggle">
                    <button id="pastWeekBtn" class="active">Past Week</button>
                    <button id="past2WeeksBtn">Past 2 Weeks</button>
                    <button id="pastMonthBtn">Past Month</button>
                </div>
                <input type="text" id="dateRangePicker" class="date-range" placeholder="Select Date Range">
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <!-- Exam Section -->
                <div class="card headcard p-0 question-section">
                    <div class="card-header border-bottom pb-1">
                        <div class="d-flex">
                            <img src="{{ asset('image/admin-dashboard/exam.png') }}" alt="" style="height:20px">
                            <h1 class="ml-1">Exam</h1>
                        </div>
                        <a href="/exams" class="seemore-btn">
                            See More <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="chart-container" id="chart-container-2" style="height: 245px">
                                    <canvas id="myChart2"></canvas>
                                    <div class="chart-center" id="chart-center-2" style="left:40%; font-size:33px">
                                        <span id="exam-total">0</span>
                                        <small>Total</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="card p-3">
                                            <div class="summary-card">
                                                <h2 class="text-left"> <i class="fas fa-circle mr-2" style="color:#21D3BB"></i> <span id="exams-active">0</span></h2>
                                                <p class="text-left">Exams Active</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card p-3">
                                            <div class="summary-card">
                                                <h2 class="text-left"> <i class="fas fa-circle mr-2" style="color:#E65F2B"></i> <span id="exams-inactive">0</span></h2>
                                                <p class="text-left">Exams Inactive</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="row p-3">
                                        <div class="col-md-6">
                                            <div class="summary-card">
                                                <h2 id="exams-used">0</h2>
                                                <p>Exam Used in courses</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 border-left pl-4">
                                            <div class="summary-card">
                                                <h2 id="exams-added">0</h2>
                                                <p>Exams added</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courses Section -->
                <div class="card headcard question-section">
                    <div class="header">
                        <div class="d-flex">
                            <img src="{{ asset('image/admin-dashboard/courses.png') }}" alt="" style="height:20px">
                            <h1 class="ml-1" style="font-size: 16px; color:#101828">Courses</h1>
                        </div>
                        <div class="filters">
                            <span class="pill active" id="allCoursesFilter" data-filter="all">All Courses</span>
                            <span id="completedFilter" data-filter="completed"><span class="dot completed"></span>Completed</span>
                            <span id="inProgressFilter" data-filter="inProgress"><span class="dot inprogress"></span>In Progress</span>
                        </div>
                    </div>
                    <canvas id="coursesChart" height="300"></canvas>
                </div>

                <!-- Supervisor Section -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card headcard p-0 question-section">
                            <div class="card-header border-bottom pb-1">
                                <div class="d-flex">
                                    <img src="{{ asset('image/admin-dashboard/supervisor.png') }}" alt="" style="height:20px">
                                    <h1 class="ml-1">Supervisor</h1>
                                </div>
                                <a href="" class="seemore-btn">
                                    See More <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="card">
                                    <div class="summary-card p-3">
                                        <h2 id="supervisor-total">0</h2>
                                        <p>Total Supervisor</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="summary-card p-3">
                                        <h2 id="supervisor-new">0</h2>
                                        <p>Newly registered</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Students Section -->
                    <div class="col-md-6">
                        <div class="card headcard p-0 question-section">
                            <div class="card-header border-bottom pb-1">
                                <div class="d-flex">
                                    <img src="{{ asset('image/admin-dashboard/student.png') }}" alt="" style="height:20px">
                                    <h1 class="ml-1">Students</h1>
                                </div>
                                <a href="" class="seemore-btn">
                                    See More <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="card">
                                    <div class="summary-card p-3">
                                        <h2 id="students-total">0</h2>
                                        <p>Total Students</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="row p-3">
                                        <div class="col-md-6">
                                            <div class="summary-card">
                                                <h2 id="students-new">0</h2>
                                                <p>Newly registered</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 border-left pl-4">
                                            <div class="summary-card">
                                                <h2 class="text-left" id="unregistered">0</h2>
                                                <p class="text-left">Unregistered </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Questions Section -->
                <div class="card headcard p-0 question-section">
                    <div class="card-header border-bottom pb-1">
                        <div class="d-flex">
                            <img src="{{ asset('image/admin-dashboard/question.png') }}" alt="" style="height:20px">
                            <h1 class="ml-1">Question</h1>
                        </div>
                        <a href="/question" class="seemore-btn">
                            See More <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="row p-3">
                                <div class="col-md-6">
                                    <div class="summary-card">
                                        <h2 id="questions-total">0</h2>
                                        <p>Total Questions</p>
                                    </div>
                                </div>
                                <div class="col-md-6 border-left">
                                    <div class="summary-card">
                                        <h2 class="text-right"> <i class="fas fa-circle mr-2" style="color:#6CD7A1"></i> <span id="questions-total-right">0</span></h2>
                                        <p class="text-right">Questions Added</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress m-2">
                                <div class="progress-bar w-0" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="summary-card p-3">
                                <h2 id="questions-feedback">0</h2>
                                <p>Questions with Feedback</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Lessons Section -->
                <div class="card headcard p-0 question-section">
                    <div class="card-header border-bottom pb-1">
                        <div class="d-flex">
                            <img src="{{ asset('image/admin-dashboard/video.png') }}" alt="" style="height:20px">
                            <h1 class="ml-1">Video Lessons</h1>
                        </div>
                        <a href="/lessons" class="seemore-btn">
                            See More <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="row p-3">
                                <div class="col-md-6">
                                    <div class="summary-card">
                                        <h2 id="lessons-total">0</h2>
                                        <p>Total Lessons</p>
                                    </div>
                                </div>
                                <div class="col-md-6 border-left">
                                    <div class="summary-card">
                                        <h2 class="text-right"> <i class="fas fa-circle mr-2" style="color:#6CD7A1"></i> <span id="lessons-added">0</span></h2>
                                        <p class="text-right">Lessons Added</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress m-2">
                                <div class="progress-bar w-0" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subscriptions Section -->
                <div class="card headcard p-0 question-section">
                    <div class="card-header border-bottom pb-1">
                        <div class="d-flex">
                            <img src="{{ asset('image/admin-dashboard/subcription.png') }}" alt="" style="height:20px">
                            <h1 class="ml-1">Subscriptions</h1>
                        </div>
                        <a href="" class="seemore-btn">
                            See More <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="chart-container" id="chart-container-1">
                                    <canvas id="myChart1"></canvas>
                                    <div class="chart-center" id="chart-center-1">
                                        <span id="subscriptions-total">0</span>
                                        <small>Total</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card pl-3 pt-3 pr-3 pb-2">
                                    <div class="summary-card">
                                        <div class="d-flex justify-content-between">
                                            <p><i class="fas fa-circle mr-2" style="color:#6CD7A1"></i> Active</p>
                                            <p id="subscriptions-active">0</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p><i class="fas fa-circle mr-2" style="color:#FDB022"></i> Expired</p>
                                            <p id="subscriptions-expired">0</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p><i class="fas fa-circle mr-2" style="color:#E65F2B"></i> Canceled</p>
                                            <p id="subscriptions-canceled">0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @push('css')
        <style>
            .question-section h1 {
                font-size: 16px;
                font-weight: 500;
                color: #101828;
            }

            .summary-card h2 {
                color: #353945;
                font-size: 20px;
                font-weight: 600;
            }

            .summary-card p {
                color: #101828;
                font-size: 14px;
                font-weight: 500;
            }

            .progress {
                border-radius: 25px;
                background-color: #47CD89 !important;
            }

            .progress-bar {
                border-radius: 25px;
                background-color: #6343C0 !important;
            }

            .seemore-btn {
                color: #691D5E;
                font-size: 12px;
                font-weight: 500;
            }

             .seemore-btn i {
                font-size: 10px;
                margin-left: 10px;
             }

            .chart-container {
                position: relative;
                width: 300px;
                height: 300px;
            }

            .chart-center {
                position: absolute;
                top: 50%;
                left: 22%;
                transform: translate(-50%, -50%);
                font-size: 19px;
                font-weight: bold;
                text-align: center;
            }

            .chart-center small {
                display: block;
                font-size: 14px;
                color: gray;
                font-weight: normal;
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }
            .filters {
                display: flex;
                gap: 16px;
                align-items: center;
                font-size: 14px;
                border: 1px solid #ddd;
                background: #fff;
                padding: 4px;
                padding-right: 11px;
                border-radius: 12px;
            }
            .pill {
                background: #f3f4f6;
                padding: 6px 12px;
                border-radius: 8px;
            }
            .dot {
                width: 12px;
                height: 12px;
                border-radius: 9999px;
                display: inline-block;
                margin-right: 6px;
            }
            .completed { background-color: #732067; }
            .inprogress { background-color: #BF98B9; }
        </style>
        <style>
            :root {
                --primary-color: #732067; /* A deep purple */
                --secondary-color: #ff9900; /* An orange for accents */
                --text-color-dark: #101828;
                --text-color-light: #666;
                --background-color: #f4f7f6;
                --card-background: #F9FAFB;
                --border-color: #e0e0e0;
                --success-color: #4CAF50;
                --info-color: #2196F3;
                --warning-color: #FFC107;
                --danger-color: #F44336;
            }

            .header {
                grid-column: 1 / -1;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .header h1 {
                font-size: 24px;
                font-weight: 600;
                color: var(--text-color-dark);
                margin: 0;
            }

            .header-controls {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .header-controls .time-frame-toggle {
                padding-top: 4px;
                padding-bottom: 4px;
                display: flex;
                border-radius: 8px;
                overflow: hidden;
                background-color: var(--card-background);
                border: 1px solid var(--border-color);
            }

            .header-controls .time-frame-toggle button {
                padding: 8px 15px;
                border: none;
                background-color: transparent;
                cursor: pointer;
                font-size: 14px;
                color: var(--text-color-light);
                transition: all 0.2s ease;
            }

            .header-controls .time-frame-toggle button.active {
                background-color: var(--primary-color);
                color: var(--card-background);
                font-weight: 600;
            }

            .header-controls .date-range {
                width: 195px;
                padding: 8px 15px;
                border: 1px solid var(--border-color) !important;
                border-radius: 8px;
                background-color: var(--card-background) !important;
                font-size: 14px;
                color: var(--text-color-light);
                height: 48px;
            }

            .headcard {
                background-color: var(--card-background);
                border-radius: 12px;
                padding: 25px;
                border: 1px solid #EAECF0;
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .card-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10px;
                color: #101828;
                font-size: 16px;
                font-weight: 500;
            }

            .card-header h3 {
                font-size: 18px;
                font-weight: 600;
                color: var(--text-color-dark);
                margin: 0;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .card-header .see-more {
                font-size: 14px;
                color: var(--primary-color);
                text-decoration: none;
                font-weight: 500;
            }

            /* Exam Card Specific Styles */
            .exam-overview {
                display: flex;
                align-items: center;
                gap: 30px;
            }

            .exam-chart-container {
                position: relative;
                width: 120px;
                height: 120px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: conic-gradient(var(--primary-color) 0% 75%, var(--secondary-color) 75% 100%);
                box-shadow: inset 0 0 0 10px rgba(255, 255, 255, 0.8); /* Inner white ring */
            }

            .exam-chart-container::before {
                content: '';
                position: absolute;
                background-color: var(--card-background);
                width: 90px;
                height: 90px;
                border-radius: 50%;
            }

            .exam-chart-center-text {
                position: relative;
                z-index: 1;
                text-align: center;
                font-size: 14px;
                color: var(--text-color-light);
                font-weight: 500;
            }

            .exam-chart-center-text .total {
                display: block;
                font-size: 28px;
                font-weight: 700;
                color: var(--text-color-dark);
                margin-top: 5px;
            }

            .exam-stats {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 10px 20px;
            }

            .exam-stat-item {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 15px;
                color: var(--text-color-dark);
            }

            .exam-stat-item::before {
                content: '';
                display: inline-block;
                width: 10px;
                height: 10px;
                border-radius: 50%;
            }

            .exam-stat-item.active::before {
                background-color: var(--info-color); /* You can adjust these colors */
            }

            .exam-stat-item.inactive::before {
                background-color: var(--danger-color);
            }

            .exam-stat-item.used::before {
                background-color: var(--primary-color);
            }

            .exam-stat-item.added::before {
                background-color: var(--secondary-color);
            }

            .exam-stat-value {
                font-weight: 600;
            }

            /* Courses Card Specific Styles */
            .courses-chart-controls {
                display: flex;
                gap: 15px;
                margin-bottom: 20px;
                justify-content: flex-end; /* Align to the right */
            }

            .courses-chart-controls .legend-item {
                display: flex;
                align-items: center;
                gap: 5px;
                font-size: 14px;
                color: var(--text-color-light);
            }

            .courses-chart-controls .legend-item::before {
                content: '';
                width: 10px;
                height: 10px;
                border-radius: 50%;
                display: inline-block;
            }

            .courses-chart-controls .legend-item.completed::before {
                background-color: var(--secondary-color);
            }

            .courses-chart-controls .legend-item.in-progress::before {
                background-color: var(--primary-color);
            }

            .chart-container {
                position: relative;
                height: 130px; /* Adjust as needed for the chart height */
                margin-top: 00px;
            }

            .bar-chart {
                display: flex;
                height: 100%;
                align-items: flex-end;
                gap: 15px; /* Spacing between bars */
                padding: 0 10px; /* Padding for the chart */
                box-sizing: border-box;
            }

            .bar-wrapper {
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                position: relative;
                height: 100%;
            }

            .bar {
                width: 100%;
                background-color: var(--primary-color);
                border-radius: 4px 4px 0 0;
                transition: height 0.3s ease-out;
                position: relative;
                cursor: pointer;
            }

            .bar.completed {
                background-color: var(--secondary-color);
                margin-top: 2px; /* Small gap for stacked appearance */
            }

            .bar-label {
                text-align: center;
                font-size: 12px;
                color: var(--text-color-light);
                margin-top: 5px;
            }

            .tooltip {
                position: absolute;
                background-color: rgba(0, 0, 0, 0.8);
                color: white;
                padding: 8px 12px;
                border-radius: 6px;
                font-size: 13px;
                white-space: nowrap;
                top: -30px; /* Position above the bar */
                left: 50%;
                transform: translateX(-50%);
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.2s ease, visibility 0.2s ease;
                pointer-events: none;
                z-index: 10;
            }

            .bar:hover .tooltip {
                opacity: 1;
                visibility: visible;
            }

            /* Questions and Video Lessons Card Styles */
            .summary-card-stats {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .summary-stat-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 16px;
                color: var(--text-color-dark);
                font-weight: 500;
            }

            .summary-stat-value {
                font-weight: 700;
            }

            .summary-stat-added {
                color: var(--success-color);
                font-weight: 600;
            }

            /* Subscriptions Card Styles */
            .subscriptions-overview {
                display: flex;
                align-items: center;
                gap: 20px;
            }

            .subscriptions-chart-container {
                position: relative;
                width: 120px;
                height: 120px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                /* Example for 1000 active, 80 expired, 20 canceled out of 1200 total */
                /* Active: (1000/1200)*360 = 300 deg */
                /* Expired: (80/1200)*360 = 24 deg */
                /* Canceled: (20/1200)*360 = 6 deg */
                background: conic-gradient(
                    var(--info-color) 0% 83.33%, /* Active */
                    var(--warning-color) 83.33% 90%, /* Expired */
                    var(--danger-color) 90% 91.66%, /* Canceled */
                    #f0f0f0 91.66% 100% /* Remaining or background */
                );
                box-shadow: inset 0 0 0 10px rgba(255, 255, 255, 0.8);
            }

            .subscriptions-chart-container::before {
                content: '';
                position: absolute;
                background-color: var(--card-background);
                width: 90px;
                height: 90px;
                border-radius: 50%;
            }

            .subscriptions-chart-center-text {
                position: relative;
                z-index: 1;
                text-align: center;
                font-size: 14px;
                color: var(--text-color-light);
                font-weight: 500;
            }

            .subscriptions-chart-center-text .total {
                display: block;
                font-size: 28px;
                font-weight: 700;
                color: var(--text-color-dark);
                margin-top: 5px;
            }

            .subscription-stats {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .subscription-stat-item {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 15px;
                color: var(--text-color-dark);
            }

            .subscription-stat-item::before {
                content: '';
                display: inline-block;
                width: 10px;
                height: 10px;
                border-radius: 50%;
            }

            .subscription-stat-item.active::before {
                background-color: var(--info-color);
            }
            .subscription-stat-item.expired::before {
                background-color: var(--warning-color);
            }
            .subscription-stat-item.canceled::before {
                background-color: var(--danger-color);
            }

            .subscription-stat-value {
                font-weight: 600;
            }

            /* Supervisor and Students Card Styles */
            .user-card-stats {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .user-stat-item {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .user-stat-label {
                font-size: 15px;
                color: var(--text-color-light);
            }

            .user-stat-value {
                font-size: 24px;
                font-weight: 700;
                color: var(--text-color-dark);
            }

            /* Grid specific placements */
            .card.exam {
                grid-column: span 2;
            }
            .card.courses {
                grid-column: span 3;
            }
            .card.supervisor {
                grid-column: span 1;
            }
            .card.students {
                grid-column: span 2;
            }

            /* Adjust style for the input field to match the button design */
            .date-range {
                padding: 8px 15px;
                border: 1px solid var(--border-color);
                border-radius: 8px;
                background-color: var(--card-background);
                font-size: 14px;
                color: var(--text-color-light);
                cursor: pointer; /* Indicate it's clickable */
                width: 200px; /* Adjust width as needed */
                box-sizing: border-box; /* Include padding/border in width */
                text-align: center; /* Center the text inside the input */
            }

            /* Flatpickr overrides (optional, for custom styling) */
            .flatpickr-calendar {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                font-family: 'Inter', sans-serif;
            }
            .flatpickr-current-month .flatpickr-month {
                color: var(--primary-color);
            }
            .flatpickr-day.selected,
            .flatpickr-day.selected:hover,
            .flatpickr-day.startRange,
            .flatpickr-day.endRange {
                background-color: var(--primary-color) !important;
                border-color: var(--primary-color) !important;
                color: white !important;
            }
            .flatpickr-day.in-range {
                background-color: rgba(106, 13, 173, 0.1) !important; /* Primary color with transparency */
                border-color: rgba(106, 13, 173, 0.1) !important;
            }
            .flatpickr-calendar {
                display: none;
            }

            .filters span {
                cursor: pointer;
            }
        </style>
    @endpush

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            // Initialize Charts
            let chart1, chart2, coursesChart;
            let coursesData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                completed: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                inProgress: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            };

            // API Fetch Function
            async function fetchDashboardData(params = '') {
                try {
                    const response = await fetch(`/api/dashboard?${params}`);
                    const data = await response.json();

                    // Update Subscriptions
                    chart1.data.datasets[0].data = [
                        data.subscriptions.active || 0,
                        data.subscriptions.expired || 0,
                        data.subscriptions.canceled || 0
                    ];
                    chart1.update();
                    document.getElementById('subscriptions-total').textContent = data.subscriptions.total || 0;
                    document.getElementById('subscriptions-active').textContent = data.subscriptions.active || 0;
                    document.getElementById('subscriptions-expired').textContent = data.subscriptions.expired || 0;
                    document.getElementById('subscriptions-canceled').textContent = data.subscriptions.canceled || 0;

                    // Update Exams
                    chart2.data.datasets[0].data = [
                        data.exams.active || 0,
                        data.exams.inactive || 0,
                        data.exams.used || 0
                    ];
                    chart2.update();
                    document.getElementById('exam-total').textContent = data.exams.total || 0;
                    document.getElementById('exams-active').textContent = data.exams.active || 0;
                    document.getElementById('exams-inactive').textContent = data.exams.inactive || 0;
                    document.getElementById('exams-used').textContent = data.exams.used || 0;
                    document.getElementById('exams-added').textContent = data.exams.added || 0;

                    // Update Courses
                    coursesData.completed = data.courses.completed || Array(12).fill(0);
                    coursesData.inProgress = data.courses.inProgress || Array(12).fill(0);
                    updateCoursesChart('all');

                    // Update Supervisor
                    document.getElementById('supervisor-total').textContent = data.supervisor.total || 0;
                    document.getElementById('supervisor-new').textContent = data.supervisor.new || 0;

                    // Update Students
                    document.getElementById('students-total').textContent = data.students.total || 0;
                    document.getElementById('students-new').textContent = data.students.new || 0;
                    document.getElementById('unregistered').textContent = data.students.unregistered || 0;

                    // Update Questions
                    document.getElementById('questions-total').textContent = data.questions.total || 0;
                    document.getElementById('questions-total-right').textContent = data.questions.add || 0;
                    document.getElementById('questions-feedback').textContent = data.questions.feedback || 0;

                    // Update Video Lessons
                    document.getElementById('lessons-total').textContent = data.videoLessons.total || 0;
                    document.getElementById('lessons-added').textContent = data.videoLessons.added || 0;

                    // Update Progress Bars
                    document.querySelectorAll('.progress-bar').forEach(bar => {
                        const percentage = data.questions.progress || 0;
                        bar.style.width = `${percentage}%`;
                        bar.setAttribute('aria-valuenow', percentage);
                    });
                } catch (error) {
                    console.error('Error fetching dashboard data:', error);
                }
            }

            // Subscriptions Chart
            function initializeChart1() {
                const ctx1 = document.getElementById('myChart1').getContext('2d');
                chart1 = new Chart(ctx1, {
                    type: 'doughnut',
                    data: {
                        labels: ['Active', 'Expired', 'Canceled'],
                        datasets: [{
                            data: [0, 0, 0],
                            backgroundColor: ['#6CD7A1', '#FDB022', '#E65F2B'],
                            borderWidth: 3,
                            cutout: '70%'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: true }
                        }
                    }
                });
            }

            // Exams Chart
            function initializeChart2() {
                const ctx2 = document.getElementById('myChart2').getContext('2d');
                chart2 = new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: ['Active', 'Inactive', 'Used'],
                        datasets: [{
                            data: [0, 0, 0],
                            backgroundColor: ['#21D3BB', '#E65F2B', '#6343C0'],
                            borderWidth: 3,
                            cutout: '70%'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: true }
                        }
                    }
                });
            }

            // Courses Chart
            function initializeCoursesChart() {
                const ctx = document.getElementById('coursesChart').getContext('2d');
                coursesChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: coursesData.labels,
                        datasets: [
                            {
                                label: 'Completed',
                                data: coursesData.completed,
                                backgroundColor: '#732067',
                                borderRadius: 6,
                            },
                            {
                                label: 'In Progress',
                                data: coursesData.inProgress,
                                backgroundColor: '#BF98B9',
                                borderRadius: 6,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `${context.dataset.label}: ${context.raw}`;
                                    }
                                }
                            },
                            legend: { display: false }
                        },
                        scales: {
                            x: { stacked: true, grid: { display: false } },
                            y: { stacked: true, min: 0, max: 100, ticks: { stepSize: 20 } }
                        }
                    }
                });
            }

            // Update Courses Chart based on filter
            function updateCoursesChart(filter) {
                const datasets = [];
                if (filter === 'all' || filter === 'completed') {
                    datasets.push({
                        label: 'Completed',
                        data: coursesData.completed,
                        backgroundColor: '#732067',
                        borderRadius: 6,
                    });
                }
                if (filter === 'all' || filter === 'inprogress') {
                    datasets.push({
                        label: 'In Progress',
                        data: coursesData.inProgress,
                        backgroundColor: '#BF98B9',
                        borderRadius: 6,
                    });
                }

                coursesChart.data.datasets = datasets;
                coursesChart.options.scales.x.stacked = filter === 'all';
                coursesChart.options.scales.y.stacked = filter === 'all';
                coursesChart.update();

                // Update active filter styling
                document.querySelectorAll('.filters span').forEach(span => {
                    span.classList.remove('pill'); // Remove pill class from all spans
                    if (span.id === `${filter}Filter` || (filter === 'all' && span.id === 'allCoursesFilter')) {
                        span.classList.add('pill'); // Add pill class to the selected filter
                    }
                });
            }

            // Event Listeners
            document.addEventListener('DOMContentLoaded', () => {
                initializeChart1();
                initializeChart2();
                initializeCoursesChart();

                // Initialize Flatpickr
                const datePicker = flatpickr('#dateRangePicker', {
                    mode: 'range',
                    dateFormat: 'Y-m-d',
                    onChange: (selectedDates) => {
                        if (selectedDates.length === 2) {
                            const params = `custom&start=${selectedDates[0].toISOString()}&end=${selectedDates[1].toISOString()}`;
                            fetchDashboardData(params);
                        }
                    }
                });

                // Set default to Past Week
                const today = new Date();
                const pastWeekStart = new Date(today);
                pastWeekStart.setDate(today.getDate() - 6); // 7 days including today
                datePicker.setDate([pastWeekStart, today]);
                fetchDashboardData('week');

                // Time Frame Buttons
                document.querySelectorAll('.time-frame-toggle button').forEach(button => {
                    button.addEventListener('click', () => {
                        document.querySelectorAll('.time-frame-toggle button').forEach(btn => btn.classList.remove('active'));
                        button.classList.add('active');

                        const endDate = new Date();
                        let startDate = new Date();
                        let params = '';

                        if (button.id === 'pastWeekBtn') {
                            startDate.setDate(endDate.getDate() - 6);
                            params = 'week';
                        } else if (button.id === 'past2WeeksBtn') {
                            startDate.setDate(endDate.getDate() - 13);
                            params = 'two_weeks';
                        } else if (button.id === 'pastMonthBtn') {
                            startDate.setDate(endDate.getDate() - 29);
                            params = 'month';
                        }

                        datePicker.setDate([startDate, endDate]);
                        fetchDashboardData(params);
                    });
                });

                // Courses Filter Buttons
                document.querySelectorAll('.filters span').forEach(span => {
                    span.addEventListener('click', () => {
                        const filter = span.dataset.filter;
                        updateCoursesChart(filter);
                    });
                });
            });
        </script>
         <script>
            $(document).ready(function() {
                fetchNotifications();
                // setInterval(fetchNotifications, 5000); // Fetch notifications every 5 seconds
            });
            function fetchNotifications() {
                
                $.get('/api/notifications', function(data) {
                    $('#notifications-list').empty();
                    console.log(data, 'hiefdj');
                    data.forEach(function(notification) {
                        
                        $('#notifications-list').append(
                            `<li>${notification.data.message} - <small>${notification.created_at}</small></li>`
                        );
                    });
                });
            } 
        </script>
    @endpush
</x-backend.layouts.master>
