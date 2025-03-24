<x-backend.layouts.master>

    <x-backend.layouts.partials.blocks.contentwrapper 
        :headerTitle="'All Students'"
        :prependContent="'
            <a href=\'/students/create\' data-toggle=\'modal\' data-target=\'#studentCreateModelCenter\' class=\'btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Add Student
            </a>
        '">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div class="d-none" id="studentNullList">
        <x-backend.layouts.partials.blocks.empty-state 
        title="You haven't added any students yet." 
        message="Start building your student list."
        buttonText="Add Student"
        buttonRoute="#studentCreateModelCenter"
    />
    </div>



    <!-- Create Modal -->
    <div class="modal fade" id="studentCreateModelCenter" tabindex="-1" role="dialog" aria-labelledby="studentCreateModelCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content student-create-section" style="border-radius: 24px; height:100%">
                <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                    <h5 class="" id="exampleModalLongTitle"><b>Add Student</b></h5>
                    <p>Enter the necessary details to add a student</p>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Gender</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                        <label class="form-check-label" for="female">
                                        Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control" placeholder="">
                        </div>
                        <div class="col-md-6 mt-2">
                            <x-input-label for="password" :value="__('Password')" />
                            <div class="position-relative">
                                <x-text-input id="password" name="password" type="password"  class="form-control mt-1 block w-full pr-10" autocomplete="password" />
                                <span class="toggle-password" toggle="#password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <x-input-label for="confirm_password" :value="__('Confirm Password')" />
                            <div class="position-relative">
                                <x-text-input id="confirm_password" name="confirm_password" type="password"  class="form-control mt-1 block w-full pr-10" autocomplete="password" />
                                <span class="toggle-password" toggle="#confirm_password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Package</label>
                            <select name="package"  class="form-control">
                                <option value="">Please Select</option>
                                <option value="super-man">Super Man</option>
                                <option value="avenger">Avenger</option>
                                <option value="gladiator">Gladiator</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Duration</label>
                            <select name="duration"  class="form-control">
                                <option value="">Please Select</option>
                                <option value="monthly">Monthly</option>
                                <option value="annual">Annual</option>
                            </select>                        
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Audience</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="audience" id="high-school" value="high-school">
                                        <label class="form-check-label" for="high-school">
                                            High School
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="audience" id="college" value="college">
                                        <label class="form-check-label" for="college">
                                        College
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="audience" id="graduate" value="graduate">
                                        <label class="form-check-label" for="graduate">
                                            Graduate
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="audience" id="sat-2" value="sat-2">
                                        <label class="form-check-label" for="sat-2">
                                        SAt 2
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <x-input-label for="photo" :value="__('Photo')" />
                                    {{-- <form action="#" class="dropzone" id="dropzone_single"></form> --}}
                                    <div class="photosection" ondragover="allowDrop(event)" ondrop="dropImage(event)">
                                        <!-- Profile Image Preview -->
                                        <img id="previewImage" src="">
                                    
                                        <!-- Upload Area -->
                                        <label for="profileImage" style="cursor: pointer; position: relative;">
                                            <div class="upload-icon">
                                                <img src="{{ asset('image/icon/image-upload.png') }}" alt="Upload Icon" style="width: 16.67px; height: 15px;">
                                            </div>
                                            <h5 style="font-size: 14px;">
                                                <span style="color: #521749">Click to upload</span> 
                                                <span style="color: #475467"> or drag and drop</span>
                                            </h5>
                                        </label>
                                    
                                        <!-- Hidden File Input -->
                                        <input type="file" id="profileImage" name="profile_image" accept="image/*" style="display: none;" onchange="previewImage(event)">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn save-student" style="background-color:#691D5E ;border-radius: 8px; color:#fff">Add Student</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="studentEditModelCenter" tabindex="-1" role="dialog" aria-labelledby="studentEditModelCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content student-edit-section" style="border-radius: 24px; height:100%">
                <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                    <h5 class="" id="exampleModalLongTitle"><b>Edit Student</b></h5>
                    <p>Enter the necessary details to edit a student</p>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="student_uuid" id="student_uuid">
                        <div class="col-md-12 mt-2">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Gender</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="gender" value="male">
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="gender" value="female">
                                        <label class="form-check-label" for="female">
                                        Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control" placeholder="">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Package</label>
                            <select name="package"  class="form-control">
                                <option value="">Please Select</option>
                                <option value="super-man">Super Man</option>
                                <option value="avenger">Avenger</option>
                                <option value="gladiator">Gladiator</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Duration</label>
                            <select name="duration"  class="form-control">
                                <option value="">Please Select</option>
                                <option value="monthly">Monthly</option>
                                <option value="annual">Annual</option>
                            </select>                        
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Audience</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="audience" id="high-school" value="high-school">
                                        <label class="form-check-label" for="high-school">
                                            High School
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="audience" id="college" value="college">
                                        <label class="form-check-label" for="college">
                                        College
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="audience" id="graduate" value="graduate">
                                        <label class="form-check-label" for="graduate">
                                            Graduate
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="audience" id="sat-2" value="sat-2">
                                        <label class="form-check-label" for="sat-2">
                                        SAt 2
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <x-input-label for="photo" :value="__('Photo')" />
                                    {{-- <form action="#" class="dropzone" id="dropzone_single"></form> --}}
                                    <div class="editPhotosection" ondragover="editAllowDrop(event)" ondrop="editDropImage(event)">
                                        <!-- Profile Image Preview -->
                                        <img id="editPreviewImage" src="">
                                    
                                        <!-- Upload Area -->
                                        <label for="editProfileImage" style="cursor: pointer; position: relative;">
                                            <div class="upload-icon">
                                                <img src="{{ asset('image/icon/image-upload.png') }}" alt="Upload Icon" style="width: 16.67px; height: 15px;">
                                            </div>
                                            <h5 style="font-size: 14px;">
                                                <span style="color: #521749">Click to upload</span> 
                                                <span style="color: #475467"> or drag and drop</span>
                                            </h5>
                                        </label>
                                    
                                        <!-- Hidden File Input -->
                                        <input type="file" id="editProfileImage" name="profile_image" accept="image/*" style="display: none;" onchange="editPreviewImage(event)">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn update-student" style="background-color:#691D5E ;border-radius: 8px; color:#fff">Edit Student</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="messageModalCenter" tabindex="-1" role="dialog" aria-labelledby="messageModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 24px; height:100%">
                <div class="modal-header text-left" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                    <h5 class="modal-title">Send Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="notification_title">Notification Title</label>
                            <input type="text" id="notification_title" class="form-control" placeholder="Enter Title">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="description">Description</label>
                            <textarea id="description" cols="30" rows="5" class="form-control" placeholder="Enter a description"></textarea>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="date">Time Schedule</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" id="date" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <input type="time" id="time" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn student-send-notification" style="background-color:#691D5E ;border-radius: 8px; color:#fff">Send Notification</button>
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal fade" id="detailModalCenter" tabindex="-1" role="dialog" aria-labelledby="detailModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 60%">
            <div class="modal-content" style="border-radius: 24px; height:100%">
                <div class="modal-header text-left d-flex pb-3" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                    <h5 class="modal-title" id="exampleModalLongTitle">StudentID <span id="studentCode">#SID000</span></h5>
                    <button type="button" class="close p-0 m-0" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="student-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="true">Student</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="performance-tab" data-toggle="tab" href="#performance" role="tab" aria-controls="performance" aria-selected="false">Performance</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="wallet-tab" data-toggle="tab" href="#wallet" role="tab" aria-controls="wallet" aria-selected="true">Wallet</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="ratings-tab" data-toggle="tab" href="#ratings" role="tab" aria-controls="ratings" aria-selected="false">Ratings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="test-result-tab" data-toggle="tab" href="#test-result" role="tab" aria-controls="test-result" aria-selected="false">Test result</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="student" role="tabpanel" aria-labelledby="student-tab">
                                <div>
                                    <h4>Student Details</h4>
                                    <table class="table table-striped custom-table" style="border: 1px solid #EAECF0">
                                        <tr>
                                            <td style="width: 25%">Name</td>
                                            <td class="font-weight-bold" style="width: 25%" id="studentName">: </td>

                                            <td style="width: 25%">Date of Birth</td>
                                            <td class="font-weight-bold" style="width: 25%" id="studentDob">: </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 25%">Email</td>
                                            <td class="font-weight-bold" style="width: 25%" id="StudentEmail">: </td>

                                            <td style="width: 25%">Audience Type</td>
                                            <td class="font-weight-bold" style="width: 25%" id="studentAudience">: </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 25%">Gender</td>
                                            <td class="font-weight-bold" style="width: 25%" id="studentGender">: </td>

                                            <td style="width: 25%">Active Status</td>
                                            <td class="font-weight-bold" style="width: 25%" id="studentStatus">: </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 25%">Phone Number</td>
                                            <td class="font-weight-bold" style="width: 25%" id="studentPhone">: </td>

                                            <td style="width: 25%">-</td>
                                            <td class="font-weight-bold" style="width: 25%">: -</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="performance" role="tabpanel" aria-labelledby="performance-tab">
                                <div>
                                    <h4>Appearing Exams</h4>
                                    <table class="table datatable-basic" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info"  style="border: 1px solid #EAECF0">
                                        <thead>
                                            <tr class="bg-light" role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Notification: activate to sort column descending">Course</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Test/Section</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Score</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="custom-row">
                                                <td>Chemistry</td>
                                                <td>27-09-25</td>
                                                <td>Not found</td>
                                                <td>45.9</td>
                                                <td>100%</td>
                                            </tr>
                                            <tr class="custom-row">
                                                <td>Chemistry</td>
                                                <td>27-09-25</td>
                                                <td>Not found</td>
                                                <td>45.9</td>
                                                <td>100%</td>
                                            </tr>
                                            <tr class="custom-row">
                                                <td>Chemistry</td>
                                                <td>27-09-25</td>
                                                <td>Not found</td>
                                                <td>45.9</td>
                                                <td>100%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="wallet" role="tabpanel" aria-labelledby="wallet-tab">
                                <div class="d-flex justify-content-center align-items-center" style="background: #F5F5F5; width:100%; height:300px">
                                    <p><b>Waiting for content</b></p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="ratings" role="tabpanel" aria-labelledby="ratings-tab">
                                <div class="d-flex justify-content-center align-items-center" style="background: #F5F5F5; width:100%; height:300px">
                                    <p><b>Waiting for content</b></p>
                                </div>   
                            </div>
                            <div class="tab-pane fade" id="test-result" role="tabpanel" aria-labelledby="test-result-tab">
                                <div class="d-flex justify-content-center align-items-center" style="background: #F5F5F5; width:100%; height:300px">
                                    <p><b>Waiting for content</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end border-top pt-3">
                    {{-- <button type="button" class="btn" style="border: 1px solid #D0D5DD; border-radius: 8px;">Edit Student</button> --}}
                    <button type="button" class="btn btn-outline-dark" style="background-color:#691D5E ;border-radius: 8px; color:#fff"  data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="studentList">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
            <div class="card-header border-bottom d-flex justify-content-between">
                <div>
                    <input type="text" id="search" class="form-control search__input" placeholder="Search Notification" style="padding-left: 35px">
                </div>

                <div class="d-flex">
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
    
            <div class="card-body table-responsive">
                <table class="table datatable-basic" id="studentsTable" role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead>
                        <tr>
                            <th colspan="10">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-0 p-0"><b><span id="totalStudent">1</span> Student</b></h5>
                                    </div>
                                    <div class="delete-btn d-none">
                                        <button class="btn"><img src="{{ asset('image/icon/disable.png') }}" alt=""></button>
                                        <button class="btn student-excel-download"><img src="{{ asset('image/icon/download.png') }}" alt=""></button>
                                        <button class="btn text-danger student-delete"><i class="fas fa-trash-alt"></i></button>


                                        <button class="btn text-warning student-deactive">Inactive</button>
                                        <button class="btn send-notification-btn" data-toggle="modal" data-target="#messageModalCenter" style="background-color:#691D5E ;border-radius: 8px; color:#fff"><img src="{{ asset('image/icon/message.png') }}" alt=""> <span class="ml-2">Send Notification</span></button>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr class="bg-light">
                            <th><input type="checkbox" id="selectAll"></th>
                            <th>Student</th>
                            <th>Phone No.</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Audience</th>
                            <th>Package</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="studentsBody">
                        <!-- AJAX Loaded Content -->
                    </tbody>
                </table>
                <!-- Empty State -->
                <div id="emptyState" class="text-center d-none">
                    <p class="mt-3">No student found.</p>
                </div>
                <div>
                    <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                        <form method="GET" class="d-flex align-items-center">
                            <label for="per_page" class="fs-13 fw-medium mr-2 mt-1">Showing:</label>
                            <select name="per_page" id="per_page" class="form-select form-select-sm w-auto mr-2" onchange="fetchStudents(1)" style="border:1px solid #D0D5DD; padding:5px">
                                @foreach([5, 10, 20, 50, 100] as $size)
                                    <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                        {{ $size }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    
                        <div class="d-flex align-items-center">
                            <span class="fs-13 fw-medium me-2" id="paginationInfo">
                                <!-- Pagination info will be dynamically updated here -->
                            </span>
                            <div id="pagination">
                                <!-- Pagination buttons will be dynamically updated here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
    
                
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
                <button type="button" class="close-btn" id="closeSidebar">&times;</button>
            </div>
            <div class="sidebar-content">
                <div class="task-form">
                    <form class="form-section filter-form-section">
                        <div class="p-3">
                            <div class="d-flex justify-content-between">
                                <p style="font-size: 12px"> <span style="color: #344054"><b>Created on:</b></span> <span style="color: #475467">06 Jan 25 - 12 Jan 25</span></p>
                                <button class="btn p-0 m-0"><u>Reset</u></button>
                            </div>
                            <div class="mt-1 mb-2 d-flex justify-content-between">
                                <div style="width: 49%">
                                    <input type="date" class="form-control" name="create_from">
                                </div>
                                <div style="align-items: center; display: flex; width:1%">
                                    -
                                </div>
                                <div style="width: 49%">
                                    <input type="date" class="form-control" name="create_to">
                                </div>
                            </div>
                            <div>
                                <h6><b>Status:</b> All Result</h6>
                                <div class="form-check status-radio">
                                    <input class="form-check-input" type="radio" name="status" id="all" value="all" checked>
                                    <label class="form-check-label" for="all">
                                      All
                                    </label>
                                  </div>
                                  <div class="form-check status-radio">
                                    <input class="form-check-input" type="radio" name="status" id="activeonly" value="active">
                                    <label class="form-check-label" for="activeonly">
                                        Active only
                                    </label>
                                  </div>
                                  <div class="form-check status-radio">
                                    <input class="form-check-input" type="radio" name="status" id="inactiveonly" value="inactive">
                                    <label class="form-check-label" for="inactiveonly">
                                        Inactive only
                                    </label>
                                  </div>
                            </div>
                            <div class="mt-2">
                                <h6><b>Audience & Type:</b> All Result</h6>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" name="audience_type" id="All-SAT-1" value="sate-1">
                                    <label class="form-check-label" for="All-SAT-1">All SAT 1</label>
                                </div>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" name="audience_type" id="All-SAT-2" value="sate-2">
                                    <label class="form-check-label" for="All-SAT-2">All SAT 2</label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h6><b>Package Type:</b> All Result</h6>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="super-man" name="package">
                                    <label class="form-check-label" for="super-man"><span class="badge badge-flat badge-pill" style="border: 1px solid #3E4784; color:#3E4784"><b>Super man</b></span></label>
                                </div>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="avenger"  name="package">
                                    <label class="form-check-label" for="avenger"><span class="badge badge-flat badge-pill" style="border: 1px solid #D9D6FE; color:#5925DC; background-color:#F4F3FF"><b>Avenger</b></span></label>
                                </div>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="gladiator"  name="package">
                                    <label class="form-check-label" for="gladiator"><span class="badge badge-flat badge-pill" style="border: 1px solid #B2DDFF; color:#175CD3; background-color:#EFF8FF"><b>Gladiator</b></span></label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h6><b>Package Duration:</b> All Result</h6>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="monthly" name="duration">
                                    <label class="form-check-label" for="monthly">Monthly</label>
                                </div>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="annual"  name="duration">
                                    <label class="form-check-label" for="annual">Annual</label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h6><b>Gender:</b> All Result</h6>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="male" name="gender">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="female" name="gender">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>

                        <div class="border-top fixed-bottom-buttons">
                            <div class="d-flex justify-content-between p-3">
                                <button type="button" class="btn filter-submit-btn" style="background-color:#691D5E ;border-radius: 8px; color:#fff; width:50%">Apply Filters</button>
                                <button type="button" class="btn btn-outline-dark ml-2 reset-filter" style="border: 1px solid #D0D5DD; border-radius: 8px; width:50%">Reset All</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('css')
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

            .editPhotosection {
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
    	<!-- Theme JS files -->
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/uploaders/dropzone.min.js"></script>
	    <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/uploader_dropzone.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/switch.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/datatables_basic.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_multiselect.js"></script>
        <!-- /theme JS files -->

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".toggle-password").forEach(function(element) {
                    element.addEventListener("click", function() {
                        let input = document.querySelector(this.getAttribute("toggle"));
                        let icon = this.querySelector("i");
            
                        if (input.type === "password") {
                            input.type = "text";
                            icon.classList.remove("fa-eye");
                            icon.classList.add("fa-eye-slash");
                        } else {
                            input.type = "password";
                            icon.classList.remove("fa-eye-slash");
                            icon.classList.add("fa-eye");
                        }
                    });
                });
            });

            function toggleDeleteButton() {
                
                
                let anyChecked = document.querySelectorAll(".row-checkbox:checked").length > 0;
                document.querySelector(".delete-btn").classList.toggle("d-none", !anyChecked);
            }

            document.querySelectorAll(".row-checkbox").forEach(checkbox => {
                
                checkbox.addEventListener("change", function() {
                    this.closest("tr").classList.toggle("selected", this.checked);
                    toggleDeleteButton();
                });
            });

            document.getElementById("selectAll").addEventListener("change", function() {
                let isChecked = this.checked;
                document.querySelectorAll(".row-checkbox").forEach(checkbox => {
                    checkbox.checked = isChecked;
                    checkbox.closest("tr").classList.toggle("selected", isChecked);
                });
                toggleDeleteButton();
            });

            // Initial check on page load
            toggleDeleteButton();
        </script>

        <!-- /Photo, Filter -->
        <script>
            $(document).ready(function () {

                $(".custom-radio").click(function() {
                    $(this).find("input[type='radio']").prop("checked", true);
                });

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

            // Allow drop
            function allowDrop(event) {
                event.preventDefault();
                document.querySelector('.photosection').classList.add('dragover');
            }

            // Remove dragover style on leave
            document.querySelector('.photosection').addEventListener('dragleave', function () {
                this.classList.remove('dragover');
            });

            // Handle dropped image
            function dropImage(event) {
                event.preventDefault();
                document.querySelector('.photosection').classList.remove('dragover');
                const file = event.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    previewFile(file);
                }
            }

            // Handle click upload
            function previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    previewFile(file);
                }
            }

            // Preview image
            function previewFile(file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    console.log('in');
                    
                    const preview = document.getElementById('previewImage');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }

            //edit
            // Allow drop
            function editAllowDrop(event) {
                event.preventDefault();
                
                document.querySelector('.editPhotosection').classList.add('dragover');
            }

            // Remove dragover style on leave
            document.querySelector('.editPhotosection').addEventListener('dragleave', function () {
                this.classList.remove('dragover');
            });

            // Handle dropped image
            function editDropImage(event) {
                event.preventDefault();
                document.querySelector('.editPhotosection').classList.remove('dragover');
                const file = event.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    editPreviewFile(file);
                }
            }

            // Handle click upload
            function editPreviewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    editPreviewFile(file);
                }
            }

            // Preview image
            function editPreviewFile(file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('editPreviewImage');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        </script>

        <!-- /Fetch Data -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                fetchStudents(1); // Initial Load

                // Search on Enter key
                document.getElementById('search').addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') fetchStudents(1);
                });

                // Per page change
                document.getElementById('per_page').addEventListener('change', () => fetchStudents(1));

                // Apply filters on form submit
                document.querySelector('.filter-submit-btn').addEventListener('click', () => fetchStudents(1));

                // Reset filters
                
                document.querySelector('.reset-filter').addEventListener('click', () => {
                    document.querySelector('input[name="create_from"]').value = '';
                    document.querySelector('input[name="create_to"]').value = '';
                    document.querySelector('input[name="status"][value="all"]').checked = true;
                    document.querySelectorAll('input[name="audience_type"]').forEach(el => el.checked = false);
                    document.querySelectorAll('input[name="package"]').forEach(el => el.checked = false);
                    document.querySelectorAll('input[name="duration"]').forEach(el => el.checked = false);
                    document.querySelectorAll('input[name="gender"]').forEach(el => el.checked = false);
                    fetchStudents(1);
                });
            });

            function fetchStudents(page = 1) {
                const search = document.getElementById('search').value;
                const perPage = document.getElementById('per_page').value;

                // Get filter values from the form
                const createFrom = document.querySelector('input[name="create_from"]').value;
                const createTo = document.querySelector('input[name="create_to"]').value;
                const status = document.querySelector('input[name="status"]:checked').value;
                const audienceType = Array.from(document.querySelectorAll('input[name="audience_type"]:checked')).map(el => el.id);
                const package = Array.from(document.querySelectorAll('input[name="package"]:checked')).map(el => el.id);
                const duration = Array.from(document.querySelectorAll('input[name="duration"]:checked')).map(el => el.id);
                const gender = Array.from(document.querySelectorAll('input[name="gender"]:checked')).map(el => el.id);

                // Construct the URL with filter parameters
                const url = `/api/students?search=${search}&per_page=${perPage}&page=${page}` +
                    `&create_from=${createFrom}&create_to=${createTo}` +
                    `&status=${status}` +
                    `&audience_type=${audienceType.join(',')}` +
                    `&package=${package.join(',')}` +
                    `&duration=${duration.join(',')}` +
                    `&gender=${gender.join(',')}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.getElementById('studentsBody');
                        tbody.innerHTML = '';
                        console.log(data);
                        

                        if (data.students.data.length === 0) {
                            document.getElementById('studentNullList').classList.remove('d-none');
                            document.getElementById('studentList').classList.add('d-none');
                            document.getElementById('emptyState').classList.remove('d-none');
                            document.getElementById('studentsTable').classList.add('d-none');
                            document.getElementById('pagination').classList.add('d-none');
                        } else {
                            document.getElementById('emptyState').classList.add('d-none');
                            document.getElementById('studentsTable').classList.remove('d-none');
                            document.getElementById('pagination').classList.remove('d-none');
                            document.getElementById('studentNullList').classList.add('d-none');
                            document.getElementById('studentList').classList.remove('d-none');

                            $('#totalStudent').text(data.totalStudent);

                            data.students.data.forEach(student => {
                                const firstWord = student.name.trim().split(/\s+/)[0];
                                const firstLetter = firstWord.replace(/\W/g, '').charAt(0);
                                
                                tbody.innerHTML += `
                                    <tr>
                                        <td><input type="checkbox" class="row-checkbox student-row" value="${student.uuid}"></td>
                                        <td class="openDetailModal" data-uuid="${student.uuid}" data-toggle="modal" data-target="#detailModalCenter">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <a href="#" class="btn rounded-round btn-icon btn-sm" style="border: 1px solid #ddd;">
                                                        <img src="${student.photo_url}" alt="${firstLetter}" class="rounded-circle" width="40" height="40">
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="#" class="text-default font-weight-semibold letter-icon-title">${student.name}</a>
                                                    <div class="text-muted font-size-sm">${student.email}</div>
                                                </div>
                                            </div>  
                                        </td>
                                        <td class="openDetailModal" data-uuid="${student.uuid}" data-toggle="modal" data-target="#detailModalCenter">${student.phone}</td>
                                        <td class="openDetailModal" data-uuid="${student.uuid}" data-toggle="modal" data-target="#detailModalCenter">${student.date_of_birth}</td>
                                        <td class="text-capitalize openDetailModal" data-uuid="${student.uuid}" data-toggle="modal" data-target="#detailModalCenter">${student.gender}</td>
                                        <td class="text-capitalize openDetailModal" data-uuid="${student.uuid}" data-toggle="modal" data-target="#detailModalCenter">${student.audience}</td>
                                        <td class="text-capitalize openDetailModal" data-uuid="${student.uuid}" data-toggle="modal" data-target="#detailModalCenter">
                                            <span class="badge badge-flat badge-pill" style="border: 1px solid #3E4784; color:#3E4784"><b>${student.package}</b></span>
                                        </td>
                                        <td class="text-capitalize openDetailModal" data-uuid="${student.uuid}" data-toggle="modal" data-target="#detailModalCenter">${student.duration}</td>
                                        <td>${student.status_switch}</td>
                                        <td class="text-center">
                                            <button data-uuid="${student.uuid}" class="btn btn-sm edit-student-btn"  data-toggle="modal" data-target="#studentEditModelCenter">
                                                <i class="far fa-edit"></i> Edit
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            });

                            // Update Pagination Info
                            document.getElementById('paginationInfo').innerHTML = `
                                ${data.students.from} - ${data.students.to} of ${data.students.total}
                            `;

                            // Render Pagination Buttons
                            renderPagination(data.students);
                            document.querySelectorAll(".row-checkbox").forEach(checkbox => {
                                checkbox.addEventListener("change", function() {
                                    this.closest("tr").classList.toggle("selected", this.checked);
                                    toggleDeleteButton();
                                });
                            });

                            document.getElementById("selectAll").addEventListener("change", function() {
                                let isChecked = this.checked;
                                document.querySelectorAll(".row-checkbox").forEach(checkbox => {
                                    checkbox.checked = isChecked;
                                    checkbox.closest("tr").classList.toggle("selected", isChecked);
                                });
                                toggleDeleteButton();
                            });
                        }
                    });
            }

            function renderPagination(data) {
                const pagination = document.getElementById('pagination');
                pagination.innerHTML = '';

                if (data.last_page > 1) {
                    for (let i = 1; i <= data.last_page; i++) {
                        pagination.innerHTML += `
                            <button class="btn btn-sm ${i === data.current_page ? 'btn-primary' : 'btn-light'}" onclick="fetchStudents(${i})">${i}</button>
                        `;
                    }
                }
            }
        </script>

        <!-- /Craete, Edit, Update -->
        <script>
            function formatDate(dateString) {
                const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                const date = new Date(dateString);
                
                let day = date.getDate().toString().padStart(2, "0"); // 22
                let month = months[date.getMonth()]; // Jan
                let year = date.getFullYear().toString().slice(-2); // 24

                return `${day}-${month}-${year}`;
            }
            $(document).ready(function () {
                $(document).on('click', '.save-student', function () {
                    let $button = $(this);
                    $button.prop('disabled', true).html('Processing...');
        
                    let formData = new FormData();
        
                    // Collect form data
                    const name = $('.student-create-section').find('input[name="name"]').val();
                    const email = $('.student-create-section').find('input[name="email"]').val();
                    const phone = $('.student-create-section').find('input[name="phone"]').val();
                    const gender = $('.student-create-section').find('input[name="gender"]:checked').val();
                    const dob = $('.student-create-section').find('input[name="date_of_birth"]').val();
                    const package = $('.student-create-section').find('select[name="package"]').val();
                    const duration = $('.student-create-section').find('select[name="duration"]').val();
                    const password = $('.student-create-section').find('input[name="password"]').val();
                    const confirmPassword = $('.student-create-section').find('input[name="confirm_password"]').val();
                    const audience = $('.student-create-section').find('input[name="audience"]:checked').val();
                    const photo = $('.student-create-section').find('#profileImage')[0].files ? $('#profileImage')[0].files[0] : null;
        
                    // Validate required fields
                    if (!name || !email || !phone || !gender || !dob || !password || !confirmPassword || !audience || !package || !duration) {
                        let missingFields = [];
        
                        if (!name) missingFields.push('Name');
                        if (!email) missingFields.push('Email');
                        if (!phone) missingFields.push('Phone');
                        if (!gender) missingFields.push('Gender');
                        if (!package) missingFields.push('Package');
                        if (!duration) missingFields.push('Duration');
                        if (!dob) missingFields.push('Date of Birth');
                        if (!password) missingFields.push('Password');
                        if (!confirmPassword) missingFields.push('Confirm Password');
                        if (!audience) missingFields.push('Audience');
        
                        Swal.fire({
                            icon: 'warning',
                            title: 'Missing Fields',
                            html: 'Please fill in the following fields:<br><strong>' + missingFields.join(', ') + '</strong>',
                        });
                        $button.prop('disabled', false).html('Save'); // Re-enable button
                        return;
                    }
        
                    // Validate password match
                    if (password !== confirmPassword) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Password Mismatch',
                            text: 'Password and Confirm Password do not match.',
                        });
                        $button.prop('disabled', false).html('Save'); // Re-enable button
                        return;
                    }
        
                    // Append data to FormData
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // CSRF token
                    formData.append('name', name);
                    formData.append('email', email);
                    formData.append('phone', phone);
                    formData.append('gender', gender);
                    formData.append('date_of_birth', dob);
                    formData.append('password', password);
                    formData.append('password_confirmation', confirmPassword);
                    formData.append('audience', audience);
                    formData.append('package', package);
                    formData.append('duration', duration);
        
                    if (photo) {
                        formData.append('photo', photo);
                    }
        
                    // AJAX Request
                    $.ajax({
                        url: '/api/students',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Student Added',
                                    text: response.message,
                                }).then(() => {
                                    $('#studentCreateModelCenter').modal('hide');
                                    fetchStudents(1);

                                    $('#studentCreateModelCenter').find('input[name="name"], input[name="email"], input[name="password"], input[name="confirm_password"], input[name="phone"],input[name="date_of_birth"], select[name="package"], select[name="duration"]').val('');
                                    $('#profileImage').val('');

                                    $('#studentCreateModelCenter').find('input[name="gender"], input[name="audience"]').prop('checked', false);

                                    $('#studentCreateModelCenter').find('select').each(function () {
                                        $(this).prop('selectedIndex', 0);
                                    });

                                    $('#previewImage').attr('src', '');
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.error || 'Something went wrong!',
                                });
                            }
                        },
                        error: function (xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                let errorMsg = '';
                                $.each(errors, function (key, value) {
                                    errorMsg += value[0] + '<br>';
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validation Error',
                                    html: errorMsg,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Unexpected Error',
                                    text: 'An unexpected error occurred. Please try again.',
                                });
                            }
                        },
                        complete: function () {
                            $button.prop('disabled', false).html('Save'); // Re-enable button after request completes
                        }
                    });
                });

                $(document).on('click', '.edit-student-btn', function () {
                    let uuid = $(this).data("uuid");
        
                    $.ajax({
                        url: "/api/students/" + uuid,  // Adjust the route as per your Laravel API
                        type: "GET",
                        success: function (response) {
                            // Populate modal fields with fetched data
                            $('.student-edit-section').find("input[name='student_uuid']").val(response.data.uuid);
                            $('.student-edit-section').find("input[name='name']").val(response.data.name);
                            $('.student-edit-section').find("input[name='email']").val(response.data.email);
                            $('.student-edit-section').find("input[name='phone']").val(response.data.phone);
                            $('.student-edit-section').find("input[name='date_of_birth']").val(response.data.date_of_birth);
                            
                            // Set gender radio button
                            $('.student-edit-section').find("input[name='gender'][value='" + response.data.gender + "']").prop("checked", true);
                            
                            // Set audience radio button
                            $('.student-edit-section').find("input[name='audience'][value='" + response.data.audience + "']").prop("checked", true);
        
                            // Set package and duration dropdowns
                            $('.student-edit-section').find("select[name='package']").val(response.data.package);
                            $('.student-edit-section').find("select[name='duration']").val(response.data.duration);
        
                            // Profile Image Preview
                            if (response.data.profile_image) {
                                $('.student-edit-section').find("#editPreviewImage").attr("src", response.data.profile_image);
                            }
                        },
                        error: function () {
                            alert("Failed to fetch student details!");
                        }
                    });
                });

                $(document).on('click', '.update-student', function () {
                    let $button = $(this);
                    $button.prop('disabled', true).html('Processing...');
        
                    let formData = new FormData();
        
                    // Collect form data
                    
                    const student_uuid = $('.student-edit-section').find('input[name="student_uuid"]').val();
                    const name = $('.student-edit-section').find('input[name="name"]').val();
                    const email = $('.student-edit-section').find('input[name="email"]').val();
                    const phone = $('.student-edit-section').find('input[name="phone"]').val();
                    const gender = $('.student-edit-section').find('input[name="gender"]:checked').val();
                    const dob = $('.student-edit-section').find('input[name="date_of_birth"]').val();
                    const package = $('.student-edit-section').find('select[name="package"]').val();
                    const duration = $('.student-edit-section').find('select[name="duration"]').val();
                    const audience = $('.student-edit-section').find('input[name="audience"]:checked').val();
                    const photo = $('#editProfileImage')[0].files ? $('#editProfileImage')[0].files[0] : null;
        
                    // Validate required fields
                    if (!name || !email || !phone || !gender || !dob || !audience || !package || !duration) {
                        let missingFields = [];
        
                        if (!name) missingFields.push('Name');
                        if (!email) missingFields.push('Email');
                        if (!phone) missingFields.push('Phone');
                        if (!gender) missingFields.push('Gender');
                        if (!package) missingFields.push('Package');
                        if (!duration) missingFields.push('Duration');
                        if (!dob) missingFields.push('Date of Birth');
                        if (!audience) missingFields.push('Audience');
        
                        Swal.fire({
                            icon: 'warning',
                            title: 'Missing Fields',
                            html: 'Please fill in the following fields:<br><strong>' + missingFields.join(', ') + '</strong>',
                        });
                        $button.prop('disabled', false).html('Save'); // Re-enable button
                        return;
                    }
        
                    // Append data to FormData
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // CSRF token
                    formData.append('name', name);
                    formData.append('email', email);
                    formData.append('phone', phone);
                    formData.append('gender', gender);
                    formData.append('date_of_birth', dob);
                    formData.append('audience', audience);
                    formData.append('package', package);
                    formData.append('duration', duration);
        
                    if (photo) {
                        formData.append('photo', photo);
                    }
        
                    // AJAX Request
                    $.ajax({
                        url: `/api/students/${student_uuid}/update`,
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Student Update',
                                    text: response.message,
                                }).then(() => {
                                    $('#studentEditModelCenter').modal('hide');
                                    fetchStudents(1);

                                    $('#studentEditModelCenter').find('input[name="name"], input[name="email"], input[name="password"], input[name="confirm_password"], input[name="phone"],input[name="date_of_birth"], select[name="package"], select[name="duration"]').val('');
                                    $('#editProfileImage').val('');

                                    $('#studentEditModelCenter').find('input[name="gender"], input[name="audience"]').prop('checked', false);

                                    $('#studentEditModelCenter').find('select').each(function () {
                                        $(this).prop('selectedIndex', 0);
                                    });

                                    $('#editPreviewImage').attr('src', '');
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.error || 'Something went wrong!',
                                });
                            }
                        },
                        error: function (xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                let errorMsg = '';
                                $.each(errors, function (key, value) {
                                    errorMsg += value[0] + '<br>';
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validation Error',
                                    html: errorMsg,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Unexpected Error',
                                    text: 'An unexpected error occurred. Please try again.',
                                });
                            }
                        },
                        complete: function () {
                            $button.prop('disabled', false).html('Save'); // Re-enable button after request completes
                        }
                    });
                });

                $(document).on("click", ".openDetailModal", function () {
                    var studentUuid = $(this).data("uuid"); // Button er data-id theke Student ID pabo

                    $.ajax({
                        url: `/api/students/${studentUuid}`, // Backend route jekhane data fetch hobe
                        type: "GET",
                        success: function (response) {
                            // Modal er ID update
                            $("#studentCode").text("#" + response.data.student_code);

                            // Student details update
                            $("#studentName").text(": " + response.data.name);
                            $("#studentDob").text(": " + formatDate(response.data.date_of_birth));
                            $("#StudentEmail").text(": " + response.data.email);
                            $("#studentAudience").text(": " + response.data.audience);
                            $("#studentGender").text(": " + response.data.gender);
                            $("#studentStatus").text(": " + response.data.status);
                            $("#studentPhone").text(": " + response.data.phone);

                            // Performance table update (Example)
                            // var performanceTable = "";
                            // response.performance.forEach(function (exam) {
                            //     performanceTable += `
                            //         <tr class="custom-row">
                            //             <td>${exam.course}</td>
                            //             <td>${exam.date}</td>
                            //             <td>${exam.section || "Not found"}</td>
                            //             <td>${exam.score}</td>
                            //             <td>${exam.percentage}%</td>
                            //         </tr>`;
                            // });
                            // $("#DataTables_Table_0 tbody").html(performanceTable);

                            // Modal show
                            $("#detailModalCenter").modal("show");
                        },
                        error: function () {
                            alert("Failed to fetch student details.");
                        },
                    });
                });

            });
        </script>

        <!-- /Delete Notification Status Deactive -->
        <script>
            $(document).ready(function () {
                function getSelectedStudents() {
                    return $(".row-checkbox:checked").map(function () {
                        return $(this).val();
                    }).get();
                }

                function toggleActionButtons() {
                    let selectedStudents = getSelectedStudents();
                    if (selectedStudents.length > 0) {
                        $(".delete-btn").removeClass("d-none");
                    } else {
                        $(".delete-btn").addClass("d-none");
                    }
                }

                // Checkbox selection logic
                $(document).on("change", ".row-checkbox, #selectAll", function () {
                    toggleActionButtons();
                });

                // Download Excel
                $(".student-excel-download").click(function () {
                    let selectedStudents = getSelectedStudents();
                    if (selectedStudents.length === 0) {
                        Swal.fire("Warning", "Please select at least one student.", "warning");
                        return;
                    }

                    let url = `/api/students/export/${selectedStudents.join(",")}`;
                    window.location.href = url;
                });

                // Delete Students
                $(".student-delete").click(function () {
                    let selectedStudents = getSelectedStudents();
                    if (selectedStudents.length === 0) {
                        Swal.fire("Warning", "Please select at least one student.", "warning");
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
                                url: "/api/students-delete",
                                type: "POST",
                                data: {
                                    students: selectedStudents,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function (response) {
                                    Swal.fire("Deleted!", "Students deleted successfully.", "success");
                                    fetchStudents(1);
                                },
                                error: function () {
                                    Swal.fire("Error", "Failed to delete students.", "error");
                                }
                            });
                        }
                    });
                });

                // Deactivate Students
                $(".student-deactive").click(function () {
                    let selectedStudents = getSelectedStudents();
                    if (selectedStudents.length === 0) {
                        Swal.fire("Warning", "Please select at least one student.", "warning");
                        return;
                    }

                    $.ajax({
                        url: "/api/students/deactivate",
                        type: "POST",
                        data: {
                            students: selectedStudents,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            Swal.fire("Success", "Students deactivated successfully.", "success");
                            fetchStudents(1);
                        },
                        error: function () {
                            Swal.fire("Error", "Failed to deactivate students.", "error");
                        }
                    });
                });

                // Send Notification
                $(".student-send-notification").click(function () {
                    let selectedStudents = getSelectedStudents();
                    let title = $("#notification_title").val().trim();
                    let description = $("#description").val().trim();
                    let date = $("#date").val();
                    let time = $("#time").val();

                    if (selectedStudents.length === 0) {
                        Swal.fire("Warning", "Please select at least one student.", "warning");
                        return;
                    }

                    if (!title || !description || !date || !time) {
                        Swal.fire("Warning", "All fields are required.", "warning");
                        return;
                    }

                    $.ajax({
                        url: "/api/students/send-notification",
                        type: "POST",
                        data: {
                            students: selectedStudents,
                            title: title,
                            description: description,
                            date: date,
                            time: time,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            Swal.fire("Success", "Notification sent successfully.", "success");
                            $("#messageModalCenter").modal("hide");
                            $("#notification_title").val("");
                            $("#description").val("");
                            $("#date").val("");
                            $("#time").val("");
                            $(".row-checkbox").prop("checked", false);
                        },
                        error: function () {
                            Swal.fire("Error", "Failed to send notification.", "error");
                        }
                    });
                });

                $(document).on('change', '.status-switch', function() {
                    let checkbox = $(this);
                    let status = checkbox.is(':checked') ? 'active' : 'inactive';
                    let studentUuid = checkbox.closest('tr').find('.student-row').val();
                    
                    $.ajax({
                        url: '/api/students/update-status',
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            uuid: studentUuid,
                            status: status
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
                });

            });
        </script>

        <script>
            (function($){
                $(document).ready(()=>{
                    $(document).change(function(event){
                        let
                            el = event.target,
                            sectionRow = $(el).closest('.section-row');

                            if($(el).is(":checked")){
                                $(sectionRow).find('.value-of-checkbox').val(1);
                            }else{
                                $(sectionRow).find('.value-of-checkbox').val(0);
                            }
                    });
                    
                });
            })(jQuery)
        </script>
       
    @endpush
</x-backend.layouts.master>