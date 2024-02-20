<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Attendance;
use App\Models\Post;

class AttendancesController extends Controller
{

    public function index()
    {
        $data["attendances"] = Attendance::filter()->searchonly()->orderBy("created_at","desc")->paginate(10);
        
        $data["posts"] = Post::pluck("name","id");

        $data["filterRoles"] = Post::orderBy("updated_at","desc")->get();
        
        return view("attendances.index",$data);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this -> validate(request(),[
            "name" => "required",
            "classdate" => "required",
            "post_id" => "required"
        ]);

        $userId = Auth::user()->id;

        Attendance::create([
            "name" => $request["name"],
            "classdate" => $request["classdate"],
            "post_id" => $request["post_id"],
            "user_id" => $userId
        ]);

        session()->flash("success","Data Insert Successful");

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
        $this -> validate(request(),[
            "name" => "required",
            "post_id" => "required",
        ]);

        $attendance = Attendance::findOrFail($id);

        $attendance -> post_id = $request["post_id"];

        $attendance -> save();

        session()->flash("success","Data Update Successful");

        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id);

        $attendance->delete();

        session()->flash("success","Data Delete Successful");

        return redirect()->back();
    }
}
