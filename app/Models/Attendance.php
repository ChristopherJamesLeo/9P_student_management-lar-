<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = "attendances";

    protected $primaryKey ="id";

    protected $fillable = [
        "name",
        "classdate",
        "post_id",
        "user_id"
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }

    public function post(){
        return $this -> belongsTo(Post::class);
    }


    public function scopefilter($query){
        return $query -> where(function($query){
            if($getfilter = request("filter")){
                $query -> where("post_id",$getfilter);
            }
        });
    }

    public function scopesearchonly($query){
        return $query -> where(function($query){
            if($getsearchonly = request("searchonly")){
                $query -> where("name","LIKE","%".$getsearchonly."%")
                     -> orWhere("classdate","LIKE","%".$getsearchonly."%")
                     -> orWhere("created_at","LIKE","%".$getsearchonly."%")
                     -> orWhere("updated_at","LIKE","%".$getsearchonly."%");
            }
        });
    }
}
