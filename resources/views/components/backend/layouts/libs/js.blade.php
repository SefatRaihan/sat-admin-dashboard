<div id="jsLibContainer">

    <!-- Core JS files -->
    <script id="jquery" src="{{ asset('/ui/backend') }}/global_assets/js/main/jquery.min.js"></script>
    <script id="bootstrap_bundle" src="{{ asset('/ui/backend') }}/global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script id="blockui" src="{{ asset('/ui/backend') }}/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script id="ripple" src="{{ asset('/ui/backend') }}/global_assets/js/plugins/ui/ripple.min.js"></script>


    <!--alpaca forms -->
    <script id="handlebar" src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/inputs/typeahead/handlebars.min.js"></script>
    <script id="alpaca" src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/inputs/alpaca/alpaca.min.js"></script>
    <script id="prism" src="{{ asset('/ui/backend') }}/global_assets/js/plugins/ui/prism.min.js"></script>
    <script id="select2" src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script id="bootstrap_multiselect" src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script id="price_format" src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/inputs/alpaca/price_format.min.js"></script>
    <script id="uniform" src="{{ asset('/ui/backend') }}/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script id="datatables" src="{{ asset('/ui/backend') }}/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script id="theme" src="{{ asset('/ui/backend') }}/assets/js/app.js"></script>
    <script src ="{{ asset('/ui/backend') }}/assets/js/utility.js"></script>

    <!-- /core JS files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js" integrity="sha512-eV68QXP3t5Jbsf18jfqT8xclEJSGvSK5uClUuqayUbF5IRK8e2/VSXIFHzEoBnNcvLBkHngnnd3CY7AFpUhF7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script id="toast-msg" src="{{ asset('/ui/backend') }}/global_assets/js/plugins/notifications/noty.min.js"></script>
    <script id="sweet-alert" src="{{ asset('/ui/backend') }}/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script id="sweet-alert" src="{{ asset('/ui/backend') }}/global_assets/js/plugins/notifications/sweetalert2.min.js"></script>
    <script id="flash-msg" src="{{ asset('/ui/backend') }}/assets/js/flash-message.js"></script>
	<script id="css3-animation" src="{{ asset('/ui/backend') }}/global_assets/js/demo_pages/animations_css3.js"></script>

    @stack('js')
</div>

