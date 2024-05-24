<footer>
    <div class="policy-footer">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                    <div class="content-policy">
                        <div class="policy-left">
                            <img src="{{asset('frontend/assets/images/policy_1.png')}}"alt="Olivo Việt Nam">
                        </div>
                        <div class="policy-right">
                            <div class="title-policy">
                                {{__('frontend.warranty')}}
                            </div>
                            <div class="policy-sumary">
                                {{__('frontend.warranty_des')}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                    <div class="content-policy po_2">
                        <div class="policy-left">
                            <img src="{{asset('frontend/assets/images/policy_2.png')}}"alt="Olivo Việt Nam">
                        </div>
                        <div class="policy-right">
                            <div class="title-policy">
                                {{__('frontend.payment')}}
                            </div>
                            <div class="policy-sumary">
                                {{__('frontend.payment_des')}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                    <div class="content-policy po_3">
                        <div class="policy-left">
                            <img src="{{asset('frontend/assets/images/policy_3.png')}}"alt="Olivo Việt Nam">
                        </div>
                        <div class="policy-right">
                            <div class="title-policy">
                                {{__('frontend.shipping')}}
                            </div>
                            <div class="policy-sumary">
                                {{__('frontend.shipping_call')}} <a class="fone" href="tel:0912739249">0912739249</a> {{__('frontend.shipping_des')}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                    <div class="content-policy po_2 po_4">
                        <div class="policy-left">
                            <img src="{{asset('frontend/assets/images/policy_4.png')}}"alt="Olivo Việt Nam">
                        </div>
                        <div class="policy-right">
                            <div class="title-policy">
                                {{__('frontend.staff')}}
                            </div>
                            <div class="policy-sumary">
                                {{__('frontend.staff_des')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle-footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="logo_footer">
                        <a href="/" class="logo-wrapper ">  
                            <img src="{{asset($settings->logo_footer ?? '')}}" alt="logo Olivo Việt Nam">
                        </a>
                    </div>
                    <p class="sum_footer">
                        {{__('frontend.footer_des')}}
                    </p>
                    <div class="widget-ft first before lasst">
                        <div class="getmail section">
                            <div class="social">
                                
                                <a class="tw" target="blank" href="{{$settings->twitter ?? ''}}" title="Theo dõi trên Twitter"><i class="fab fa-twitter"></i></a>
                                
                                
                                <a class="fb" target="blank" href="{{$settings->facebook ?? ''}}" title="Theo dõi trên Facebook"><i class="fab fa-facebook-f"></i></a>
                                
                                
                                <a class="pi" target="blank" href="{{$settings->pinterest ?? ''}}" title="Theo dõi trên Pinterest"><i class="fab fa-pinterest-p"></i></a>
                                
                                
                                <a class="go" target="blank" href="{{$settings->google_plus ?? ''}}" title="Theo dõi trên Google"><i class="fab fa-google-plus-g"></i></a>
                                                            
                                
                                <a class="yt" target="blank" href="{{$settings->youtube ?? ''}}" title="Theo dõi trên Youtube"><i class="fab fa-youtube"></i></a>

                                <a class="instagram" target="blank" href="{{$settings->instagram ?? ''}}" title="Theo dõi trên Instagram"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu_fot" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fot_menu_copyright">
                    <ul class="menu a-center">
                        
                        <li><a class="a_menu" href="/gioi-thieu">{{__('frontend.footer_introduce')}}</a></li>
                        
                        <li><a class="a_menu" href="{{ route('contact.index') }}">{{__('frontend.footer_contact')}}</a></li>
                        
                        <li><a class="a_menu" href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.privacy_policy')
                                )  }}">{{__('frontend.footer_privacy_policy')}}</a></li>
                        
                        <li><a class="a_menu" href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.terms_service')
                                )  }}">{{__('frontend.footer_terms_service')}}</a></li>
                        
                        <li><a class="a_menu" href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.warranty_refund')
                                )  }}">{{__('frontend.footer_warranty_refund')}}</a></li>
                        
                        <li><a class="a_menu" href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.shipping_installation')
                                )  }}">{{__('frontend.footer_shipping_installation')}}</a></li>
                        
                        <li><a class="a_menu" href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.payment_mothods')
                                )  }}">{{__('frontend.footer_payment_mothods')}}</a></li>
                        
                        <li><a class="a_menu" href="{{ url('/'.
                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . __('route.asked_question')
                                )  }}">{{__('frontend.footer_asked_question')}}</a></li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-footer-bottom copyright clearfix">
        <div class="container">
            <div class="inner clearfix">
                <div class="row tablet">
                    <div class="col-lg-12 a-center">
                        @if(!empty($settings->ecommerce_industry))
                            {!! $settings->ecommerce_industry !!}
                        @endif
                    </div>
                    <div id="copyright" class="col-lg-12 a-center fot_copyright">
                        <span class="wsp">
                            <span class="mobile">© Design By Galen.com
                                <span class="dash"> | </span>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@include('frontend.component.input-contact')
<a href="javascript:void(0)" class="scroll-top show" title="Lên đầu trang"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
