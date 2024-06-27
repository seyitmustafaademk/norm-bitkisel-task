@extends('front._layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-5">
            @include('front._partials.sidebar')
        </div>
        <div class="col-lg-9 col-md-7">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="filter__found text-left">
                        <h6><span class="txt-product-count">{{ $products->total() }}</span> Üründen <span class="txt-product-count">{{ $products->count() }}</span> tanesi gösteriliyor</h6>
                    </div>
                </div>
            </div>
            <div class="filter__item"></div>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6" data-product-id="{{ $product->id }}">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ str_starts_with($product->image, 'http') ? $product->image : url('storage/' . $product->image) }}">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{ $product->name }}</a></h6>
                                <h5>${{ $product->price }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="product__pagination">
                <div class="product__pagination">
                    @if ($products->hasPages())
                        <nav>
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($products->onFirstPage())
                                    <a href="#" class="disabled"><span>&laquo;</span></a>
                                @else
                                    <a href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($products->links()->elements as $element)
                                    {{-- "Three Dots" Separator --}}
                                    @if (is_string($element))
                                        <a class="disabled"><span>{{ $element }}</span></a>
                                    @endif

                                    {{-- Array Of Links --}}
                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $products->currentPage())
                                                <a href="#" class="active"><span>{{ $page }}</span></a>
                                            @else
                                                <a href="{{ $url }}">{{ $page }}</a>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a>
                                @else
                                    <a class="disabled"><span>&raquo;</span></a>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
