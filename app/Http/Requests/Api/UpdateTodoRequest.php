<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest
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
            'name' => 'sometimes|required|max:20',
            'description' => 'nullable|max:255',
            'end_date' => 'sometimes|required|date|after_or_equal:' . date("Y-m-d"),
            'end_time' => 'sometimes|required|date_format:H:i',
            'status'=>'sometimes|in:finished,pending',
        ];
    }
}
