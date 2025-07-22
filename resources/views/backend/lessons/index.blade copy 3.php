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
                    <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" onclick="window.filter(this)">
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
                                <th>Lesson</th>
                                <th>Title</th>
                                <th>Audience</th>
                                <th>Subject</th>
                                <th>Course(s)</th>
                                <th>Total Time</th>
                                <th>Created</th>
                                <th>State</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="lesson-table-body">
                            <tr>
                                <td colspan="10" class="text-center">Loading...</td>
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
                        <p class="pb-2 d-none step-2">Step 2 : Upload Videos and PDF Files</p>
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
                                                    <input type="radio" name="question_type" value="Verbal"> Verbal
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label class="radio-container mb-3 col-md-12">
                                                    <input type="radio" name="question_type" value="Quant"> Quant
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
                                                <input type="radio" name="question_type" value="Physics"> Physics
                                            </label>
                                            <label class="radio-container mb-3 col-md-12">
                                                <input type="radio" name="question_type" value="Chemistry"> Chemistry
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="radio-container mb-3 col-md-12">
                                                <input type="radio" name="question_type" value="Biology"> Biology
                                            </label>
                                            <label class="radio-container mb-3 col-md-12">
                                                <input type="radio" name="question_type" value="Math"> Math
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
                                                <th>File Size</th>
                                            </tr>
                                        </thead>
                                        <tbody id="lessonsTableBody"></tbody>
                                    </table>
                                </div>
                                <div class="upload-files-section">
                                    <h2>Upload Files</h2>
                                    <div class="drop-zone" id="dropZone">
                                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                        <p><strong>Click to upload</strong> or drag and drop</p>
                                        <p>JPEG, PNG, PDF, GIF, MP3 and MPOSSIBLE formats</p>
                                        <input type="file" id="fileInput" multiple accept=".jpeg,.jpg,.png,.pdf,.gif,.mp3,.mp4" style="display: none;">
                                        <button id="chooseFilesBtn">Choose files</button>
                                        <p>[Max: 350MB]</p>
                                    </div>
                                    <div class="uploading-list" id="uploadingList"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-3">
                        <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                        <a href="#" class="btn next-step-2" style="background-color:#691D5E; border-radius: 8px; color:#D0D5DD">Next</a>
                        <a href="#" class="btn save-lesson d-none" style="background-color:#691D5E; border-radius: 8px; color:#D0D5DD" data-dismiss="modal">Add Lesson</a>
                        <a href="#" class="btn update-lesson d-none" style="background-color:#691D5E; border-radius: 8px; color:#D0D5DD" data-dismiss="modal">Update Lesson</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Edit Confirmation Modal -->
    <section>
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border-radius: 24px;">
                    <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px;">
                        <h5 class="modal-title" id="confirmationModalTitle">Confirm Edit</h5>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to edit this lesson?</p>
                    </div>
                    <div class="modal-footer border-top pt-3">
                        <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn" id="proceedBtn" style="background-color:#691D5E; border-radius: 8px; color:#D0D5DD">Proceed</button>
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
                                            < input type="checkbox" value="Physics" name="question_type[]">Physics
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Chemistry" name="question_type[]">Chemistry
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Biology" name="question_type[]">Biology
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Math" name="question_type[]">Math
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Verbal" name="question_type[]">Verbal
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" value="Quant" name="question_type[]">Quant
                                        </div>
                                    </div>
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

        .progress-container {
            width: 100%;
            height: 8px;
            background-color: #E0E0E0;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: #691D5E;
            transition: width 0.3s ease-in-out;
        }

        .progress-percentage {
            margin-left: 10px;
            font-size: 12px;
            color: #344054;
        }

        .uploading-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #D0D5DD;
        }

        .delete-icon {
            cursor: pointer;
            color: #d33;
        }

        .drop-zone.dragover {
            background-color: #F1E9F0;
            border: 2px dashed #691D5E;
        }
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

            $('.next-step-2').on('click', function(e) {
                e.preventDefault();
                $('.step-1').addClass('d-none');
                $('.step-2').removeClass('d-none');
                $('.save-lesson').removeClass('d-none');
                $('.next-step-2').addClass('d-none');
                $('#lessonpleModalLongTitle').text('Upload Lesson Files');
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
            $(document).on('click', '.save-lesson', store);
            $(document).on('click', '.lesson-delete', destroy);
            $(document).on('change', '.toggle-status', updateState);
            $(document).on('click', '.edit-btn', show);
            $(document).on('click', '.create-button', function() {
                $('.update-lesson').addClass('d-none');
                $('.next-step-2').removeClass('d-none');
                resetData();
            });

            $('.update-lesson').on('click', function(e) {
                e.preventDefault();
                let lessonId = $(this).data('id');
                update(lessonId, e);
            });

            $(document).on('click', '#proceedBtn', function(e) {
                $('#confirmationModal').modal('hide');
                $('#lessonModal').modal('show');
            });

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
                fetchLessons(1, $('#rowsPerPage').val());
            });

            // File upload handling
            const $dropZone = $('#dropZone');
            const $fileInput = $('#fileInput');
            const $chooseFilesBtn = $('#chooseFilesBtn');
            const $uploadingList = $('#uploadingList');
            const maxSizeMB = 350;
            const allowedTypes = ['jpeg', 'jpg', 'png', 'pdf', 'gif', 'mp3', 'mp4'];

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
                    const fileExtension = file.name.split('.').pop().toLowerCase();
                    const fileSizeMB = file.size / (1024 * 1024);

                    if (!allowedTypes.includes(fileExtension)) {
                        Swal.fire('Error', `File type ${fileExtension} is not allowed.`, 'error');
                        continue;
                    }
                    if (fileSizeMB > maxSizeMB) {
                        Swal.fire('Error', `File size exceeds ${maxSizeMB}MB limit.`, 'error');
                        continue;
                    }
                    uploadFile(file);
                }
            }

            function uploadFile(file) {
                const fileName = file.name;
                const fileSize = (file.size / (1024 * 1024)).toFixed(2);
                const fileExtension = fileName.split('.').pop().toLowerCase();
                let fileTypeDisplay = fileExtension === 'mp4' ? 'Video' : fileExtension === 'pdf' ? 'PDF' : fileExtension === 'mp3' ? 'Audio' : 'Image';
                let iconClass = fileExtension === 'mp4' ? 'video' : fileExtension === 'pdf' ? 'pdf' : 'file';

                const uploadItem = `
                    <div class="uploading-item" data-filename="${fileName}">
                        <div class="icon ${iconClass}">
                            <i class="fas ${iconClass === 'video' ? 'fa-play' : iconClass === 'pdf' ? 'fa-file-pdf' : 'fa-file'}"></i>
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

                const formData = new FormData();
                formData.append('file', file);
                formData.append('audience', $('input[name="audience"]:checked').val() || '');
                formData.append('question_type', $('input[name="question_type"]:checked').val() || '');
                formData.append('file_name', fileName);
                formData.append('file_type', fileTypeDisplay);
                formData.append('file_size', fileSize);
                formData.append('total_length', fileExtension === 'mp4' ? '00:00' : null);

                const xhr = new XMLHttpRequest();

                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        const percentComplete = (e.loaded / e.total) * 100;
                        const $item = $(`[data-filename="${fileName}"]`);
                        $item.find('.progress-bar').css('width', `${percentComplete}%`);
                        $item.find('.progress-percentage').text(`${Math.round(percentComplete)}%`);
                    }
                });

                xhr.upload.addEventListener('load', function() {
                    const $item = $(`[data-filename="${fileName}"]`);
                    $item.find('.progress-bar').css('width', '100%');
                    $item.find('.progress-percentage').text('100%');
                });

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            $(`[data-filename="${fileName}"]`).remove();
                            fetchLessons(1, $('#rowsPerPage').val());
                            const response = typeof xhr.response === "string" ? JSON.parse(xhr.response) : xhr.response;
                            $('#lessonsTableBody').append(`
                                <tr>
                                    <td>${response.lesson.file_name}</td>
                                    <td>${response.lesson.file_type}</td>
                                    <td>${response.lesson.file_size} MB</td>
                                </tr>
                            `);
                            Swal.fire('Success', 'File uploaded successfully!', 'success');
                        } else {
                            Swal.fire('Error', 'Failed to upload file.', 'error');
                        }
                    }
                };

                xhr.upload.addEventListener('error', function() {
                    Swal.fire('Error', 'Upload failed. Please try again.', 'error');
                    $(`[data-filename="${fileName}"]`).remove();
                });

                xhr.open('POST', '/api/lessons', true);
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                xhr.send(formData);

                $uploadingList.on('click', '.delete-icon', function() {
                    xhr.abort();
                    $(this).closest('.uploading-item').remove();
                });
            }

            function store(e) {
                e.preventDefault();
                $('#lessonsTableBody').empty();
            }

            function fetchLessons(page = 1, perPage = 10) {
                let filters = {
                    search: $('.search_input').val(),
                    crated_start_at: $('input[name="crated_start_at"]').val(),
                    crated_end_at: $('input[name="crated_end_at"]').val(),
                    status: $('input[name="status"]:checked').val(),
                    audience: $('input[name="audience[]"]:checked').map((_, el) => el.value).get(),
                    question_type: $('input[name="question_type[]"]:checked').map((_, el) => el.value).get()
                };

                $.ajax({
                    url: `/api/lessons?page=${page}&per_page=${perPage}`,
                    type: 'GET',
                    data: filters,
                    success: function(response) {
                        let lessonNullList = $('#lessonNullList');
                        let lessonList = $('#lessonList');
                        let tableBody = $('#lesson-table-body');
                        let totalResults = response.total;

                        $('#total-lessons').text(`${totalResults} Lessons`);

                        if (response.data.length === 0) {
                            if (page === 1 && Object.values(filters).every(val => !val || (Array.isArray(val) && !val.length))) {
                                lessonNullList.removeClass('d-none');
                                lessonList.addClass('d-none');
                            } else {
                                lessonNullList.addClass('d-none');
                                lessonList.removeClass('d-none');
                                tableBody.html('<tr><td colspan="10" class="text-center">No lessons found.</td></tr>');
                            }
                        } else {
                            lessonNullList.addClass('d-none');
                            lessonList.removeClass('d-none');

                            let rows = '';
                            $.each(response.data, function(index, lesson) {
                                let icon = lesson.file_type === 'Video' ? '<video width="70" height="50" controls><source src="' + lesson.file_path + '" type="video/mp4"></video>' :
                                    lesson.file_type === 'PDF' ? '<i class="fas fa-file-pdf" style="font-size: 50px;"></i>' :
                                    '<i class="fas fa-file" style="font-size: 50px;"></i>';
                                let totalTime = lesson.total_length ? lesson.total_length : 'N/A';
                                let statusChecked = lesson.state ? 'checked' : '';

                                rows += `<tr>
                                    <td><input type="checkbox" class="row-checkbox lesson-row" value="${lesson.uuid}"></td>
                                    <td>${icon}</td>
                                    <td>${lesson.file_name}</td>
                                    <td>${lesson.audience}</td>
                                    <td>${lesson.question_type || 'N/A'}</td>
                                    <td>N/A</td>
                                    <td>${totalTime}</td>
                                    <td>${formatDate(lesson.created_at)}</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-status" data-id="${lesson.id}" ${statusChecked}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <button data-id="${lesson.id}" class="btn btn-sm edit-btn" data-toggle="modal" data-target="#confirmationModal">
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
                    data: { state: newStatus },
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
                            url: '/api/lessons/delete',
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
                $.ajax({
                    url: `/api/lessons/${lessonId}`,
                    type: 'GET',
                    success: function(response) {
                        $('#lessonpleModalLongTitle').text('Edit Lesson');
                        $('input[name="audience"][value="' + response.audience + '"]').prop('checked', true);
                        if (response.audience === 'SAT 2') {
                            $('#sat_type_2').removeClass('d-none');
                            $('#sat_type_1').addClass('d-none');
                        } else {
                            $('#sat_type_1').removeClass('d-none');
                            $('#sat_type_2').addClass('d-none');
                        }
                        $('input[name="question_type"][value="' + response.question_type + '"]').prop('checked', true);
                        $('.save-lesson').addClass('d-none');
                        $('.next-step-2').addClass('d-none');
                        $('.update-lesson').removeClass('d-none').data('id', lessonId);
                        $('.step-1').removeClass('d-none');
                        $('.step-2').addClass('d-none');
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to load lesson data.', 'error');
                    }
                });
            }

            function update(lessonId, e) {
                e.preventDefault();
                const formData = new FormData();
                formData.append('audience', $('input[name="audience"]:checked').val());
                formData.append('question_type', $('input[name="question_type"]:checked').val());
                formData.append('_method', 'POST');

                $.ajax({
                    url: `/api/lessons/${lessonId}`,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Success', 'Lesson updated successfully!', 'success').then(() => {
                                $('#lessonModal').modal('hide');
                                fetchLessons(1, $('#rowsPerPage').val());
                            });
                        } else {
                            Swal.fire('Error', 'Failed to update the lesson!', 'error');
                        }
                    },
                    error: function(error) {
                        let errors = error.responseJSON?.errors;
                        let errorMessage = errors ? Object.values(errors).flat().join('\n') : 'An unexpected error occurred.';
                        Swal.fire('Validation Error', errorMessage, 'error');
                    }
                });
            }

            function resetData() {
                $('#lessonpleModalLongTitle').text('Create Lesson');
                $('#lessonModal input[type="text"]').val('');
                $('input[name="audience"]').prop('checked', false);
                $('input[name="question_type"]').prop('checked', false);
                $('.step-1').removeClass('d-none');
                $('.step-2').addClass('d-none');
                $('.next-step-2').removeClass('d-none');
                $('.save-lesson').addClass('d-none');
                $('.update-lesson').addClass('d-none');
                $('#lessonModal').modal('show');
            }
        });
    </script>
    @endpush
</x-backend.layouts.master>