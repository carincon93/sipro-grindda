<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActividadRequest extends FormRequest
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
            'codigo'        => 'required|max:191', // varchar 191 required
            'descripcion'   => 'required', // longtext required
            'fechaInicio'   => 'required|date|date_format:Y-m-d|before:fechaFin', // date required
            'fechaFin'      => 'required|date|date_format:Y-m-d|after:fechaInicio', // date required
            'duracion'      => 'required|max:5', // int 11 required
        ];
    }
}
