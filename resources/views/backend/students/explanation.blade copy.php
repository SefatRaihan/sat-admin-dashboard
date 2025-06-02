<x-backend.layouts.student-master>
    <div class="p-4">
        <div class="row">
           <div class="col-md-3">
                <div class="header-content">
                    <h5 style="color: #344054;font: Inter;font-size: 20px;font-weight: 600;">{{ $exam->title }}</h5>
                    <div class="heading-summary d-flex justify-content-start">
                        <ul class="p-0 m-0 text-center">
                            <li id="audience" style="list-style: none">{{ $exam->sections[0]->audience  }}</li>
                            <li id="total-section">{{ $exam->sections->count() }} sections</li>
                            <li id="total-question">{{ collect($exam->duration)->flatten(1)->count() }} Questions</li>
                        </ul>
                    </div>
                </div>
           </div>
           <div class="col-md-9 d-flex justify-content-left align-items-center gap-2">
              <span class="text-center p-1" style="margin-right: 18px; border: 1px solid #ddd; border-radius: 50%; width: 32px; height: 32px; cursor: pointer;"><i class="fas fa-chevron-left text-center"></i></span>
            <div class="header-pagination">
                @php $flatQuestions = collect($questions)->flatten(1)->values(); @endphp

                @foreach ($questions as $key => $group)
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
              <span class="text-center p-1" style="margin-left: 18px; border: 1px solid #ddd; border-radius: 50%; width: 32px; height: 32px; cursor: pointer;"><i class="fas fa-chevron-right"></i></span>
           </div>
        </div>
     </div>
     <div class="p-4">
        <div class="row">
           <div class="col-md-3" style="border-right: 1px solid #ddd; min-height: 100vh">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                 <button class="nav-link text-left" id="v-pills-question-context-tab" data-toggle="pill" data-target="#v-pills-question-context" type="button" role="tab" aria-controls="v-pills-question-context" aria-selected="true">
                    <i class="far fa-file-word" style="margin-right: 18px"></i>Question & Context
                 </button>
                 <button class="nav-link text-left" id="v-pills-analytics-tab" data-toggle="pill" data-target="#v-pills-analytics" type="button" role="tab" aria-controls="v-pills-analytics" aria-selected="false">
                    <i class="fas fa-chart-line" style="margin-right: 18px"></i>Analytics
                 </button>
                 <button class="nav-link active text-left" id="v-pills-messages-tab" data-toggle="pill" data-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                    <i class="far fa-lightbulb" style="margin-right: 18px"></i>Explanation
                 </button>
              </div>
           </div>
           <div class="col-9">
              <div class="tab-content position-relative" id="v-pills-tabContent">
                 <div class="tab-pane fade" id="v-pills-question-context" role="tabpanel"aria-labelledby="v-pills-question-context-tab">
                 </div>
                 <div class="tab-pane fade" id="v-pills-analytics" role="tabpanel" aria-labelledby="v-pills-analytics-tab">
                 </div>
                 <div class="tab-pane fade show active" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <div class="row p-4">
                        <div class="col-md-6 pl-4 pr-4">
                            <h4><b>Context</b></h4>
                            <div id="question-context">

                            </div>
                            <h4><b>Explanation</b></h4>
                            <div id="question-explanation" style="padding-bottom:100px">

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
                    <p style="border-bottom: 1px solid #ddd; margin-top: 30px;"></p>
                    <div class="profileTableWrapper ">
                        <table class="table profileTable">
                            <thead style="background-color: #F9FAFB">
                            <tr>
                                <td style="width: 480px;">Question</td>
                                <td>Section</td>
                                <td>Difficulty</td>
                                <td>Your Time</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span><i class="fas fa-check p-2 text-center" style="color: #079455; background-color: #ECFDF3;margin-right: 8px; border: 1px solid #079455; border-radius: 5px;"></i></span>
                                        <div>
                                            <p class="p-0 m-0">Question 1</p>
                                            <p><b>What type of bond is formed between two oxygen atoms in an O₂
                                                molecule? What is the chemical formula of water?</b>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>2</td>
                                <td><span class="badge badge-pill badge-hard">Hard</span></td>
                                <td>1 min 32 s</td>
                                <td>
                                    <button type="button" class="btn p-1" style="width: 94px; height: 36px; border: 1px solid #D0D5DD; border-radius: 5px;"  data-toggle="modal" data-target="#feedBackModal">Feedback</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <p style="border-bottom: 1px solid #ddd; margin-top: 30px;"></p>
                    <div style="margin-bottom: 30px;">
                        <div class="p-4"
                            style=" border-radius: 10px;border: 1px solid #ddd; min-height: 100vh;width: 100%;">
                            <h4>Explanation</h4>
                            <p style="border-bottom: 1px solid #ddd;width: 100%;margin-top: 20px; text-align: center;"></p>
                            <div id="explation-data">

                            </div>
                        </div>
                    </div>
                 </div>
              </div>

           </div>
        </div>
        <p style="border-bottom: 1px solid #ddd; "></p>
        <div style="width: 100%;" class="d-flex text-align-right justify-content-end">
           <a href="" style="text-decoration: none;color: #521749;"><i class="far fa-flag" style="margin-right: 5px;"></i>Feedback</a>
        </div>
     </div>

     {{-- feadback modal --}}
     <div class="modal fade" id="feedBackModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="feedBackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                    <h5 class="" id="exampleModalLongTitle"><b>Provide Feedback</b></h5>
                    <p>Your feedback helps us create a great experience. Please let us know what went wrong.</p>
                </div>
                <div class="modal-body text-center feedback-modal">
                    <div class="row">
                        <div class="col-md-12 feedback-option mt-2">
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="feedback" id="" value="The answer choice is incorrect">
                                <label class="form-check-label" for="">
                                    The answer choice is incorrect
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 feedback-option mt-2">
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="feedback" id="" value="The question contains an issue">
                                <label class="form-check-label" for="">
                                    The question contains an issue
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 feedback-option mt-2">
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="feedback" id="" value="No relevance between context and question">
                                <label class="form-check-label" for="">
                                    No relevance between context and question
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 feedback-option mt-2">
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="feedback" id="" value="Something else went wrong">
                                <label class="form-check-label" for="">
                                    Something else went wrong
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <textarea name="description" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer pb-0 pt-3">
                        <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn save" style="background-color:#691D5E ;border-radius: 8px; color:#fff">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

     @push('css')
        <link rel="stylesheet" href="{{ asset('css/explanation.css') }}">
        <link rel="stylesheet" href="{{ asset('css/student-exam.css') }}">
     @endpush

     @push('js')
         <script>
            $(document).on('click', '.feedback-option', function() {
                $(this).find('input[type="radio"]').prop('checked', true);
            });
         </script>
         <script>
            let questions = @json($flatQuestions);
            let examAttempt = @json($examAttempt);
            let exam = @json($exam);
            let currentIndex = 0;
            let answers = {};
            let timeTracking = {}; // { [question_id]: seconds }
            let questionStartTime = Date.now();

            function pad(n) {
                return n.toString().padStart(2, '0');
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

                console.log(question);


                $('#explation-data').html(question.explanation);

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


            $(document).ready(function () {
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

                $('.box').on('click', function () {
                    saveAnswerAndColor(currentIndex);
                    currentIndex = $(this).index('.box');
                    renderQuestion(currentIndex);
                });

                $('.total-questions').text(questions.length);
            });
        </script>
     @endpush
</x-backend.layouts.student-master>
