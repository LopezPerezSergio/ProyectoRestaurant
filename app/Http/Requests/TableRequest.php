<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableRequest extends FormRequest
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
            'nombre' => 'required|string|max:25',
            'capacidad' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio',
            'nombre.string' => 'El campo nombre debe ser una cadena de caracteres',
            'nombre.max:25' => 'El campo nombre solo recibe como maximo 25 caracteres',
            'capacidad.require' => 'El campo capacidad es obligatorio',
        ];
    }
}
