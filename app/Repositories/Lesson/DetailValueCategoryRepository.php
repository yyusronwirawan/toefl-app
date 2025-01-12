<?php

namespace App\Repositories\Lesson;

use App\Models\Lesson\DetailValueCategory;
use App\Repositories\Contracts\Lesson\DetailValueCategoryInterface;
use App\Repositories\BaseRepository;

class DetailValueCategoryRepository extends BaseRepository implements DetailValueCategoryInterface
{
    /**
     * @var
     */
    protected $model;

    public function __construct()
    {
        $this->model = new DetailValueCategory();
    }

    public function getAllSimplePaginatedWithParams($params, $limit = 10)
    {
        $detailValueCategories = $this->model;
        if(isset($params->search) && !empty($params->search)) $detailValueCategories->where('category_grade', 'like', '%' . $params->search . '%');
        $detailValueCategories = $detailValueCategories->orderBy('created_at', 'ASC')->simplePaginate($limit);
        return $detailValueCategories;
    }

    public function getAllByValueCategoryPaginatedWithParams($valueCategoryId, $params, $limit = 10)
    {
        $detailValueCategories = $this->model;
        if(isset($params->search) && !empty($params->search)) $detailValueCategories->where('category_grade', 'like', '%' . $params->search . '%');
        $detailValueCategories = $detailValueCategories->where('value_category_id', $valueCategoryId)->with(['valueCategory'])->orderBy('created_at', 'ASC')->paginate($limit);
        return $detailValueCategories;
    }
}
