<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends BaseModel
{
    use HasFactory;

    protected $guarded = ['id'];
}
