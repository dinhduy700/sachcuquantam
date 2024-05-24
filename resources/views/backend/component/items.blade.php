<div class="d-flex align-items-center justify-content-between">
    Show
    <select class="form-select rounded-0 ml-1 mr-1" id="filter-page-items">
        @foreach(config('constants.itemsOption') as $pageOption)
        <option value={{ $pageOption }} @if($pageOption==Request::get('items')) selected @endif>
            {{ $pageOption }}
        </option>
        @endforeach
    </select>
    entries
</div>


<div class="col-auto p-0">
    <span style="color: rgb(128, 128, 128);">
        Showing {{ ($items->currentPage() - 1) * $items->perPage() + ($items->total() ? 1 : 0) }}
        to {{ ($items->currentPage() - 1) * $items->perPage()+count($items) }}
        of {{ $items->total() }}
        entries</span>
</div>