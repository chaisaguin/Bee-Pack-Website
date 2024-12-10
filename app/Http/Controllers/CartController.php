<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getCartInstance()
    {
        return Auth::check() ? 'cart_' . Auth::id() : 'default';
    }

    public function index()
    {
        $cartInstance = $this->getCartInstance();
        $products = Cart::instance($cartInstance)->content();
        return view('frontend.cart', compact('products'));
    }

    public function add_to_cart(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'title' => 'required',
            'price' => 'required',
            'quantity' => 'required|numeric|min:1'
        ]);

        $price = floatval(str_replace(['₱', ','], '', $request->price));
        $productId = $request->product_id;
        $title = $request->title;
        $quantity = $request->quantity;
        
        $cartInstance = $this->getCartInstance();
        
        Cart::instance($cartInstance)->add(
            $productId,
            $title,
            $quantity,
            $price
        )->associate(Products::class);

        // Store cart in database
        Cart::instance($cartInstance)->store($cartInstance);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function mergeCart()
    {
        if (Auth::check()) {
            $guestCart = Cart::instance('default')->content();
            $userCartInstance = 'cart_' . Auth::id();

            // Restore user's cart from database if exists
            if (Cart::instance($userCartInstance)->count() == 0) {
                Cart::instance($userCartInstance)->restore(Auth::id());
            }

            // Add guest cart items to user cart
            foreach ($guestCart as $item) {
                Cart::instance($userCartInstance)->add(
                    $item->id,
                    $item->name,
                    $item->qty,
                    $item->price
                )->associate(Products::class);
            }

            // Store updated cart in database
            Cart::instance($userCartInstance)->store(Auth::id());

            // Clear guest cart
            Cart::instance('default')->destroy();
        }
    }

    public function restoreCart()
    {
        if (Auth::check()) {
            $cartInstance = 'cart_' . Auth::id();
            Cart::instance($cartInstance)->restore(Auth::id());
        }
    }

    public function removeItem($rowId)
    {
        $cartInstance = $this->getCartInstance();
        Cart::instance($cartInstance)->remove($rowId);
        
        // Store updated cart
        if (Auth::check()) {
            Cart::instance($cartInstance)->store(Auth::id());
        }

        return redirect()->back()->with('success', 'Item removed from cart');
    }

    public function updateQuantity(Request $request, $rowId)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1'
        ]);

        $cartInstance = $this->getCartInstance();
        Cart::instance($cartInstance)->update($rowId, $request->quantity);

        // Store updated cart
        if (Auth::check()) {
            Cart::instance($cartInstance)->store(Auth::id());
        }

        return redirect()->back()->with('success', 'Cart updated successfully');
    }
}
