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
    public function cart()
    {
        return view('frontend.cart');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $product = Products::create([
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

}
