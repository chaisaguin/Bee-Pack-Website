@extends('frontend.master')

@section('title', 'Product Details')

@section('content')
<style>
    .alert {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 40px;
        border: none;
        border-radius: 16px;
        padding: 15px 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
        width: 500px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }

    .alert i {
        font-size: 1.1em;
        vertical-align: middle;
    }

    .alert-close {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        padding: 5px;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.2s;
        border-radius: 10px;
    }

    .alert-close:hover {
        opacity: 1;
    }

    .alert-close .bx {
        font-size: 1.5em;
        color: inherit;
    }

    .fade {
        transition: opacity 0.15s linear;
    }
</style>

<div class="container mt-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class='bx bxs-check-circle me-2'></i>
                    {{ session('success') }}
                    <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">
                        <i class='bx bx-x'></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">
                        <i class='bx bx-x'></i>
                    </button>
                </div>
            @endif
        </div>



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



        <!--ADD TO CART BUTTON AND FORMS-->
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <!-- Quantity Control -->
            <div class="quantity-control">
                <button type="button" class="qty-btn minus" aria-label="Decrease quantity">-</button>
                <input type="number" name="quantity" value="1" min="1" class="qty-input">
                <button type="button" class="qty-btn plus" aria-label="Increase quantity">+</button>
            </div>
            
            <!-- Product ID -->
            <!-- Product Information -->
            <input type="hidden" name="product_id" value="{{ $product['Product_ID'] }}" />
            <input type="hidden" name="title" value="{{ $product['Product_Name'] }}" />
            <input type="hidden" name="price" value="{{ str_replace(['₱', ','], '', $product['Product_Price']) }}" />


            <!-- Submit Button -->
            <button type="submit" class="normal"> 
                Add To Cart
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

        // Quantity Control JavaScript
    document.querySelectorAll('.quantity-control').forEach(control => {
        const input = control.querySelector('.qty-input');
        const increaseBtn = control.querySelector('.qty-btn.plus');
        const decreaseBtn = control.querySelector('.qty-btn.minus');

        // Increase Quantity
        increaseBtn.addEventListener('click', () => {
            input.value = parseInt(input.value) + 1;
        });

        // Decrease Quantity
        decreaseBtn.addEventListener('click', () => {
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });
    });

</script>
@endsection