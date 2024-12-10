@extends('frontend.master')

@section('title', 'Cart')

@section('content')
<section id="cart-header-yellow">
            <h2>Your Shopping Cart</h2>
            <p>Almost Yours! Complete Your Order Now.</p>
</section>


<main class="pt-90">
    <section class="shop-checkout container">
        <div class="checkout-steps">
        <a href="{{ route('cart.index') }}" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">01</span>
          <span class="checkout-steps__item-title">
            <span>Shopping Bag</span>
            <em>Manage Your Items List</em>
          </span>
        </a>
        <a href="{{ route('cart.index') }}" class="checkout-steps__item">
          <span class="checkout-steps__item-number">02</span>
          <span class="checkout-steps__item-title">
            <span>Shipping and Checkout</span>
            <em>Checkout Your Items List</em>
          </span>
        </a>
        <a href="{{ route('cart.index') }}" class="checkout-steps__item">
          <span class="checkout-steps__item-number">03</span>
          <span class="checkout-steps__item-title">
            <span>Confirmation</span>
            <em>Review And Submit Your Order</em>
          </span>
        </a>
        </div>

        <div class="section-p1" id="cart">
            @if($products->count() > 0)
                <div class="cart-table__wrapper">
                    <table width="100%">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th></th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ asset($product->model->Product_Image ?? 'media/products/f1.png') }}" alt="{{ $product->name }}" width="120">
                                    </td>
                                    <td>
                                        <p>{{ $product->name }} , {{ $product->Product_Description }}</p>
                                    </td>
                                    <td>${{ $product->price }}</td>
                                    <td>
                                        <input type="number" name="quantity" value="{{ $product->qty }}" min="1" 
                                               class="qty-control__number text-center" 
                                               onchange="updateCart('{{ $product->rowId }}', this.value)">
                                    </td>
                                    <td>${{ $product->subtotal }}</td>
                                    <td>
                                        <a href="{{ route('cart.index', $product->rowId) }}" class="remove-cart">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="shopping-cart__totals-wrapper">
                    <h3>Cart Totals</h3>
                    <table class="cart-totals">
                        <tr>
                            <th>Subtotal</th>
                            <td>${{ Cart::subtotal() }}</td>
                        </tr>
                        <tr>
                            <th>Shipping</th>
                            <td>Free</td>
                        </tr>
                        <tr>
                            <th>VAT</th>
                            <td>${{ Cart::tax() }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>${{ Cart::total() }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('cart.index') }}">
                        <button class="normal">Proceed to Checkout</button>
                    </a>

                    
                </div>
            @else
                <div class="container text-center">
                    <img src="{{ asset('images/empty_cart.png') }}" alt="Empty Cart" class="img-fluid mb-4">
                    <h2>Your Cart is Empty</h2>
                    <p>Looks like you haven’t added anything to your cart yet.</p>
                    <a href="{{ route('shop') }}" class="normal">Continue Shopping</a>
                </div>
            @endif
        </div>
    </section>
</main>

@endsection
