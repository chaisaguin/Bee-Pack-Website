<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MongoDB\Client;
use Illuminate\Support\Facades\Cache;
use App\Models\CustomerOrder;
class FrontendController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function home()
    {
        return view('frontend.home');
    }

    public function shop()
    {
        try {
            $client = new \MongoDB\Client(env('DB_URI'));
            $collection = $client->BeePackDB2->products;
            $products = collect($collection->find()->toArray());
    
            // Log the number of products fetched
            Log::info('Number of products fetched: ' . $products->count());
    
            // Check if any products were found
            if ($products->isEmpty()) {
                Log::warning('No products found in the database.');
                return view('frontend.shop', ['products' => []]);
            }
            // Ensure no caching is interfering with data retrieval
            Log::info('Products:', $products->toArray());
    
            return view('frontend.shop', ['products' => $products]);
        } catch (\Exception $e) {
            Log::error('Error fetching products: ' . $e->getMessage());
            return abort(500, 'Error fetching products from the database.');
        }
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    
    public function product($id)
    {
        // Initialize the MongoDB client with the URI from the .env file
        $client = new \MongoDB\Client(env('DB_URI'));
        $collection = $client->BeePackDB2->products;

        // Fetch the product with the given Product_ID
        $product = $collection->findOne(['Product_ID' => $id]);

        if (!$product) {
            abort(404);
        }

        return view('frontend.sproduct', ['product' => $product]);
    }

    public function updateProduct(Request $request, $productID)
    {
        try {
            // Assume $updatedData contains the updated product data
            $updatedData = $request->all();
            
            // Update the product in the database
            $client = new \MongoDB\Client(env('DB_URI'));
            $collection = $client->BeePackDB2->products;
            $collection->updateOne(['Product_ID' => $productID], ['$set' => $updatedData]);

            // Clear the cache for products
            Cache::forget('products'); // This will force the cache to be refreshed

            // Optionally, you can also broadcast the update event to notify clients
            event(new ProductUpdated($updatedData));

            return response()->json(['message' => 'Product updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating product'], 500);
        }
    }

}
