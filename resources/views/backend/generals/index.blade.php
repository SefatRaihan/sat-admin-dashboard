<x-backend.layouts.master>
    <x-slot name="page_title">
        Generals
    </x-slot>

    <x-backend.layouts.partials.blocks.contentwrapper 
        :headerTitle="'Generals'"
        :prependContent="'
            <a href=\'/generals/create\' class=\'btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
                <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Create Generals
            </a>
        '">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div class="card mb-4">
        <div class="card-header text-white" style="background-color: #3F1239;">
            <div class="d-flex justify-general-between">
                <span><i class="fas fa-table me-1"></i> Generals</span>
            </div>
        </div>
        <div class="card-body pt-3">
            <x-backend.layouts.elements.message :message="session('message')"/>

            <table id="myTable" class="display table table-bordered" style="padding-top:20px">
                <thead>
                    <tr class="text-white" style="background-color: #3F1239;">
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
                                <a class="btn btn-sm btn-warning" href="{{ route('generals.edit',['general' => $general->uuid]) }}" role="button" style="border-radius: 50%"><i class="fas fa-pen-nib text-white"></i></a>
                                <form style="display: inline;" action="{{ route('generals.destroy', ['general'=>$general->uuid]) }}" method="POST">
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
    </div>

</x-backend.layouts.master>



