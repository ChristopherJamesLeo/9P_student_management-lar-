<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;


use App\Models\User;
use App\Models\Enroll;
use App\Models\Leave;
use App\Models\Gender;
use App\Models\Role;
use App\Models\City;
use App\Models\Country;
use App\Models\Status;

class DashboardController extends Controller
{

    public function index()
    {
        $data["user"] = User::findOrFail(Auth::user()->id);

        $id = $data["user"]->id;

        $data["enrolls"] = Enroll::where("user_id",$id)->orderBy("updated_at","desc")->get();

        $data["leaves"] = Leave::where("user_id",$id)->orderby("created_at","desc")->get();

        $data["genders"]= Gender::pluck("name","id");

        $data["roles"]= Role::pluck("name","id");

        $data["cities"]= City::pluck("name","id");

        $data["countries"]= Country::pluck("name","id");

        $data["statuses"]= Status::whereIn("id",["1","2","16","18"])->pluck("name","id");

        $data["today"] = Carbon::today()->format("Y-m-d");

        return view("./dashboard",$data);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
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
        // dd($request);
        $this -> validate(request(),[
            "name" => "required|unique:users,name,".$id,
            "email" => "required|unique:users,email,".$id,
        ]);

        $user = User::findOrFail($id);

        $user->name = $request["name"];
        $user -> slug = Str::slug($request["name"]);
        $user->email = $request["email"];
        $user->status_id = $request["status_id"];
        $user->role_id = $request["role_id"];
        $user->gender_id = $request["gender_id"];
        $user->city_id = $request["city_id"];
        $user->country_id = $request["country_id"];

        $user -> save();

        session()->flash("success","User Info Update Successful");
        return redirect()->back();
    }


    public function destroy(string $id)
    {
        //
    }
}
