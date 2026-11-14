<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ObservationStoreRequest extends FormRequest
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
	        'year_group' => 'sometimes',
			'date' => 'required',
			'time' => 'sometimes',
			'number_of_students' => 'sometimes',
			'course_title' => 'sometimes',
			'topic' => 'sometimes',
			'ability' => 'sometimes',
			'pre_req' => 'sometimes',
			'outcome' => 'sometimes',
			'number_of_staff' => 'sometimes',
	        'teacher_observed' => 'sometimes'
        ];
    }
}
