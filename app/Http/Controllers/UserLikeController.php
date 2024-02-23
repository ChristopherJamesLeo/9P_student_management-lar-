<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\UserLike;

class UserLikeController extends Controller
{
    public function like(Request $request){

        $user_id = Auth::user()->id;

        $liker_id = $request["id"];

        UserLike::create([
            "user_id" => $user_id,
            "liker_id" => $liker_id
        ]);

        return redirect()->back();

    }

    public function unlike(Request $request){
        $user_id = Auth::user()->id;

        $liker_id = $request["id"];

        UserLike::where("liker_id",$liker_id)->where("user_id",$user_id)->delete();

        return redirect()->back();
    }
}