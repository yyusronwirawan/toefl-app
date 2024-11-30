<?php

namespace App\Models\Lesson;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Question extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'question_title_id',
        'type',
        'direction',
        'value_category_id',
        'audio_input',
        'audio',
        'audio_played',
        'audio_played_limit',
        'audio_answer_time',
        'question',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'option_5',
        'answer',
        'section'
    ];

    public function questionTitle()
    {
        return $this->belongsTo(\App\Models\Lesson\QuestionTitle::class);
    }

    public function valueCategory()
    {
        return $this->belongsTo('\App\Models\Lesson\ValueCategory');
    }
}
