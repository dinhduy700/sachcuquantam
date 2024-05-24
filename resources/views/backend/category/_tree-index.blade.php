@if (count($categories) > 0)
<div class="pb-3">
    {{ __('app.categories.drag-drop-note') }}
</div>

<ul class="sortable list-unstyled" id="sortable">
    <!-- Loop Category -->
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
                        <button type="button" class="btn text-edit btn-remove" onClick="swalDeleteConfirm(this, '@lang('app.are_you_sure_delete')', '@lang('app.confirm_delete')')"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <ul class="sortable list-unstyled"></ul>
        @if (count($category->child) > 0)
            <!--Recursion Child Category-->
            @include('backend.category._recursion-tree-index', ['categories' => $category->child])
            <!--End Recursion Child Category-->
        @endif
    </li>
    @endforeach
    <!-- End Loop Category-->
</ul>
@else
<div class="not-info-wrapper text-center">
    <div class="icon">
        <i class="fas fa-box-open"></i>
    </div>
    <h5>There's no categories to display!</h5>
</div>
@endif
