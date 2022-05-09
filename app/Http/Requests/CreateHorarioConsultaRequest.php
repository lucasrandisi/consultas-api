<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateHorarioConsultaRequest extends FormRequest
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
            'day' => ['required', Rule::in(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'])],
			'hour' => 'required|integer|min:7|max:23',
			'profesor_id' => 'required|exists:usuarios,id',
			'materia_id' => 'required|exists:materias,id'
        ];
    }
}
