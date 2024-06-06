<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
        $rules = [
            'nombreCompleto'    => 'required',
            'password'          => 'required|string|min:6',  
            'email'             => 'required|string|unique:users',
            'provincia'         => 'required|string',
            'ciudad'            => 'required|string|min:4',
            'direccion'         => 'required|string|min:5|max:50',
        ];

        if($this->request->get('refugio') === 'true') {
            $rules = array_merge($rules, [
                'descripcion'   => 'required|string',
                'horario'       => 'required|string',
            ]);

            
        } else {
            $rules = array_merge($rules, [
                'dni' => 'required|unique:users',
            ]);
        }
        return $rules;



    }
}
