@if (count($categories) > 0)
    <!-- Loop Category -->
    <ul class="directory-list sortable">
        @foreach ($categories as $category)
            <li class="folder">
                <div>{{ $category->translation->product_category_name }}</div>
                @if (count($category->child) > 0)
                    <!--Recursion Child Category-->
                    @include('backend.category._recursion-tree', ['categories' => $category->child])
                    <!--End Recursion Child Category-->
                @endif
            </li>
        @endforeach
    </ul>
    <!-- End Loop Category-->
@else
<div class="not-info-wrapper text-center">
    <div class="icon">
        <i class="fas fa-box-open"></i>
    </div>
    <h5>There's no categories to display!</h5>
</div>
@endif

