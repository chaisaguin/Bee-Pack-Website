<div class="pro" onclick="window.location.href='{{ $link ?? '#' }}'; return false;">
    <img src="{{ asset($img) }}">
    <div class="des">
        <span>{{ $collection }}</span>
        <h5>{{ $title }}</h5>
        <div class="star">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $rating)
                    <i class='bx bxs-star'></i>
                @else
                    <i class='bx bx-star'></i>
                @endif
            @endfor
        </div>
        <h4>{{ $price }}</h4>
    </div>
    <a href="#"><i class='bx bxs-cart-alt cart'></i></a>
</div>