<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MascotaRequest extends FormRequest
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
            'nombreFantasia' => 'required|string|min:3|max:50',
            'edad' => 'required|numeric|min:1',
            'sexo' => 'required|string',
            'descripcion' => 'required|string|max:1000',
            'galeriaFotos' => 'array',
            'raza_id' => 'required|numeric'
        ];
    }
}
