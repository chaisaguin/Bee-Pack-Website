<!DOCTYPE html>
<html>
<head>
    <title>Browse Products</title>
</head>
<body>
    <h1>All Products</h1>

    @if($products->isEmpty())
        <p>No products available.</p>
    @else
        <ul>
            @foreach ($products as $product)
                <li>
                    <strong>{{ $product->Product_Name }}</strong><br>
                    Price: ${{ $product->Product_Price }}<br>
                    Quantity: {{ $product->Item_Quantity }}<br>
                    Description: {{ $product->Product_Description }}
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
