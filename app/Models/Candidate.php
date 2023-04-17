<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'city',
        'country',
        'phone',
        'birth_date',
        'bio',
        'resume',
        'user_id',
    ];
}
