<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomChecker extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function room_data():BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
