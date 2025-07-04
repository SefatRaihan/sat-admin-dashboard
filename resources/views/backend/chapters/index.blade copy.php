
<x-backend.layouts.master>
    @php
        $prependHtml = '
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                <a data-toggle="modal" data-target="#chapterModal" class="create-button btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm" style="background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px">
                    <i class="fas fa-plus" style="font-size: 12px; margin-right: 5px; margin-top: 5px;"></i> Manage Chapter
                </a>
            </div>
        ';
    @endphp

    <x-backend.layouts.partials.blocks.contentwrapper :headerTitle="'Manage Chapter'" :prependContent="$prependHtml">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div class="d-none" id="chapterNullList">
        <x-backend.layouts.partials.blocks.empty-state
            title="Add Chapter"
            message="No chapters found. Start by adding a new chapter."
            buttonText="Add Chapter"
            buttonRoute="#chapterModal"
        />
    </div>

    <div id="chapterList">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <input type="text" id="search" class="form-control search_input" placeholder="Search Chapter" style="padding-left: 40px">
                </div>
                <div class="d-flex">
                    <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" onclick="filter()">
                        <img src="{{ asset('image/icon/layer.png') }}" alt=""> Filters
                    </button>
                </div>
            </div>
            <div class="card-body p-0 m-0 table-responsive">
                <div class="d-flex justify-content-between align-items-center mt-3 p-2">
                    <h4><strong id="total-chapters"></strong></h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr class="bg-light">
                                <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                                <th>Chapter Name</th>
                                <th>Audience</th>
                                <th>Subject</th>
                                <th>Created</th>
                                <th>State</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="chapter-table-body">
                            <tr>
                                <td colspan="7" class="text-center">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2 p-2" style="border-topic: 1px solid #D0D5DD; background:#F9FAFB">
                    <div id="pagination-info"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mr-2">
                            <span class="me-2 pr-2">Rows per page</span>
                            <select id="rowsPerPage" class="form-control form-select-sm" style="width: 60px;">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <nav>
                            <ul class="pagination pagination-sm" id="pagination-links"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create/Edit Modal -->
    <section>
        <div class="modal fade" id="chapterModal" tabindex="-1" role="dialog" aria-labelledby="chapterModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="width:60%">
                <div class="modal-content" style="border-radius: 24px;">
                    <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px;">
                        <h5 class="modal-title" id="chapterModalLongTitle">Create Chapter</h5>
                        <p class="pb-2">Step 1: Choose Audience, Subject, Title, and Description to Get Started</p>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label class="label-header">1. Select the Audience</label>
                            <div class="row" style="margin-left: 3px">
                                <div class="col-md-6 row">
                                    <label class="radio-container mb-3 col-md-12 custom-radio">
                                        <input class="sat_1" type="radio" name="audience" value="High School"> High School
                                        <span class="form-check-label"></span>
                                    </label>
                                    <label class="radio-container mb-3 col-md-12 custom-radio">
                                        <input class="sat_1" type="radio" name="audience" value="Graduation"> Graduation
                                        <span class="form-check-label"></span>
                                    </label>
                                </div>
                                <div class="col-md-6 row">
                                    <label class="radio-container mb-3 col-md-12 custom-radio">
                                        <input class="sat_1" type="radio" name="audience" value="College"> College
                                        <span class="form-check-label"></span>
                                    </label>
                                    <label class="radio-container mb-3 col-md-12 custom-radio">
                                        <input class="sat_2" type="radio" name="audience" value="SAT 2"> SAT 2
                                        <span class="form-check-label"></span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <div id="sat_type_1" class="d-none">
                                    <h5 class="mt-3 label-header">2. Select the Question Type</h5>
                                    <div class="row">
                                        <div class="col-md-12 row">
                                            <div class="col-md-6 mb-2">
                                                <label class="radio-container mb-3 col-md-12 custom-radio">
                                                    <input type="radio" name="subject" value="Verbal"> Verbal
                                                    <span class="form-check-label"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label class="radio-container mb-3 col-md-12 custom-radio">
                                                    <input type="radio" name="subject" value="Quant"> Quant
                                                    <span class="form-check-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="sat_type_2" class="d-none">
                                    <h5 class="mt-3 label-header">2. Select the Question Subject</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="radio-container mb-3 col-md-12 custom-radio">
                                                <input type="radio" name="subject" value="Physics"> Physics
                                                <span class="form-check-label"></span>
                                            </label>
                                            <label class="radio-container mb-3 col-md-12 custom-radio">
                                                <input type="radio" name="subject" value="Chemistry"> Chemistry
                                                <span class="form-check-label"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="radio-container mb-3 col-md-12 custom-radio">
                                                <input type="radio" name="subject" value="Biology"> Biology
                                                <span class="form-check-label"></span>
                                            </label>
                                            <label class="radio-container mb-3 col-md-12 custom-radio">
                                                <input type="radio" name="subject" value="Math"> Math
                                                <span class="form-check-label"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="label-header">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter chapter title">
                            </div>
                            <div class="form-group">
                                <label class="label-header">Description</label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="5" maxlength="500" placeholder="Enter chapter description"></textarea>
                                <p class="text-right" style="color: #475467"><span id="char-count">0</span>/500 characters</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-3">
                        <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn save-chapter" style="background-color:#691D5E; border-radius: 8px; color:#fff">Save Chapter</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Sidebar -->
    <div class="sidebar-overlay" id="taskSidebarOverlay"></div>
    <div class="floating-sidebar" id="taskSidebar">
        <div class="filter">
            <div class="sidebar-header">
                <div>
                    <h4 style="font-size: 18px;" class="p-0 m-0">Filters</h4>
                    <p class="p-0 m-0" style="color: #475467">Apply filters to table data.</p>
                </div>
                <button type="button" class="close-btn" id="closeSidebar">×</button>
            </div>
            <div class="filter-sidebar-content">
                <div class="task-form">
                    <div class="pt-3 pr-3 pb-3 pl-0">
                        <div class="d-flex justify-content-between">
                            <p style="font-size: 12px"><span style="color: #344054"><b>Created on:</b></span> <span id="date-range">All time</span></p>
                            <button class="reset-slider"><u>Reset</u></button>
                        </div>
                        <div class="mt-1 mb-2 d-flex justify-content-between">
                            <div style="width: 49%">
                                <input type="date" class="form-control" name="created_start_at">
                            </div>
                            <div style="align-items: center; display: flex; width:1%">-</div>
                            <div style="width: 49%">
                                <input type="date" class="form-control" name="created_end_at">
                            </div>
                        </div>
                        <div id="filter-status">
                            <h6><b>Status:</b> All</h6>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="all" value="All" checked>
                                <label class="form-check-label" for="all">All</label>
                            </div>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="activeonly" value="Active">
                                <label class="form-check-label" for="activeonly">Active only</label>
                            </div>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="inactiveonly" value="Inactive">
                                <label class="form-check-label" for="inactiveonly">Inactive only</label>
                            </div>
                        </div>
                        <div class="mt-2">
                            <h6><b>Audience:</b> All</h6>
                            <div class="filter-group">
                                <div class="form-check">
                                    <input type="checkbox" value="High School" name="audience[]"> High School
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" value="Graduation" name="audience[]"> Graduation
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" value="College" name="audience[]"> College
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" value="SAT 2" name="audience[]"> SAT 2
                                </div>
                            </div>
                            <h6><b>Subject:</b> All</h6>
                            <div class="filter-group">
                                <div class="form-check">
                                    <input type="checkbox" value="Verbal" name="subject[]"> Verbal
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" value="Quant" name="subject[]"> Quant
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" value="Physics" name="subject[]"> Physics
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" value="Chemistry" name="subject[]"> Chemistry
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" value="Biology" name="subject[]"> Biology
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" value="Math" name="subject[]"> Math
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top fixed-bottom-buttons">
                <div class="d-flex justify-content-between p-3">
                    <button type="button" class="btn apply-filter-btn" style="background-color:#691D5E; border-radius: 4px; color:#fff; width:50%">Apply Filters</button>
                    <button type="button" class="btn btn-outline-dark ml-2 reset-filter" style="border: 1px solid #D0D5DD; border-radius: 4px; width:50%;">Reset All</button>
                </div>
            </div>
        </div>
    </div>

    @push('css')
    <style>
        input[type="radio"] {
            accent-color: #691D5e;
        }

        .label-header {
            font-size: 16px;
            font-weight: bold;
        }

        .search_input {
            width: 400px;
            padding: 12px 24px;
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 0 3 3 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: 18px 18px;
            background-position: 10px center;
            border-radius: 50px;
            padding-left: 36px;
        }

        input[type='checkbox'] {
            width: 20px;
            height: 20px;
            border: 1px solid #D0D5DD;
            appearance: none;
            background-color: white;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type='checkbox']:checked {
            background-color: #3F1239;
            position: relative;
        }

        input[type='checkbox']:checked::after {
            content: '✓';
            font-size: 12px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .dataTable tbody > tr.selected {
            background-color: #F1E9F0;
        }

        .modal .form-check {
            border: 1px solid #D0D5DD;
            border-radius: 8px;
            height: 44px;
            display: flex;
            align-items: center;
            padding-left: 46px;
            cursor: pointer;
        }

        .custom-radio .form-check-input:checked ~ .form-check {
            background-color: #F1E9F0;
            border-color: #A16A99;
        }

        .form-check-input:checked {
            background-color: #732066;
            border-color: #732066;
        }

        .form-check-input {
            position: absolute;
            opacity: 0;
        }

        .form-check-label::before {
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
        }

        .form-check-input:checked + .form-check-label::before {
            border-color: #732066;
            background-color: #732066;
            box-shadow: 0 0 0 2px white, 0 0 0 4px #732066;
        }

        .floating-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100%;
            background-color: #fff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
            transition: right 0.3s ease-in-out;
            z-index: 1050;
        }

        .floating-sidebar.open {
            right: 0;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
        }

        .sidebar-overlay.active {
            display: block;
        }

        .filter-sidebar-content {
            flex-grow: 1;
            overflow-y: auto;
            padding: 15px;
        }

        .sidebar-header {
            padding: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #D0D5DD;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 22px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 22px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #22c55e;
        }

        input:checked+.slider:before {
            transform: translateX(18px);
        }
    </style>
    @endpush

    @push('js')
    <script>
        $(document).ready(function() {
            let currentPage = 1;
            let perPage = $('#rowsPerPage').val();
            let currentChapterId = null;

            // Initialize character counter
            $('#description').on('input', function() {
                $('#char-count').text($(this).val().length);
            });

            // Audience selection handling
            $('.sat_1').change(function() {
                $('#sat_type_2').find('input').prop('checked', false);
                $('#sat_type_1').removeClass('d-none');
                $('#sat_type_2').addClass('d-none');
            });

            $('.sat_2').change(function() {
                $('#sat_type_1').find('input').prop('checked', false);
                $('#sat_type_2').removeClass('d-none');
                $('#sat_type_1').addClass('d-none');
            });

            // Sidebar toggle
            window.filter = function() {
                $('#taskSidebar').addClass('open');
                $('#taskSidebarOverlay').addClass('active');
            };

            $('#closeSidebar, #taskSidebarOverlay').on('click', function() {
                $('#taskSidebar').removeClass('open');
                $('#taskSidebarOverlay').removeClass('active');
            });

            // Checkbox selection
            function toggleDeleteButton() {
                $('.delete-btn').toggleClass('d-none', $('.row-checkbox:checked').length === 0);
            }

            $(document).on('change', '.row-checkbox', function() {
                $(this).closest('tr').toggleClass('selected', this.checked);
                toggleDeleteButton();
            });

            $('#selectAll').on('change', function() {
                $('.row-checkbox').prop('checked', this.checked).closest('tr').toggleClass('selected', this.checked);
                toggleDeleteButton();
            });

            // Fetch chapters
            function fetchChapters(page = 1, perPage = 10) {
                let filters = {
                    search: $('.search_input').val(),
                    created_start_at: $('input[name="created_start_at"]').val(),
                    created_end_at: $('input[name="created_end_at"]').val(),
                    status: $('input[name="status"]:checked').val(),
                    audience: $('input[name="audience[]"]:checked').map((_, el) => el.value).get(),
                    subject: $('input[name="subject[]"]:checked').map((_, el) => el.value).get(),
                };

                $.ajax({
                    url: `/api/chapters?page=${page}&per_page=${perPage}`,
                    type: 'GET',
                    data: filters,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {
                        updateTable(response);
                        updatePagination(response, page);
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to fetch chapters.', 'error');
                    }
                });
            }

            function updateTable(response) {
                let chapterNullList = $('#chapterNullList');
                let chapterList = $('#chapterList');
                let tableBody = $('#chapter-table-body');

                if (response.data.length === 0) {
                    chapterNullList.removeClass('d-none');
                    chapterList.addClass('d-none');
                    tableBody.html('<tr><td colspan="7" class="text-center">No chapters found.</td></tr>');
                } else {
                    chapterNullList.addClass('d-none');
                    chapterList.removeClass('d-none');
                    let rows = '';
                    $.each(response.data, function(index, chapter) {
                        let statusChecked = chapter.state ? 'checked' : '';
                        rows += `
                            <tr>
                                <td><input type="checkbox" class="row-checkbox" value="${chapter.uuid}"></td>
                                <td>${chapter.title}</td>
                                <td>${chapter.audience}</td>
                                <td>${chapter.type}</td>
                                <td>${formatDate(chapter.created_at)}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-status" data-id="${chapter.id}" ${statusChecked}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm edit-btn" data-id="${chapter.id}" data-toggle="modal" data-target="#chapterModal">
                                        <i class="far fa-edit"></i> Edit
                                    </button>
                                </td>
                            </tr>`;
                    });
                    tableBody.html(rows);
                    $('#total-chapters').text(`${response.total} Chapters`);
                }
            }

            function updatePagination(response, currentPage) {
                let totalResults = response.total;
                let perPage = response.per_page;
                let totalPages = response.last_page;
                let start = response.from || 0;
                let end = response.to || 0;

                $('#pagination-info').text(`Showing ${start}-${end} out of ${totalResults} results`);

                let paginationHtml = `
                    <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" data-page="1">«</a>
                    </li>
                    <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" data-page="${currentPage - 1}">‹</a>
                    </li>
                `;

                for (let i = Math.max(1, currentPage - 1); i <= Math.min(totalPages, currentPage + 1); i++) {
                    paginationHtml += `
                        <li class="page-item ${i === currentPage ? 'active' : ''}">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                        </li>`;
                }

                if (currentPage < totalPages - 1) {
                    paginationHtml += `
                        <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a></li>`;
                }

                paginationHtml += `
                    <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                        <a class="page-link" href="#" data-page="${currentPage + 1}">›</a>
                    </li>
                    <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                        <a class="page-link" href="#" data-page="${totalPages}">»</a>
                    </li>
                `;

                $('#pagination-links').html(paginationHtml);
            }

            function formatDate(dateString) {
                let date = new Date(dateString);
                return date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
            }

            // Create/Edit chapter
            $('.save-chapter').on('click', function() {
                let data = getFormData();
                let url = currentChapterId ? `/api/chapters/${currentChapterId}` : '/api/chapters';
                let method = currentChapterId ? 'PATCH' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {
                        Swal.fire('Success', currentChapterId ? 'Chapter updated successfully!' : 'Chapter created successfully!', 'success');
                        $('#chapterModal').modal('hide');
                        resetForm();
                        fetchChapters(currentPage, perPage);
                    },
                    error: function(error) {
                        let message = error.responseJSON?.message || 'An error occurred.';
                        Swal.fire('Error', message, 'error');
                    }
                });
            });

            // Edit chapter
            $(document).on('click', '.edit-btn', function() {
                currentChapterId = $(this).data('id');
                $('#chapterModalLongTitle').text('Edit Chapter');
                $.ajax({
                    url: `/api/chapters/${currentChapterId}`,
                    type: 'GET',
                    success: function(chapter) {
                        $('#title').val(chapter.title);
                        $('#description').val(chapter.description).trigger('input');
                        $(`input[name="audience"][value="${chapter.audience}"]`).prop('checked', true).trigger('change');
                        $(`input[name="subject"][value="${chapter.type}"]`).prop('checked', true);
                        $('#chapterModal').modal('show');
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to fetch chapter details.', 'error');
                    }
                });
            });

            // Toggle state
            $(document).on('click', '.toggle-status', function() {
                let chapterId = $(this).data('id');
                let newStatus = $(this).is(':checked');

                $.ajax({
                    url: `/api/chapters/${chapterId}/state`,
                    type: 'PATCH',
                    data: JSON.stringify({ state: newStatus }),
                    contentType: 'application/json',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function() {
                        Swal.fire('Success', 'Status updated successfully!', 'success');
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to update status.', 'error');
                        $(this).prop('checked', !newStatus);
                    }
                });
            });

            // Delete chapters
            $(document).on('click', '.chapter-delete', function() {
                let selectedChapters = $('.row-checkbox:checked').map(function() { return $(this).val(); }).get();
                if (!selectedChapters.length) {
                    Swal.fire('Warning', 'Please select at least one chapter.', 'warning');
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/api/chapters/delete',
                            type: 'POST',
                            data: JSON.stringify({ uuids: selectedChapters }),
                            contentType: 'application/json',
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            success: function() {
                                Swal.fire('Deleted!', 'Chapters deleted successfully.', 'success');
                                fetchChapters(1, perPage);
                            },
                            error: function() {
                                Swal.fire('Error', 'Failed to delete chapters.', 'error');
                            }
                        });
                    }
                });
            });

            // Reset form
            function resetForm() {
                $('#chapterModalLongTitle').text('Create Chapter');
                $('#title').val('');
                $('#description').val('').trigger('input');
                $('input[name="audience"]').prop('checked', false);
                $('input[name="subject"]').prop('checked', false);
                $('#sat_type_1, #sat_type_2').addClass('d-none');
                currentChapterId = null;
            }

            $('.create-button').on('click', resetForm);

            // Form data
            function getFormData() {
                return {
                    title: $('#title').val(),
                    description: $('#description').val(),
                    audience: $('input[name="audience"]:checked').val(),
                    type: $('input[name="subject"]:checked').val(),
                };
            }

            // Pagination and filters
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).data('page');
                if (page) {
                    currentPage = page;
                    fetchChapters(currentPage, perPage);
                }
            });

            $('#rowsPerPage').on('change', function() {
                perPage = $(this).val();
                currentPage = 1;
                fetchChapters(currentPage, perPage);
            });

            let searchTimeout;
            $('.search_input').on('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    currentPage = 1;
                    fetchChapters(currentPage, perPage);
                }, 300);
            });

            $('.apply-filter-btn').on('click', function() {
                currentPage = 1;
                fetchChapters(currentPage, perPage);
                $('#taskSidebar').removeClass('open');
                $('#taskSidebarOverlay').removeClass('active');
            });

            $('.reset-filter').on('click', function() {
                $('.search_input').val('');
                $('input[name="created_start_at"]').val('');
                $('input[name="created_end_at"]').val('');
                $('input[name="status"][value="All"]').prop('checked', true);
                $('input[name="audience[]"]').prop('checked', false);
                $('input[name="subject[]"]').prop('checked', false);
                $('#date-range').text('All time');
                currentPage = 1;
                fetchChapters(currentPage, perPage);
            });

            // Initial fetch
            fetchChapters(currentPage, perPage);
        });
    </script>
    @endpush
</x-backend.layouts.master>

