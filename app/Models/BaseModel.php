<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class BaseModel extends Model
{
    use SoftDeletes;
    protected $guarded = ['created_at', 'updated_at'];
    public $incrementing = false;
    protected $casts = ['id' => 'string'];
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4();
        });
    }
}
