<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProyectoRequest extends FormRequest
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
            'titulo'                            => 'required', // longtext required
            'tipoProyecto'                      => 'required|max:191', // varchar 191 required
            'areaConocimiento1'                 => 'required|max:191',
            'areaConocimiento2'                 => 'max:191',

            'municipiosAImpactar'               => 'required_with:aplicacionPosconflictoSi|max:191',
            'descripcionEstrategia'             => 'required_with:aplicacionPosconflictoSi',
            'recursosPosconflicto'              => 'required_with:aplicacionPosconflictoSi|max:11',

            'antecedentesJustificacionProyecto' => 'required',
            'planteamientoProblema'             => 'required',
            'metodologia'                       => 'required',
            'objetivoGeneral'                   => 'required',
            'fechaInicioProyecto'               => 'required|date',
            'fechaFinProyecto'                  => 'required|date',
            'codigoGruplac'                     => 'max:191', // varchar 191 required

            'modificado'                        => 'max:1', // tinyint

            'grupoInvestigacion'                => 'max:191', // varchar 191 required

            'objetivoEspecifico.0'              => 'required',
            'objetivoEspecifico.1'              => 'required',
            'objetivoEspecifico.2'              => 'required',

            'semillero'                         => 'required',
            'lineasInvestigacion'               => 'required',
            'programaFormacion'                 => 'max:191',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required'                   => 'El campo título del proyecto es obligatorio',

            'areaConocimiento1.required'        => 'El campo área de conocimiento es obligatorio',
            'areaConocimiento1.max'             => 'El campo área de conocimiento no debe contener más de 191 caracteres',
            'areaConocimiento2.max'             => 'El campo área de conocimiento no debe contener más de 191 caracteres',

            'antecedentesJustificacionProyecto.required' => 'El campo antecedente/justificación del proyecto es obligatorio',
            'planteamientoProblema.required'    => 'El campo planteamiento del problema es obligatorio',
            'metodologia.required'              => 'El campo metodología es obligatorio',
            'objetivoGeneral.required'          => 'El campo objetivo general es obligatorio',

            'fechaInicioProyecto.required'      => 'El campo fecha de inicio es obligatorio',
            'fechaInicioProyecto.date'          => 'El campo fecha debe ser válido',
            'fechaFinProyecto.required'         => 'El campo fecha final es obligatorio',
            'fechaFinProyecto.date'             => 'El campo fecha debe ser válido',
            'grupoInvestigacion.required'       => 'El campo grupo de investigación es obligatorio',
            'grupoInvestigacion.max'            => 'El campo grupo de investigación no debe contener más de 191 caracteres',
            // 'codigoGruplac.required'            => 'El campo código Gruplac es obligatorio',
            'codigoGruplac.max'                 => 'El campo código Gruplac no debe contener más de 191 caracteres',

            'objetivoEspecifico.0.required'     => 'El campo objetivo específico 1 es obligatorio',
            'objetivoEspecifico.1.required'     => 'El campo objetivo específico 2 es obligatorio',
            'objetivoEspecifico.2.required'     => 'El campo objetivo específico 3 es obligatorio',

            'semillero.required'                => 'El campo semillero es obligatorio',
            'programaFormacion.max'             => 'El campo programas de formación no debe contener más de 5 caracteres',
        ];
    }
}
