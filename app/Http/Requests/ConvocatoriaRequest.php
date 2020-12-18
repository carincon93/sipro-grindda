<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvocatoriaRequest extends FormRequest
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
            'fecha_inicio'          => 'required|date|date_format:Y-m-d|before:fecha_fin',
            'fecha_fin'             => 'required|date|date_format:Y-m-d|after:fecha_inicio',
            'descripcion'           => 'required',
            'tipoConvocatoria'      => 'required',
        ];
    }

    public function messages() {
        return [
            'fecha_inicio.required' => 'La fecha inicial de la convocatoria es obligatoria',
            'fecha_inicio.date'     => 'Este campo debe ser una fecha',
            'fecha_fin.required'    => 'La fecha final de la convocatoria es obligatoria',
            'fecha_fin.date'        => 'Este campo debe ser una fecha',
        ];
    }
}
