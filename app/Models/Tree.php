<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tree extends Model
{
    protected $fillable = [
        'user_id',
        'species_id',
        'seed_type',
        'level',
        'care_count',
        'health',
        'status',
        'auto_water_until',
        'accelerator_until',
        'planted_at',
    ];

    protected $casts = [
        'auto_water_until' => 'datetime',
        'accelerator_until' => 'datetime',
        'planted_at' => 'datetime',
    ];
    //$casts hace que las fechas sean tratadas como fechas por Laravel.

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function species(): BelongsTo
    {
        return $this->belongsTo(SpeciesCatalog::class);
    }


    //RELACIONES 
    public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

public function species(): BelongsTo
{
    return $this->belongsTo(SpeciesCatalog::class);
}
}
