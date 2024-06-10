<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdopcionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'idMascota' => 'required|exists:mascotas,id',
            'idNuevoDuenio' => 'required|exists:users,id',
            'idAntiguoDuenio' => 'required|exists:users,id',
            'descripcion'   => 'required|string|min:30',
            'fotosTestigo'  => 'required'
        ];
    }
}
