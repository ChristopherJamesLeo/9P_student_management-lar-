<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;


use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory;

    use Notifiable;


    protected $table = "posts";

    protected $primaryKey ="id";

    protected $fillable = [
        "name",
        "zoomid",
        "passcode",
        "startdate",
        "enddate",
        "starttime",
        "endtime",
        "fee",
        "image",
        "content",
        "slug",
        "tag_id",
        "type_id",
        "attshow",
        "status_id",
        "user_id"
    ];

    public function getpost(){
        return $this->where("id",auth()->user()->id)->get();
    }


    public function tag(){
        return $this -> belongsTo(Tag::class);
    }

    public function type(){
        return $this -> belongsTo(Type::class);
    }

    public function attstatus(){
        return $this -> belongsTo(Status::class,"attshow","id");
    }

    public function status(){
        return $this -> belongsTo(Status::class);
    }

    public function user(){
        return $this -> belongsTo(User::class);
    }

    public function days(){
        return $this -> morphToMany(Day::class,"dayable");
    }

    public function comments(){
        return $this -> morphMany(Comment::class,"commentable");
    }

    public function checkenroll($user_id) {
        return \DB::table("enrolls")->where("post_id",$this->id)->where("user_id",$user_id)->exists();
    }


    public function scopefilter($query){
        return $query -> where(function($query){
            if($getfilter = request("filter")){
                $query -> where("slug",$getfilter);
            }
        });
    }

    public function scopesearchonly($query){
        return $query -> where(function($query){
            if($getsearchonly = request("searchonly")){
                $query -> where("name","LIKE","%".$getsearchonly."%")
                     -> orWhere("fee","LIKE","%".$getsearchonly."%")
                ->orWhereHas("user",function($query) use($getsearchonly){
                    $query -> where("name","LIKE","%".$getsearchonly."%");
                })->orWhereHas("status",function($query) use($getsearchonly){
                    $query -> where("name","LIKE","%".$getsearchonly."%");
                });
            }
        });
    }
}
