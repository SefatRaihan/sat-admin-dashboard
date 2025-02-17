        		{{-- <!-- Right sidebar -->
                <div class="sidebar sidebar-light sidebar-right sidebar-expand-md">

                    <!-- Sidebar mobile toggler -->
                    <div class="sidebar-mobile-toggler text-center">
                        <a href="#" class="sidebar-mobile-expand">
                            <i class="icon-screen-full"></i>
                            <i class="icon-screen-normal"></i>
                        </a>
                        <span class="font-weight-semibold">Right Sidebar</span>
                        <a href="#" class="sidebar-mobile-right-toggle">
                            <i class="icon-arrow-right8"></i>
                        </a>
                    </div>
                    <!-- /sidebar mobile toggler -->


                    <!-- Sidebar content -->
                    <div class="sidebar-content">
                        @foreach($contents as $content_component)
                            <x-dynamic-component :component="$content_component" />
                        @endforeach
                    </div>
                    <!-- /sidebar content -->

                </div>
                <!-- /right sidebar --> --}}
