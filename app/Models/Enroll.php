<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    use HasFactory;

    protected $table = "enrolls";

    protected $primaryKey ="id";

    protected $fillable = [
        "post_id",
        "user_id"
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }
    
}
