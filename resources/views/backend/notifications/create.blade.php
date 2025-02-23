<x-backend.layouts.master>

    <x-backend.layouts.partials.blocks.contentwrapper 
        :headerTitle="'
            <a href=\'\notification\' class=\'text-dark\'>
                <i class=\'fa-solid fa-angle-left mr-2\'></i> Notification
            </a>
        '"
        :prependContent="'
            
        '">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div>
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px; width:70%">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="send-notification-tab" data-toggle="tab" href="#send-notification" role="tab" aria-controls="send-notification" aria-selected="true">Send notification</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="send-sms-tab" data-toggle="tab" href="#send-sms" role="tab" aria-controls="send-sms" aria-selected="false">Send SMS</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="send-notification" role="tabpanel" aria-labelledby="send-notification-tab">
                    <form action="">
                        <div>
                            <label for="">The Message in Arabic</label>
                            <textarea name="description" class="form-control" cols="30" rows="6" placeholder="Enter a description"></textarea>
                        </div>

                        <div class="mt-3">
                            <label for="">Destination Category</label>
                            <select name="category" class="form-control">
                                <option value="" disabled>Select the destination category.</option>
                                <option value="all-members">All Members</option>
                                <option value="active-users">Active Users</option>
                                <option value="inactive-users">Inactive Users</option>
                                <option value="blocked-users">Blocked Users</option>
                                <option value="unblocked-users">Unblocked Users</option>
                                <option value="supervisors">Supervisors</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default legitRipple ml-2 text-white btn-sm" style="background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px">
                                Send notification
                            </button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="send-sms" role="tabpanel" aria-labelledby="send-sms-tab">
                    <form action="">
                        <div>
                            <label for="">Message Text</label>
                            <textarea name="description" class="form-control" cols="30" rows="6" placeholder="Enter a description"></textarea>
                        </div>

                        <div class="mt-3">
                            <label for="">Destination Category</label>
                            <select name="category" class="form-control">
                                <option value="" disabled>Select the destination category.</option>
                                <option value="all-members">All Members</option>
                                <option value="active-users">Active Users</option>
                                <option value="inactive-users">Inactive Users</option>
                                <option value="blocked-users">Blocked Users</option>
                                <option value="unblocked-users">Unblocked Users</option>
                                <option value="supervisors">Supervisors</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default legitRipple ml-2 text-white btn-sm" style="background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px">
                                Send SMS
                            </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            .nav-tabs {
                border: 1px solid #ddd;
                border-radius: 9px !important;
            }

            .nav-tabs .nav-link.active {
                color: #333;
                background-color: #F9FAFB;
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
        </style>
    @endpush

</x-backend.layouts.master>