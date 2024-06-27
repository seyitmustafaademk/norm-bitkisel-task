@extends('front._layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="shoping__cart__table">
                <table>
                    <thead>
                    <tr>
                        <th class="shoping__product">Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($basket_products->isEmpty())
                        <tr>
                            <td colspan="5">There is no product in the basket.</td>
                        </tr>
                    @else
                        @foreach($basket_products as $basket_product)
                            <tr data-id="{{ $basket_product->product->id }}">
                                <td class="shoping__cart__item">
                                    @if(str_starts_with($basket_product->product->image, 'http'))
                                        <img style="max-height: 150px; max-width: 150px;" src="{{ $basket_product->product->image }}" alt="">
                                    @else
                                        <img style="max-height: 150px; max-width: 150px;" src="{{ url('storage/' . $basket_product->image) }}" alt="">
                                    @endif
                                    <h5>{{ $basket_product->product->name }}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    {{ $basket_product->product->price }} ₺
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="{{ $basket_product->quantity }}">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    {{ number_format( ($basket_product->product->price * $basket_product->quantity), 2, ',', '.') }} ₺
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span class="icon_close"></span>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        @if(!$basket_products->isEmpty())
            <div class="col-lg-6">
                <div class="shoping__cart__btns">
                    <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Subtotal <span>$454.98</span></li>
                        <li>Total <span>$454.98</span></li>
                    </ul>
                    <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        const api_url = {
            basket: '{{ route('front.basket.index') }}',
            increase: '{{ route('front.basket.increase', '###') }}',
            decrease: '{{ route('front.basket.decrease', '###') }}',
            remove: '{{ route('front.basket.remove', '###') }}',
            add: '{{ route('front.basket.add', '###') }}',
        }

        $(document).ready(function () {
            {{--$.ajax({--}}
            {{--    url: api_url.basket,--}}
            {{--    method: 'GET', // Şu an için GET istek gönderiyorsunuz--}}
            {{--    xhrFields: {--}}
            {{--        withCredentials: true--}}
            {{--    },--}}
            {{--    headers: {--}}
            {{--        'X-Requested-With': 'XMLHttpRequest',--}}
            {{--        'Accept': 'application/json',--}}
            {{--        'Referer': '{{ route('front.cart') }}',--}}
            {{--        'Origin': '{{ route('front.cart') }}'--}}
            {{--    },--}}
            {{--    success: function(data) {--}}
            {{--        console.log(data);--}}
            {{--    },--}}
            {{--    error: function(xhr, status, error) {--}}
            {{--        console.error(error);--}}
            {{--    }--}}
            {{--});--}}

            $('').click(function () {
                // api isteği atılacak
                let product_id = $(this).closest('tr').data('id');
                alert('increase clicked: ' + product_id);

                $.ajax({
                    url: api_url.increase.replace('###', product_id),
                    method: 'POST',
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });

            $('.dec.qtybtn').click(function () {
                let product_id = $(this).closest('tr').data('id');
                alert('decrease clicked: ' + product_id);
            });

            $('.icon_close').click(function () {
                let product_id = $(this).closest('tr').data('id');
                alert('remove clicked: ' + product_id);
            });
        });
    </script>
@endpush
