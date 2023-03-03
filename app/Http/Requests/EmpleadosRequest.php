<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadosRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|regex:/^[A-Z]|-|\s{1,50}$/',
            'apellidos' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'telefono' => 'required|regex:/^[0-9]{10}$/',
            'sueldo' => 'required|regex:/^([0-9]{1,3}\.[0-9]{2})$/'

        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio',
            'nombre.regex' => 'El nombre debe empezar con Mayuscula, solo se admiten letras',
            'nombre.max: 10' => 'El campo nombre solo recibe como maximo 10 caracteres',
        ];
    }
}
