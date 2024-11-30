<?php

namespace App\Http\Controllers\User\TryOut;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Exam\GradeRepository;
use App\Repositories\Exam\ExamRepository;
use App\Services\CalculateGradeService;
use Barryvdh\DomPDF\Facade\Pdf;

class GradeController extends Controller
{
    protected $gradeRepository;

    public function __construct(GradeRepository $gradeRepository)
    {
        $this->gradeRepository = $gradeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return inertia('User/TryOut/Grade/Index', [
            'grades' => $this->gradeRepository->getAllByUserPaginatedWithParams($request)
        ]);
    }

    public function show($id)
    {
        $grade = $this->gradeRepository->find($id);

        if(!$grade) {
            return abort('404');
        }

        if($grade->grade_calculate == 0) {
            (new CalculateGradeService())->calculateGradeCategory($grade->id);
        }
        
        $grade = $grade->refresh();

        $rankingExams = $this->gradeRepository->getRankingByExam($grade->exam_id, 10, 1);

        return inertia('User/TryOut/Grade/Show', [
            'grade' => $this->gradeRepository->find($id),
            'rankingExams' => $rankingExams,
            'answers' => empty($grade->answers) ? [] : $grade->answers,
        ]);
    }

    public function certificate($id)
    {
        $grade = $this->gradeRepository->find($id);
        $exam = (new ExamRepository())->find($grade->exam_id);

        if($exam->print_certificate == 0) {
            return abort('503');
        }

        $pdf = Pdf::loadView('export.certificate', ['exam' => $exam, 'grade' => $grade])->setPaper('a4', $exam->template->orientation == 1 ? 'landscape' : 'portrait');
        return $pdf->stream($exam->title.' - '.$grade->user->name.'.pdf');
    }
}