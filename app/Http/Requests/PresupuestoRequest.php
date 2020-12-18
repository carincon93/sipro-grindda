<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PresupuestoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'valor.*'         => 'required',
            'descripcion.*'   => 'required',
            'archivo.*'       => 'file|max:800',
        ];
    }

    public function messages()
    {
        return [
            'valor.*.required'                  => 'El valor es obligatorio',
            'descripcion.*.required'            => 'La descripción es obligatorio',
            'archivo.*.max'                     => 'El archivo no puede pesar más de 800 KB',
        ];
    }
}
