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
            <li class="breadcrumb-item active">Show</li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <div class="d-flex justify-general-between">
                <span><i class="fas fa-table me-1"></i>General Show</span>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Title:</strong> {{ $general->title }}</p>

                    <p><strong>Logo:</strong>
                        <img src="{{ asset('storage/' . $general->logo) }}" alt="Image" class="img-thumbnail mt-2" width="100">
                    </p>
                    <p><strong>Favicon Icon:</strong>
                        <img src="{{ asset('storage/' . $general->favicon_icon) }}" alt="Image" class="img-thumbnail mt-2" width="100">
                    </p>
            </div>

        </div>
        <div class="card-footer text-center text-muted">
            <a class="btn btn-success text-white btn-sm" href="{{ route('generals.index') }}" role="button" style="border-radius: 50%"><i class="fas fa-list"></i></a>
        </div>
    </div>

    @push('js')

    @endpush
</x-backend.layouts.master>
