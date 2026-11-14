<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RationaleRequest extends FormRequest
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
            'observed' => 'sometimes',
	        'course_year' => 'required',
	        'observed_course' => 'required',
	        'strength' => 'required',
	        'organization' => 'required',
	        'date' => 'required',
	        'purpose' => 'required',
	        'observer_id' => 'required',
	        'lesson_plan' => 'sometimes|nullable|url'
        ];
    }
}
