<div class="button-fix hidden-xs">
    <ul>
        @if(!empty($settings->hotline))
        <li class="phone">
            <a href="tel:{{ $settings->hotline }}" rel="nofollow" aria-label="Gọi ngay cho chúng tôi">
                <img src="{{asset('frontend/assets/images/telephone-call.png')}}" style="max-width:50px">
            </a>
            <a class="tel" href="tel:{{ $settings->hotline }}">{{ $settings->hotline }}</a>
        </li>   
        @endif

        @if(!empty($settings->facebook))
        <li>
            <a href="{{$settings->facebook}}" target="_blank" rel="noreferrer" aria-label="Chat với chúng tôi">
                <img src="{{asset('frontend/assets/images/3670042.png')}}" style="max-width:50px">
            </a>
        </li>
        @endif

        @if(!empty($settings->zalo))
        <li class="chatbot">
            <a href="{{$settings->zalo}}" target="_blank" rel="noreferrer" aria-label="Chat với chúng tôi qua Zalo">
                <img src="{{asset('frontend/assets/images/icon-menu-right2.png')}}" style="max-width:75px">
            </a>
        </li>
        @endif

        @if(!empty($settings->email))
        <li>
            <a href="mailto:{{ $settings->email }}" aria-label="Đăng kí thông tin và để lại lời nhắn">
                <img src="{{asset('frontend/assets/images/email.png')}}" style="max-width:50px">
            </a>
        </li>
        @endif

        <li>
            <a href="{{ route('contact.index') }}" aria-label="Xem địa chỉ doanh nghiệp">
                <img src="{{asset('frontend/assets/images/1865269.png')}}" style="max-width:50px">
            </a>
        </li>
    </ul>
</div>