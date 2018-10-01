<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitOfMeasurementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:unit_of_measurements',
            'short_name' => 'required|unique:unit_of_measurements',
        ];
    }
}
