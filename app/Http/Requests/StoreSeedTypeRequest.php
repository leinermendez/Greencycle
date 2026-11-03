<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeedTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:20', 'unique:seed_types,name'],
            'cares_per_level' => ['required', 'integer', 'min:1'],
            'harvest_reward' => ['required', 'integer', 'min:0'],
        ];
    }
}