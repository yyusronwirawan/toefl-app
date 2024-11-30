<?php

namespace App\Repositories\Lesson;

use App\Models\Lesson\QuestionTitle;
use App\Repositories\Contracts\Lesson\QuestionTitleInterface;
use App\Repositories\BaseRepository;

class QuestionTitleRepository extends BaseRepository implements QuestionTitleInterface
{
    /**
     * @var
     */
    protected $model;

    public function __construct()
    {
        $this->model = new QuestionTitle();
    }

    public function getAllPaginatedWithParams($params, $limit = 10)
    {
        $questionTitles = $this->model->query();
        if(isset($params->search) && !empty($params->search)) $questionTitles->where('name', 'like', '%' . $params->search . '%');
        
        $questionTitles = $questionTitles->with(['category'])->orderBy('created_at', 'ASC')->paginate($limit);

        $questionTitles->appends([
            'search' => $params->search,
        ]);

        return $questionTitles;
    }

    public function find($id)
    {
        return $this->model->with(['category'])->find($id);
    }

    public function create($attributes)
    {
        $input = $attributes->all();
        $input['assessment_type'] = 1;

        return $this->model->create($input);
    }

    public function update($attributes, $id)
    {
        $questionTitle = $this->model->find($id);
        $input = $attributes->all();
        $input['assessment_type'] = 1;

        return $questionTitle->update($input);
    }

    public function getAllByCategory($categoryId)
    {
        return $this->model->where('category_id', $categoryId)->orderBy('created_at', 'ASC')->get();
    }
}
