<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname', 'lastname', 'email', 'phonenumber1', 'phonenumber2', 'comment'
    ];

    
}
