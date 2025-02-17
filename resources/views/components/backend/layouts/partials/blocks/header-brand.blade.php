<div class="navbar-brand wmin-0 p-0 m-0 mt-2 mr-1">
    <a href="{{$url}}" class="d-inline-block">
        @if(!is_null($header_brand))
            <img src="/{{$header_brand}}" alt="{{$header_brand_title}}" title="{{$header_brand_title}}" style="width: 100%; height:30px; padding:0;margin:0">
        @else
            <h4 style="width: 100%; padding:0;margin:0"><span class="text-white text-uppercase border-white border-2 rounded p-1">{{count(explode('.',$_SERVER['SERVER_NAME'])) > 0 ? explode('.',$_SERVER['SERVER_NAME'])[0] : 'Brand Logo' }}</span></h4>
        @endif
    </a>
</div>
