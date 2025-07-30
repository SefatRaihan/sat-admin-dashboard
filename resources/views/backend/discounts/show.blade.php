<x-backend.layouts.master>
    <div class="border-bottom d-flex justify-content-between pt-2 pl-4 pb-2">
        <h4 class="form-header text-left">Coupon Code Details</h4>
        <div class="d-flex">
            <button class="btn"><img src="{{ asset('image/icon/cross.png') }}" style="width: 12px; height:12px" alt=""></button>
            <button class="btn ml-2"><img src="{{ asset('image/icon/download.png') }}" style="width: 18px; height:18px" alt=""></button>
        </div>
    </div>

    <div class="p-3">
        <table class="table table-striped custom-table" style="border: 1px solid #EAECF0">
            <tr>
                <td style="width: 25%">Discount Code</td>
                <td class="font-weight-bold" style="width: 25%">: </td>

                <td style="width: 25%">Discount Type</td>
                <td class="font-weight-bold" style="width: 25%">: </td>
            </tr>

            <tr>
                <td style="width: 25%">Discount Amount</td>
                <td class="font-weight-bold" style="width: 25%">: </td>

                <td style="width: 25%">Expiry Date</td>
                <td class="font-weight-bold" style="width: 25%">: </td>
            </tr>

            <tr>
                <td style="width: 25%">Maximum No. of Uses</td>
                <td class="font-weight-bold" style="width: 25%">: </td>

                <td style="width: 25%">No. Redeemed</td>
                <td class="font-weight-bold" style="width: 25%">: </td>
            </tr>
        </table>
    </div>

    <div class="pl-3">
        <a href=" class="btn create-btn" style="background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px; color:#fff">Edit Discount</a>
    </div>

    <div class="p-3 pb-0" style="padding-bottom: 0px !important; margin-bottom:0px !important">
        <h4>Users Who Redeemed This Discount</h4>
    </div>

    <section class="p-3 pt-0 mt-0" style="padding-top: 0px !important; margin-top:0px !important">
        <div id="discountList">
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px; border-radius: 12px;">
                
                <div class="card-body p-0 m-0 table-responsive">
                    <!-- Questions Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr align="center">
                                    <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                                    <th class="text-left">User Name</th>
                                    <th class="text-left">Role</th>
                                    <th class="text-left">Date Redeemed</th>
                                    <th class="text-left">Amount Saved (SAR)</th>
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

    <div class="fixed-bottom border-top p-3 bg-white d-flex justify-content-end" style="left: 272px;">
        <div>
            <a href="/discounts"  class="btn btn-primary btn-action" style="background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px; color:#fff">Close</a>
        </div>
    </div>

    @push('css')
        <style>
            .content {
                padding: 0;
                margin:0;
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