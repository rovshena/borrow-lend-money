<aside class="app-aside app-aside-expand-md app-aside-light">
    <div class="aside-content">
        <header class="aside-header d-block d-md-none">
            <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside">
				<span class="user-avatar user-avatar-lg">
					<img src="{{ asset('assets/images/avatars/placeholder.jpg') }}" alt="">
				</span>
                <span class="account-icon">
					<span class="fas fa-caret-down fa-lg"></span>
				</span>
                <span class="account-summary">
					<span class="account-name">{{ Auth::user()->username }}</span>
                    <span class="account-description">{{ Auth::user()->name }}</span>
				</span>
            </button>
            <div id="dropdown-aside" class="dropdown-aside collapse">
                <div class="pb-3">
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                        <span class="dropdown-icon far fa-user-circle fa-fw"></span>{{ __('Мой учетная запись') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.change-password') }}" >
                        <span class="dropdown-icon fas fa-key fa-fw"></span>{{ __('Изменить пароль') }}
                    </a>
                    <a class="dropdown-item" href="javascript:void(0);"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="dropdown-icon fas fa-sign-out-alt fa-fw"></span>{{ __('Выход') }}
                    </a>
                    @foreach (config('app.available_locales', ['en' => 'English']) as $locale=>$value)
                        <a class="dropdown-item py-1" href="{{ route('locale', ['locale' => $locale]) }}">
                            <span class="tile tile-img">
                                <img src="{{ asset('assets/images/locales/' . $locale . '.png') }}" alt="{{ $value }}" title="{{ $value }}">
                            </span>
                            {{ $value }}
                        </a>
                    @endforeach
                </div>
            </div>
        </header>
        <div class="aside-menu overflow-hidden">
            <nav id="stacked-menu" class="stacked-menu">
                <ul class="menu">
                    <li class="menu-item {{ Route::is('admin.index') ? 'has-active' : '' }}">
                        <a href="{{ route('admin.index') }}" class="menu-link">
                            <span class="menu-icon fas fa-home"></span>
                            <span class="menu-text">{{ __('Главная') }}</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::is('admin.profile') ? 'has-active' : '' }}">
                        <a href="{{ route('admin.profile') }}" class="menu-link">
                            <span class="menu-icon far fa-user-circle"></span>
                            <span class="menu-text">{{ __('Мой учетная запись') }}</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::is('admin.inquiries*') ? 'has-active' : '' }}">
                        <a href="{{ route('admin.inquiries') }}" class="menu-link">
                            <span class="menu-icon fas fa-inbox"></span>
                            <span class="menu-text">{{ __('Сообщения') }}</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::is('admin.settings*') ? 'has-active' : '' }}">
                        <a href="{{ route('admin.settings.index') }}" class="menu-link">
                            <span class="menu-icon fas fa-cogs"></span>
                            <span class="menu-text">{{ __('Настройки') }}</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::is('admin.users*') ? 'has-active' : '' }}">
                        <a href="{{ route('admin.users.index') }}" class="menu-link">
                            <span class="menu-icon fas fa-user-friends"></span>
                            <span class="menu-text">{{ __('Пользователи') }}</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link">
                            <span class="menu-icon fas fa-sign-out-alt"></span>
                            <span class="menu-text">{{ __('Выход') }}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <footer class="aside-footer border-top p-2">
            <button class="btn btn-light btn-block text-primary" data-toggle="skin">
                <span class="d-compact-menu-none">{{ __('Темный режим') }}</span>
                <i class="fas fa-moon ml-1"></i>
            </button>
        </footer>
    </div>
</aside>
