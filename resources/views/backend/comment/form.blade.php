<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-lg-12">
                <!--General Information-->
                <div class="card">
                    <div class="card-header">
                        @lang('app.layouts.general-information')
                    </div>

                    <div class="card-body">
                        <!-- News Comment -->
                        @if (!empty(Request::get('filter')) && Request::get('filter') == 'news')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.comments.name')
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                {{ $comment->name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.comments.email')
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                {{ $comment->email }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.comments.news')
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                {{ $comment->news->news_title }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.comments.content')
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                {!! nl2br($comment->comment) !!}
                            </div>
                        </div>
                        <!-- End News Comment -->
                        @else
                        <!-- Product Review -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.comments.name')
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                {{ $comment->name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.comments.product')
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                {{ $comment->product->product_name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.comments.content')
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                {!! nl2br($comment->review_content) !!}
                            </div>
                            <div class="offset-2 col-sm-10" style="padding-left: 20px">
                                @if (count($comment->child) > 0)
                                    @foreach($comment->child as $reply)
                                    <div class="d-flex align-items-center" style="margin-top: 20px">
                                        <div>+ {!! nl2br($reply->review_content) !!} </div>
                                        <div>
                                            <form action="{{ route('admin.comments.delete', ['comment' => $reply]) }}" method="post" class="form-delete edit">
                                                @method('delete')
                                                @csrf
                                                <button type="button" class="btn text-edit btn-remove" onClick="swalDeleteConfirm(this, '@lang('app.are_you_sure_delete')', '@lang('app.confirm_delete')')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.comments.images')
                            </label>
                            <div class="offset-2 col-sm-10" style="padding-left: 20px">
                                @if (count($comment->arr_files) > 0)
                                    @foreach($comment->arr_files as $files)
                                        <img src="{{asset('storage/'.$files)}}" width="500">
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <form id="comment-save-form" method="post"
                            action="{{ route('admin.comments.update', ['comment' => $comment]) }}{{ !empty(Request::get('filter')) && Request::get('filter') == 'news' ? '?filter=news' : null }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">@lang('app.comments.reply')</label>
                                <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                    <textarea class="form-control" rows="5" name="review_content"></textarea>
                                </div>
                            </div>
                            <!-- End Product Review -->
                            @endif

                            <!--Approved-->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">@lang('app.layouts.active')</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-switch custom-switch">
                                        <input class="form-check-input form-switch-custom" type="checkbox"
                                            id="customActive" value="1" name="is_active"
                                            {{ empty($comment) || old('is_active', $comment->is_active) == config('constants.status.active') ? 'checked' : null }}>
                                        <label class="form-check-label" for="customActive"></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--End Approved-->
                    </div>
                </div>
                <!--End General Information-->
            </div>
        </div>
    </div>
</div>

@push('scripts')

@endpush