@extends('frontend.master1')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="container d-flex justify-content-center align-items-start mt-5">
    <div class="row w-100">
        <div class="col-md-6">
            <div class="card p-4 mb-4" style="border-radius: 5px;">
                <h3 class="text-center mb-4">Account Information</h3>
                <div class="mb-3">
                    <label class="text-muted">Name</label>
                    <p class="font-weight-bold">{{ $customer->Customer_Name }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted">Email</label>
                    <p class="font-weight-bold">{{ $customer->Customer_Email }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted">Contact Number</label>
                    <p class="font-weight-bold">{{ $customer->Customer_ContactNumber }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted">Address</label>
                    <p class="font-weight-bold">{{ $customer->Customer_Address }}</p>
                </div>
                <button class="btn btn-dark" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 mb-4" style="border-radius: 5px;">
                <h3 class="text-center mb-4">Order Status & Feedback</h3>
                @if($orders->isEmpty())
                    <p>No orders found.</p>
                @else
                    <ul class="list-group">
                        @foreach($orders as $order)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Order #{{ $order->order_id }}
                                <span class="badge badge-primary badge-pill">{{ ucfirst($order->status) }}</span>
                                <button class="btn btn-sm btn-outline-secondary ml-3" @if($order->status !== 'Delivered') disabled @endif>Feedback</button>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('customer.update', $customer->Customer_ID) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Customer_Name">Name</label>
                        <input type="text" class="form-control" id="Customer_Name" name="Customer_Name" value="{{ $customer->Customer_Name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="Customer_ContactNumber">Contact Number</label>
                        <input type="text" class="form-control" id="Customer_ContactNumber" name="Customer_ContactNumber" value="{{ $customer->Customer_ContactNumber }}" required>
                    </div>
                    <div class="form-group">
                        <label for="Customer_Address">Address</label>
                        <input type="text" class="form-control" id="Customer_Address" name="Customer_Address" value="{{ $customer->Customer_Address }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f8f8;
    }
    .card {
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .btn-dark {
        background-color: #343a40;
        border-color: #343a40;
    }
</style>
@endsection
