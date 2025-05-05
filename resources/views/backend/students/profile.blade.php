<x-backend.layouts.student-master>

    <div>
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="true">My Profile</button>
                    <button class="nav-link" id="v-pills-package-tab" data-toggle="pill" data-target="#v-pills-package" type="button" role="tab" aria-controls="v-pills-package" aria-selected="false">Package</button>
                    <button class="nav-link" id="v-pills-billing-tab" data-toggle="pill" data-target="#v-pills-billing" type="button" role="tab" aria-controls="v-pills-billing" aria-selected="false">Billing</button>
                    <button class="nav-link" id="v-pills-notification-tab" data-toggle="pill" data-target="#v-pills-notification" type="button" role="tab" aria-controls="v-pills-notification" aria-selected="false">Notification</button>
                    <button class="nav-link" id="v-pills-term-condition-tab" data-toggle="pill" data-target="#v-pills-term-condition" type="button" role="tab" aria-controls="v-pills-term-condition" aria-selected="false">Terms & Conditions</button>
                    <button class="nav-link" id="v-pills-privacy-policy-tab" data-toggle="pill" data-target="#v-pills-privacy-policy" type="button" role="tab" aria-controls="v-pills-privacy-policy" aria-selected="false">Privacy Policy</button>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="card edit-card d-none" style="border-radius: 15px; box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                            <div class="card-header border-bottom">
                                <h4 class="mb-0" style="font-size:20px; font-weight:600">My Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p class="mb-0" style="color:#344054; font-size:14px; font-weight:600">Personal info</p>
                                                <p style="color:#475467; font-size:14px; font-weight:400">Update your photo and personal details.</p>
                                            </div>
                                            <div class="col-md-9">
                                                <div style="width: 80%">
                                                    @include('profile.partials.update-profile-information-form')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p class="mb-0" style="color:#344054; font-size:14px; font-weight:600">Password</p>
                                            </div>
                                            <div class="col-md-9">
                                                <div style="width: 80%">
                                                    @include('profile.partials.update-password-form')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card information-card" style="border-radius: 15px; box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                            <div class="card-header border-bottom">
                                <h4 class="mb-0" style="font-size:20px">My Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-8">
                                        <div class="card" style="border-radius: 15px; box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div>
                                                        <img src="{{ auth()->user()->profile_image ? asset('uploads/profile_images/' . auth()->user()->profile_image) : asset('image/profile.jpeg') }}" alt="Avatar" style="height: 48px; width:48px; border-radius:50%; object-fit: cover;">
                                                    </div>
                                                    <div class="ml-2">
                                                        <h4 class="mb-0" style="font-size: 16px; font-weight:600">{{ auth()->user()->full_name }}</h4>
                                                        <p style="font-size: 14px; font-weight:400; color:#6B7280">{{ auth()->user()->email }}</p>
                                                    </div>
                                                </div>
                                                <hr class="mt-0">
                                                <h4 style="font-size: 16px; font-weight:600">Student Details</h4>
                                                <div class="profileTableWrapper">
                                                    <table class="table table-striped custom-table profileTable" style="border: 1px solid #EAECF0">
                                                        <tr>
                                                            <td style="width: 25%">Name</td>
                                                            <td class="font-weight-bold" style="width: 25%" id="studentName">: {{ auth()->user()->full_name }}</td>
                
                                                            <td style="width: 25%">Date of Birth</td>
                                                            <td class="font-weight-bold" style="width: 25%" id="studentDob">: {{ \Carbon\Carbon::parse(auth()->user()->student->date_of_birth)->format('d-M-Y') }}</td>                                                             </td>
                                                        </tr>
                
                                                        <tr>
                                                            <td style="width: 25%">Email</td>
                                                            <td class="font-weight-bold" style="width: 25%" id="StudentEmail">: {{ auth()->user()->email }}</td>
                
                                                            <td style="width: 25%">Audience Type</td>
                                                            <td class="font-weight-bold" style="width: 25%" id="studentAudience">: {{ auth()->user()->student->audience }}</td>
                                                        </tr>
                
                                                        <tr>
                                                            <td style="width: 25%">Gender</td>
                                                            <td class="font-weight-bold text-capitalize" style="width: 25%" id="studentGender">: {{ auth()->user()->student->gender }}</td>
                
                                                            <td style="width: 25%">Active Status</td>
                                                            <td class="font-weight-bold text-capitalize" style="width: 25%" id="studentStatus">: {{ auth()->user()->student->status }}</td>
                                                        </tr>
                
                                                        <tr>
                                                            <td style="width: 25%">Phone Number</td>
                                                            <td class="font-weight-bold" style="width: 25%" id="studentPhone">: {{ auth()->user()->student->phone }}</td>
                
                                                            <td style="width: 25%">-</td>
                                                            <td class="font-weight-bold" style="width: 25%">: -</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="d-flex justify-content-end mt-3">
                                                    <a href="" type="button" class="btn btn-outline-dark mr-2 edit-student" style="border: 1px solid #D0D5DD; border-radius: 8px;"><i class="fas fa-pen"></i> Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-package" role="tabpanel" aria-labelledby="v-pills-package-tab">
                        <div class="card" style="border-radius: 15px; box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                            <div class="card-header border-bottom">
                                <h4 class="mb-0" style="font-size:20px; font-weight:600">Packages</h4>
                            </div>
                            <div class="card-body">
                                <div class="mt-2">
                                    <!-- Current Plan -->
                                    <div class="row mb-4">
                                       <div class="col-md-4">
                                            <p class="mb-0" style="color:#344054; font-size:14px; font-weight:600">Current plan</p>
                                            <p style="color:#475467; font-size:14px; font-weight:400">We’ll credit your account if you need to downgrade during the billing cycle.</p>
                                       </div>
                                       <div class="col-md-8">
                                          <div class="card" style="border-radius: 15PX">
                                             <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                       <h5 class="mb-0" style="font-size: 18px; font-weight:600">3 months Plan <span class="badge bg-light text-dark border ms-1" style="border-radius: 8px">Monthly</span></h5>
                                                       <p class="mb-1" style="color: #475467; font-size:14px; font-weight:400">Perfect for starting your journey</p>
                                                       <p class="small" style="color: #475467; font-size:14px; font-weight:400">Expire: 20 Jun 2025</p>
                                                    </div>
                                                    <div class="text-end">
                                                       <p class="plan-price mb-0" style="font-size:48px; font-weight:600">199 SAR <span class="fs-6 fw-normal" style="font-size:16px; font-weight:500; color:#475467">per month</span></p>
                                                    </div>
                                                 </div>
                                             </div>
                                             <div class="card-footer pt-1 d-flex justify-content-end" style="background: transparent">
                                                 <button class="btn btn-link text-decoration-none upgrade-plan" style="font-size:14px; font-weight:600; color:#521749">Upgrade plan <i class="fas fa-arrow-right" style="rotate: -30deg;"></i></button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="mb-0" style="color:#344054; font-size:14px; font-weight:600">Billing and invoicing</p>
                                            <p style="color:#475467; font-size:14px; font-weight:400">Pick an account plan that fits your workflow.</p>
                                        </div>
                                        <div class="col-md-8 d-flex justify-content-end">
                                            <button type="button" class="btn btn-sm btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;"><i class="fas fa-cloud-download-alt"></i> Download All</button>
                                        </div>
                                    </div>
                                    <!-- Billing and Invoicing -->
                                    <div class="row mt-3">
                                       <div class="col-md-4">
                                            <p class="mb-0" style="color:#344054; font-size:14px; font-weight:600">Billing history</p>
                                            <p style="color:#475467; font-size:14px; font-weight:400">Please reach out to our friendly team via <a href="mailto:billing@mubhir.com">billing@mubhir.com</a> with questions.</p>
                                       </div>
                                       <div class="col-md-8">
                                           <div class="profileTableWrapper">
                                               <table class="table custom-table profileTable" style="border: 1px solid #EAECF0">
                                                   <thead>
                                                       <tr class="bg-light">
                                                          <th><input type="checkbox"></th>
                                                          <th>Invoice</th>
                                                          <th>Amount</th>
                                                          <th>Date</th>
                                                          <th>Status</th>
                                                          <th></th>
                                                       </tr>
                                                    </thead>
                                                    <tbody>
                                                       <!-- Sample row -->
                                                       <tr>
                                                          <td><input type="checkbox"></td>
                                                          <td>Basic Plan – Dec 2022</td>
                                                          <td>SAR 10.00</td>
                                                          <td>Dec 1, 2022</td>
                                                          <td><span class="badge badge-pill badge-easy">Easy</span></td>
                                                          <td><a type="button" class="btn btn-sm btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;"><i class="fas fa-cloud-download-alt"></i></a></td>
                                                       </tr>
                                                       <tr>
                                                          <td><input type="checkbox"></td>
                                                          <td>Basic Plan – Dec 2022</td>
                                                          <td>SAR 10.00</td>
                                                          <td>Dec 1, 2022</td>
                                                          <td><span class="badge badge-pill badge-easy">Easy</span></td>
                                                          <td><a type="button" class="btn btn-sm btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;"><i class="fas fa-cloud-download-alt"></i></a></td>
                                                       </tr>
                                                       <tr>
                                                          <td><input type="checkbox"></td>
                                                          <td>Basic Plan – Dec 2022</td>
                                                          <td>SAR 10.00</td>
                                                          <td>Dec 1, 2022</td>
                                                          <td><span class="badge badge-pill badge-easy">Easy</span></td>
                                                          <td><a type="button" class="btn btn-sm btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;"><i class="fas fa-cloud-download-alt"></i></a></td>
                                                       </tr>
                                                       <tr>
                                                          <td><input type="checkbox"></td>
                                                          <td>Basic Plan – Dec 2022</td>
                                                          <td>SAR 10.00</td>
                                                          <td>Dec 1, 2022</td>
                                                          <td><span class="badge badge-pill badge-easy">Easy</span></td>
                                                          <td><a type="button" class="btn btn-sm btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;"><i class="fas fa-cloud-download-alt"></i></a></td>
                                                       </tr>
                                                       <tr>
                                                          <td><input type="checkbox"></td>
                                                          <td>Basic Plan – Dec 2022</td>
                                                          <td>SAR 10.00</td>
                                                          <td>Dec 1, 2022</td>
                                                          <td><span class="badge badge-pill badge-easy">Easy</span></td>
                                                          <td><a type="button" class="btn btn-sm btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;"><i class="fas fa-cloud-download-alt"></i></a></td>
                                                       </tr>
                                                       <tr>
                                                          <td><input type="checkbox"></td>
                                                          <td>Basic Plan – Dec 2022</td>
                                                          <td>SAR 10.00</td>
                                                          <td>Dec 1, 2022</td>
                                                          <td><span class="badge badge-pill badge-easy">Easy</span></td>
                                                          <td><a type="button" class="btn btn-sm btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;"><i class="fas fa-cloud-download-alt"></i></a></td>
                                                       </tr>
                                                       <tr>
                                                          <td><input type="checkbox"></td>
                                                          <td>Basic Plan – Dec 2022</td>
                                                          <td>SAR 10.00</td>
                                                          <td>Dec 1, 2022</td>
                                                          <td><span class="badge badge-pill badge-easy">Easy</span></td>
                                                          <td><a type="button" class="btn btn-sm btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;"><i class="fas fa-cloud-download-alt"></i></a></td>
                                                       </tr>
                                                       <!-- Add more rows as needed -->
                                                    </tbody>
                                               </table>
                                           </div>
                                       </div>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-billing" role="tabpanel" aria-labelledby="v-pills-billing-tab">
                        <div class="card" style="border-radius: 15px; box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                            <div class="card-header border-bottom">
                                <h4 class="mb-0" style="font-size:20px; font-weight:600">Billing</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mt-2">
                                    <!-- Left Column -->
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-0" style="color:#344054; font-size:14px; font-weight:600">Card details</p>
                                                <p style="color:#475467; font-size:14px; font-weight:400">Select default payment method.</p>
                                            </div>
                                            <div class="col-md-8">
                                                <!-- Visa Card Selected -->
                                                <div class="p-3 mb-3 card-selected">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-start">
                                                            <div class="mr-2">
                                                                <span class="icon-box visa-icon me-2"></span>
                                                            </div>
                                                            <div>
                                                                <p class="mb-0" style="color:#344054; font-size:14px; font-weight:500">Visa ending in 1234</p>
                                                                <p class="mb-0" style="color:#475467; font-size:14px; font-weight:400">Expiry 06/2024</p>
                                                                <div class="mt-1 d-flex">
                                                                    <a href="#" class="text-decoration-none text-muted mr-2" style="color:#475467; ont-size:14px; font-weight:600">Set as default</a>
                                                                    <a href="#" class="text-decoration-none" style="color:#521749; font-weight:600">Edit</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-check-input" type="checkbox" name="defaultCard" checked>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Mastercard Unselected -->
                                                <div class="p-3 mb-3 card-unselected">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-start">
                                                            <div class="mr-2">
                                                                <span class="icon-box mastercard-icon me-2"></span>
                                                            </div>
                                                            <div>
                                                                <p class="mb-0" style="color:#344054; font-size:14px; font-weight:500">Mastercard ending in 1234</p>
                                                                <p class="mb-0" style="color:#475467; font-size:14px; font-weight:400">Expiry 06/2024</p>
                                                                <div class="mt-1 d-flex">
                                                                    <a href="#" class="text-decoration-none text-muted mr-2" style="color:#475467; ont-size:14px; font-weight:600">Set as default</a>
                                                                    <a href="#" class="text-decoration-none" style="color:#521749; font-weight:600">Edit</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-check-input" type="checkbox" name="defaultCard">
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn text-decoration-none" style="color:#475467; font-size:14px; font-weight:600" data-toggle="modal" data-target="#paymentMethodModal">+ Add new payment method</button>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <!-- Right Column -->
                                    <div class="col-md-12 mt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-0" style="color:#344054; font-size:14px; font-weight:600">Contact email</p>
                                                <p style="color:#475467; font-size:14px; font-weight:400">Where should invoices be sent?</p>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-check custom-radio mb-2">
                                                  <input class="form-check-input" type="radio" name="emailOption" id="accountEmail">
                                                  <label class="form-check-label" for="accountEmail">
                                                    Send to my account email<br>
                                                    <small class="text-muted">olivia@mubhir.com</small>
                                                  </label>
                                                </div>
                                          
                                                <div class="form-check custom-radio mb-3">
                                                  <input class="form-check-input" type="radio" name="emailOption" id="altEmail" checked>
                                                  <label class="form-check-label" for="altEmail">
                                                    Send to an alternative email
                                                  </label>
                                                </div>
                                          
                                                <input type="email" class="form-control" value="billing@mubhir.com">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- modal --}}
                                <div class="modal fade" id="paymentMethodModal" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content text-center"  style="border-radius: 15px;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel" style="color: #101828; font-size:20px; font-weight:600">
                                                    Payment method
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left paymentModal">
                                                <div class="form-section">
                                                    <h4 class="label-title" style="font-weight: 600 !important;">Card details</h4>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="mb-3">
                                                                <label for="nameOnCard" class="form-label label-title">Name on card</label>
                                                                <input type="text" class="form-control" id="nameOnCard" placeholder="Full name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="expiry" class="form-label label-title">Expiry</label>
                                                                <input type="text" class="form-control" id="expiry" placeholder="Date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="mb-3 card-number-group">
                                                                <label for="cardNumber" class="form-label label-title">Card number</label>
                                                                <input type="text" class="form-control" id="cardNumber" value="1234 1234 1234 1234">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="cvv" class="form-label label-title">CVV</label>
                                                                <input type="text" class="form-control" id="cvv" placeholder="***">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <div class="form-section">
                                                    <h4 class="label-title">Street address</h4>
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" placeholder="Address">
                                                    </div>
                                                </div>
                                        
                                                <div class="form-section border-bottom">
                                                    <h4 class="label-title">City</h4>
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" placeholder="City name">
                                                    </div>
                                                </div>
                                        
                                                <div class="form-section border-bottom mt-2">
                                                    <h4 class="label-title">State / Province</h4>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control" value="VIC">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control" value="3066">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <div class="form-section mt-2">
                                                    <h4 class="label-title">Country</h4>
                                                    <div class="mb-3">
                                                        <select class="form-control" id="country">
                                                            <option selected>Select country</option>
                                                            <option value="1">United States</option>
                                                            <option value="2">Canada</option>
                                                            <option value="3">Australia</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-top d-flex justify-content-between pt-2">
                                                <button type="button" class="btn btn-outline-dark" data-dismiss="modal" style="border: 1px solid #A16A99; border-radius: 8px; color:#A16A99" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn submit-exam" style="background-color:#691D5E ;border-radius: 8px; color:#fff">End Exam</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-notification" role="tabpanel" aria-labelledby="v-pills-notification-tab">
                        <div class="card" style="border-radius: 15px; box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                            <div class="card-header border-bottom">
                                <h4 class="mb-0" style="font-size:20px; font-weight:600">Notification</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <p class="mb-0" style="color:#344054; font-size:14px; font-weight:600">General notifications</p>
                                        <p style="color:#475467; font-size:14px; font-weight:400">Select when and how you’ll be notified</p>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                            <div>
                                                <h4 style="color: #344054; font-size:14px; font-weight:500">Notification</h4>
                                            </div>
                                            <div>
                                                @include('components.backend.layouts.elements.switch', ['name' => 'switch'])
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center border-bottom pt-2 pb-2">
                                            <div>
                                                <h4 style="color: #344054; font-size:14px; font-weight:500">Important Announcements</h4>
                                            </div>
                                            <div>
                                                <div class="btn-group mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px; background-color: transparent !important;">
                                                    <button type="button" class="btn btn-light legitRipple" style="background-color: transparent !important;">Non</button>
                                                    <button type="button" class="btn btn-light border-left border-right legitRipple" style="background-color: #F9FAFB !important;">In-app</button>
                                                    <button type="button" class="btn btn-light legitRipple" style="background-color: transparent !important;">Email</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center pt-2">
                                            <div>
                                                <h4 style="color: #344054; font-size:14px; font-weight:500">Exam Schedule Reminder</h4>
                                            </div>
                                            <div>
                                                <div class="btn-group mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px; background-color: transparent !important;">
                                                    <button type="button" class="btn btn-light legitRipple" style="background-color: transparent !important;">Non</button>
                                                    <button type="button" class="btn btn-light border-left border-right legitRipple" style="background-color: transparent !important;">In-app</button>
                                                    <button type="button" class="btn btn-light border-left legitRipple" style="background-color: #F9FAFB !important; border-radius: 8px;">Email</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-term-condition" role="tabpanel" aria-labelledby="v-pills-term-condition-tab">
                        <div class="card" style="border-radius: 15px; box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                            <div class="card-header border-bottom">
                                <h4 class="mb-0" style="font-size:20px; font-weight:600">Terms & Conditions</h4>
                            </div>
                            <div class="card-body term-condition-section">
                                <div class="mt-2">
                                    <p>Welcome to the "Mubhir" platform! Please read the following terms and conditions carefully before using the site. By using this site, you agree to be bound by the following terms and conditions:</p>

                                    <h2>1. Acceptance of Terms</h2>
                                    <p>By using the "Mubarak" website, you agree to be bound by these terms and conditions. If you do not agree with any part of these terms, you must immediately stop using the website.</p>

                                    <h2>2. Registration</h2>
                                    <p>The Site may require you to register to create an account. You must provide correct and complete information during the registration process, and maintain the confidentiality of your account information.</p>

                                    <h2>3. Use of the Site</h2>
                                    <p>You are permitted to use the Site for educational and training purposes only.<br>
                                    The use of the Site for any illegal or unauthorized purposes is prohibited.<br>
                                    You must not copy, distribute or modify any part of the Site Content without express permission.</p>

                                    <h2>4. Content</h2>
                                    <p>The content on the Site is provided for educational and training purposes only.<br>
                                    Mubhir is not responsible for the accuracy or completeness of the information provided.<br>
                                    The Site reserves the right to modify or delete any content at any time without prior notice.</p>

                                    <h2>5. Subscriptions and Payment</h2>
                                    <p>The Platform offers a variety of subscription plans that vary in duration and benefits.<br>
                                    Subscriptions are automatically renewed unless you cancel them before the renewal date.<br>
                                    All payments are non-refundable, unless otherwise stated.</p>

                                    <h2>6. Privacy</h2>
                                    <p>All personal information you provide is subject to our Privacy Policy. By using this Site, you agree to the collection and use of information in accordance with the Privacy Policy.</p>

                                    <h2>7. Intellectual Property</h2>
                                    <p>All intellectual property rights in and to the Site and its contents are owned by Mehber or its licensors.<br>
                                    You may not use any trademarks or logos of the Site without prior written permission.</p>

                                    <h2>8. Modifications to the Terms</h2>
                                    <p>Mehber reserves the right to modify these Terms and Conditions at any time. Users will be notified of any changes to the Terms, and continued use of the Site after posting of modifications will be deemed acceptance of the modified Terms.</p>

                                    <h2>9. Disclaimer</h2>
                                    <p>The Site is provided on an "as is" and "as available" basis without any warranties of any kind, either express or implied.<br>
                                    Mehber does not warrant that the Site will be error free or available at all times.</p>

                                    <h2>10. Governing Law</h2>
                                    <p>These Terms and Conditions shall be governed by and construed in accordance with the laws of [Saudi Arabia], and any dispute arising out of them shall be subject to the exclusive jurisdiction of the courts of [Saudi Arabia].</p>

                                    <h2>11. Contact Us</h2>
                                    <p>If you have any questions or comments about these Terms and Conditions, please contact us at our email address or mobile number.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-privacy-policy" role="tabpanel" aria-labelledby="v-pills-privacy-policy-tab">
                        <div class="card" style="border-radius: 15px; box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                            <div class="card-header border-bottom">
                                <h4 class="mb-0" style="font-size:20px; font-weight:600">Privacy Policy</h4>
                            </div>
                            <div class="card-body privacy-policy-section">
                                <div class="mt-2">
                                    <p>We at Mubehr are committed to protecting your privacy. This Privacy Policy explains how we collect, use and protect the personal information you provide to us when you use our website.</p>
                                  
                                    <h2>1. Information We Collect</h2>
                                    <p>We may collect the following information when you use the Site:</p>
                                    <ul>
                                      <li>Personal information: such as name, email address, phone number, and payment information</li>
                                      <li>Technical information: such as IP address, browser type, and operating system</li>
                                      <li>Behavioral information: such as the pages you visit, the time you spend on the site, and the activities you undertake</li>
                                    </ul>
                                  
                                    <h2>2. How we use the information</h2>
                                    <p>We use the information we collect for the following purposes:</p>
                                    <ul>
                                      <li>Providing and improving our services</li>
                                      <li>Communicating with you</li>
                                      <li>Security</li>
                                      <li>Marketing</li>
                                    </ul>
                                  
                                    <h2>3. Sharing Information</h2>
                                    <p>We do not sell or rent your personal information to third parties. We may share your information in the following cases:</p>
                                    <ul>
                                      <li>With Service Providers</li>
                                      <li>To comply with law</li>
                                      <li>To protect our rights</li>
                                    </ul>
                                  
                                    <h2>4. Content</h2>
                                    <p>The content on the Site is provided for educational and training purposes only. Mubehr is not responsible for the accuracy or completeness of the information provided. The Site reserves the right to modify or delete any content at any time without prior notice.</p>
                                  
                                    <h2>5. Subscriptions and Payment</h2>
                                    <p>The Platform offers a variety of subscription plans. Subscriptions are automatically renewed unless you cancel them before the renewal date. All payments are non-refundable, unless otherwise stated.</p>
                                  
                                    <h2>6. Privacy</h2>
                                    <p>All personal information you provide is subject to our Privacy Policy. By using this Site, you agree to the collection and use of information in accordance with the Privacy Policy.</p>
                                  
                                    <h2>7. Intellectual Property</h2>
                                    <p>All intellectual property rights in and to the Site and its contents are owned by Mubehr or its licensors. You may not use any trademarks or logos of the Site without prior written permission.</p>
                                  
                                    <h2>8. Modifications to the Terms</h2>
                                    <p>Mubehr reserves the right to modify these Terms and Conditions at any time. Continued use of the site after posting of modifications will be deemed acceptance of the modified Terms.</p>
                                  
                                    <h2>9. Disclaimer</h2>
                                    <p>The Site is provided on an "as is" and "as available" basis without warranties of any kind. Mubehr does not warrant that the Site will be error free or available at all times.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="pricingModal" tabindex="-1" aria-labelledby="pricingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 50% !important;">
           <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-header d-flex justify-content-center border-0">
                 <div>
                    <h5 class="text-center mb-0" style="color:#101828; font-size:24px; font-weight:600">Flexible Pricing for Every Learner</h5>
                    <p class="text-center text-muted" style="color:#475467; font-size:14px; font-weight:400">Choose the plan that fits your goals and budget</p>
                 </div>
              </div>
              <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="payment-tab-section p-2">
                        <ul class="nav nav-tabs mb-0" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="exam-all-tab" data-toggle="tab" href="#exam-all" role="tab" aria-controls="exam-all" aria-selected="true">Hi school</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="unattempted-tab" data-toggle="tab" href="#unattempted" role="tab" aria-controls="unattempted" aria-selected="false">College</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="attempted-tab" data-toggle="tab" href="#attempted" role="tab" aria-controls="attempted" aria-selected="false">Graduate</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="attempted-tab" data-toggle="tab" href="#attempted" role="tab" aria-controls="attempted" aria-selected="false">SAT 2</a>
                            </li>
                        </ul>
                    </div>
                </div>
                 <div class="row text-center mt-4">
                    <div class="col-md-4 mb-3">
                       <div class="card card-body text-left" style="border-radius: 15px">
                        <div class="pricing-card">
                            <h6 class="mb-0" style="color:#101828; font-size:16px; font-weight:600">Monthly Plan</h6>
                            <p class="text-muted small" style="color:#667085; font-size:14px; font-weight:500">Perfect for starting your journey</p>
                            <p class="plan-price mb-0 mt-3" style="font-size:24px; font-weight:600; color:#671E5A">99 <span class="fs-6 fw-normal" style="font-size:16px; font-weight:500; color:#727272">SAR</span></p>
                            <p class="text-muted small" style="color:#050505; font-size:14px; font-weight:500">Per user per month</p>
                            <a href="/checkout" class="btn btn-block btn-outline-dark mr-2" style="border: 1px solid #A16A99; border-radius: 8px;">Buy Now</a>
                         </div>
                       </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card card-body active text-left" style="border-radius: 15px">
                            <div class="pricing-card">
                                <h6 class="mb-0" style="color:#101828; font-size:16px; font-weight:600">3 Months Plan</h6>
                                <p class="text-muted small" style="color:#667085; font-size:14px; font-weight:500">Perfect for starting your journey</p>
                                <p class="plan-price mb-0 mt-3" style="font-size:24px; font-weight:600; color:#671E5A">199 <span class="fs-6 fw-normal" style="font-size:16px; font-weight:500; color:#727272">SAR</span></p>
                                <p class="text-muted small" style="color:#050505; font-size:14px; font-weight:500">Per user per month</p>
                                <a href="/checkout" class="btn btn-block mr-2" style="border: 1px solid #691D5E;; background-color:  #691D5E; border-radius: 8px; color:#fff">Buy Now</a>
                             </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card card-body text-left" style="border-radius: 15px">
                            <div class="pricing-card">
                                <h6 class="mb-0" style="color:#101828; font-size:16px; font-weight:600">6 Months Plan</h6>
                                <p class="text-muted small" style="color:#667085; font-size:14px; font-weight:500">Perfect for starting your journey</p>
                                <p class="plan-price mb-0 mt-3" style="font-size:24px; font-weight:600; color:#671E5A">299 <span class="fs-6 fw-normal" style="font-size:16px; font-weight:500; color:#727272">SAR</span></p>
                                <p class="text-muted small" style="color:#050505; font-size:14px; font-weight:500">Per user per month</p>
                                <a href="/checkout" class="btn btn-block btn-outline-dark mr-2" style="border: 1px solid #A16A99; border-radius: 8px;">Buy Now</a>
                             </div>
                        </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
    </div> 

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/student-profile.css') }}">   
    @endpush

    @push('js')
        <script>
            $(document).ready(function() {
                // Edit button click
                $('.edit-student').on('click', function(e) {
                    e.preventDefault();
                    $('.information-card').addClass('d-none');
                    $('.edit-card').removeClass('d-none');
                });

                // Cancel button click
                $('.cancel').on('click', function(e) {
                    e.preventDefault();
                    $('.edit-card').addClass('d-none');
                    $('.information-card').removeClass('d-none');
                });

                $(document).on('click', '.upgrade-plan', function () {
                    $('#pricingModal').modal('show');
                });
            });
        </script>
    @endpush

</x-backend.layouts.student-master>