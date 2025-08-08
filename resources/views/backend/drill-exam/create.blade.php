<x-backend.layouts.student-master>
    <div class="">
        <div class="header p-2">
            {{-- <div class="header-content">
                <h5 style="color: #344054;font: Inter;font-size: 20px;font-weight: 600;">{{ $exam->title }}</h5>
                <div class="heading-summary d-flex justify-content-center">
                    <ul class="p-0 m-0 text-center">
                        <li id="audience" style="list-style: none">{{ $exam->sections[0]->audience  }}</li>
                        <li id="total-section">{{ $exam->sections->count() }} sections</li>
                        <li id="total-question">{{ collect($exam->duration)->flatten(1)->count() }} Questions</li>
                    </ul>
                </div>
            </div> --}}

            <div class="header-pagination">
                <div class="pagination-1">

                    <p class="topic-title p-0 m-0 text-center text-capitalize"></p>
                    <div class="box-pagination question-topic">
                    </div>
                </div>
            </div>

            <div id="timer-container">
                {{-- <div class="d-none">
                    <input type="number" id="timeInput" placeholder="Enter time in minutes" />
                    <button onclick="startTimer()">Start</button>
                </div> --}}
                <div id="clock-wrapper" style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-stopwatch" style="font-size: 20px; "></i>
                    <div id="clock">00:00:00</div>
                </div>
            </div>
        </div>

        <div class="row p-4">
            <div class="col-md-6 pl-4 pr-4">
                <h4><b>Context</b></h4>
                <div class="card p-2" style="border-radius: 25px">
                    <div id="question-context">

                    </div>
                </div>
                {{-- <h4><b>Explanation</b></h4>
                <div id="question-explanation" style="padding-bottom:100px">

                </div> --}}
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

        <div class="footer m-0 p-0" style="border-top: 1px solid #ddd; bottom: 0; position: fixed; width: 100%; left: 0; background: #fff;">
            <div class="footer-content p-4">
                <div class="footer-left">
                    <button type="button" class="btn" style="width: 112px; height: 44px; border-radius: 25px; border: 1px solid #FDA29B; color: #B42318;" data-toggle="modal" data-target="#endExamModal">End Exam</button>
                </div>
                <div class="footer-right">
                    <button type="button" id="prevBtn" class="btn btn-prev d-none mr-2" style="width: 108px; height: 44px; border-radius: 25px; border: 1px solid #A16A99; color: #521749;">Previous</button>
                    <button type="button" id="nextBtn" class="btn btn-next" style="width: 108px; height: 44px; border-radius: 25px; background: #691D5E; color: #FFFF;">Next</button>
                    <button type="button" id="submitBtn" class="btn btn-submit submit-exam d-none" style="width: 108px; height: 44px; border-radius: 25px; background: #691D5E; color: #FFFF;">Submit</button>
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
        <div class="modal fade" id="endExamModal" tabindex="-1">
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
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal" style="border: 1px solid #D0D5DD; border-radius: 25px;" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn submit-exam" style="background-color:#D92D20 ; border-radius: 25px; color:#fff">End Exam</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/student-exam.css') }}">
    @endpush

    {{-- let examAttempt = @json($examAttempt);
    let exam = @json($exam); --}}
    {{-- let questions = @json($flatQuestions); --}}
    @push('js')
        <script>
            let currentIndex = 0;
            let answers = {};
            let timeTracking = {}; // { [question_id]: seconds }
            let questionStartTime = Date.now();
            let getSessionData = JSON.parse(sessionStorage.getItem('drill_exam_data'))
            let questions = getSessionData.questions;


            function pad(n) {
                return n.toString().padStart(2, '0');
            }

            function startTimer(minutes) {
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
                            setTimeout(() => {
                                $('#expiredModal').modal('hide'); // Optional: hide modal after showing
                                    $('#submitBtn').trigger('click');
                            }, 3000)
                    }
                    totalSeconds--;
                }, 1000);
            }

            function updateAnsweredCount() {
                let answeredCount = Object.keys(answers).length;
                $('.answered-count').text(answeredCount);
                $('.total-questions').text(questions.length);
            }

            function getGroupBgColor(type) {
                switch (type?.toLowerCase()) {
                    case 'verbal':
                        return {
                            groupColor: 'verbalGroupActive',
                            groupBgColor: 'verbalBgGroupActive'
                        };
                    case 'quant':
                        return {
                            groupColor: 'quantGroupActive',
                            groupBgColor: 'quantBgGroupActive'
                        };
                    case 'chemistry':
                        return {
                            groupColor: 'chemistryGroupActive',
                            groupBgColor: 'chemistryBgGroupActive'
                        };
                    case 'biology':
                        return {
                            groupColor: 'biologyGroupActive',
                            groupBgColor: 'biologyBgGroupActive'
                        };
                    case 'math':
                        return {
                            groupColor: 'mathGroupActive',
                            groupBgColor: 'mathBgGroupActive'
                        };
                    case 'physics':
                        return {
                            groupColor: 'physicsGroupActive',
                            groupBgColor: 'physicsBgGroupActive'
                        };
                    default:
                        return {
                            groupColor: 'groupActive',
                            groupBgColor: 'groupBgActive'
                        };
                }
            }

            function renderQuestionBoxes(questions) {

                let { groupColor, groupBgColor } = getGroupBgColor(getSessionData.question_type);
                $('.topic-title').text(getSessionData.question_type);
                $('.topic-title').addClass(groupColor);

                let html = '';
                for (let question of questions) {
                    html += `<span class="box question-${question.id}" data-bgColor="${groupBgColor}" data-question='${question}'></span>`;
                }

                $('.question-topic').html(html);
            }


            function renderQuestion(index) {
                let question = questions[index];

                $('.box').removeClass('active');
                let boxBgColor = $(`.question-${question.id}`).attr('data-bgColor');
                $(`.question-${question.id}`).addClass('active '+ boxBgColor);

                $('#question-context').html(`
                    <p>${question.question_description || 'No context provided.'}</p>
                `);
                $('#question-explanation').html(`
                    <p>${question.explanation || 'No explanation provided.'}</p>
                `);

                let options;
                if (typeof question.options === 'string') {
                    options = JSON.parse(question.options);
                } else {
                    options = Array.isArray(question.options) ? question.options : Object.values(question.options || {});
                }

                let selected = answers[question.id] || null;
                $('#question-title').html(`${question.question_title}`);
                $('#question-option').html(
                    options.map((opt, i) => `
                        <div class="col-md-12 mt-2">
                            <div class="form-check custom-radio" onclick="selectOption('question_${question.id}_${i}', '${opt}', ${question.id})">
                                <input class="form-check-input" type="radio" name="question_${question.id}" id="question_${question.id}_${i}" value="${opt}" ${selected === opt ? 'checked' : ''}>
                                <label class="form-check-label" style="padding-top:8px" for="question_${question.id}_${i}">
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
                let incompleteBgColor = $(`.question-${questionId}`).attr('data-bgColor');
                $(`.question-${questionId}`).removeClass('incomplete ' + incompleteBgColor).addClass('completed '+ incompleteBgColor+'Complete');
                updateAnsweredCount();
            }

            function saveAnswerAndColor(index) {
                let q = questions[index];
                let now = Date.now();
                let timeSpent = Math.floor((now - questionStartTime) / 1000); // in seconds
                timeTracking[q.id] = (timeTracking[q.id] || 0) + timeSpent;

                // Reset start time for next question
                questionStartTime = now;

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


            function submitExam() {
                saveAnswerAndColor(currentIndex);
                let q = questions[currentIndex];

                let selectedOption = $(`input[name="question_${q.id}"]:checked`).val();

                if (selectedOption) answers[q.id] = selectedOption;


                let submissionData = questions.map(q => ({
                    question_id: q.id,
                    answer: answers[q.id] ?? null,
                    is_correct: answers[q.id] === q.correct_answer ? 1 : 0,
                    time_spent: timeTracking[q.id] || 0,
                }));

                let startTime = getSessionData.start_time;
                let totalDuration = getSessionData.total_duration;

                $.ajax({
                    url: '/drill-exam/store',
                    type: 'POST',
                    data: JSON.stringify({responses: submissionData, start_time: startTime, totalDuration: totalDuration}),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        sessionStorage.removeItem('drill_exam_data'); // Clear session data after submission
                        // return false;
                        Swal.fire("Submitted", "Your exam has been submitted successfully", "success");
                        window.location.href = '/full-tests';
                    },
                    error: function (xhr) {
                        Swal.fire("Error", "Something Went Wrong!", "error");
                        // alert('Error submitting exam: ' + (xhr.responseJSON?.message || 'Unknown error'));
                    }
                });
            }


            $(document).ready(function () {
                renderQuestionBoxes(questions);
                startTimer(getSessionData.total_duration);
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
                      Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you really want to submit the exam?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, submit it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            submitExam(); // your existing function
                        }
                    });
                });

                $('.box').on('click', function () {
                    saveAnswerAndColor(currentIndex);
                    currentIndex = $(this).index('.box');
                    renderQuestion(currentIndex);
                });

                // End Exam button functionality
                $('.submit-exam').filter(':contains("End Exam")').on('click', function () {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you really want to submit the exam?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, submit it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            submitExam(); // your existing function
                        }
                    });
                });

                $('.total-questions').text(questions.length);
            });
        </script>
    @endpush
</x-backend.layouts.student-master>
