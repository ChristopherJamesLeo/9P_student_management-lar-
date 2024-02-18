<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\User;
use App\Models\Enroll;
use App\Models\Leave;



use App\Jobs\StudentEmailJob;

class UsersController extends Controller
{

    public function index()
    {
        $data["users"] = User::paginate(20);

        return view("users.index",$data);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $slug)
    {
        // $data["user"] = User::findOrFail($id);

        $data["user"] = User::where("slug",$slug)->firstOrFail();

        // dd($data["user"]);

        $id = $data["user"]->id;

        $data["enrolls"] = Enroll::where("user_id",$id)->orderBy("updated_at","desc")->get();

        $data["posts"] = Enroll::where("user_id",Auth::user()->id)->where("stage_id",1)->get();

        $data["leaves"] = Leave::where("user_id",$id)->orderby("created_at","desc")->get();

        $data["today"] = Carbon::today()->format("Y-m-d");

        return view("users.show",$data);
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


    // email send 
    public function usersendemail(Request $request){
        $user = User::findOrFail($request["user_id"]);

        $username = $user -> name;

        $comemail = $request["comemail"];

        $comsubject = $request["comsubject"];

        $comcontent = $request["comcontent"];

        $data = [
            "to" => $comemail,
            "subject" => $comsubject,
            "username" => $username,
            "content" => $comcontent,
            "sendby" => Auth::user()->name
        ];

        // dd($data);

        dispatch(new StudentEmailJob($data));

        session()->flash("success","Email Send Successful");

        return redirect()->back();
    }

}
