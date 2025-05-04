<x-backend.layouts.student-master>
    <div class="header p-2" style="border-bottom: 1px solid #ddd">
        <div class="header-content">
            <h5 class="p-0 m-0" style="color: #344054;font: Inter;font-size: 20px;font-weight: 600;">Exam Name</h5>
            <div class="heading-summary d-flex justify-content-center">
                <ul class="p-0 m-0">
                    <li id="audience" style="list-style: none">Hi School</li>
                    <li id="total-section">4 sections</li>
                    <li id="total-question">80 Questions</li>
                </ul>
            </div>
        </div>
        <div id="timer-container">
            <h2>Digital Countdown Timer</h2>
            <input type="number" id="timeInput" placeholder="Enter time in minutes" />
            <button onclick="startTimer()">Start</button>
            <div id="clock-wrapper" style="display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-stopwatch" style="font-size: 20px; "></i>
                <div id="clock">00:00:00</div>
            </div>
        </div>
    </div>

    <div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 exam-card">
                <h4 class="exam-title">Stress Endurance Test for Student (SAT 2)</h4>
                <div class="d-flex">
                    <p class="card-text"><i class="fas fa-th-large"></i> Section <span class="card-text-value">4</span></p>
                    <p class="card-text ml-4"><i class="fas fa-file-alt"></i> Question <span class="card-text-value">80</span></p>
                    <p class="card-text ml-4"><i class="fas fa-clock"></i> Duration <span class="card-text-value">1hr 15min</span></p>
                </div>
                <p class="mt-4" style="color:#344054">
                    Mubhir’s "Full Test" section provides an immersive experience that closely resembles the actual examination, challenging your expertise with a vast collection of questions and exams.
                    <br>
                    <br>
                    It encompasses both quantitative and verbal assessments, aimed at enhancing students' time management skills, familiarizing them with the question distribution, and equipping them for the various challenges posed by the real test. Additionally, this section provides detailed analytical reports on students' performance, enabling them to pinpoint effective strategies for improving their outcomes.
                </p>
            </div>
        </div>
    </div>

    <div class="footer m-0 p-0" style="border-top: 1px solid #ddd; bottom: 0; position: fixed; width: 100%; left: 0; background: #fff;">
        <div class="footer-content p-4">
            <div class="footer-left">
            </div>
            <div class="footer-right">
                
                <a href="/full-tests/create" class="btn mr-2" style="width: 108px; height: 44px; border-radius: 8px; border: 1px solid #A16A99; color: #521749; padding: 11px .875rem !important;">Cancel</a>
                <a href="/student-exams/create" type="button" class="btn" style="width: 108px; height: 44px; border-radius: 8px; background: #691D5E; color: #FFFF; padding: 11px .875rem !important;">Start Exam</a>
            </div>
        </div>
    </div>

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/student-exam.css') }}">
    @endpush
</x-backend.layouts.student-master>