<?php

namespace App\Repositories\MasterData;

use App\Models\MasterData\Faq;
use App\Repositories\Contracts\MasterData\FaqInterface;
use App\Repositories\BaseRepository;

class FaqRepository extends BaseRepository implements FaqInterface
{
    /**
     * @var
     */
    protected $model;

    public function __construct()
    {
        $this->model = new Faq();
    }

    public function getAllPaginatedWithParams($params, $limit = 10)
    {
        $faq = $this->model->query();
        if(isset($params->search) && !empty($params->search)) $faq->where('question', 'like', '%' . $params->search . '%');
        $faq = $faq->orderBy('created_at', 'ASC')->paginate($limit);
        return $faq;
    }

    public function getAllWithParams($params)
    {
        $faq = $this->model->query();
        if(isset($params->search) && !empty($params->search)) $faq->where('question', 'like', '%' . $params->search . '%');
        $faq = $faq->orderBy('created_at', 'ASC')->get();
        return $faq;
    }
}
