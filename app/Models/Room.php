<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];
    public function room_category():BelongsTo
    {
        return $this->belongsTo(RoomCategory::class);
    }

    public function room_check()
    {
        return $this->belongsTo(RoomChecker::Class, 'room_id');
    }
}
