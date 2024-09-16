<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomCategory extends BaseModel
{
    use HasFactory, SoftDeletes;

//    protected $table = 'room_category';
    protected $guarded = ["id"];


}
