<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\CustomerOrder;

class CartController extends Controller
{
    /**
     * Add a product to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

     public function cart()
     {
        $cart = session()->get('cart', []);
        return view('frontend.cart', compact('cart'));
     }

    public function add(Request $request)
    {
        $cart = session()->get('cart', []); // Get the cart from the session, or initialize an empty array
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
    
        // Check if the product already exists in the cart
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity; // Update quantity
        } else {
            // Fetch product details from the database (simplified for example)
            $product = Product::find($productId);
            if ($product) {
                $cart[$productId] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                ];
            }
        }
    

        // Save the cart back to the session
        Session::put('cart', $cart);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Display the cart items.
     *
     * @return \Illuminate\View\View
     */

}
