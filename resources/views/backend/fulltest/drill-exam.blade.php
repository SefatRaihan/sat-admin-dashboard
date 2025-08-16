<x-backend.layouts.student-master>
    <div class="bg-white p-2">
        <h5 class="text-center" id="exampleModalLongTitle"><b>Create a Drill Exam</b></h5>
        <p class="text-center">Create a personalized exam for practice</p>
    </div>

    <div class="d-flex justify-content-center align-items-center" style="height: 80vh">
        <div class="card" style="width:60%">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <label for="">1. Select question type</label>
                        <div class="row">
                            @forEach($data as $key => $value)
                                <div class="col-md-4">
                                    <div class="form-check custom-radio mb-2">
                                        <input class="form-check-input" type="radio" name="question_type" id="{{ $key }}" value="{{ $key }}"  {{ $loop->first ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-12 mt-2">
                        <label for="">2. Question pool</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="question_pool" id="unanswered" value="unanswered">
                                    <label class="form-check-label" for="unanswered">
                                        Unanswered
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="question_pool" id="answeredUnanswered" value="answeredUnanswered">
                                    <label class="form-check-label" for="answeredUnanswered">
                                        Answered & unanswered
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="question_pool" id="correct" value="correct">
                                    <label class="form-check-label" for="correct">
                                        Correct
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="question_pool" id="incorrect" value="incorrect">
                                    <label class="form-check-label" for="incorrect">
                                        Incorrect
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">3. Question difficulty level</label>
                        <div class="d-flex">
                            <div class="form-check custom-radio" style="border: none; background: transparent;">
                                <input class="form-check-input" type="radio" name="question_difficulty_level" id="very-easy" value="Very Easy" checked>
                                <label class="form-check-label" for="very-easy">
                                    <span class="badge badge-pill badge-very-easy">Very Easy</span>
                                </label>
                            </div>
                            <div class="form-check custom-radio" style="border: none; background: transparent;">
                                <input class="form-check-input" type="radio" name="question_difficulty_level" id="easy" value="easy">
                                <label class="form-check-label" for="easy">
                                    <span class="badge badge-pill badge-easy">Easy</span>
                                </label>
                            </div>
                            <div class="form-check custom-radio" style="border: none; background: transparent;">
                                <input class="form-check-input" type="radio" name="question_difficulty_level" id="medium" value="medium">
                                <label class="form-check-label" for="medium">
                                    <span class="badge badge-pill badge-medium">Medium</span>
                                </label>
                            </div>
                            <div class="form-check custom-radio" style="border: none; background: transparent;">
                                <input class="form-check-input" type="radio" name="question_difficulty_level" id="hard" value="hard">
                                <label class="form-check-label" for="hard">
                                    <span class="badge badge-pill badge-hard">Hard</span>
                                </label>
                            </div>
                            <div class="form-check custom-radio" style="border: none; background: transparent;">
                                <input class="form-check-input" type="radio" name="question_difficulty_level" id="very-hard" value="very_hard">
                                <label class="form-check-label" for="very-hard">
                                    <span class="badge badge-pill badge-very-hard">Very Hard</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-2">
                        <label for="">4. Total no of questions</label>
                        <input type="number" name="total_no_of_question" class="form-control total-no-of-question" placeholder="">
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="">5. Total duration</label>
                        <input type="number" name="total_duration" class="form-control total-duration" placeholder="">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <a href="{{ url('full-tests') }}" type="button" class="btn" style="border: 1px solid #D0D5DD; border-radius: 25px;">Cancel</a>
        <button type="button" class="btn start-exam ml-2" style="background-color:#691D5E ;border-radius: 25px; color:#fff">Start Exam</button>
    </div>

    @push('css')
    <style>

        .badge-very-easy {
            background-color: #b6f0ff;
            color: #0a5669;
            border: 1px solid #17a2b8;
        }

        .content {
            background-color: #FCFAFF;
            padding: 0px !important;
        }

        .page-header {
            display: none;
        }

        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: flex-end;
            background-color: #fff;
            padding: 20px 20px;
            border-top: 1px solid #D0D5DD;
        }

        .form-control {
            border-radius: 25px !important;
        }

        .form-check {
            border: 1px solid #D0D5DD;
            border-radius: 25px;
            height: 44px;
            display: flex;
            align-items: center;
            padding-left: 46px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .custom-radio .form-check-input:checked ~ .form-check {
            background-color: #F1E9F0;
            border-color: #A16A99;
        }

        .custom-radio .form-check-label::before {
            content: "";
            position: absolute;
            left: -30px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            border: 2px solid #D0D5DD;
            border-radius: 50%;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .custom-radio .form-check-input:checked + .form-check-label::before {
            border-color: #732066;
            background-color: #732066;
            box-shadow: 0 0 0 2px white, 0 0 0 4px #732066;
        }

        .custom-radio:has(.form-check-input:checked) {
            background-color: #F1E9F0;
            border-color: #A16A99;
        }

        .form-check-input:checked {
            background-color: #732066 !important;
            border-color: #732066 !important;
            margin: 2px;
        }

        .form-check-input:checked + .form-check-label {
            color: #344054;
            font-weight: 500;
        }

        .form-check-input {
            position: absolute;
            opacity: 0;
        }

        .form-check-input:checked ~ .form-check-label {
            color: #344054;
            font-weight: 500;
        }

        .form-check-label {
            position: relative;
            cursor: pointer;
        }
        .badge-pill {
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 14px;
        }

        .badge-easy {
            background-color: #d4edda;
            color: #28a745;
            border: 1px solid #28a745;
        }

        .badge-medium {
            background-color: #d1ecf1;
            color: #17a2b8;
            border: 1px solid #17a2b8;
        }

        .badge-hard {
            background-color: #fff3cd;
            color: #fab905;
            border: 1px solid #fab905;
        }

        .badge-very-hard {
            background-color: #f8d7da;
            color: #dc3545;
            border: 1px solid #dc3545;
        }
    </style>
    @endpush
    @push('js')
        <script>
            $(document).ready(function () {
                $(document).on('click', '.start-exam', startExam)
            });

            const startExam = () => {
                let questionType = $('input[name="question_type"]:checked').val();
                let questionPool = $('input[name="question_pool"]:checked').val();
                let difficulty = $('input[name="question_difficulty_level"]:checked').val();
                let totalQuestions = $('input[name="total_no_of_question"]').val();
                let totalDuration = $('input[name="total_duration"]').val();


            const validations = [
                { value: questionType, message: "Please select a question type" },
                { value: questionPool, message: "Please select a question pool" },
                { value: difficulty, message: "Please select a difficulty level" },
                { value: totalQuestions, message: "Please enter total number of questions" },
                { value: totalDuration, message: "Please enter total duration" },
            ];

            for (let i = 0; i < validations.length; i++) {
                if (!validations[i].value) {
                    Swal.fire({
                        width: 400,
                        icon: "warning",
                        text: validations[i].message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }
            }

            $.ajax({
                url: "{{ route('drill-exam.prepare') }}", // route to prepare and redirect
                method: "POST",
                data: {
                    question_type: questionType,
                    question_pool: questionPool,
                    difficulty_level: difficulty,
                    total_questions: totalQuestions,
                    total_duration: totalDuration
                },
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                success: function (response, textStatus, jqXHR) {
                    sessionStorage.setItem('drill_exam_data', JSON.stringify(response));

                    // Redirect to another blade page
                    window.location.href = "/drill-exam/create"; //
                },
                error: function (xhr) {
                    alert("Error: " + xhr.responseJSON.message ?? "Something went wrong.");
                }
            });
            }
        </script>

    @endpush
</x-backend.layouts.student-master>
