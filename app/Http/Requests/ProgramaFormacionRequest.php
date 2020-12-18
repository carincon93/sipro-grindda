<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramaFormacionRequest extends FormRequest
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
            'nombre'            => 'required|max:191',
            'nivelAcademico'    => 'required|max:191',
            'sectorProductivo'  => 'required|max:191',
        ];
    }
    public function messages()
    {
        return [
            'nombre.required'   => 'El nombre del programa de formación es obligatorio',
            'nombre.max'        => 'El nombre del programa de formación no debe contener más de 191 caracteres',
        ];
    }
}
