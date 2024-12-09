<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Client;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'Product_Name' => $request->input('Product_Name'),
            'Product_Description' => $request->input('Product_Description'),
            'Product_Price' => $request->input('Product_Price'),
            'image_path' => $request->file('image')->store('products/images', 'public'),
        ]);

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     */
    public function showProducts()
    {
        $products = Products::all(); // Fetch all products
        return view('frontend.shop', compact('products')); // Pass products to the view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }

    public function testMongoDB()
    {
        try {
            $client = new \MongoDB\Client(env('DB_URI'));
            $collection = $client->BeePackDB2->products;
            $products = $collection->find()->toArray();

            return response()->json([
                'status' => 'success',
                'data' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::where('Product_ID', $productId)->first();
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }
    
        $cart = session()->get('cart', []);
    
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                "name" => $product->Product_Name,
                "quantity" => 1,
                "price" => $product->Product_Price,
                "image" => $product->image_path
            ];
        }
    
        session()->put('cart', $cart);
        session()->flash('success', "{$product->Product_Name} has been added to your cart!");
    
        return redirect()->route('cart.show');
    }
    
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('frontend.cart', compact('cart'));
    }
}
