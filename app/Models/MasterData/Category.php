<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Category extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'thumbnail',
        'development_status'
    ];

    protected $casts = [
        'id' => 'string'
    ];

    public function valueCategory()
    {
        return $this->hasMany(\App\Models\Lesson\ValueCategory::class);
    }
}
