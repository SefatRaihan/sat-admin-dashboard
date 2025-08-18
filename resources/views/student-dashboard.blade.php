<x-backend.layouts.student-master>
    <div class="dashboard">
        <div class="header">
            <h2 style="font-size: 44px">My SAT Dashboard</h2>
        </div>
        <div class="container">
            <div class="chart-box">
                <div class="row">
                    <div class="col-md-4">
                        <div class="pie-chart">
                            <div class="pie-header">
                                <h3>Question Distribution</h3>
                                <p>Combined</p>
                            </div>
                            <div class="pie-content">
                                <div class="pie-legend" style="padding-left: 16px;">
                                    <ul style="list-style-type:none;display:flex;gap:20px;">
                                        <li id="allTimeBtn" class="active">All-Time</li>
                                        <li id="last5Btn">Last 5</li>
                                    </ul>
                                    <div id="toggleContent" style="margin-top:20px;">
                                        <div id="allTimeBox">
                                            <ul>
                                                @foreach ($categories as $index => $category)
                                                    <li class="{{ strtolower($category) }}-correct">
                                                        <span class="dot"></span>
                                                        <span class="label">{{ $category }} - Correct</span>
                                                        <span class="value" id="{{ strtolower($category) }}-correct-all">{{ $questionDistribution['allTime'][$category.'_Correct'] ?? 0 }}</span>
                                                    </li>
                                                    <li class="{{ strtolower($category) }}-incorrect">
                                                        <span class="dot"></span>
                                                        <span class="label">{{ $category }} - Incorrect</span>
                                                        <span class="value" id="{{ strtolower($category) }}-incorrect-all">{{ $questionDistribution['allTime'][$category.'_Incorrect'] ?? 0 }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div id="last5Box" style="display:none;">
                                            <ul>
                                                @foreach ($categories as $index => $category)
                                                    <li class="{{ strtolower($category) }}-correct">
                                                        <span class="dot"></span>
                                                        <span class="label">{{ $category }} - Correct</span>
                                                        <span class="value" id="{{ strtolower($category) }}-correct-last5">{{ $questionDistribution['last5'][$category.'_Correct'] ?? 0 }}</span>
                                                    </li>
                                                    <li class="{{ strtolower($category) }}-incorrect">
                                                        <span class="dot"></span>
                                                        <span class="label">{{ $category }} - Incorrect</span>
                                                        <span class="value" id="{{ strtolower($category) }}-incorrect-last5">{{ $questionDistribution['last5'][$category.'_Incorrect'] ?? 0 }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <canvas id="questionPieChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="ber-chart">
                            <h3 style="margin-left: 15px;">Top 5 Weakness Areas</h3>
                            <canvas id="weaknessBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="persent-box">
                <div class="first-box">
                    <p>Courses Completed</p>
                    <div class="persent-info">
                        <h3>{{ $coursesCompleted }}%</h3> <!-- Placeholder; update dynamically if needed -->
                        <div class="progress-bar">
                            <div class="progress" style="width: {{ $coursesCompleted }}%;"></div>
                        </div>
                    </div>
                </div>
                <div class="second-box">
                    <p>Predicted Score</p>
                    <div class="persent-info">
                        <h3>{{ $predictedScore }}%</h3> <!-- Placeholder; update dynamically if needed -->
                        <div class="progress-bar">
                            <div class="progress" style="width: {{ $predictedScore }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tables-container">
                <!-- Leaderboard -->
                <div class="table-card leaderboard">
                    <div class="table-header">
                        <h4>Leaderboard</h4>
                    </div>
                    <div class="table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Exam</th>
                                    <th>Student</th>
                                    <th>Rank +/-</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leadBoard as $index => $data)
                                    <tr>
                                        <td><img src="{{ $data['profile_image'] }}" alt="student" width="40" height="40"></td>
                                        <td>{{ $data['user_name'] }}</td>
                                        <td></td>
                                        {{-- <td class="{{ $attempt->rank_change > 0 ? 'positive' : 'negative' }}">
                                            {{ $attempt->rank_change }}
                                            <span class="rank-change-icon">
                                                @if($attempt->rank_change > 0)
                                                    <i class="fas fa-arrow-up"></i>
                                                @else
                                                    <i class="fas fa-arrow-down"></i>
                                                @endif
                                            </span>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Last 5 Exams -->
                <div class="table-card last-exams">
                    <div class="table-header">
                        <h4>Last 5 Exams</h4>
                    </div>
                    <div class="table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Exam</th>
                                    <th>Score</th>
                                    <th>Questions</th>
                                    <th>Duration</th>
                                    <th>Date Taken</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attemptedExams as $exam)
                                    <tr>
                                        <td>{{ $exam->exam->title }}</td>
                                        <td>{{ $exam->correct_answers }}/{{ $exam->exam->questions->count() }} ({{ round(($exam->correct_answers / $exam->exam->questions->count()) * 100) }}%)</td>
                                        <td>{{ $exam->exam->questions->count() ?? 0 }}</td>
                                        <td>{{ floor((strtotime($exam->end_time) - strtotime($exam->start_time)) / 60) }} Mins</td>
                                        <td>{{ $exam->start_time->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                                <tr>

                                </tr>
                                <!-- আরও rows copy করবে -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/student-dashboard.css') }}">
        <style>
            .pie-legend ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .pie-legend li {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 10px;
            }
            .pie-legend .dot {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                display: inline-block;
            }
            .pie-legend .verbal-correct .dot,
            .pie-legend .math-correct .dot { background-color: #6c247e; }
            .pie-legend .verbal-incorrect .dot,
            .pie-legend .math-incorrect .dot { background-color: #c490d1; }
            .pie-legend .quant-correct .dot,
            .pie-legend .physics-correct .dot { background-color: #3f8efc; }
            .pie-legend .quant-incorrect .dot,
            .pie-legend .physics-incorrect .dot { background-color: #90caf9; }
            .pie-legend .biology-correct .dot { background-color: #4CAF50; }
            .pie-legend .biology-incorrect .dot { background-color: #81C784; }
            .pie-legend .chemistry-correct .dot { background-color: #FF9800; }
            .pie-legend .chemistry-incorrect .dot { background-color: #FFB74D; }
            .pie-legend .label { flex-grow: 1; }
            .pie-legend .value { font-weight: bold; }
            .pie-legend li.active { font-weight: bold; cursor: pointer; }
            .progress-bar {
                background-color: #e0e0e0;
                border-radius: 25px;
                overflow: hidden;
            }
            .progress {
                background-color: #6c247e;
                height: 10px;
                transition: width 0.3s ease;
            }
            .table-card {
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                padding: 15px;
            }
            .table-header h4 {
                margin: 0;
                font-size: 18px;
            }
            .table-content table {
                width: 100%;
                border-collapse: collapse;
            }
            .table-content th, .table-content td {
                padding: 10px;
                text-align: left;
            }
            .table-content th {
                background-color: #f4f4f4;
                font-weight: bold;
            }
            ::-webkit-scrollbar {
                display: none;
            }

            p img {
                width: 100% !important;
            }
        </style>
    @endpush

@push('js')
    <!-- Include Chart.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize data from Blade
        const questionDistribution = {
            allTime: @json($questionDistribution['allTime']),
            last5: @json($questionDistribution['last5'])
        };
        const categories = @json($categories);
        const weaknessAreas = @json($weaknessAreas);

        // Pie Chart
        const pieCtx = document.getElementById('questionPieChart').getContext('2d');
        const questionPieChart = new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: categories.flatMap(cat => [`${cat} - Correct`, `${cat} - Incorrect`]).slice(0, 4), // Limit to first two categories for pie
                datasets: [{
                    data: [
                        questionDistribution.allTime[`${categories[0]}_Correct`] ?? 0,
                        questionDistribution.allTime[`${categories[0]}_Incorrect`] ?? 0,
                        questionDistribution.allTime[`${categories[1]}_Correct`] ?? 0,
                        questionDistribution.allTime[`${categories[1]}_Incorrect`] ?? 0
                    ],
                    backgroundColor: ['#6c247e', '#c490d1', '#3f8efc', '#90caf9'],
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Bar Chart
        const barCtx = document.getElementById('weaknessBarChart').getContext('2d');
        const weaknessBarChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: weaknessAreas.map(area => area.topic_id ? `${area.name} - ${area.topic_id}` : area.name),
                datasets: [{
                    data: weaknessAreas.map(area => area.incorrect_count ?? 0),
                    backgroundColor: '#c090f0',
                    barThickness: 20
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Toggle All-Time/Last 5
        const allTimeBtn = document.getElementById('allTimeBtn');
        const last5Btn = document.getElementById('last5Btn');
        const allTimeBox = document.getElementById('allTimeBox');
        const last5Box = document.getElementById('last5Box');

        allTimeBtn.addEventListener('click', () => {
            allTimeBtn.classList.add('active');
            last5Btn.classList.remove('active');
            allTimeBox.style.display = 'block';
            last5Box.style.display = 'none';
            questionPieChart.data.datasets[0].data = categories.flatMap(cat => [
                questionDistribution.allTime[`${cat}_Correct`] ?? 0,
                questionDistribution.allTime[`${cat}_Incorrect`] ?? 0
            ]).slice(0, 4);
            questionPieChart.update();
        });

        last5Btn.addEventListener('click', () => {
            last5Btn.classList.add('active');
            allTimeBtn.classList.remove('active');
            allTimeBox.style.display = 'none';
            last5Box.style.display = 'block';
            questionPieChart.data.datasets[0].data = categories.flatMap(cat => [
                questionDistribution.last5[`${cat}_Correct`] ?? 0,
                questionDistribution.last5[`${cat}_Incorrect`] ?? 0
            ]).slice(0, 4);
            questionPieChart.update();
        });
    </script>
@endpush
</x-backend.layouts.student-master>
