<header class="navbar navbar-expand-lg navbar-light fixed-top" data-scroll-header="">
    <div class="container">
        <a class="navbar-brand me-3 me-xl-4 d-md-flex align-items-center" href="{{ url('/') }}">
            <img class="me-2" src="{{ asset('assets/images/logo/logo-icon.png') }}" alt="" width="50">
            <h4 class="mb-0 d-none d-md-block">{{ isset($shared_settings['title']) ? $shared_settings['title'] : '' }}</h4>
        </a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="btn btn-primary btn-sm rounded-pill ms-2 order-lg-3" href="{{ route('borrow.money') }}">
            <i class="fas fa-plus fa-fw me-sm-2"></i>
            <span class="d-none d-sm-inline-flex">Взять деньги</span>
        </a>
        <a class="btn btn-primary btn-sm rounded-pill ms-2 order-lg-3" href="{{ route('lend.money') }}">
            <i class="fas fa-handshake fa-fw me-sm-2"></i>
            <span class="d-none d-sm-inline-flex">Дать деньги</span>
        </a>
        <div class="collapse navbar-collapse order-lg-2" id="navbarNav">
            <ul class="navbar-nav navbar-nav-scroll" style="max-height: 35rem;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fi-layers me-2"></i> Объявление
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('category', 'borrow-money') }}">
                                <i class="fas fa-plus fa-fw fs-base opacity-50 me-2"></i>Взять деньги
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('category', 'lend-money') }}">
                                <i class="fas fa-handshake fa-fw fs-base opacity-50 me-2"></i>Дать деньги
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('credit-calculator') }}">
                                <i class="fas fa-calculator fa-fw fs-base opacity-50 me-2"></i>Кредит калькулятор
                            </a>
                        </li>
                    </ul>
                </li>
                @if(count($countries))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            Страны
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($countries as $country)
                                <li>
                                    <a class="dropdown-item" href="{{ route('category', ['geo', $country->id]) }}">
                                        {{ $country->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</header>
