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
                <li class="breadcrumb-item active">Generals</li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

<div class="card mb-4">
    <div class="card-header bg-success text-white">
        <div class="d-flex justify-general-between">
            <span><i class="fas fa-table me-1"></i>Generals</span>
        </div>
    </div>
    <div class="card-body">
        <x-backend.layouts.elements.message :message="session('message')"/>

        <table id="myTable" class="display table  table-bordered" style="padding-top:20px">
            <thead>
                <tr class="bg-success text-white">
                    <th>SL#</th>
                    <th class="text-center">Logo</th>
                    <th class="text-center">Favicon Icon</th>
                    <th class="text-center">Title</th>
                    <th class="text-center" width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($general != null)
                    @php
                        $sl = 0;
                    @endphp
                    <tr>
                        <td>{{ ++$sl }}</td>
                        <td class="text-center">
                            <img src="{{ asset('storage/' . $general->logo) }}" alt="Image" class="img-thumbnail mt-2" width="100">
                        </td>
                        <td class="text-center">
                            <img src="{{ asset('storage/' . $general->favicon_icon) }}" alt="Image" class="img-thumbnail mt-2" width="100">
                        </td>
                        <td class="text-center">{{ $general->title }}</td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-info" href="{{ route('generals.show',['general' => $general->id]) }}" role="button" style="border-radius: 50%"><i class="fas fa-eye text-white"></i></a>
                            <a class="btn btn-sm btn-warning" href="{{ route('generals.edit',['general' => $general->id]) }}" role="button" style="border-radius: 50%"><i class="fas fa-pen-nib text-white"></i></a>
                            <form style="display: inline;" action="{{ route('generals.destroy', ['general'=>$general->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('Are you sure want to delete ?')" class="btn btn-sm btn-danger" type="submit" style="border-radius: 50%"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="card-footer text-center text-muted">
        @if ($general == null)
            <a class="btn btn-sm btn-success text-left" href="{{ Route('generals.create') }}" role="button" style="border-radius: 50%"><i class="fas fa-plus"></i></a>
        @endif
    </div>
</div>

</x-backend.layouts.master>



