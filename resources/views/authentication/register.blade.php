@extends('frontend.master1')

@section('content')

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4" style="width: 350px; border-radius: 5px;">
        <h3 class="text-center mb-4">Register</h3>
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" id="name" name="Customer_Name" placeholder="Name" required>
            </div>
            <div class="form-group mt-3">
                <label for="email">Your Email</label>
                <input type="email" class="form-control" id="email" name="Customer_Email" placeholder="Email" required>
            </div>
            <div class="form-group mt-3">
                <label for="contact">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="Customer_ContactNumber" placeholder="Contact Number" required>
            </div>
            <div class="form-group mt-3">
                <label for="address">Complete Address</label>
                <input type="text" class="form-control" id="address" name="Customer_Address" placeholder="Address" required>
            </div>
            <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required onkeyup="validatePassword()">
                <small id="passwordHelp" class="form-text text-danger"></small>
            </div>
            <div class="form-group mt-3">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required onkeyup="validatePassword()">
                <small id="confirmPasswordHelp" class="form-text text-danger"></small>
            </div>
            <button type="submit" class="btn btn-dark btn-block mt-4" id="submitBtn">Register</button>
        </form>
        <p class="text-center mt-3">Already have an account?<br><a href="{{ route('login') }}" style="color:#519725;"><strong>Login</strong></a></p>
    </div>
</div>
<style>
    body {
        background-color: #ffffff;
    }
    .card {
        border-radius: 5px;
        box-shadow: none;
    }
    .form-control {
        border-radius: 5px;
    }
    .btn-dark {
        background-color: #333333;
        border-radius: 5px;
    }
</style>
<script>
function validatePassword() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;
    const submitBtn = document.getElementById('submitBtn');
    const passwordHelp = document.getElementById('passwordHelp');
    const confirmPasswordHelp = document.getElementById('confirmPasswordHelp');

    // Check password length
    if (password.length < 8) {
        passwordHelp.textContent = 'Password must be at least 8 characters long';
        submitBtn.disabled = true;
        return;
    } else {
        passwordHelp.textContent = '';
    }

    // Check if passwords match
    if (password !== confirmPassword && confirmPassword !== '') {
        confirmPasswordHelp.textContent = 'Passwords do not match';
        submitBtn.disabled = true;
    } else {
        confirmPasswordHelp.textContent = '';
        submitBtn.disabled = false;
    }
}
</script>
@endsection