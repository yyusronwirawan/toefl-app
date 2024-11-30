<?php

namespace App\Repositories\Lesson;

use App\Models\Lesson\Question;
use App\Repositories\Contracts\Lesson\QuestionInterface;
use App\Repositories\BaseRepository;
use App\Models\Lesson\ValueCategory;
use App\Services\UploadService;

class QuestionRepository extends BaseRepository implements QuestionInterface
{
    /**
     * @var
     */
    protected $model;

    protected $path = 'upload_files/questions';

    public function __construct()
    {
        $this->model = new Question();
    }

    public function getAllPaginatedWithParams($params, $limit = 10)
    {
        $questions = $this->model;
        if(isset($params->search) && !empty($params->search)) $questions->where('question', 'like', '%' . $params->search . '%');
        $questions = $questions->with(['questionTitle','valueCategory'])->orderBy('created_at', 'ASC')->paginate($limit);
        return $questions;
    }

    public function getByQuestionTitlePaginatedWithParams($params, $questionTitleId, $limit = 10)
    {
        $questions = $this->model;
        if(isset($params->search) && !empty($params->search)) $questions->where('question', 'like', '%' . $params->search . '%');
        $questions = $questions->where('question_title_id', $questionTitleId)->with(['questionTitle','valueCategory'])->orderBy('created_at', 'ASC')->paginate($limit);
        return $questions;
    }

    public function create($attributes)
    {
        $input = $attributes->all();

        $input['audio_played'] = 0;
        $input['direction'] = $attributes->type == 1 ? null : $attributes->direction;
        $input['audio_input'] = $attributes->audio_input;
        $input['audio_played_limit'] = $attributes->audio_input == 0 ? null : $attributes->audio_played_limit;
        $input['audio_answer_time'] = $attributes->audio_input == 0 ? null : $attributes->audio_answer_time;
        $input['section'] = ValueCategory::find($attributes->value_category_id)->section;
        $input['question'] = empty($attributes->question) || $attributes->type == 2 ? 0 : str_replace("../../../..", "", $attributes->question);
        $input['option_1'] = empty($attributes->option_1) || $attributes->type == 2 ? 0 : str_replace("../../../..", "", $attributes->option_1);
        $input['option_2'] = empty($attributes->option_2) || $attributes->type == 2 ? 0 : str_replace("../../../..", "", $attributes->option_2);
        $input['option_3'] = empty($attributes->option_3) || $attributes->type == 2 ? 0 : str_replace("../../../..", "", $attributes->option_3);
        $input['option_4'] = empty($attributes->option_4) || $attributes->type == 2 ? 0 : str_replace("../../../..", "", $attributes->option_4);
        $input['option_5'] = empty($attributes->option_5) || $attributes->type == 2 ? null : str_replace("../../../..", "", $attributes->option_5);
        $input['answer'] = $attributes->type == 2 ? null : $attributes->answer;

        if($attributes->hasFile('audio')){
            $file = $attributes->file('audio')->getClientOriginalName();
            $filename = (new UploadService())->uploadFile($attributes->file('audio'), $this->path);
            $input['audio'] = $filename;
        }

        return $this->model->create($input);
    }

    public function update($attributes, $id)
    {
        $input = $attributes->except('_token','_method');
        $question = $this->find($id);
        $input['audio_played'] = 0;
        $input['direction'] = $attributes->type == 1 ? null : $attributes->direction;
        $input['audio_input'] = $attributes->audio_input;
        $input['audio_played_limit'] = $attributes->audio_input == 0 ? null : $attributes->audio_played_limit;
        $input['audio_answer_time'] = $attributes->audio_input == 0 ? null : $attributes->audio_answer_time;
        $input['section'] = ValueCategory::find($attributes->value_category_id)->section;
        $input['question'] = empty($attributes->question) || $attributes->type == 2 ? null : str_replace("../../../..", "", $attributes->question);
        $input['option_1'] = empty($attributes->option_1) || $attributes->type == 2 ? null : str_replace("../../../..", "", $attributes->option_1);
        $input['option_2'] = empty($attributes->option_2) || $attributes->type == 2 ? null : str_replace("../../../..", "", $attributes->option_2);
        $input['option_3'] = empty($attributes->option_3) || $attributes->type == 2 ? null : str_replace("../../../..", "", $attributes->option_3);
        $input['option_4'] = empty($attributes->option_4) || $attributes->type == 2 ? null : str_replace("../../../..", "", $attributes->option_4);
        $input['option_5'] = empty($attributes->option_5) || $attributes->type == 2 ? null : str_replace("../../../..", "", $attributes->option_5);
        $input['answer'] = $attributes->type == 2 ? null : $attributes->answer;

        if($attributes->hasFile('audio')){
            $file = $attributes->file('audio')->getClientOriginalName();
            $filename = (new UploadService())->uploadFile($attributes->file('audio'), $this->path);
            (new UploadService())->deleteFile($question->audio, $this->path);
            $input['audio'] = $filename;
        }

        if($attributes->audio_input == 0) {
            $input['audio'] = null;
            (new UploadService())->deleteFile($question->audio, $this->path);
        }

        return $question->update($input);
    }

    public function delete($id)
    {
        $question = $this->model->find($id);
        (new UploadService())->deleteFile($question->audio, $this->path);
        return $question->delete();
    }
}
