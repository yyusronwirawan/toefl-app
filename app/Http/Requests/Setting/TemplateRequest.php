<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class TemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:191',
            'size' => 'required|in:1',
            'orientation' => 'required|in:1,2',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('template.name'),
            'size' => __('template.size'),
            'orientation' => __('template.orientation'),
        ];
    }
}
