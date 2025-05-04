{{-- <x-backend.layouts.student-master>
    <div class="">
        <div class="header p-4">
            <div class="header-content">
                <h5 class="p-0 m-0" style="color: #344054;font-size: 20px;font-weight: 600;">Exam Name</h5>
                <div class="heading-summary d-flex justify-content-center">
                    <ul class="p-0 m-0">
                        <li style="list-style: none">Hi School</li>
                        <li id="total-section">{{ count($data) }} sections</li>
                        <li id="total-question">
                            {{ collect($data)->flatten(1)->count() }} Questions
                        </li>
                    </ul>
                </div>
            </div>

            <div class="header-pagination">
                @foreach ($data as $key => $group)
                    <div class="pagination-1">
                        <p class="text-center">{{ $key }}</p>
                        <div class="box-pagination">
                            @foreach ($group as $index => $question)
                                <span
                                    class="box question-{{ $question['id'] }}"
                                    data-question='@json($question)'
                                    style="cursor:pointer; display: inline-block; width: 24px; height: 24px; background: #ddd; margin: 2px; border-radius: 4px;"
                                ></span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="timer-container" class="mt-4">
                <h5>Countdown Timer</h5>
                <input type="number" id="timeInput" placeholder="Enter time in minutes" />
                <button onclick="startTimer()">Start</button>
                <div id="clock-wrapper" class="d-flex align-items-center gap-2">
                    <i class="fas fa-stopwatch" style="font-size: 20px;"></i>
                    <div id="clock">00:00:00</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 pl-4 pr-4" id="question-context"></div>
            <div class="col-md-6" id="question-box"></div>
        </div>

        <div class="footer m-0 p-0" style="border-top: 1px solid #ddd;">
            <div class="footer-content p-4 d-flex justify-content-between">
                <div>
                    <button type="button" class="btn btn-outline-danger">End Exam</button>
                </div>
                <div>
                    <button class="btn btn-outline-secondary mr-2">Previous</button>
                    <button type="button" class="btn btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="expiredModal" tabindex="-1" aria-labelledby="expiredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title w-100">Time Expired</h5>
                </div>
                <div class="modal-body">
                    Your time has ended.
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/student-exam.css') }}">
        <style>
            .box.active {
                background-color: #0d6efd !important;
                color: #fff;
                font-weight: bold;
            }
        </style>
    @endpush

    @push('js')
    <script>
        let timerInterval;

        function startTimer(minutes = 60) {
            clearInterval(timerInterval);
            let totalSeconds = minutes * 60;

            timerInterval = setInterval(() => {
                let hrs = Math.floor(totalSeconds / 3600);
                let mins = Math.floor((totalSeconds % 3600) / 60);
                let secs = totalSeconds % 60;

                document.getElementById("clock").innerText = `${pad(hrs)}:${pad(mins)}:${pad(secs)}`;

                if (totalSeconds <= 0) {
                    clearInterval(timerInterval);
                    document.getElementById("clock").innerText = "Time Expired!";
                    var expiredModal = new bootstrap.Modal(document.getElementById('expiredModal'));
                    expiredModal.show();
                }

                totalSeconds--;
            }, 1000);
        }

        function pad(num) {
            return num.toString().padStart(2, '0');
        }

        function renderQuestion(question) {
            const contextHTML = `
                <h4><b>Context</b></h4>
                <div><p>${question.context || 'No context provided.'}</p></div>
            `;
            document.getElementById('question-context').innerHTML = contextHTML;

            const options = Array.isArray(question.options) ? question.options : Object.values(question.options || {});
            const optionsHTML = options.map((option, idx) => `
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="question_${question.id}" value="${option}">
                    <label class="form-check-label">${option}</label>
                </div>
            `).join('');

            const questionBoxHTML = `
                <h4><b>Question</b></h4>
                <p>${question.question}</p>
                ${optionsHTML}
            `;
            document.getElementById('question-box').innerHTML = questionBoxHTML;
        }

        window.onload = () => {
            startTimer(60);

            const boxes = document.querySelectorAll('.box');

            boxes.forEach((box) => {
                box.addEventListener('click', () => {
                    boxes.forEach(b => b.classList.remove('active'));
                    box.classList.add('active');

                    const question = JSON.parse(box.dataset.question);
                    renderQuestion(question);
                });
            });

            // ✅ Load the first question box by default
            const firstBox = document.querySelector('.box');
            if (firstBox) {
                firstBox.classList.add('active');
                const firstQuestion = JSON.parse(firstBox.dataset.question);
                renderQuestion(firstQuestion);
            }
        };
    </script>
    @endpush
</x-backend.layouts.student-master> --}} 
<x-backend.layouts.student-master>
    <div class="p-4">
        <h5 style="color: #344054;font-size: 20px;font-weight: 600;">Exam Name</h5>
        <div class="d-flex justify-content-center">
            <ul class="p-0 m-0 text-center" style="list-style: none;">
                <li>Hi School</li>
                <li>{{ count($data) }} sections</li>
                <li>{{ collect($data)->flatten(1)->count() }} Questions</li>
            </ul>
        </div>

        @php $flatQuestions = collect($data)->flatten(1)->values(); @endphp

        <div class="header-pagination mt-3">
            @foreach ($data as $key => $group)
                <div class="pagination-1 mb-2">
                    <p class="text-center">{{ $key }}</p>
                    <div class="box-pagination d-flex flex-wrap gap-1">
                        @foreach ($group as $question)
                            <span class="box question-{{ $question['id'] }}"
                                  data-question='@json($question)'
                                  style="cursor:pointer; display:inline-block; width: 24px; height: 24px; background: #ddd; border-radius: 4px;">
                            </span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-3">
            <div class="col-md-6" id="question-context"></div>
            <div class="col-md-6" id="question-box"></div>
        </div>

        <div class="footer p-4 border-top mt-3 d-flex justify-content-between">
            <button id="prevBtn" class="btn-prev d-none">Previous</button>
            <div>
                <button id="nextBtn" class="btn-next">Next</button>
                <button id="submitBtn" class="btn-submit d-none">Submit</button>
            </div>
        </div>

        <div class="modal fade" id="expiredModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title w-100">Time Expired</h5>
                    </div>
                    <div class="modal-body">Your time has ended.</div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

    @push('css')
        <style>
            .box.active {
                background-color: #0d6efd !important;
                color: #fff;
            }
            .box.incomplete {
                background-color: yellow !important;
            }
        </style>
    @endpush

    @push('js')
    <script>
        let questions = @json($flatQuestions);
        let currentIndex = 0;
        let answers = {};

        function pad(n) {
            return n.toString().padStart(2, '0');
        }

        function startTimer(minutes = 60) {
            clearInterval(window.timerInterval);
            let totalSeconds = minutes * 60;

            window.timerInterval = setInterval(() => {
                let hrs = Math.floor(totalSeconds / 3600);
                let mins = Math.floor((totalSeconds % 3600) / 60);
                let secs = totalSeconds % 60;
                document.getElementById("clock").innerText = `${pad(hrs)}:${pad(mins)}:${pad(secs)}`;
                if (totalSeconds <= 0) {
                    clearInterval(window.timerInterval);
                    document.getElementById("clock").innerText = "Time Expired!";
                    new bootstrap.Modal(document.getElementById('expiredModal')).show();
                }
                totalSeconds--;
            }, 1000);
        }

        function renderQuestion(index) {
            let question = questions[index];
            document.querySelectorAll('.box').forEach(b => b.classList.remove('active'));
            document.querySelector(`.question-${question.id}`).classList.add('active');

            document.getElementById('question-context').innerHTML = `
                <h4><b>Context</b></h4>
                <p>${question.context || 'No context provided.'}</p>
            `;

            let options = Array.isArray(question.options) ? question.options : Object.values(question.options || {});
            let selected = answers[question.id] || null;

            document.getElementById('question-box').innerHTML = `
                <h4><b>Question</b></h4>
                <p>${question.question}</p>
                ${options.map(opt => `
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="question_${question.id}" value="${opt}" ${selected === opt ? 'checked' : ''}>
                        <label class="form-check-label">${opt}</label>
                    </div>
                `).join('')}
            `;

            // Hide/show navigation buttons
            document.getElementById('prevBtn').classList.toggle('d-none', index === 0);
            document.getElementById('nextBtn').classList.toggle('d-none', index === questions.length - 1);
            document.getElementById('submitBtn').classList.toggle('d-none', index !== questions.length - 1);
        }

        function saveAnswerAndColor(index) {
            let q = questions[index];
            let selectedOption = document.querySelector(`input[name="question_${q.id}"]:checked`);
            let boxEl = document.querySelector(`.question-${q.id}`);

            if (selectedOption) {
                answers[q.id] = selectedOption.value;
                boxEl.classList.remove('incomplete');
            } else {
                boxEl.classList.add('incomplete');
            }
        }

        window.onload = function () {
            startTimer(60);
            renderQuestion(currentIndex);

            document.getElementById('nextBtn').addEventListener('click', () => {
                saveAnswerAndColor(currentIndex);
                if (currentIndex < questions.length - 1) {
                    currentIndex++;
                    renderQuestion(currentIndex);
                }
            });

            document.getElementById('prevBtn').addEventListener('click', () => {
                saveAnswerAndColor(currentIndex);
                if (currentIndex > 0) {
                    currentIndex--;
                    renderQuestion(currentIndex);
                }
            });

            document.getElementById('submitBtn').addEventListener('click', () => {
                saveAnswerAndColor(currentIndex);
                alert('Exam submitted!');
                // You can POST answers here
            });

            document.querySelectorAll('.box').forEach((box, i) => {
                box.addEventListener('click', () => {
                    saveAnswerAndColor(currentIndex);
                    currentIndex = i;
                    renderQuestion(currentIndex);
                });
            });
        };
    </script>
    @endpush
</x-backend.layouts.student-master>

