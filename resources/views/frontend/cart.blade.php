@extends('frontend.master1')

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
        <a href="{{ route('cart.checkout') }}" class="checkout-steps__item">
          <span class="checkout-steps__item-number">02</span>
          <span class="checkout-steps__item-title">
            <span>Shipping and Checkout</span>
            <em>Checkout Your Items List</em>
          </span>
        </a>
        <a href="javascript:void(0)" class="checkout-steps__item">
          <span class="checkout-steps__item-number">03</span>
          <span class="checkout-steps__item-title">
            <span>Confirmation</span>
            <em>Review And Submit Your Order</em>
          </span>
        </a>
      </div>

<div class="shopping-cart">
    <div class="cart-table__wrapper">
        <table class="cart-table">
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
                        <div class="shopping-cart__product-item">
                            <img loading="lazy" src="{{ asset($product->image_path) }}" width="120" height="120" alt="{{ $product->name }}" />
                        </div>
                    </td>
                    <td>
                        <div class="shopping-cart__product-item__detail">
                            <h4>{{ $product->name }}</h4>
                            <ul class="shopping-cart__product-item__options">
                                <li>{{ $product->Product_Description }}</li>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <span class="shopping-cart__product-price">${{ $product->price }}</span>
                    </td>
                    <td>
                        <div class="qty-control">
                            <button type="button" class="qty-btn minus" onclick="c('{{ $product->rowId }}', {{ $product->qty - 1 }})">-</button>
                            <input type="number" name="quantity" value="{{ $product->qty }}" min="1" 
                                   class="qty-input" 
                                   onchange="updateCart('{{ $product->rowId }}', this.value)">
                            <button type="button" class="qty-btn plus" onclick="updateCart('{{ $product->rowId }}', {{ $product->qty + 1 }})">+</button>
                        </div>
                    </td>
                    <td>
                        <span class="shopping-cart__subtotal">${{ $product->subtotal }}</span>
                    </td>

                    <form method="POST" action="{{ route('cart.remove', ['rowId' => $product->rowId]) }}">
                        @csrf
                        @method('DELETE')
                    <td>
                        <button type="submit" class="remove-cart">
                            <i class='bx bx-x-circle'></i>
                        </button>
                    </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="cart-table-footer">
                            <button class="btn btn-light">Update Cart</button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="shopping-cart__totals-wrapper">
        <div class="shopping-cart__totals">
            <h3>Cart Totals</h3>
            <table class="cart-totals">
                <tr>
                    <th>Subtotal</th>
                    <td>${{ Cart::subtotal() }}</td>
                </tr>
                <tr>
                    <th>Shipping</th>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shipping" id="free_shipping" value="free">
                            <label for="free_shipping">Free Shipping</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shipping" id="flat_rate" value="flat">
                            <label for="flat_rate">Flat Rate: $49</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shipping" id="local_pickup" value="pickup">
                            <label for="local_pickup">Local Pickup: $8</label>
                        </div>
                        <div>Shipping to AL.</div>
                        <div>
                            <a href="#" class="menu-link">Change Address</a>
                        </div>
                    </td>
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
            <div class="checkout-btn-wrapper">
                <a href="{{ route('cart.checkout') }}" class="btn btn-primary btn-checkout">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</div>

</section>
</main>

<script>
    $('.remove-cart').on('click', function() {
        $(this).closest('form').submit();
    });
</script>

@endsection
