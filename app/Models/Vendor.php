<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'username', 'password', 'email', 'mobile_number', 'location', 'industry_type','icon_image','status','created_at','updated_at'
    ];

    // Add any additional relationships or methods as needed
}

