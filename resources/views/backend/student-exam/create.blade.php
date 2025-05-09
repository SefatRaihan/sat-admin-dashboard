<x-backend.layouts.student-master>
    <div class="">
        <div class="header p-4">
            <div class="header-content">
                <h5 style="color: #344054;font: Inter;font-size: 20px;font-weight: 600;">Exam Name</h5>
                <div class="heading-summary d-flex justify-content-center">
                    <ul class="p-0 m-0 text-center">
                        <li id="audience" style="list-style: none">Hi School</li>
                        <li id="total-section">{{ count($data) }} sections</li>
                        <li id="total-question">{{ collect($data)->flatten(1)->count() }} Questions</li>
                    </ul>
                </div>
            </div>

            <div class="header-pagination">
                @php $flatQuestions = collect($data)->flatten(1)->values(); @endphp
                @foreach ($data as $key => $group)
                <div class="pagination-1">
                    <p class="p-0 m-0 text-center text-capitalize groupActive">{{ $key }}</p>
                    <div class="box-pagination">
                        @foreach ($group as $index => $question)
                            <span class="box question-{{ $question['id'] }}" data-question='@json($question)'></span>
                        @endforeach
                    </div>
                </div>
                @endforeach
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

        <div class="row p-4">
            <div class="col-md-6 pl-4 pr-4">
                <h4><b>Context</b></h4>
                <div id="question-context">
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4><b>Question</b></h4>
                    </div>
                    <div class="mr-3" style="color:#344054; font-size: 20px; font-weight: 400;">
                        <span class="answered-count">0</span>/<span class="total-questions">0</span>
                    </div>
                </div>
                <div class="question-box">
                    <p id="question-title" style="margin-top: 8px;"></p>
                    <div class="check-box-field">
                        <div id="question-option" class="row">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer m-0 p-0" style="border-top: 1px solid #ddd;">
            <div class="footer-content p-4">
                <div class="footer-left">
                    <button type="button" class="btn" style="width: 112px; height: 44px; border-radius: 5px; border: 1px solid #FDA29B; color: #B42318;" data-toggle="modal" data-target="#endExamdModal">End Exam</button>
                </div>
                <div class="footer-right">
                    <button type="button" id="prevBtn" class="btn btn-prev d-none mr-2" style="width: 108px; height: 44px; border-radius: 8px; border: 1px solid #A16A99; color: #521749;">Previous</button>
                    <button type="button" id="nextBtn" class="btn btn-next" style="width: 108px; height: 44px; border-radius: 8px; background: #691D5E; color: #FFFF;">Next</button>
                    <button type="button" id="submitBtn" class="btn btn-submit submit-exam d-none" style="width: 108px; height: 44px; border-radius: 8px; background: #691D5E; color: #FFFF;">Submit</button>
                </div>
            </div>
        </div>

        {{-- time over modal --}}
        <div class="modal fade" id="expiredModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center"  style="border-radius: 15px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            <img src="{{ asset('image/icon/time-out.png') }}" alt="">
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 42px;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-left">
                        <h4 class="mb-0 mt-3">Time up</h4>
                        <p>Your time is up. This is just a demo text to fill out this supporting text field. UX writer will put the appropriate text here.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- exam done modal --}}
        <div class="modal fade" id="examDoneModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="examDoneModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 15px;">
                    <div class="modal-body text-center exam-done-modal">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('image/icon/exam-done.png') }}" alt="">
                        </div>
                        <h4 class="mb-0 mt-3">Exam completed</h4>
                        <p>The test has been completed successfully.</p>
                    </div>
                </div>
            </div>
        </div>  

        {{-- end exam modal --}}
        <div class="modal fade" id="endExamdModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center"  style="border-radius: 15px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            <img src="{{ asset('image/icon/end-exam.png') }}" alt="">
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 42px;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-left">
                        <h4 class="mb-0 mt-3">End exam</h4>
                        <p>In case of completion of the test, the questions that were not answered by mistake will be counted.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn submit-exam" style="background-color:#D92D20 ;border-radius: 8px; color:#fff">End Exam</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/student-exam.css') }}">
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
                    $('#clock').text(`${pad(hrs)}:${pad(mins)}:${pad(secs)}`);
                    if (totalSeconds <= 0) {
                        clearInterval(window.timerInterval);
                        $('#clock').text("Time Expired!");
                        $('#expiredModal').modal('show');
                        submitExam(); // Auto-submit when time expires
                    }
                    totalSeconds--;
                }, 1000);
            }

            function updateAnsweredCount() {
                let answeredCount = Object.keys(answers).length;
                $('.answered-count').text(answeredCount);
                $('.total-questions').text(questions.length);
            }

            function renderQuestion(index) {
                let question = questions[index];
                $('.box').removeClass('active');
                $(`.question-${question.id}`).addClass('active');

                $('#question-context').html(`
                    <p>${question.context || 'No context provided.'}</p>
                `);

                let options = Array.isArray(question.options) ? question.options : Object.values(question.options || {});
                let selected = answers[question.id] || null;
                $('#question-title').html(`${question.question}`);
                $('#question-option').html(
                    options.map((opt, i) => `
                        <div class="col-md-12 mt-2">
                            <div class="form-check custom-radio" onclick="selectOption('question_${question.id}_${i}', '${opt}', ${question.id})">
                                <input class="form-check-input" type="radio" name="question_${question.id}" id="question_${question.id}_${i}" value="${opt}" ${selected === opt ? 'checked' : ''}>
                                <label class="form-check-label" for="question_${question.id}_${i}">
                                    ${opt}
                                </label>
                            </div>
                        </div>
                    `).join('')
                );

                $('#prevBtn').toggleClass('d-none', index === 0);
                $('#nextBtn').toggleClass('d-none', index === questions.length - 1);
                $('#submitBtn').toggleClass('d-none', index !== questions.length - 1);

                updateAnsweredCount();
            }

            function selectOption(inputId, option, questionId) {
                $(`#${inputId}`).prop('checked', true);
                answers[questionId] = option;
                $(`.question-${questionId}`).removeClass('incomplete').addClass('completed');
                updateAnsweredCount();
            }

            function saveAnswerAndColor(index) {
                let q = questions[index];
                let selectedOption = $(`input[name="question_${q.id}"]:checked`).val();
                let boxEl = $(`.question-${q.id}`);

                if (selectedOption) {
                    answers[q.id] = selectedOption;
                    boxEl.removeClass('incomplete').addClass('completed');
                } else {
                    boxEl.addClass('incomplete');
                }
                updateAnsweredCount();
            }

            // function submitExam() {
            //     saveAnswerAndColor(currentIndex);

            //     // need all quedtion ids and his answer
                
              

            //     $.ajax({
            //         url: '/student-exams', // Replace with your actual endpoint
            //         type: 'POST',
            //         data: JSON.stringify(submissionData),
            //         contentType: 'application/json',
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
            //         },
            //         success: function (response) {
            //             alert('Exam submitted successfully!');
            //             window.location.href = '/exam-result'; // Redirect to result page or another page
            //         },
            //         error: function (xhr) {
            //             alert('Error submitting exam: ' + (xhr.responseJSON?.message || 'Unknown error'));
            //         }
            //     });
            // }

            function submitExam() {
                saveAnswerAndColor(currentIndex);
                let q = questions[currentIndex];
                let selectedOption = $(`input[name="question_${q.id}"]:checked`).val();
                if (selectedOption) answers[q.id] = selectedOption;

                
                let submissionData = questions.map(q => ({
                    question_id: q.id,
                    answer: answers[q.id] ?? null
                }));

                $.ajax({
                    url: '/student-exams',
                    type: 'POST',
                    data: JSON.stringify({ responses: submissionData }),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function () {
                        alert('Exam submitted successfully!');
                        window.location.href = '/exam-result';
                    },
                    error: function (xhr) {
                        alert('Error submitting exam: ' + (xhr.responseJSON?.message || 'Unknown error'));
                    }
                });
}


            $(document).ready(function () {
                startTimer(60);
                renderQuestion(currentIndex);

                $('#nextBtn').on('click', function () {
                    saveAnswerAndColor(currentIndex);
                    if (currentIndex < questions.length - 1) {
                        currentIndex++;
                        renderQuestion(currentIndex);
                    }
                });

                $('#prevBtn').on('click', function () {
                    saveAnswerAndColor(currentIndex);
                    if (currentIndex > 0) {
                        currentIndex--;
                        renderQuestion(currentIndex);
                    }
                });

                $('#submitBtn').on('click', function () {
                    if (confirm('Are you sure you want to submit the exam?')) {
                        submitExam();
                    }
                });

                $('.box').on('click', function () {
                    saveAnswerAndColor(currentIndex);
                    currentIndex = $(this).index('.box');
                    renderQuestion(currentIndex);
                });

                // End Exam button functionality
                $('.submit-exam').filter(':contains("End Exam")').on('click', function () {
                    if (confirm('Are you sure you want to end the exam?')) {
                        submitExam();
                    }
                });

                $('.total-questions').text(questions.length);
            });
        </script>
    @endpush
</x-backend.layouts.student-master>