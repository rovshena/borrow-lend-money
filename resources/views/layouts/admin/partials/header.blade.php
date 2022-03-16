<header class="app-header app-header-dark">
    <div class="top-bar">
        <div class="top-bar-brand">
            <button class="hamburger hamburger-squeeze mr-2" type="button" data-toggle="aside-menu" aria-label="toggle aside menu">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
            </button>
            <a href="{{ route('admin.index') }}" class="">
                <h6 class="mb-0">{{ __('Панель администратора') }}</h6>
            </a>
        </div>
        <div class="top-bar-list">
            <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
                <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="toggle menu">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
                </button>
            </div>
            <div class="top-bar-item top-bar-item-right d-none d-sm-flex px-0">
                <ul class="header-nav nav">
                    @include('admin.inquiry.dropdown')
                    <li class="nav-item dropdown header-nav-dropdown">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-th"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
                            <div class="dropdown-arrow"></div>
                            <div class="dropdown-sheets">
                                <div class="dropdown-sheet-item">
                                    <a href="{{ route('admin.index') }}" class="tile-wrapper">
                                        <span class="tile tile-lg bg-dropbox">
                                            <i class="fas fa-home"></i>
                                        </span>
                                        <span class="tile-peek">{{ __('Главная') }}</span>
                                    </a>
                                </div>
                                <div class="dropdown-sheet-item">
                                    <a href="{{ route('admin.profile') }}" class="tile-wrapper">
                                        <span class="tile tile-lg bg-flickr">
                                            <i class="far fa-user-circle"></i>
                                        </span>
                                        <span class="tile-peek">{{ __('Мой учетная запись') }}</span>
                                    </a>
                                </div>
                                <div class="dropdown-sheet-item">
                                    <a href="{{ route('admin.generate.sitemap') }}" class="tile-wrapper show-preloader">
                                        <span class="tile tile-lg bg-amazon">
                                            <i class="fas fa-cogs"></i>
                                        </span>
                                        <span class="tile-peek">{{ __('Generate Sitemap') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="dropdown">
                    <button class="btn-account" type="button">
						<span class="tile tile-img">
							<img src="{{ asset('assets/images/locales/' . app()->getLocale() . '.png') }}" title="{{ config('app.available_locales', ['en' => 'English'])[app()->getLocale()] }}" alt="{{ config('app.available_locales', ['en' => 'English'])[app()->getLocale()] }}">
						</span>
                    </button>
                </div>
                <div class="dropdown d-none d-md-flex">
                    <button class="btn-account" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="user-avatar user-avatar-md">
                            <img src="{{ asset('assets/images/avatars/placeholder.jpg') }}" alt="">
                        </span>
                        <span class="account-icon d-none d-lg-block">
							<span class="fas fa-caret-down fa-lg"></span>
						</span>
                        <span class="account-summary pr-lg-4 d-none d-lg-block">
                            <span class="account-name">{{ Auth::user()->username }}</span>
                            <span class="account-description">{{ Auth::user()->name }}</span>
                        </span>
                    </button>
                    <div class="dropdown-menu">
                        <div class="dropdown-arrow d-lg-none" x-arrow=""></div>
                        <div class="dropdown-arrow ml-3 d-none d-lg-block"></div>
                        <a href="{{ route('admin.profile') }}" class="dropdown-item">
                            <span class="dropdown-icon far fa-user-circle"></span>{{ __('Мой учетная запись') }}
                        </a>
                        <a href="{{ route('admin.change-password') }}" class="dropdown-item">
                            <span class="dropdown-icon fas fa-key"></span>{{ __('Изменить пароль') }}
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="dropdown-icon fas fa-sign-out-alt"></span>{{ __('Выход') }}
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
