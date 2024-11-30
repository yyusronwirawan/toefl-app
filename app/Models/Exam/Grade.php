<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Grade extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $casts = [
        'answers' => 'json',
        'end_time' => 'datetime:Y-m-d H:i:s',
        'start_time' => 'datetime:Y-m-d H:i:s',
        'grade_details' => 'json',
    ];

    // protected $appends = ['gradeTotal'];

    protected $fillable = [
        'id',
        'category_id',
        'exam_id',
        'user_id',
        'duration',
        'section',
        'total_section',
        'start_time',
        'end_time',
        'work_duration',
        'total_correct',
        'total_correct_per_section',
        'percentage_grade',
        'grade',
        'final_grade',
        'answers',
        'grade_details',
        'is_finished',
        'grade_calculate',
        'total_tolerance',
        'is_blocked',
    ];
    
    public function category()
    {
        return $this->belongsTo(\App\Models\MasterData\Category::class);
    }

    public function exam()
    {
        return $this->belongsTo(\App\Models\Exam\Exam::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    protected function grade(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? null : number_format($value),
        );
    }
}
