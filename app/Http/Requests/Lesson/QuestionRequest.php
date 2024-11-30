<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Lesson\QuestionTitle;

class QuestionRequest extends FormRequest
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
        $questionTitle = QuestionTitle::find(request()->question_title_id);

        $validation = [
            'type' => 'required',
            'value_category_id' => 'required',
            'audio_input' => 'required',
        ];

        // if(request()->method('PATCH')) {
        //     $validation['audio'] = 'sometimes';
        // } else {
        //     $validation['audio'] = 'required_if:audio_input,1';
        // }

        // for($i = 1; $i <= $questionTitle->total_choices; $i++) {
        //     $validation['option_'.$i] = 'required';
        // }

        return $validation;
    }

    public function attributes()
    {
        return [
            'value_category_id' => __('question.value_category_id'),
            'question' => __('question.question'),
            'option_1' => __('question.option_1'),
            'option_2' => __('question.option_2'),
            'option_3' => __('question.option_3'),
            'option_4' => __('question.option_4'),
            'option_5' => __('question.option_5'),
            'answer' => __('question.answer'),
            'section' => __('question.section'),
        ];
    }
}
