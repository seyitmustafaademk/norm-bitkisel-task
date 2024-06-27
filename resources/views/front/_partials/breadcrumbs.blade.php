{{--  Breadcrumb Section Begin --}}
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('front-assets/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>NORM BİTKİSEL</h2>
                    <div class="breadcrumb__option">
                        @foreach($__breadcrumbs as $__breadcrumb)
                            @if(array_key_exists('url', $__breadcrumb))
                                <a href="{{ $__breadcrumb['url'] }}">{{ $__breadcrumb['title'] }}</a>
                            @else
                                <span>{{ $__breadcrumb['title'] }}</span>
                            @endif

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{--  Breadcrumb Section End --}}
