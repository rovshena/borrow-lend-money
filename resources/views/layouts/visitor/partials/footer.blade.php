<footer class="footer bg-dark text-light">
    <div class="py-4">
        <div class="container d-flex flex-column flex-lg-row align-items-center justify-content-between py-2">
            <p class="order-lg-1 order-2 fs-sm mb-2 mb-lg-0">
                @if(Arr::exists($shared_settings, 'author'))
                {{ $shared_settings['author'] }}
                @endif
                &copy;
                @if (date('Y') == 2022)
                    2022
                @else
                    2022 - {{ date('Y') }}
                @endif
                Все права защищены.
            </p>
            <div class="d-flex flex-lg-row flex-column align-items-center order-lg-2 order-1 ms-lg-4 mb-lg-0 mb-4">
                <div class="d-flex flex-wrap fs-sm mb-lg-0 mb-4 pe-lg-4">
                    @if(Arr::exists($shared_settings, 'about_us'))
                    <a class="nav-link-light px-2 mx-1" href="{{ route('about') }}">О нас</a>
                    @endif
                    <a class="nav-link-light px-2 mx-1" href="{{ route('contact') }}">Связаться с нами</a>
                    @if(Arr::exists($shared_settings, 'privacy_policy'))
                        <a class="nav-link-light px-2 mx-1" href="{{ route('privacy') }}">Политика конфиденциальности</a>
                    @endif
                    @if(Arr::exists($shared_settings, 'terms_of_use'))
                    <a class="nav-link-light px-2 mx-1" href="{{ route('terms') }}">Условия использования</a>
                    @endif
                    <a class="nav-link-light px-2 mx-1" target="_blank" href="{{ asset('sitemap.xml') }}">Карта сайта</a>
                </div>
                <div class="d-flex align-items-center">
                    <div class="ms-4 ps-lg-2 text-nowrap">
                        <a class="btn btn-icon btn-translucent-light btn-xs rounded-circle ms-2" href="{{ isset($shared_settings['vk_link']) ? $shared_settings['vk_link'] : 'javascript:void(0);' }}">
                            <i class="fi-vk"></i>
                        </a>
                        <a class="btn btn-icon btn-translucent-light btn-xs rounded-circle ms-2" href="{{ isset($shared_settings['telegram_link']) ? $shared_settings['telegram_link'] : 'javascript:void(0);' }}">
                            <i class="fi-telegram"></i>
                        </a>
                        <a class="btn btn-icon btn-translucent-light btn-xs rounded-circle ms-2" href="{{ isset($shared_settings['messenger_link']) ? $shared_settings['messenger_link'] : 'javascript:void(0);' }}">
                            <i class="fi-messenger"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
