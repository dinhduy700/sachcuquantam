<ul class="sortable list-unstyled">
    @foreach ($categories as $category)
        <li class="tree-element" tree-category={{ $category->id }} id="heading{{ $category->id }}">
            <div class="block block-title">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <span class="fw-bold me-3">{{ $category->translation->product_category_name }}</span>
                        <span>/{{ $category->translation->product_category_slug }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <a class="text-edit" href="{{ route('admin.categories.edit', ['category' => $category]) }}"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.categories.delete', $category->id) }}" method="post" class="form-delete edit">
                            @method('delete')
                            @csrf
                            <button type="button" class="btn text-edit btn-remove" onClick="swalDeleteConfirm(this,'@lang('app.are_you_sure_delete')', '@lang('app.confirm_delete')')"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <ul class="sortable list-unstyled"></ul>
            @if (count($category->child) > 0)
                @include('backend.category._recursion-tree-index', ['categories' => $category->child])
            @endif
        </li>
    @endforeach
</ul>
