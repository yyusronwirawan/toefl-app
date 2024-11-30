<?php

namespace App\Repositories\Exam;

use App\Models\Exam\Exam;
use App\Repositories\Contracts\Exam\ExamInterface;
use App\Repositories\BaseRepository;
use App\Models\Exam\ValueCategoryExam;
use App\Models\Lesson\ValueCategory;

class ExamRepository extends BaseRepository implements ExamInterface
{
    /**
     * @var
     */
    protected $model;

    public function __construct()
    {
        $this->model = new Exam();
    }

    public function all($columns = ['*'])
    {
        return $this->model->orderBy('created_at', 'ASC')->get($columns);
    }

    public function getAllSimplePaginatedWithParams($params, $limit = 10)
    {
        $exams = $this->model;
        if(isset($params->search) && !empty($params->search)) $exams->where('title', 'like', '%' . $params->search . '%');
        $exams = $exams->orderBy('created_at', 'ASC')->simplePaginate($limit);
        return $exams;
    }

    public function getAllPaginatedWithParams($params, $limit = 10)
    {
        $exams = $this->model;
        if(isset($params->search) && !empty($params->search)) $exams->where('title', 'like', '%' . $params->search . '%');
        $exams = $exams->withCount('gradeFinished')->with(['category', 'questionTitle'])->orderBy('created_at', 'ASC')->paginate($limit);
        return $exams;
    }

    public function getAllByCategoryPaginatedWithParams($params, $categoryId, $limit = 10, $examStatus = null)
    {
        $exams = $this->model->query();
        if(isset($params->search) && !empty($params->search)) $exams->where('title', 'like', '%' . $params->search . '%');
        if(isset($examStatus) && !empty($examStatus)) $exams->where('exam_status', $examStatus);
        $exams = $exams->where('category_id', $categoryId)->with(['category', 'questionTitle', 'transaction'])->orderBy('created_at', 'ASC')->paginate($limit);
        return $exams;
    }

    public function find($id)
    {
        return $this->model->with(['category', 'questionTitle', 'template'])->find($id);
    }

    public function create($attributes)
    {
        $input = $attributes->all();
        $input['duration'] = $attributes->duration_type == 2 ? null : $attributes->duration;
        $input['unblock_token'] = $attributes->total_tolerance == null ? null : $this->generateRandomCode(6); 
        $exam =  $this->model->create($input);

        if($attributes->duration_type == 2) {
            $valueCategories = ValueCategory::where('category_id', $attributes->category_id)->orderBy('section', 'ASC')->get();
            foreach($valueCategories as $index => $valueCategory) {
                ValueCategoryExam::create([
                    'exam_id' => $exam->id,
                    'value_category_id' => $valueCategory->id,
                    'section' => $index + 1,
                    'index' => $index,
                    'duration' => $attributes->duration_section[$index],
                ]);
            }
        }
    }

    public function update($attributes, $id)
    {
        $input = $attributes->except('_token','_method');
    

        $input['duration'] = $attributes->duration_type == 2 ? null : $attributes->duration;
        $input['unblock_token'] = $attributes->total_tolerance == null ? null : $this->generateRandomCode(6); 

        ValueCategoryExam::where('exam_id', $id)->delete();

        $exam = $this->find($id);
        $exam->update($input);

        if($attributes->duration_type == 2) {
            $valueCategories = ValueCategory::where('category_id', $attributes->category_id)->orderBy('section', 'ASC')->get();
            foreach($valueCategories as $index => $valueCategory) {
                ValueCategoryExam::create([
                    'exam_id' => $id,
                    'value_category_id' => $valueCategory->id,
                    'section' => $index + 1,
                    'index' => $index,
                    'duration' => $attributes->duration_section[$index],
                ]);
            }
        }
    }

    public function regenerateToken($id)
    {
        $exam = $this->find($id);
        $exam->update(['unblock_token' => $this->generateRandomCode()]);

        return $exam;
    }

    function generateRandomCode($length = 8) 
    {
        $bytes = random_bytes($length);
        return strtoupper(substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $length));
    }
}
