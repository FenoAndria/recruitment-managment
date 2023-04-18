<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'published_at',
        'deadline',
        'description',
        'missions',
        'profile_required',
        'urgent',
        'visibility',
        'company_id',
    ];

    protected $casts = [
        'urgent' => 'boolean',
        'visibility' => 'boolean',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function candidature(): HasMany
    {
        return $this->hasMany(Candidature::class);
    }
}
