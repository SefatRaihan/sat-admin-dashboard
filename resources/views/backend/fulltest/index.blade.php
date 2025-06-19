<x-backend.layouts.student-master>
    <div class="container d-flex align-items-center justify-content-center" style="width: 33%;">
        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-12 mb-4">
                <a href="/full-tests/create">
                    <div class="custom-card">
                        <div class="image-placeholder">
                            <img src="{{ asset('image/full-test.png') }}" alt="">
                        </div>
                        <div>
                            <h3 class="card-title">Full Test</h3>
                            <p class="card-text">Master the subjects with our comprehensive exam list. Showcase your expertise.</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Card 2 -->
            <div class="col-md-12 mb-4">
                <a href="/drill-exam">
                    <div class="custom-card">
                        <div class="image-placeholder">
                            <img src="{{ asset('image/drill-exam.png') }}" alt="">
                        </div>
                        <div>
                            <h3 class="card-title">Drill Exam</h3>
                            <p class="card-text">Pick questions and set a timer. Get quick feedback on what you’re good at and where you can improve!</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Card 3 -->
            <div class="col-md-12 mb-4">
                <a href="{{ route('student-exam.histories') }}">
                    <div class="custom-card">
                        <div class="image-placeholder">
                            <img src="{{ asset('image/history.png') }}" alt="">
                        </div>
                        <div>
                            <h3 class="card-title">History</h3>
                            <p class="card-text">Boost your career with our skill assessments. Showcase your expertise and draw in potential clients.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="drillExamModelCenter" tabindex="-1" role="dialog" aria-labelledby="drillExamModelCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content student-create-section" style="border-radius: 24px; height:100%">
                <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                    <h5 class="" id="exampleModalLongTitle"><b>Create a Drill Exam</b></h5>
                    <p>Create a personalized exam for practice</p>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="">1. Select question type</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="question_type" id="verbal" value="verbal" checked>
                                        <label class="form-check-label" for="verbal">
                                            Verbal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="question_type" id="quant" value="quant">
                                        <label class="form-check-label" for="quant">
                                            Quant
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="question_type" id="mixed" value="mixed">
                                        <label class="form-check-label" for="mixed">
                                            Mixed
                                        </label>
                                    </div>
                                </div>
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
                                        <input class="form-check-input" type="radio" name="question_pool" id="incorrect" value="incorrect">
                                        <label class="form-check-label" for="incorrect">
                                            Incorrect
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="question_pool" id="flagged" value="flagged">
                                        <label class="form-check-label" for="flagged">
                                            Flagged
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="">3. Question difficulty level</label>
                            <div class="form-check custom-radio" style="border: none; background: transparent;">
                                <input class="form-check-input" type="radio" name="question_defficulty_level" id="easy" value="easy" checked>
                                <label class="form-check-label" for="easy">
                                    <span class="badge badge-pill badge-easy">Easy</span>
                                </label>
                            </div>
                            <div class="form-check custom-radio" style="border: none; background: transparent;">
                                <input class="form-check-input" type="radio" name="question_defficulty_level" id="medium" value="medium">
                                <label class="form-check-label" for="medium">
                                    <span class="badge badge-pill badge-medium">Medium</span>
                                </label>
                            </div>
                            <div class="form-check custom-radio" style="border: none; background: transparent;">
                                <input class="form-check-input" type="radio" name="question_defficulty_level" id="hard" value="hard">
                                <label class="form-check-label" for="hard">
                                    <span class="badge badge-pill badge-hard">Hard</span>
                                </label>
                            </div>
                            <div class="form-check custom-radio" style="border: none; background: transparent;">
                                <input class="form-check-input" type="radio" name="question_defficulty_level" id="very-hard" value="very_hard">
                                <label class="form-check-label" for="very-hard">
                                    <span class="badge badge-pill badge-very-hard">Very Hard</span>
                                </label>
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
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn start-exam" style="background-color:#691D5E ;border-radius: 8px; color:#fff">Start Exam</button>
                </div>
            </div>
        </div>
    </div>

    @push('css')
    <style>
        .content {
            background-color: #FCFAFF;
            display: flex;
        }

        .custom-card {
            border-radius: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #fff;
            display: flex;
            align-items: center;
            border: 1px solid #D0D5DD;
            height: 188px;
        }
        .card-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #000000;

        }
        .card-text {
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            color: #667085;
        }
        .image-placeholder {
            width: 250px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
        }
        /* drill exam modal section */
        .modal .form-check {
            border: 1px solid #D0D5DD;
            border-radius: 8px;
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
</x-backend.layouts.student-master>
