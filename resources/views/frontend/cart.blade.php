@extends('frontend.master') {{-- Use the main layout --}}

@section('title', 'Home') {{-- Page title --}}

@section('content') {{-- Start of the page content --}}

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<section id="cart-header">
            <h2>Your Shopping Cart</h2>
            <p>Almost Yours! Complete Your Order Now.</p>
    </section>

    <section id="cart" class="section-p1">
    <table width="100%">
        <thead>
            <tr>
                <td>Remove</td>
                <td>Image</td>
                <td>Product</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $product)
                <tr>
                    <td><img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}"></td>
                    <td>{{ $product['name'] }}</td>
                    <td>₱{{ $product['price'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>₱{{ $product['price'] * $product['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

                <section id="cart-add" class="section-p1">
                    <div id="subtotal">
                        <h3>Cart Totals</h3>
                        <table>
                            <tr>
                                <td>Cart Subtotal: </td>
                                <td>$300</td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td>Free</td>
                            </tr>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><Strong>$300</Strong></td>
                            </tr>
                        </table>

                        <a href="#"><button class="normal">Proceed Checkout</button></a>

                    </div>
                </section>

    </div>
</section>

@endsection
