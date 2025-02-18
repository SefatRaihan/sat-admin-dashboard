<x-backend.layouts.master>

    <x-backend.layouts.partials.blocks.contentwrapper 
    :headerTitle="'Notification'"
    :prependContent="'
        <a href=\'/notification/create\' class=\'btn d-flex btn-link btn-float font-size-sm mr-3 font-weight-semibold text-default legitRipple ml-2 text-white btn-sm\' style=\'background-color:#732066;padding: 7px .875rem !important; font-size:12px; border-radius:8px\'>
            <i class=\'fas fa-plus\' style=\'font-size: 12px; margin-right: 5px; margin-top: 5px;\'></i> Create Role
        </a>
    '">
</x-backend.layouts.partials.blocks.contentwrapper>

<div class="flex flex-col items-center align-content-center justify-center min-h-screen" style="height: 90vh">
    <div class="text-center" style="position: relative">
        <img src="{{ asset('image/loading.png') }}" alt="Loading Image" class="mb-4" style="opacity: 0.4">
        <div class="text-section">
            <h2 class="text-xl font-semibold" style="font-size: 24px; font-weight:900px"><b>You have not created any Role yet</b></h2>
            <p style="color: #475467; font-size:16px">Let’s create a role now</p>
            <a href="/roles/create" 
            class="btn text-default ml-2 text-white" 
            style="background-color:#732066; font-size: 12px; border-radius: 8px;">
                <i class="fas fa-plus" style="font-size: 12px;"></i> Create Role
            </a>

        </div>
    </div>
</div>

@push('css')
    <style>
        .text-section {
            position: absolute;
            top: 54%;
            left: 38%;
        }
    </style>
@endpush

</x-backend.layouts.master>