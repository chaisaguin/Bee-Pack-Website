<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

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
            Cart::instance($cartInstance)->store($cartInstance);
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

    public function increase_cart_quantity($rowId)
        {
            $product = Cart::instance('cart')->get($rowId);
            $qty = $product->qty + 1;
            Cart::instance('cart')->update($rowId, $qty);
            return redirect()->back();
        }

    public function decrease_cart_quantity($rowId)
        {
            $product = Cart::instance('cart')->get($rowId);
            $qty = $product->qty - 1;
            Cart::instance('cart')->update($rowId, $qty);
            return redirect()->back();
        }


    public function checkout() {
        if(!Auth::check())
        {
            return redirect()->route('login');
        }

        $cartInstance = $this->getCartInstance();
        $cart = Cart::instance($cartInstance);
        
        // For MongoDB, we use _id instead of id
        $address = Address::where('user_id', (string)Auth::user()->_id)
                         ->where('is_default', true)
                         ->first();
                         
        return view('frontend.checkout', [
            'address' => $address,
            'cartItems' => $cart->content(),
            'cartSubtotal' => $cart->subtotal(),
            'cartTax' => $cart->tax(),
            'cartTotal' => $cart->total()
        ]);
    }

    public function place_an_order(Request $request) {
        try {
            // Validate the request
            $validated = $request->validate([
                'mode' => 'required|in:online_banking,cod,gcash,e_wallet'
            ]);

            if (!Auth::check()) {
                return redirect()->route('login');
            }

            $user_id = Auth::user()->_id;
            
            // Debug information
            Log::info('Checkout Debug:', [
                'user_id' => $user_id,
                'payment_mode' => $request->mode,
                'session_data' => Session::get('checkout')
            ]);

            $address = Address::where('user_id', $user_id)
                ->where('is_default', true)
                ->first();
            
            if(!$address) {
                $validated = $request->validate([
                    'name' => 'required',
                    'address' => 'required',
                    'landmark' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'country' => 'required',
                    'zip' => 'required',
                    'phone' => 'required',
                ]);

                $address = new Address();
                $address->user_id = $user_id;
                $address->name = $request->name;
                $address->address = $request->address;
                $address->landmark = $request->landmark;
                $address->city = $request->city;
                $address->state = $request->state;
                $address->country = $request->country;
                $address->zip = $request->zip;
                $address->phone = $request->phone;
                $address->is_default = true;
                $address->save();

                Log::info('New address created:', $address->toArray());
            }
            
            $cartInstance = $this->getCartInstance();
            if (!Cart::instance($cartInstance)->count()) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty');
            }

            // Check if checkout session exists
            if (!Session::has('checkout')) {
                $this->setAmountForCheckout();
            }

            $checkoutData = Session::get('checkout');
            if (!$checkoutData) {
                throw new \Exception('Checkout data is missing');
            }

            Log::info('Creating order with data:', [
                'user_id' => $user_id,
                'checkout_data' => $checkoutData
            ]);

            $order = new Order();
            $order->user_id = $user_id;
            $order->order_id = $checkoutData['order_id'];
            $order->status = $checkoutData['status'];
            $order->subtotal = $checkoutData['subtotal'];
            $order->tax = $checkoutData['tax'];
            $order->total = $checkoutData['total'];
            $order->name = $address->name;
            $order->phone = $address->phone;
            $order->locality = $address->locality ?? null;
            $order->address = $address->address;
            $order->city = $address->city;
            $order->state = $address->state;
            $order->country = $address->country;
            $order->landmark = $address->landmark;
            $order->zip = $address->zip;
            $order->save();

            Log::info('Order created:', $order->toArray());

            foreach (Cart::instance($cartInstance)->content() as $item) {
                $orderItem = new OrderItem();
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->price = $item->price;
                $orderItem->quantity = $item->qty;
                $orderItem->save();
            }

            $transaction = new Transaction();
            $transaction->user_id = $order->user_id;
            $transaction->order_id = $order->id;
            
            switch($request->mode) {
                case 'online_banking':
                    $transaction->mode = 'online_bank';
                    break;
                case 'cod':
                    $transaction->mode = 'cash_on_delivery';
                    break;
                case 'gcash':
                    $transaction->mode = 'gcash';
                    break;
                case 'e_wallet':
                    $transaction->mode = 'e_wallet';
                    break;
            }
            
            $transaction->status = 'pending';
            $transaction->amount = $order->total;
            $transaction->save();

            Log::info('Transaction created:', $transaction->toArray());
        
            Cart::instance($cartInstance)->destroy();
            Session::forget('checkout');

            return redirect()->route('cart.order-confirmation', ['orderId' => $order->id]);
            
        } catch (\Exception $e) {
            Log::error('Order placement error: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all(),
                'user_id' => Auth::id(),
                'cart_content' => Cart::instance($this->getCartInstance())->content(),
                'session_data' => Session::all()
            ]);
            return back()->with('error', 'An error occurred while placing your order: ' . $e->getMessage());
        }
    }

    public function order_confirmation($orderId) 
    {
        try {
            $order = Order::findOrFail($orderId);
            return view('frontend.order-confirmation', compact('order'));
        } catch (\Exception $e) {
            Log::error('Order confirmation error: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'Order not found');
        }
    }

    public function setAmountForCheckout()
    {
        if (Cart::instance('cart')->content()->count() > 0) {
            Session::forget('checkout');
            return;
        }

        Session::put('checkout', [
            'discount' => 0,
            'subtotal' => Cart::instance('cart')->subtotal(),
            'tax' => Cart::instance('cart')->tax(),
            'total' => Cart::instance('cart')->total(),
        ]);
    }
}
