<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMateriaRequest extends FormRequest
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
            'name' => 'required|string',
			'fecha_inicio_cursado' => 'required|date_format:Y-m-d|before:fecha_fin_cursado',
			'fecha_fin_cursado' => 'required|date_format:Y-m-d'
		];
    }
}
