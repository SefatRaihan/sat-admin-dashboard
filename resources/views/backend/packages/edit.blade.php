
<x-backend.layouts.master>
    <form action="{{ route('packages.update', $package->uuid) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="border-bottom pt-2">
            <h4 class="form-header text-center">Edit Package</h4>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h5 class="mb-3">Basic Info</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-section">
                        <div class="form-group">
                            <label>Package Type</label>
                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check custom-radio">
                                            <input class="form-check-input" type="radio" name="packageType" id="sat1" value="SAT 1" {{ old('packageType', $package->package_type) === 'SAT 1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sat1">SAT 1</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check custom-radio">
                                            <input class="form-check-input" type="radio" name="packageType" id="sat2" value="SAT 2" {{ old('packageType', $package->package_type) === 'SAT 2' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sat2">SAT 2</label>
                                        </div>
                                    </div>
                                </div>
                                @error('packageType')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group" id="audienceSection" style="display: {{ old('packageType', $package->package_type) === 'SAT 1' ? 'block' : 'none' }};">
                            <label>Audience</label>
                            <div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check custom-radio">
                                            <input class="form-check-input" type="radio" name="audience" id="highSchool" value="High School" {{ old('audience', $package->audience) === 'High School' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="highSchool">High School</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check custom-radio">
                                            <input class="form-check-input" type="radio" name="audience" id="college" value="College" {{ old('audience', $package->audience) === 'College' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="college">College</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check custom-radio">
                                            <input class="form-check-input" type="radio" name="audience" id="graduate" value="Graduate" {{ old('audience', $package->audience) === 'Graduate' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="graduate">Graduate</label>
                                        </div>
                                    </div>
                                </div>
                                @error('audience')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-flex align-content-center">
                                <label>Package Status</label>
                                <div class="ml-3">
                                    <input type="checkbox" class="highlight" name="highlight" id="highlight" {{ old('highlight', $package->highlight_status) ? 'checked' : '' }}>
                                    <label for="highlight">Highlight this package</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="packageStatus" id="active" value="Active" {{ old('packageStatus', $package->status ? 'Active' : 'Inactive') === 'Active' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="packageStatus" id="inactive" value="Inactive" {{ old('packageStatus', $package->status ? 'Active' : 'Inactive') === 'Inactive' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inactive">Inactive</label>
                                    </div>
                                </div>
                            </div>
                            @error('packageStatus')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="planTitle">Plan Title</label>
                            <input type="text" class="form-control" id="planTitle" name="planTitle" value="{{ old('planTitle', $package->title) }}" placeholder="Enter description here">
                            @error('planTitle')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $package->description) }}" placeholder="Enter description here">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <h5 class="mb-3 mt-3">Pricing Configuration</h5>
                    <div class="form-section">
                        <div class="form-group">
                            <label for="promotionalBadge">Promotional Badge</label>
                            <div class="d-flex align-items-center">
                                <input type="text" class="form-control" id="promotionalBadge" name="promotionalBadge" value="{{ old('promotionalBadge', $package->promotional_badge ? $package->promotional_badge . '%' : '') }}" placeholder="E.g. Save 15%">
                                <div class="ml-3">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="highlight_badge" {{ old('highlight_badge', $package->highlight_badge) ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            @error('promotionalBadge')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pricing">Pricing</label>
                            <input type="text" class="form-control" id="pricing" name="pricing" value="{{ old('pricing', $package->price) }}" placeholder="SAR NNNN.NN">
                            @error('pricing')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pricingTerms">Pricing Terms</label>
                            <input type="text" class="form-control" id="pricingTerms" name="pricingTerms" value="{{ old('pricingTerms', $package->terms_per_month) }}" placeholder="e.g. per user per month">
                            @error('pricingTerms')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check custom-radio" style="background-color: transparent !important; border:none">
                                        <input class="form-check-input" type="radio" name="pricingTermRadio" id="yearly" value="Yearly" {{ old('pricingTermRadio', $package->pricing_terms) === 'yearly' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="yearly">Yearly</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check custom-radio" style="background-color: transparent !important; border:none">
                                        <input class="form-check-input" type="radio" name="pricingTermRadio" id="monthly" value="Monthly" {{ old('pricingTermRadio', $package->pricing_terms) === 'monthly' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="monthly">Monthly</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check custom-radio" style="background-color: transparent !important; border:none">
                                        <input class="form-check-input" type="radio" name="pricingTermRadio" id="threeMonths" value="3-Month" {{ old('pricingTermRadio', $package->pricing_terms) === '3month' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="threeMonths">3-Month</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check custom-radio" style="background-color: transparent !important; border:none">
                                        <input class="form-check-input" type="radio" name="pricingTermRadio" id="sixMonths" value="6-Month" {{ old('pricingTermRadio', $package->pricing_terms) === '6month' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sixMonths">6-Month</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check custom-radio" style="background-color: transparent !important; border:none">
                                        <input class="form-check-input" type="radio" name="pricingTermRadio" id="other" value="Other" {{ old('pricingTermRadio', $package->pricing_terms) === 'others' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="text" class="form-control mt-2" name="other_description" value="{{ old('other_description', $package->other_description) }}" placeholder="If other, please describe">
                                @error('other_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @error('pricingTermRadio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="validity">Validity (months)</label>
                            <input type="text" class="form-control" id="validity" name="validity" value="{{ old('validity', $package->validity) }}">
                            @error('validity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4 border-top p-3">
            <a href="{{ route('packages.index') }}" type="button" class="btn btn-outline-secondary btn-cancel mr-2">Cancel</a>
            <button type="submit" class="btn btn-primary btn-action">Update Package</button>
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
            .custom-radio .form-check-input:checked ~ .form-check {
                background-color: #F1E9F0;
                border-color: #A16A99;
            }
            .form-check-input:checked {
                background-color: #732066 !important;
                border-color: #732066 !important;
                margin: 2px;
            }
            .form-check-input:checked + .form-check-label {
                color: #344054;
                font-weight: 500;
            }
            .form-check:hover {
                border-color: #732066;
            }
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
            .custom-radio .form-check-input:checked + .form-check-label::before {
                border-color: #732066;
                background-color: #732066;
                box-shadow: 0 0 0 2px white, 0 0 0 4px #732066;
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
            .input:checked + .slider {
                background-color: #079455;
            }
            .input:checked + .slider:before {
                transform: translateX(20px);
            }
            .text-danger {
                font-size: 0.875rem;
                margin-top: 0.25rem;
                color: red !important;
                font-weight: bold;
            }
            .alert-danger {
                background-color: #f8d7da;
                border-color: #f5c6cb;
                color: #721c24;
                padding: 10px;
                border-radius: 5px;
                margin-bottom: 20px;
            }
        </style>
    @endpush
    @push('js')
        <script>
            document.querySelectorAll('input[name="packageType"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    var audienceSection = document.getElementById('audienceSection');
                    var audienceInputs = document.querySelectorAll('input[name="audience"]');
                    if (this.value === 'SAT 1') {
                        audienceSection.style.display = 'block';
                        audienceInputs.forEach(input => input.required = true);
                    } else {
                        audienceSection.style.display = 'none';
                        audienceInputs.forEach(input => {
                            input.required = false;
                            input.checked = false;
                        });
                    }
                });
            });

            document.querySelector('input[name="packageType"]:checked').dispatchEvent(new Event('change'));
        </script>
    @endpush
</x-backend.layouts.master>