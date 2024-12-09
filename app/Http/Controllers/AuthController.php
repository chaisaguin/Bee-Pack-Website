<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // If it's a GET request, return the login view
        if ($request->isMethod('get')) {
            if (Auth::check()) {
                return redirect()->route('customer.account');
            }
            return view('authentication.login');
        }

        // If it's a POST request, handle login authentication
        $request->validate([
            'Customer_Email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Find the customer by email
        $customer = Customer::where('Customer_Email', $request->Customer_Email)->first();

        // Check if customer exists and password matches
        if ($customer && $customer->Password === $request->password) {
            // Manually log in the user
            Auth::login($customer);
            
            // Regenerate session for security
            $request->session()->regenerate();

            // Redirect to account page after successful login
            return redirect()->route('customer.account')->with('success', 'Login successful!');
        }

        // If authentication fails, redirect back with error
        return back()->withErrors([
            'Customer_Email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('Customer_Email'));
    }

    public function register()
    {
        return view('authentication.register');
    }

    public function store(Request $request)
    {
        $nextId = Customer::count() + 1;
        $nextId = str_pad($nextId, 8, '0', STR_PAD_LEFT);

        $request->validate([
            'Customer_Name' => 'required|string|max:255',
            'Customer_Email' => 'required|email|unique:customers,Customer_Email',
            'Customer_ContactNumber' => 'required|string',
            'Customer_Address' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the customer
        $customer = Customer::create([
            'Customer_ID' => 'CUST' . $nextId,
            'Customer_Name' => $request->Customer_Name,
            'Customer_Email' => $request->Customer_Email,
            'Customer_ContactNumber' => $request->Customer_ContactNumber,
            'Customer_Address' => $request->Customer_Address,
            'Password' => $request->password, // Store plain password
        ]);

        // Log in the customer
        Auth::login($customer);

        // Cache the customer data for 10 minutes
        Cache::put('customer_' . $customer->Customer_ID, $customer, 600); // Cache for 10 minutes

        return redirect()->route('customer.account')->with('success', 'Registration successful!');
    }

    public function account()
    {
        $customer = Auth::user();
        return view('customer.account', ['customer' => $customer]);
    }

    public function getCustomer($customerId)
    {
        // Try to get the customer from the cache
        $customer = Cache::get('customer_' . $customerId);

        if (!$customer) {
            // If not found in cache, retrieve from database
            $customer = Customer::find($customerId);
            
            // Store in cache for future requests
            Cache::put('customer_' . $customerId, $customer, 600); // Cache for 10 minutes
        }

        return view('customer.show', compact('customer'));
    }

    public function updateCustomer(Request $request, $customerId)
    {
        $request->validate([
            'Customer_Name' => 'required|string|max:255',
            'Customer_ContactNumber' => 'required|string',
            'Customer_Address' => 'required|string',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $customer = Customer::find($customerId);
        
        // Update basic information
        $customer->Customer_Name = $request->Customer_Name;
        $customer->Customer_ContactNumber = $request->Customer_ContactNumber;
        $customer->Customer_Address = $request->Customer_Address;

        // Handle password change
        if ($request->filled('current_password')) {
            if ($request->current_password !== $customer->Password) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            $customer->Password = $request->new_password;
        }

        $customer->save();

        // Clear the cache for this customer
        Cache::forget('customer_' . $customerId);

        return redirect()->route('customer.account')->with('success', 'Profile updated successfully!');
    }

    public function sendVerificationEmail($customerId)
    {
        $customer = Customer::find($customerId);
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $customer->Customer_ID]
        );

        Mail::send('emails.verify', ['url' => $verificationUrl], function($message) use ($customer) {
            $message->to($customer->Customer_Email)
                    ->subject('Verify Your Email Address');
        });

        return back()->with('success', 'Verification link sent!');
    }

    public function verifyEmail(Request $request, $id)
    {
        if (!$request->hasValidSignature()) {
            return response()->json(['msg' => 'Invalid/Expired url provided.'], 401);
        }

        $customer = Customer::find($id);
        if (!$customer->email_verified_at) {
            $customer->email_verified_at = now();
            $customer->save();
        }

        return redirect()->route('customer.account')->with('success', 'Email verified successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }
}
