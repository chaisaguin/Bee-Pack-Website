@extends('frontend.master') {{-- Use the main layout --}}

@section('title', 'Home') {{-- Page title --}}

@section('content') {{-- Start of the page content --}}

<section id="hero">
    <h4>Bee Pack offers you</h4>
    <h2>Super Value deals!</h2>
    <h1>On All Products</h1>
    <p>Save more up to 30% off this Winter Szn!</p>
    <a href="{{ url('shop') }}"><button>Shop Now</button></a>
</section>
<div class="about-hero section-p1" id="">
    <div class="hero-content">
        <span class="badge">WELCOME TO BEE PACK</span>
        <h1>We are an Eco-Friendly<br>Packaging Company</h1>
        <p class="subtitle">Creating sustainable solutions for a better tomorrow</p>
        <a href="#learn-more" class="learn-more-btn">LEARN MORE <i class='bx bx-right-arrow-alt'></i></a>
    </div>
    
    <div class="service-tags">
        <div class="tag">SUSTAINABLE</div>
        <div class="tag">ECO-FRIENDLY</div>
        <div class="tag">INNOVATIVE</div>
    </div>
</div>

<div class="about-features section-p1">
    <h2>What We Offer</h2>
    <div class="features-container">
        <div class="feature-card">
            <i class='bx bxs-group' ></i>
            <h3>Who we are &<br>what we do</h3>
            <p>Learn our mission & values</p>
            <a href="#" class="feature-btn">START HERE <i class='bx bx-right-arrow-alt'></i></a>
        </div>

        <div class="feature-card">
            <i class='bx bxs-palette' ></i>
            <h3>We'll design your<br>projects</h3>
            <p>Custom packaging solutions</p>
            <a href="#" class="feature-btn">START HERE <i class='bx bx-right-arrow-alt'></i></a>
        </div>

        <div class="feature-card">
            <i class='bx bxs-contact' ></i>
            <h3>Drop us your<br>message!</h3>
            <p>Get in touch with our team</p>
            <a href="#" class="feature-btn">START HERE <i class='bx bx-right-arrow-alt'></i></a>
        </div>
    </div>
</div>

<style>
.about-hero {
    text-align: center;
    padding: 80px 20px;
    background-color: #f9f9f9;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

.badge {
    background-color: #f5bb00;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    display: inline-block;
    margin-bottom: 20px;
}

.about-hero h1 {
    font-size: 48px;
    margin-bottom: 20px;
    line-height: 1.2;
}

.subtitle {
    font-size: 18px;
    color: #666;
    margin-bottom: 30px;
}

.learn-more-btn {
    display: inline-flex;
    align-items: center;
    background-color: #000;
    color: white;
    padding: 12px 24px;
    border-radius: 30px;
    text-decoration: none;
    transition: transform 0.3s ease;
}

.learn-more-btn:hover {
    transform: translateY(-3px);
}

.service-tags {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 50px;
}

.tag {
    padding: 15px 25px;
    background-color: #fff;
    border-radius: 10px;
    font-weight: bold;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transform: rotate(-5deg);
    transition: transform 0.3s ease;
}

.tag:hover {
    transform: rotate(0deg);
}

.about-features {
    padding: 80px 20px;
}

.about-features h2 {
    text-align: center;
    margin-bottom: 50px;
}

.features-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
}

.feature-card {
    background-color: #f5f5f5;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-10px);
    background: linear-gradient(57deg, rgba(255,250,231,1) 0%, rgba(255,230,120,1) 100%);

}

.feature-card img {
    width: 150px;
    height: 150px;
    margin-bottom: 20px;
}

.feature-card h3 {
    margin-bottom: 15px;
    font-size: 24px;
}

.feature-btn {
    display: inline-flex;
    align-items: center;
    color: #000;
    text-decoration: none;
    margin-top: 20px;
    font-weight: bold;
}

.about-team {
    text-align: center;
    padding: 80px 20px;
    background-color: #f9f9f9;
}

.about-team h2 {
    margin: 20px 0;
    font-size: 36px;
}

.about-team p {
    color: #666;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .about-hero h1 {
        font-size: 36px;
    }
    
    .service-tags {
        flex-direction: column;
        align-items: center;
    }
    
    .features-container {
        grid-template-columns: 1fr;
    }
}
</style>
<section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>Sustainability starts here! Check out an overview of our products!</p>
    <div class="pro-container">
        {{-- Reusable Product Card Components --}}
        @include('components.product-card', [
            'img' => 'media/products/f1.png',
            'collection' => 'Bee Pack Winter Collection',
            'title' => 'Roll-on Food Wrap',
            'price' => '$20',
            'rating' => 4,
        ])

        @include('components.product-card', [
            'img' => 'media/products/f3.png',
            'collection' => 'Bee Pack Winter Collection',
            'title' => 'Roll-on Food Wrap',
            'price' => '$20',
            'rating' => 4,
        ])

        @include('components.product-card', [
            'img' => 'media/products/f5.png',
            'collection' => 'Bee Pack Winter Collection',
            'title' => 'Roll-on Food Wrap',
            'price' => '$20',
            'rating' => 4,
        ])

        @include('components.product-card', [
            'img' => 'media/products/f2.png',
            'collection' => 'Bee Pack Winter Collection',
            'title' => 'Roll-on Food Wrap',
            'price' => '$20',
            'rating' => 4,
        ])

        @include('components.product-card', [
        'img' => 'media/products/f4.png',
        'collection' => 'Bee Pack Variety',
        'title' => 'Five-Pack Assorted Wrap',
        'price' => '$30',
        'rating' => 4.5,
        ])

        @include('components.product-card', [
            'img' => 'media/products/f5.png',
            'collection' => 'Bee Pack Bowl Collection',
            'title' => 'Bowl Cover',
            'price' => '$25',
            'rating' => 4,
        ])
    
    </div>
</section>

@endsection
