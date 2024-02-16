<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Models\Leave;
use App\Models\Enroll;
use App\Models\Stage;

use App\Models\Post;

class LeavesController extends Controller
{
    public function index()
    {
        $data["leaves"] = Leave::orderby("created_at","desc")->paginate(30);
        $data["posts"] = Enroll::where("user_id",Auth::user()->id)->where("stage_id",1)->get();
        $data["stages"] = Stage::whereIn("id",["1","2","3"])->pluck("name","id");
        return view("leaves.index",$data);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this -> validate($request,[
            "image" => "image|mimes:jpg,jpeg,png|max:3072",
            "message" => "required"
        ]);


        $leave = new Leave();
        $leave -> post_id = $request["post_id"];
        $leave -> startdate = $request["startdate"];
        $leave -> enddate = $request["enddate"];
        $leave -> message = $request["message"];
        $leave -> user_id = Auth::user()->id;
        $leave -> admin_id = $request["admin_id"];

        // dd($request["image"]);

        if(file_exists($request["image"])){

            $file = $request->file("image");

            $fname = $file->getClientOriginalName();

            $newfilename = uniqid().time().$fname;

            $file -> move(public_path("assets/imgs/leaves/"),$newfilename);

            $filepath = "assets/imgs/leaves/".$newfilename;

            $leave -> image = $filepath;
        }
        
        $leave -> save();

        session()->flash("success","Leave Successful");

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

        $leave = Leave::findOrFail($id);

        $leave -> stage_id = $request["stage_id"];

        $leave -> admin_id = Auth::user()->id;

        $leave -> save();

        session()->flash("success","Enroll " . $leave -> stage -> name . " Successful");

        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $leave = Leave::findOrFail($id);

        // dd($leave);

        $file = $leave->image;

        if(File::exists($file)){
            File::delete($file);
        }

        $leave->delete();
        
        session()->flash("success","Enroll Delete Successful");

        return redirect()->back();
    }
}
