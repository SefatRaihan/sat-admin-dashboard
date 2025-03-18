<x-backend.layouts.master>
    @php
        $prependHtml = '
            <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                <a href=\'/exams/create\' data-toggle=\'modal\' data-target=\'#examModal\' class=\'btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                    <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Create Exam
                </a>
            </div>
        ';
    @endphp

    <x-backend.layouts.partials.blocks.contentwrapper :headerTitle="'All Exams'" :prependContent="$prependHtml">
    </x-backend.layouts.partials.blocks.contentwrapper>

    {{-- <x-backend.layouts.partials.blocks.empty-state
        title="You have not created any exams yet"
        message="Let’s add your first exam now"
        buttonText="Create Exam"
        buttonText="Create Exam"
        data-toggle="modal"
        data-target="#examModal"
    /> --}}
    <div>
        <div class="card"
            style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
            <div class="card-header border-bottom d-flex justify-content-between">
                <div>
                    <input type="text" class="form-control search_input" placeholder="Search Questions">
                </div>

                <div class="d-flex">
                    <button type="button" class="btn pt-0 pb-0 mr-2"
                        style="border: 1px solid #D0D5DD; border-radius: 8px;" onclick="filter(this)"><img
                            src="{{ asset('image/icon/layer.png') }}" alt=""> Filters</button>

                    <div class="form-group mb-0">
                        <select class="form-control multiselect" multiple="multiple" data-fouc>
                            <option value="All">All</option>
                            <option value="Unread">Unread</option>
                            <option value="Audience">Audience</option>
                            <option value="Audience">Question Type</option>
                            <option value="Audience">Difficulty</option>
                            <option data-role="divider"></option>
                            <option value="Latest">Latest</option>
                            <option value="Oldest">Oldest</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 m-0 table-responsive">
                <!-- Filters & Pagination Controls -->
                <div class="d-flex justify-content-between align-items-center mt-3 p-2">
                    <h4><strong id="total-questions"></strong></h4>
                    <div class="delete-btn d-none">
                        <button class="btn"><img src="{{ asset('image/icon/download.png') }}"
                                alt=""></button>
                        <button class="btn text-danger"><i class="fas fa-trash-alt"></i></button>
                        <button class="btn text-success"><strong>Make <span id="active-count"></span>
                                Active</strong></button>
                        <button class="btn text-warning"><strong>Make <span id="inactive-count"></span>
                                Inactive</strong></button>
                    </div>
                </div>

                <!-- Questions Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr align="center">
                                <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                                <th data-column="question" class="sortable">Exam</th>
                                <th data-column="audience" class="sortable">Audience</th>
                                <th data-column="question_type" class="sortable">Section</th>
                                <th data-column="exam" class="sortable">Total</th>
                                <th data-column="difficulty" class="sortable">Average</th>
                                <th data-column="avg_time" class="sortable">Highest</th>
                                <th data-column="created_at" class="sortable">Complete</th>
                                <th data-column="created_at" class="sortable">Created</th>
                                <th>State</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="exam-table-body">
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

    {{-- Create Modal --}}
    <section>
        <div class="modal fade" id="examModal" tabindex="-1" role="dialog" aria-labelledby="examModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="width:60%">
                <div class="modal-content" style="border-radius: 24px; height:100%">
                    <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                        <h5 class="" id="exampleModalLongTitle"><b>Create an Exam</b></h5>
                        <p class="pb-2">Set a name and provide the exam parameters</p>
                    </div>
                    <div class="modal-body" style="height: 600px; overflow-y: scroll;">
                        <div>
                            <div class="form-group">
                                <div style="display: flex; justify-content: space-between;">
                                    <label class="label-header" for="examName">Set a Name for the Exam</label>
                                    <label class="label-header" for="">Max 120 characters</label>
                                </div>
                                <input type="text" class="form-control" max="120" id="title" name="title" placeholder="">
                            </div>
                        </div>
                        <div>
                            <label class="label-header" for="">Select the Audience</label>
                            <div class="row">
                                <div class="col-md-6 row">
                                    <label class="radio-container mb-3 col-md-12">
                                        <input class="sat_1" type="radio" name="audience" value="High School" checked> High School
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
                        </div>
                        <div>
                            <label class="label-header" for="">How many sections will be there?</label>
                            <div class="row">
                                <div class="col-md-6 row">
                                    <label class="radio-container mb-3 col-md-12">
                                        <input type="radio" name="section" class="sections" value="1"> 1 Section
                                    </label>
                                    <label class="radio-container mb-3 col-md-12">
                                        <input type="radio" name="section" class="sections" value="2"> 2 Sections
                                    </label>
                                </div>
                                <div class="col-md-6 row">
                                    <label class="radio-container mb-3 col-md-12">
                                        <input type="radio" name="section" class="sections" value="3"> 3 Sections
                                    </label>
                                    <label class="radio-container mb-3 col-md-12">
                                        <input type="radio" name="section" class="sections" value="4"> 4 Sections
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="section_part section_div_1 d-none">
                            <label class="label-header" for="">Provide details for : Section 1</label>
                            <div style="background-color: #F9FAFB; border:1px solid #EAECF0;border-radius: 8px; padding: 13px 13px 0 13px;">
                                <div class="sat_type_1" >
                                    <label for="">Section Type</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_1" id="verbal_section_1" value="Verbal">
                                                <label class="form-check-label" for="verbal_section_1">
                                                    Verbal
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_1" id="quant_section_1" value="Quant">
                                                <label class="form-check-label" for="quant_section_1">
                                                Quant
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_1" id="mixed_section_1" value="Mixed">
                                                <label class="form-check-label" for="mixed_section_1">
                                                    Mixed
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none sat_type_2">
                                    <label for="">Section Type</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_1" id="physics_section_1" value="Physics">
                                                <label class="form-check-label" for="physics_section_1">
                                                    Physics
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_1" id="chemistry_section_1" value="Chemistry">
                                                <label class="form-check-label" for="chemistry_section_1">
                                                    Chemistry
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_1" id="biology_section_1" value="Biology">
                                                <label class="form-check-label" for="biology_section_1">
                                                    Biology
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_1" id="math_section_1" value="Math">
                                                <label class="form-check-label" for="math_section_1">
                                                    Math
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_1" id="mixed_sat_section_1" value="Mixed">
                                                <label class="form-check-label" for="mixed_sat_section_1">
                                                    Mixed
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label class="label-header" for="">Name of the Section</label>
                                            <input type="text" class="form-control" id="examName" name="exam_name" placeholder="Verbal Section">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-header" for="">No of Questions (Verbal)</label>
                                                    <input type="text" class="form-control no_of_questions" id="no_of_questions" name="no_of_questions" placeholder="20">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-header" for="">Set Duration (minutes)</label>
                                                    <input type="text" class="form-control duration" id="duration" name="duration" placeholder="40">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section_part section_div_2 d-none">
                            <label class="label-header" for="">Provide details for : Section 2</label>
                            <div style="background-color: #F9FAFB; border:1px solid #EAECF0;border-radius: 8px; padding: 13px 13px 0 13px;">
                                <div class="sat_type_1" >
                                    <label for="">Section Type</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_2" id="verbal_section_2" value="Verbal">
                                                <label class="form-check-label" for="verbal_section_2">
                                                    Verbal
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_2" id="quant_section_2" value="Quant">
                                                <label class="form-check-label" for="quant_section_2">
                                                Quant
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_2" id="mixed_section_2" value="Mixed">
                                                <label class="form-check-label" for="mixed_section_2">
                                                    Mixed
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none sat_type_2">
                                    <label for="">Section Type</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_2" id="physics_section_2" value="Physics">
                                                <label class="form-check-label" for="physics_section_2">
                                                    Physics
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_2" id="chemistry_section_2" value="Chemistry">
                                                <label class="form-check-label" for="chemistry_section_2">
                                                    Chemistry
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_2" id="biology_section_2" value="Biology">
                                                <label class="form-check-label" for="biology_section_2">
                                                    Biology
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_2" id="math_section_2" value="Math">
                                                <label class="form-check-label" for="math_section_2">
                                                    Math
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_2" id="mixed_sat_section_2" value="Mixed">
                                                <label class="form-check-label" for="mixed_sat_section_2">
                                                    Mixed
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label class="label-header" for="">Name of the Section</label>
                                            <input type="text" class="form-control" id="examName" name="exam_name" placeholder="Verbal Section">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-header" for="">No of Questions (Verbal)</label>
                                                    <input type="text" class="form-control no_of_questions" id="no_of_questions" name="no_of_questions" placeholder="20">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-header" for="">Set Duration (minutes)</label>
                                                    <input type="text" class="form-control duration" id="duration" name="duration" placeholder="40">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section_part section_div_3 d-none">
                            <label class="label-header" for="sat_type_1"> Provide details for : Section 3</label>
                            <div style="background-color: #F9FAFB; border:1px solid #EAECF0;border-radius: 8px; padding: 13px 13px 0 13px;">
                                <div class="sat_type_1" >
                                    <label for="">Section Type</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_3" id="verbal_section_3" value="Verbal">
                                                <label class="form-check-label" for="verbal_section_3">
                                                    Verbal
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_3" id="quant_section_3" value="Quant">
                                                <label class="form-check-label" for="quant_section_3">
                                                Quant
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_3" id="mixed_section_3" value="Mixed">
                                                <label class="form-check-label" for="mixed_section_3">
                                                    Mixed
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none sat_type_2">
                                    <label for="">Section Type</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_3" id="physics_section_3" value="Physics">
                                                <label class="form-check-label" for="physics_section_3">
                                                    Physics
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_3" id="chemistry_section_3" value="Chemistry">
                                                <label class="form-check-label" for="chemistry_section_3">
                                                    Chemistry
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_3" id="biology_section_3" value="Biology">
                                                <label class="form-check-label" for="biology_section_3">
                                                    Biology
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_3" id="math_section_3" value="Math">
                                                <label class="form-check-label" for="math_section_3">
                                                    Math
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_3" id="mixed_sat_section_3" value="Mixed">
                                                <label class="form-check-label" for="mixed_sat_section_3">
                                                    Mixed
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label class="label-header" for="">Name of the Section</label>
                                            <input type="text" class="form-control" id="examName" name="exam_name" placeholder="Verbal Section">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-header" for="">No of Questions (Verbal)</label>
                                                    <input type="text" class="form-control no_of_questions" id="no_of_questions" name="no_of_questions" placeholder="20">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-header" for="">Set Duration (minutes)</label>
                                                    <input type="text" class="form-control duration" id="duration" name="duration" placeholder="40">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section_part section_div_4 d-none">
                            <label class="label-header" for="sat_type_1"> Provide details for : Section 4</label>
                            <div style="background-color: #F9FAFB; border:1px solid #EAECF0;border-radius: 8px; padding: 13px 13px 0 13px;">
                                <div class="sat_type_1" >
                                    <label for="">Section Type</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_4" id="verbal_section_4" value="Verbal">
                                                <label class="form-check-label" for="verbal_section_4">
                                                    Verbal
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_4" id="quant_section_4" value="Quant">
                                                <label class="form-check-label" for="quant_section_4">
                                                Quant
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_4" id="mixed_section_4" value="Mixed">
                                                <label class="form-check-label" for="mixed_section_4">
                                                    Mixed
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none sat_type_2">
                                    <label for="">Section Type</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_4" id="physics_section_4" value="Physics">
                                                <label class="form-check-label" for="physics_section_4">
                                                    Physics
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_4" id="chemistry_section_4" value="Chemistry">
                                                <label class="form-check-label" for="chemistry_section_4">
                                                    Chemistry
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_4" id="biology_section_4" value="Biology">
                                                <label class="form-check-label" for="biology_section_4">
                                                    Biology
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_4" id="math_sat_section_4" value="Math">
                                                <label class="form-check-label" for="math_sat_section_4">
                                                    Math
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-check custom-radio">
                                                <input class="form-check-input" type="radio" name="sat_type_section_4" id="mixed_section_4" value="Mixed">
                                                <label class="form-check-label" for="mixed_section_4">
                                                    Mixed
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label class="label-header" for="">Name of the Section</label>
                                            <input type="text" class="form-control" id="examName" name="exam_name" placeholder="Verbal Section">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-header" for="">No of Questions (Verbal)</label>
                                                    <input type="text" class="form-control no_of_questions" id="no_of_questions" name="no_of_questions" placeholder="20">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-header" for="">Set Duration (minutes)</label>
                                                    <input type="text" class="form-control duration" id="duration" name="duration" placeholder="40">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-group mt-2">
                                <label class="label-header" for=""> Total no of Questions</label>
                                <input type="text" class="form-control" id="total_questions" name="total_questions" readonly>
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label class="label-header" for=""> Total duration</label>
                                <input type="text" class="form-control" id="total_duration" name="total_duration" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-3">
                        <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                        <a href="" class="btn save-exam" style="background-color:#691D5E; border-radius: 8px; color:#D0D5DD">Proceed to Add Questions</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('css')
        <style>
            input[type="radio"] {
                accent-color: #691D5E;
            }
            .label-header {
                font-size: 12px;
                font-weight: bold;
            }
        </style>
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
            input[type='checkbox'] {
                width: 20px;
                height: 20px;
                border: 1px solid #D0D5DD !important;
                appearance: none; /* Removes default checkbox styling */
                background-color: white;
                cursor: pointer;
                border-radius: 4px !important; /* Optional: for rounded corners */
            }

            /* Checked state */
            input[type='checkbox']:checked {
                background-color: #3F1239; /* Change the background color when checked */
                position: relative;
            }

            /* Adding a custom checkmark */
            input[type='checkbox']:checked::after {
                content: '✓'; /* Unicode checkmark */
                font-size: 12px;
                color: white; /* Checkmark color */
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100%;
            }
            .dataTable tbody > tr.selected, .dataTable tbody > tr > .selected {
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

            /* Change background and border when checked */
            .custom-radio .form-check-input:checked ~ .form-check {
                background-color: #F1E9F0; /* Light purple */
                border-color: #A16A99; /* Darker purple */
            }

            .form-check-input:checked {
                background-color: #732066 !important; /* Dark purple for radio */
                border-color: #732066 !important;
                margin: 2px;
            }

            .form-check-input:checked + .form-check-label {
                color: #344054; /* Keeping text dark */
                font-weight: 500;
            }

            /* Hover effect */
            .form-check:hover {
                border-color: #732066;
            }

            /* Hide default radio circle and use custom */
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

            /* Custom radio circle when checked */
            .custom-radio .form-check-input:checked + .form-check-label::before {
                border-color: #732066;  /* Outer border color */
                background-color: #732066;
                box-shadow: 0 0 0 2px white, 0 0 0 4px #732066; /* White gap (2px) and outer blue border (2px) */
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

            /* Custom radio circle when checked */
            .status-radio .form-check-input:checked + .form-check-label::before {
                border-color: #732066;  /* Outer border color */
                background-color: #732066;
                width: 10px;
                height: 10px;
                margin-left: 4px;
                box-shadow: 0 0 0 2px white, 0 0 0 4px #732066; /* White gap (2px) and outer blue border (2px) */
            }

            .form-check-input:checked ~ .form-check-label {
                color: #344054;
                font-weight: 500;
            }

            /* Change parent background when checked */
            .custom-radio:has(.form-check-input:checked) {
                background-color: #F1E9F0; /* Light purple */
                border-color: #A16A99; /* Darker purple */
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
            .dropzone .dz-default.dz-message > span {
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
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%; /* Full width of parent */
                background-color: #fff;
                border-top: 1px solid #D0D5DD;
            }
        </style>
        <style>
            .floating-sidebar {
                position: fixed;
                top: 0;
                right: -400px;
                width: 400px;
                height: 100%;
                background-color: #fff;
                box-: -2px 0 5px rgba(0, 0, 0, 0.2);
                transition: right 0.3s ease-in-out;
                z-index: 1050;
                overflow-y: auto;
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
            }

            .floating-sidebar.open {
                right: 0;
            }

            .sidebar-overlay.active {
                display: block;
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
                bottom: 50px;
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
                border: 1px solid #EAECF0;
                border-radius: 8px;
                align-items: end;
                display: flex;
                justify-content: center;
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
        </style>
        <style>
            .switch {
                position: relative;
                display: inline-block;
                width: 50px;
                height: 23px;
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
                -webkit-transition: .4s;
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 16px;
                width: 16px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }

            input:checked + .slider {
                background-color: #2196F3;
            }

            input:focus + .slider {
                box-shadow: 0 0 1px #2196F3;
            }

            input:checked + .slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }

            /* Rounded sliders */
            .slider.round {
                border-radius: 34px;
            }

            .slider.round:before {
                border-radius: 50%;
            }
        </style>
    @endpush

    @push('js')
        <script>
            $(document).ready(function() {
                $(".sat_2").change(function () {
                    $(".sat_type_2").removeClass("d-none");
                    $(".sat_type_1").addClass("d-none");
                });

                $(".sat_1").change(function () {
                    $(".sat_type_1").removeClass("d-none");
                    $(".sat_type_2").addClass("d-none");
                });

                $(document).on('input change', '.no_of_questions, .duration', function() {
                    calculateTotalSectionValues();
                });
                $(document).on('change', "input[name='section']", section);
                $(document).on('click', ".save-exam", store);

                // fetchQuestions(currentPage, perPage);

                // // Handle pagination clicks
                // $(document).on('click', '.pagination a', function(e) {
                //     e.preventDefault();
                //     let page = $(this).data('page');
                //     if (page) {
                //         currentPage = page;
                //         fetchQuestions(currentPage, perPage);
                //     }
                // });

                // // Handle "Rows per page" change
                // $('#rowsPerPage').change(function() {
                //     perPage = $(this).val();
                //     fetchQuestions(1, perPage);
                // });

                // $('.search_input, .multiselect').on('input click', function() {
                //     fetchQuestions();
                // });

                // $(document).on('change', '.toggle-status', updateState);
            });

            function section() {

                var sectionValue = $("input[name='section']:checked").val();

                // Hide all section divs initially
                $(".section_part").addClass("d-none");

                // Show only the necessary divs
                for (let i = 1; i <= sectionValue; i++) {
                    $(".section_div_" + i).removeClass("d-none");
                }
            }

            function calculateTotalSectionValues() {
                let totalQuestions = 0;
                let totalDuration = 0;

                $('.section_part').each(function(index) {
                    if ($(this).hasClass("d-none")) return;

                    const no_of_questions = parseInt($(this).find('input[name="no_of_questions"]').val()) || 0;
                    const duration = parseInt($(this).find('input[name="duration"]').val()) || 0;
                    console.log(no_of_questions, duration);

                    totalQuestions += no_of_questions;
                    totalDuration += duration;
                });

                // Update totals in the DOM
                $('#total_questions').val(totalQuestions);
                $('#total_duration').val(totalDuration);
            }

            const store = (e) => {
                 e.preventDefault();

                let formData = {
                    title: $('#title').val(),
                    audience: $('input[name="audience"]:checked').val(),
                    section: $('input[name="section"]:checked').val(),
                    section_details: [],
                    total_questions: 0,
                    total_duration: 0
                };

                let totalQuestions = 0;
                let totalDuration = 0;

                $('.section_part').each(function(index) {
                    if ($(this).hasClass("d-none")) return; // Skip hidden sections

                    const sectionIndex = index + 1;

                    const $inputs = $(this).find('input');
                    const no_of_questions = parseInt($inputs.filter('[name="no_of_questions"]').val()) || 0;
                    const duration = parseInt($inputs.filter('[name="duration"]').val()) || 0;

                    const sectionData = {
                        section_type: $inputs.filter(`[name="sat_type_section_${sectionIndex}"]:checked`).val(),
                        exam_name: $inputs.filter('[name="exam_name"]').val(),
                        section_order: sectionIndex,
                        no_of_questions,
                        duration
                    };

                    formData.section_details.push(sectionData);
                    totalQuestions += no_of_questions;
                    totalDuration += duration;
                });

                formData.total_questions = totalQuestions;
                formData.total_duration = totalDuration;

                // console.log(formData);

                 $.ajax({
                     url: '/api/exams',
                     type: 'POST',
                     data: formData,
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     success: function(response) {
                         if (response.success) {
                            Swal.fire("Success", "Exam created successfully!", "success").then(() => {
                                window.location.href = response.redirect;
                            });
                         } else {
                             Swal.fire("Error", "Failed to created successfully!", "error");
                             checkbox.prop('checked', !checkbox.is(':checked'));
                         }
                     },
                     error: function(response) {
                         Swal.fire("Error", response.error, "error");
                         Swal.fire("Error", "Something went wrong!", "error");
                         checkbox.prop('checked', !checkbox.is(':checked'));
                     }

                });
            }


            // get all exams
            function fetchQuestions(page = 1, perPage = 10) {
                let filters = {
                    search: $('.search_input').val(),
                    difficulty: $('.multiselect').val(),
                };

                $.ajax({
                    url: "/api/exam?page=" + page + "&per_page=" + perPage,
                    type: "GET",
                    data: filters,
                    success: function(response) {
                        let rows = '';
                        $.each(response.data, function(index, question) {
                            let difficultyColor = getDifficultyColor(question.difficulty);
                            let statusChecked = question.status ? "checked" : "";

                            // <td><span class="badge badge-pill badge-hard">Hard</span><p class="text-center"><span>9/10</span>(70%)</p></td>
                            rows += `<tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" >${question.question_title}</td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" >${question.audience}</td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" >${question.question_type}</td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" >${question.exam || ''}</td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" ><span class="badge badge-pill ${difficultyColor}">${question.difficulty}</span></td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" >${question.avg_time || '00:00'} min</td>
                                <td class="openDetailModal" data-toggle="modal" data-target="#detailModalCenter" >${question.created_at}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-status" data-id="${question.id}" ${question.status === 'active' ? 'checked' : '' }>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                     <td class="text-center"><button data-toggle="modal" data-id="${question.id}" data-target="#questionModal" class="btn edit-btn"><i class="far fa-edit"></i>Edit</button></td>
                                </td>
                            </tr>`;
                        });
                        $("#exam-table-body").html(rows);
                        updatePagination(response, page);
                    },
                    error: function() {
                        alert("Error fetching questions.");
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
                $('#total-questions').text(`${totalResults} Questions`);

                let paginationHtml = '';

                // First & Previous
                paginationHtml += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="1">«</a></li>`;
                paginationHtml += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="${currentPage - 1}">‹</a></li>`;

                // Page Numbers
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
                    paginationHtml +=
                        `<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a></li>`;
                }

                // Next & Last
                paginationHtml += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="${currentPage + 1}">›</a></li>`;
                paginationHtml += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                        <a class="page-link" href="#" data-page="${totalPages}">»</a></li>`;

                $('#pagination-links').html(paginationHtml);
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

            // Toggle status (on/off)
            function updateState() {
                let questionId = $(this).data('id');

                let newStatus = $(this).is(':checked') ? 'active' : 'inactive';

                $.ajax({
                    url: `/api/questions/${questionId}/update-status`,
                    type: "PATCH",
                    data: {
                        status: newStatus
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire("Success", "Status updated successfully!", "success");
                        } else {
                            Swal.fire("Error", "Failed to update status.", "error");
                            checkbox.prop('checked', !checkbox.is(':checked'));
                        }
                    },
                    error: function() {
                        Swal.fire("Error", "Something went wrong!", "error");
                        checkbox.prop('checked', !checkbox.is(':checked'));
                    }
                });
            }
        </script>
    @endpush
</x-backend.layouts.master>
