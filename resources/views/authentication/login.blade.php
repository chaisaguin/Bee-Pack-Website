@extends('frontend.master1')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 350px; border-radius: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="text-center mb-4">
            <img src="{{ asset('media/icon.png') }}" alt="Bee Pack Icon" style="width: 100px;">
        </div>
        <h3 class="text-center mb-4" style="font-weight: bold;">Login to your account</h3>
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="email" name="Customer_Email" class="form-control" placeholder="Email" style="border-radius: 30px;" required>
            </div>
            <div class="form-group mt-3">
                <input type="password" name="password" class="form-control" placeholder="Password" style="border-radius: 30px;" required>
            </div>
            <button type="submit" class="btn btn-warning btn-block mt-4" style="border-radius: 30px; background-color: #f0ad4e;">Sign in</button>
        </form>
        <p class="text-center mt-3">Don't have an account?<br><a href="{{ route('register') }}" style="color:#519725; font-weight: bold;">Register Now!</a></p>
    </div>
</div>
<style>
    body {
        background-color: #f8f8f8;
    }
    .card {
        border-radius: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .form-control {
        border-radius: 30px;
    }
    .btn-warning {
        background-color: #f0ad4e;
        border-radius: 30px;
    }
</style>
@endsection