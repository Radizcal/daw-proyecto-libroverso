<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReadingSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_book_id' => 'required|integer|exists:user_books,id',
            'pages_read' => 'required|integer|min:1',
            'read_at' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'user_book_id.required' => 'Debes seleccionar un libro de tu biblioteca.',
            'user_book_id.integer' => 'El identificador del libro debe ser un número entero.',
            'user_book_id.exists' => 'El libro seleccionado no existe en la biblioteca.',

            'pages_read.required' => 'Debes indicar las páginas leídas.',
            'pages_read.integer' => 'Las páginas leídas deben ser un número entero.',
            'pages_read.min' => 'Debes leer al menos una página.',

            'read_at.required' => 'Debes indicar la fecha de lectura.',
            'read_at.date' => 'La fecha de lectura no es válida.',
        ];
    }
}
