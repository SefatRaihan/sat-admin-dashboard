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
            /* padding: 11px .875rem !important; */
            text-transform: capitalize !important;
        }

        body {
            background-color: #fffcff;
        }

        .notification-badge {
            position: absolute;
            top: 7px;
            right: 8px;
            width: 10px;
            height: 10px;
            background-color: #D92D20;
            border-radius: 50%;
            border: 1px solid white;
        }

        input {
            border-radius: 8px !important;
        }

        select {
            border-radius: 8px !important;
        }

        textarea {
            border-radius: 8px !important;
        }

        input[readonly] {
            background-color: #F9FAFB !important;
            border: 1px solid #EAECF0;
            color: #333;
            cursor: not-allowed;
            border-bottom: 0px solid !important;
        }

        .select2-selection--single {
            padding: 0.5rem;
            border: 1px solid #ddd !important;
            border-radius: 8px !important;;
        }
        .rotated {
            display: flex;
            flex-direction: column; /* আইকন দুটি উপর-নিচ থাকবে */
            align-items: center; /* কেন্দ্রবিন্দুতে রাখবে */
            margin-top: 4px;
            margin-right: 6px;
        }

        .rotated i {
            font-size: 6px; /* উভয় আইকনের সমান আকার */
        }

        .btn-group-sm>.btn, .btn-sm {
            padding: .375rem .575rem;
            font-size: .75rem;
            line-height: 1.6667;
            border-radius: .125rem;
        }

        .btn-color {
            background-color: #3F1239;
            color: #fff;
        }
        .swal2-icon.swal2-warning:before {
            content: "";
        }
        .swal2-icon.swal2-error:before {
            content: "";
        }
        .swal2-icon.swal2-success:before {
            content: "";
        }
        .swal2-icon.swal2-warning {
            font-size: 11px;
        }
        .swal2-icon.swal2-error {
            font-size: 11px;
        }
        .swal2-icon.swal2-success {
            font-size: 11px;
        }
        .swal2-icon.swal2-success [class^="swal2-success-line"][class$="tip"] {
            height: 0 !important;
            border-right: 0.25rem solid #a5dc86 !important;
            border-top: 0.25rem solid #a5dc86 !important;
        }
        .swal2-icon.swal2-success [class^=swal2-success-line][class$=tip] {
            top: 28px !important;
            left: 10px !important;
            width: 1.5625em !important;
        }
        .content-wrapper {
            overflow: hidden;
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
            // $('select').select2();
        });
    </script>
    {{-- <script src="https://cdn.tiny.cloud/1/3dymgiuzyi2o390gh5jgcv47chk7fkpd04eci1k99gdwoai7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script> --}}
    {{-- <script>
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
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tagify JS -->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
</body>

</html>