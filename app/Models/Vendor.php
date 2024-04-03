<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'username', 'password', 'email', 'mobile_number', 'location', 'industry_type'
    ];

    // Add any additional relationships or methods as needed
}

