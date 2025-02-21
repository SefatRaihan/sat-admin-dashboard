<x-slot name="contentWrapper">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title p-3 d-flex">
                <h4>
                    <span class="font-weight-semibold header-title">
                        {!! $headerTitle ?? 'Default Title' !!}  
                    </span>
                </h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none">

                <div class="d-flex justify-content-end notification-section">
                    
                    {{-- এখানে নতুন কন্টেন্ট অ্যাপেন্ড করুন --}}
                    {!! $prependContent ?? '' !!}  

                    <div class="position-relative">
                        <div class="d-flex align-items-center justify-content-center" 
                             style="height: 40px; width:40px; border:1px solid #EAECF0; border-radius:20px; background-color: #F9FAFB">
                            <img src="{{ asset('image/icon/notification-2.png') }}" alt="">
                        </div>
                        <!-- Notification Badge -->
                        <span class="notification-badge"></span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-slot>
