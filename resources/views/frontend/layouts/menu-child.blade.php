
<div class="menu-child">
    <ul>
        @foreach($categories as $key => $category)
        <li>
            <a href="{{ url('/'.
                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . 'collections/'.$category->translation->product_category_slug
                )  }}">{{$category->translation->product_category_name}}</a>
            @include('frontend.layouts.menu-child', ['categories' => $category->child])
        </li>
        @endforeach
    </ul>
</div>
