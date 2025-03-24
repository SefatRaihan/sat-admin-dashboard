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

    <div class="d-none" id="examNullList">
        <x-backend.layouts.partials.blocks.empty-state 
            title="You have not created any exams yet"
            message="Let’s add your first exam now"
            buttonText="Create Exam"
            buttonRoute="#examModal"
        />
    </div>

    <div id="examList">
        <div class="card"
            style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
            <div class="card-header border-bottom d-flex justify-content-between">
                <div>
                    <input type="text" id="search" class="form-control search_input" placeholder="Search Exam" style="padding-left: 40px">
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
                            <option value="Audience">Exam Type</option>
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
                    <h4><strong id="total-exams"></strong></h4>
                    <div class="delete-btn d-none">
                        <button class="btn"><img src="{{ asset('image/icon/download.png') }}"
                                alt=""></button>
                        <button class="btn text-danger exam-delete"><i class="fas fa-trash-alt"></i></button>
                        <button class="btn text-success"><strong>Make <span id="active-count"></span>
                                Active</strong></button>
                        <button class="btn text-warning"><strong>Make <span id="inactive-count"></span>
                                Inactive</strong></button>
                    </div>
                </div>

                <!-- Exams Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr align="center">
                                <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                                <th data-column="exam" class="sortable text-left">Exam</th>
                                <th data-column="audience" class="sortable text-left">Audience</th>
                                <th data-column="exam_type" class="sortable text-left">Section</th>
                                <th data-column="exam" class="sortable text-left">Total</th>
                                <th data-column="difficulty" class="sortable text-left">Average</th>
                                <th data-column="avg_time" class="sortable text-left">Highest</th>
                                <th data-column="created_at" class="sortable text-left">Complete</th>
                                <th data-column="created_at" class="sortable text-left">Created</th>
                                <th class="text-left">State</th>
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
                                                    <label class="label-header" for="">No of Exams (Verbal)</label>
                                                    <input type="text" class="form-control no_of_exams" id="no_of_exams" name="no_of_questions" placeholder="20">
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
                                                    <label class="label-header" for="">No of Question (Verbal)</label>
                                                    <input type="text" class="form-control no_of_exams" id="no_of_exams" name="no_of_questions" placeholder="20">
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
                                                    <label class="label-header" for="">No of Exams (Verbal)</label>
                                                    <input type="text" class="form-control no_of_exams" id="no_of_exams" name="no_of_questions" placeholder="20">
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
                                                    <label class="label-header" for="">No of Exams (Verbal)</label>
                                                    <input type="text" class="form-control no_of_exams" id="no_of_exams" name="no_of_questions" placeholder="20">
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
                        <a href="" class="btn save-exam" style="background-color:#691D5E; border-radius: 8px; color:#D0D5DD">Proceed to Add Exams</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="sidebar-overlay" id="taskSidebarOverlay"></div>
    <div class="floating-sidebar" id="taskSidebar">
        <div class="filter">
            <div class="sidebar-header">
                <div>
                    <h4 style="font-size: 18px;" class="p-0 m-0">Filters</h4>
                    <p class="p-0 m-0" style="color: #475467">Apply filters to table data.</p>
                </div>
                <button type="button" class="close-btn" id="closeSidebar">&times;</button>
            </div>
            <div class="filter-sidebar-content">
                <div class="task-form">
                    <div class="pt-3 pr-3 pb-3 pl-0">
                        <div class="d-flex justify-content-between">
                            <p style="font-size: 12px"> <span style="color: #344054"><b>Created on:</b></span> <span
                                    style="color: #475467">06 Jan 25 - 12 Jan 25</span></p>
                            <button class="reset-slider"><u>Reset</u></button>
                        </div>
                        <div class="mt-1 mb-2 d-flex justify-content-between">
                            <div style="width: 49%">
                                <input type="date" class="form-control" name="crated_start_at">
                            </div>
                            <div style="align-items: center; display: flex; width:1%">
                                -
                            </div>
                            <div style="width: 49%">
                                <input type="date" class="form-control" name="crated_end_at">
                            </div>
                        </div>
                        <div id="filter-status">
                            <div class="d-flex justify-content-between">
                                <h6><b>Status:</b> Active Only</h6>
                            </div>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="all"
                                    value="All" checked>
                                <label class="form-check-label" for="all">
                                    All
                                </label>
                            </div>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="activeonly"
                                    value="Active only">
                                <label class="form-check-label" for="activeonly">
                                    Active only
                                </label>
                            </div>
                            <div class="form-check status-radio">
                                <input class="form-check-input" type="radio" name="status" id="inactiveonly"
                                    value="Inactive only">
                                <label class="form-check-label" for="inactiveonly">
                                    Inactive only
                                </label>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="d-flex justify-content-between">
                                <h6><b>Audience & Type:</b> All Result</h6>
                            </div>
                            <div id="all_sat_type_1">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class=" toggle-parent" type="checkbox"
                                            id="allSet1Toggle">
                                        <label class="form-check-label" for="allSet1Toggle">
                                            All SAT 1
                                        </label>
                                        <span class="toggle-icon" data-target="allSet1"><i
                                                class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="nested-options collapse" id="allSet1">
                                        <div class="form-check">
                                            <input class="" type="checkbox" id="exam1">
                                            <label class="form-check-label" for="exam1">Hight School :
                                                Verbal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="" type="checkbox" id="exam2">
                                            <label class="form-check-label" for="exam2">Hight School :
                                                Quant</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="" type="checkbox" id="exam3">
                                            <label class="form-check-label" for="exam3">College :
                                                Verbal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="" type="checkbox" id="exam3">
                                            <label class="form-check-label" for="exam3">College :
                                                Verbal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="" type="checkbox" id="exam3">
                                            <label class="form-check-label" for="exam3">Graduate :
                                                Verbal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="" type="checkbox" id="exam3">
                                            <label class="form-check-label" for="exam3">Graduate :
                                                Quant</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="all_sat_type_2">
                                <div class="filter-group">
                                    <div class="form-check">
                                        <input class=" toggle-parent" type="checkbox"
                                            id="allSet2Toggle">
                                        <label class="form-check-label" for="allSet2Toggle">
                                            All SAT 2
                                        </label>
                                        <span class="toggle-icon" data-target="allSet2"><i
                                                class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div class="nested-options collapse" id="allSet2">
                                        <div class="form-check">
                                            <input class="" type="checkbox" id="exam1">
                                            <label class="form-check-label" for="exam1">Verbal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="" type="checkbox" id="exam2">
                                            <label class="form-check-label" for="exam2">Quant</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="d-flex justify-content-between">
                                <h6><b>Exam Appearance:</b> 2 Selected</h6>
                            </div>
                            <div class="mb-1">
                                <input type="text" class="form-control search_input w-100 pl-4"
                                    placeholder="Search Exams">
                            </div>
                            <div class="filter-group">
                                <div class="form-check">
                                    <input class=" toggle-parent" type="checkbox"
                                        id="highSchoolToggle">
                                    <label class="form-check-label" for="highSchoolToggle">
                                        View all High School Exams
                                    </label>
                                    <span class="toggle-icon" data-target="highSchoolOptions"><i
                                            class="fas fa-chevron-down"></i></span>
                                </div>
                                <div class="nested-options collapse" id="highSchoolOptions">
                                    <div class="form-check">
                                        <input class="" type="checkbox" id="exam1">
                                        <label class="form-check-label" for="exam1">High School Verbal Exam
                                            1</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="" type="checkbox" id="exam2">
                                        <label class="form-check-label" for="exam2">High School Verbal Exam
                                            2</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="" type="checkbox" id="exam3">
                                        <label class="form-check-label" for="exam3">High School Verbal Exam
                                            3</label>
                                    </div>
                                </div>
                            </div>

                            <div class="filter-group">
                                <div class="form-check">
                                    <input class=" toggle-parent" type="checkbox"
                                        id="collegeToggle">
                                    <label class="form-check-label" for="collegeToggle">
                                        View all College Exams
                                    </label>
                                    <span class="toggle-icon" data-target="collegeOptions"><i
                                            class="fas fa-chevron-down"></i></span>
                                </div>
                                <div class="nested-options collapse" id="collegeOptions">
                                    <div class="form-check">
                                        <input class="" type="checkbox" id="college1">
                                        <label class="form-check-label" for="college1">College Verbal Exam</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="" type="checkbox" id="college2">
                                        <label class="form-check-label" for="college2">College Quant Exam</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="d-flex justify-content-between">
                                <h6><b>Defficulty Level:</b> All Result</h6>
                            </div>
                            <div class="form-check custom-checkbox d-flex justify-center">
                                <input type="checkbox" class="difficulty" value="Easy">
                                <label class="form-check-label pl-1"><span
                                        class="badge badge-pill badge-easy"><b>Easy</b></span></label>
                            </div>
                            <div class="form-check custom-checkbox d-flex justify-center">
                                <input type="checkbox" class="difficulty" value="Medium">
                                <label class="form-check-label pl-1"><span
                                        class="badge badge-pill badge-medium"><b>Medium</b></span></label>
                            </div>
                            <div class="form-check custom-checkbox d-flex justify-center">
                                <input type="checkbox" class="defficulty" value="Hard">
                                <label class="form-check-label pl-1" for="gladiator"><span
                                        class="badge badge-pill badge-hard"><b>Hard</b></span></label>
                            </div>
                            <div class="form-check custom-checkbox d-flex justify-center">
                                <input type="checkbox" class="difficulty" value="Very Hard">
                                <label class="form-check-label pl-1" for="gladiator"><span
                                        class="badge badge-pill badge-very-hard"><b>Very Hard</b></span></label>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="slider-container" style="max-width: 100% !important;">
                                <div class="slider-header">
                                    <span>Correct Percentage: All Result</span>
                                </div>
                                <div class="range-slider">
                                    <input type="range" min="1" max="120" value="1"
                                        id="min-range">
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="slider-container" style="max-width: 100% !important;">
                                <div class="slider-header">
                                    <span>Average Time: All Result</span>
                                </div>
                                <div class="range-slider">
                                    <input type="range" min="1" max="120" value="1"
                                        id="min-range">
                                    <input type="range" min="1" max="120" value="120"
                                        id="max-range">
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <h6><b>Created By:</b></h6>
                            @foreach ($exams as $exam)
                            <div class="form-check custom-checkbox d-flex justify-center">
                                <input type="checkbox" class="created_by" value="{{ $exam->createdBy->id ?? '' }}">
                                <label class="form-check-label pl-1">{{ $exam->createdBy->full_name ?? '' }}</label>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
            <div class="border-top fixed-bottom-buttons">
                <div class="d-flex justify-content-between p-3">
                    <button type="button" class="btn apply-filter-btn"
                        style="background-color:#691D5E ;border-radius: 8px; color:#fff; width:50%">Apply
                        Filters</button>
                    <button type="button" class="btn btn-outline-dark ml-2 reset-filter-btn"
                        style="border: 1px solid #D0D5DD; border-radius: 8px; width:50%">Reset All</button>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            input[type="radio"] {
                accent-color: #691D5E;
            }
            .label-header {
                font-size: 12px;
                font-weight: bold;
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

            /* filter sidebar every dropdown start */
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

            /* filter sidebar every dropdown end */

            /* filter avg time slider start  */
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

            /* avg time slider end */

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

            /* Active step */
            .step-circle.active {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: #691D5E;
                color: white;
                border-color: #691D5E;
            }

            /* Completed step */
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

            .border-left {
                border-left: 3px solid #6c757d;
                /* Left border when options exist */
                padding-left: 10px;
                /* Spacing to avoid text touching the border */
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
               
        </style>
    @endpush

    @push('js')
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_multiselect.js"></script>
        <script>
            $(document).ready(function() {
                $('#closeSidebar, #taskSidebarOverlay').on('click', function() {
                    $('#taskSidebar').removeClass('open');
                    $('#taskSidebarOverlay').removeClass('active');
                    $('#boardHiddenInputSection').html('');
                });
            });

            function filter(button) {
                const filter = $('.filter');
                filter.show();
                $('#taskSidebar').addClass('open');
                $('#taskSidebarOverlay').addClass('active');
            }


            // filter every dropdown in sidebar
            document.querySelectorAll(".toggle-icon").forEach(icon => {
                icon.addEventListener("click", function() {
                    const target = document.getElementById(this.dataset.target);
                    target.classList.toggle("collapse");
                    this.classList.toggle("open");
                    target.style.display = target.classList.contains("collapse") ? "none" : "block";
                });
            });

            document.querySelectorAll(".toggle-parent").forEach(parentCheckbox => {
                parentCheckbox.addEventListener("change", function() {
                    let targetDiv = document.getElementById(this.nextElementSibling.nextElementSibling.dataset
                        .target);
                    let checkboxes = targetDiv.querySelectorAll("input[type='checkbox']");
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });
            });

            // avg time filter slider
            const minRange = document.getElementById("min-range");
            const maxRange = document.getElementById("max-range");
            const minLabel = document.getElementById("min-label");
            const maxLabel = document.getElementById("max-label");
            const sliderValue = document.getElementById("slider-value");
            const resetButton = document.getElementById("reset-slider");

            function updateSlider() {
                let minValue = parseInt(minRange.value);
                let maxValue = parseInt(maxRange.value);

                if (maxValue - minValue < 10) {
                    minRange.value = maxValue - 10;
                    maxRange.value = minValue + 10;
                }

                minLabel.innerText = `${Math.floor(minRange.value / 60)}m ${minRange.value % 60}s`;
                maxLabel.innerText = `${Math.floor(maxRange.value / 60)}m ${maxRange.value % 60}s`;

                sliderValue.innerText = `${minLabel.innerText} - ${maxLabel.innerText}`;
            }

            minRange.addEventListener("input", updateSlider);
            maxRange.addEventListener("input", updateSlider);

            // resetButton.addEventListener("click", () => {
            //     minRange.value = 90; // Reset to full range
            //     maxRange.value = 120;
            //     updateSlider();
            // });

            // Ensure initial full length is displayed
            // updateSlider();
        </script>
        <script>
            // toggle delete checkboxes
            $(document).ready(function() {
                function toggleDeleteButton() {
                    let anyChecked = $(".row-checkbox:checked").length > 0;

                    if (anyChecked) {
                        $(".delete-btn").removeClass("d-none");
                    } else {
                        $(".delete-btn").addClass("d-none");
                    }
                }

                $(document).on("change", ".row-checkbox", function() {
                    var row = $(this).closest('tr'); // Get the closest <tr> element
                    if ($(this).prop('checked')) {
                        row.css('background-color', '#F1E9F0'); // Change background color
                    } else {
                        row.css('background-color', ''); // Reset background color
                    }
                    
                    $(this).closest("tr").toggleClass("selected", this.checked);
                    toggleDeleteButton();
                });


                $("#selectAll").on("change", function() {
                    let isChecked = this.checked;
                    $(".row-checkbox").prop("checked", isChecked).closest("tr").toggleClass("selected",
                        isChecked);
                    toggleDeleteButton();
                });

                // Ensure button state is set correctly on page load
                toggleDeleteButton();
            });
        </script>
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

                $(document).on('input change', '.no_of_exams, .duration', function() {
                    calculateTotalSectionValues();
                });
                $(document).on('change', "input[name='section']", section);
                $(document).on('click', ".save-exam", store);

                let currentPage = 1;
                let perPage = $('#rowsPerPage').val();
                fetchExams(currentPage, perPage);

                // Handle pagination clicks
                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    let page = $(this).data('page');
                    if (page) {
                        currentPage = page;
                        fetchExams(currentPage, perPage);
                    }
                });

                // Handle "Rows per page" change
                $('#rowsPerPage').change(function() {
                    perPage = $(this).val();
                    fetchExams(1, perPage);
                });

                $('.search_input, .multiselect').on('input click', function() {
                    fetchExams();
                });

                $(document).on('change', '.toggle-status', updateState);
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
                let totalExams = 0;
                let totalDuration = 0;

                $('.section_part').each(function(index) {
                    if ($(this).hasClass("d-none")) return;

                    const no_of_exams = parseInt($(this).find('input[name="no_of_questions"]').val()) || 0;
                    const duration = parseInt($(this).find('input[name="duration"]').val()) || 0;
                    console.log(no_of_exams, duration);

                    totalExams += no_of_exams;
                    totalDuration += duration;
                });

                // Update totals in the DOM
                $('#total_questions').val(totalExams);
                $('#total_duration').val(totalDuration);
            }

            const store = (e) => {
                 e.preventDefault();

                let formData = {
                    title: $('#title').val(),
                    audience: $('input[name="audience"]:checked').val(),
                    section: parseInt($('input[name="section"]:checked').val()),
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
                    error: function(error) {
                        console.log(error.responseJSON.errors);
                        
                        let errors = error.responseJSON.errors;
                        let errorMessage = "";

                        if (errors && typeof errors === 'object') {
                            errorMessage = Object.keys(errors)
                                .map(field => {
                                    return `${field.replace('_', ' ')}: ${errors[field].join(', ')}`;
                                })
                                .join('\n');
                        } else {
                            errorMessage = "An unexpected error occurred.";
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: errorMessage,
                            footer: 'Please correct the errors and try again.'
                        });

                        checkbox.prop('checked', !checkbox.is(':checked'));
                        
                        // Reset button text and enable it on error
                        submitButton.text('Save Question').prop('disabled', false);
                    }

                });
            }


            let searchTimeout;
            $('.search_input').on('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    fetchExams(1, $('#rowsPerPage').val());
                }, 300); // 300ms debounce
            });

            // Apply filters button click
            $('.apply-filter-btn').on('click', function() {
                fetchExams(1, $('#rowsPerPage').val());
            });

            // Reset filters button click
            $('.reset-filter-btn').on('click', function() {
                // Reset all filter inputs
                $('.search_input').val('');
                $('input[name="crated_start_at"]').val('');
                $('input[name="crated_end_at"]').val('');
                $('input[name="status"][value="All"]').prop('checked', true);
                $('.filter-group input:checkbox').prop('checked', false);
                $('.custom-checkbox input:checkbox').prop('checked', false);
                $('.multiselect').val([]).trigger('change');
                
                // Fetch with reset filters
                fetchExams(1, $('#rowsPerPage').val());
            });

            // get all exams
            function fetchExams(page = 1, perPage = 10) {
                let filters = {
                    search: $('.search_input').val() || '', // Search input value, default to empty string if undefined
                    difficulty: $('.difficulty:checked').map((_, el) => el.value).get(), // Get all checked difficulty levels
                    crated_start_at: $('input[name="crated_start_at"]').val() || '', // Start date, default to empty string
                    crated_end_at: $('input[name="crated_end_at"]').val() || '', // End date, default to empty string
                    status: $('input[name="status"]:checked').val() || 'All', // Selected status, default to 'All'
                    audience: $('#all_sat_type_1 .nested-options input:checked').map((_, el) => el.value).get(), // Checked SAT 1 options
                    sat_type: $('#all_sat_type_2 .nested-options input:checked').map((_, el) => el.value).get(), // Checked SAT 2 options
                    exam_appearance: $('.filter-group .nested-options input:checked').map((_, el) => el.value).get(), // Checked exam appearance options
                    created_by: $('.custom-checkbox .created_by:checked').map((_, el) => el.value).get(), // Checked created_by values
                    average_time: {
                        min: $('#min-range').val() || 1, // Minimum time from slider
                        max: $('#max-range').val() || 120 // Maximum time from slider
                    }
                };

                $.ajax({
                    url: "/api/exams?page=" + page + "&per_page=" + perPage,
                    type: "GET",
                    data: filters,
                    success: function(response) {
                        console.log(response);

                        if (response.data.length === 0) {
                            document.getElementById('examNullList').classList.remove('d-none');
                            document.getElementById('examList').classList.add('d-none');
                        } else {
                            document.getElementById('examNullList').classList.add('d-none');
                            document.getElementById('examList').classList.remove('d-none');

                            let rows = '';
                            $.each(response.data, function(index, exam) {
                                // let difficultyColor = getDifficultyColor(exam.difficulty);
                                let statusChecked = exam.status ? "checked" : "";

                                // <td><span class="badge badge-pill badge-hard">Hard</span><p class="text-center"><span>9/10</span>(70%)</p></td>
                                rows += `<tr>
                                    <td><input type="checkbox" class="row-checkbox  exam-row" value="${exam.uuid}"></td>
                                    <td class="openDetailModal text-left" data-toggle="modal" data-target="#detailModalCenter" >${exam.title || ''}</td>
                                    <td class="openDetailModal text-left" data-toggle="modal" data-target="#detailModalCenter" >${exam.sections[0].audience || ''}</td>
                                    <td class="openDetailModal text-left" data-toggle="modal" data-target="#detailModalCenter" >${exam.section || ''}</td>
                                    <td class="openDetailModal text-left" data-toggle="modal" data-target="#detailModalCenter" >${exam.sections[0].num_of_question}<p>${exam.duration}<span>min</span></p></td>
                                    <td class="openDetailModal text-left" data-toggle="modal" data-target="#detailModalCenter" >${exam.avg_time || '00:00'} min</td>
                                    <td class="openDetailModal text-left" data-toggle="modal" data-target="#detailModalCenter" >${exam.avg_time || '00:00'} min</td>
                                    <td class="openDetailModal text-left" data-toggle="modal" data-target="#detailModalCenter" >N/A</td>
                                    <td class="openDetailModal text-left" data-toggle="modal" data-target="#detailModalCenter" >${formatDate(exam.created_at)} ${exam?.created_by?.full_name || ''}</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-status" data-id="${exam.id}" ${exam.status === 'active' ? 'checked' : '' }>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <button data-toggle="modal" data-id="${exam.id}" data-target="#examModal" class="btn edit-btn"><i class="far fa-edit"></i>Edit</button>
                                    </td>
                                </tr>`;
                            });
                            $("#exam-table-body").html(rows);
                            updatePagination(response, page);
                        }
                    },
                    error: function() {
                        alert("Error fetching exams.");
                    }
                });
            }

            function formatDate(dateString) {
                let date = new Date(dateString);
                let options = { day: '2-digit', month: 'short', year: 'numeric' };
                return date.toLocaleDateString('en-GB', options); // "24 Mar 2025"
            }

            $(document).on("change", ".row-checkbox", function() {
                $(this).closest("tr").toggleClass("selected", this.checked);
                updateActiveInactiveCount();
            });

            $("#selectAll").on("change", function() {
                let isChecked = this.checked;
                $(".row-checkbox").prop("checked", isChecked).closest("tr").toggleClass("selected",
                    isChecked);
                updateActiveInactiveCount();
            });

            function updateActiveInactiveCount() {
                let selectedRows = $(".row-checkbox:checked").closest("tr");

                let activeCount = selectedRows.find(".toggle-status:checked").length;
                let inactiveCount = selectedRows.length - activeCount;

                // Update UI
                $("#active-count").text(activeCount);
                $("#inactive-count").text(inactiveCount);
            }

            function updatePagination(response, currentPage) {
                let totalResults = response.total;
                let perPage = response.per_page;
                let totalPages = response.last_page;
                let start = (response.from || 0);
                let end = (response.to || 0);

                $('#pagination-info').text(`Showing ${start}-${end} out of ${totalResults} results`);
                $('#total-exams').text(`${totalResults} Exams`);

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
                let examId = $(this).data('id');

                let newStatus = $(this).is(':checked') ? 'active' : 'inactive';

                $.ajax({
                    url: `/api/exams/${examId}/update-status`,
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

            function getSelectedExams() {
                return $(".row-checkbox:checked").map(function () {
                    return $(this).val();
                }).get();
            }

            $(".exam-delete").click(function () {
                let selectedExams = getSelectedExams();
                if (selectedExams.length === 0) {
                    Swal.fire("Warning", "Please select at least one exam.", "warning");
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
                            url: "/api/exam-delete",
                            type: "POST",
                            data: {
                                exams: selectedExams,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                Swal.fire("Deleted!", "Exams deleted successfully.", "success");
                                fetchExams(1);
                            },
                            error: function () {
                                Swal.fire("Error", "Failed to delete exams.", "error");
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
</x-backend.layouts.master>
