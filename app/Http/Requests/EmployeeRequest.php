<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'nombre' => 'required|regex:/^[a-zA-Z|-|\s]{1,50}$/',
            'apellidos' => 'required|regex:/^[A-Z][[a-zÀ-ÿ\s]]{2,100}/',
            'telefono' => 'required|regex:/^[0-9]{10}$/',
            'sueldo' => 'required|regex:/^([0-9]{1,3}\.[0-9]{2})$/',
            'codigoAcceso' => 'required|numeric',
        ];
    }
}
