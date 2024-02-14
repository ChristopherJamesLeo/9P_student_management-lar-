<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = "registrations";

    protected $primaryKey = "id";

    protected $fillable = [
        "reg_no",
        "registrable_id",
        "registrable_type"
    ];
}
