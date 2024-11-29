<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use MongoDB\Client;

class EmployeeController extends Controller
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

            // Access the BeePackDB database and the employee collection
            $collection = $client->BeePackDB->employee;

            // Fetch all documents from the employee collection
            $employees = $collection->find()->toArray();

            // Return the data or debug it
            return view('browse_employees', ['employees' => $employees]); // Adjust to your Blade file
        }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
