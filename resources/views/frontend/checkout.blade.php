@extends('frontend.master1')

@section('title', 'Checkout')

@php
    use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
      <h2 class="page-title">Shipping and Checkout</h2>
      <div class="checkout-steps">
        <a href="{{ route('cart.index') }}" class="checkout-steps__item">
          <span class="checkout-steps__item-number">01</span>
          <span class="checkout-steps__item-title">
            <span>Shopping Bag</span>
            <em>Manage Your Items List</em>
          </span>
        </a>
        <a href="javascript:void(0)" class="checkout-steps__item active">
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


    <form action="{{ route('cart.place-an-order') }}" method="POST">
        @csrf
        <div class="checkout-form">
          @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
          @endif
          @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <div class="billing-info__wrapper">
            <div class="row">
              <div class="col-6">
                <h4>SHIPPING DETAILS</h4>
              </div>
            </div>
            @if($address)
                <div class="row">
                    <div class="col-md-12">
                        <div class="my-account__address-list">
                            <div class="my-account__address-list-item">
                                <div class="my-account__address-item__detail">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="name" required="" value="{{ $address->name }}">
                                        <label for="name">Full Name *</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="address" required="" value="{{ $address->address }}">
                                        <label for="address">Address *</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="landmark" required="" value="{{ $address->landmark }}">
                                        <label for="landmark">Landmark *</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-floating my-3">
                                                <input type="text" class="form-control" name="city" required="" value="{{ $address->city }}">
                                                <label for="city">City *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating my-3">
                                                <input type="text" class="form-control" name="state" required="" value="{{ $address->state }}">
                                                <label for="state">State *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating my-3">
                                                <input type="text" class="form-control" name="country" required="" value="{{ $address->country }}">
                                                <label for="country">Country *</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="zip" required="" value="{{ $address->zip }}">
                                        <label for="zip">ZIP Code *</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="phone" required="" value="{{ $address->phone }}">
                                        <label for="phone">Phone Number *</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else

                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="name" required="" value="{{ old('name') }}">
                            <label for="name">Full Name *</label>
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="phone" required="" value="{{ old('phone') }}">
                            <label for="phone">Phone Number *</label>
                            @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="zip" required="" value="{{ old('zip') }}">
                            <label for="zip">Pincode *</label>
                            @error('zip')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="state" required="" value="{{ old('state') }}">
                            <label for="state">State *</label>
                            @error('state')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="city" required="" value="{{ old('city') }}">
                            <label for="city">Town / City *</label>
                            @error('city')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="address" required="" value="{{ old('address') }}">
                            <label for="address">House no, Building Name *</label>
                            @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="locality" required="" value="{{ old('locality') }}">
                            <label for="locality">Road Name, Area, Colony *</label>
                            @error('locality')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="country" required="" value="{{ old('country', 'India') }}">
                            <label for="country">Country *</label>
                            @error('country')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="landmark" required="" value="{{ old('landmark') }}">
                            <label for="landmark">Landmark *</label>
                            @error('landmark')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            @endif
          </div>

          <div class="checkout__totals-wrapper">
            <div class="sticky-content">
              <div class="checkout__totals">
                <h3>Your Order</h3>
                <table class="checkout-cart-items">
                  <thead>
                    <tr>
                      <th>PRODUCT</th>
                      <th align="right">SUBTOTAL</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $cartInstance = Auth::check() ? 'cart_' . Auth::id() : 'default';
                        Cart::instance($cartInstance);
                    @endphp
                    @foreach(Cart::content() as $item)
                    <tr>
                      <td>{{ $item->name }} x {{ $item->qty }}</td>
                      <td align="right">₱{{ $item->subtotal }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <table class="checkout-totals">
                  <tbody>
                    <tr>
                      <th>SUBTOTAL</th>
                      <td align="right">₱{{ Cart::subtotal() }}</td>
                    </tr>
                    <tr>
                      <th>SHIPPING</th>
                      <td align="right">Free shipping</td>
                    </tr>
                    <tr>
                      <th>VAT</th>
                      <td align="right">₱{{ Cart::tax() }}</td>
                    </tr>
                    <tr>
                      <th>TOTAL</th>
                      <td align="right">₱{{ Cart::total() }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="checkout__payment-methods">
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="mode" 
                  value="online_banking" id="payment1" required>
                  <label class="form-check-label" for="payment1">
                    Online Banking
                    <p class="option-detail">
                      Pay directly with your bank account.
                    </p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="mode" 
                  value="cod" id="payment2">
                  <label class="form-check-label" for="payment2">
                    Cash on Delivery
                    <p class="option-detail">
                      Pay when you receive your order.
                    </p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="mode" 
                  value="gcash" id="payment3">
                  <label class="form-check-label" for="payment3">
                    GCash
                    <p class="option-detail">
                      Pay using your GCash account.
                    </p>
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="mode" 
                  value="e_wallet" id="payment4">
                  <label class="form-check-label" for="payment4">
                    E-Wallet
                    <p class="option-detail">
                      Pay using your preferred e-wallet service (PayMaya, etc.).
                    </p>
                  </label>
                </div>
                <div class="policy-text">
                  Your personal data will be used to process your order, support your experience throughout this
                  website, and for other purposes described in our <a href="terms.html" target="_blank">privacy
                    policy</a>.
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-checkout">PLACE ORDER</button>
            </div>
          </div>
        </div>
    </form>


    </section>
</main>
@endsection