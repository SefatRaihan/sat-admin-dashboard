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

                            <div class="pie-legend">

                                <ul style="list-style-type:none;display:flex;gap:20px;">
                                    <li id="allTimeBtn" class="active">All-Time</li>
                                    <li id="last5Btn">Last 5</li>
                                </ul>
                                <div id="toggleContent" style="margin-top:20px;">
                                    <div id="allTimeBox">
                                        <ul>
                                            <li class="verbal-correct">
                                                <span class="dot"></span>
                                                <span class="label">Verbal - Correct</span>
                                                <span class="value">700</span>
                                            </li>
                                            <li class="verbal-incorrect">
                                                <span class="dot"></span>
                                                <span class="label">Verbal - Incorrect</span>
                                                <span class="value">300</span>
                                            </li>
                                            <li class="quant-correct">
                                                <span class="dot"></span>
                                                <span class="label">Quant - Correct</span>
                                                <span class="value">800</span>
                                            </li>
                                            <li class="quant-incorrect">
                                                <span class="dot"></span>
                                                <span class="label">Quant - Incorrect</span>
                                                <span class="value">200</span>
                                            </li>
                                        </ul>
                                    </div>


                                    <div id="last5Box" style="display:none;">This is Last 5 content</div>
                                </div>


                            </div>
                            <canvas id="questionPieChart"></canvas>

                        </div>
                    </div>
                    </div>
                    <div class="col-md-8">
                        <div class="ber-chart">
                            <h3 style="margin-left: 15px;">Top 5 weakness Areas</h3>
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
                    <h3>56%</h3>
                    <div class="progress-bar">
                        <div class="progress" style="width: 56%;"></div>
                    </div>
                </div>

            </div>
            <div class="second-box">
                <p>Predicted Score</p>
                <div class="persent-info">
                    <h3>76%</h3>
                    <div class="progress-bar">
                        <div class="progress" style="width: 76%;"></div>
                    </div>
                </div>

            </div>
            </div>

            <div class="tables-container">
                <!-- Leaderboard -->
                <div class="table-card leaderboard">
                    <div class="table-header">
                        <h4>Leaderboard</h4>
                        <button class="see-more">See more</button>
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
                        <button class="see-more">See more</button>
                    </div>
                    <div class="table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Exam</th>
                                    <th>Score</th>
                                    {{-- <th>Previous</th> --}}
                                    <th>Questions</th>
                                    <th>Duration</th>
                                    <th>Date Taken</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forEach($attemptedExams as $exam)
                                    <tr>
                                        <td>{{ $exam->exam->title }}</td>
                                        <td>{{ $exam->score }}%</td>
                                        {{-- <td>{{ $exam->previous_score }}%</td> --}}
                                        <td>{{ $exam->exam->questions->count() ?? 0 }}</td>
                                        <td>{{ floor($exam->total_duration / 60) }} Mins</td>
                                        <td>{{ $exam->start_time }}</td>
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

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/student-dashboard.css') }}">
    @endpush

    @push('js')
        <script>
            const allTimeBtn = document.getElementById('allTimeBtn');
            const last5Btn = document.getElementById('last5Btn');
            const allTimeBox = document.getElementById('allTimeBox');
            const last5Box = document.getElementById('last5Box');

            allTimeBtn.addEventListener('click', () => {
                allTimeBtn.classList.add('active');
                last5Btn.classList.remove('active');
                allTimeBox.style.display = 'block';
                last5Box.style.display = 'none';
            });

            last5Btn.addEventListener('click', () => {
                last5Btn.classList.add('active');
                allTimeBtn.classList.remove('active');
                allTimeBox.style.display = 'none';
                last5Box.style.display = 'block';
            });
        </script>

        <script>
            const pieCtx = document.getElementById('questionPieChart').getContext('2d');
            new Chart(pieCtx, {
                type: 'doughnut',
                data: {

                    datasets: [{
                        data: [700, 300, 800, 200],
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

            const barCtx = document.getElementById('weaknessBarChart').getContext('2d');
            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: ['Reading', 'Correction', 'Precision', 'Geometry', 'Exponents'],
                    datasets: [{
                        data: [70, 60, 50, 40, 30],
                        backgroundColor: '#c090f0',
                        // ✅ Add barThickness for thin bars
                        barThickness: 20
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false // ✅ Remove dataset label from legend
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
        </script>
    @endpush

</x-backend.layouts.student-master>
