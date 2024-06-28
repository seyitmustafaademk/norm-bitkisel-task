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
                    <tbody id="basket-product-wrapper">

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
    <script type="module">
        let controller = new Controller();

        controller.init_basket();
    </script>
@endpush
