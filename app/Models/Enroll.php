<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

class Enroll extends Model
{
    use HasFactory;

    use Notifiable;

    protected $table = "enrolls";

    protected $primaryKey ="id";

    protected $fillable = [
        "image",
        "post_id",
        "stage_id",
        "user_id"
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }

    public function admit(){
        return $this -> belongsTo(User::class,"admit_by","id");
    }
    
    public function post(){
        return $this -> belongsTo(Post::class);
    }

    public function postname(){
        return $this -> post ->name;
    }

    public function postid(){
        return $this -> post ->id;
    }



    public function stage(){
        return $this -> belongsTo(Stage::class,"stage_id","id");
    }

    public function stagename(){
        return $this -> stage -> name;
    }

    public function scopefilter($query){
        return $query -> where(function($query){
            if($getfilter = request("filter")){
                $query -> where("id",$getfilter);
            }
        });
    }

    public function scopesearchonly($query){
        return $query -> where(function($query){
            if($getsearchonly = request("searchonly")){
                $query ->whereHas("user",function($query) use($getsearchonly){
                    $query -> where("name","LIKE","%".$getsearchonly."%");
                });
            }
        });
    }
}
