<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    use HasFactory;

    protected $table = "user_like";

    protected $primaryKey = "id";

    protected $fillable = [
        "user_id",
        "liker_id"
    ];

}
