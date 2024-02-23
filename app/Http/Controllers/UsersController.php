<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\User;
use App\Models\Enroll;
use App\Models\Role;
use App\Models\Leave;
use App\Models\Gender;
use App\Models\City;
use App\Models\Country;
use App\Models\Status;




use App\Jobs\StudentEmailJob;

class UsersController extends Controller
{

    public function index()
    {
        $data["users"] = User::filter()->searchonly()->paginate(20);

        $data["filterRoles"] = Role::where("status_id",3)->get();

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
        $data["user"] = User::where("slug",$slug)->firstOrFail();


        $id = $data["user"]->id;

        $data["enrolls"] = Enroll::where("user_id",$id)->orderBy("updated_at","desc")->get();

        $data["posts"] = Enroll::where("user_id",Auth::user()->id)->where("stage_id",1)->get();

        $data["leaves"] = Leave::where("user_id",$id)->orderby("created_at","desc")->get();

        $data["today"] = Carbon::today()->format("Y-m-d");

        $data["genders"]= Gender::pluck("name","id");

        $data["roles"]= Role::pluck("name","id");

        $data["cities"]= City::pluck("name","id");

        $data["countries"]= Country::pluck("name","id");

        $data["statuses"]= Status::whereIn("id",["1","2","16","18"])->pluck("name","id");

        return view("users.show",$data);
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        $this -> validate(request(),[
            "status_id" => "required",
            "role_id" => "required"
        ]);

        $user = User::findOrFail($id);

        $user -> status_id = $request["status_id"];
        $user -> role_id = $request["role_id"];

        $user -> save();

        session()->flash("success","User Data Update Successful");

        return redirect()->back();

    }


    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user -> delete();

        return redirect()->route("users.index");
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
