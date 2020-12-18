<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaConocimientoRequest extends FormRequest
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
            'nombre'    => 'required|max:191', // varchar 191 required
            'codigo'    => 'required|max:4', // bigint 20 required
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'              => 'El campo nombre del área de conocimiento es obligatorio',
            'nombre.max'                   => 'El campo nombre del área de conocimiento no debe contener más de 191 caracteres',
            'nombre.string'                => 'El campo nombre debe ser tipo texto',
            'codigo.required'              => 'El campo código es obligatorio',
            'codigo.max'                   => 'El campo código no debe contener más de 4 de caracteres',
        ];
    }
}
