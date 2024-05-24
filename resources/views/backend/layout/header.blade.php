<header>
  <nav class="navbar navbar-expand-lg navbar-light d-flex align-items-center justify-content-between">
    <div class="container-fluid">
      <a href="javascript:void(0)" id="jsSidebarToggler">
        <div class="sidebar-toggler">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </a>

      <ul class="navbar-nav flex-row">
        <li class="nav-item dropdown">
          <a class="nav-link" href="javascript:void(0)" id="languageDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img class="flag-icon"
              src="{{ asset('assets/images/icons/' .config('constants.flag_locale')[getLocaleSession()]) }}"
              title="{{ getLocaleSession() }}" />
            <span class="fw-bold ml-1 mr-1 d-none d-md-inline-block">
              {{ __('app.languages.' .config('constants.full_locale')[getLocaleSession()]) }}
            </span>
          </a>


          <div class="dropdown-menu" aria-labelledby="languageDropdown">
            @foreach (config('constants.flag_locale') as $key => $lang)
              <a href="javascript:void(0)" class="dropdown-item set-locale">
                <img class="flag-icon"
                  src="{{ asset('assets/images/icons/' . config('constants.flag_locale')[$key]) }}"
                  title="{{ $key }}" />
                <span class="ml-1"> {{ __('app.languages.' . config('constants.full_locale')[$key]) }}
                </span>
              </a>
            @endforeach
          </div>
          <form method="POST" id="locale-admin" action="{{ route('admin.locale') }}">
            @csrf
            <input type="hidden" name="locale" value="{{ getLocaleSession() }}">
          </form>
        </li>

        <li class="nav-item dropdown nav-notifications">
          <a class="nav-link" href="javascript:void(0)" id="notificationDropdown" role="button" 
            aria-haspopup="true" aria-expanded="true">
            <i class="far fa-bell"></i>
            <div class="indicator">
              @if (auth()->user()->unreadnotifications()->count() > 0)
                <div class="circle"><span id="notify-unread">{{ auth()->user()->unreadnotifications()->count() }}</span></div>
              @endif
            </div>
          </a>

          <div class="dropdown-menu" id="notificationMenu" aria-labelledby="notificationDropdown">
            <div class="dropdown-header align-items-center">
              <div class="d-flex align-items-center justify-content-between">
                <a href="javascript:;" class="text-muted" id="delete-notify">{{ __('app.layouts.clear-all') }}</a>
                <p class="mb-0 fw-bold text-capitalize"><button class="btn btn-close-notify"><i class="fas fa-times"></i></button></p>
              </div>
              {{-- <div class="d-flex justify-content-between" style="margin-top: 15px">
                <button class="btn">All</button>
                <button class="btn">Unread</button>
              </div> --}}
            </div>
            <div class="dropdown-body menu-notification" attr-load="2" attr-open="false">

            </div>
            <div class="dropdown-footer d-flex align-items-center justify-content-center">
              <span id="notify-load-more">{{ __('app.layouts.view-more') }}</span>
            </div>
          </div>
        </li>

        <li class="nav-item dropdown border-start ms-3 ps-3">
          <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="profileDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            {{ auth()->user()->name }}
          </a>

          <ul class="dropdown-menu" aria-labelledby="profileDropdown">
            <form method="POST" action="{{ route('admin.logout') }}">
              @csrf
              <button type="submit" class="btn text-danger btn-logout">{{ __('app.layouts.logout') }}</button>
            </form>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
