@section('title-page')
    {{$detailNews->translation->seo_title ?? ($detailNews->translation->news_title ?? ($settings->translation->seo_title ?? 'Galen Official Store'))}}
@endsection

@section('seo')
    <meta name="description" content="{{ $detailNews->translation->seo_description ?? ($settings->translation->seo_description ?? '') }}">
    <meta name="keywords" content="{{$detailNews->translation->seo_keywords ?? ($settings->translation->seo_keywords ?? '') }}">
    <meta property="og:image" content="{{asset($detailNews->news_image ?? ($settings->logo ?? 'assets/images/favicon.ico'))}}" />
    <meta property="og:title" content="{{$detailNews->translation->seo_title ?? ($detailNews->translation->news_title ?? ($settings->translation->seo_title ?? 'Galen Official Store'))}}" />
    <meta property="og:site_name" content="{{$settings->translation->seo_title ?? 'Galen Official Store'}}" />
    <meta property="og:description" content="{{$detailNews->translation->seo_description ?? ($settings->translation->seo_description ?? '')}}" />
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
                            <h2>Tin tức gần đây</h2>
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
                                )  }}">{{ $value->translation->news_description }}</a>
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
                <div class="news-right">
                    <div class="news-detail">
                        <h1 class="title-news">{{ $detailNews->translation->news_title }}</h1>
                        <p class="posts">
                            {{ date('d-m-Y H:i', strtotime($detailNews->news_publish)) }}
                        </p>
                        <div class="content">
                            {!! $detailNews->translation->news_content !!}
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12  tags-list">
                                <span>Tag:</span>
                                <?php
                                    $arrTags = json_decode($detailNews->tag_id);
                                ?>
                                @foreach($tags as $tag)
                                @if(in_array($tag->id, $arrTags))
                                <div class="tag_list">
                                    <a href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.tags').'/'. $tag->translation->tag_slug
                                )  }}" title="nồi chiên không dầu olivo">{{$tag->translation->tag_name}}</a>,&nbsp;
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <div class="col-xs-12 col-md-6 a-right share_social">
                                <div class="social-media" data-permalink="https://olivo-kitchen.com/huong-dan-lam-banh-mi-nuong-cuc-ki-don-gian-tai-nha-bang-noi-chien-khong-dau-olivo-af15">
                                    <label><i class="fa fa-share-alt"></i> Chia sẻ bài viết: </label>
                                    <a target="_blank" href="//twitter.com/share?text={{$detailNews->translation->news_title}}&amp;url={{url('/'.route('news').'/'.$detailNews->translation->news_slug  )}}" class="share-twitter" title="Chia sẻ lên Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a target="_blank" href="//www.facebook.com/sharer.php?u={{url('/'.route('news').'/'.$detailNews->translation->news_slug  )}}" class="share-facebook" title="Chia sẻ lên Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a target="_blank" href="//plus.google.com/share?url={{url('/'.route('news').'/'.$detailNews->translation->news_slug  )}}" class="share-google" title="+1">
                                        <i class="fab fa-google-plus-g"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 clear-fix">
                            <form method="post" action="{{route('submit-comment')}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="news_id" value="{{$detailNews->id}}">
                                <div class="form-coment">
                                    <div class="title-form">
                                        <h5 class="title-form-coment">{{__('frontend.your_comment')}}</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group padding-0">
                                                <input placeholder="{{__('frontend.full_name')}}" type="text" class="form-control" name="name" value="" required="">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <fieldset class="form-group padding-0"> 
                                                <input placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" type="email" class="form-control" value="" name="email" required="">
                                            </fieldset>
                                        </div>
                                        <div class="form-group padding-right-15 padding-left-15 col-lg-12 col-md-12 col-sm-12 col-xs-12">   
                                            <textarea placeholder="{{ __('frontend.content') }}" class="form-control" id="comment" name="comment" rows="6" required=""></textarea>
                                        </div>
                                        <div class="submit-form">
                                            <button type="submit" class="btn btn-primary button_45">{{__('frontend.send_info')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection