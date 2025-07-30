<x-backend.layouts.master>
<form>

    <div class="border-bottom pt-2 pl-4">
        <h4 class="form-header text-left">Referral Settings</h4>
    </div>

    <div class="roe">
        <div class="col-md-6">
            <div class="form-section m-4">
                <h5 class="mt-4 mb-3">Current Reward: <span><b>10 SAR</b></span></h5>
                <div class="form-group">
                    <label for="amount">Referral Reward Amount (SAR)</label>
                    <select class="form-control" name="amount" id="amount">
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed-bottom border-top p-3 bg-white d-flex justify-content-end" style="left: 272px;">
        <div>
            <a href="/packages" type="button" class="btn btn-outline-secondary btn-cancel mr-2">Cancel</a>
            <button type="submit" class="btn btn-primary btn-action">Save Change</button>
        </div>
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