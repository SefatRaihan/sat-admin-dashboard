<x-backend.layouts.master>

    <x-slot name="page_title">
        Dashboard
    </x-slot>

    <x-slot name="contentWrapper">
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="fa-solid fa-angle-left mr-2"></i> <span class="font-weight-semibold">Create new SAT question</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements d-none">
                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default legitRipple" style="background-color:#f5f5f5">
                            <img src="{{ asset('image/icon/undo.png') }}" alt="" style="height: 15px">
                        </a>
                        <a href="#" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default legitRipple ml-2" style="background-color:#f5f5f5">
                            <img src="{{ asset('image/icon/redo.png') }}" alt="" style="height: 15px">
                        </a>

                        <a href="#" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default legitRipple ml-2" style="border:1px solid #e6e8ed">
                            Preview
                        </a>
                        <a href="#" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default legitRipple ml-2 text-white" style="background-color:#732066">
                            Save
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="page-header" style="border-radius:12px; background-color: #fff0fd !important">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title">
                <h4><span class="font-weight-semibold">40%</span></h4>
                <p>SAT 2 creation completed</p>
                <p class="text-muted">Due date 24.12.2024</p>
            </div>

            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">

                    <a href="#" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default legitRipple ml-2 text-white" style="background-color:#732066">
                        Resume
                    </a>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="page-header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title">
                <h2><b>Overview</b></h2>
            </div>

            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">

                    <a href="#" class="btn btn-link font-size-sm font-weight-semibold text-default legitRipple ml-2" style="border:1px solid #e6e8ed">
                        <i class="fa-solid fa-cloud-arrow-up"></i> Upload file
                    </a>
                    <a href="#" class="btn font-size-sm font-weight-semibold ml-2 text-white " style="background-color:#732066">
                        <i class="fa-solid fa-plus"></i>  Create Question
                    </a>
                    
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <div class="card card-body" style="border-radius:12px;">
                <h3>Total Questions</h3>
                <h3><b>18,755</b></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-body" style="border-radius:12px;">
                <h3>SAT 1</h3>
                <h3><b>2,243</b></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-body" style="border-radius:12px;">
                <h3>SAT 2</h3>
                <h3><b>3.756</b></h3>
            </div>
        </div>
    </div>


    <div class="card" style="border-radius:12px;">
        <div class="card-header header-elements-sm-inline">
            <h2 class="card-title"><b>All Question</b></h2>
        </div>

        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead>
                    <tr>
                        <th>Campaign</th>
                        <th>Client</th>
                        <th>Changes</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="../../../../global_assets/images/brands/facebook.png" class="rounded-circle" width="32" height="32" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold">Facebook</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark border-blue mr-1"></span>
                                        02:00 - 03:00
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted">Mintlime</span></td>
                        <td><span class="text-success-600"><i class="icon-stats-growth2 mr-2"></i> 2.43%</span></td>
                        <td><h6 class="font-weight-semibold mb-0">$5,489</h6></td>
                        <td><span class="badge bg-blue">Active</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-stats"></i> View statement</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-text2"></i> Edit campaign</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-locked"></i> Disable campaign</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="../../../../global_assets/images/brands/youtube.png" class="rounded-circle" width="32" height="32" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold">Youtube videos</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark border-danger mr-1"></span>
                                        13:00 - 14:00
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted">CDsoft</span></td>
                        <td><span class="text-success-600"><i class="icon-stats-growth2 mr-2"></i> 3.12%</span></td>
                        <td><h6 class="font-weight-semibold mb-0">$2,592</h6></td>
                        <td><span class="badge bg-danger">Closed</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-stats"></i> View statement</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-text2"></i> Edit campaign</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-locked"></i> Disable campaign</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="../../../../global_assets/images/brands/spotify.png" class="rounded-circle" width="32" height="32" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold">Spotify ads</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark border-grey-400 mr-1"></span>
                                        10:00 - 11:00
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted">Diligence</span></td>
                        <td><span class="text-danger"><i class="icon-stats-decline2 mr-2"></i> - 8.02%</span></td>
                        <td><h6 class="font-weight-semibold mb-0">$1,268</h6></td>
                        <td><span class="badge bg-grey-400">On hold</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-stats"></i> View statement</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-text2"></i> Edit campaign</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-locked"></i> Disable campaign</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="../../../../global_assets/images/brands/twitter.png" class="rounded-circle" width="32" height="32" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold">Twitter ads</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark border-grey-400 mr-1"></span>
                                        04:00 - 05:00
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted">Deluxe</span></td>
                        <td><span class="text-success-600"><i class="icon-stats-growth2 mr-2"></i> 2.78%</span></td>
                        <td><h6 class="font-weight-semibold mb-0">$7,467</h6></td>
                        <td><span class="badge bg-grey-400">On hold</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-stats"></i> View statement</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-text2"></i> Edit campaign</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-locked"></i> Disable campaign</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



</x-backend.layouts.master>
