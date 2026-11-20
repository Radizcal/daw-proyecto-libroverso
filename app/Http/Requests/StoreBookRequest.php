<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:200',
            'author' => 'required|string|max:150',
            'total_pages' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El título del libro es obligatorio.',
            'title.string' => 'El título del libro debe ser un texto.',
            'title.max' => 'El título del libro no puede superar los 200 caracteres.',

            'author.required' => 'El autor es obligatorio.',
            'author.string' => 'El autor debe ser un texto.',
            'author.max' => 'El autor no puede superar los 150 caracteres.',

            'total_pages.required' => 'El número total de páginas es obligatorio.',
            'total_pages.integer' => 'El número total de páginas debe ser un número entero.',
            'total_pages.min' => 'El libro debe tener al menos una página.',
        ];
    }
}
