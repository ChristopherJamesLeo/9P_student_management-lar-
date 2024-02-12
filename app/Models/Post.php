<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $table = "posts";

    protected $primaryKey ="id";

    protected $fillable = [
        "name",
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



    public function tag(){
        return $this -> belongsTo(Tag::class);
    }

    public function type(){
        return $this -> belongsTo(Type::class);
    }

    public function attshow(){
        return $this -> belongsTo(Status::class,"attshow");
    }

    public function status(){
        return $this -> belongsTo(Status::class);
    }

    public function user(){
        return $this -> belongsTo(User::class);
    }
}
