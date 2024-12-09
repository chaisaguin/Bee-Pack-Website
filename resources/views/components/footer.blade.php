<footer class="section-p1">
    <div class="col">
        <img class="logo" src="{{ asset('media/logo-small.png') }}" alt="">
        <h4>Contact</h4>
        <p><strong>Address:</strong> Cagayan de Oro City</p>
        <p><strong>Phone:</strong>(+63)-9974837101</p>
        <div class="follow">
            <h4>Follow us!</h4>
            <div class="icon">
                <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                <a href="#"><i class='bx bxl-instagram'></i></a>
                <a href="#"><i class='bx bxl-tiktok'></i></a>
            </div>
        </div>
    </div>

    <div class="col">
        <h4>About</h4>
        <a href="{{ route('about') }}">About Us</a>
        <a href="#">Delivery Information</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms & Conditions</a>
        <a href="#">Contact us</a>
    </div>

    <div class="col">
        <h4>My Account</h4>
        <a href="#">Sign in</a>
        <a href="{{ route('cart') }}">View Cart</a>
        <a href="#">Track My Order</a>
        <a href="#">Help</a>
    </div>

    <div class="col secure">
        <p>Payment Gateways</p>
        <img class="pay" src="{{ asset('media/pay.png') }}" alt="">
    </div>

    <div class="cred">
        <p>© 2024, PST Tech Devs - Bee Pack Ecommerce Website</p>
    </div>
</footer>
