<x-backend.layouts.student-master>
    <div class="header p-2" style="border-bottom: 1px solid #ddd">
        <div class="header-content">
            <h5 class="p-0 m-0" style="color: #344054;font: Inter;font-size: 20px;font-weight: 600;">{{ $exam->title }}</h5>
            <div class="heading-summary d-flex justify-content-center">
                <ul class="p-0 m-0">
                    <li id="audience" style="list-style: none">{{ $exam->sections[0]->audience }}</li>
                    <li id="total-section">{{ $exam->section }} sections</li>
                    <li id="total-question">{{ $exam->questions->count() }} Questions</li>
                </ul>
            </div>
        </div>
        <div id="timer-container">
            <div class="d-none">
                <input type="number" id="timeInput" placeholder="Enter time in minutes" />
                <button onclick="startTimer()">Start</button>
            </div>
            <div id="clock-wrapper" style="display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-stopwatch" style="font-size: 20px; "></i>
                <div id="clock">00:00:00</div>
            </div>
        </div>
    </div>

    <div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 exam-card">
                <h4 class="exam-title">{{ $exam->title }} ({{ $exam->sections[0]->audience }})</h4>
                <div class="d-flex">
                    <p class="card-text"><i class="fas fa-th-large"></i> Section <span class="card-text-value">{{ $exam->section }}</span></p>
                    <p class="card-text ml-4"><i class="fas fa-file-alt"></i> Question <span class="card-text-value">{{ $exam->questions->count() }}</span></p>
                    <p class="card-text ml-4"><i class="fas fa-clock"></i> Duration <span class="card-text-value">{{ $exam->formatted_duration }}</span></p>
                </div>
                <p class="mt-4" style="color:#344054">
                    {{ $exam->description }}
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
                <a href="{{ route('student-exam.start', $exam->id) }}" type="button" class="btn" style="width: 108px; height: 44px; border-radius: 8px; background: #691D5E; color: #FFFF; padding: 11px .875rem !important;">Start Exam</a>
            </div>
        </div>
    </div>

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/student-exam.css') }}">
    @endpush
</x-backend.layouts.student-master>