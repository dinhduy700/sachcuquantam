<ul class="sortable">
    @foreach ($categories as $category)
        <li>
            <div>{{ $category->translation->product_category_name }}</div>
            
            @if (count($category->child) > 0)
                @include('backend.category._recursion-tree', ['categories' => $category->child])
            @endif
        </li>
    @endforeach
</ul>
