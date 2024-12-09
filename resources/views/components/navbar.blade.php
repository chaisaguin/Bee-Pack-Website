<section id="header">
    <a href="{{ route('home') }}"><img src="{{ asset('media/long-logo-small.png') }}" class="logo"></a>

    <div>
        <ul id="navbar">
            <li><a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
            <li><a class="{{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}">Shop</a></li>
            <li><a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
            <li><a class="{{ request()->routeIs('cart') ? 'active' : '' }}" href="{{ route('cart') }}"><i class='bx bx-cart-alt'></i></a></li>
            
            @if(auth()->check())
                <li><a class="{{ request()->routeIs('customer.account') ? 'active' : '' }}" href="{{ route('customer.account') }}">
                    <i class='bx bx-user-circle'></i>
                </a></li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class='bx bx-log-out'></i>
                    </a>
                </li>
            @else
                <li><a class="{{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                    <i class='bx bx-user-circle'></i>
                </a></li>
            @endif

        </ul>
    </div>

    <div id="mobile">
        @if(auth()->check())
            <a href="{{ route('customer.account') }}"><i class='bx bx-user'></i></a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class='bx bx-log-out'></i>
            </a>
        @else
            <a href="{{ route('login') }}"><i class='bx bx-user-circle'></i></a>
        @endif
        <a href="{{ route('cart') }}"><i class='bx bx-cart-alt'></i></a>
        <i id="bar" class='bx bx-menu'></i>
    </div>
</section>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    const bar = document.getElementById('bar');
    const mobile = document.getElementById('mobile');

    bar.addEventListener('click', () => {
        mobile.classList.toggle('active');
    });
</script>
