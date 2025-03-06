<x-backend.layouts.master>
    <x-backend.layouts.partials.blocks.contentwrapper 
        :headerTitle="'
            <a href=\'\roles\' class=\'text-dark\'>
                <i class=\'fa-solid fa-angle-left mr-2\'></i> Edit Role
            </a>
        '"
        :prependContent="''">
    </x-backend.layouts.partials.blocks.contentwrapper>

    <div>
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
            <div class="card-body">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="text-right">
                        <button type="submit" class="btn ml-2 text-white" style="background-color:#732066; border-radius:8px">
                            Update
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control role-name @error('name') is-invalid @enderror" name="name" value="{{ old('name', $role->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <div>
                            <h4><b>Features <span id="totalSelected">(0 Selected)</span></b></h4>
                        </div>
                        <div>
                            <input type="checkbox" class="all-checkbox all-select" id="select-all">  
                            <span style="color: #121926; font-size:16px">All Permissions</span>
                        </div>
                    </div>

                    <div class="row mt-2">
                        @foreach($controllers as $controller => $methods)
                        <div class="col-md-6">
                            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
                                <div class="card-header" style="background-color: #EAECF0">
                                    <input type="checkbox" class="checkbox controller-select" data-controller="{{ $controller }}">
                                    <b style="color: #121926; font-size:16px">{{ $controller }}</b>
                                </div>
                                <div class="card-body pt-3 table-responsive" style="height:300px">
                                    @foreach($methods as $method)
                                        <div class="form-check">
                                            <input type="checkbox" 
                                                   name="permissions[{{ $controller }}][]" 
                                                   value="{{ $method }}" 
                                                   class="form-check-input method-select checkbox" 
                                                   data-controller="{{ $controller }}"
                                                   {{ in_array($controller . '.' . $method, $rolePermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label" style="color: #121926; font-size:16px">{{ $method }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('css')
    <style>
        .all-checkbox {
            width: 20px;
            height: 20px;
            border: 1px solid #D0D5DD !important;
            appearance: none;
            background-color: white;
            cursor: pointer;
            border-radius: 4px !important;
        }

        .all-checkbox:checked {
            background-color: #3F1239;
            position: relative;
        }

        .all-checkbox:checked::after {
            content: '✓';
            font-size: 12px;
            color: white;
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
            appearance: none;
            background-color: white;
            cursor: pointer;
            border-radius: 4px !important;
        }

        .checkbox:checked {
            background-color: #3F1239;
            position: relative;
        }

        .checkbox:checked::after {
            content: '✓';
            font-size: 12px;
            color: white;
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
    document.addEventListener("DOMContentLoaded", function () {
        const checkboxes = document.querySelectorAll(".method-select");
        const totalSelectedSpan = document.getElementById("totalSelected");

        function updateTotalSelected() {
            const selectedCount = document.querySelectorAll(".method-select:checked").length;
            totalSelectedSpan.textContent = `(${selectedCount} Selected)`;
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", updateTotalSelected);
        });

        document.getElementById("select-all").addEventListener("change", function () {
            checkboxes.forEach(el => el.checked = this.checked);
            updateTotalSelected();
        });

        document.querySelectorAll(".controller-select").forEach(controllerCheckbox => {
            controllerCheckbox.addEventListener("change", function () {
                let controller = this.getAttribute("data-controller");
                document.querySelectorAll(`.method-select[data-controller="${controller}"]`).forEach(el => el.checked = this.checked);
                updateTotalSelected();
            });

            // Check if all methods under a controller are selected
            let controller = controllerCheckbox.getAttribute("data-controller");
            let allMethods = document.querySelectorAll(`.method-select[data-controller="${controller}"]`);
            let checkedMethods = document.querySelectorAll(`.method-select[data-controller="${controller}"]:checked`);
            controllerCheckbox.checked = allMethods.length === checkedMethods.length;
        });

        updateTotalSelected();
    });
    </script>
    @endpush
</x-backend.layouts.master>