@extends('frontend.master') {{-- Use the main layout --}}

@section('title', 'Shop') {{-- Page title --}}

@section('content') {{-- Start of the page content --}}
<section id="page-header" class="section-p1">
    <div class="ph-txt">
        <h2>Shop Now!</h2>
        <p>Winter Sale soon!</p>
    </div>
</section>
<section id="product1" class="section-p1">
    <div class="pro-container">
            @foreach($products as $product)
            <div class="pro" onclick="window.location.href='{{ route('product', ['id' => $product['Product_ID']]) }}'; return false;">
                <img src="{{ asset($product['image_path']) }}">
                <div class="des">
                    <span>{{ $product['Product_Description'] }}</span>
                    <h5>{{ $product['Product_Name'] }}</h5>
                    <div class="star">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= 4) {{-- Assuming a static rating for now --}}
                                <i class='bx bxs-star'></i>
                            @else
                                <i class='bx bx-star'></i>
                            @endif
                        @endfor
                    </div>
                    <h4>₱{{ $product['Product_Price'] }}</h4>
                </div>
                <a href="#"><i class='bx bxs-cart-alt cart'></i></a>
            </div>
        @endforeach
    </div>
</section>


@endsection
