<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSeedTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $seedTypeId = $this->route('seed_type');

        return [
            'name' => [
                'required',
                'string',
                'max:20',
                Rule::unique('seed_types', 'name')->ignore($seedTypeId),
            ],
            'cares_per_level' => ['required', 'integer', 'min:1'],
            'harvest_reward' => ['required', 'integer', 'min:0'],
        ];
    }
}