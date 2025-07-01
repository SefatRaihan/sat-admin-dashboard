<x-backend.layouts.master>
    @php
        $prependHtml = '
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                <a data-toggle="modal" data-target="#lessonModal" class="create-button btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm" style="background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px">
                    <i class="fas fa-plus" style="font-size: 12px; margin-right: 5px; margin-top: 5px;"></i> Manage Lesson
                </a>
            </div>
        ';
    @endphp

    <x-backend.layouts.partials.blocks.contentwrapper :headerTitle="'Manage Lesson'" :prependContent="$prependHtml">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div class="d-none" id="lessonNullList">
        <x-backend.layouts.partials.blocks.empty-state
            title="add lesson"
            message=""
            buttonText="Add Lesson"
            buttonRoute="#lessonModal"
        />
    </div>

    <div id="lessonList">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
            <div class="card-header border-bottom d-flex justify-content-between">
                <div>
                    <input type="text" id="search" class="form-control search_input" placeholder="Search Lesson" style="padding-left: 40px">
                </div>
                <div class="d-flex">
                    <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;">
                        <img src="{{ asset('image/icon/layer.png') }}" alt=""> Filters
                    </button>
                </div>
            </div>
            <div class="card-body p-0 m-0 table-responsive">
                <div class="d-flex justify-content-between align-items-center mt-3 p-2">
                    <h4><strong id="total-lessons"></strong></h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr class="bg-light">
                                <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                                <th>Question</th>
                                <th>Audience</th>
                                <th>Q. Type</th>
                                <th>Exam</th>
                                <th>Difficulty</th>
                                <th>Avg. Time</th>
                                <th>Created</th>
                                <th>State</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="lesson-table-body">
                            <tr>
                                <td colspan="7" class="text-center">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2 p-2" style="border-top: 1px solid #D0D5DD; background:#F9FAFB">
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
        <div class="modal fade" id="lessonModal" tabindex="-1" role="dialog" aria-labelledby="lessonModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="width:60%">
                <div class="modal-content" style="border-radius: 24px; height:100%">
                    <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                        <h5 class=""><b id="lessonpleModalLongTitle">Create Lesson</b></h5>

                        <p class="pb-2 step-1">Step 1 : Choose Audience and Subject to Get Started</p>
                        <p class="pb-2 d-none step-2">Step 2 :  Upload Videos and PDF Files</p>
                    </div>
                    <div class="modal-body" style="height: 100%;">
                        <div class="step-1">
                            <label class="label-header" for="">1. Select the Audience</label>
                            <div class="row" style="margin-left: 3px">
                                <div class="col-md-6 row">
                                    <label class="radio-container mb-3 col-md-12">
                                        <input class="sat_1" type="radio" name="audience" value="High School"> High School
                                    </label>
                                    <label class="radio-container mb-3 col-md-12">
                                        <input class="sat_1" type="radio" name="audience" value="Graduation"> Graduation
                                    </label>
                                </div>
                                <div class="col-md-6 row">
                                    <label class="radio-container mb-3 col-md-12">
                                        <input class="sat_1" type="radio" name="audience" value="College"> College
                                    </label>
                                    <label class="radio-container mb-3 col-md-12">
                                        <input class="sat_2" type="radio" name="audience" value="SAT 2"> SAT 2
                                    </label>
                                </div>
                            </div>
                            <div class="">
                                <div id="sat_type_1" class="d-none">
                                    <h5 class="mt-3 label-header">2. Select the Question Type</h5>
                                    <div class="row">
                                        <div class="col-md-12 row">
                                            <div class="col-md-6 mb-2">
                                                <label class="radio-container mb-3 col-md-12">
                                                    <input class="" type="radio" name="question_type" value="Verbal"> Verbal
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label class="radio-container mb-3 col-md-12">
                                                    <input class="" type="radio" name="question_type" value="Quant"> Quant
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="sat_type_2" class="d-none">
                                    <h5 class="mt-3"><strong>2. Select the Question Subject</strong></h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="radio-container mb-3 col-md-12">
                                                <input class="" type="radio" name="subjects" value="Physics"> Physics
                                            </label>
                                            <label class="radio-container mb-3 col-md-12">
                                                <input class="" type="radio" name="subjects" value="Chemistry"> Chemistry
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="radio-container mb-3 col-md-12">
                                                <input class="" type="radio" name="subjects" value="Biology"> Biology
                                            </label>
                                            <label class="radio-container mb-3 col-md-12">
                                                <input class="" type="radio" name="subjects" value="Math"> Math
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="step-2 d-none">
                            <div class="">
                                <div class="lessons-section">
                                    <h2>Lessons</h2>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>File Type</th>
                                                <th>File size</th>
                                            </tr>
                                        </thead>
                                        <tbody id="lessonsTableBody">
                                            </tbody>
                                    </table>
                                </div>

                                <div class="upload-files-section">
                                    <h2>Upload Files</h2>
                                    <div class="drop-zone" id="dropZone">
                                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                        <p><strong>Click to upload</strong> or drag and drop</p>
                                        <p>JPEG, PNG, PDF, GIF, MP3 and MP4 formats</p>
                                        <input type="file" id="fileInput" multiple accept=".jpeg,.jpg,.png,.pdf,.gif,.mp3,.mp4" style="display: none;">
                                        <button id="chooseFilesBtn">Choose files</button>
                                        <p>[Max: 350MB]</p>
                                    </div>

                                    <div class="uploading-list" id="uploadingList">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-3">
                        <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                        <a href="#" class="btn next-step-2" style="background-color:#691D5E; border-radius: 8px; color:#D0D5DD">Next</a>
                        <a href="#" class="btn save-lesson d-none" style="background-color:#691D5E; border-radius: 8px; color:#D0D5DD">Add Lesson</a>
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
                            <p style="font-size: 12px"><span style="color: #344054"><b>Created on:</b></span> <span style="color: #475467">06 Jan 25 - 12 Jan 25</span></p>
                            <button class="reset-slider"><u>Reset</u></button>
                        </div>
                        <div class="mt-1 mb-2 d-flex justify-content-between">
                            <div style="width: 49%">
                                <input type="date" class="form-control" name="crated_start_at">
                            </div>
                            <div style="align-items: center; display: flex; width:1%">-</div>
                            <div style="width: 49%">
                                <input type="date" class="form-control" name="crated_end_at">
                            </div>
                        </div>
                        <div id="filter-status">
                            <div class="d-flex justify-content-between">
                                <h6><b>Status:</b> Active Only</h6>
                            </div>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="all" value="All" checked>
                                <label class="form-check-label" for="all">All</label>
                            </div>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="activeonly" value="Active only">
                                <label class="form-check-label" for="activeonly">Active only</label>
                            </div>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="inactiveonly" value="Inactive only">
                                <label class="form-check-label" for="inactiveonly">Inactive only</label>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="d-flex justify-content-between">
                                <h6><b>Audience & Type:</b> All Result</h6>
                            </div>
                            <div id="all_sat_type_1">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="toggle-parent" type="checkbox" id="allSet1Toggle">
                                        <label class="form-check-label" for="allSet1Toggle">All SAT 1</label>
                                        <span class="toggle-icon" data-target="allSet1"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="nested-options collapse" id="allSet1">
                                        <div class="form-check">
                                            <input type="checkbox" value="High School" name="audience[]">High School
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Graduation" name="audience[]">Graduation
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="College" name="audience[]">College
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="all_sat_type_2">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="toggle-parent" type="checkbox" id="allSet2Toggle">
                                        <label class="form-check-label" for="allSet2Toggle">All SAT 2</label>
                                        <span class="toggle-icon" data-target="allSet2"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="nested-options collapse" id="allSet2">
                                        <div class="form-check">
                                            <input type="checkbox" value="SAT 2" name="audience[]">SAT 2
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="section_types">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class="toggle-parent" type="checkbox" id="sectionTypeToggle">
                                        <label class="form-check-label" for="sectionTypeToggle">Section Types</label>
                                        <span class="toggle-icon" data-target="sectionTypes"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="nested-options collapse" id="sectionTypes">
                                        <div class="form-check">
                                            <input type="checkbox" value="Physics" name="sat_type[]">Physics
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Chemistry" name="sat_type[]">Chemistry
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Biology" name="sat_type[]">Biology
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Math" name="sat_type[]">Math
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Verbal" name="sat_type[]">Verbal
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Quant" name="sat_type[]">Quant
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Mixed" name="sat_type[]">Mixed
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="d-flex justify-content-between">
                                <h6><b>Difficulty Level:</b> All Result</h6>
                            </div>
                            <div class="form-check custom-checkbox d-flex justify-center">
                                <input type="checkbox" class="difficulty" value="Easy">
                                <label class="form-check-label pl-1"><span class="badge badge-pill badge-easy"><b>Easy</b></span></label>
                            </div>
                            <div class="form-check custom-checkbox d-flex justify-center">
                                <input type="checkbox" class="difficulty" value="Medium">
                                <label class="form-check-label" for="medium"><span class="badge badge-pill badge-medium"><b>Medium</b></span></label>
                            </div>
                            <div class="form-check custom-checkbox d-flex justify-center">
                                <input type="checkbox" class="difficulty" value="Hard">
                                <label class="form-check-label" for="hard"><span class="badge badge-pill badge-hard"><b>Hard</b></span></label>
                            </div>
                            <div class="form-check custom-checkbox d-flex justify-center">
                                <input type="checkbox" class="difficulty" value="Very Hard">
                                <label class="form-check-label" for="very-hard"><span class="badge badge-pill badge-very-hard"><b>Very Hard</b></span></label>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="slider-container" style="max-width: 100%!important;">
                                <div class="slider-header">
                                    <span>Average Time: All Result</span>
                                </div>
                                <div class="range-slider">
                                    <input type="range" min="1" max="120" value="1" id="min-range">
                                    <input type="range" min="1" max="120" value="120" id="max-range">
                                </div>
                                <div class="slider-labels">
                                    <span id="min-label">0m 1s</span>
                                    <span id="max-label">2m 0s</span>
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
    <link rel="stylesheet" href="{{ asset('css/lesson.css') }}">
    <style>
        #chartdiv, #areaChartdiv {
            width: 100%;
            height: 300px;
        }

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
            background-color: transparent;
            font-size: 14px;
            color: #575756;
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 0 3 3 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: 18px 18px;
            background-position: 10px center;
            border-radius: 50px;
            padding-left: 36px;
        }

        .search_input::placeholder {
            padding-left: 30px;
        }

        .nav-tabs {
            border: 1px solid #ddd;
            background-color: #F9FAFB;
            border-radius: 8px;
        }

        .nav-tabs .nav-link.active {
            color: #000;
            background-color: #fff;
            border-color: transparent;
            padding: 8px;
            margin-top: 3px;
            margin-left: 3px;
            border-radius: 7px;
            font-weight: bold;
        }

        .nav-tabs .nav-link:hover {
            background-color: transparent;
            color: #333;
            border-radius: 8px;
        }

        input[type='checkbox'] {
            width: 20px;
            height: 20px;
            border: 1px solid #D0D5DD;
            appearance: none;
            background-color: white;
            cursor: pointer;
            border-radius: 4px !important;
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

        .dataTable tbody > tr.selected, .dataTable tbody > tr > .selected {
            background-color: #F1E9F0;
        }

        .change-btn {
            color: #ffffff;
            background-color: #521749;
            border: 1px solid #A16A99;
            width: 80px;
            border-radius: 5px;
            font-weight: bold;
        }

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

        .form-check-input:checked {
            background-color: #732066;
            border-color: #732066;
            margin: 2px;
        }

        .form-check-input:checked + .form-check-label {
            color: #344054;
            font-weight: 500;
        }

        .form-check:hover {
            border-color: #732066;
        }

        .form-check-input {
            position: absolute;
            opacity: 0;
        }

        .form-check-label {
            position: relative;
            cursor: pointer;
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

        .status-radio .form-check-label::before {
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

        .status-radio .form-check-input:checked + .form-check-label::before {
            border-color: #732066;
            background-color: #732066;
            width: 10px;
            height: 10px;
            margin-left: 4px;
            box-shadow: 0 0 0 2px white, 0 0 0 4px #732066;
        }

        .form-check-input:checked ~ .form-check-label {
            color: #344054;
            font-weight: 500;
        }

        .custom-radio:has(.form-check-input:checked) {
            background-color: #F1E9F0;
            border-color: #A16A99;
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
            display: flex;
            flex-direction: column;
        }

        .filter-sidebar-content {
            flex-grow: 1;
            height: calc(100vh - 120px);
            overflow-y: auto;
            padding-left: 15px;
            padding-bottom: 60px;
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

        .sidebar-header {
            padding: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #D0D5DD;
        }

        .floating-sidebar.open {
            right: 0;
        }

        .sidebar-overlay.active {
            display: block;
        }

        .filter-group {
            margin-bottom: 10px;
        }

        .form-check {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 8px;
            cursor: pointer;
        }

        .nested-options {
            margin-left: 24px;
            display: none;
        }

        .toggle-icon {
            cursor: pointer;
            font-size: 14px;
            transition: transform 0.3s ease-in-out;
            margin-left: auto;
        }

        .toggle-icon.open {
            transform: rotate(180deg);
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            accent-color: #4B1D3F;
        }

        .form-check-label {
            font-size: 14px;
            color: #333;
        }

        .slider-container {
            width: 100%;
            max-width: 300px;
            font-family: Arial, sans-serif;
        }

        .slider-header {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .reset-slider {
            background: none;
            border: none;
            color: black;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            text-decoration: underline;
        }

        .range-slider {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .range-slider input {
            -webkit-appearance: none;
            width: 100%;
            position: absolute;
            background: transparent;
            pointer-events: none;
        }

        .range-slider input::-webkit-slider-runnable-track {
            background: #E0E0E0;
            height: 4px;
            border-radius: 2px;
        }

        .range-slider input::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            background: white;
            border: 3px solid #69275C;
            border-radius: 50%;
            cursor: pointer;
            pointer-events: auto;
            margin-top: -6px;
        }

        .slider-labels {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-top: 8px;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }

        .task-form .form-control {
            border: 1px solid #ddd;
            padding-left: 4px;
            padding-right: 4px;
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

        .new-question, .next-step, .back-btn {
            border-radius: 8px;
        }

        .modal-content {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        }

        .badge-pill {
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 14px;
        }

        .badge-easy { background-color: #d4edda; color: #28a745; border: 1px solid #28a745; }
        .badge-medium { background-color: #d1ecf1; color: #17a2b8; border: 1px solid #17a2b8; }
        .badge-hard { background-color: #fff3cd; color: #fab905; border: 1px solid #fab905; }
        .badge-very-hard { background-color: #f8d7da; color: #dc3545; border: 1px solid #dc3545; }

    </style>
    @endpush

    @push('js')
    <script>
        $(document).ready(function() {
            $(".sat_2").change(function() {
                $('#sat_type_1').find('input').prop('checked', false);
                $("#sat_type_2").removeClass("d-none");
                $("#sat_type_1").addClass("d-none");
            });

            $(".sat_1").change(function() {
                $('#sat_type_2').find('input').prop('checked', false);
                $("#sat_type_1").removeClass("d-none");
                $("#sat_type_2").addClass("d-none");
            });

            $('.next-step-2').on('click', function() {
                $('.step-1').addClass('d-none');
                $('.step-2').removeClass('d-none');
                $('.save-lesson').removeClass('d-none');
                $('.next-step-2').addClass('d-none');
            });

            // Sidebar toggle
            $('#closeSidebar, #taskSidebarOverlay').on('click', function() {
                $('#taskSidebar').removeClass('open');
                $('#taskSidebarOverlay').removeClass('active');
            });

            // Filter sidebar toggle
            window.filter = function(button) {
                $('#taskSidebar').addClass('open');
                $('#taskSidebarOverlay').addClass('active');
            };

            // Filter dropdowns
            $('.toggle-icon').on('click', function() {
                const target = $('#' + $(this).data('target'));
                target.toggleClass('collapse');
                $(this).toggleClass('open');
                target.css('display', target.hasClass('collapse') ? 'none' : 'block');
            });

            $('.toggle-parent').on('change', function() {
                const target = $('#' + $(this).next().next().data('target'));
                target.find('input[type="checkbox"]').prop('checked', this.checked);
            });

            // Slider for average time
            const minRange = $('#min-range');
            const maxRange = $('#max-range');
            const minLabel = $('#min-label');
            const maxLabel = $('#max-label');

            function updateSlider() {
                let minValue = parseInt(minRange.val());
                let maxValue = parseInt(maxRange.val());

                if (maxValue - minValue < 10) {
                    if (minValue > maxValue - 10) minRange.val(maxValue - 10);
                    else maxRange.val(minValue + 10);
                }

                minValue = parseInt(minRange.val());
                maxValue = parseInt(maxRange.val());

                minLabel.text(`${Math.floor(minValue / 60)}m ${minValue % 60}s`);
                maxLabel.text(`${Math.floor(maxValue / 60)}m ${maxValue % 60}s`);
            }

            minRange.on('input', updateSlider);
            maxRange.on('input', updateSlider);
            updateSlider();

            // Checkbox selection
            function toggleDeleteButton() {
                $('.delete-btn').toggleClass('d-none', $('.row-checkbox:checked').length === 0);
            }

            $(document).on('change', '.row-checkbox', function() {
                $(this).closest('tr').toggleClass('selected', this.checked);
                $(this).closest('tr').css('background-color', this.checked ? '#F1E9F0' : '');
                toggleDeleteButton();
            });

            $('#selectAll').on('change', function() {
                $('.row-checkbox').prop('checked', this.checked).closest('tr').toggleClass('selected', this.checked);
                $('.row-checkbox').each(function() {
                    $(this).closest('tr').css('background-color', this.checked ? '#F1E9F0' : '');
                });
                toggleDeleteButton();
            });

            // Lesson modal handling
            $('.sat_2').on('change', function() {
                $('.sat_type_2').removeClass('d-none');
                $('.sat_type_1').addClass('d-none');
            });

            $('.sat_1').on('change', function() {
                $('.sat_type_1').removeClass('d-none');
                $('.sat_type_2').addClass('d-none');
            });

            $(document).on('input change', '.no_of_lessons, .duration', calculateTotalSectionValues);
            $(document).on('change', 'input[name="section"]', section);
            $(document).on('click', '.save-lesson', store);
            $(document).on('click', '.lesson-delete', destroy);
            $(document).on('change', '.toggle-status', updateState);
            $(document).on('click', '.edit-btn', show);
            $(document).on('click', '.create-button', function() {
                // $('.save-lesson').removeClass('d-none');
                $('.edit-lesson').addClass('d-none');
                resetData();
            });

            $('.edit-lesson').on('click', function(e) {
                e.preventDefault();
                $('#confirmationModal').modal('show');
            });

            $(document).on('click', '#proceedBtn', function(e) {
                let lessonId = $('.edit-lesson').data('id');
                update(lessonId, e);
            });

            $(document).on('click', '.openDetailModal', openDetailModal);
            $(document).on('click', '.move-ranking', moveRanking);
            $(document).on('click', '.update-ranking', updateRankingModal);

            // Datatable initialization
            let currentPage = 1;
            let perPage = $('#rowsPerPage').val();
            fetchLessons(currentPage, perPage);

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).data('page');
                if (page) {
                    currentPage = page;
                    fetchLessons(currentPage, perPage);
                }
            });

            $('#rowsPerPage').on('change', function() {
                perPage = $(this).val();
                fetchLessons(1, perPage);
            });

            let searchTimeout;
            $('.search_input').on('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    fetchLessons(1, $('#rowsPerPage').val());
                }, 300);
            });

            $('.apply-filter-btn').on('click', function() {
                fetchLessons(1, $('#rowsPerPage').val());
            });

            $('.reset-filter').on('click', function() {
                $('.search_input').val('');
                $('input[name="crated_start_at"]').val('');
                $('input[name="crated_end_at"]').val('');
                $('input[name="status"][value="All"]').prop('checked', true);
                $('.filter-group input:checkbox').prop('checked', false);
                $('.custom-checkbox input:checkbox').prop('checked', false);
                minRange.val(1);
                maxRange.val(120);
                updateSlider();
                fetchLessons(1, $('#rowsPerPage').val());
            });
        });

        function section() {
            var sectionValue = $('input[name="section"]:checked').val();
            $('.section_part').addClass('d-none');
            for (let i = 1; i <= sectionValue; i++) {
                $('.section_div_' + i).removeClass('d-none');
            }
            calculateTotalSectionValues();
        }

        function calculateTotalSectionValues() {
            let totalLessons = 0;
            let totalDuration = 0;

            $('.section_part:not(.d-none)').each(function() {
                const no_of_lessons = parseInt($(this).find('input[name="no_of_questions"]').val()) || 0;
                const duration = parseInt($(this).find('input[name="duration"]').val()) || 0;
                totalLessons += no_of_lessons;
                totalDuration += duration;
            });

            $('#total_questions').val(totalLessons);
            $('#total_duration').val(totalDuration);
        }

        function store(e) {
            e.preventDefault();
            $.ajax({
                url: '/api/lessons',
                type: 'POST',
                data: getFormData(),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success', 'Lesson created successfully!', 'success').then(() => {
                            window.location.href = response.redirect;
                        });
                    } else {
                        Swal.fire('Error', 'Failed to create lesson!', 'error');
                    }
                },
                error: function(error) {
                    let errors = error.responseJSON.errors;
                    let errorMessage = errors ? Object.keys(errors).map(field => `${field.replace('_', ' ')}: ${errors[field].join(', ')}`).join('\n') : 'An unexpected error occurred.';
                    Swal.fire('Validation Error', errorMessage, 'error');
                }
            });
        }

        function fetchLessons(page = 1, perPage = 10) {
            let filters = {
                search: $('.search_input').val(),
                difficulty: $('.difficulty:checked').map((_, el) => el.value).get(),
                crated_start_at: $('input[name="crated_start_at"]').val(),
                crated_end_at: $('input[name="crated_end_at"]').val(),
                status: $('input[name="status"]:checked').val(),
                audience: $('input[name="audience[]"]:checked').map((_, el) => el.value).get(),
                sat_type: $('input[name="sat_type[]"]:checked').map((_, el) => el.value).get(),
                created_by: $('.created_by:checked').map((_, el) => el.value).get(),
                average_time: {
                    min: $('#min-range').val(),
                    max: $('#max-range').val()
                }
            };

            $.ajax({
                url: `/api/ranking?page=${page}&per_page=${perPage}`,
                type: 'GET',
                data: filters,
                success: function(response) {
                    let lessonNullList = $('#lessonNullList');
                    let lessonList = $('#lessonList');
                    let tableBody = $('#lesson-table-body');
                    let maxLessonCount = response.total;

                    $('#max-lesson-count').text(maxLessonCount);

                    if (response.data.length === 0) {
                        if (page === 1 && Object.values(filters).every(val => !val || (Array.isArray(val) && !val.length))) {
                            lessonNullList.removeClass('d-none');
                            lessonList.addClass('d-none');
                        } else {
                            lessonNullList.addClass('d-none');
                            lessonList.removeClass('d-none');
                            tableBody.html('<tr><td colspan="11" class="text-center">No lessons found.</td></tr>');
                        }
                    } else {
                        lessonNullList.addClass('d-none');
                        lessonList.removeClass('d-none');

                        let rows = '';
                        $.each(response.data, function(index, lesson) {
                            let statusChecked = lesson.status === 'active' ? 'checked' : '';

                            rows += `<tr>
                                <td><input type="checkbox" class="row-checkbox lesson-row" value="${lesson.uuid}"></td>
                                <td>
                                    <video width="70" height="50" controls>
                                    <source src="movie.mp4" type="video/mp4">
                                    </video>
                                </td>
                                <td>Variables & Expressions</td>
                                <td>High School</td>
                                <td>Verbal</td>
                                <td>Fundamentals of Algebra</td>
                                <td>50 min 52 s</td>
                                <td>22 Jan, 25 Admin</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-status" data-id="${lesson.id}" ${statusChecked}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <button data-uuid="f120efeb-1bb6-436c-90cc-7c467469f314" class="btn btn-sm edit-lesson-btn" data-toggle="modal" data-target="#lessonEditModelCenter">
                                        <i class="far fa-edit"></i> Edit
                                    </button>
                                </td>
                            </tr>`;
                        });
                        tableBody.html(rows);
                        updatePagination(response, page);
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Error fetching lessons.', 'error');
                }
            });
        }

        function updatePagination(response, currentPage) {
            let totalResults = response.total;
            let perPage = response.per_page;
            let totalPages = response.last_page;
            let start = response.from || 0;
            let end = response.to || 0;

            $('#pagination-info').text(`Showing ${start}-${end} out of ${totalResults} results`);
            $('#total-lessons').text(`${totalResults} Lessons`);

            let paginationHtml = `
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="1">«</a>
                </li>
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${currentPage - 1}">‹</a>
                </li>
            `;

            if (currentPage > 2) {
                paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`;
                paginationHtml += `<li class="page-item disabled"><a class="page-link" href="#">...</a></li>`;
            }

            for (let i = Math.max(1, currentPage - 1); i <= Math.min(totalPages, currentPage + 1); i++) {
                paginationHtml += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>`;
            }

            if (currentPage < totalPages - 1) {
                paginationHtml += `<li class="page-item disabled"><a class="page-link" href="#">...</a></li>`;
                paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a></li>`;
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

        function updateState() {
            let lessonId = $(this).data('id');
            let newStatus = $(this).is(':checked') ? 'active' : 'inactive';

            $.ajax({
                url: `/api/lessons/${lessonId}/update-status`,
                type: 'PATCH',
                data: { status: newStatus },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success', 'Status updated successfully!', 'success');
                    } else {
                        Swal.fire('Error', 'Failed to update status.', 'error');
                        $(this).prop('checked', !$(this).is(':checked'));
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Something went wrong!', 'error');
                    $(this).prop('checked', !$(this).is(':checked'));
                }
            });
        }

        function destroy() {
            let selectedLessons = $('.row-checkbox:checked').map(function() { return $(this).val(); }).get();
            if (!selectedLessons.length) {
                Swal.fire('Warning', 'Please select at least one lesson.', 'warning');
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/api/lesson-delete',
                        type: 'POST',
                        data: { lessons: selectedLessons, _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            Swal.fire('Deleted!', 'Lessons deleted successfully.', 'success');
                            fetchLessons(1);
                        },
                        error: function() {
                            Swal.fire('Error', 'Failed to delete lessons.', 'error');
                        }
                    });
                }
            });
        }

        function show() {
            let lessonId = $(this).data('id');
            $('.edit-lesson').data('id', lessonId);
            $('#proceedBtn').data('lesson-id', lessonId);
            $('.save-lesson').addClass('d-none');
            $('.edit-lesson').removeClass('d-none');
            resetData();

            $.get(`/api/lessons/${lessonId}`, function(response) {
                $('#lessonpleModalLongTitle').text('Edit Lesson');
                $('input[name="audience"][value="' + response.sections[0].audience + '"]').prop('checked', true).trigger('change');
                $('input[name="section"][value="' + response.section + '"]').prop('checked', true).trigger('change');
                $('#title').val(response.title);

                $.each(response.sections, function(index, section) {
                    let sectionDiv = $(`.section_div_${index + 1}`);
                    if (sectionDiv.length) {
                        sectionDiv.attr('section-id', section.id);
                        sectionDiv.find('[name="lesson_name"]').val(section.title);
                        sectionDiv.find('[name="no_of_questions"]').val(section.num_of_questions);
                        sectionDiv.find('[name="duration"]').val(section.duration);
                        sectionDiv.find(`[name="sat_type_section_${index+1}"][value="${section.section_type}"]`).prop('checked', true);
                    }
                });
                calculateTotalSectionValues();
                $('#lessonModal').modal('show');
            });
        }

        function update(lessonId, e) {
            e.preventDefault();
            $.ajax({
                url: `/api/lessons/${lessonId}`,
                method: 'PATCH',
                data: getFormData(),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success', 'Lesson updated successfully!', 'success').then(() => {
                            window.location.href = response.redirect;
                        });
                    } else {
                        Swal.fire('Error', 'Failed to update the lesson!', 'error');
                    }
                },
                error: function(error) {
                    let errors = error.responseJSON.errors;
                    let errorMessage = errors ? Object.keys(errors).map(field => `${field.replace('_', ' ')}: ${errors[field].join(', ')}`).join('\n') : 'An unexpected error occurred.';
                    Swal.fire('Validation Error', errorMessage, 'error');
                }
            });
        }

        function getFormData() {
            let formData = {
                title: $('#title').val(),
                audience: $('input[name="audience"]:checked').val(),
                section: parseInt($('input[name="section"]:checked').val()) || null,
                section_details: [],
                total_questions: 0,
                total_duration: 0
            };

            let totalQuestions = 0, totalDuration = 0;

            $('.section_part:not(.d-none)').each(function(index) {
                let $inputs = $(this).find('input');
                let no_of_questions = parseInt($inputs.filter('[name="no_of_questions"]').val()) || 0;
                let duration = parseInt($inputs.filter('[name="duration"]').val()) || 0;

                formData.section_details.push({
                    section_type: $inputs.filter(`[name="sat_type_section_${index + 1}"]:checked`).val(),
                    lesson_name: $inputs.filter('[name="lesson_name"]').val(),
                    section_id: $(this).attr('section-id'),
                    section_order: index + 1,
                    no_of_questions,
                    duration
                });

                totalQuestions += no_of_questions;
                totalDuration += duration;
            });

            formData.total_questions = totalQuestions;
            formData.total_duration = totalDuration;

            return formData;
        }

        function resetData() {
            $('#lessonpleModalLongTitle').text('Create Lesson');
            $('#lessonModal input[type="text"]').val('');
            $('input[name="audience"]').prop('checked', false);
            $('input[name="section"]').prop('checked', false);
            $('.section_part input[type="radio"]').prop('checked', false);
            $('.section_part').attr('section-id', '').addClass('d-none');
            $('.section_part input[type="text"]').val('');
            $('#lessonModal').modal('show');
        }

        function openDetailModal() {
            let lessonId = $(this).data('id');
            $('.update-ranking').data('id', lessonId);
            $('#ranking-input').val('');
            $('#detailModalCenter').modal('show');
        }

        function moveRanking() {
            let lessonId = $(this).data('id');
            let direction = $(this).data('direction');
            let page = $('.pagination .active a').data('page') || 1;
            let perPage = $('#rowsPerPage').val();

            $.ajax({
                url: `/api/lessons/${lessonId}/move-ranking`,
                type: 'POST',
                data: { direction: direction, _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success', response.message, 'success');
                        fetchLessons(page, perPage);
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(error) {
                    Swal.fire('Error', 'Failed to update ranking.', 'error');
                }
            });
        }

        function updateRankingModal() {
            let lessonId = $(this).data('id');
            let newRanking = $('#ranking-input').val();
            let page = $('.pagination .active a').data('page') || 1;
            let perPage = $('#rowsPerPage').val();

            if (!newRanking || newRanking < 1) {
                Swal.fire('Error', 'Please enter a valid ranking.', 'error');
                return;
            }

            $.ajax({
                url: `/api/lessons/${lessonId}/ranking`,
                type: 'PATCH',
                data: { ranking: newRanking, _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success', response.message, 'success');
                        $('#detailModalCenter').modal('hide');
                        fetchLessons(page, perPage);
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(error) {
                    Swal.fire('Error', 'Failed to update ranking.', 'error');
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            // Initial lesson data (simulated)
            const initialLessons = [
                { name: "Math101.MP4", type: "Video", size: "250 MB", iconClass: "video", fileExtension: "mp4" },
                { name: "Math102.MP4", type: "Video", size: "175 MB", iconClass: "video", fileExtension: "mp4" },
                { name: "Math103.MP4", type: "Video", size: "210 MB", iconClass: "video", fileExtension: "mp4" },
                { name: "Advanced Data Structures and Algorithms.pdf", type: "PDF", size: "2.5 MB", iconClass: "pdf", fileExtension: "pdf" }
            ];

            // Function to render lesson table
            function renderLessons() {
                const $lessonsTableBody = $('#lessonsTableBody');
                $lessonsTableBody.empty(); // Clear existing
                initialLessons.forEach(lesson => {
                    const row = `
                        <tr>
                            <td>
                                <div class="lesson-item">
                                    <div class="icon ${lesson.iconClass}">
                                        <i class="fas ${lesson.fileExtension === 'mp4' ? 'fa-play' : 'fa-file-pdf'}"></i>
                                    </div>
                                    <span>${lesson.name}</span>
                                </div>
                            </td>
                            <td>${lesson.type}</td>
                            <td>${lesson.size}</td>
                        </tr>
                    `;
                    $lessonsTableBody.append(row);
                });
            }

            // Call renderLessons on document ready to populate the initial table
            renderLessons();

            const $dropZone = $('#dropZone');
            const $fileInput = $('#fileInput');
            const $chooseFilesBtn = $('#chooseFilesBtn');
            const $uploadingList = $('#uploadingList');

            // Prevent default drag behaviors
            $dropZone.on('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).addClass('dragover');
            });

            $dropZone.on('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass('dragover');
            });

            $dropZone.on('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass('dragover');
                const files = e.originalEvent.dataTransfer.files;
                handleFiles(files);
            });

            // Handle file input click
            $chooseFilesBtn.on('click', function() {
                $fileInput.click();
            });

            $fileInput.on('change', function() {
                const files = this.files;
                handleFiles(files);
            });

            function handleFiles(files) {
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    uploadFile(file);
                }
            }

            function uploadFile(file) {
                const fileName = file.name;
                const fileSize = (file.size / (1024 * 1024)).toFixed(2); // Convert to MB
                const fileExtension = fileName.split('.').pop().toLowerCase();
                let iconClass = '';
                let fileTypeDisplay = '';

                if (['mp4', 'mp3'].includes(fileExtension)) {
                    iconClass = 'mp4'; // Use mp4 icon for both video and audio for this design
                    fileTypeDisplay = 'Video'; // Or 'Audio' for mp3
                } else if (fileExtension === 'pdf') {
                    iconClass = 'pdf-upload';
                    fileTypeDisplay = 'PDF';
                } else if (['jpeg', 'jpg', 'png', 'gif'].includes(fileExtension)) {
                    iconClass = 'image'; // Add an image icon class if needed
                    fileTypeDisplay = 'Image';
                } else {
                    iconClass = 'file'; // Default icon
                    fileTypeDisplay = 'File';
                }

                const uploadItem = `
                    <div class="uploading-item" data-filename="${fileName}">
                        <div class="icon ${iconClass}">
                            <i class="fas ${iconClass === 'mp4' ? 'fa-play' : (iconClass === 'pdf-upload' ? 'fa-file-pdf' : 'fa-file')}"></i>
                        </div>
                        <div class="file-details">
                            <div class="file-name">${fileName}</div>
                            <div class="file-size">${fileSize} MB</div>
                            <div class="progress-row">
                                <div class="progress-container">
                                    <div class="progress-bar" style="width: 0%;"></div>
                                </div>
                                <div class="progress-percentage">0%</div>
                            </div>
                        </div>
                        <i class="fas fa-trash-alt delete-icon"></i>
                    </div>
                `;
                $uploadingList.append(uploadItem);

                // Simulate upload progress
                let progress = 0;
                const interval = setInterval(() => {
                    if (progress < 100) {
                        progress += Math.floor(Math.random() * 10) + 5; // Simulate random progress increase
                        if (progress > 100) progress = 100;

                        const $item = $(`[data-filename="${fileName}"]`);
                        $item.find('.progress-bar').css('width', `${progress}%`);
                        $item.find('.progress-percentage').text(`${progress}%`);
                    } else {
                        clearInterval(interval);
                        // Once upload is "complete", add to lessons table
                        initialLessons.push({
                            name: fileName,
                            type: fileTypeDisplay,
                            size: `${fileSize} MB`,
                            iconClass: iconClass === 'mp4' ? 'video' : (iconClass === 'pdf-upload' ? 'pdf' : 'file'), // Map back to lesson icons
                            fileExtension: fileExtension
                        });
                        renderLessons();

                        // Optionally, remove from uploading list after a short delay
                        setTimeout(() => {
                            $(`[data-filename="${fileName}"]`).remove();
                        }, 1000);
                    }
                }, 300); // Update every 300ms

                // Handle delete icon click for uploading items
                $uploadingList.on('click', '.delete-icon', function() {
                    $(this).closest('.uploading-item').remove();
                    // In a real application, you would also cancel the upload here
                });
            }
        });
    </script>
    @endpush
</x-backend.layouts.master>
