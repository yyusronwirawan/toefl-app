<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Auth;

class Exam extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'category_id',
        'question_title_id',
        'template_id',
        'title',
        'price',
        'duration',
        'duration_type',
        'description',
        'random_question',
        'random_answer',
        'show_answer',
        'show_question_number_navigation',
        'show_question_number',
        'next_question_automatically',
        'show_prev_next_button',
        'type_option',
        'button_type_finish',
        'repeat_the_exam',
        'print_certificate',
        'show_ranking',
        'valid_until',
        'exam_start_time',
        'exam_end_time',
        'total_tolerance',
        'unblock_token',
        'exam_status',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\MasterData\Category::class);
    }

    public function questionTitle()
    {
        return $this->belongsTo(\App\Models\Lesson\QuestionTitle::class);
    }

    public function template()
    {
        return $this->belongsTo(\App\Models\Setting\Template::class);
    }

    public function grade()
    {
        return $this->hasMany(\App\Models\Exam\Grade::class);
    }

    public function gradeFinished()
    {
        return $this->hasMany(\App\Models\Exam\Grade::class)->where('is_finished', 1);
    }

    public function transaction()
    {
        return $this->hasMany(\App\Models\Transaction\Transaction::class)->where(['transaction_status' => 'done', 'user_id' => Auth::user()->id]);
    }

}
