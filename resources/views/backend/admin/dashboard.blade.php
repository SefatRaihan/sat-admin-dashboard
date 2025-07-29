<x-backend.layouts.master>
    <x-slot name="page_title">
        Admin Dashboard
    </x-slot>

        <div class="dashboard-container">
        <div class="header">
            <h1>Admin Dashboard</h1>
            <div class="header-controls">
                <div class="time-frame-toggle">
                    <button id="pastWeekBtn">Past week</button>
                    <button id="past2WeeksBtn">Past 2 weeks</button>
                    <button id="pastMonthBtn">Past Month</button>
                </div>
                <input type="text" id="dateRangePicker" class="date-range" placeholder="Select Date Range">
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">

            </div>
            <div class="col-md-4">
                
            </div>
        </div>

        <div class="card exam">
            <div class="card-header">
                <h3>Exam</h3>
                <a href="#" class="see-more">See more <i class="arrow-right"></i></a>
            </div>
            <div class="exam-overview">
                <div class="exam-chart-container">
                    <div class="exam-chart-center-text">
                        Total Exam
                        <span class="total">160</span>
                    </div>
                </div>
                <div class="exam-stats">
                    <div class="exam-stat-item active">
                        <span class="exam-stat-value">120</span> Exams Active
                    </div>
                    <div class="exam-stat-item inactive">
                        <span class="exam-stat-value">12</span> Exams Inactive
                    </div>
                    <div class="exam-stat-item used">
                        <span class="exam-stat-value">85</span> Exam Used in courses
                    </div>
                    <div class="exam-stat-item added">
                        <span class="exam-stat-value">40</span> Exams added
                    </div>
                </div>
            </div>
        </div>

        <div class="card questions">
            <div class="card-header">
                <h3>Questions</h3>
                <a href="#" class="see-more">See more <i class="arrow-right"></i></a>
            </div>
            <div class="summary-card-stats">
                <div class="summary-stat-item">
                    <span>Total Questions</span>
                    <span class="summary-stat-value">1440</span>
                </div>
                <div class="summary-stat-item">
                    <span>Questions Added</span>
                    <span class="summary-stat-value summary-stat-added">160</span>
                </div>
                <div class="summary-stat-item">
                    <span>Questions with Feedback</span>
                    <span class="summary-stat-value">20</span>
                </div>
            </div>
        </div>

        <div class="card courses">
            <div class="card-header">
                <h3>Courses</h3>
                <div class="courses-chart-controls">
                    <div class="legend-item completed">Completed</div>
                    <div class="legend-item in-progress">In Progress</div>
                </div>
            </div>
            <div class="chart-container">
                <div class="bar-chart">
                    <div class="bar-wrapper">
                        <div class="bar completed" style="height: 35%;">
                            <span class="tooltip">Completed: 35</span>
                        </div>
                        <div class="bar" style="height: 45%;">
                            <span class="tooltip">In Progress: 45</span>
                        </div>
                        <div class="bar-label">Jan</div>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar completed" style="height: 40%;">
                            <span class="tooltip">Completed: 40</span>
                        </div>
                        <div class="bar" style="height: 35%;">
                            <span class="tooltip">In Progress: 35</span>
                        </div>
                        <div class="bar-label">Feb</div>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar completed" style="height: 25%;">
                            <span class="tooltip">Completed: 25</span>
                        </div>
                        <div class="bar" style="height: 55%;">
                            <span class="tooltip">In Progress: 55</span>
                        </div>
                        <div class="bar-label">Mar</div>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar completed" style="height: 60%;">
                            <span class="tooltip">Completed: 60</span>
                        </div>
                        <div class="bar" style="height: 85%;">
                            <span class="tooltip">In Progress: 85</span>
                        </div>
                        <div class="bar-label">Apr</div>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar completed" style="height: 30%;">
                            <span class="tooltip">Completed: 30</span>
                        </div>
                        <div class="bar" style="height: 40%;">
                            <span class="tooltip">In Progress: 40</span>
                        </div>
                        <div class="bar-label">May</div>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar completed" style="height: 20%;">
                            <span class="tooltip">Completed: 20</span>
                        </div>
                        <div class="bar" style="height: 35%;">
                            <span class="tooltip">In Progress: 35</span>
                        </div>
                        <div class="bar-label">Jun</div>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar completed" style="height: 35%;">
                            <span class="tooltip">Completed: 35</span>
                        </div>
                        <div class="bar" style="height: 48%;">
                            <span class="tooltip">In Progress: 48</span>
                        </div>
                        <div class="bar-label">Jul</div>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar completed" style="height: 28%;">
                            <span class="tooltip">Completed: 28</span>
                        </div>
                        <div class="bar" style="height: 55%;">
                            <span class="tooltip">In Progress: 55</span>
                        </div>
                        <div class="bar-label">Aug</div>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar completed" style="height: 30%;">
                            <span class="tooltip">Completed: 30</span>
                        </div>
                        <div class="bar" style="height: 45%;">
                            <span class="tooltip">In Progress: 45</span>
                        </div>
                        <div class="bar-label">Sep</div>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar completed" style="height: 25%;">
                            <span class="tooltip">Completed: 25</span>
                        </div>
                        <div class="bar" style="height: 50%;">
                            <span class="tooltip">In Progress: 50</span>
                        </div>
                        <div class="bar-label">Oct</div>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar completed" style="height: 40%;">
                            <span class="tooltip">Completed: 40</span>
                        </div>
                        <div class="bar" style="height: 95%;">
                            <span class="tooltip">In Progress: 95</span>
                        </div>
                        <div class="bar-label">Nov</div>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar completed" style="height: 35%;">
                            <span class="tooltip">Completed: 35</span>
                        </div>
                        <div class="bar" style="height: 55%;">
                            <span class="tooltip">In Progress: 55</span>
                        </div>
                        <div class="bar-label">Dec</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card video-lessons">
            <div class="card-header">
                <h3>Video Lessons</h3>
                <a href="#" class="see-more">See more <i class="arrow-right"></i></a>
            </div>
            <div class="summary-card-stats">
                <div class="summary-stat-item">
                    <span>Total Lessons</span>
                    <span class="summary-stat-value">200</span>
                </div>
                <div class="summary-stat-item">
                    <span>Lessons Added</span>
                    <span class="summary-stat-value summary-stat-added">80</span>
                </div>
            </div>
        </div>

        <div class="card subscriptions">
            <div class="card-header">
                <h3>Subscriptions</h3>
                <a href="#" class="see-more">See more <i class="arrow-right"></i></a>
            </div>
            <div class="subscriptions-overview">
                <div class="subscriptions-chart-container">
                    <div class="subscriptions-chart-center-text">
                        Total
                        <span class="total">1200</span>
                    </div>
                </div>
                <div class="subscription-stats">
                    <div class="subscription-stat-item active">
                        <span class="subscription-stat-value">1000</span> Active
                    </div>
                    <div class="subscription-stat-item expired">
                        <span class="subscription-stat-value">80</span> Expired
                    </div>
                    <div class="subscription-stat-item canceled">
                        <span class="subscription-stat-value">20</span> Canceled
                    </div>
                </div>
            </div>
        </div>

        <div class="card supervisor">
            <div class="card-header">
                <h3>Supervisor</h3>
                <a href="#" class="see-more">See more <i class="arrow-right"></i></a>
            </div>
            <div class="user-card-stats">
                <div class="user-stat-item">
                    <span class="user-stat-value">06</span>
                    <span class="user-stat-label">Total Supervisor</span>
                </div>
                <div class="user-stat-item">
                    <span class="user-stat-value">02</span>
                    <span class="user-stat-label">Newly registered</span>
                </div>
            </div>
        </div>

        <div class="card students">
            <div class="card-header">
                <h3>Students</h3>
                <a href="#" class="see-more">See more <i class="arrow-right"></i></a>
            </div>
            <div class="user-card-stats">
                <div class="user-stat-item">
                    <span class="user-stat-value">1200</span>
                    <span class="user-stat-label">Total Students</span>
                </div>
                <div class="user-stat-item">
                    <span class="user-stat-value">250</span>
                    <span class="user-stat-label">Newly registered</span>
                </div>
                <div class="user-stat-item">
                    <span class="user-stat-value">580</span>
                    <span class="user-stat-label">Unregistered</span>
                </div>
            </div>
        </div>
    </div>

    @push('css')
            <style>
        :root {
            --primary-color: #732067; /* A deep purple */
            --secondary-color: #ff9900; /* An orange for accents */
            --text-color-dark: #101828;
            --text-color-light: #666;
            --background-color: #f4f7f6;
            --card-background: #fff;
            --border-color: #e0e0e0;
            --success-color: #4CAF50;
            --info-color: #2196F3;
            --warning-color: #FFC107;
            --danger-color: #F44336;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: var(--background-color);
            color: var(--text-color-dark);
            line-height: 1.6;
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
            padding: 8px 15px;
            border: 1px solid var(--border-color) !important;
            border-radius: 8px;
            background-color: var(--card-background) !important;
            font-size: 14px;
            color: var(--text-color-light);
            height: 48px; 
        }

        .card {
            background-color: var(--card-background);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
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
            height: 180px; /* Adjust as needed for the chart height */
            margin-top: 20px;
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
    </style>
    @endpush

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const datePickerInput = document.getElementById('dateRangePicker');
            const timeFrameButtons = document.querySelectorAll('.time-frame-toggle button');

            // Function to format Date object to DD/MM/YYYY
            function formatDate(date) {
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
                const year = date.getFullYear();
                return `${day}/${month}/${year}`;
            }

            // Get today's date
            const today = new Date();
            // Get date from image (June 11 - June 18, 2025)
            const defaultStartDate = new Date('2025-06-11T00:00:00'); // Use ISO 8601 for reliable parsing
            const defaultEndDate = new Date('2025-06-18T23:59:59');

            // Initialize Flatpickr
            const fp = flatpickr(datePickerInput, {
                mode: "range",
                dateFormat: "d/m/Y",
                defaultDate: [defaultStartDate, defaultEndDate], // Set initial dates from image
                onReady: function(selectedDates, dateStr, instance) {
                    // Set 'Past week' button as active if default dates match roughly
                    const oneWeekAgo = new Date(today);
                    oneWeekAgo.setDate(today.getDate() - 7);
                    if (selectedDates[0] && selectedDates[1] &&
                        selectedDates[0].getDate() === defaultStartDate.getDate() &&
                        selectedDates[0].getMonth() === defaultStartDate.getMonth() &&
                        selectedDates[0].getFullYear() === defaultStartDate.getFullYear() &&
                        selectedDates[1].getDate() === defaultEndDate.getDate() &&
                        selectedDates[1].getMonth() === defaultEndDate.getMonth() &&
                        selectedDates[1].getFullYear() === defaultEndDate.getFullYear()) {
                        document.getElementById('pastWeekBtn').classList.add('active'); // Based on image
                    }
                },
                onChange: function(selectedDates, dateStr, instance) {
                    // Remove active class from all time frame buttons when a date is manually selected
                    timeFrameButtons.forEach(btn => btn.classList.remove('active'));
                    console.log("Selected Date Range:", dateStr);
                    // *** Call your data fetching function here ***
                    // Example: fetchDataForDateRange(selectedDates[0], selectedDates[1]);
                }
            });

            // Add functionality for the "Past week", "Past 2 weeks", "Past Month" buttons
            timeFrameButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    timeFrameButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to the clicked button
                    this.classList.add('active');

                    let startDate, endDate = new Date(today); // Always relative to current 'today'

                    if (this.id === 'pastWeekBtn') {
                        startDate = new Date(today);
                        startDate.setDate(today.getDate() - 7);
                    } else if (this.id === 'past2WeeksBtn') {
                        startDate = new Date(today);
                        startDate.setDate(today.getDate() - 14);
                    } else if (this.id === 'pastMonthBtn') {
                        startDate = new Date(today);
                        startDate.setMonth(today.getMonth() - 1);
                    }

                    // For range end date, ensure it's end of today for full day coverage
                    endDate.setHours(23, 59, 59, 999);
                    startDate.setHours(0, 0, 0, 0);


                    // Update the Flatpickr instance's selected dates
                    fp.setDate([startDate, endDate]);

                    // Trigger data refresh based on the new date range
                    // Example: fetchDataForDateRange(startDate, endDate);
                    console.log(`Set date range to: ${formatDate(startDate)} - ${formatDate(endDate)}`);
                });
            });

            // Set the default "Past week" button to active on load based on the image example
            // If you want the "Past week" to literally be "the last 7 days from TODAY", uncomment this:
            // document.getElementById('pastWeekBtn').click(); // This will trigger the default for "Past week"
            // If you want the image's specific date range (11/06/2025 - 18/06/2025) to be the default:
            // The `defaultDate` in flatpickr config already handles this.
            // The `onReady` callback tries to make the 'Past week' button active if the default matches the image.
        });
    </script>
    @endpush

</x-backend.layouts.master>