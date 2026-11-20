<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_equipped' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'is_equipped.required' => 'Debes indicar si quieres equipar o desequipar el objeto.',
            'is_equipped.boolean' => 'El estado del objeto debe ser verdadero o falso.',
        ];
    }
}
