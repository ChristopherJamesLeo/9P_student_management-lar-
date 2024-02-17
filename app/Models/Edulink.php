<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edulink extends Model
{
    use HasFactory;

    protected $table = "edulinks";

    protected $primaryKey = "id";

    protected $fillable = [
        "post_id",
        "tag_id",
        "classdate",
        "link",
        "status_id",
        "stage_id",
        "user_id"
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }
    
    public function post(){
        return $this -> belongsTo(Post::class);
    }

    public function tag(){
        return $this -> belongsTo(Tag::class);
    }

    public function status(){
        return $this -> belongsTo(Status::class);
    }

    public function stage(){
        return $this -> belongsTo(Stage::class);
    }

    
}
