@extends('layouts.app') {{-- Use the main layout --}}

@section('title', 'Home') {{-- Page title --}}

@section('content') {{-- Start of the page content --}}

<section id="hero">
    <h4>Bee Pack offers you</h4>
    <h2>Super Value deals!</h2>
    <h1>On All Products</h1>
    <p>Save more up to 30% off this Winter Szn!</p>
    <a href="{{ url('shop') }}"><button>Shop Now</button></a>
</section>

<section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>Sustainability starts here! Check out an overview of our products!</p>
    <div class="pro-container">
        {{-- Reusable Product Card Components --}}
        @include('partials.product-card', [
            'img' => 'media/products/f1.png',
            'collection' => 'Bee Pack Winter Collection',
            'title' => 'Roll-on Food Wrap',
            'price' => '$20',
            'rating' => 4,
        ])

        @include('partials.product-card', [
            'img' => 'media/products/f3.png',
            'collection' => 'Bee Pack Winter Collection',
            'title' => 'Roll-on Food Wrap',
            'price' => '$20',
            'rating' => 4,
        ])

        @include('partials.product-card', [
            'img' => 'media/products/f5.png',
            'collection' => 'Bee Pack Winter Collection',
            'title' => 'Roll-on Food Wrap',
            'price' => '$20',
            'rating' => 4,
        ])

        @include('partials.product-card', [
            'img' => 'media/products/f2.png',
            'collection' => 'Bee Pack Winter Collection',
            'title' => 'Roll-on Food Wrap',
            'price' => '$20',
            'rating' => 4,
        ])
    </div>
</section>

@endsection
