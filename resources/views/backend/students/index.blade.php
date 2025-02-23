<x-backend.layouts.master>

    <x-backend.layouts.partials.blocks.contentwrapper 
        :headerTitle="'All Students'"
        :prependContent="'
            <a href=\'/students/create\' data-toggle=\'modal\' data-target=\'#exampleModalCenter\' class=\'btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Add Student
            </a>
        '">
    </x-backend.layouts.partials.blocks.contentwrapper>

    {{-- <x-backend.layouts.partials.blocks.empty-state 
        title="You haven't added any students yet." 
        message="Start building your student list."
        buttonText="Add Student"
        buttonRoute="/students/create"
    /> --}}

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border-radius: 24px; height:100%">
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
                                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                                            <label class="form-check-label" for="male">
                                                Male
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check custom-radio">
                                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
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
                            <div class="col-md-12 mt-2">
                                <label for="">Audience</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check custom-radio">
                                            <input class="form-check-input" type="radio" name="audience" id="high-school" value="High School">
                                            <label class="form-check-label" for="high-school">
                                                High School
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check custom-radio">
                                            <input class="form-check-input" type="radio" name="audience" id="college" value="College">
                                            <label class="form-check-label" for="college">
                                            College
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check custom-radio">
                                            <input class="form-check-input" type="radio" name="audience" id="graduate" value="Graduate">
                                            <label class="form-check-label" for="graduate">
                                                Graduate
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check custom-radio">
                                            <input class="form-check-input" type="radio" name="audience" id="sat-2" value="SAt 2">
                                            <label class="form-check-label" for="sat-2">
                                            SAt 2
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <x-input-label for="photo" :value="__('Photo')" />
                                        <form action="#" class="dropzone" id="dropzone_single"></form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-3">
                        <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn" style="background-color:#691D5E ;border-radius: 8px; color:#fff">Add Student</button>
                    </div>
                </div>
            </div>
    </div>

    <div class="modal fade" id="messageModalCenter" tabindex="-1" role="dialog" aria-labelledby="messageModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 24px; height:100%">
                <div class="modal-header text-left" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                    <h5 class="modal-title" id="exampleModalLongTitle">Send Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="">Notification Title</label>
                            <input type="text" name="notification_title" class="form-control" placeholder="Enter Title">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Description</label>
                            <textarea name="description" id="" cols="30" rows="5" class="form-control" placeholder="Enter a description"></textarea>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Time schedule</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" name="date" class="form-control" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <input type="time" name="time" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top pt-3">
                    <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn" style="background-color:#691D5E ;border-radius: 8px; color:#fff">Send Notification</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailModalCenter" tabindex="-1" role="dialog" aria-labelledby="detailModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 24px; height:100%">
                <div class="modal-header text-left" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                    <h5 class="modal-title" id="exampleModalLongTitle">StudentID <span>#SID6386</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="question-tab" data-toggle="tab" href="#question" role="tab" aria-controls="question" aria-selected="true">Question</a>
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
                            <div class="tab-pane fade show active" id="question" role="tabpanel" aria-labelledby="question-tab">
                                <div>
                                    <h4>Student Details</h4>
                                    <table class="table table-striped custom-table" style="border: 1px solid #EAECF0">
                                        <tr>
                                            <td style="width: 25%">Name</td>
                                            <td class="font-weight-bold" style="width: 25%">: Addul Hakim</td>

                                            <td style="width: 25%">Date of Birth</td>
                                            <td class="font-weight-bold" style="width: 25%">: 22-Jan-24</td>
                                        </tr>

                                        <tr>
                                            <td style="width: 25%">Email</td>
                                            <td class="font-weight-bold" style="width: 25%">: a.hakim@email.com</td>

                                            <td style="width: 25%">Audience Type</td>
                                            <td class="font-weight-bold" style="width: 25%">: Hi School</td>
                                        </tr>

                                        <tr>
                                            <td style="width: 25%">Gender</td>
                                            <td class="font-weight-bold" style="width: 25%">: Male</td>

                                            <td style="width: 25%">Active Status</td>
                                            <td class="font-weight-bold" style="width: 25%">: Active</td>
                                        </tr>

                                        <tr>
                                            <td style="width: 25%">Phone Number</td>
                                            <td class="font-weight-bold" style="width: 25%">: +96657647535</td>

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
                <div class="modal-footer d-flex justify-content-between border-top pt-3">
                    <button type="button" class="btn" style="border: 1px solid #D0D5DD; border-radius: 8px;">Edit Student</button>
                    <button type="button" class="btn btn-outline-dark" style="background-color:#691D5E ;border-radius: 8px; color:#fff"  data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
            <div class="card-header border-bottom d-flex justify-content-between">
                <div>
                    <input type="text" class="form-control search__input" placeholder="Search Notification">
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
            <div class="card-body p-0 m-0 table-responsive">
                <table class="table datatable-basic" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead>
                        <tr>
                            <th colspan="10">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-0 p-0"><b>1 Supervisor</b></h5>
                                    </div>
                                    <div class="delete-btn d-none">
                                        <button class="btn"><img src="{{ asset('image/icon/disable.png') }}" alt=""></button>
                                        <button class="btn"><img src="{{ asset('image/icon/download.png') }}" alt=""></button>
                                        <button class="btn text-danger"><i class="fas fa-trash-alt"></i></button>


                                        <button class="btn text-warning">Make 1 Inactive</button>
                                        <button class="btn send-notification-btn" data-toggle="modal" data-target="#messageModalCenter" style="background-color:#691D5E ;border-radius: 8px; color:#fff"><img src="{{ asset('image/icon/message.png') }}" alt=""> <span class="ml-2">Send Notification</span></button>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr class="bg-light" role="row">
                            <th style="width: 20px"><input type="checkbox" id="selectAll"></th>
                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Notification: activate to sort column descending">Student</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Phone No.</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Date of Birth</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Gender</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Audience</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Package</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Duration</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Status</th>
                            <th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Actions">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="custom-row" data-toggle="modal" data-target="#detailModalCenter">
                            <td><input type="checkbox" class="row-checkbox"></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <a href="#" class="btn bg-secondary rounded-round btn-icon btn-sm">
                                            <span class="letter-icon"></span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="#" class="text-default font-weight-semibold letter-icon-title">Hassan Ali</a>
                                        <div class="text-muted font-size-sm">ali@gmail.com </div>
                                    </div>
                                </div>
                            </td>
                            <td>1111111</td>
                            <td>22 Jan, 2012</td>
                            <td>Male</td>
                            <td>High School</td>
                            <td><span class="badge badge-flat badge-pill" style="border: 1px solid #3E4784; color:#3E4784"><b>Super man</b></span></td>
                            <td>Monthly</td>
                            <td>
                                <div class="form-check form-check-switchery p-0 m-0">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input-switchery" checked data-fouc>
                                    </label>
                                </div>
                            </td>
                            <td class="text-center"><button class="btn edit-btn"><i class="far fa-edit"></i> Edit</button></td>
                        </tr>
                    </tbody>
                </table>
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
                    <form class="form-section">
                        <div class="p-3">
                            <div class="d-flex justify-content-between">
                                <p style="font-size: 12px"> <span style="color: #344054"><b>Created on:</b></span> <span style="color: #475467">06 Jan 25 - 12 Jan 25</span></p>
                                <button class="btn p-0 m-0"><u>Reset</u></button>
                            </div>
                            <div class="mt-1 mb-2 d-flex justify-content-between">
                                <div style="width: 49%">
                                    <input type="date" class="form-control" name="craeted_at">
                                </div>
                                <div style="align-items: center; display: flex; width:1%">
                                    -
                                </div>
                                <div style="width: 49%">
                                    <input type="date" class="form-control" name="craeted_at">
                                </div>
                            </div>
                            <div>
                                <h6><b>Status:</b> All Result</h6>
                                <div class="form-check status-radio">
                                    <input class="form-check-input" type="radio" name="status" id="all" value="All" checked>
                                    <label class="form-check-label" for="all">
                                      All
                                    </label>
                                  </div>
                                  <div class="form-check status-radio">
                                    <input class="form-check-input" type="radio" name="status" id="activeonly" value="Active only">
                                    <label class="form-check-label" for="activeonly">
                                        Active only
                                    </label>
                                  </div>
                                  <div class="form-check status-radio">
                                    <input class="form-check-input" type="radio" name="status" id="inactiveonly" value="Inactive only">
                                    <label class="form-check-label" for="inactiveonly">
                                        Inactive only
                                    </label>
                                  </div>
                            </div>
                            <div class="mt-2">
                                <h6><b>Audience & Type:</b> All Result</h6>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="All-SAT-1">
                                    <label class="form-check-label" for="All-SAT-1">All SAT 1</label>
                                </div>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="All-SAT-2">
                                    <label class="form-check-label" for="All-SAT-2">All SAT 2</label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h6><b>Package Type:</b> All Result</h6>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="super-man">
                                    <label class="form-check-label" for="super-man"><span class="badge badge-flat badge-pill" style="border: 1px solid #3E4784; color:#3E4784"><b>Super man</b></span></label>
                                </div>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="avenger">
                                    <label class="form-check-label" for="avenger"><span class="badge badge-flat badge-pill" style="border: 1px solid #D9D6FE; color:#5925DC; background-color:#F4F3FF"><b>Avenger</b></span></label>
                                </div>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="gladiator">
                                    <label class="form-check-label" for="gladiator"><span class="badge badge-flat badge-pill" style="border: 1px solid #B2DDFF; color:#175CD3; background-color:#EFF8FF"><b>Gladiator</b></span></label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h6><b>Package Duration:</b> All Result</h6>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="monthly">
                                    <label class="form-check-label" for="monthly">Monthly</label>
                                </div>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="annual">
                                    <label class="form-check-label" for="annual">Annual</label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h6><b>Gender:</b> All Result</h6>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" id="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>

                        <div class="border-top fixed-bottom-buttons">
                            <div class="d-flex justify-content-between p-3">
                                <button type="button" class="btn" style="background-color:#691D5E ;border-radius: 8px; color:#fff; width:50%">Apply Filters</button>
                                <button type="button" class="btn btn-outline-dark ml-2" style="border: 1px solid #D0D5DD; border-radius: 8px; width:50%">Reset All</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    @push('css')
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/uploaders/dropzone.min.js"></script>
	    <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/uploader_dropzone.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/switch.min.js"></script>
            <!-- Theme JS files -->
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

        </style>
    @endpush
    @push('js')
    	<!-- Theme JS files -->
        <script src="{{ asset('/ui/backend') }}/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/datatables_basic.js"></script>
        <!-- /theme JS files -->

        <script src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/form_multiselect.js"></script>
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
        <script>
            $(document).ready(function () {
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

        </script>
    @endpush

</x-backend.layouts.master>