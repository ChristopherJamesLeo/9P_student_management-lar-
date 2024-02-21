<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Announcement extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = "announcements";

    protected $primaryKey = "id";

    protected $fillable = [
        "image",
        "title",
        "message",
        "status_id",
        "post_id",
        "user_id",
        "role_id",
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }
    public function status(){
        return $this -> belongsTo(Status::class);
    }   
    public function post(){
        return $this -> belongsTo(Post::class);
    }
    public function role(){
        return $this -> belongsTo(Role::class);
    }
}
