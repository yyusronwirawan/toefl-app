<?php

namespace App\Services;

use App\Models\Exam\Grade;
use App\Models\Exam\Exam;
use App\Models\Exam\ExamGroup;
use App\Models\Exam\ExamGroupUser;
use App\Models\Lesson\ValueCategory;
use App\Models\Lesson\DetailValueCategory;
use Ramsey\Uuid\Uuid as Generator;
use Carbon\Carbon;

class CalculateGradeService 
{
    function calculateGradeCategory($id) 
    {
        $grade = Grade::find($id);
        $exam = Exam::find($grade->exam_id);
        $gradeAnswers = unserialize($grade->answers);

        $totalCorrect = array_filter($gradeAnswers, function ($var) {
            return ($var['is_correct'] === "Y" && $var['answer'] !== 0 && $var['type'] == 1);
        });

        $totalAnswer = array_filter($gradeAnswers, function ($var) {
            return ($var['answer'] != 0 && $var['type'] == 1);
        });

        $totalWrong = array_filter($gradeAnswers, function ($var) {
            return ($var['is_correct'] == "N" && $var['type'] == 1);
        });

        $totalQuestionGrade = count($gradeAnswers);
        $count_correct_answer = count($totalCorrect);

        $grade_exam = round($count_correct_answer / $totalQuestionGrade * 100, 2);

        $valueCategories = ValueCategory::where('category_id', $exam->category_id)->orderBy('section', 'ASC')->get();

        $resultGradeDetails = [];

        if ($exam->questionTitle->add_value_category == 1 && $exam->questionTitle->assessment_type == 1) {
            $grades = [];

            foreach ($valueCategories as $index => $valueCategory) {
                if ($exam->questionTitle->assessment_type == 1) {
                    $totalCorrect = array_filter($gradeAnswers, function ($var) use ($valueCategory) {
                        return ($var['value_category_id'] == $valueCategory->id && $var['is_correct'] == "Y" && $var['type'] == 1);
                    });

                    $totalWrong = array_filter($gradeAnswers, function ($var) use ($valueCategory) {
                        return ($var['value_category_id'] == $valueCategory->id && $var['is_correct'] == "N" && $var['type'] == 1);
                    });
                }

                $totalCorrectFinal = count($totalCorrect);
                $totalWrongFinal = count($totalWrong);
                $totalQuestion = (int) $totalCorrectFinal + (int) $totalWrongFinal;

                $grades[] = [
                    'category_id' => $exam->category_id,
                    'exam_id' => $exam->id,
                    'total_correct' => $totalCorrectFinal,
                    'total_wrong' => $totalWrongFinal,
                    'value_category_id' => $valueCategory->id,
                    'value_category_name' => $valueCategory->name,
                    'variable' => $valueCategory->variable,
                    'value_category_assessment_type' => $valueCategory->assessment_type,
                ];

                if ($valueCategory->assessment_type == 1) {
                    $grades[$index]['grade'] = round(($totalCorrectFinal == 0 ? 0 : ($totalCorrectFinal / $totalQuestion)) * 100);
                }

                if ($valueCategory->assessment_type == 2) {
                    $grades[$index]['grade'] = $totalCorrectFinal;
                }
            }

            $valueCategoryIds = array_unique(array_column($grades, 'value_category_id'));

            $detailValueCategories = DetailValueCategory::whereIn('value_category_id', $valueCategoryIds)
                ->orderBy('value_category_id')
                ->orderBy('final_grade')
                ->get();

            $finalGradeExam = 0;

            foreach ($grades as $gradeData) {
                $finalGrade = null;
                $finalCategoryGrade = null;

                foreach ($detailValueCategories as $detailValueCategory) {
                    if ($detailValueCategory->value_category_id == $gradeData['value_category_id'] &&
                        $gradeData['grade'] >= $detailValueCategory->min_grade &&
                        $gradeData['grade'] <= $detailValueCategory->max_grade) {
                        $finalGrade = $detailValueCategory->final_grade;
                        $finalCategoryGrade = $detailValueCategory->category_grade;
                        break;
                    }
                }

                $finalGradeExam += $finalGrade;

                $resultGradeDetails[] = [
                    'id' => Generator::uuid4()->toString(),
                    'variable' => $gradeData['variable'],
                    'grade_category_name' => $gradeData['value_category_name'],
                    'total_correct' => $gradeData['total_correct'],
                    'total_wrong' => $gradeData['total_wrong'],
                    'grade_category' => $finalCategoryGrade,
                    'grade' => $finalGrade,
                ];
            }
        }

        $updates = [
            'end_time' => Carbon::now(),
            'total_correct' => $count_correct_answer,
            'grade' => ($finalGradeExam * 10) / 3,
            'is_finished' => 1,
            'grade_calculate' => 1,
            'grade_details' => $resultGradeDetails
        ];

        $grade->update($updates);

        return $grade;
    }
}