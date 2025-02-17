<div id="tree-card" class="card card-custom example example-compact gutter-b overlay overlay-block" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
    <div class="card-body">
        <div id="card-body-wrapper" class="overlay-wrapper">
            <div id="categories-tree" class="tree-demo"></div>
        </div>
        <div class="d-flex justify-content-center">
            <div id="spinner-container" class="overlay-layer bg-dark-o-10">
                <div class="spinner spinner-primary"></div>
            </div>
        </div>
    </div>
</div>


<link href="{{ asset('vendor/designer/plugins/custom/jstree/jstree.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendor/designer/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendor/designer/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendor/designer/css/custom-style.bundle.css') }}" rel="stylesheet" type="text/css" />


@push('css')
    <style>
        .text-success {
            color: #f7ca05 !important;
        }
        .jstree-default .jstree-wholerow-clicked {
            background: linear-gradient(to bottom, #1BC5BD 0%, #1BC5BD 100%) !important;
        }
    </style>
@endpush


@push('js')
<script>

    const HOST = window.location.origin + "{{ $apiURL }}";
    
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },

                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
   
</script>
    <script src="{{ asset('vendor/designer/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('vendor/designer/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('vendor/designer/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('vendor/designer/plugins/custom/jstree/jstree.bundle.js') }}"></script>
    <script src="{{ asset('vendor/designer/js/pages/features/miscellaneous/tree.js') }}">
    </script>
@endpush