<?php

namespace App\Http\Controllers\Admin\Lesson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Lesson\QuestionRepository;
use App\Repositories\Lesson\QuestionTitleRepository;
use App\Repositories\Lesson\ValueCategoryRepository;
use App\Http\Requests\Lesson\QuestionRequest;
use Ramsey\Uuid\Uuid as Generator;
use App\Models\Lesson\Question;
use Carbon\Carbon;
use Excel;
use App\Imports\QuestionImport;
use App\Exports\QuestionExport;
use Maatwebsite\Excel\Concerns\ToCollection;

class QuestionController extends Controller
{
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($questionTitleId, Request $request)
    {
        if(!(new QuestionTitleRepository())->find($questionTitleId)) return abort('404', 'uppss....');

        return inertia('Admin/Lesson/Question/Index', [
            'questions' => $this->questionRepository->getByQuestionTitlePaginatedWithParams($request, $questionTitleId),
            'questionTitle' => (new QuestionTitleRepository())->find($questionTitleId)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($questionTitleId)
    {
        if(!(new QuestionTitleRepository())->find($questionTitleId)) return abort('404', 'uppss....');

        $questionTitle = (new QuestionTitleRepository())->find($questionTitleId);
        
        $valueCategories = (new ValueCategoryRepository())->findByField('category_id', $questionTitle->category_id);

        return inertia('Admin/Lesson/Question/Create', [
            'questionTitle' => $questionTitle,
            'valueCategories' => $valueCategories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($questionTitleId, QuestionRequest $request)
    {
        try {
            if(!(new QuestionTitleRepository())->find($questionTitleId)) return abort('404', 'uppss....');

            #store
            $this->questionRepository->create($request);

            #Bump....
            return redirect()->route('admin.question-titles.questions.index', $questionTitleId);

        } catch(\Exception $e) {
            #get message
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            #redirect
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($questionTitleId, $id)
    {
        if(!(new QuestionTitleRepository())->find($questionTitleId)) return abort('404', 'uppss....');

        if(!$this->questionRepository->find($id)) return abort('404', 'uppss....');

        $questionTitle = (new QuestionTitleRepository())->find($questionTitleId);

        $valueCategories = (new ValueCategoryRepository())->findByField('category_id', $questionTitle->category_id);

        return inertia('Admin/Lesson/Question/Edit', [
            'questionTitle' => $questionTitle,
            'question' => $this->questionRepository->find($id),
            'valueCategories' => $valueCategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($questionTitleId, QuestionRequest $request, $id)
    {
        try {
            if(!(new QuestionTitleRepository())->find($questionTitleId)) return abort('404', 'uppss....');

            if(!$this->questionRepository->find($id)) return abort('404', 'uppss....');

            $this->questionRepository->update($request, $id);

            return redirect()->route('admin.question-titles.questions.index', $questionTitleId);

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
    public function destroy($questionTitleId, $id)
    {
        try {
            if(!(new QuestionTitleRepository())->find($questionTitleId)) return abort('404', 'uppss....');

            if(!$this->questionRepository->find($id)) return abort('404', 'uppss....');

            $this->questionRepository->delete($id);

            return redirect()->route('admin.question-titles.questions.index', $questionTitleId);

        } catch(\Exception $e) {
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            return redirect()->back();
        }
    }

    public function importExcel(Request $request, $questionTitleId)
    {
        try {

            $questionTitle = (new QuestionTitleRepository())->find($questionTitleId);

            $collection = Excel::toCollection(null, $request->file);
            $headingRow = $collection->first()->first();
            $headingArray = $headingRow->toArray();

            $headerFile = array_filter($headingArray, function ($value) {
                return $value !== null;
            });
            $headerFile = array_values($headerFile);

            $headerImport = [
                'NO',
            ];

            if ($questionTitle->assessment_type == 1) {
                $headerImport[] = 'KATEGORI_PENILAIAN';
            }

            $headerImport[] = 'SOAL';

            for ($i = 0; $i < $questionTitle->total_choices; $i++) {
                $headerImport[] = 'PILIHAN_' . chr(65 + $i);
            }

            if ($questionTitle->assessment_type != 4) {
                $headerImport[] = 'JAWABAN';
            }

            if ($questionTitle->assessment_type == 4) {
                for ($i = 0; $i < $questionTitle->total_choices; $i++) {
                    $headerImport[] = 'BOBOT_JAWABAN_' . chr(65 + $i);
                }
            }

            if ($questionTitle->assessment_type == 3) {
                $headerImport[] = 'POIN_JAWABAN_BENAR';
            }

            if ($headerFile === $headerImport) {
                Excel::import(new QuestionImport($questionTitle), $request->file);
                session()->flash('success', 'Proses Import Berhasil Dijalankan.');
                return redirect()->route('admin.question-titles.questions.index', $questionTitleId);
            } else {
                session()->flash('failed', 'Format Import Tidak Sesuai. ');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            session()->flash('failed', $e->getMessage() . ' in file: ' . $e->getFile() . ' line: ' . $e->getLine());
            return redirect()->back();
        }
    }

    public function exportExcel($questionTitleId)
    {
        try {
            $questionTitle = (new QuestionTitleRepository())->find($questionTitleId);
            return Excel::download(new QuestionExport($questionTitle), str_replace(' ', '_', $questionTitle->name).'.xlsx');

        } catch(\Exception $e) {
            return $e;
            #get message
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            #redirect
            return redirect()->back();
        }
    }

    public function deleteQuestion($questionTitleId)
    {
        try {
            if(!(new QuestionTitleRepository())->find($questionTitleId)) return abort('404', 'uppss....');
            
            Question::where('question_title_id', $questionTitleId)->delete();

            #Bump....
            return redirect()->route('admin.question-titles.questions.index', $questionTitleId);

        } catch(\Exception $e) {
            #get message
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            #redirect
            return redirect()->back();
        }
    }

    public function getOption($number)
    {
        switch ($number) {
            case 0:
                return 'A';
                break;
            case 1:
                return 'B';
                break;
            case 2:
                return 'C';
                break;
            case 3:
                return 'D';
                break;
            default:
                return 'E';
                break;
        }
    }
}
