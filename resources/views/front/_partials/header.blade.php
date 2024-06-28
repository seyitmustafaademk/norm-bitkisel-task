{{-- Header Section Begin --}}
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6">
                    <div class="header__top__right">
                        @auth
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
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ route('front.homepage') }}"><img src="{{ asset('front-assets/img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li><a href="{{ route('front.homepage') }}">Ana Sayfa</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                @auth()
                <div class="header__cart" id="header-basket-icon">
                    <ul>
                        <li><a href="{{ route('front.cart') }}"><i class="fa fa-shopping-bag"></i> <span id="txt-basket-count"></span></a></li>
                    </ul>
                </div>
                @endauth
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
{{-- Header Section End --}}
