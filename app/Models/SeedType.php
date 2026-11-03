<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeedType extends Model
{
    protected $fillable = [
        'name',
        'cares_per_level',
        'harvest_reward',
    ];

    public function trees(): HasMany
    {
        return $this->hasMany(Tree::class);
    }
}
