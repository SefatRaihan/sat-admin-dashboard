<x-backend.layouts.master>
    <x-slot name="contentWrapper">
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title p-3 d-flex">
                    <h4><span class="font-weight-semibold">All Questions</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements d-none">
                    <div class="d-flex justify-content-end">
                        <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                            <button type="button" style="padding: 5px 15px; border:2px solid #D0D5DD; border-radius:10px; background-color: #FFFFFF; color:#344054; font-size: 1.2rem"><i class="fa-solid fa-cloud-arrow-up"></i> Upload Question</button>
                        </div>
                        <div class="d-flex align-items-center justify-content-center" style="margin-right: 10px">
                            <button type="button" style="padding: 5px 15px; border:2px solid #691D5E; border-radius:10px; background-color: #691D5E; color:#EAECF0; font-size: 1.2rem"><i class="fa-solid fa-plus"></i> Add Question</button>
                        </div>
                        <div class="d-flex align-items-center justify-content-center" style="height: 40px; width:40px; border:1px solid #EAECF0; border-radius:20px; background-color: #F9FAFB">
                            <img src="{{ asset('image/icon/notification-icon.png') }}" alt="">
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="breadcrumb">
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader">
                All Questions
            </x-slot>
            <x-slot name="add">

            </x-slot>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="text-decoration: none; color:#6c757d">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('generals.index') }}" style="text-decoration: none; color:#6c757d">Generals</a></li>
            <li class="breadcrumb-item active">Create</li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <div class="d-flex justify-general-between">
                <span><i class="fas fa-table me-1"></i>General Create</span>
            </div>
        </div>
        <div class="card-body">
            <x-backend.layouts.elements.errors :errors="$errors"/>
            <form action="{{ route('generals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" id="logo" name="logo" class="form-control mt-2" placeholder="Enter Logo" value="{{ old('logo') }}">
                            @error("logo")
                                <span class="sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="favicon_icon">Favicon Icon</label>
                            <input type="file" id="favicon_icon" name="favicon_icon" class="form-control mt-2" placeholder="Enter Favicon Icon" value="{{ old('favicon_icon') }}">
                            @error("favicon_icon")
                                <span class="sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" class="form-control mt-2" placeholder="Enter Title" value="{{ old('title') }}">
                            @error("title")
                                <span class="sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4 mb-0 d-flex justify-general-end">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center text-muted">
            <a class="btn btn-success text-white btn-sm" href="{{ route('generals.index') }}" role="button" style="border-radius: 50%"><i class="fas fa-list"></i></a>
        </div>
    </div>


</x-backend.layouts.master>
