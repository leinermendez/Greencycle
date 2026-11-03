<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'item_id' => ['required', 'integer', 'exists:items_catalog,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }
}