{{--  Footer Section Begin  --}}
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{ route('front.homepage') }}"><img src="{{ asset('front-assets/img/logo.png') }}" alt=""></a>
                    </div>
                    <ul>
                        <li>Address: Mecidiye, Selçuk Cd. No:85, 34930 Sultanbeyli/İstanbul</li>
                        <li>Phone: (0216) 399 41 34</li>
                        <li>Email: info@normbitkisel.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>Useful Links</h6>
                    <ul>
                        <li><a href="{{ route('front.homepage') }}">ÜRÜNLER</a></li>
                        <li><a href="{{ route('front.cart') }}">SEPET</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p>
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                            All rights reserved | This template is made with
                            <i class="fa fa-heart" aria-hidden="true"></i> by
                            <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
{{--  Footer Section End  --}}
