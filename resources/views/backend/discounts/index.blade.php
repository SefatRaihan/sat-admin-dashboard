<x-backend.layouts.master>
    <div class="page-header-content header-elements-md-inline pl-0 ml-0 pr-0 mr-0">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-semibold header-title">
                    Discount Coupons
                </span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">

            <div class="d-flex justify-content-end">

                <div class="">
                    <a href="/discounts/create" class="btn create-btn" style="background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px; color:#fff">Add Coupon Code</a>
                </div>

            </div>
        </div>
    </div>

    <div class="card-header d-flex justify-content-between">
        <div>
            <input type="text" id="search" class="form-control search_input" style="background-color: #fff" placeholder="Search Discount" style="padding-left: 40px">
        </div>

        <div class="d-flex">
            <div class="form-group mb-0">
                <select class="form-control" id="sortSelect" style="width: 200px">
                    <option value="">Filter By Status</option>
                    <option value="Latest">Latest</option>
                    <option value="Oldest">Oldest</option>
                </select>
            </div>
            <button class="btn btn-success ml-2" style="border-radius: 12px">Export CSV</button>
        </div>
    </div>

    <section>
        <div id="discountList">
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px; border-radius: 12px;">
                
                <div class="card-body p-0 m-0 table-responsive">
                    <!-- Questions Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr align="center">
                                    <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                                    <th class="text-left">Discount Code</th>
                                    <th class="text-left">Discount Type</th>
                                    <th class="text-left">Discount Amount</th>
                                    <th class="text-left">Expiry Date</th>
                                    <th class="text-left">Max Uses</th>
                                    <th class="text-left">No. Redeemed</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="question-table-body">
                                <tr>
                                    <td colspan="9" class="text-center">Loading...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-2 p-2"
                        style="border-top: 1px solid #D0D5DD; background:#F9FAFB">
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
                                <ul class="pagination pagination-sm" id="pagination-links">
                                    <!-- Pagination links will be inserted here -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- create modal --}}
    <section>
        <div class="modal fade" id="questionModal" tabindex="-1" role="dialog"
            aria-labelledby="questionModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border-radius: 24px; height:100%">
                    <div style="background: #F9FAFB;  border-bottom:1px solid #D0D5DD ">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <h4 class="text-center font-weight-bold question-modal-heading">Create a Topic</h4>

                    </div>
                    <div class="modal-body" style="padding: 10px 40px" id="topic_id" value="">
                        <div>
                            <label for="topicTitle" class="form-label">Topic Title</label>
                            <input type="text" class="form-control" id="topicTitle" name="topicTitle" required>
                        </div>
                    </div>
                    <div class="modal-footer pt-2" style="border-top: 1px solid #D0D5DD">
                        <div class="d-flex w-100 justify-content-end align-items-center">

                            <!-- Right side: Navigation buttons -->
                            <div class="d-flex">
                                <button type="button"
                                    class="btn back-btn btn-outline-secondary cancel mr-2">Cancel</button>
                                <button type="submit" class="btn save-topic"
                                    style="background:#691D5E; color: #EAECF0; border-radius: 8px;">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Question upload modal --}}
    <section>
        <div class="modal fade" id="uploadQuestion" tabindex="-1" role="dialog" aria-labelledby="uploadQuestion"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content question-create-section" style="border-radius: 24px; height:100%">
                    <div class="modal-header text-center"
                        style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                        <h3 class="" id="exampleModalLongTitle"><b>Upload CSV</b></h3>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2">
                            <x-input-label for="photo" :value="__('Photo')" />
                            <div class="photosection" ondragover="allowDrop(event)" ondrop="dropImage(event)">
                                <!-- Profile Image Preview -->
                                <img id="previewImage" src="">

                                <!-- Upload Area -->
                                <label for="profileImage" style="cursor: pointer; position: relative;">
                                    <div class="upload-icon">
                                        <img src="{{ asset('image/icon/image-upload.png') }}" alt="Upload Icon"
                                            style="width: 16.67px; height: 15px;">
                                    </div>
                                    <h5 style="font-size: 14px;">
                                        <span style="color: #521749">Click to upload</span>
                                        <span style="color: #475467"> or drag and drop</span>
                                    </h5>
                                </label>

                                <!-- Hidden File Input -->
                                <input type="file" id="profileImage" name="profile_image" accept="image/*"
                                    style="display: none;" onchange="previewImage(event)">
                            </div>

                        </div>
                        <div class="mt-2">
                            <label for="question-url">Or upload from URL</label>
                            <input type="text" class="form-control" id="question-url"
                                placeholder="Enter Url here" styele="border-radius:8px; border:1px solid #D0D5DD; ">
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-3">
                        <button type="button" class="btn btn-outline-dark"
                            style="border: 1px solid #D0D5DD; border-radius: 8px;"
                            data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn save-question"
                            style="background-color:#A16A99 ;border-radius: 8px; color:#fff">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('css')
        <!-- DataTables -->
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">

        <style>
            .nav-tabs {
                border: 1px solid #ddd;
                background-color: #F9FAFB;
                border-radius: 9px !important;
            }

            .nav-tabs .nav-link.active {
                color: #000;
                background-color: #fff;
                border-color: #fff #fff #fff;
                padding: 8px;
                margin-top: 3px;
                margin-left: 3px !important;
                border-radius: 7px !important;
                font-weight: bold;
            }

            .nav-tabs .nav-link:hover {
                background-color: transparent !important;
                color: #333 !important;
                border-radius: 8px !important;
            }

            .search_input {
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

            .search_input::placeholder {
                padding-left: 30px;
            }

            input[type='checkbox'] {
                width: 20px;
                height: 20px;
                border: 1px solid #D0D5DD !important;
                appearance: none;
                background-color: white;
                cursor: pointer;
                border-radius: 4px !important;
            }

            /* Checked state */
            input[type='checkbox']:checked {
                background-color: #3F1239;
                position: relative;
            }

            /* Adding a custom checkmark */
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

            .custom-checkbox input[type='checkbox'] {
                margin-top: 3px;
            }

            .dataTable tbody>tr.selected,
            .dataTable tbody>tr>.selected {
                background-color: #F1E9F0 !important;
            }

            .edit-btn {
                color: #344054 !important;
                width: 80px;
                background-color: #FFFFFF;
                border-radius: 8px;
                font-weight: bold;
            }

            .position-relative {
                position: relative;
            }

            .dropdown-item.active {
                background-color: #575756 !important;
                padding: 0px;
                margin: 0px;
                border-radius: 0px;
            }

            .datatable-footer,
            .datatable-header {
                padding: 1.25rem 1.25rem 0 1.25rem;
                margin-left: 17px;
                margin-right: 17px;
                margin-bottom: 17px;
            }

            .datatable-header {
                border-bottom: 1px solid #ddd;
                display: none;
            }

            .dropzone {
                position: relative;
                border: 2px solid rgba(0, 0, 0, 0.125);
                min-height: 9rem;
                background-color: #fff;
                padding: 0.3125rem;
                border-radius: 1.1875rem;
            }

            .dropzone .dz-default.dz-message:before {
                content: "";
                font-family: icomoon;
                font-size: 2rem;
                display: inline-block;
                position: absolute;
                top: 2rem;
                left: 50%;
                -webkit-transform: translateX(-50%);
                transform: translateX(-50%);
                line-height: 1;
                z-index: 2;
                color: #ccc;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            .dropzone .dz-default.dz-message>span {
                font-size: 1.0625rem;
                color: #777;
                display: block;
                margin-top: 4.25rem;
            }

            .form-check-switchery .switchery {
                position: absolute;
                top: -12px;
                left: 0;
                margin-top: 0.00002rem;
            }

            .fixed-bottom-buttons {
                border-top: 1px solid #D0D5DD;
                background-color: #fff;
                padding: 10px;
                position: sticky;
                bottom: 0;
            }

            .multiselect-native-select {
                position: relative;
                border: 1px solid #ddd;
                border-radius: 8px;
                min-width: 125px;
            }

            .multiselect:after {
                position: absolute;
                top: 50%;
                right: 2px !important;
            }

            .multiselect.btn-light {
                background-color: transparent;
                border-width: 0px 0 !important;
                border-color: #fff !important;
                border-top-color: transparent;
                border-radius: 0;
            }
            .multiselect.btn{
                padding: 8px .875rem !important;
            }
            .multiselect-container {
                max-height: 280px;
                overflow-y: auto;
                width: 200px;
            }

            .datatable-footer, .datatable-header {
                padding: 0.25rem 0.25rem 0 0.25rem;
                margin-left: 0px;
                margin-right: 0px;
                margin-bottom: 14px;
            }
        </style>
        <style>
            input[type="radio"] {
                accent-color: #691D5E;
            }

            label {
                padding-top: 2px;
            }

            .new-question {
                border: 1px solid #691D5E;
                background: #FFFFFF;
                color: #691D5E;
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

        
        </style>

    @endpush

    @push('js')

        <script>

            $('.show-edit-btn').click(function (e) {
                e.preventDefault();
                $('.show-modal-close').trigger('click');
            });

            $(".feedback-btn").on("click", function() {
                $(".feedback-btn").removeClass("active")
                $(this).addClass("active");
            });

            $(document).ready(function() {

                // start datatable code
                let currentPage = 1;
                let perPage = $('#rowsPerPage').val();

                fetchQuestions(currentPage, perPage);

                // Handle pagination clicks
                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    let page = $(this).data('page');
                    if (page) {
                        currentPage = page;
                        fetchQuestions(currentPage, perPage);
                    }
                });

                // Handle "Rows per page" change
                $('#rowsPerPage').change(function() {
                    perPage = $(this).val();
                    fetchQuestions(1, perPage);
                });

                $('#sortSelect').on('change', function() {
                    let sortOption = $(this).val();
                    fetchQuestions(1, perPage, sortOption);
                });

                //end datatable code

                $(document).on('click', '.edit-btn', show);

                $('.search_input, .multiselect').on('input click', function() {
                    fetchQuestions();
                });

                let searchTimeout;
                $('.search_input').on('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        fetchQuestions(1, $('#rowsPerPage').val());
                    }, 300); // 300ms debounce
                });

                // Apply filters button click
                $('.apply-filter-btn').on('click', function() {
                    fetchQuestions(1, $('#rowsPerPage').val());
                });

                // Reset filters button click
                $('.reset-filter-btn').on('click', function() {
                    // Reset all filter inputs
                    $('.search_input').val('');
                    $('input[name="crated_start_at"]').val('');
                    $('input[name="crated_end_at"]').val('');
                    $('.question_search_input').val('');

                    $('input[name="status"][value="All"]').prop('checked', true);
                    $('.filter-group input:checkbox').prop('checked', false);
                    $('.custom-checkbox input:checkbox').prop('checked', false);
                    $('.multiselect').val([]).trigger('change');


                    // Fetch with reset filters
                    fetchQuestions(1, $('#rowsPerPage').val());
                });

            });

            // start datatable code
            // get all questions
            function fetchQuestions(page = 1, perPage = 10, sort = 'Latest') {
                let filters = {
                    search: $('.search_input').val() || '',
                    sort: sort, // Include sort parameter
                };

                $.ajax({
                    url: `/api/topic?page=${page}&per_page=${perPage}`,
                    type: "GET",
                    data: filters,
                    success: function(response) {
                        let questionList = $('#questionList');
                        let questionNullList = $('#questionNullList');
                        let tableBody = $("#question-table-body");

                        if (response.success && response.data.data.length === 0) {
                            questionNullList.removeClass('d-none');
                            questionList.addClass('d-none');
                            tableBody.html('<tr><td colspan="3" class="text-center">No topics found.</td></tr>');
                        } else if (response.success) {
                            questionNullList.addClass('d-none');
                            questionList.removeClass('d-none');
                            tableBody.html("");

                            let rows = '';
                            $.each(response.data.data, function(index, value) {
                                rows += `
                                    <tr>
                                        <td><input type="checkbox" class="row-checkbox question-row" value="${value.id}"></td>
                                        <td>${value.name}</td>
                                        <td>${value.name}</td>
                                        <td>${value.name}</td>
                                        <td>${value.name}</td>
                                        <td>${value.name}</td>
                                        <td>${value.name}</td>
                                        <td class="text-center d-flex justify-content-center">
                                            <div class="d-flex" style="border: 1px solid #ddd; border-radius: 6px; width:114px">
                                                <a href="" class="btn edit-btn" style="border-right: 1px solid #ddd; border-radius: 0px;"><i class="far fa-edit"></i></a>
                                                <a href="" class="btn edit-btn"><i class="fas fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>`;
                            });
                            tableBody.html(rows);
                            updatePagination(response.data, page);
                        } else {
                            console.error("Error: ", response.message);
                            tableBody.html('<tr><td colspan="3" class="text-center">Error loading topics.</td></tr>');
                        }
                    },
                    error: function(xhr) {
                        console.error("Error fetching topics:", xhr.responseJSON?.message || "Unknown error");
                        $("#question-table-body").html('<tr><td colspan="3" class="text-center">Error loading topics.</td></tr>');
                    }
                });
            }

            function updatePagination(paginationData, currentPage) {
                let totalResults = paginationData.total || 0;
                let perPage = paginationData.per_page || 10;
                let totalPages = paginationData.last_page || 1;
                let start = paginationData.from || 0;
                let end = paginationData.to || 0;

                $('#pagination-info').text(`Showing ${start}-${end} out of ${totalResults} results`);

                let paginationHtml = '';

                // First & Previous
                paginationHtml += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                    <a class="page-link" href="#" data-page="1">«</a>
                                </li>`;
                paginationHtml += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                    <a class="page-link" href="#" data-page="${currentPage - 1}">‹</a>
                                </li>`;

                // Page Numbers
                let startPage = Math.max(1, currentPage - 1);
                let endPage = Math.min(totalPages, currentPage + 1);

                if (currentPage > 2) {
                    paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`;
                    if (currentPage > 3) {
                        paginationHtml += `<li class="page-item disabled"><a class="page-link" href="#">...</a></li>`;
                    }
                }

                for (let i = startPage; i <= endPage; i++) {
                    paginationHtml += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                                    </li>`;
                }

                if (currentPage < totalPages - 1) {
                    if (currentPage < totalPages - 2) {
                        paginationHtml += `<li class="page-item disabled"><a class="page-link" href="#">...</a></li>`;
                    }
                    paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a></li>`;
                }

                // Next & Last
                paginationHtml += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                    <a class="page-link" href="#" data-page="${currentPage + 1}">›</a>
                                </li>`;
                paginationHtml += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                    <a class="page-link" href="#" data-page="${totalPages}">»</a>
                                </li>`;

                $('#pagination-links').html(paginationHtml);
            }
            // end datatable code

            function formatDate(dateString) {
                let date = new Date(dateString);
                let options = { day: '2-digit', month: 'short', year: 'numeric' };
                return date.toLocaleDateString('en-GB', options); // "24 Mar 2025"
            }

            function getDifficultyColor(difficulty) {
                switch (difficulty.toLowerCase()) {
                    case "easy":
                        return "badge-easy";
                    case "medium":
                        return "badge-medium";
                    case "hard":
                        return "badge-hard";
                    case "very hard":
                        return "badge-very-hard";
                    default:
                        return "bg-secondary text-white";
                }
            }

            function destroy() {
                let selectedQuestions = getSelectedQuestions();
                if (selectedQuestions.length === 0) {
                    Swal.fire("Warning", "Please select at least one question.", "warning");
                    return;
                }

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/api/questions-delete",
                            type: "POST",
                            data: {
                                questions: selectedQuestions,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                Swal.fire("Deleted!", "Questions deleted successfully.", "success");
                                fetchQuestions(1);
                                $('#active-count').text('')
                                $('#inactive-count').text('')
                            },
                            error: function () {
                                Swal.fire("Error", "Failed to delete questions.", "error");
                            }
                        });
                    }
                });
            }

            function getSelectedQuestions() {
                let selectedQuestions = [];
                $('.question-row:checked').each(function() {
                    selectedQuestions.push($(this).val());
                });
                return selectedQuestions;
            }
        </script>
    @endpush

</x-backend.layouts.master>
