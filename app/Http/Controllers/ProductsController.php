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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
        {
            // Initialize the MongoDB client with the URI from the .env file
            $client = new Client(env('DB_URI'));

            // Access the BeePackDB database and the products collection
            $collection = $client->BeePackDB2->products;

            // Fetch all documents from the products collection
            $products = collect($collection->find()->toArray());

            // Return the data to the view
            return view('browse_products', ['products' => $products]);
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
}
