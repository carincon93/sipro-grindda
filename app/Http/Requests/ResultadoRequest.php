<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultadoRequest extends FormRequest
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
            'codigo'                    => 'required|max:191', // varchar 191 required
            'descripcion'               => 'required', // longtext required
            'indicador'                 => 'required', // longtext required
            'medioVerificacion'         => 'required|max:191', // varchar 191 required
            'meta'                      => 'required', // text required
        ];
    }
}
