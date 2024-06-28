@extends('front._layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-5">
            @include('front._partials.sidebar')
        </div>
        <div class="col-lg-9 col-md-7">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="filter__found text-left">
                        <h6><span id="txt-total-product-count">0</span> Üründen <span id="txt-product-count">0</span> aralığı gösteriliyor</h6>
                    </div>
                </div>
            </div>
            <div class="filter__item"></div>
            <div class="row" id="product-wrapper">

            </div>
            <div class="product__pagination">
                <div class="product__pagination">
                    <nav>
                        <ul class="pagination" id="pagination-wrapper"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        let controller = new Controller();

        controller.init_homepage();
    </script>
@endpush
