<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecursoHumanoRequest extends FormRequest
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
                'personalInternoNombre.*'           => 'required|max:191',
                'personalInternoDocumento.*'        => 'required|max:11',

                'personalInstructorNombre.*'        => 'required|max:191',
                'personalInstructorDocumento.*'     => 'required|max:11',
                'personalInstructorCarta.*'         => 'required|file|max:800', // no funciona
            ];
                break;
            case 'PUT':
            case 'PATCH':
            return [
                'personalNombre'           => 'required|max:191',
                'personalNumeroDocumento'  => 'required|max:11',
                'personalInstructorCarta'  => 'file|max:800',
            ];
                break;
            default:
                break;
        }
    }
}
