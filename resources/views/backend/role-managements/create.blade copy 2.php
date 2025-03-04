<x-backend.layouts.master>

    <x-backend.layouts.partials.blocks.contentwrapper 
    :headerTitle="'
        <a href=\'\roles\' class=\'text-dark\'>
            <i class=\'fa-solid fa-angle-left mr-2\'></i> Create Role
        </a>
    '"
    :prependContent="'
        
    '">
</x-backend.layouts.partials.blocks.contentwrapper>

<div class="container">
    <h2>Create Role</h2>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Role Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <h4>Permissions</h4>
        <input type="checkbox" id="select-all"> <label for="select-all">Select All</label>

        @foreach($controllers as $controller => $methods)
            <div class="card my-3">
                <div class="card-header">
                    <input type="checkbox" class="controller-select" data-controller="{{ $controller }}">
                    <b>{{ $controller }}</b>
                </div>
                <div class="card-body">
                    @foreach($methods as $method)
                        <div class="form-check">
                            <input type="checkbox" name="permissions[{{ $controller }}][]" value="{{ $method }}" class="form-check-input method-select" data-controller="{{ $controller }}">
                            <label class="form-check-label">{{ $method }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Save Role</button>
    </form>
</div>



@push('css')
    <style>
        .all-checkbox {
            width: 20px;
            height: 20px;
            border: 1px solid #D0D5DD !important;
            appearance: none; /* Removes default checkbox styling */
            background-color: white;
            cursor: pointer;
            border-radius: 4px !important; /* Optional: for rounded corners */
        }

        /* Checked state */
        .all-checkbox:checked {
            background-color: #3F1239; /* Change the background color when checked */
            position: relative;
        }

        /* Adding a custom checkmark */
        .all-checkbox:checked::after {
            content: '-'; /* Unicode checkmark */
            font-size: 12px;
            color: white; /* Checkmark color */
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .checkbox {
            width: 20px;
            height: 20px;
            border: 1px solid #D0D5DD !important;
            appearance: none; /* Removes default checkbox styling */
            background-color: white;
            cursor: pointer;
            border-radius: 4px !important; /* Optional: for rounded corners */
        }

        /* Checked state */
        .checkbox:checked {
            background-color: #3F1239; /* Change the background color when checked */
            position: relative;
        }

        /* Adding a custom checkmark */
        .checkbox:checked::after {
            content: '✓'; /* Unicode checkmark */
            font-size: 12px;
            color: white; /* Checkmark color */
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }
    </style>
@endpush

@push('js')
<script>
    document.getElementById('select-all').addEventListener('change', function() {
        document.querySelectorAll('.method-select').forEach(el => el.checked = this.checked);
    });
    
    document.querySelectorAll('.controller-select').forEach(controllerCheckbox => {
        controllerCheckbox.addEventListener('change', function() {
            let controller = this.getAttribute('data-controller');
            document.querySelectorAll(`.method-select[data-controller="${controller}"]`).forEach(el => el.checked = this.checked);
        });
    });
    </script>
@endpush


</x-backend.layouts.master>