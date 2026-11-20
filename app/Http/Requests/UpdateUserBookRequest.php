<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'book_id' => 'sometimes|required|integer|exists:books,id',
            'started_at' => 'sometimes|nullable|date',
            'status' => 'sometimes|required|string|in:reading,paused,completed',
            'completed_at' => 'sometimes|nullable|date|after_or_equal:started_at',
        ];
    }

    public function messages(): array
    {
        return [
            'book_id.required' => 'Debes seleccionar un libro.',
            'book_id.integer' => 'El identificador del libro debe ser un número entero.',
            'book_id.exists' => 'El libro seleccionado no existe.',

            'started_at.date' => 'La fecha de inicio no es válida.',

            'status.required' => 'El estado de lectura es obligatorio.',
            'status.string' => 'El estado de lectura debe ser un texto.',
            'status.in' => 'El estado debe ser leyendo, pausado o completado.',

            'completed_at.date' => 'La fecha de finalización no es válida.',
            'completed_at.after_or_equal' => 'La fecha de finalización no puede ser anterior a la fecha de inicio.',
        ];
    }
}
