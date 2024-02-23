<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function gender(){
        return $this -> belongsTo(Gender::class);
    }

    public function role(){
        return $this -> belongsTo(Role::class);
    }

    public function status(){
        return $this -> belongsTo(Status::class);
    }

    public function city(){
        return $this -> belongsTo(City::class);
    }

    public function country(){
        return $this -> belongsTo(Country::class);
    }

    public function image(){
        return $this -> morphToMany(Image::class,"imageable");
    }

    public function registration(){
        return $this -> hasOne(Registration::class,"user_id");
    }

    public function scopefilter($query){
        return $query -> where(function($query){
            if($getfilter = request("filter")){
                $query -> where("role_id",$getfilter);
            }
        });
    }

    public function scopesearchonly($query){
        return $query -> where(function($query){
            if($getsearchonly = request("searchonly")){
                $query -> where("name","LIKE","%".$getsearchonly."%")
                        ->orWhereHas("registration",function($query) use ($getsearchonly){
                            $query -> where("reg_no","LIKE","%".$getsearchonly."%");
                        })->orWhereHas("city",function($query) use($getsearchonly){
                            $query -> where("name","LIKE","%".$getsearchonly."%");
                        })->orWhereHas("country",function($query) use($getsearchonly){
                            $query -> where("name","LIKE","%".$getsearchonly."%");
                        });
            }
        });
    }

    public function checklike($liker_id){
        return \DB::table("user_like")->where("user_id",auth()->user()->id)->where("liker_id",$liker_id)->exists();
    }

    public function countlike($liker_id){
        if (auth()->check()) {
            return \DB::table("user_like")->where("liker_id", $liker_id)->count();
        } else {
            return 0; 
        }
    }

}
