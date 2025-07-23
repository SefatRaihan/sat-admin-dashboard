<x-backend.layouts.master>
    @php
        $prependHtml = '
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                <a href="/courses/create" data-toggle="modal" data-target="#courseModal" class="btn d-flex btn-link create-btn btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm" style="background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px">
                    <i class="fas fa-plus" style="font-size: 12px; margin-right: 5px; margin-top: 5px;"></i> Add Course
                </a>
            </div>
        ';
    @endphp

    <x-backend.layouts.partials.blocks.contentwrapper :headerTitle="'All Courses'" :prependContent="$prependHtml">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div class="d-none" id="courseNullList">
        <x-backend.layouts.partials.blocks.empty-state
            title="You have not created any Course yet"
            message="Let’s create a new course"
            buttonText="Create Course"
            buttonRoute="#courseModal"
            class="create-btn"
        />
    </div>

    <section>
        <div id="courseList">
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <div>
                        <input type="text" id="search" class="form-control search_input" placeholder="Search Courses" style="padding-left: 40px">
                    </div>
                    <div class="d-flex">
                        <button type="button" class="btn pt-0 pb-0 mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" onclick="filter(this)">
                            <img src="{{ asset('image/icon/layer.png') }}" alt=""> Filters
                        </button>
                        <div class="form-group mb-0">
                            <select class="form-control" id="sortSelect">
                                <option value="Latest" selected>Latest</option>
                                <option value="Oldest">Oldest</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 m-0 table-responsive">
                    <div class="d-flex justify-content-between align-items-center mt-3 p-2">
                        <h4><strong id="total-courses"></strong></h4>
                        <div class="delete-btn d-none">
                            <button class="btn text-danger course-delete"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr class="bg-light">
                                    <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                                    <th>Courses</th>
                                    <th>Audience</th>
                                    <th>Chapter No</th>
                                    <th>Lessons No</th>
                                    <th>Duration</th>
                                    <th>Created</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="course-table-body">
                                <tr>
                                    <td colspan="9" class="text-center">Loading...</td>
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
                                <p style="font-size: 12px"> <span style="color: #344054"><b>Created on:</b></span> <span style="color: #475467">06 Jan 25 - 12 Jan 25</span></p>
                                <button class="reset-slider reset-filter-btn"><u>Reset</u></button>
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
                            <div class="mt-2">
                                <div class="d-flex justify-content-between">
                                    <h6><b>Audience & Type:</b> All Result</h6>
                                </div>
                                <div id="all_sat_type_1">
                                    <div class="filter-group">
                                        <div class="form-check">
                                            <input class="form-check-input toggle-parent" type="checkbox" id="allSet1Toggle">
                                            <label class="form-check-label" for="allSet1Toggle">All SAT 1</label>
                                            <span class="toggle-icon" data-target="allSet1"><i class="fas fa-chevron-down"></i></span>
                                        </div>
                                        <div class="nested-options collapse" id="allSet1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="High School-Verbal" id="exam1">
                                                <label class="form-check-label" for="exam1">High School : Verbal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="High School-Quant" id="exam2">
                                                <label class="form-check-label" for="exam2">High School : Quant</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="College-Verbal" id="exam3">
                                                <label class="form-check-label" for="exam3">College : Verbal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Graduate-Verbal" id="exam4">
                                                <label class="form-check-label" for="exam4">Graduate : Verbal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Graduate-Quant" id="exam5">
                                                <label class="form-check-label" for="exam5">Graduate : Quant</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="all_sat_type_2">
                                    <div class="filter-group">
                                        <div class="form-check">
                                            <input class="form-check-input toggle-parent" type="checkbox" value="All SAT 2" id="allSet2Toggle">
                                            <label class="form-check-label" for="allSet2Toggle">All SAT 2</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="d-flex justify-content-between">
                                    <h6><b>Exam Appearance:</b> All Result</h6>
                                </div>
                                <div class="mb-1">
                                    <input type="text" class="form-control course_search_input w-100 pl-4" placeholder="Search Courses">
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="slider-container" style="max-width: 100% !important">
                                    <div class="slider-header">
                                        <span>Average Time:</span>
                                        <span id="slider-value">1m 00s - 2m 00s</span>
                                        <button class="reset-slider reset-filter-btn" id="reset-slider">Reset</button>
                                    </div>
                                    <div class="range-slider">
                                        <input type="range" min="1" max="120" value="1" id="min-range">
                                        <input type="range" min="1" max="120" value="120" id="max-range">
                                    </div>
                                    <div class="slider-labels">
                                        <span id="min-label">1m 00s</span>
                                        <span id="max-label">2m 00s</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top fixed-bottom-buttons">
                    <div class="d-flex justify-content-between p-3">
                        <button type="button" class="btn apply-filter-btn" style="background-color:#691D5E ;border-radius: 8px; color:#fff; width:50%">Apply Filters</button>
                        <button type="button" class="btn btn-outline-dark ml-2 reset-filter-btn" style="border: 1px solid #D0D5DD; border-radius: 8px; width:50%">Reset All</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="courseModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 80%">
                <div class="modal-content" style="border-radius: 24px; height:100%">
                    <div style="background: #F9FAFB; border-bottom:1px solid #D0D5DD">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <h4 class="text-center font-weight-bold course-modal-heading">Create a Course</h4>
                        <p class="text-center text-muted step-title"></p>
                        <div class="d-flex justify-content-center align-items-center mb-4 step-container">
                            <div class="step-group">
                                <div class="step-circle active" data-step="1"><i class="fa-solid fa-check d-none"></i><span class="circle-count">1</span></div>
                            </div>
                            <div class="step-group">
                                <div class="step-line"></div>
                                <div class="step-circle m-0" data-step="2"><i class="fa-solid fa-check d-none"></i><span class="circle-count">2</span></div>
                            </div>
                            <div class="step-group">
                                <div class="step-line"></div>
                                <div class="step-circle m-0" data-step="3"><i class="fa-solid fa-check d-none"></i><span class="circle-count">3</span></div>
                            </div>
                            <div class="step-group">
                                <div class="step-line"></div>
                                <div class="step-circle m-0" data-step="4"><i class="fa-solid fa-check d-none"></i><span class="circle-count">4</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body" style="padding: 10px 40px">
                        <input type="hidden" name="course_id" id="courseId" value="{{ null }}">
                        <div class="step step-1">
                            <h5><strong>1. Select the Audience</strong></h5>
                            <div class="row" style="margin-left: 3px">
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input type="radio" name="audience" value="High School" class="form-check-input sat_1" id="high_school">
                                        <label class="radio-container form-check-label" for="high_school">High School</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" name="audience" value="Graduation" class="form-check-input sat_1" id="graduation">
                                        <label class="radio-container form-check-label" for="graduation">Graduation</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input type="radio" name="audience" value="College" class="form-check-input sat_1" id="college">
                                        <label class="radio-container form-check-label" for="college">College</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" name="audience" value="SAT 2" class="form-check-input sat_2" id="sat_2">
                                        <label class="radio-container form-check-label" for="sat_2">SAT 2</label>
                                    </div>
                                </div>
                            </div>
                            <div id="sat_type_1" class="d-none">
                                <h5 class="mt-3"><strong>2. Select the Course Type</strong></h5>
                                <div class="row" style="margin-left: 3px">
                                    <div class="col-md-12 row" style="margin-left: 3px">
                                        <div class="form-check col-md-6 mb-2">
                                            <input type="radio" class="form-check-input" name="course_type" value="Verbal" id="verbal">
                                            <label class="radio-container form-check-label" for="verbal">Verbal</label>
                                        </div>
                                        <div class="form-check col-md-6 mb-2">
                                            <input type="radio" class="form-check-input" name="course_type" value="Quant" id="quant">
                                            <label class="radio-container form-check-label" for="quant">Quant</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="sat_type_2" class="d-none">
                                <h5 class="mt-3"><strong>2. Select the Course Subject</strong></h5>
                                <div class="row" style="margin-left: 3px">
                                    <div class="col-md-6">
                                        <div class="form-check mb-2">
                                            <input type="radio" name="subjects" value="Physics" class="form-check-input" id="physics">
                                            <label class="form-check-label radio-container" for="physics">Physics</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="radio" name="subjects" value="Chemistry" class="form-check-input" id="chemistry">
                                            <label class="form-check-label radio-container" for="chemistry">Chemistry</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check mb-2">
                                            <input type="radio" name="subjects" value="Biology" class="form-check-input" id="biology">
                                            <label class="form-check-label radio-container" for="biology">Biology</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="radio" name="subjects" value="Math" class="form-check-input" id="math">
                                            <label class="form-check-label radio-container" for="math">Math</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <h5 class="mt-3"><strong>3. Course Title</strong></h5>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="">
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <h5 class="mt-3"><strong>4. Course Description</strong></h5>
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="5" maxlength="500"></textarea>
                                    <p class="text-right" style="color: #475467"><span id="char-count">0</span>/500 character Maximum</p>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">5. Course Thumbnail</label>
                                <div id="thumbnail-upload-box" class="upload-box text-center p-4 border border-dashed rounded">
                                    <input type="file" id="thumbnail" name="thumbnail" class="d-none" accept="image/jpeg, image/png" />
                                    <div id="upload-preview" class="mb-2">
                                        <img src="#" id="preview-image" alt="Preview" class="img-fluid d-none" style="max-height: 200px;" />
                                    </div>
                                    <label for="thumbnail" class="upload-label mt-3">
                                        <div class="upload-icon mb-2">
                                            <img src="{{ asset('image/icon/image-upload.png') }}" alt="Upload Icon" style="width: 16.67px; height: 15px;">
                                        </div>
                                        <span class="d-block fw-semibold text-primary">Click to upload</span>
                                        <span class="text-muted small">or drag and drop</span><br>
                                        <span class="text-muted small">JPEG, PNG formats</span><br>
                                        <span class="text-muted small">[Max: 10MB]</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="step step-2 d-none">
                            <div>
                                <h5><strong>Chapter Options</strong></h5>
                                <div>
                                    <select name="chapter" class="form-control" id="chapter" multiple></select>
                                </div>
                            </div>
                        </div>
                        <div class="step step-3 d-none">
                            <div>
                                <h5><strong>Lesson</strong></h5>
                                <div class="form-group lessonSelectBox"></div>
                            </div>
                            <div class="form-group mt-2">
                                <h5><strong>Is Exam Create</strong></h5>
                                <div>
                                    <input type="checkbox" class="form-control" name="isExamCreate" id="isExamCreate">
                                </div>
                            </div>
                            <div class="mt-2 exam-section" style="display: none;">
                                <h5><strong>Select from existing exam</strong></h5>
                                <div>
                                    <select name="exam" class="form-control exam" id="exam"></select>
                                </div>
                            </div>
                        </div>
                        <div class="step step-4 d-none">
                            <div class="course-page-container">
                                <div class="main-content">
                                    <div class="video-player-section">
                                        <video id="lesson-player" controls width="100%" height="auto" poster="https://via.placeholder.com/800x450/4A67ED/FFFFFF?text=Course+Video+Placeholder">
                                            <source id="videoSource" src="" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    <div class="course-meta">
                                        <div class="tags">
                                            <span id="lastAudience"></span>
                                            <span id="total-lessons"></span>
                                            <span id="total-chapters"></span>
                                            <span id="total-duration"></span>
                                        </div>
                                        <h1 id="show_title"></h1>
                                        <p id="show_description"></p>
                                    </div>
                                </div>
                                <div class="sidebar2">
                                    <div class="student-profile-card">
                                        <div class="profile-avatar">
                                            <img src="https://via.placeholder.com/50/4A67ED/FFFFFF?text=MS" alt="Img">
                                        </div>
                                        <div class="profile-info">
                                            <div class="name">Mubhir Student</div>
                                            <div class="role">SAT Student</div>
                                        </div>
                                        <div class="progress-info">
                                            <div style="display: flex; justify-content: space-between;">
                                                <div class="progress-label">In Progress</div>
                                                <div class="progress-percentage">67%</div>
                                            </div>
                                            <div class="progress-bar-container">
                                                <div class="progress-bar" style="width: 67%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course-lessons-list" id="courseLessonsList"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-2" style="border-top: 1px solid #D0D5DD">
                        <div class="d-flex w-100 justify-content-end align-items-center">
                            <div class="d-flex">
                                <button type="button" class="btn back-btn btn-outline-secondary cancel mr-2">Cancel</button>
                                <button type="button" class="btn back-btn btn-outline-secondary prev-step mr-2 d-none">Back</button>
                                <button type="button" class="btn next-step">Next</button>
                                <button type="submit" class="btn save-course d-none" style="background:#691D5E; color: #EAECF0; border-radius: 8px;">Save Course</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/courses.css') }}">
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
            .custom-checkbox input[type='checkbox'] {
                margin-top: 3px;
            }
            .dataTable tbody>tr.selected, .dataTable tbody>tr>.selected {
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
            .datatable-footer, .datatable-header {
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
            .multiselect.btn {
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
            .upload-box {
                border: 2px dashed #d1c4e9;
                background-color: #fdfdff;
                cursor: pointer;
                transition: border-color 0.3s ease;
            }
            .upload-box:hover {
                border-color: #7e57c2;
            }
            .upload-label {
                display: block;
                cursor: pointer;
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
                height: calc(100vh - 60px - 60px);
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
                text-decoration: #000 underline;
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
                background: white;
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
                border: 1px solid #ddd !important;
                padding-left: 4px;
                padding-right: 4px;
            }
            .task-form .select2-selection--single {
                padding-left: 4px;
                padding-right: 4px;
            }
            .task-form .select2-selection--single .select2-selection__arrow:after {
                right: 7px !important;
            }
            .task-form .select2-container {
                border: 1px solid #ddd;
            }
            .upload-icon {
                position: absolute;
                bottom: 150px;
                left: 50%;
                transform: translateX(-50%);
                width: 40px;
                height: 40px;
                border: 1px solid #EAECF0;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .photosection {
                height: 120px;
                border: 2px solid #A16A99;
                border-radius: 8px;
                align-items: end;
                display: flex;
                justify-content: center;
                border-style: dashed;
            }
            .toggle-password {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                font-size: 16px;
                color: #888;
            }
            .toggle-password:hover {
                color: #333;
            }
            #previewImage {
                height: 104px;
                position: absolute;
                top: 24%;
                left: 17px;
            }
            input[type="radio"] {
                accent-color: #691D5E;
            }
            label {
                padding-top: 2px;
            }
            .new-course {
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
            .step-circle.active {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: #691D5E;
                color: white;
                border-color: #691D5E;
            }
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
            .form-check-input:checked {
                background-color: #6f42c1;
                border-color: #6f42c1;
            }
            .exam-section {
                display: none;
            }
            .feedback-btn-count {
                border: 1px solid #EAECF0;
                border-radius: 50%;
                padding: 3px;
                padding-left: 6px;
                padding-right: 6px;
                font-size: 11px;
                background-color: #F9FAFB;
                margin-left: 5px;
            }
            .feedback-btn.active {
                color: #521749 !important;
                border: 1px solid #F1E9F0 !important;
                background-color: #F1E9F0 !important;
            }
            .feedback-btn.active .feedback-btn-count {
                border: 1px solid #521749 !important;
                background-color: #F1E9F0 !important;
            }
        </style>
    @endpush

    @push('js')
        <script src="{{ asset('/ui/backend/global_assets/js/plugins/uploaders/dropzone.min.js') }}"></script>
        <script src="{{ asset('/ui/backend/global_assets/js/demo_pages/uploader_dropzone.js') }}"></script>
        <script src="{{ asset('/ui/backend/global_assets/js/demo_pages/form_checkboxes_radios.js') }}"></script>
        <script src="{{ asset('/ui/backend/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
        <script src="{{ asset('/ui/backend/global_assets/js/demo_pages/form_multiselect.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

<script>
            const appUrl = @json(config('app.url'));
            let currentStep = 1;
            const totalSteps = $('.step').length;

            $(document).ready(function() {
                // Initialize character count for description
                $('#description').on('input', function() {
                    let charCount = $(this).val().length;
                    $('#char-count').text(charCount);
                });

                // Toggle SAT type sections based on audience selection
                $('input[name="audience"]').on('change', function() {
                    const audience = $(this).val();
                    if (audience === 'SAT 2') {
                        $('#sat_type_1').addClass('d-none');
                        $('#sat_type_2').removeClass('d-none');
                    } else {
                        $('#sat_type_2').addClass('d-none');
                        $('#sat_type_1').removeClass('d-none');
                    }
                });

                // Toggle delete checkboxes
                function toggleDeleteButton() {
                    let anyChecked = $('.row-checkbox:checked').length > 0;
                    $('.delete-btn').toggleClass('d-none', !anyChecked);
                }

                $(document).on('change', '.row-checkbox', function() {
                    let row = $(this).closest('tr');
                    row.css('background-color', this.checked ? '#F1E9F0' : '');
                    row.toggleClass('selected', this.checked);
                    toggleDeleteButton();
                    updateActiveInactiveCount();
                });

                $('#selectAll').on('change', function() {
                    let isChecked = this.checked;
                    $('.row-checkbox').prop('checked', isChecked).closest('tr').toggleClass('selected', isChecked).css('background-color', isChecked ? '#F1E9F0' : '');
                    toggleDeleteButton();
                    updateActiveInactiveCount();
                });

                // Modal reset and initialization
                $('.create-btn').on('click', function() {
                    resetModal();
                    $('.course-modal-heading').text('Create a Course');
                    $('#courseId').val(null);
                    showStep(1);
                    $('#courseModal').modal('show');
                    selectChapter();
                    selectExam();
                });

                // Sidebar filter toggle
                $('#closeSidebar, #taskSidebarOverlay').on('click', function() {
                    $('#taskSidebar').removeClass('open');
                    $('#taskSidebarOverlay').removeClass('active');
                });

                // Filter button
                function filter(button) {
                    $('.filter').show();
                    $('#taskSidebar').addClass('open');
                    $('#taskSidebarOverlay').addClass('active');
                }

                // Thumbnail upload preview
                $('#thumbnail').on('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const fileSizeMB = file.size / 1024 / 1024;
                        if (fileSizeMB > 10) {
                            alert('File size exceeds 10MB.');
                            this.value = '';
                            return;
                        }
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            $('#preview-image').attr('src', e.target.result).removeClass('d-none');
                        };
                        reader.readAsDataURL(file);
                    }
                });

                $('#thumbnail-upload-box').on('dragover', function(e) {
                    e.preventDefault();
                    $(this).addClass('border-primary');
                }).on('dragleave drop', function(e) {
                    e.preventDefault();
                    $(this).removeClass('border-primary');
                }).on('drop', function(e) {
                    const droppedFile = e.originalEvent.dataTransfer.files[0];
                    $('#thumbnail')[0].files = e.originalEvent.dataTransfer.files;
                    $('#thumbnail').trigger('change');
                });

                // Filter sidebar dropdowns
                $('.toggle-icon').on('click', function() {
                    const target = document.getElementById(this.dataset.target);
                    target.classList.toggle('collapse');
                    this.classList.toggle('open');
                    target.style.display = target.classList.contains('collapse') ? 'none' : 'block';
                });

                $('.toggle-parent').on('change', function() {
                    let targetDiv = document.getElementById(this.nextElementSibling.nextElementSibling.dataset.target);
                    let checkboxes = targetDiv.querySelectorAll('input[type="checkbox"]');
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });

                // Slider for average time filter
                const minRange = $('#min-range');
                const maxRange = $('#max-range');
                const minLabel = $('#min-label');
                const maxLabel = $('#max-label');
                const sliderValue = $('#slider-value');
                const resetButton = $('#reset-slider');

                function updateSlider() {
                    let minValue = parseInt(minRange.val());
                    let maxValue = parseInt(maxRange.val());
                    if (maxValue - minValue < 10) {
                        minRange.val(maxValue - 10);
                        maxRange.val(minValue + 10);
                    }
                    minLabel.text(`${Math.floor(minRange.val() / 60)}m ${minRange.val() % 60}s`);
                    maxLabel.text(`${Math.floor(maxRange.val() / 60)}m ${maxRange.val() % 60}s`);
                    sliderValue.text(`${minLabel.text()} - ${maxLabel.text()}`);
                }

                minRange.on('input', updateSlider);
                maxRange.on('input', updateSlider);
                resetButton.on('click', () => {
                    minRange.val(1);
                    maxRange.val(120);
                    updateSlider();
                });
                updateSlider();

                // Modal navigation
                $('.next-step').on('click', function() {
                    if (currentStep < totalSteps) {
                        currentStep++;
                        showStep(currentStep);
                        if (currentStep === 4) {
                            renderCourseContent();
                        }
                    }
                });

                $('.prev-step').on('click', function() {
                    if (currentStep > 1) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });

                $('.cancel').on('click', function() {
                    $('#courseModal').modal('hide');
                    resetModal();
                });

                // Save course
                $('.save-course').on('click', store);

                // Edit course
                $(document).on('click', '.edit-btn', show);

                // Delete courses
                $(document).on('click', '.course-delete', destroy);

                // Fetch courses on page load
                let currentPage = 1;
                let perPage = $('#rowsPerPage').val();
                fetchCourses(currentPage, perPage);

                $('#rowsPerPage').on('change', function() {
                    perPage = $(this).val();
                    fetchCourses(1, perPage);
                });

                $('#sortSelect').on('change', function() {
                    fetchCourses(1, perPage, $(this).val());
                });

                let searchTimeout;
                $('.search_input').on('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        fetchCourses(1, $('#rowsPerPage').val());
                    }, 300);
                });

                $('.apply-filter-btn').on('click', function() {
                    fetchCourses(1, $('#rowsPerPage').val());
                });

                $('.reset-filter-btn').on('click', function() {
                    $('.search_input').val('');
                    $('input[name="crated_start_at"]').val('');
                    $('input[name="crated_end_at"]').val('');
                    $('.course_search_input').val('');
                    $('input[name="status"][value="All"]').prop('checked', true);
                    $('.filter-group input:checkbox').prop('checked', false);
                    $('.custom-checkbox input:checkbox').prop('checked', false);
                    $('.multiselect').val([]).trigger('change');
                    minRange.val(1);
                    maxRange.val(120);
                    updateSlider();
                    fetchCourses(1, $('#rowsPerPage').val());
                });

                $('#isExamCreate').on('change', function() {
                    $('.exam-section').toggle(this.checked);
                });

                // Course lessons list
                $('#courseLessonsList').on('click', '.chapter-header', chapterHeaderToggle);
                $(document).on('click', '.lesson-name', selectedVideo);
            });

            function resetModal() {
                $('#courseId').val(null);
                $('input[name="audience"]').prop('checked', false);
                $('input[name="course_type"]').prop('checked', false);
                $('input[name="subjects"]').prop('checked', false);
                $('#title').val('');
                $('#description').val('');
                $('#char-count').text('0');
                $('#thumbnail').val('');
                $('#preview-image').addClass('d-none').attr('src', '#');
                $('#chapter').val(null).trigger('change');
                $('.lessonSelectBox').empty();
                $('#isExamCreate').prop('checked', false);
                $('.exam-section').hide();
                $('#exam').val(null).trigger('change');
                $('#sat_type_1').addClass('d-none');
                $('#sat_type_2').addClass('d-none');
                currentStep = 1;
                showStep(currentStep);
            }

            function showStep(step) {
                $('.step').addClass('d-none');
                $(`.step-${step}`).removeClass('d-none');
                $('.step-circle').removeClass('active completed');
                $('.step-line').css('background', '#D0D5DD');
                $('.step-circle i').addClass('d-none');
                $('.step-circle .circle-count').removeClass('d-none');

                for (let i = 1; i < step; i++) {
                    $(`.step-circle[data-step=${i}]`).addClass('completed');
                    $(`.step-circle[data-step=${i}] i`).removeClass('d-none');
                    $(`.step-circle[data-step=${i}] .circle-count`).addClass('d-none');
                    $(`.step-circle[data-step=${i}]`).parent().next('.step-group').find('.step-line').css('background', '#12B76A');
                }

                $(`.step-circle[data-step=${step}]`).addClass('active');
                updateButtons();

                $('.step-title').text({
                    1: 'Step 1: Select Audience, Subject, Course Title and Description.',
                    2: 'Step 2: Add New Chapter or Add from existing Chapters',
                    3: 'Step 3: Add from existing lessons',
                    4: 'Step 4: Publish and Preview'
                }[step]);
            }

            function updateButtons() {
                $('.cancel').toggleClass('d-none', currentStep !== 1);
                $('.prev-step').toggleClass('d-none', currentStep === 1);
                $('.next-step').toggleClass('d-none', currentStep === totalSteps);
                $('.save-course').toggleClass('d-none', currentStep !== totalSteps);
            }

            function selectChapter(selectedVal = null) {
                let chapterSelect = $('#chapter');
                const lessonContainer = $('.lessonSelectBox');

                $.get('/api/get-chapter', function(data){
                    chapterSelect.empty();
                    chapterSelect.select2({
                        data: data,
                        placeholder: "Select Chapter",
                        allowClear: true,
                        width: '100%',
                    }).val(selectedVal).trigger('change');

                    chapterSelect.on('change').on('change', function () {
                        const selectedChapters = $(this).val(); // array of selected chapter IDs
                        lessonContainer.empty(); // Clear previous selections

                        if (selectedChapters && selectedChapters.length) {
                            selectedChapters.forEach((chapterId) => {
                                const chapter = data.find(c => c.id == chapterId);
                                const chapterTitle = chapter ? chapter.text : 'Unnamed Chapter';

                                const lessonSelectHTML = `
                                    <div class="mb-3">
                                        <label class="form-label"><strong>${chapterTitle}</strong></label>
                                        <select name="lessons[${chapterId}][]" id="lesson_${chapterId}" class="form-control lesson" multiple></select>
                                    </div>
                                `;

                                const wrapper = $(lessonSelectHTML);
                                selectLesson('#lesson_' + chapterId);


                                lessonContainer.append(wrapper);
                            });
                        }
                    });
                });
            }

            function selectLesson(lessonId, selectedVal = null) {

                $.get('/api/get-lesson', function(data){
                   $(`${lessonId}`).empty();
                    $(`${lessonId}`).select2({
                        data: data,
                        placeholder: "Select Lesson",
                        allowClear: true,
                        width: '100%',
                    }).val(selectedVal).trigger('change');
                });
            }

            function selectEditChapter(selectedVal = null) {
                return new Promise((resolve, reject) => {
                    let chapterSelect = $('#chapter');
                    const lessonContainer = $('.lessonSelectBox');

                    $.get('/api/get-chapter', function(data) {
                        console.log('Chapter data loaded:', data); // Debug

                        // Clear existing select2 and re-initialize
                        if (chapterSelect.hasClass('select2-hidden-accessible')) {
                            chapterSelect.select2('destroy');
                        }
                        chapterSelect.empty();
                        chapterSelect.select2({
                            data: data,
                            placeholder: 'Select Chapter',
                            allowClear: true,
                            width: '100%',
                        });

                        // Function to create lesson selects
                        function createLessonSelects(selectedChapters) {
                            lessonContainer.empty();
                            if (selectedChapters && selectedChapters.length) {
                                selectedChapters.forEach((chapterId) => {
                                    const chapter = data.find(c => c.id == chapterId);
                                    const chapterTitle = chapter ? chapter.text : 'Unnamed Chapter';

                                    const lessonSelectHTML = `
                                        <div class="mb-3">
                                            <label class="form-label"><strong>${chapterTitle}</strong></label>
                                            <select name="lessons[${chapterId}][]" id="lesson_${chapterId}" class="form-control lesson" multiple></select>
                                        </div>
                                    `;
                                    $('.lesson').select2();
                                    lessonContainer.append(lessonSelectHTML);
                                    console.log(`Created lesson select for chapter ${chapterId}`); // Debug
                                });
                                console.log('Lesson select elements created:', lessonContainer.html()); // Debug
                            } else {
                                console.log('No chapters selected, lesson container cleared'); // Debug
                            }
                        }

                        // Handle change event for select2
                        chapterSelect.on('select2:select select2:unselect', function() {
                            const selectedChapters = $(this).val() || [];
                            console.log('Chapter select changed, selected chapters:', selectedChapters); // Debug
                            createLessonSelects(selectedChapters);
                            resolve(); // Resolve after lesson selects are created
                        });

                        // Set initial value and create lesson selects
                        if (selectedVal && Array.isArray(selectedVal) && selectedVal.length) {
                            chapterSelect.val(selectedVal).trigger('change.select2');
                            createLessonSelects(selectedVal); // Explicitly create lesson selects
                            resolve(); // Resolve immediately after creating lesson selects
                        } else {
                            console.log('No chapters to select initially'); // Debug
                            resolve(); // Resolve if no chapters to select
                        }
                    }).fail(function(error) {
                        console.error('Failed to load chapters:', error); // Debug
                        Swal.fire('Error', 'Failed to load chapters.', 'error');
                        reject();
                    });
                });
            }

            function selectEditLesson(lessonId, selectedVal = null) {
                return new Promise((resolve, reject) => {
                    if (!$(lessonId).length) {
                        console.warn(`Lesson select element ${lessonId} does not exist.`); // Debug
                        resolve(); // Resolve to avoid blocking
                        return;
                    }

                    $.get('/api/get-lesson', function(data) {
                        console.log(`Lessons data for ${lessonId}:`, data); // Debug
                        console.log(`Attempting to select lessons for ${lessonId}:`, selectedVal); // Debug

                        if ($(lessonId).hasClass('select2-hidden-accessible')) {
                            $(lessonId).select2('destroy');
                        }
                        $(lessonId).empty();
                        $(lessonId).select2({
                            data: data,
                            placeholder: 'Select Lesson',
                            allowClear: true,
                            width: '100%',
                        });

                        if (selectedVal && Array.isArray(selectedVal)) {
                            $(lessonId).val(selectedVal).trigger('change.select2');
                            console.log(`Selected values for ${lessonId}:`, $(lessonId).val()); // Debug
                        }
                        $('.lesson').select2();

                        resolve();
                    }).fail(function(error) {
                        console.error('Failed to load lessons:', error); // Debug
                        Swal.fire('Error', 'Failed to load lessons.', 'error');
                        reject();
                    });
                });
            }

            function selectExam(selectedVal = null) {
                let examSelect = $('#exam');
                $.get('/api/get-exam', function(data) {
                    examSelect.empty();
                    examSelect.select2({
                        data: data,
                        placeholder: 'Select Exam',
                        allowClear: true,
                        width: '100%',
                    }).val(selectedVal).trigger('change');
                });
            }

            function fetchCourses(page = 1, perPage = 10, sort = 'Latest') {
                let filters = {
                    search: $('.search_input').val() || '',
                    difficulty: $('.difficulty:checked').map((_, el) => el.value).get(),
                    crated_start_at: $('input[name="crated_start_at"]').val() || '',
                    crated_end_at: $('input[name="crated_end_at"]').val() || '',
                    status: $('input[name="status"]:checked').val() || 'All',
                    audience: $('#all_sat_type_1 .nested-options input:checked').map((_, el) => el.value).get(),
                    audienceSat: $('#all_sat_type_2 #allSet2Toggle:checked').map((_, el) => el.value).get(),
                    courseSearch: $('.course_search_input').val() || '',
                    created_by: $('.custom-checkbox .created_by:checked').map((_, el) => el.value).get(),
                    average_time: {
                        min: $('#min-range').val() || 1,
                        max: $('#max-range').val() || 120
                    },
                    sort: sort,
                };

                $.ajax({
                    url: `/api/course?page=${page}&per_page=${perPage}`,
                    type: 'GET',
                    data: filters,
                    success: function(response) {
                        let courseList = $('#courseList');
                        let courseNullList = $('#courseNullList');
                        let tableBody = $('#course-table-body');

                        if (response.data.length === 0) {
                            courseNullList.removeClass('d-none');
                            courseList.addClass('d-none');
                        } else {
                            courseNullList.addClass('d-none');
                            courseList.removeClass('d-none');
                            tableBody.html('');

                            let rows = '';
                            $.each(response.data, function(index, course) {
                                rows += `
                                    <tr>
                                        <td><input type="checkbox" class="row-checkbox course-row" value="${course.uuid}"></td>
                                        <td>${course.title}</td>
                                        <td>${course.audience}</td>
                                        <td>${course.total_chapter}</td>
                                        <td>${course.total_lesson}</td>
                                        <td>${formatDuration(course.total_duration)}</td>
                                        <td>${formatDate(course.created_at)}</td>
                                        <td class="text-center">
                                            <button data-toggle="modal" data-id="${course.id}" data-target="#courseModal" class="btn edit-btn"><i class="far fa-edit"></i>Edit</button>
                                        </td>
                                    </tr>`;
                            });
                            tableBody.html(rows);
                            updatePagination(response, page);
                        }
                    },
                    error: function() {
                        alert('Error fetching courses.');
                    }
                });
            }

            function updatePagination(response, currentPage) {
                let totalResults = response.total;
                let perPage = response.per_page;
                let totalPages = response.last_page;
                let start = (response.from || 0);
                let end = (response.to || 0);

                $('#pagination-info').text(`Showing ${start}-${end} out of ${totalResults} results`);
                $('#total-courses').text(`${totalResults} Courses`);

                let paginationHtml = '';
                paginationHtml += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="1">«</a></li>`;
                paginationHtml += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${currentPage - 1}">‹</a></li>`;

                if (currentPage > 2) {
                    paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`;
                    paginationHtml += `<li class="page-item disabled"><a class="page-link" href="#">...</a></li>`;
                }

                for (let i = Math.max(1, currentPage - 1); i <= Math.min(totalPages, currentPage + 1); i++) {
                    paginationHtml += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                }

                if (currentPage < totalPages - 1) {
                    paginationHtml += `<li class="page-item disabled"><a class="page-link" href="#">...</a></li>`;
                    paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a></li>`;
                }

                paginationHtml += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${currentPage + 1}">›</a></li>`;
                paginationHtml += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${totalPages}">»</a></li>`;

                $('#pagination-links').html(paginationHtml);

                $('#pagination-links').on('click', '.page-link', function(e) {
                    e.preventDefault();
                    const page = $(this).data('page');
                    if (page && !$(this).parent().hasClass('disabled')) {
                        fetchCourses(page, $('#rowsPerPage').val());
                    }
                });
            }

            function formatDate(dateString) {
                let date = new Date(dateString);
                let options = { day: '2-digit', month: 'short', year: 'numeric' };
                return date.toLocaleDateString('en-GB', options);
            }

            function formatDuration(second) {
                const hours = Math.floor(second / 3600);
                const remainingSeconds = second % 3600;
                const mins = Math.floor(remainingSeconds / 60);
                const secs = remainingSeconds % 60;

                let result = '';
                if (hours > 0) result += hours + 'hr ';
                if (mins > 0) result += mins + 'min ';
                if (secs > 0) result += secs + 'sec';
                return result.trim();
            }

            function getSelectedCourses() {
                return $('.row-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();
            }

            function destroy() {
                let selectedCourses = getSelectedCourses();
                if (selectedCourses.length === 0) {
                    Swal.fire('Warning', 'Please select at least one course.', 'warning');
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
                            url: '/api/courses-delete',
                            type: 'POST',
                            data: {
                                courses: selectedCourses,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire('Deleted!', 'Courses deleted successfully.', 'success');
                                fetchCourses(1);
                                $('#active-count').text('');
                                $('#inactive-count').text('');
                            },
                            error: function() {
                                Swal.fire('Error', 'Failed to delete courses.', 'error');
                            }
                        });
                    }
                });
            }

            function updateActiveInactiveCount() {
                let selectedRows = $('.row-checkbox:checked').closest('tr');
                let activeCount = selectedRows.find('.toggle-status:checked').length;
                let inactiveCount = selectedRows.length - activeCount;
                $('#active-count').text(activeCount);
                $('#inactive-count').text(inactiveCount);
            }

            function store(e) {
                e.preventDefault();
                const submitButton = $('.save-course');
                submitButton.text('Processing').prop('disabled', true);

                let formData = new FormData();
                formData.append('audience', $('input[name="audience"]:checked').val() || '');
                formData.append('title', $('#title').val() || '');
                formData.append('description', $('#description').val() || '');
                formData.append('exam', $('#exam').val() || '');
                formData.append('total_duration', $('#total-duration').data('duration') || 0);
                formData.append('total_chapter', $('#total-chapters').data('chapter') || 0);
                formData.append('total_lesson', $('#total-lessons').data('lesson') || 0);
                formData.append('exam_checked', $('#isExamCreate').is(':checked') ? 1 : 0);

                let courseType = $('input[name="course_type"]:checked').val() || $('input[name="subjects"]:checked').val() || '';
                formData.append('sat_course_type', courseType);

                let thumbnail = $('#thumbnail')[0].files[0];
                if (thumbnail) {
                    formData.append('thumbnail', thumbnail);
                }

                let chapters = $('#chapter').val() || [];
                chapters.forEach((chapterId, index) => {
                    formData.append(`chapters[${index}]`, chapterId);
                    const selectedLessons = $(`select[name="lessons[${chapterId}][]"]`).val() || [];
                    selectedLessons.forEach((lessonId, lessonIndex) => {
                        formData.append(`lessons[${chapterId}][${lessonIndex}]`, lessonId);
                    });
                });

                const courseId = $('#courseId').val();
                const url = courseId ? `/api/course/${courseId}/update` : '/api/course';
                const method = courseId ? 'POST' : 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Success', response.message, 'success');
                            $('#courseModal').modal('hide');
                            resetModal();
                            fetchCourses(1, $('#rowsPerPage').val());
                        } else {
                            Swal.fire('Error', 'Failed to save course.', 'error');
                        }
                        submitButton.text('Save Course').prop('disabled', false);
                    },
                    error: function(error) {
                        submitButton.text('Save Course').prop('disabled', false);
                        let errors = error.responseJSON?.errors || {};
                        let errorMessage = Object.keys(errors).map(field => `${field.replace('_', ' ')}: ${errors[field].join(', ')}`).join('\n') || 'An unexpected error occurred.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: errorMessage,
                            footer: 'Please correct the errors and try again.'
                        });
                    }
                });
            }

            function show() {
                let courseId = $(this).data('id');
                resetModal();
                $('.course-modal-heading').text('Edit Course');
                $('#courseId').val(courseId);

                $.ajax({
                    url: `/api/course/${courseId}`,
                    type: 'GET',
                    success: async function(response) {
                        console.log('Course data:', response); // Debug

                        // Step 1: Populate audience and course type/subject
                        if (response.audience) {
                            $(`input[name="audience"][value="${response.audience}"]`).prop('checked', true).trigger('change');
                            if (response.audience === 'SAT 2') {
                                $('#sat_type_1').addClass('d-none');
                                $('#sat_type_2').removeClass('d-none');
                                if (response.subject) {
                                    $(`input[name="subjects"][value="${response.subject}"]`).prop('checked', true);
                                }
                            } else {
                                $('#sat_type_2').addClass('d-none');
                                $('#sat_type_1').removeClass('d-none');
                                if (response.subject) {
                                    $(`input[name="course_type"][value="${response.subject}"]`).prop('checked', true);
                                }
                            }
                        }

                        // Populate title and description
                        $('#title').val(response.title || '');
                        $('#description').val(response.description || '');
                        $('#char-count').text(response.description?.length || 0);

                        // Populate thumbnail
                        if (response.thumbnail) {
                            $('#preview-image').attr('src', `${appUrl}/storage/${response.thumbnail}`).removeClass('d-none');
                        }

                        // Step 2 & 3: Populate chapters and lessons
                        if (response.chapters && response.chapters.length > 0) {
                            const chapterIds = response.chapters.map(ch => ch.id);
                            console.log('Selected chapter IDs:', chapterIds); // Debug
                            await selectEditChapter(chapterIds);

                            // Wait for DOM to update
                            await new Promise(resolve => setTimeout(resolve, 100));

                            // Populate lessons for each chapter
                            for (const chapter of response.chapters) {
                                const lessonIds = chapter.lessons.map(lesson => lesson.id);
                                console.log(`Populating lessons for chapter ${chapter.id}:`, lessonIds); // Debug
                                await selectEditLesson(`#lesson_${chapter.id}`, lessonIds);
                            }
                        } else {
                            console.log('No chapters in course data'); // Debug
                            await selectChapter();
                        }

                        // Step 3: Populate exam
                        $('#isExamCreate').prop('checked', !!response.exam_id);
                        $('.exam-section').toggle(!!response.exam_id);
                        if (response.exam_id) {
                            await selectExam(response.exam_id);
                        } else {
                            await selectExam();
                        }

                        // Update step 4 preview
                        if (response.chapters && response.chapters.length > 0) {
                            $('#total-chapters').text(`${response.chapters.length} ${response.chapters.length === 1 ? 'Chapter' : 'Chapters'}`)
                                .attr('data-chapter', response.chapters.length);
                            const totalLessons = response.chapters.reduce((sum, chapter) => sum + chapter.lessons.length, 0);
                            $('#total-lessons').text(`${totalLessons} ${totalLessons === 1 ? 'Lesson' : 'Lessons'}`)
                                .attr('data-lesson', totalLessons);
                            $('#total-duration').text(formatDuration(response.total_duration || 0))
                                .attr('data-duration', response.total_duration || 0);
                            $('#lastAudience').text(response.audience || '');
                            $('#show_title').text(response.title || '');
                            $('#show_description').text(response.description || '');
                        }

                        // Show the modal at step 1
                        showStep(1);
                        $('#courseModal').modal('show');
                    },
                    error: function(error) {
                        console.error('Failed to load course data:', error);
                        Swal.fire('Error', 'Failed to load course data.', 'error');
                    }
                });
            }
            async function renderCourseContent() {
                $('#courseLessonsList').empty();
                const courseData = await collectCourseDataFromSelections();
                courseData.forEach((chapter, index) => {
                    let lessonsHtml = '';
                    chapter.lessons.forEach(lesson => {
                        const iconClass = lesson.type === 'Video' ? 'fa-play' : 'fa-file-pdf';
                        const statusHtml = lesson.completed ? '<i class="fas fa-check-circle"></i>' :
                            (lesson.progress > 0 && lesson.progress < 100 ?
                                `<div class="progress-bar-tiny"><div style="width: ${lesson.progress}%;"></div></div><span class="progress-percentage-small">${lesson.progress}%</span>` : '');
                        lessonsHtml += `
                            <div class="lesson-item ${lesson.completed ? 'completed' : ''} ${lesson.progress > 0 && !lesson.completed ? 'in-progress' : ''}" data-lesson-id="${lesson.id}">
                                <div class="lesson-item-icon">
                                    <i class="fas ${iconClass}"></i>
                                </div>
                                <div class="lesson-details">
                                    <div class="lesson-name" data-lesson-type="${lesson.type}" data-lesson-id="${lesson.id}" data-lesson-path="${lesson.file_path}">${lesson.name}</div>
                                    <div class="lesson-duration">${lesson.duration}</div>
                                </div>
                                <div class="lesson-status">${statusHtml}</div>
                            </div>
                        `;
                    });

                    const chapterClass = index === 0 ? 'expanded' : '';
                    const chapterHeaderActiveClass = index === 0 ? 'active' : '';
                    const chapterHtml = `
                        <div class="chapter-section ${chapterClass}" data-chapter-id="${chapter.id}">
                            <div class="chapter-header ${chapterHeaderActiveClass}">
                                <div class="chapter-title">
                                    <i class="fas fa-chevron-right chapter-toggle-icon"></i>
                                    <span>${chapter.title}</span>
                                </div>
                                <div class="chapter-meta">
                                    <span>${chapter.lessonsCount} Lessons</span>
                                    <span>${chapter.duration}</span>
                                </div>
                            </div>
                            <div class="chapter-content" ${index === 0 ? 'style="display: block;"' : ''}>
                                ${lessonsHtml}
                            </div>
                        </div>
                    `;
                    $('#courseLessonsList').append(chapterHtml);
                });

                $('.chapter-section.expanded .chapter-toggle-icon').css('transform', 'rotate(90deg)');
                // Removed updateCourseMeta() call as it is handled in collectCourseBeamFromSelections
            }

            async function collectCourseDataFromSelections() {
                const chapterSelect = $('#chapter');
                let chapterOptions = chapterSelect.hasClass('select2-hidden-accessible') ?
                    chapterSelect.select2('data') :
                    chapterSelect.find('option:selected').map(function() {
                        return { id: $(this).val(), text: $(this).text() };
                    }).get();

                const courseData = [];
                for (const chapter of chapterOptions) {
                    const chapterId = chapter.id;
                    const chapterTitle = chapter.text;
                    const lessonSelect = $(`select[name="lessons[${chapterId}][]"]`);
                    const selectedLessonIds = lessonSelect.val() || [];

                    if (selectedLessonIds.length === 0) continue;
                    const lessonData = await $.get('/api/lessons-by-id', { ids: selectedLessonIds });
                    const lessonObjects = lessonData.map(lesson => ({
                        id: lesson.id,
                        name: lesson.file_name,
                        file_path: lesson.file_path || 'video',
                        type: lesson.file_type || 'video',
                        duration: lesson.total_length || '00:10:00',
                        completed: lesson.completed || false,
                        progress: lesson.progress || 0
                    }));

                    const totalSeconds = lessonObjects.reduce((sum, lesson) => {
                        return lesson.type.toLowerCase() === 'video' ? sum + timeStringToSeconds(lesson.duration) : sum;
                    }, 0);

                    const totalDuration = secondsToTimeString(totalSeconds);
                    courseData.push({
                        id: chapterId,
                        title: chapterTitle,
                        lessonsCount: lessonObjects.length,
                        duration: totalDuration,
                        expanded: true,
                        lessons: lessonObjects
                    });
                }

                let firstVideoLesson = null;
                for (const chapter of courseData) {
                    const videoLesson = chapter.lessons.find(lesson => lesson.type.toLowerCase() === 'video');
                    if (videoLesson) {
                        firstVideoLesson = videoLesson;
                        break;
                    }
                }

                if (firstVideoLesson) {
                    const filePath = 'storage/' + firstVideoLesson.file_path;
                    const fullUrl = `${appUrl}${filePath}`;
                    $('#videoSource').attr('src', fullUrl);
                    $('#lesson-player')[0].load();
                }

                const totalChapters = courseData.length;
                const totalLessons = courseData.reduce((sum, chapter) => sum + chapter.lessons.length, 0);
                const totalCourseSeconds = courseData.reduce((sum, chapter) => {
                    return sum + timeStringToSeconds(chapter.duration);
                }, 0);

                const totalCourseDuration = secondsToTimeString(totalCourseSeconds);
                const $totalChapters = $('#total-chapters');
                const chapterLabel = totalChapters === 1 ? 'Chapter' : 'Chapters';
                $totalChapters.text(`${totalChapters} ${chapterLabel}`).attr('data-chapter', totalChapters);

                const $totalLessons = $('#total-lessons');
                const lessonLabel = totalLessons === 1 ? 'Lesson' : 'Lessons';
                $totalLessons.text(`${totalLessons} ${lessonLabel}`).attr('data-lesson', totalLessons);

                $('#total-duration').text(totalCourseDuration + ' Duration').attr('data-duration', totalCourseSeconds);
                $('#lastAudience').text($('input[name="audience"]:checked').val());
                $('#show_title').text($('#title').val());
                $('#show_description').text($('#description').val());
                return courseData;
            }

            function timeStringToSeconds(timeStr) {
                const [hours, minutes, seconds] = timeStr.split(':').map(Number);
                return hours * 3600 + minutes * 60 + seconds;
            }

            function secondsToTimeString(totalSeconds) {
                const hours = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
                const minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
                const seconds = String(totalSeconds % 60).padStart(2, '0');
                return `${hours}:${minutes}:${seconds}`;
            }

            function chapterHeaderToggle() {
                const $header = $(this);
                const $chapterSection = $header.closest('.chapter-section');
                const $chapterContent = $chapterSection.find('.chapter-content');
                const $toggleIcon = $header.find('.chapter-toggle-icon');

                $chapterContent.slideToggle(300, function() {
                    $chapterSection.toggleClass('expanded');
                    $toggleIcon.css('transform', $chapterSection.hasClass('expanded') ? 'rotate(90deg)' : 'rotate(0deg)');
                    $header.toggleClass('active', $chapterSection.hasClass('expanded'));
                });
            }

            function selectedVideo() {
                const $lessonItem = $(this);
                const filePath = 'storage/' + $lessonItem.data('lesson-path');
                const fileType = $lessonItem.data('lesson-type');
                const fullUrl = `${appUrl}${filePath}`;
                const isVideo = fileType ? fileType.toLowerCase() === 'video' : filePath.toLowerCase().endsWith('.mp4') || filePath.toLowerCase().endsWith('.webm');
                const isPdf = fileType ? fileType.toLowerCase() === 'pdf' : filePath.toLowerCase().endsWith('.pdf');

                if (isVideo) {
                    $('#videoSource').attr('src', fullUrl);
                    const video = $('#lesson-player')[0];
                    video.load();
                    video.play();
                } else if (isPdf) {
                    window.open(fullUrl, '_blank');
                }
            }
        </script>
    @endpush
</x-backend.layouts.master>