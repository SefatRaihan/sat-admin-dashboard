{{-- <!-- Header Start -->
<div class="breadcrumb-line breadcrumb-line-light bg-light header-elements-md-inline">
    <div class="header-elements d-none">
        @foreach($left as $left_component)
            <x-dynamic-component :component="$left_component" />
        @endforeach
    </div>
    <div class="header-elements d-flex">
        @foreach($center as $center_component)
            <x-dynamic-component :component="$center_component" />
        @endforeach
    </div>

    <div class="header-elements d-flex">
        @foreach($right as $right_component)
            <x-dynamic-component :component="$right_component" />
        @endforeach

        <a href="#" class="header-elements-toggle text-default d-md-none">
            <i class="icon-more"></i>
        </a>
    </div>
</div>
 <!-- Header End --> --}}
