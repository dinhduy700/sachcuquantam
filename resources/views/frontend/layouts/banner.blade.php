<div class="banner">
    <div class="list">
        <div id="slider-banner">
            @foreach($banners as $banner)
            <div class="item">
                @if($banner->translation->banner_link)
                <a href="{{$banner->translation->banner_link}}" title="{{$banner->translation->banner_title}}">
                @endif
                    <img src="{{asset($banner->translation->banner_image)}}" alt="{{$banner->translation->banner_title}}">
                @if($banner->translation->banner_link)
                </a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>