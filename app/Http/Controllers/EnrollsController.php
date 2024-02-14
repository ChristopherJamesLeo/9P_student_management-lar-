<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Enroll;
use App\Models\Post;

use Illuminate\Support\Facades\Notification;

use App\Notifications\EnrollEmailNotify; 

class EnrollsController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $enroll = new Enroll();
        $enroll -> post_id = $request["post_id"];
        $enroll -> user_id = Auth::user()->id;
        $enroll -> stage_id = 2;
        $enroll -> save();

        $user = Auth::user();

        $post_id = $enroll->post_id;

        $emailnotidata = [
            
            "name" => $enroll->postname(),
            "stage" => $enroll -> stagename(),
            "url" => url("posts/".$post_id)
        ];


        Notification::send($user, new EnrollEmailNotify($emailnotidata));

        session()->flash("success","Enroll Successful");
        return redirect()->back();
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
