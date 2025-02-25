<x-backend.layouts.master>
    <x-slot name="page_title">
        Generals
    </x-slot>

    <x-backend.layouts.partials.blocks.contentwrapper 
        :headerTitle="'Generals'"
        :prependContent="'
            <a href=\'/generals\' class=\'btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                <i class=\'fas fa-list\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> List
            </a>
        '">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div class="card mb-4">
        <div class="card-header text-white" style="background-color: #3F1239;">
            <div class="d-flex justify-general-between">
                <span><i class="fas fa-table me-1"></i> General Create</span>
            </div>
        </div>
        <div class="card-body">
            <x-backend.layouts.elements.errors :errors="$errors"/>
            <form action="{{ route('generals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-3">
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
                    <button type="submit" class="btn btn-color">Save</button>
                </div>
            </form>
        </div>
    </div>


</x-backend.layouts.master>
