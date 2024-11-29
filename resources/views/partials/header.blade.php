<section id="header">
    <a href="{{ url('/') }}"><img src="{{ asset('media/long-logo-small.png') }}" class="logo" alt="Logo"></a>
    <div>
        <ul id="navbar">
            <li><a class="active" href="{{ url('/home') }}">Home</a></li>
            <li><a href="{{ url('shop') }}">Shop</a></li>
            <li><a href="{{ url('about') }}">About</a></li>
            <li><a href="{{ url('cart') }}"><i class='bx bx-cart-alt'></i></a></li>
        </ul>
    </div>
    <div id="mobile">
        <a href="{{ url('cart') }}"><i class='bx bx-cart-alt'></i></a>
        <i id="bar" class='bx bx-menu'></i>
    </div>
</section>
