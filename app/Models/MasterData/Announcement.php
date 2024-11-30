<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Carbon\Carbon;

class Announcement extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $dates = ['created_at'];

    protected $fillable = [
        'id',
        'title',
        'description',
    ];

    protected $casts = [
        'id' => 'string'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i');
    }

    public function getDescriptionAttribute($value)
    {
        return str_replace("/storage/upload_files/questions", env('APP_URL', 'http://127.0.0.1:8000')."/storage/upload_files/questions", $value);
    }
}
