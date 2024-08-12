<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
