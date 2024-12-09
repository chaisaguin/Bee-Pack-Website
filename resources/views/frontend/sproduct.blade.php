@extends('frontend.master')

@section('title', 'Product Details')

@section('content')
<section id="prodetails" class="section-p1">
    <div class="single-pro-image">
        <img src="{{ asset($product['image_path'] ?? 'media/products/default.png') }}" width="100%" id="MainImg" alt="Product Image">
        <div class="small-img-group">
            <div class="small-img-col">
                <img src="{{ asset($product['image_path'] ?? 'media/products/default.png') }}" width="100%" class="small-img" alt="">
            </div>
            <div class="small-img-col">
                <img src="{{ asset('media/products/f8.png') }}" width="100%" class="small-img" alt="">
            </div>
            <div class="small-img-col">
                <img src="{{ asset('media/products/f6.png') }}" width="100%" class="small-img" alt="">
            </div>
        </div>
    </div>

    <div class="single-pro-details">
        <h5>SHOP / PRODUCTS</h5>


        <h4>{{ $product['title'] ?? $product['Product_Name'] }}</h4>
        <h2>{{ $product['price'] ?? '₱' . $product['Product_Price'] }}</h2>


        <input type="number" value="1">

       <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product['id'] ?? $product['Product_ID'] }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="normal">
                <i class='bx bx-cart'></i> Add To Cart
            </button>
        </form>


        <hr class="solid">
        <h3><i class='bx bx-list-ul'></i> PRODUCT DETAILS</h3>
        <p>{{ $product['description'] ?? $product['Product_Description'] }}</p>
        <p>{{ $product['more_description'] ?? $product['More_Description'] }}</p>



        <h3><i class='bx bx-food-menu'></i> INGREDIENTS</h3>
        <p id="ing">Made in Philippines with organic cotton, beeswax, organic plant oil, and tree resin.</p>
        
        <h3><i class='bx bx-leaf'></i> HOW TO USE AND CARE</h3>
        <p>
            <strong>Cover<br></strong>
            Place over a bowl. Use the warmth of your hands to press the cover to the sides of the bowl, using the shape to form a tight grip.<br><br>

            <strong>Rinse<br></strong>
            Hand-wash in cool water with mild dish soap, then air dry. Avoid exposure to heat and hot water to keep your wraps in tip-top shape.<br><br>

            <strong>Reuse<br></strong>
            Reuse for an entire year with regular use and good care. At the end of its life, wraps can be composted or used as a natural fire starter.<br><br>
        </p>
    </div>
</section>

<div id="sproductfeatures">
    <section id="product1" class="section-p1">
        <h2>You may also like...</h2>
        <div class="pro-container">
            @include('components.product-card', [
                'img' => 'media/products/f1.png',
                'collection' => 'Bee Pack Winter Collection',
                'title' => 'Roll-on Food Wrap',
                'price' => '$20',
                'rating' => 4,
                'link' => route('product', ['id' => 1])
            ])

            @include('components.product-card', [
                'img' => 'media/products/f5.png',
                'collection' => 'Bee Pack Winter Collection',
                'title' => 'Roll-on Food Wrap',
                'price' => '$20',
                'rating' => 4,
                'link' => route('product', ['id' => 5])
            ])

            @include('components.product-card', [
                'img' => 'media/products/f2.png',
                'collection' => 'Bee Pack Winter Collection',
                'title' => 'Roll-on Food Wrap',
                'price' => '$20',
                'rating' => 4,
                'link' => route('product', ['id' => 2])
            ])
        </div>
    </section>
</div>

<script>
    var MainImg = document.getElementById("MainImg");
    var smallimg = document.getElementsByClassName("small-img");

    smallimg[0].onclick = function() {
        MainImg.src = smallimg[0].src;
    }
    smallimg[1].onclick = function() {
        MainImg.src = smallimg[1].src;
    }
    smallimg[2].onclick = function() {
        MainImg.src = smallimg[2].src;
    }
</script>
@endsection