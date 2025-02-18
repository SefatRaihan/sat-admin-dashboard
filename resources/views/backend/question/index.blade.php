<x-backend.layouts.master>
@php
    $prependHtml = '
        <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
            <button type="button" style="padding: 5px 15px; border:2px solid #D0D5DD; border-radius:10px; background-color: #FFFFFF; color:#344054; font-size: 1.2rem">
                <i class="fa-solid fa-cloud-arrow-up"></i> Upload Question
            </button>
        </div>
        <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
            <button type="button" style="padding: 5px 15px; border:2px solid #691D5E; border-radius:10px; background-color: #691D5E; color:#EAECF0; font-size: 1.2rem">
                <i class="fa-solid fa-plus"></i> Add Question
            </button>
        </div>
    ';
@endphp

<x-backend.layouts.partials.blocks.contentwrapper
    :headerTitle="'Profile'"
    :prependContent="$prependHtml">
</x-backend.layouts.partials.blocks.contentwrapper>

    {{-- <x-slot name="contentWrapper">
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title p-3 d-flex">
                    <h4><span class="font-weight-semibold">All Questions</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements d-none">
                    <div class="d-flex justify-content-end">
                        <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                            <button type="button" style="padding: 5px 15px; border:2px solid #D0D5DD; border-radius:10px; background-color: #FFFFFF; color:#344054; font-size: 1.2rem"><i class="fa-solid fa-cloud-arrow-up"></i> Upload Question</button>
                        </div>
                        <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                            <button type="button" style="padding: 5px 15px; border:2px solid #691D5E; border-radius:10px; background-color: #691D5E; color:#EAECF0; font-size: 1.2rem"><i class="fa-solid fa-plus"></i> Add Question</button>
                        </div>
                        <div class="d-flex align-items-center justify-content-center" style="height: 40px; width:40px; border:1px solid #EAECF0; border-radius:20px; background-color: #F9FAFB">
                            <img src="{{ asset('image/icon/notification-icon.png') }}" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-slot> --}}

    <x-slot name="breadcrumb">
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader">
                All Questions
            </x-slot>
            <x-slot name="add">

            </x-slot>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="text-decoration: none; color:#6c757d">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('generals.index') }}" style="text-decoration: none; color:#6c757d">Generals</a></li>
            <li class="breadcrumb-item active">Create</li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="container mt-5">
            <div class="card shadow-sm p-4">
                <h4 class="text-center font-weight-bold">Create a Question</h4>
                <p class="text-center text-muted">Step 1: Select Audience & Question Type</p>

                {{-- Step Progress Indicator --}}
                <div class="d-flex justify-content-center mb-4">
                    <div class="step-circle active" data-step="1">1</div>
                    <div class="step-circle" data-step="2">2</div>
                    <div class="step-circle" data-step="3">3</div>
                    <div class="step-circle" data-step="4">4</div>
                </div>

                {{-- Form Start --}}
                <form id="questionForm">
                    <div class="step step-1">
                        <h5>1. Select the Audience</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="radio-container">
                                    <input type="radio" name="audience" value="High School" checked> High School
                                </label>
                                <label class="radio-container">
                                    <input type="radio" name="audience" value="Graduation"> Graduation
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="radio-container">
                                    <input type="radio" name="audience" value="College"> College
                                </label>
                                <label class="radio-container">
                                    <input type="radio" name="audience" value="SAT 2"> SAT 2
                                </label>
                            </div>
                        </div>

                        <h5 class="mt-3">2. Select the Question Type</h5>
                        <label class="radio-container">
                            <input type="radio" name="question_type" value="Verbal" checked> Verbal
                        </label>
                        <label class="radio-container">
                            <input type="radio" name="question_type" value="Quant"> Quant
                        </label>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary">Cancel</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>
                    </div>

                    {{-- Placeholder for future steps --}}
                    <div class="step step-2 d-none">
                        <h5>Step 2 Content</h5>
                        <button type="button" class="btn btn-secondary prev-step">Back</button>
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>

                    <div class="step step-3 d-none">
                        <h5>Step 3 Content</h5>
                        <button type="button" class="btn btn-secondary prev-step">Back</button>
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>

                    <div class="step step-4 d-none">
                        <h5>Step 4 Content</h5>
                        <button type="button" class="btn btn-secondary prev-step">Back</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('css')
        <style>
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
                margin: 0 5px;
                font-weight: bold;
            }

            .step-circle.active {
                background: #691D5E;
                color: white;
                width: 40px;
                height: 40px;
                border: 3px solid #691D5E;
                border-radius: 50%;
            }

            .radio-container {
                display: block;
                padding: 8px;
                cursor: pointer;
            }

            .radio-container input {
                margin-right: 5px;
            }



/* 
            .step-container {
                display: flex;
                align-items: center;
            }

            .step {
                position: relative;
                display: flex;
                align-items: center;
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
                transition: 0.3s ease-in-out;
            }

            /* Active step */
            .step-circle.active {
                background: #691D5E;
                color: white;
                border-color: #691D5E;
            } */

            /* Completed step */
            .step-circle.completed {
                background: #12B76A;
                color: white;
                border-color: #12B76A;
                position: relative;
            }

            .step-circle.completed::before {
                content: "✔";
                font-size: 18px;
            }

            /* Connector line */
            .step::after {
                content: "";
                position: absolute;
                width: 40px;
                height: 3px;
                background: #D0D5DD;
                left: 50%;
                top: 50%;
                transform: translateY(-50%);
                z-index: -1;
            }

            .step:last-child::after {
                display: none;
            }

            /* Active and completed step connector */
            .step.completed::after {
                background: #12B76A;
            }

        </style>
    @endpush

    @push('js')
        <script>
            $(document).ready(function () {
                let currentStep = 1;

                function showStep(step) {
                    $(".step").addClass("d-none");
                    $(".step-" + step).removeClass("d-none");
                    $(".step-circle").removeClass("active");
                    $(".step-circle[data-step=" + step + "]").addClass("active");
                }

                $(".next-step").click(function () {
                    if (currentStep < 4) {
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

                showStep(currentStep);
            });

        </script>
    @endpush

</x-backend.layouts.master>
