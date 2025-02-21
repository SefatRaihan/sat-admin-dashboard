<x-backend.layouts.master>
    @php
        $prependHtml = '
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                <button type="button"style="padding: 5px 15px; border:2px solid #D0D5DD; border-radius:10px; background-color: #FFFFFF; color:#344054; font-size: 1.2rem">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Upload Question
                </button>
            </div>
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                <button type="button" data-toggle="modal" data-target="#questionModal" id="add-question" style="padding: 5px 15px; border:2px solid #691D5E; border-radius:10px; background-color: #691D5E; color:#EAECF0; font-size: 1.2rem">
                    <i class="fa-solid fa-plus"></i> Add Question
                </button>
            </div>
        ';
    @endphp

    <x-backend.layouts.partials.blocks.contentwrapper :headerTitle="'Profile'" :prependContent="$prependHtml">
    </x-backend.layouts.partials.blocks.contentwrapper>

    {{-- <x-backend.layouts.partials.blocks.empty-state 
        title="You have not created any Question yet" 
        message="Let’s create a new question"
        buttonText="Add Question"
        buttonRoute="/button/create"
        /> --}}

    <div class="modal fade modal-dialog modal-dialog-scrollable" id="questionModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
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
                <div class="modal-body">
                    {{-- Form Start --}}
                    <form id="questionForm">
                        <div class="step step-1">
                            <h5>1. Select the Audience</h5>
                            <div class="row">
                                <div class="col-md-6 row">
                                    <label class="radio-container col-md-12">
                                        <input type="radio" name="audience" value="High School" checked> High School
                                    </label>
                                    <label class="radio-container col-md-12">
                                        <input type="radio" name="audience" value="Graduation"> Graduation
                                    </label>
                                </div>
                                <div class="col-md-6 row">
                                    <label class="radio-container col-md-12">
                                        <input type="radio" name="audience" value="College"> College
                                    </label>
                                    <label class="radio-container col-md-12">
                                        <input type="radio" name="audience" value="SAT 2"> SAT 2
                                    </label>
                                </div>
                            </div>

                            <h5 class="mt-3">2. Select the Question Type</h5>
                            <div class="row">
                                <label class="radio-container col-md-6">
                                    <input type="radio" name="question_type" value="Verbal" checked> Verbal
                                </label>
                                <label class="radio-container col-md-6">
                                    <input type="radio" name="question_type" value="Quant"> Quant
                                </label>
                            </div>

                            {{-- Buttons --}}
                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="btn back-btn btn-outline-secondary mr-2">Cancel</button>
                                <button type="button" class="btn next-step">Next</button>
                            </div>
                        </div>

                        {{-- Placeholder for future steps --}}
                        <div class="step step-2 d-none">
                            <h5>Step 2 Content</h5>
                            <div id="editor-container">
                                <div class="editor mb-3"></div>
                                <button type="button" class="btn btn-sm btn-secondary mt-2 add-option"
                                    data-question="1">
                                    + Add Option
                                </button>
                            </div>
                            <div class="d-flex justify-content-end mt-4 ">
                                <button type="button" class="btn back-btn prev-step mr-2">Back</button>
                                <button type="button" class="btn next-step">Next</button>
                            </div>
                        </div>

                        <div class="step step-3 d-none">
                            <h5>Step 3 Content</h5>
                            <div id="editor-container">
                                <div class="editor mb-3"></div>
                                <button type="button" class="btn btn-sm btn-secondary mt-2 add-option"
                                    data-question="1">
                                    + Add Option
                                </button>
                            </div>
                            <div class="d-flex justify-content-end mt-4 ">
                                <button type="button" class="btn back-btn prev-step mr-2">Back</button>
                                <button type="button" class="btn next-step">Next</button>
                            </div>
                        </div>

                        <div class="step step-4 d-none">
                            <h5>Step 4 Content</h5>
                            <div id="editor-container">
                                <div class="editor mb-3"></div>
                                <button type="button" class="btn btn-sm btn-secondary mt-2 add-option"
                                    data-question="1">
                                    + Add Option
                                </button>
                            </div>
                            <div class="d-flex justify-content-between mt-4 ">
                                <button type="button" class="btn new-question float-left">Save & Create
                                    Another</button>
                                <div>
                                    <button type="button" class="btn back-btn float-end prev-step mr-2">Back</button>
                                    <button type="submit" class="btn float-end"
                                        style="background:#691D5E; color: #EAECF0;  border-radius: 8px;">Save
                                        Question</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
        <style>
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
        </style>
    @endpush

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <script>
            $(document).ready(function() {
                let currentStep = 1;
                let questionCount = 0;

                function showStep(step) {
                    $(".step").addClass("d-none");
                    $(".step-" + step).removeClass("d-none");

                    $(".step-circle").removeClass("active completed");
                    $(".step-line").css("background", "#D0D5DD");

                    $(".step-circle i").addClass("d-none");
                    $(".step-circle .circle-count").removeClass("d-none");

                    for (let i = 1; i < step; i++) {
                        $(".step-circle[data-step=" + i + "]").addClass("completed");
                        $(".step-circle[data-step=" + i + "] i").removeClass("d-none");
                        $(".step-circle[data-step=" + i + "] .circle-count").addClass("d-none");
                        $(".step-circle[data-step=" + i + "]").parent().next(".step-group").find(".step-line").css(
                            "background", "#12B76A");
                    }

                    $(".step-circle[data-step=" + step + "]").addClass("active");

                    initializeQuill();
                }

                $(".next-step").click(function() {
                    if (currentStep < 4) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });

                $(".prev-step").click(function() {
                    if (currentStep > 1) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });



                function initializeQuill() {
                    $(".editor").each(function() {
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


                $("#add-new-editor").click(function() {
                    questionCount++;
                    let questionId = "question-" + questionCount;
                    let option1Id = "option-" + questionCount + "-1";
                    let option2Id = "option-" + questionCount + "-2";

                    let newQuestionHtml = `
                        <div class="question-block mb-3 mt-3">
                            <h5>Question ${questionCount}</h5>
                            <div id="${questionId}" class="editor"></div>
                            <button type="button" class="btn btn-sm btn-danger remove-question" float-right data-question="${questionCount}">
                                ✖ Remove Question
                            </button>
                        </div>
                        `;

                    $("#editor-container").append(newQuestionHtml);
                });

                // Function to dynamically add more options under a question
                $(document).on("click", ".add-option", function() {
                    let questionNum = $(this).data("question");
                    let optionCount = $(this).siblings(".editor").length + 1;
                    let newOptionId = `option-${questionNum}-${optionCount}`;

                    let newOptionHtml = `<div id="${newOptionId}" class="editor mt-1"></div>`;
                    $(this).before(newOptionHtml); // Add before the "+ Add Option" button

                    initializeQuill("#" + newOptionId);
                });

                // Initialize the first question and its options on page load
                // initializeQuill(".editor");





                // function initializeQuill(selector) {
                //     new Quill(selector, {
                //         modules: {
                //             toolbar: [
                //                 ['bold', 'italic', 'underline', 'strike'],
                //                 ['blockquote', 'code-block'],
                //                 ['link', 'image', 'video', 'formula'],
                //                 [{ 'header': 1 }, { 'header': 2 }],
                //                 [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                //                 [{ 'script': 'sub' }, { 'script': 'super' }],
                //                 [{ 'direction': 'rtl' }],
                //                 [{ 'size': ['small', false, 'large', 'huge'] }],
                //                 [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                //                 [{ 'color': [] }, { 'background': [] }],
                //                 [{ 'font': [] }],
                //                 [{ 'align': [] }]
                //             ]
                //         },
                //         placeholder: 'Type here...',
                //         theme: 'snow'
                //     });
                // }

                // // Function to add a new question block
                // $("#add-new-editor").click(function () {
                //     questionCount++;
                //     let questionId = `question-${questionCount}`;

                //     let newQuestionHtml = `
        //         <div class="question-block mt-3 p-3 border rounded">
        //             <h5>Question ${questionCount}</h5>
        //             <div id="${questionId}" class="editor"></div>

        //             <h6 class="mt-2">Options:</h6>
        //             <div class="options-container" data-question="${questionCount}"></div>

        //             <button type="button" class="btn btn-sm btn-primary add-option" data-question="${questionCount}">
        //                 + Add Option
        //             </button>
        //             <button type="button" class="btn btn-sm btn-danger remove-question" data-question="${questionCount}">
        //                 ✖ Remove Question
        //             </button>
        //         </div>
        //     `;

                //     $("#editor-container").append(newQuestionHtml);

                //     // Initialize Quill for the new question editor
                //     initializeQuill(`#${questionId}`);
                // });

                // // Function to dynamically add more options under a question
                // $(document).on("click", ".add-option", function () {
                //     let questionNum = $(this).data("question");
                //     let optionCount = $(`.options-container[data-question="${questionNum}"] .editor`).length + 1;
                //     let newOptionId = `option-${questionNum}-${optionCount}`;

                //     let newOptionHtml = `
        //         <div class="d-flex align-items-center mt-2 option-item">
        //             <div id="${newOptionId}" class="editor flex-grow-1"></div>
        //             <button type="button" class="btn btn-sm btn-danger remove-option ms-2">✖</button>
        //         </div>
        //     `;

                //     $(`.options-container[data-question="${questionNum}"]`).append(newOptionHtml);

                //     // Initialize Quill for the new option editor
                //     initializeQuill(`#${newOptionId}`);
                // });

                // Function to remove a question block
                $(document).on("click", ".remove-question", function() {
                    let questionNum = $(this).data("question");
                    $(this).closest(".question-block").remove();
                });

                // // Function to remove an option
                // $(document).on("click", ".remove-option", function () {
                //     $(this).closest(".option-item").remove();
                // });

                showStep(currentStep);


            });
        </script>
    @endpush

</x-backend.layouts.master>
