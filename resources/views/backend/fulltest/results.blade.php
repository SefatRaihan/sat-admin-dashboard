<x-backend.layouts.student-master>
    <div class="mt-3">
        <h4 class="text-center score-title">Your score: <span class="scoreValue">75</span></h4>
        <p class="text-center score-text">Your performance is better than <b><span class="scoreValue">75</span>% of <span class="studentName">Mubhir</span> student</b> who have <br> completed this exam</p>
        <div class="mt-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <p class="summary-text">Your Percent Correct</p>
                            <p class="summary-value"><b>0%</b></p>
                            <p class="summary-description">(<span class="correct-answers">0</span> of <span class="total-questions">3</span>)</p>
                        </div>
                    
                        <div class="col-md-4 text-center">
                            <p class="summary-text">Your Average Pace</p>
                            <p class="summary-value"><b>0:03</b></p>
                            <p class="summary-description">(<span class="total-time">0:10</span> total)</p>
                        </div>
                    
                        <div class="col-md-4 text-center">
                            <p class="summary-text">Others' Average Pace</p>
                            <p class="summary-value"><b>0:45</b></p>
                            <p class="summary-description">(<span class="others-total-time">2:16</span> total)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 style="font-size: 30px; color:#000000; font-weight:600">Question list</h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="text" id="search" class="form-control search__input" placeholder="Search Notification" style="padding-left: 35px; margin-right:13px;">
        
                        <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px; width:200px; height: 38px;" onclick="filter(this)"><img src="{{ asset('image/icon/layer.png') }}" alt=""> Filters</button>
    
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

                <div>
                    <div class="questionListTableWrapper">
                        <table class="table  questionListTable">
                            <thead>
                                <tr class="bg-light">
                                    <th>Result</th>
                                    <th>Question Title</th>
                                    <th>Section</th>
                                    <th>Difficulty level</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sample</td>
                                    <td>Sample Title</td>
                                    <td>Sample Section</td>
                                    <td><span class="badge badge-pill badge-easy">Easy</span></td>
                                    <td>10:00</td>
                                    <td>View</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
    </div>

    @push('css')
        <style>
            .score-title {
                color: #101828;
                font-size: 30px;
                font-weight: 700;
                line-height: 38px;
            }

            .summary-text {
                color: #000000;
                font-size: 16px;
                font-weight: 500;
            }

            .summary-value {
                color: #000000
                font-size: 24px;
                font-weight: 600;
            }

            .summary-description {
                color: #000000;
                font-size: 14px;
                font-weight: 500;
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
                background-position: 10px center; /* Adjusted to position the icon to the left */
                border-radius: 50px;
                transition: all 250ms ease-in-out;
                backface-visibility: hidden;
                transform-style: preserve-3d;
                padding-left: 36px; /* Ensures the placeholder doesn't overlap with the icon */
            }
            
            .search__input::placeholder {
                padding-left: 30px;
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

            .questionListTableWrapper {
                border: 1px solid #ddd !important;
                border-radius: 18px !important;
                overflow: hidden; /* Ensures content respects rounded corners */
            }

            .questionListTable {
                border-collapse: collapse; /* Removes gaps between cells */
                width: 100%; /* Ensures table fills the wrapper */
            }
            .table thead th {
                vertical-align: middle;
                border-bottom: 0px;
            }

            .table td {
                border: 0px solid #ddd !important;
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
    <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_multiselect.js"></script>
    @endpush
</x-backend.layouts.student-master>