<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $table = "leaves";

    protected $primaryKey = "id";

    protected $fillable = [
        "image",
        "startdate",
        "enddate",
        "post_id",
        "user_id",
        "stage_id",
        "admin_id"
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }

    public function admin(){
        return $this -> belongsTo(User::class,"admin_id","id");
    }
    
    public function stage(){
        return $this -> belongsTo(Stage::class,"stage_id","id");
    }

        
    public function post(){
        return $this -> belongsTo(Post::class);
    }

}
