<?php

namespace App\Repositories\Setting;

use App\Models\Setting\Template;
use App\Repositories\Contracts\Setting\TemplateInterface;
use App\Repositories\BaseRepository;
use App\Services\UploadService;

class TemplateRepository extends BaseRepository implements TemplateInterface
{
    /**
     * @var
     */
    protected $model;

    public function __construct()
    {
        $this->model = new Template();
    }

    public function getAllPaginatedWithParams($params, $limit = 10)
    {
        $templates = $this->model->orderBy('created_at', 'ASC')->paginate($limit);

        return $templates;
    }
}
