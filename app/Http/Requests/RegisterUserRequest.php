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
        return [
            'nombreCompleto'    => 'required',
            'password'          => 'required|string|min:6',  
            'email'             => 'required|string|unique:users',
            'celular'           => 'required|string|unique:users',
            'dni'               => 'required|string|unique:users',
            'provincia'         => 'required|string',
            'ciudad'            => 'required|string|min:4',
            'direccion'         => 'required|string|min:5|max:50',
        ];
    }
}
