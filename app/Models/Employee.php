<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Employee extends Model
{
    protected $connection = 'mongodb'; // Use the MongoDB connection
    protected $collection = 'employee'; // Use the `employee` collection
}
