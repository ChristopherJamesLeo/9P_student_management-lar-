<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use App\Models\Registration;

class SocialiteController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){

        try{
            $socialUser = Socialite::driver($provider)->stateless()->user();
        }catch(\Exception $e){
            return redirect("/login");
        }
        $user = User::where("provider",$provider)->where("provider_id",$socialUser->id)->first();

        if(!$user){
            $validator = Validator::make(
                ["email"=>$socialUser->email],
                ["email"=>["unique:users,email"]],
                ["email.unique" => "Coluldn't log in , Use Different Email To Log In"]
            );

            if($validator->fails()){
                session()->flash("warning","Your Email is already in use ");
                return redirect("/login");
            }
            $user = new User();

            $user -> name = $socialUser->name;
            $user -> email = $socialUser->email;
            $user -> slug = Str::slug($socialUser->name);
            $user -> provider = $provider;
            $user -> provider_id = $socialUser->id;

            $user -> save();

            $reglist = new Registration();

            $reglist -> reg_no = "BID_".$user->id;
            $reglist -> user_id = $user->id;
    
            $reglist->save();
    
        }

        // dd($user);
        Auth::login($user);

        return redirect("/");
    }
}
