<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Movie extends Model
{
    protected $connection = 'mongodb';
}
