<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Myusers extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'location',
        'mobile_number',
        'password',
    ];
}
