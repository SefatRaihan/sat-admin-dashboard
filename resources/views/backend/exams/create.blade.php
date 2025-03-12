<x-backend.layouts.master>

    <x-backend.layouts.partials.blocks.contentwrapper
        :headerTitle="'
            <a href=\'\roles\' class=\'text-dark\'>
                <i class=\'fa-solid fa-angle-left mr-2\'></i> Create Exam : Add Question to Section 1
            </a>

            <div class=\'heading-summary\'>
                <ul class=\'pl-4 m-0\'>
                    <li id=\'type\' style=\'list-style: none\'>Hi School</li>
                    <li id=\'total-section\'>4 sections</li>
                    <li id=\'total-question\'>40 Questions</li>
                    <li id=\'total-time\'>1h 30m</li>
                </ul>
            </div>
        '"
        :prependContent="'

        '">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div>
        <div class="row">
            <div class="col-md-9" style="background-color:#fff; padding: 16px; padding-left: 45px !important; border-bottom:1px solid #EAECF0">
                <div class="d-flex justify-content-between">
                    <div>
                        <input type="text" id="search" class="form-control search__input" placeholder="Search Notification" style="padding-left: 35px">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" onclick="filter(this)"><img src="{{ asset('image/icon/layer.png') }}" alt=""> Filters</button>
                        <div class="form-group mb-0">
                            <select class="form-control multiselect" multiple="multiple" data-fouc>
                                <option value="All">All</option>
                                <option value="Unread">Unread</option>
                                <option value="Audience">Audience</option>
                                <option data-role="divider"></option>
                                <option value="Latest">Latest</option>
                                <option value="Oldest">Oldest</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="background-color: #F2F4F7">
                <div class="d-flex justify-content-between pt-1">
                    <div>
                        <ul class="p-0" style="display: flex; gap:20px">
                            <li style="list-style: none">Verbal</li>
                            <li>45 min</li>
                        </ul>
                    </div>
                    <div>
                        <button class="btn p-0" style="font-size: 12px"><u>Clear All</u></button>
                    </div>
                </div>
                <h6><b>Section 1: Extreme Section</b></h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9" style="height: 82vh; background-color:#fff; border-right:1px solid #D0D5DD; padding-left:50px; overflow-y: auto;">
                <h5 style="color: #101828; font-size:16px"><span id="totalQuestion">10</span> Questions</h5>
                <div class="row" id="question-container"></div>
            </div>
            <div class="col-md-3" style="height: 82vh; background-color:#fff; overflow-y: auto;">
                <div class="exam-question-summary pt-2 pr-2">
                    <div class="d-flex justify-content-between">
                        <p style="color: #333333; font-size:14px"><b>Total : <span class="exam-question-count">0</span>/<span class="section-total-question">20</span> </b></p>
                        <div>
                            <span class="badge badge-flat badge-pill border-secondary text-secondary-600"><span class="dot"></span> 01</span>
                            <span class="badge badge-flat badge-pill border-secondary text-secondary-600"><span class="dot"></span> 02</span>
                            <span class="badge badge-flat badge-pill border-secondary text-secondary-600"><span class="dot"></span> 01</span>
                            <span class="badge badge-flat badge-pill border-secondary text-secondary-600"><span class="dot"></span> 01</span>
                        </div>
                    </div>
                </div>
                <div id="exam-section" class="row exam-question-section" style="padding: 8px; min-height:100px"></div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            .dot {
                display: inline-block;
                width: 8px;
                height: 8px;
                background-color: #9333ea;
                border-radius: 50%;
            }
            .heading-summary li {
                color: #667085;
                font-size: 14px;
            }
            .heading-summary ul {
                display: flex;
                gap: 25px;
            }
            .content {
                padding: 0px !important;
                margin-top: 6px;
                background-color: #F2F4F7 !important;
            }
            .multiselect-native-select {
                position: relative;
                border: 1px solid #ddd;
                border-radius: 8px;
                min-width: 125px;
            }
            .multiselect.btn {
                padding: 8px .875rem !important;
            }
            .search__input {
                width: 400px;
                padding: 12px 24px;
                background-color: transparent;
                transition: transform 250ms ease-in-out;
                font-size: 14px;
                line-height: 18px;
                color: #575756;
                background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-size: 18px 18px;
                background-position: 10px center;
                border-radius: 50px;
                transition: all 250ms ease-in-out;
                backface-visibility: hidden;
                transform-style: preserve-3d;
                padding-left: 36px;
            }
            .search__input::placeholder {
                padding-left: 20px;
            }
            .question-checkbox {
                height: 20px;
                width: 20px;
                border-radius: 6px;
            }
            .question-title {
                font-size: 14px;
                color: #101828;
            }
            .question-card {
                transition: all 0.5s ease;
                cursor: move;
                background-color: transparent !important; /* Ensure parent is transparent */
            }
            /* When dragging, enforce transparency */
            .question-card.dragging {
                background-color: transparent !important;
                opacity: 0.8; /* Optional: slight opacity to indicate dragging */
            }
            .question-card .card {
                background-color: #F2F4F7; /* Default background for card */
                transition: all 0.5s ease;
            }
            .question-card.dragging .card {
                background-color: transparent !important; /* Transparent when dragging */
            }
            .exam-question-section .card {
                border-left: 3px solid #22C55E;
                margin-bottom: 15px;
                width: 100%;
                background-color: #F2F4F7;
                border-radius: 8px;
            }
            .exam-question-section .question-checkbox {
                display: none;
            }
        </style>
    @endpush

    @push('js')
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/uploaders/dropzone.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/uploader_dropzone.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/datatables_basic.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_multiselect.js"></script>
        <script>
            $(document).ready(function() {
                // Initial question card generation
                function createQuestionCard(id) {
                    return `
                        <div class="col-md-4 p-2 question-card" data-id="${id}" draggable="true" style="border-radius:8px; background-color:transparent !important">
                            <div class="card card-body m-0" style="border-left:3px solid #F79009; background-color:#F2F4F7; border-radius:8px">
                                <input type="hidden" class="question-id" value="${id}">
                                <div class="question-card-header">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <ul class="p-0" style="display: flex; gap:20px; color:#475467">
                                                <li style="list-style: none">Hi School</li>
                                                <li>Verbal</li>
                                                <li>Details</li>
                                            </ul>
                                        </div>
                                        <input type="checkbox" class="question-checkbox">
                                    </div>
                                </div>
                                <p class="question-title">A car accelerates uniformly from rest to a velocity of 30 m/s in 10 s. What is the car’s acceleration?</p>
                                <div class="question-card-footer">
                                    <ul class="p-0 m-0" style="display: flex; gap:20px; color:#475467">
                                        <li style="list-style: none"><u>2 Exams</u></li>
                                        <li>84%</li>
                                        <li>1m 12s</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `;
                }

                // Generate initial 10 cards
                for (let i = 0; i < 10; i++) {
                    $('#question-container').append(createQuestionCard(i));
                }

                // Drag and Drop functionality
                let draggedCard = null;

                // Handle drag start
                $(document).on('dragstart', '.question-card', function(e) {
                    draggedCard = this;
                    $(this).addClass('dragging');
                    e.originalEvent.dataTransfer.effectAllowed = 'move';
                });

                // Handle drag end
                $(document).on('dragend', '.question-card', function() {
                    $(this).removeClass('dragging');
                    draggedCard = null;
                });

                // Exam section drag events
                const $examSection = $('#exam-section');

                $examSection.on('dragover', function(e) {
                    e.preventDefault();
                    $(this).addClass('drag-over');
                    e.originalEvent.dataTransfer.dropEffect = 'move';
                });

                $examSection.on('dragleave', function() {
                    $(this).removeClass('drag-over');
                });

                $examSection.on('drop', function(e) {
                    e.preventDefault();
                    $(this).removeClass('drag-over');

                    if (draggedCard) {
                        const $card = $(draggedCard);
                        // Modify card for exam section
                        $card.find('.question-card-header').addClass('d-none');
                        $card.find('.question-card-footer').addClass('d-none');
                        $card.removeClass('col-md-4');
                        $card.addClass('col-md-12');

                        // Add to exam section
                        $(this).append($card);
                    }
                });

                // Question container drag events (for dragging back)
                const $questionContainer = $('#question-container');

                $questionContainer.on('dragover', function(e) {
                    e.preventDefault();
                    $(this).addClass('drag-over');
                    e.originalEvent.dataTransfer.dropEffect = 'move';
                });

                $questionContainer.on('dragleave', function() {
                    $(this).removeClass('drag-over');
                });

                $questionContainer.on('drop', function(e) {
                    e.preventDefault();
                    $(this).removeClass('drag-over');

                    if (draggedCard) {
                        const $card = $(draggedCard);
                        // Restore card for question section
                        $card.find('.question-card-header').removeClass('d-none');
                        $card.find('.question-card-footer').removeClass('d-none');
                        $card.removeClass('col-md-12');
                        $card.addClass('col-md-4');

                        // Add back to question container
                        $(this).prepend($card);
                    }
                });
            });
        </script>
    @endpush
</x-backend.layouts.master>
