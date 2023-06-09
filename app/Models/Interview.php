<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable =[
        'candidature_id',
        'date',
        'time',
        'details',
    ];

    public function candidature()
    {
        return $this->belongsTo(Candidature::class);
    }
}
