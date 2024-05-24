<nav class="sidebar">
  <div class="sidebar-header d-flex align-items-center justify-content-between">
    <a href="{{ route('admin.dashboard.index') }}" class="sidebar-brand link-dark text-decoration-none d-flex align-items-baseline">
      <h4 class="fw-bold m-0">Admin.</h4>
      <h6 class="m-0">page</h6>
    </a>

    <div class="sidebar-toggler">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div class="sidebar-body scrollbar">
    <ul class="nav">
      <li class="nav-item nav-category">{{ __('app.layouts.general') }}</li>
      <li class="nav-item">
        <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
          <i class="fas fa-house-user"></i>
          <span class="link-title">{{ __('app.layouts.dashboard') }}</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="javascript:void(0)" class="nav-link collapsed">
          <i class="fas fa-tag"></i>
          <span class="link-title">{{ __('app.layouts.products') }}</span>
          <i class="fas fa-angle-down"></i>
        </a>

        <div class="collapse">
          <ul class="nav nav-sub">
            <li class="nav-item">
              <a href="{{ route('admin.products.index') }}" class="nav-link">{{ __('app.layouts.all-products') }}</a>
            </li>
            <!-- <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">{{ __('app.layouts.inventory') }}</a>
            </li> -->
            <li class="nav-item">
              <a href="{{ route('admin.categories.index') }}" class="nav-link">{{ __('app.layouts.categories') }}</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.brands.index') }}" class="nav-link">{{ __('app.layouts.brands') }}</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.orders.index') }}" class="nav-link">
          <i class="fas fa-dolly-flatbed"></i>
          <span class="link-title">{{ __('app.layouts.orders') }}</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.banners.index') }}" class="nav-link">
          <i class="fas fa-photo-video"></i>
          <span class="link-title">{{ __('app.layouts.banners') }}</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.news.index') }}" class="nav-link">
          <i class="fas fa-newspaper"></i>
          <span class="link-title">{{ __('app.layouts.news') }}</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.tags.index') }}" class="nav-link">
          <i class="fas fa-tags"></i>
          <span class="link-title">{{ __('app.layouts.tags') }}</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.videos.index') }}" class="nav-link">
          <i class="fas fa-video"></i>
          <span class="link-title">{{ __('app.layouts.video') }}</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.customers.index') }}" class="nav-link">
          <i class="fas fa-user-circle"></i>
          <span class="link-title">{{ __('app.layouts.customers') }}</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="javascript:void(0)" class="nav-link collapsed">
          <i class="fas fa-user-lock"></i>
          <span class="link-title">{{ __('app.layouts.users') }}</span>
          <i class="fas fa-angle-down"></i>
        </a>

        <div class="collapse">
          <ul class="nav nav-sub">
            <li class="nav-item">
              <a href="{{ route('admin.users.index') }}" class="nav-link">{{ __('app.layouts.all-users') }}</a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{ route('admin.roles.index') }}" class="nav-link">{{ __('app.layouts.all-roles') }}</a>
            </li> --}}
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.pages.index') }}" class="nav-link">
          <i class="fas fa-pager"></i>
          <span class="link-title">{{ __('app.layouts.pages') }}</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.contacts.index') }}" class="nav-link">
          <i class="fas fa-address-card"></i>
          <span class="link-title">{{ __('app.layouts.contact') }}</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.comments.index') }}" class="nav-link">
          <i class="fas fa-comments"></i>
          <span class="link-title">{{ __('app.layouts.comment') }}</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.subscribes.index') }}" class="nav-link">
          <i class="fas fa-address-book"></i>
          <span class="link-title">{{ __('app.layouts.subscribe') }}</span>
        </a>
      </li>

      {{-- <li class="nav-item">
        <a href="javascript:void(0)" class="nav-link collapsed">
          <i class="fas fa-shipping-fast"></i>
          <span class="link-title">{{ __('app.layouts.shipments') }}</span>
          <i class="fas fa-angle-down"></i>
        </a>

        <div class="collapse">
          <ul class="nav nav-sub">
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">{{ __('app.layouts.general') }}</a>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">{{ __('app.layouts.shipments') }}</a>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">{{ __('app.layouts.cod-management') }}</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a href="javascript:void(0)" class="nav-link">
          <i class="fas fa-chart-line"></i>
          <span class="link-title">{{ __('app.layouts.analytics') }}</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="javascript:void(0)" class="nav-link">
          <i class="fas fa-gift"></i>
          <span class="link-title">{{ __('app.layouts.discounts') }}</span>
        </a>
      </li> --}}
    </ul>
  </div>

  <div class="sidebar-footer hidden-small">
    <a href="{{ route('admin.setting.index') }}" class="nav-link" data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings">
      <i class="fas fa-cog"></i>
      <span class="link-title">{{ __('app.layouts.settings') }}</span>
    </a>
  </div>
</nav>
