<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeedTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cares_per_level' => $this->cares_per_level,
            'harvest_reward' => $this->harvest_reward,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}