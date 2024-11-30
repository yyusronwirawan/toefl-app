<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueCategoryExam extends Model
{
    use HasFactory;
    
    protected $table = 'value_category_exam';

    protected $fillable = [
        'value_category_id',
        'exam_id',
        'section',
        'index',
        'duration',
    ];
}
