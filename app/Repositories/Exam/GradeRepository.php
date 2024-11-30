<?php

namespace App\Repositories\Exam;

use App\Models\Exam\Grade;
use App\Repositories\Contracts\Exam\GradeInterface;
use App\Repositories\BaseRepository;

class GradeRepository extends BaseRepository implements GradeInterface
{
    /**
     * @var
     */
    protected $model;

    public function __construct()
    {
        $this->model = new Grade();
    }

    public function getAllByUserPaginatedWithParams($params, $limit = 10)
    {
        $exams = $this->model;
        $exams = $exams->where('is_finished', 1)->where('user_id', auth()->user()->id)->with(['category', 'exam'])->orderBy('created_at', 'DESC')->paginate($limit);
        return $exams;
    }

    public function getSummaryExamByUser($limit = 5)
    {
        $exams = $this->model;
        $exams = $exams->where('is_finished', 1)->where('user_id', auth()->user()->id)->with(['category', 'exam'])->orderBy('created_at', 'DESC')->limit($limit)->get();
        return $exams;
    }

    public function find($id)
    {
        return $this->model->with(['category', 'exam', 'exam.questionTitle.question', 'exam.questionTitle', 'user', 'user.student'])->find($id);
    }

    public function getRankingByExam($examId, $limit = 10)
    {
        return $this->model->where(['exam_id' => $examId, 'is_finished' => 1])->with(['user.student', 'user.student.province', 'user.student.city'])->orderBy('grade', 'DESC')->paginate($limit);
    }
}
