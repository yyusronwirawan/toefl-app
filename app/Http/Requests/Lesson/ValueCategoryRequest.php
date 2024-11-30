<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class ValueCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'name' => 'required|string|max:191',
            'assessment_type' => 'required',
            'section' => 'required',
            'variable' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => __('value_category.category_id'),
            'name' => __('value_category.name'),
            'assessment_type' => __('value_category.assessment_type'),
            'section' => __('value_category.section'),
            'variable' => __('value_category.variable'),
        ];
    }
}
