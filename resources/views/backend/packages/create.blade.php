<x-backend.layouts.master>
<form>

    <div class="border-bottom pt-2">
        <h4 class="form-header text-center">Add New Package</h4>
    </div>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="form-container">
        
        <h5 class="mb-3">Basic Info</h5>
          <div class="form-section">
            <div class="form-group">
                <label>Package Type</label>
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="packageType" id="sat1" value="SAT 1" checked>
                                <label class="form-check-label" for="sat1">
                                    SAT 1
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check custom-radio">
                                 <input class="form-check-input" type="radio" name="packageType" id="sat2" value="SAT 2">
                                <label class="form-check-label" for="sat2">
                                    SAT 2
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="d-flex align-content-center">
                  <label>Package Status</label>
                    <div class="ml-3">
                        <input type="checkbox" class="highlight" name="highlight" id="highlight">
                        <label class="" for="highlight">Highlight this package</label>
                    </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="form-check custom-radio">
                        <input class="form-check-input" type="radio" name="packageStatus" id="active" value="Active" checked>
                        <label class="form-check-label" for="Active">
                            Active
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check custom-radio">
                        <input class="form-check-input" type="radio" name="packageStatus" id="inactive" value="Inactive">
                        <label class="form-check-label" for="Inactive">
                            Inactive
                        </label>
                    </div>
                </div>
            </div>
            </div>
            <div class="form-group">
                <label for="planTitle">Plan Title</label>
                <input type="text" class="form-control" id="planTitle" placeholder="Enter description here">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" placeholder="Enter description here">
            </div>
          </div>
          
          <h5 class="mb-3 mt-3">Pricing Configuration</h5>
          <div class="form-section">
            <div class="form-group">
                <label for="promotionalBadge">Promotional Badge</label>
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control" id="promotionalBadge" placeholder="E.g. Save 15%">
                    <div class="ml-3">
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <input type="checkbox" class="highlight" name="highlight" id="highlight">
                <label class="" for="highlight">Highlight this package</label>
            </div>
            <div class="form-group">
              <label for="pricing">Pricing</label>
              <input type="text" class="form-control" id="pricing" placeholder="SAR NNNN.NN">
            </div>
            <div class="form-group">
              <label for="pricingTerms">Pricing Terms</label>
              <input type="text" class="form-control" id="pricingTerms" placeholder="e.g. per user per month">
            </div>
            <div class="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check custom-radio" style="background-color: transparent !important; border:none">
                            <input class="form-check-input" type="radio" name="pricingTermRadio" id="yearly" value="Yearly">
                            <label class="form-check-label" for="yearly">
                                Yearly
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check custom-radio" style="background-color: transparent !important; border:none">
                            <input class="form-check-input" type="radio" name="pricingTermRadio" id="monthly" value="Monthly">
                            <label class="form-check-label" for="monthly">
                                Monthly
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check custom-radio" style="background-color: transparent !important; border:none">
                            <input class="form-check-input" type="radio" name="pricingTermRadio" id="threeMonths" value="3-Month" checked>
                            <label class="form-check-label" for="threeMonths">
                                3-Month
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check custom-radio" style="background-color: transparent !important; border:none">
                            <input class="form-check-input" type="radio" name="pricingTermRadio" id="sixMonths" value="6-Month">
                            <label class="form-check-label" for="sixMonths">
                                6-Month
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check custom-radio" style="background-color: transparent !important; border:none">
                            <input class="form-check-input" type="radio" name="pricingTermRadio" id="other" value="Other">
                            <label class="form-check-label" for="Other">
                                other
                            </label>
                        </div>
                    </div>
                </div>
              <div>
                
                <input type="text" class="form-control mt-2" placeholder="If other, please describe">
              </div>
            </div>
            <div class="form-group mt-2">
              <label for="validity">Validity (months)</label>
              <input type="text" class="form-control" id="validity" value="6 Months">
            </div>
          </div>
          
      </div>
    </div>
  </div>

    <div class="d-flex justify-content-end mt-4 border-top p-3">
        <a href="/packages" type="button" class="btn btn-outline-secondary btn-cancel mr-2">Cancel</a>
        <button type="submit" class="btn btn-primary btn-action">Add New Package</button>
    </div>
</form>

  @push('css')
      <style>
        .content {
            padding: 0px;
            margin: 0px;
        }

        .form-container {
            background-color: #fff;
            border-radius: 15px;
            border: 1px solid #D0D5DD;
            padding: 11px;
            margin-top: 30px;
        }
        .form-header {
            text-align: center;
            font-size: 20px;
            font-weight: 600;
        }

        .form-section {
            border: 1px solid #EAECF0;
            background: #F9FAFB;
            border-radius: 8px;
            padding: 10px;
        }

        .form-check {
            border: 1px solid #D0D5DD;
            border-radius: 8px;
            height: 44px;
            display: flex;
            align-items: center;
            padding-left: 46px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fff;
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

        .highlight {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #ccc;
            border-radius: 4px !important;
            cursor: pointer;
            vertical-align: middle;
            position: relative;
            transition: background-color 0.2s;
        }

        .highlight:checked {
            background-color: #732066;
            border-color: #732066;
        }

        .highlight:checked::after {
            content: '';
            position: absolute;
            top: 3px;
            left: 6px;
            width: 4px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .form-group label {
            font-weight: 500;
            color: #555;
        }

        .form-control {
            background-color: #fff;
        }
        .form-check-label {
        font-weight: normal;
        }
        .btn-action {
            background-color: #732066;
            color: #fff;
            border-color: #732066;
            font-weight: 500;
            border-radius: 8px;
        }
        .btn-cancel {
            color: #732066;
            background-color: transparent;
            border-color: #732066;
            border-radius: 8px;
        }
        .radio-custom input[type="radio"] {
        display: none;
        }
        .radio-custom input[type="radio"] + label {
        border: 1px solid #ddd;
        border-radius: 20px;
        padding: 10px 20px;
        margin-right: 10px;
        cursor: pointer;
        transition: all 0.3s;
        }
        .radio-custom input[type="radio"]:checked + label {
        background-color: #732066;
        color: #fff;
        border-color: #732066;
        }
        .toggle-switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
        }
        .toggle-switch input {
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
        border-radius: 34px;
        }
        .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
        }
        input:checked + .slider {
        background-color: #079455;
        }
        input:checked + .slider:before {
        transform: translateX(20px);
        }
      </style>
  @endpush
</x-backend.layouts.master>