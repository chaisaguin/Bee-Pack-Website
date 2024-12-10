@extends('frontend.master1')

@section('content')
<section class="order-confirmation py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        <h2 class="mt-4">Thank You for Your Order!</h2>
                        <p class="lead">Your order has been successfully placed.</p>
                        
                        @if(isset($order))
                        <div class="order-details mt-4">
                            <h4>Order Details</h4>
                            <p>Order ID: {{ $order->order_id }}</p>
                            <p>Total Amount: ₱{{ number_format((float)$order->total, 2) }}</p>
                            <p>Status: {{ ucfirst($order->status ?? 'Pending') }}</p>
                        </div>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('shop') }}" class="btn btn-primary">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection