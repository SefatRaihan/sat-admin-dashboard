```blade
<x-backend.layouts.master>
    <div class="package">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <ul class="nav nav-pills custom-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="all-package-tab" data-toggle="tab" href="#all-package" role="tab" aria-controls="all-package" aria-selected="true">All Package</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="hi-school-tab" data-toggle="tab" href="#hi-school" role="tab" aria-controls="hi-school" aria-selected="false">Hi School</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="college-tab" data-toggle="tab" href="#college" role="tab" aria-controls="college" aria-selected="false">College</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="graduate-tab" data-toggle="tab" href="#graduate" role="tab" aria-controls="graduate" aria-selected="false">Graduate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="sat2-tab" data-toggle="tab" href="#sat2" role="tab" aria-controls="sat2" aria-selected="false">SAT2</a>
                </li>
            </ul>

            <a href="{{ route('packages.create') }}" class="btn add-package-btn">+ Add Package</a>
        </div>

        <div class="tab-content" id="myTabContent">
            <!-- All Packages Tab -->
            <div class="tab-pane fade show active" id="all-package" role="tabpanel" aria-labelledby="all-package-tab">
                <div class="row mt-4">
                    @forelse ($allPackages as $package)
                        <div class="col-md-4 mb-4">
                            <div class="card pricing-card h-100 {{ $package->highlight_Status ? 'active save-card' : '' }}">
                                @if ($package->highlight_badge)
                                    <div class="save-badge">Save {{ $package->promotional_badge }}%</div>
                                @endif
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title">{{ $package->title }}</h5>
                                        <p class="card-text text-muted">{{ $package->description ?? 'Perfect for starting your journey' }}</p>
                                        <h2 class="price">{{ number_format($package->price, 2) }} <span class="currency">SAR</span></h2>
                                        <p class="per-user">{{ $package->terms_per_month ?? 'Per user per month' }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('packages.edit', $package->uuid) }}" class="btn btn-primary btn-block configure-btn">Configure Package</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <p>No packages available.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- High School Tab -->
            <div class="tab-pane fade" id="hi-school" role="tabpanel" aria-labelledby="hi-school-tab">
                <div class="row mt-4">
                    @forelse ($highSchools as $package)
                        <div class="col-md-4 mb-4">
                            <div class="card pricing-card h-100 {{ $package->highlight_Status ? 'active save-card' : '' }}">
                                @if ($package->highlight_badge)
                                    <div class="save-badge">Save {{ $package->promotional_badge }}%</div>
                                @endif
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title">{{ $package->title }}</h5>
                                        <p class="card-text text-muted">{{ $package->description ?? 'Perfect for starting your journey' }}</p>
                                        <h2 class="price">{{ number_format($package->price, 2) }} <span class="currency">SAR</span></h2>
                                        <p class="per-user">{{ $package->terms_per_month ?? 'Per user per month' }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('packages.edit', $package->uuid) }}" class="btn btn-primary btn-block configure-btn">Configure Package</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <p>No High School packages available.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- College Tab -->
            <div class="tab-pane fade" id="college" role="tabpanel" aria-labelledby="college-tab">
                <div class="row mt-4">
                    @forelse ($colleges as $package)
                        <div class="col-md-4 mb-4">
                            <div class="card pricing-card h-100 {{ $package->highlight_Status ? 'active save-card' : '' }}">
                                @if ($package->highlight_badge)
                                    <div class="save-badge">Save {{ $package->promotional_badge }}%</div>
                                @endif
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title">{{ $package->title }}</h5>
                                        <p class="card-text text-muted">{{ $package->description ?? 'Perfect for starting your journey' }}</p>
                                        <h2 class="price">{{ number_format($package->price, 2) }} <span class="currency">SAR</span></h2>
                                        <p class="per-user">{{ $package->terms_per_month ?? 'Per user per month' }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('packages.edit', $package->uuid) }}" class="btn btn-primary btn-block configure-btn">Configure Package</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <p>No College packages available.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Graduate Tab -->
            <div class="tab-pane fade" id="graduate" role="tabpanel" aria-labelledby="graduate-tab">
                <div class="row mt-4">
                    @forelse ($graduates as $package)
                        <div class="col-md-4 mb-4">
                            <div class="card pricing-card h-100 {{ $package->highlight_Status ? 'active save-card' : '' }}">
                                @if ($package->highlight_badge)
                                    <div class="save-badge">Save {{ $package->promotional_badge }}%</div>
                                @endif
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title">{{ $package->title }}</h5>
                                        <p class="card-text text-muted">{{ $package->description ?? 'Perfect for starting your journey' }}</p>
                                        <h2 class="price">{{ number_format($package->price, 2) }} <span class="currency">SAR</span></h2>
                                        <p class="per-user">{{ $package->terms_per_month ?? 'Per user per month' }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('packages.edit', $package->uuid) }}" class="btn btn-primary btn-block configure-btn">Configure Package</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <p>No Graduate packages available.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- SAT2 Tab -->
            <div class="tab-pane fade" id="sat2" role="tabpanel" aria-labelledby="sat2-tab">
                <div class="row mt-4">
                    @forelse ($sat2 as $package)
                        <div class="col-md-4 mb-4">
                            <div class="card pricing-card h-100 {{ $package->highlight_Status ? 'active save-card' : '' }}">
                                @if ($package->highlight_badge)
                                    <div class="save-badge">Save {{ $package->promotional_badge }}%</div>
                                @endif
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title">{{ $package->title }}</h5>
                                        <p class="card-text text-muted">{{ $package->description ?? 'Perfect for starting your journey' }}</p>
                                        <h2 class="price">{{ number_format($package->price, 2) }} <span class="currency">SAR</span></h2>
                                        <p class="per-user">{{ $package->terms_per_month ?? 'Per user per month' }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('packages.edit', $package->uuid) }}" class="btn btn-primary btn-block configure-btn">Configure Package</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <p>No SAT2 packages available.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            .package .nav-pills {
                margin-bottom: 1.25rem;
                border: 1px solid #EAECF0;
                padding: 4px;
                border-radius: 25px;
                padding-left: 0px;
            }
            .package .nav-pills .nav-link.active {
                color: #fff;
                background-color: #691D5E !important;
                border-radius: 25px;
            }
            .package .nav-link:hover {
                border: 1px solid #691D5E !important;
                color: #691D5E !important;
                border-radius: 25px !important;
                background: transparent !important;
            }
            .add-package-btn {
                background-color: #691D5E !important;
                color: #fff;
                border-radius: 8px;
            }
            .pricing-card {
                background-color: #FCFAFF !important;
                border: 1px solid #EAECF0;
                border-radius: 25px;
            }
            .configure-btn {
                background-color: #691D5E !important;
                color: #fff;
                border-radius: 8px;
            }
            .pricing-card h5 {
                font-size: 18px;
                font-weight: 600;
                padding-bottom: 0px;
                margin-bottom: 0px;
            }
            .pricing-card p {
                font-size: 14px;
                font-weight: 500;
                padding-bottom: 0px;
                color: #667085;
            }
            .pricing-card .price {
                color: #671E5A;
                font-size: 30px;
                font-weight: 400;
                padding-bottom: 0px;
                margin-bottom: 0px;
            }
            .pricing-card .currency {
                color: #727272;
                font-size: 30px;
                font-weight: 400;
                padding-bottom: 0px;
                margin-bottom: 0px;
            }
            .per-user {
                color: #050505 !important;
            }
            .pricing-card.active {
                border: 1px solid #A16A99 !important;
                background-color: #F1E9F0 !important;
                border-radius: 25px;
            }
            .pricing-card {
                position: relative;
            }
            .save-badge {
                position: absolute;
                right: 0 !important;
                top: 18px;
                background-color: #671E5A;
                border-radius: 25px;
                margin-right: 10px;
                color: #fff;
                padding: 4px;
                padding-left: 8px;
                padding-right: 8px;
            }
            .btn-danger {
                border-radius: 8px;
            }
        </style>
    @endpush
</x-backend.layouts.master>
```