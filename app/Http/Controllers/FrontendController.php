<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MongoDB\Client;
use Illuminate\Support\Facades\Cache;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    public function submit_feedback(Request $request)
    {
        if (!Auth::check()) {
            Log::error('User not authenticated.');
            return redirect()->route('login')->with('error', 'Please log in to submit feedback.');
        }

        $user = Auth::user();
        Log::info('Authenticated user: ' . $user->Customer_ID);

        // Validate the request data
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string',
        ]);

        try {
            // Connect to MongoDB
            $client = new \MongoDB\Client(env('DB_URI'));
            $collection = $client->BeePackDB2->feedbacks;

            Log::info('Submitting feedback for user: ' . Auth::user()->Customer_ID);

            // Get the next Feedback_ID using MongoDB's findOne with sort
            $lastFeedback = $collection->findOne(
                [],
                [
                    'sort' => ['Feedback_ID' => -1],
                    'projection' => ['Feedback_ID' => 1]
                ]
            );

            // Ensure proper incrementation
            $currentId = 0;
            if ($lastFeedback && isset($lastFeedback['Feedback_ID'])) {
                $matches = [];
                if (preg_match('/FDBK(\d+)/', $lastFeedback['Feedback_ID'], $matches)) {
                    $currentId = intval($matches[1]);
                }
            }
            $nextId = $currentId + 1;

            // Format the new Feedback_ID
            $feedbackId = sprintf('FDBK%d', $nextId);
            
            Log::info('Last Feedback_ID: ' . ($lastFeedback['Feedback_ID'] ?? 'None') . ', Generated new ID: ' . $feedbackId);

            // Store Feedback_ID in session
            Session::put('checkout.Feedback_ID', $feedbackId);
            Log::info('Stored Feedback_ID in session: ' . $feedbackId);

            // Insert feedback into the database with the new ID
            $result = $collection->insertOne([
                'Feedback_ID' => $feedbackId,
                'Customer_ID' => Auth::user()->Customer_ID,
                'Employee_ID' => 'EMP00002', // Assuming employee ID is not available
                'Customer_Rating' => $validatedData['rating'],
                'Feedback_Comments' => $validatedData['comments'],
            ]);

            Log::info('Feedback submitted successfully.');

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Thank you for your feedback!');
        } catch (\Exception $e) {
            Log::error('Error submitting feedback: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to submit feedback.');
        }
    }
}
