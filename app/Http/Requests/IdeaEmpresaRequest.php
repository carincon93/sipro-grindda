<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdeaEmpresaRequest extends FormRequest
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
             'nombreEmpresa'        => 'required|max:191',
             'nit'                  => 'required|max:12',
             'representanteLegal'   => 'required|max:191',
             'sectorEmpresa'        => 'required|max:191',
             'nombrePersona'        => 'required|max:191',
             'telefonoFijo'         => 'max:11',
             'telefonoCelular'      => 'required|max:11',
             'correoElectronico'    => 'required|email|max:191',
             'idea'                 => 'required',
             'presupuesto'          => 'max:11',

         ];
     }

     public function messages()
     {
         return [
             'nombreEmpresa.required'       => 'El nombre de la empresa es obligatorio',
             'nombreEmpresa.max'            => 'El nombre de la empresa no puede superar los 191 caracteres',
             'nit.required'                 => 'El NIT de la empresa es obligatorio',
             'nit.max'                      => 'El NIT de la empresa no puede superar los 12 caracteres',
             'representanteLegal.required'  => 'El representante legal de la empresa es obligatorio',
             'representanteLegal.max'       => 'El representante legal de la empresa no puede superar los 191 caracteres',
             'sectorEmpresa.required'       => 'El sector de la empresa de la empresa es obligatorio',
             'sectorEmpresa.max'            => 'El sector de la empresa de la empresa no puede superar los 191 caracteres',
             'nombrePersona.required'       => 'El nombre de la persona encargada de los proyectos es obligatorio',
             'nombrePersona.max'            => 'El nombre de la persona encargada de los proyectos no puede superar los 191 caracteres',
             'telefonoFijo.max'             => 'El teléfono fijo no puede superar los 11 caracteres',
             'telefonoCelular.required'     => 'El teléfono celular es obligatorio',
             'telefonoCelular.max'          => 'El teléfono celular no superar los 11 caracteres',
             'correoElectronico.required'   => 'El correo electrónico es obligatorio',
             'correoElectronico.max'        => 'El correo electrónico no superar los 191 caracteres',
             'correoElectronico.email'      => 'Debe ser un correo electrónico',
             'idea.required'                => 'La idea es obligatoria',
             'idea.max'                     => 'La idea no superar los 191 caracteres',
             'presupuesto.max'              => 'El presupuesto no puede superar los 11 caracteres',
         ];
     }
}
