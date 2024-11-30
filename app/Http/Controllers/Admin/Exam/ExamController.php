<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Exam\ExamRepository;
use App\Repositories\MasterData\CategoryRepository;
use App\Repositories\Setting\TemplateRepository;
use App\Repositories\Exam\GradeRepository;
use App\Http\Requests\Exam\ExamRequest;
use App\Models\Exam\Exam;
use App\Models\Exam\Grade;
use App\Models\Setting;
use App\Models\Exam\ExamGroupUser;
use App\Models\Exam\ValueCategoryExam;
use App\Services\CalculateGradeService;
use Barryvdh\DomPDF\Facade\Pdf;

class ExamController extends Controller
{
    protected $examRepository;

    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return inertia('Admin/Exam/Exam/Index', [
            'exams' => $this->examRepository->getAllPaginatedWithParams($request),
            'categories' => (new CategoryRepository())->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Admin/Exam/Exam/Create')->with([
            'categories' => (new CategoryRepository())->all(),
            'templates' => (new TemplateRepository())->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        try {
            $this->examRepository->create($request);

            return redirect()->route('admin.exams.index');

        } catch(\Exception $e) {
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$this->examRepository->find($id)) return abort('404', 'uppss....');

        $exam = $this->examRepository->find($id);

        $rangkingExams = (new GradeRepository())->getRankingByExam($exam->id, 10, 1);

        return inertia('Admin/Exam/Exam/Show', [
            'exam' => $this->examRepository->find($id),
            'rankingExams' => $rangkingExams,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = $this->examRepository->find($id);

        $duration_section = ValueCategoryExam::where('exam_id', $exam->id)->orderBy('index', 'ASC')->pluck('duration');

        return inertia('Admin/Exam/Exam/Edit', [
            'exam' => $exam,
            'categories' => (new CategoryRepository())->all(),
            'templates' => (new TemplateRepository())->all(),
            'duration_section' => $duration_section,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, $id)
    {
        try {
            if(!$this->examRepository->find($id)) return abort('404', 'uppss....');

            $this->examRepository->update($request, $id);

            return redirect()->route('admin.exams.index');

        } catch(\Exception $e) {
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->examRepository->delete($id);

            return redirect()->route('admin.exams.index');

        } catch(\Exception $e) {
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            return redirect()->back()->withInput($request->all());
        }
    }

    public function changeExamStatus(Request $request, $id)
    {
        try {
            if(!$this->examRepository->find($id)) return abort('404', 'uppss....');

            Exam::find($id)->update(['exam_status' => $request->exam_status]);

            return redirect()->back();
            
        } catch(\Exception $e) {
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            return redirect()->back()->withInput($request->all());
        }
    }

    public function unblocked($id)
    {
        $grade = (new GradeRepository())->find($id);
        $grade->delete();

        return redirect()->back();
    }

    public function deleteExam($id)
    {
        try {
            $grade = (new GradeRepository())->find($id);

            if($grade->exam_group_id) {
                ExamGroupUser::where(['user_id' => $grade->user_id, 'exam_group_id' => $grade->exam_group_id])->update([
                    'grade' => 0,
                    'is_finished' => 0, 
                    'description' => null
                ]);
            }

            $grade->delete();

            return redirect()->back();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function regenerateBlockToken($id)
    {
        try {
            $this->examRepository->regenerateToken($id);

            return redirect()->back();

        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function regenerateScore($id)
    {
        $grade = (new GradeRepository())->find($id);

        if(!$grade) {
            return abort('404');
        }

        (new CalculateGradeService())->calculateGradeCategory($grade->id);

        return redirect()->back();
    }

    public function gradeStudent($examId, $gradeId)
    {
        $grade = (new GradeRepository())->find($gradeId);
        $exam = $this->examRepository->find($examId);
    
        return inertia('Admin/Exam/Exam/GradeUser', [
            'grade' => $grade,
            'exam' => $exam,
        ]);
    }

    public function certificate($examId, $gradeId)
    {
        $grade = (new GradeRepository())->find($gradeId);
        $exam = $this->examRepository->find($grade->exam_id);

        $pdf = Pdf::loadView('export.certificate', ['exam' => $exam, 'grade' => $grade])->setPaper('a4', $exam->template->orientation == 1 ? 'landscape' : 'portrait');
        return $pdf->stream($exam->title.' - '.$grade->user->name.'.pdf');
    }

    public function exportPdf($examId)
    {
        $exam = $this->examRepository->find($examId);
        $grades = Grade::with('user', 'user.student', 'user.student.province', 'user.student.city', 'user.student.district', 'user.student.village')->where(['exam_id' => $examId, 'is_finished' => 1])->orderBy('grade', 'DESC')->get();

        $pdf = Pdf::loadView('export.export_exam_pdf', [
            'exam' => $exam, 
            'grades' => $grades,
            'setting' => Setting::first() ?? []
            ])
            ->setPaper('a4', 'landscape');

        return $pdf->stream($exam->title.'.pdf');
    }
}
