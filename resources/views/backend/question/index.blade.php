<x-backend.layouts.master>
    @php
        $prependHtml = '
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                <button type="button"style="padding: 5px 15px; border:2px solid #D0D5DD; border-radius:10px; background-color: #FFFFFF; color:#344054; font-size: 12px">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Upload Question
                </button>
            </div>
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                <a href=\'/students/create\' data-toggle=\'modal\' data-target=\'#questionModal\' class=\'btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                    <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Add Question
                </a>
            </div>
        ';
    @endphp

    <x-backend.layouts.partials.blocks.contentwrapper :headerTitle="'All Question'" :prependContent="$prependHtml">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <x-backend.layouts.partials.blocks.empty-state
        title="You have not created any Question yet"
        message="Let’s create a new question"
        buttonText="Add Question"
        buttonText="Add Question"
        data-toggle="modal"
        data-target="#questionModal"
        {{-- buttonRoute="/button/create" --}}
        />

        <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="questionModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border-radius: 24px; height:100%">
                    <div style="background: #F9FAFB;  border-bottom:1px solid #D0D5DD ">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <h4 class="text-center font-weight-bold">Create a Question</h4>
                        <p class="text-center text-muted">Step 1: Select Audience & Question Type</p>
                        <div class="d-flex justify-content-center align-items-center mb-4 step-container">
                            <div class="step-group">
                                <div class="step-circle active" data-step="1"><i class="fa-solid fa-check d-none"></i><span
                                        class="circle-count">1</span></div>
                            </div>
                            <div class="step-group">
                                <div class="step-line"></div>
                                <div class="step-circle m-0" data-step="2"><i class="fa-solid fa-check d-none"></i><span
                                        class="circle-count">2</span></div>
                            </div>
                            <div class="step-group">
                                <div class="step-line"></div>
                                <div class="step-circle m-0" data-step="3"><i class="fa-solid fa-check d-none"></i><span
                                        class="circle-count">3</span></div>
                            </div>
                            <div class="step-group">
                                <div class="step-line"></div>
                                <div class="step-circle m-0" data-step="4"><i class="fa-solid fa-check d-none"></i><span
                                        class="circle-count">4</span></div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-body" style="padding: 10px 40px">
                        {{-- Form Start --}}
                        <form id="questionForm">
                            <div class="step step-1">
                                <h5><strong>1. Select the Audience</strong></h5>
                                <div class="row" style="margin-left: 3px">
                                    <div class="col-md-6">
                                        <div class="form-check mb-2">
                                            <input type="radio" name="audience" value="High School" class="form-check-input sat_1" id="high_school">
                                            <label class="radio-container form-check-label" for="high_school" >
                                                High School
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="radio" name="audience" value="Graduation" class="form-check-input sat_1" id="graduation">
                                            <label class="radio-container form-check-label" for="graduation">
                                                Graduation
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check mb-2">
                                            <input type="radio" name="audience" value="College" class="form-check-input sat_1" id="college">
                                            <label class="radio-container form-check-label" for="college">
                                                College
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="radio" name="audience" value="SAT 2" class="form-check-input sat_2" id="sat_2">
                                            <label class="radio-container form-check-label" for="sat_2">
                                                SAT 2
                                            </label>
                                        </div>
                                    </div>
                                </div>

                               <div id="sat_type_1" class="d-none">
                                    <h5 class="mt-3"><strong>2. Select the Question Type</strong></h5>
                                    <div class="row" style="margin-left: 3px">
                                        <div class="col-md-12 row" style="margin-left: 3px">
                                            <div class="form-check col-md-6 mb-2">
                                                <input type="radio" class="form-check-input" name="question_type" value="Verbal" id="verbal">
                                                <label class="radio-container form-check-label" for="=verbal">
                                                    Verbal
                                                </label>
                                            </div>
                                            <div class="form-check col-md-6 mb-2">
                                                <input type="radio" class="form-check-input" name="question_type" value="Quant" id="quant">
                                                <label class="radio-container form-check-label" for="quant">
                                                    Quant
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                               <div id="sat_type_2" class="d-none">
                                    <h5 class="mt-3"><strong>2. Select the Question Subject</strong></h5>
                                    <div class="row" style="margin-left: 3px">
                                        <div class="col-md-6">
                                            <div class="form-check mb-2">
                                                <input type="radio" name="subjects" value="Physics" class="form-check-input" id="physics">
                                                <label class="form-check-label radio-container" for="physics">
                                                    Physics
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="radio" name="subjects" value="Chemistry" class="form-check-input" id="chemistry">
                                                <label class="form-check-label radio-container" for="chemistry">
                                                    Chemistry
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check mb-2">
                                                <input type="radio" name="subjects" value="Biology" class="form-check-input" id="biology">
                                                <label class="form-check-label radio-container" for="biology">
                                                    Biology
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="radio" name="subjects" value="Math" class="form-check-input" id="math">
                                                <label class="form-check-label radio-container" for="math">
                                                    Math
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                            </div>

                            {{-- Placeholder for future steps --}}
                            <div class="step step-2 d-none">
                                <div>
                                    <h5><strong>3. Provide the verbal Context*</strong></h5>
                                    <div id="editor-container">
                                        <div class="editor mb-3" id="context"></div>
                                    </div>
                                </div>
                                <div>
                                    <h5><strong>4. Write Question & Provide Options*</strong></h5>
                                    <div id="editor-container">
                                        <div class="editor mb-3" id="mcq_question"></div>
                                    </div>
                                    <div class="option-block mt-2 " id="option-container" style="margin-left: 3px">

                                    </div>
                                    <a type="button" class="mt-2 add-options" style="color: #691D5E">
                                        <b>+ Add Option</b>
                                    </a>
                                </div>
                            </div>

                            <div class="step step-3 d-none">
                                <div id="question-container" style="border: 1px solid #D0D5DD; border-radius:8px; padding:10px; background:#F9FAFB"></div>
                                <div class="mt-3"><h5><strong>5. Select the Right Answer</h5></div>
                                <div id="show-options"class="row mt-2" style="margin-left: 3px"></div>
                                <div>
                                    <h5 class="mt-3"><strong>6. How difficult is this Question?</strong></h5>
                                </div>
                                <div class="row" style="margin-left: 3px">
                                    <div class="col-md-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="difficulty" id="easy">
                                            <label class="form-check-label" for="easy">
                                                <span class="badge badge-pill badge-easy">Easy</span>
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="difficulty" id="hard">
                                            <label class="form-check-label" for="hard">
                                                <span class="badge badge-pill badge-hard">Hard</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="difficulty" id="medium">
                                            <label class="form-check-label" for="medium">
                                                <span class="badge badge-pill badge-medium">Medium</span>
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="difficulty" id="very-hard">
                                            <label class="form-check-label" for="very-hard">
                                                <span class="badge badge-pill badge-very-hard">Very Hard</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="step step-4 d-none">
                                <h5><strong>7. Provide the Explanation</strong></h5>
                                <div id="editor-container">
                                    <div class="editor mb-3"></div>
                                </div>
                                <h5 class="mt-3"><strong>8. Want to Active this Question upon saving</strong></h5>
                                <div class="row" style="margin-left: 3px">
                                    <div class="col-md-12 row" style="margin-left: 3px">
                                        <div class="form-check col-md-6 mb-2">
                                            <input type="radio" class="form-check-input" name="question_type" value="Verbal" id="verbal">
                                            <label class="radio-container form-check-label" for="=verbal">
                                                Make it Active
                                            </label>
                                        </div>
                                        <div class="form-check col-md-6 mb-2">
                                            <input type="radio" class="form-check-input" name="question_type" value="Quant" id="quant">
                                            <label class="radio-container form-check-label" for="quant">
                                                Keep Inactive for now
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer pt-2" style="border-top: 1px solid #D0D5DD">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <!-- Left side: Placeholder wrapper to maintain spacing -->
                            <div class="left-placeholder">
                                <button type="button" class="btn new-question d-none">Save & Create Another</button>
                            </div>

                            <!-- Right side: Navigation buttons -->
                            <div class="d-flex">
                                <button type="button" class="btn back-btn btn-outline-secondary cancel mr-2">Cancel</button>
                                <button type="button" class="btn back-btn btn-outline-secondary prev-step mr-2 d-none">Back</button>
                                <button type="button" class="btn next-step">Next</button>
                                <button type="submit" class="btn save-question d-none" style="background:#691D5E; color: #EAECF0; border-radius: 8px;">Save Question</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
        <style>

            input[type="radio"] {
                accent-color: #691D5E;
            }
            label{
                padding-top: 2px;
            }

            .new-question {
                border: 1px solid #691D5E;
                background: #FFFFFF;
                color: #691D5E;
                border-radius: 8px;
            }

            .next-step {
                background: #691D5E;
                color: #EAECF0;
                border-radius: 8px;
            }

            .back-btn {
                border: 1px solid #D0D5DD;
                background: #FFFFFF;
                color: #344054;
                border-radius: 8px;
            }

            .modal-content {
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
            }

            .step-container {
                display: flex;
                align-items: center;
                position: relative;
            }

            .step-group {
                display: flex;
                align-items: center;
            }

            .step-line {
                width: 50px;
                height: 3px;
                background: #D0D5DD;
            }

            .step-group:first-child .step-line {
                display: none;
            }

            .step-circle {
                width: 40px;
                height: 40px;
                border: 3px solid #D0D5DD;
                border-radius: 50%;
                background: #FFFFFF;
                color: black;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                position: relative;
                z-index: 2;
                transition: 0.3s ease-in-out;
            }

            /* Active step */
            .step-circle.active {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: #691D5E;
                color: white;
                border-color: #691D5E;
            }

            /* Completed step */
            .step-circle.completed {
                background: #12B76A;
                color: white;
                border-color: #12B76A;
                position: relative;
            }

            .step-circle.completed::before {
                color: white;
                font-size: 18px;
            }

            .border-left {
                border-left: 3px solid #6c757d; /* Left border when options exist */
                padding-left: 10px; /* Spacing to avoid text touching the border */
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
                color: #ff7f07;
                border: 1px solid #ff7f07;
            }
            .badge-very-hard {
                background-color: #f8d7da;
                color: #dc3545;
                border: 1px solid #dc3545;
            }
            .form-check-input:checked {
                background-color: #6f42c1;
                border-color: #6f42c1;
            }
        </style>
    @endpush

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <script>
            $(document).ready(function() {

                $(".sat_1").change(function () {
                    $("#sat_type_2").removeClass("d-none");
                    $("#sat_type_1").addClass("d-none");
                });

                $(".sat_2").change(function () {
                    $("#sat_type_1").removeClass("d-none");
                    $("#sat_type_2").addClass("d-none");
                });

                let currentStep = 1;
                let optionCount = 1;
                const totalSteps = $(".step").length;
                console.log(currentStep);

                initializeQuill(".editor")

                function updateButtons() {
                    if (currentStep === 1) {
                        $(".cancel").removeClass("d-none"); // Show "Cancel"
                        $(".prev-step").addClass("d-none"); // Hide "Back"
                    } else {
                        $(".cancel").addClass("d-none"); // Hide "Cancel"
                        $(".prev-step").removeClass("d-none"); // Show "Back"
                    }

                    if (currentStep === totalSteps) {
                        $(".new-question").removeClass("d-none"); // show "Next" on last step
                        $(".next-step").addClass("d-none"); // Hide "Next" on last step
                        $(".save-question").removeClass("d-none"); // Show "Save"
                    } else {
                        $(".new-question").addClass("d-none"); // Hide "Next" on last step
                        $(".next-step").removeClass("d-none"); // Show "Next"
                        $(".save-question").addClass("d-none"); // Hide "Save" before last step
                    }
                }

                function showStep(step) {
                    console.log(step);
                    $(".step").addClass("d-none");
                    $(".step-" + step).removeClass("d-none");

                    // Step progress indicator
                    $(".step-circle").removeClass("active completed");
                    $(".step-line").css("background", "#D0D5DD");
                    $(".step-circle i").addClass("d-none");
                    $(".step-circle .circle-count").removeClass("d-none");

                    for (let i = 1; i < step; i++) {
                        $(".step-circle[data-step=" + i + "]").addClass("completed");
                        $(".step-circle[data-step=" + i + "] i").removeClass("d-none");
                        $(".step-circle[data-step=" + i + "] .circle-count").addClass("d-none");
                        $(".step-circle[data-step=" + i + "]").parent().next(".step-group").find(".step-line").css("background", "#12B76A");
                    }

                    $(".step-circle[data-step=" + step + "]").addClass("active");

                    initializeQuill(); // Reinitialize Quill editor if needed

                    updateButtons(); // Ensure button visibility updates

                    if(step === 3){
                        updateStep3Content();
                    }
                }

                $(".next-step").click(function () {
                    if (currentStep < totalSteps) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });

                $(".prev-step").click(function () {
                    if (currentStep > 1) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });

                $(".cancel").click(function () {
                    $("#questionModal").modal("hide"); // Hide modal on cancel (replace ID)
                });

                function initializeQuill(selector) {
                    $(selector).each(function() {
                        if (!$(this).hasClass("ql-container")) {
                            new Quill(this, {
                                modules: {
                                    toolbar: [
                                        ['bold', 'italic', 'underline', 'strike'],
                                        ['blockquote', 'code-block'],
                                        ['link', 'image', 'video', 'formula'],
                                        [{
                                            'header': 1
                                        }, {
                                            'header': 2
                                        }],
                                        [{
                                            'list': 'ordered'
                                        }, {
                                            'list': 'bullet'
                                        }],
                                        [{
                                            'script': 'sub'
                                        }, {
                                            'script': 'super'
                                        }],
                                        [{
                                            'direction': 'rtl'
                                        }],
                                        [{
                                            'size': ['small', false, 'large', 'huge']
                                        }],
                                        [{
                                            'header': [1, 2, 3, 4, 5, 6, false]
                                        }],
                                        [{
                                            'color': []
                                        }, {
                                            'background': []
                                        }],
                                        [{
                                            'font': []
                                        }],
                                        [{
                                            'align': []
                                        }]
                                    ]
                                },
                                placeholder: 'Compose an epic...',
                                theme: 'snow'
                            });
                        }
                    });
                }

         // Create new option HTML
                    // <div id="${newQuestionId}" class="editor"></div>
                // Event Listener for Adding Options
                // $(document).on("click", ".add-question", function() {
                //     questionCount++; // Increment the option counter
                //     let questionNum = $(this).data("question");
                //     let newQuestionId = "question-" + questionCount;
                //     let optionContainerId = `option-container-${questionCount}`;


                //     let newQuestionHtml = `

                //         <div class="question-block mb-4" id="${newQuestionId}">
                //             <h5>${questionCount-1}. Write Question & Provide Options</h5>
                //             <div class="option-block mt-2" id="${newQuestionId}">

                //                 <div class="parent-editor mb-3" id="parent-editor-${newQuestionId}"></div>

                //                 <div class="option-container" id="${optionContainerId}">
                //                     <!-- Options will be appended here -->
                //                 </div>
                //                 </div>
                //                 <button type="button" class="btn btn-secondary btn-sm mt-2 add-option" data-question="${questionCount}">
                //                     + Add Option
                //                 </button>
                //                 <button type="button" class="btn btn-sm btn-danger remove-question mt-2" data-question="${questionCount}">
                //                     ✖ Remove Question
                //                 </button>
                //         </div>
                //     `;
                //     $(this).before(newQuestionHtml);

                //     initializeQuill(`#parent-editor-${questionCount}`);

                //     addOption(questionCount);
                // });

                // // Function to Add New Option
                // function addOption(questionNum) {
                //     let optionCount = $(`#option-container-${questionNum} .child-editor`).length + 1;
                //     let newOptionId = `option-${questionNum}-${optionCount}`;

                //     let newOptionHtml = `
                //         <div>
                //             <div class="child-option mb-2" id="${newOptionId}">
                //                 <div class="child-editor mb-2" id="editor-${newOptionId}"></div>
                //                 <button type="button" class="btn btn-danger btn-sm remove-option" data-option="${newOptionId}">
                //                     ✖ Remove Option
                //                 </button>
                //             </div>
                //         </div>
                //     `;

                //     // Append the Option before the "+ Add Option" button
                //     $(`#option-container-${questionNum}`).append(newOptionHtml);

                //     // Initialize Quill for the Option (Child Editor)
                //     initializeQuill(`#editor-${newOptionId}`);
                // }

                // // Event Listener for Adding New Options
                // $(document).on("click", ".add-option", function() {
                //     let questionNum = $(this).data("question");
                //     addOption(questionNum);
                // });

                // //Event Listener for Removing Question
                // $(document).on("click", ".remove-option", function() {
                //     let optionId = $(this).data("option");
                //     $(`#${optionId}`).remove();
                // });

                // // Event Listener for Removing a Question
                // $(document).on("click", ".remove-question", function() {
                //     let questionNum = $(this).data("question");
                //     $(`#question-${questionNum}`).remove();
                // });




                $(document).on("click", ".add-options", function () {
                    optionCount++;
                    let newOptionId = `option-${optionCount}`;

                    let newOptionHtml = `
                        <div class="option-block mt-2" id="${newOptionId}">
                            <div class="parent-editor mb-3" id="option-editor-${optionCount}"></div>
                            <a type="button" class="remove-option" data-option="${newOptionId}"  style="color: red">
                                <b>Remove Option</b>
                            </a>
                        </div>
                    `;

                    $('#option-container').append(newOptionHtml);
                    initializeQuill(`#option-editor-${optionCount}`);

                    updateOptionContainerBorder();
                });

                // Event Listener for Removing an Option
                $(document).on("click", ".remove-option", function () {
                    let optionId = $(this).data("option");
                    $(`#${optionId}`).remove();
                    updateOptionContainerBorder();
                });

                // Function to Add/Remove Border Dynamically
                function updateOptionContainerBorder() {
                    if ($('#option-container').children().length > 0) {
                        $('#option-container').addClass('border-left');
                    } else {
                        $('#option-container').removeClass('border-left');
                    }
                }


                // Function to Copy Step 2 Data into Step 3
                function updateStep3Content() {
                    let context = $("#context .ql-editor").text();
                    let mcq_question = $("#mcq_question .ql-editor").text();

                    if(context === "" || mcq_question === ""){
                        alert('Please fill all the fields');
                        // $('.step-3').html('');
                    }
                    $('#question-container').html(
                        `
                            <p>${context}</p>
                            <div>
                                <p><strong>Question:</strong></p>
                                <p style="padding:0">${mcq_question}</p>
                            </div>
                        `
                    );
                    let optionsHtml = ``;

                    // Loop through options and create radio button inputs
                    $("#option-container .option-block .parent-editor").each(function (index) {
                        let optionText = $(this).find(".ql-editor p").html(); // Get option content
                        optionsHtml += `
                            <div class="form-check col-md-6 row" style="margin-left:3px">
                                <label class="radio-container col-md-12" style="padding-top:2px" for="option-${index}">
                                    <input class="form-check-input" type="radio" name="mcq_options" value="${optionText}" id="option-${index}" style="display: inline-block; visibility: visible;">
                                    ${optionText}
                                </label>
                            </div>
                        `;
                    });

                    $('#show-options').html(optionsHtml);
                }

                showStep(currentStep);




            });
        </script>
    @endpush

</x-backend.layouts.master>
