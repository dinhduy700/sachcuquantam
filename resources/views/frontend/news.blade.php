@section('title-page')
    {{ __('frontend.news_title') }}
@endsection
@section('seo')
    <meta name="description" content="{{$settings->translation->seo_description}}">
    <meta name="keywords" content="{{$settings->translation->seo_keywords}}">
    <meta property="og:title" content="{{$settings->translation->seo_title ?? ''}}" />
    <meta property="og:site_name" content="{{$settings->translation->seo_title ?? ''}}" />
    <meta property="og:description" content="{{$settings->translation->seo_description ?? ''}}" />
    <meta property="og:image" content="{{asset($settings->logo ?? 'assets/images/favicon.ico')}}" />
@endsection
@extends('frontend.layouts.master')
@section('content')
@include('frontend.layouts.banner', ['listBanner', array()])
<div class="news-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="news-left">
                    <div class="news-laster">
                        <div class="page-title">
                            <h2>{{__('frontend.recent_news')}}</h2>
                        </div>
                        <div class="news-list">
                            @foreach($newsN as $key => $value)
                            <div class="item">
                                <div class="img">
                                    <a href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.news').'/'. $value->translation->news_slug
                                )  }}" class="scale-img">
                                        <img src="{{asset($value->news_image)}}">
                                    </a>
                                </div>
                                <div class="info">
                                    <h3>
                                        <a href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.news').'/'. $value->translation->news_slug
                                )  }}">{{ $value->translation->news_title }}</a>
                                    </h3>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="news-tags">
                        <div class="page-title">
                            <h2>
                                Tags
                            </h2>
                        </div>
                        <div class="list-tags">
                            @foreach($tags as $tag)
                            <a class="item" href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.tags').'/'. $tag->translation->tag_slug
                                )  }}">{{ $tag->translation->tag_name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 margin-top-0 margin-bottom-30">
                @if(count($news) > 0)
                <div class="news-right">
                    <div class="list-news-page">
                        @foreach($news as $newsItem)
                        <div class="item">
                            <div class="img">
                                <a href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.news').'/'. $newsItem->translation->news_slug
                                )  }}" class="scale-img">
                                <img src="{{asset($newsItem->news_image)}}"></a>
                            </div>
                            <div class="info">
                                <div class="title">
                                    <h3><a href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.news').'/'. $newsItem->translation->news_slug
                                )  }}">{{ $newsItem->translation->news_title }}</a></h3>
                                </div>
                                <div class="posts">
                                    {{ date('d-m-Y H:i', strtotime($newsItem->news_publish)) }}
                                </div>
                                <p>
                                    {{ $newsItem->translation->news_description }}
                                </p>
                                <a href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.news').'/'. $newsItem->translation->news_slug
                                )  }}" class="view-more" title="Đọc tiếp">{{__('frontend.read_c')}}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="section pagenav clearfix a-center">
                        <nav class="clearfix relative nav-pagi">
                            {{ $news->links('vendor.pagination.bootstrap-4') }}
                        </nav>
                    </div>
                </div>
                @else
                    <div class="alert alert-danger">
                        Hiện tại chưa có tin tức nào
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection