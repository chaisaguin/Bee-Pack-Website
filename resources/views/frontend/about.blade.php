@extends('frontend.master')

@section('title', 'About Us')

@section('content')

<div class="about-team section-p1">
    <span class="badge">ABOUT US</span>
    <br> <img src="{{ asset('media/long-logo-big.png') }}" alt="Bee Pack Logo">
    <h2>We are a creative and<br>talented team of creators</h2>
    <p>Our team consists of skilled professionals who are experts in their fields,<br>working together to bring you the best sustainable packaging solutions.</p>
</div>

<div class="about-features section-p1">
    <h2>The Team</h2>
    <div class="features-container">
        <!-- Feature Card with Team Member 1 -->
        <div class="feature-card team-member">
            <img src="{{ asset('media/about/rem.jpg') }}" alt="Rem Well Pepito" class="team-img">
            <h3>Rem Well Pepito</h3>
            <p>Sales and Finance Head</p>
        </div>

        <!-- Feature Card 2 -->
        <div class="feature-card team-member">
            <img src="{{ asset('media/about/chai.png') }}" alt="Mary Kate Saguin">
            <h3>Mary Kate Saguin</h3>
            <p>Product & Development Designer</p>
        </div>
        <!-- Feature Card 3 -->
        <div class="feature-card team-member">
            <img src="{{ asset('media/about/kat.png') }}" alt="Carylle Toyogon">
            <h3>Carylle Toyogon</h3>
            <p>Logistics Head</p>
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
    background: rgb(255,250,231);
    background: linear-gradient(57deg, rgba(255,250,231,1) 0%, rgba(255,230,120,1) 100%);
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.4);

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

@endsection