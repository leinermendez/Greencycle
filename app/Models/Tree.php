<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tree extends Model
{
    
    protected $fillable = [
        'user_id',
        'seed_type_id',
    ];

    protected $casts = [
        'last_cared_at' => 'datetime',
        'next_care_at' => 'datetime',
        'last_decay_at' => 'datetime',
        'planted_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seedType(): BelongsTo
    {
        return $this->belongsTo(SeedType::class);
    }
}
