<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AliadoRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            return [
                'nombreAliado_Externo'                => 'required|max:191',
                'nitAliado_Externo'                   => 'required|max:191',
                'nombreContactoAliado_Externo'        => 'required|max:191',
                'celularContactoAliado_Externo'       => 'required|max:11',
                'emailContactoAliado_Externo'         => 'required|email|max:191',
                'convenioContactoAliado_Externo'      => 'required|file|max:800',
                'recursosEspecie_Externo'             => 'required|max:11',
                'recursosDinero_Externo'              => 'required|max:11',
                'ciudadesMunicipios_Externo'          => 'required',
            ];
                break;
            case 'PUT':
            case 'PATCH':
            return [
                'nombreAliado_Externo'                => 'required|max:191',
                'nitAliado_Externo'                   => 'required|max:191',
                'nombreContactoAliado_Externo'        => 'required|max:191',
                'celularContactoAliado_Externo'       => 'required|max:11',
                'emailContactoAliado_Externo'         => 'required|email|max:191',
                'convenioContactoAliado_Externo'      => 'file|max:800',
                'recursosEspecie_Externo'             => 'required|max:11',
                'recursosDinero_Externo'              => 'required|max:11',
                'ciudadesMunicipios_Externo'          => 'required',
            ];
                break;
            default:
                break;
        }

    }
}
