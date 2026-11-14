<?php

namespace App\Http\Requests\SuperAdmin\Topics;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('Super Admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255|unique:topics,title',
	        'subtitle' => 'string|nullable',
	        'description' => 'string|nullable',
	        'parent_id' => 'integer|nullable'
        ];
    }
}
