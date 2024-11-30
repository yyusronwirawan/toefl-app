<?php

namespace App\Http\Controllers\User\TryOut;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Exam\ExamRepository;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Exam\Grade;
use App\Models\Exam\ValueCategoryExam;
use App\Models\Lesson\Question;
use App\Models\Lesson\QuestionTitle;
use App\Repositories\Lesson\LessonRepository;
use App\Models\Lesson\{DetailValueCategory, ValueCategory};
use Carbon\Carbon;
use App\Models\Exam\Exam;
use Auth;
use App\Models\Transaction\Transaction;
use App\Models\Setting;
use File;

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
    public function index(Request $request, $categoryId)
    {
        return inertia('User/TryOut/Exam/Index', [
            'exams' => $this->examRepository->getAllByCategoryPaginatedWithParams($request, $categoryId, 8, 'active'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId, $id)
    {
        $grade = Grade::where('exam_id', $id)->where('user_id', auth()->user()->id)->first();

        return inertia('User/TryOut/Exam/Show', [
            'exam' => $this->examRepository->find($id),
            'grade' => $grade
        ]);
    }

    public function examStart($id, Request $request)
    {
        DB::beginTransaction();

        try {
            $exam = Exam::find($id);

            $setting = Setting::first() ?? [];

            if(Auth::user()->member_type == 2 && $setting->add_voucher_purchase == 1) {
                $transactions = Transaction::where(['user_id' => Auth::user()->id, 'voucher_used' => 1, 'exam_id' => $exam->id])->get();
    
                if($setting && $setting->add_voucher_purchase == 1) {  
                    if(count($transactions) == 0) {
                        return redirect()->back()->with('error', 'Anda tidak memiliki akses member aktif untuk pembelajaran <b>'.strtoupper(strtolower($exam->category->name)).'</b>, silakan pilih paket voucher kategori <b>'.strtoupper($exam->category->name).'</b> terlebih dahulu.');
                    } 
                }
            }

    
            $this->removeOldFiles(); 

            $grade = Grade::where('exam_id', $id)->where('user_id', auth()->user()->id);

            if($request->repeat == 1) {
                $grade->delete();
            }

            $totalSection = QuestionTitle::find($exam->question_title_id)->total_section;

            $grade = $grade->first();

            if(!$grade) {
                $answerInsert = [];

                $valueExam = ValueCategoryExam::where(['exam_id' => $exam->id, 'section' => 1])->first();

                if($exam->duration_type == 1) {
                    $addMinutes = (int) $exam->duration;
                } else if($exam->duration_type == 2) {
                    $addMinutes = $valueExam->duration;
                } else {
                    $addMinutes = 560;
                }

                $grade = new Grade();
                $grade->category_id = $exam->category_id;
                $grade->exam_id = $exam->id;
                $grade->user_id = auth()->user()->id;
                $grade->duration = $addMinutes;
                $grade->total_section = $totalSection;
                $grade->start_time = Carbon::now();
                $grade->end_time = Carbon::now()->addMinutes($addMinutes)->addSeconds(1);
                $grade->answers = [];
                $grade->save();
                $grade->refresh();
            }

            $path = 'json/' . Auth::user()->id . '-' . $exam->id . '.json';
            Storage::delete($path);
            
            if (!Storage::exists($path)) {
                $question_order = 0;
                
                $questionInserts = [];

                for($i = 1; $i <= $totalSection; $i++) {
                    if($exam->random_question == 1) {
                        $questions = Question::where('section', $i)->where('question_title_id', $exam->question_title_id)->inRandomOrder()->get();
                    } else {
                        $questions = Question::where('section', $i)->where('question_title_id', $exam->question_title_id)->orderBy('created_at', 'ASC')->get();
                    }

                    $navigation_order = 0;

                    foreach ($questions as $question) {
                        if($question->type == 1) {
                            $navigation_order++;
                        }    
                        
                        $options = [];
                        if($question->option_1 != null) $options[] = 1;
                        if($question->option_2 != null) $options[] = 2;
                        if($question->option_3 != null) $options[] = 3;
                        if($question->option_4 != null) $options[] = 4;
                        if($question->option_5 != null) $options[] = 5;
        
                        if($exam->random_answer == 1) {
                            shuffle($options);
                        }
        
                        $questionInserts[] = [
                            'question_title_id' => $question->question_title_id,
                            'question_id' => $question->id,
                            'value_category_id' => $question->value_category_id,
                            'type' => $question->type,
                            'direction' => $question->direction,
                            'question_order' => $question_order,
                            'navigation_order' => $navigation_order,
                            'audio_input' => $question->audio_input,
                            'audio' => $question->audio,
                            'audio_played' => (int) $question->audio_played,
                            'audio_played_limit' => (int) $question->audio_played_limit,
                            'audio_answer_time' => $question->audio_answer_time == null || $question->audio_answer_time == 0 ? 0 : (int) $question->audio_answer_time * 1000,
                            'question' => $question->question,
                            'question_answer' => $question->answer,
                            'option_1' => empty($question->option_1) ? null : $question->option_1,
                            'option_2' => empty($question->option_2) ? null : $question->option_2,
                            'option_3' => empty($question->option_3) ? null : $question->option_3,
                            'option_4' => empty($question->option_4) ? null : $question->option_4,
                            'option_5' => empty($question->option_5) ? null : $question->option_5,
                            'section' => $question->section,
                            'answer_order' => implode(",", $options),
                            'answer' => 0,
                            'is_correct' => 'N'
                        ];
        
                        $question_order++;
                    }    
                }

                Storage::put($path, json_encode($questionInserts));
            }

            DB::commit();

            return redirect()->route('user.exams.exam-show-questions', [$grade->exam_id, $grade->id, $grade->section]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e], 500);
        }
    }

    public function examShowQuestion($examId, $gradeId, $section, Request $request)
    {
        try {
            $exam = Exam::find($examId);

            $path = 'json/' . Auth::user()->id . '-' . $exam->id . '.json';

            if (!Storage::exists($path)) {
                return redirect()->route('user.exams.exam-start', $exam->id);
            }
            
            $grade = Grade::find($gradeId);

            if ($grade->is_finished == 1) {
                return redirect()->route('user.categories.lesson-categories.lessons.exams.show', [
                    $exam->category_id, $exam->lesson_category_id, $exam->lesson_id, $exam->id
                ]);
            }

            if ($section != $grade->section && empty($request->nextsection)) {
                return redirect()->route('user.exams.exam-show-questions', [$grade->exam_id, $grade->id, $grade->section]);
            }

            $valueExam = ValueCategoryExam::where(['exam_id' => $exam->id, 'section' => $section])->first();

            if($exam->duration_type == 1) {
                $addMinutes = (int) $exam->duration;
            } else if($exam->duration_type == 2) {
                $addMinutes = $valueExam->duration;
            } else {
                $addMinutes = 560;
            }
    
            if($grade->section < $section) {
                $grade->section = $grade->section + 1;
                if($exam->duration_type == 2) {
                    $grade->end_time = Carbon::now()->addMinutes($addMinutes)->addSeconds(1);
                }
                $grade->save();
                $grade->refresh();
            }

            $duration = ($grade->end_time > Carbon::now() || empty($grade->end_time)) ? $grade->end_time->diffInMilliseconds(Carbon::now()) : 0;

            $json = Storage::get($path);
            $gradeAnswers = json_decode($json, true);
            $questionLists = array_values(array_filter($gradeAnswers, fn($var) => $var['section'] == $section));

            $totalQuestions = count($questionLists);

            return inertia('User/TryOut/Exam/Question', [
                'exam' => $exam,
                'grade' => $grade,
                'setting' => Setting::first(),
                'questionLists' => $questionLists,
                'duration' => $duration,
                'section' => (int)$grade->section,
                'indexPage' => 0,
                'lastSection' => (int)$grade->total_section,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e], 500);
        }
    }

    /**
     * decrementTolerance
     *
     * @param  mixed $request
     * @return void
     */
    public function decrementTolerance(Request $request)
    {
        $grade = Grade::find($request->grade_id);

        if($request->warning == true) {
            $grade->update(['total_tolerance' => $grade->exam->total_tolerance, 'is_blocked' => 0]);
        } else {
            $total_tolerance = $grade->total_tolerance > 0 ? $grade->total_tolerance - 1 : 0 ;
            $is_blocked = $total_tolerance <= 0 ? 1 : 0;
            $grade->update(['total_tolerance' => $total_tolerance, 'is_blocked' => $is_blocked]);
        }
    }

    /**
     * endExam
     *
     * @param  mixed $request
     * @return void
     */
    public function endExam($examId, Request $request)
    {
        DB::beginTransaction();

        try {
            $exam = Exam::find($examId);
            $grade = Grade::find($request->grade_id);
            $grade->update(['answers' => $request->myAnswers]);

            $path = 'json/' . Auth::user()->id . '-' . $exam->id . '.json';

            if (!Storage::exists($path)) {
                return redirect()->route('user.exams.exam-start', $exam->id);
            }

            $json = Storage::get($path);
            $gradeAnswers = json_decode($json, true);
            
            $gradeAnswers = array_map(function ($gradeAnswer) use ($grade) {
                $data = array_filter($grade->answers, function ($item) use ($gradeAnswer) {
                    return $item['question_id'] === $gradeAnswer['question_id'];
                });

                if (!empty($data)) {
                    $gradeAnswer['answer'] = (int) reset($data)['answer'];
                    $gradeAnswer['is_correct'] = (int) reset($data)['answer'] === (int) $gradeAnswer['question_answer'] ? "Y" : "N";
                }

                return $gradeAnswer;
            }, $gradeAnswers);

            $totalCorrectPerSection = array_reduce(range(1, $exam->questionTitle->total_section), function ($carry, $i) use ($gradeAnswers) {
                $totalCorrect = array_filter($gradeAnswers, function ($var) use ($i) {
                    return ($var['is_correct'] == "Y" && $var['section'] == $i);
                });
                $carry[] = count($totalCorrect);
                return $carry;
            }, []);

            $totalCorrect = array_filter($gradeAnswers, function ($var) {
                return ($var['is_correct'] === "Y" && $var['answer'] !== 0);
            });

            $totalAnswer = array_filter($gradeAnswers, function ($var) {
                return ($var['answer'] !== 0);
            });

            $totalWrong = array_filter($gradeAnswers, function ($var) {
                return ($var['is_correct'] === "N");
            });

            $totalQuestionGrade = count($gradeAnswers);
            $count_correct_answer = count($totalCorrect);

            $grade_exam = $count_correct_answer == 0 ? 0 : round($count_correct_answer / $totalQuestionGrade * 100, 2);

            $gradeAnswers = array_map(function ($item) {
                unset($item['id']);
                unset($item['audio']);
                unset($item['section']);
                unset($item['option_1']);
                unset($item['option_2']);
                unset($item['option_3']);
                unset($item['option_4']);
                unset($item['option_5']);
                unset($item['question']);
                unset($item['created_at']);
                unset($item['deleted_at']);
                unset($item['discussion']);
                unset($item['deleted_at']);
                unset($item['updated_at']);
                unset($item['audio_input']);
                unset($item['question_id']);
                unset($item['question_order']);
                unset($item['answer_order']);
                unset($item['question_answer']);
                unset($item['navigation_order']);
                unset($item['audio_answer_time']);
                unset($item['question_title_id']);
                unset($item['audio_played_limit']);
                
                return $item;
            }, $gradeAnswers);

            $updates = [
                'end_time' => now(),
                'total_correct' => $count_correct_answer,
                'grade' => null,
                'is_finished' => 1,
                'answers' => serialize($gradeAnswers),
                'total_correct_per_section' => $totalCorrectPerSection,
            ];

            $updates['final_grade'] = $grade_exam;

            $grade->update($updates);

            DB::commit();

            return redirect()->route('user.categories.exams.show', [$exam->category_id, $exam->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function removeOldFiles()
    {
        $directoryPath = storage_path('app/json');
        $currentDate = Carbon::now();
        $thresholdDate = $currentDate->subDays(1);

        $oldFiles = [];
        $allFiles = File::allFiles($directoryPath);

        foreach ($allFiles as $file) {
            $fileCreationTime = Carbon::createFromTimestamp($file->getCTime());
            if ($fileCreationTime->lessThan($thresholdDate)) {
                $oldFiles[] = $file->getPathname();
            }
        }

        foreach ($oldFiles as $file) {
            File::delete($file);
        }
    }

    public function unblocked(Request $request, $examId, $gradeId)
    {
        try {

            $exam = Exam::find($examId);

            if($request->token == $exam->unblock_token) {
                $grade = Grade::find($gradeId)->update(['is_blocked' => 0, "total_tolerance" => $exam->total_tolerance]);
                return response()->json([ "success" => true, "message" => "Membuka Blokir Berhasil"], 200);

            } else {
                return response()->json([ "success" => false, "message" => "Kode Tidak Cocok"], 200);
            }

        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => $th->getMessage()
            ]);
        }
    }
}
