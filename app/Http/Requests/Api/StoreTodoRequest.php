<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
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
            'name' => 'required|max:20',
            'description' => 'nullable|max:255',
            'end_date' => 'required|date|after_or_equal:' . date("Y-m-d"),
            'end_time' => 'sometimes|required|date_format:H:i',
        ];
    }
}
