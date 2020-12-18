<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->isMethod('PUT')) {
            return [
                'nombre'                => 'required|max:191',
                'email'                 => 'required|email|max:191|unique:users,email,'.$this->route('usuario').',id',
                'password'              => 'required_if:tipoContrasena,contrasenaManual|string|min:6|confirmed',
                'tipoDocumento'         => 'required',
                'numeroDocumento'       => 'required|max:10|unique:users,numeroDocumento,'.$this->route('usuario').',id',
                'numeroCelular'         => 'max:10',
                'tipoVinculacion'       => 'max:191',
                'profesion'             => 'max:191',
                'foto'                  => 'file|max:800',
            ];
        } else {
            return [
                'nombre'                => 'required|max:191',
                'email'                 => 'required|email|max:191|unique:users,email',
                'password'              => 'required_if:tipoContrasena,contrasenaManual|string|min:6|confirmed',
                'tipoDocumento'         => 'required',
                'numeroDocumento'       => 'required|max:10|unique:users,numeroDocumento',
                'numeroCelular'         => 'max:10',
                'tipoVinculacion'       => 'max:191',
                'profesion'             => 'max:191',
                'foto'                  => 'file|max:800',
            ];
        }
    }
    public function messages()
    {
        return [
        'nombre.required'               => 'El nombre es obligatorio',
        'nombre.max'                    => 'El nombre no debe contener más de 191 caracteres',
        'email.required'                => 'El correo electrónico es obligatorio',
        'email.max'                     => 'El correo electrónico no debe contener más de 191 caracteres',
        'email.email'                   => 'Este campo debe ser un correo electrónico',
        'email.unique'                  => 'Este correo electrónico ya esta en uso',
        'tipoDocumento.required'        => 'El tipo de documento es obligatorio',
        'numeroDocumento.required'      => 'El número de documento es obligatorio',
        'numeroDocumento.max'           => 'El número de documento no debe contener más de 11 caracteres',
        'numeroDocumento.unique'        => 'Este número de documento ya esta registrado',
        'numeroCelular.max'             => 'El número celular no debe contener más de 10 caracteres',
        'foto.max'                      => 'La foto no puede pesar más de 800 KB',
        ];
    }
}
