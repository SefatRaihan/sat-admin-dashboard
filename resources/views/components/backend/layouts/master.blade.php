<!DOCTYPE html>
<html lang='{{ str_replace(' _', '-' , app()->getLocale()) }}'>

<head>
    <x-backend.layouts.partials.meta />
    <x-backend.layouts.partials.title />
    <x-backend.layouts.partials.favicon />
    <x-backend.layouts.libs.style />
    <style>
        .bg-teal-800 {
            background-color: #354F52 !important;
        }

        .select2-selection--single {
            padding: 0.5rem;
            border: 1px solid #ddd !important;
        }

        .select2-selection--single .select2-selection__arrow:after {
            right: 13px !important;
        }

        .form-control {
            padding: 0.5rem;
        }

        @media (min-width: 768px) {
            .sidebar-xs .sidebar-main .nav-sidebar>.nav-item>.navbar-nav-link>span {
                display: none;
            }
        }

        .search-container {
            position: relative;
        }

        .search-icon {
            position: absolute;
            top: 50%;
            left: 10px;
            right: 10px;
            transform: translateY(-50%);
            color: #fff;
        }

        #search-input {
            padding-left: 30px;
            background-color: #453043;
            height: calc(2.25rem + 15px);
            font-size: 19px;
            color: #fff;
            border: 1px solid #8c8484;
            border-radius: 7px;
        }
        #search-input::placeholder {
            color: white;
            padding-left: 10px;
        }
        .sidebar-light .nav-sidebar .nav-link {
            color: #fff;
        }

        .sidebar-light .nav-sidebar>.nav-item-open>.nav-link:not(.disabled), .sidebar-light .nav-sidebar>.nav-item>.nav-link.active {
            background-color: #453043;
            color: #fff;
            border-radius: 9px;
        }

        .nav-link:hover {
            background-color: #453043;
            color: #fff;
            border-radius: 9px;
            /* margin-left: 10px; */
        }

        .active {
            border-radius: 9px;
            margin-left: 6px;
        }

        .nav-link {
            border-radius: 9px;
        }

        .sidebar-light .nav-sidebar .nav-link {
            color: #fff;
            margin-right: 9px;
        }

        .nav-sidebar .nav-link i {
            margin-right: 1.25rem;
            margin-top: .12502rem;
            margin-bottom: .12502rem;
            top: 7px;
        }


        .sidebar-light .nav-sidebar .nav-link {
            color: #EBD0F4;
            margin-right: 9px;
            font-size: 16px;
            font-weight: 400 !important;
            align-items: center
        }

        .btn {
            padding: 11px .875rem !important;
        }

        body {
            background-color: #fffcff;
        }
    </style>
    <!-- Tagify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    {{-- <x-backend.layouts.partials.blocks.header /> --}}


    <div class="page-content pt-0">
        <x-backend.layouts.partials.blocks.sidebar />
        <!-- Main content -->
        <div class="content-wrapper">

            {{ $contentWrapper ?? ''}}

            <div class="content">
                {{ $slot }}
            </div>
        </div>
        <!-- / Main content -->
    </div>

    {{-- <x-backend.layouts.partials.blocks.footer /> --}}
    <x-backend.layouts.libs.js />
    <script>
        $(document).ready(function () {
            $('select').select2();
        });
    </script>
    <script src="https://cdn.tiny.cloud/1/3dymgiuzyi2o390gh5jgcv47chk7fkpd04eci1k99gdwoai7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>
    <script>
        $('textarea#tiny').tinymce({
        height: 250,
        menubar: false,
        plugins: [
            'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
            'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
            'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
        });
    </script>

    <!-- Tagify JS -->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
</body>

</html>