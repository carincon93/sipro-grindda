<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CentroFormacionRequest extends FormRequest
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
            'nombreCentroFormacion'          => 'required|max:191',
            'nombreSubdirector'              => 'required|max:191',
            'correoElectronicoSubdirector'   => 'required|email|max:191',
            'numeroCelularSubdirector'       => 'required|max:11',
            'nombreLiderSennova'             => 'required|max:191',
            'correoElectronicoLiderSennova'  => 'required|email|max:191',
            'numeroCelularLiderSennova'      => 'required|max:11',
        ];
    }
    public function messages()
    {
        return [
            'nombreCentroFormacion.required'         => 'El nombre del centro de formación es obligatorio',
            'nombreCentroFormacion.max'              => 'El nombre del centro de formación no debe contener más de 191 caracteres',

            'nombreSubdirector.required'             => 'El campo nombre del subdirector es obligatorio',
            'nombreSubdirector.max'                  => 'El campo nombre del subdirector no debe contener más de 191 caracteres',

            'correoElectronicoSubdirector.required'  => 'El correo electrónico del subdirector es obligatorio',
            'correoElectronicoSubdirector.max'       => 'El correo electrónico del subdirector no debe contener más de 191 caracteres',
            'correoElectronicoSubdirector.email'     => 'Este campo debe ser un correo electrónico',
            'numeroCelularSubdirector.required'      => 'El número celular del subdirector es obligatorio',
            'numeroCelularSubdirector.max'           => 'El número celular del subdirector no debe contener más de 11 caracteres',

            'nombreLiderSennova.required'            => 'El nombre del líder SENNOVA es obligatorio',
            'nombreLiderSennova.max'                 => 'El nombre del líder SENNOVA no debe contener más de 191 caracteres',

            'correoElectronicoLiderSennova.required' => 'El correo electrónico del líder SENNOVA es obligatorio',
            'correoElectronicoLiderSennova.max'      => 'El correo electrónico del líder SENNOVA no debe contener más de 191 caracteres',
            'correoElectronicoLiderSennova.email'    => 'Este campo debe ser un correo electrónico',
            'numeroCelularLiderSennova.required'     => 'El número celular del líder SENNOVA es obligatorio',
            'numeroCelularLiderSennova.max'          => 'El número celular del líder SENNOVA no debe contener más de 11 caracteres',
        ];
    }
}
