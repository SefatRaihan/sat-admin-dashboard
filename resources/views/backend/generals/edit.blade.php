<x-backend.layouts.master>
    <x-slot name="page_title">
        Generals
    </x-slot>
    <x-slot name="breadcrumb">
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader">
                Generals
            </x-slot>
            <x-slot name="add">
            </x-slot>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" style="text-decoration: none; color:#6c757d">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('generals.index') }}" style="text-decoration: none; color:#6c757d">Generals</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <div class="d-flex justify-general-between">
                <span><i class="fas fa-table me-1"></i>General Edit</span>
            </div>
        </div>
        <div class="card-body">
            <x-backend.layouts.elements.errors :errors="$errors"/>
            <form action="{{ route('generals.update', ['general' => $general->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')

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
                            <input type="text" id="title" name="title" class="form-control mt-2" placeholder="Enter Title" value="{{ old('title', $general->title) }}">
                            @error("title")
                                <span class="sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4 mb-0 d-flex justify-general-end">
                    <button onclick="return confirm('Are you sure want to update?')" type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center text-muted">
            <a class="btn btn-success text-white btn-sm" href="{{ route('generals.index') }}" role="button" style="border-radius: 50%"><i class="fas fa-list"></i></a>
        </div>
    </div>

</x-backend.layouts.master>
