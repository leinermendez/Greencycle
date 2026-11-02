<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpeciesCatalogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'seed_type_id' => ['required', 'integer', 'exists:seed_types,id'],
            'name' => ['required', 'string', 'max:100'],
            'image_url' => ['required', 'string', 'max:255'],
        ];
    }
}