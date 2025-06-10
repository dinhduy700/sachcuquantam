@php
@endphp
<header style="position: unset;">
    <div class="container">
        <div class="header-top-info">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="header-info">
                            <ul>
                                @if(!empty($settings->hotline))
                                <li>Hotline:&nbsp;
                                    <strong class="text-brand">
                                        <a class="phone" href="tel:{{ $settings->hotline }}">{{ $settings->hotline }}</a>
                                    </strong>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="header-info header-info-right position-relative">
                            <a class="language-dropdown-active" href="javascript:void(0)">
                                <img width="16"
                                    src="{{ app()->getLocale() === 'vi' ? asset('frontend/assets/images/vietnam.png') : asset('frontend/assets/images/tienganh.png')}}"
                                >
                                {{ app()->getLocale() === 'vi' ? 'Tiếng Việt' : 'English' }}
                                <i class="fa-solid fa-angle-down"></i>
                            </a>

                            @if (app()->getLocale() === 'vi')
                                <ul class="language-dropdown">
                                    <li>
                                        <a href="{{url('/')}}">
                                            <img src="{{asset('frontend/assets/images/vietnam.png')}}" title="Tiếng Việt" width="16" alt="Tiếng Việt">
                                            <span>Tiếng Việt</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('/en')}}">
                                            <img src="{{asset('frontend/assets/images/tienganh.png')}}" title="" width="16" alt="English">
                                            <span>Tiếng Anh</span>
                                        </a>
                                    </li>
                                </ul>
                                @else
                                <ul class="language-dropdown">
                                    <li>
                                        <a href="{{url('/')}}">
                                            <img src="{{asset('frontend/assets/images/vietnam.png')}}" title="Vietnamese" width="16" alt="Vietnamese">
                                            <span>Vietnamese</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('/en')}}">
                                            <img src="{{asset('frontend/assets/images/tienganh.png')}}" title="English" width="16" alt="English">
                                            <span>English</span>
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-top">
            <div class="logo">
                <a href="{{route('home')}}"><img src="{{asset($settings->logo ?? '')}}" alt="LOGO"></a>
            </div>
            <div class="header-l">
                <div class="toolbar-mb">
                    <div href="javascript:void(0)" id="button-nav">
                        <input type="checkbox" name="">
                        <div class="menu-mb">
                            <div class="content-menu">
                                <div class="content-top">
                                    <a href="{{ route('login.get') }}">{{ __('app.login.title-form') }}</a>
                                    /
                                    <a href="{{ route('register.get') }}">{{ __('app.register.title-form') }}</a>
                                </div>
                                <div class="list-menu">
                                    <ul>
                                        <li><a href="{{url('/')}}">{{__('frontend.home')}}</a></li>
                                        <li><a href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.introduce')
                                )  }}">{{__('frontend.introduce')}}</a></li>
                                        <li><a href="{{route('category-all')}}">{{__('frontend.product')}}</a></li>
                                        <li>
                                            <a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.video')
                                                )  }}">{{__('frontend.video')}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.news')
                                                )  }}">{{__('frontend.news')}}
                                            </a>
                                        </li>
                                        <li><a href="{{ route('contact.index') }}">{{__('frontend.contact')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="bg-menu"></div>
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
                <div class="header-search">
                    <form id="search-bar" method="get" action="{{ route('search.index') }}">
                        <input type="text" placeholder="{{__('frontend.search')}}..." name="search" value="{{ request('search', '') }}">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="header-info">
                    <div class="item hidden-md">
                        <div class="name ac"><a href="{{route('info-customter')}}">{{ auth()->guard('customer')->user()->name ?? __('frontend.account')}}</a></div>
                        @auth('customer')
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf
                        </form>


                        <div class="group-ac logout-btn">
                            <a href="javascript:void(0)">{{__('frontend.logout')}}</a>
                        </div>
                        @else
                        <div class="group-ac">
                            <a href="{{ route('login.get') }}">{{__('frontend.login')}}</a>
                            <a href="{{ route('register.get') }}">{{__('frontend.register')}}</a>
                        </div>
                        @endauth
                    </div>
                    <div class="item show-cart">
                        @include('frontend.layouts.header-cart')
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</header>
<div class="header-sticky">
    <div class="container">
        <div class="header-bot">
            <div class="menu">
                <div class="title">
                    {{__('frontend.product_portfolio')}}
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>

                <div class="menu-mega">
                    <ul>
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . 'collections/'.$category->translation->product_category_slug
                                                )  }}">{{$category->translation->product_category_name}}</a>
                            
                            @include('frontend.layouts.menu-child', ['categories' => $category->child])
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="nav">
                <ul>
                    <li>
                        <a href="{{route('home')}}">{{__('frontend.home')}}</a>
                    </li>
                    <li>
                        <a href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.introduce')
                                )  }}">{{__('frontend.introduce')}}</a>
                    </li>
                    <li>
                        <a href="{{route('category-all')}}">{{__('frontend.product')}}</a>
                    </li>
                    {{-- <li>
                        <a href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.video')
                                )  }}">{{__('frontend.video')}}</a>
                    </li> --}}
                    <li>
                        <a href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.news')
                                )  }}">{{__('frontend.news')}}</a>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}">{{__('frontend.contact')}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
