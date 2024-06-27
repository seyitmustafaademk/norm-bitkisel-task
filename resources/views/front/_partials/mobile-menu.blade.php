{{--  Humberger Begin  --}}
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="{{ route('front.homepage') }}">
            <img src="{{ asset('front-assets/img/logo.png') }}" alt="">
        </a>
    </div>
    <div class="humberger__menu__cart">
        @auth()
        <ul>
            <li>
                <a href="{{ route('front.cart') }}">
                    <i class="fa fa-shopping-bag"></i> <span>{{ $basket_product_count ?? '0' }}</span>
                </a>
            </li>
        </ul>
        @endauth
    </div>
    <div class="humberger__menu__widget">
        @auth()
            <span class="mr-3">{{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}</span>
            <div class="header__top__right__auth">
                <form id="form-logout" method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                </form>
                <button type="submit" form="form-logout" class="btn btn-danger">
                    <i class="fa fa-arrow-left"></i> Çıkış Yap
                </button>
            </div>
        @else
            <div class="header__top__right__auth">
                <a href="{{ route('auth.index') }}"><i class="fa fa-user"></i> Giriş Yap / Kayıt Ol</a>
            </div>
        @endauth

    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{ route('front.homepage') }}">Ana Sayfa</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
</div>
{{--  Humberger End  --}}
