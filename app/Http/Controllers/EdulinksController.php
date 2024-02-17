<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


use App\Models\Edulink;
use App\Models\Enroll;
use App\Models\Status;
use App\Models\Stage;
use App\Models\Post;
use App\Models\Tag;


class EdulinksController extends Controller
{
    public function index()
    {

        $data["edulinks"] = Edulink::paginate(7);

        $data["enrolls"] = Enroll::where("user_id",Auth::user()->id)->get();

        $data["statuses"] = Status::whereIn("id",["7","8"])->get()->pluck("name","id");

        $data["stages"] = Stage::whereIn("id",["11","12"])->get()->pluck("name","id");

        $data["posts"] = Post::all()->pluck("name","id");

        $data["tags"] = Tag::where("status_id",["3","4"])->pluck("name","id");

        return view("edulinks.index",$data);
    }

    public function store(Request $request){
        $this -> validate(request(),[
            "post_id" => "required",
            "tag_id" => "required",
            "classdate" => "required",
            "link" => "required"
        ]);

        $userId = Auth::user()->id;

        Edulink::create([
            "post_id" => $request["post_id"],
            "tag_id" => $request["tag_id"],
            "classdate" => $request["classdate"],
            "link" => $request["link"],
            "user_id" => $userId
        ]);

        session()->flash("success","Data Insert Successful");

        return redirect()->back();

    }
    
    public function update(Request $request, string $id)
    {

        $this -> validate(request(),[
            "post_id" => "required",
            "tag_id" => "required",
            "classdate" => "required",
            "link" => "required",
            "status_id" => "required",
            "stage_id" => "required"
        ]);

        $edulink = Edulink::findOrFail($id);

        $edulink -> post_id = $request["post_id"];
        $edulink -> tag_id = $request["tag_id"];
        $edulink -> classdate = $request["classdate"];
        $edulink -> link = $request["link"];
        $edulink -> status_id = $request["status_id"];
        $edulink -> stage_id = $request["stage_id"];
        $edulink -> user_id = Auth::user()->id;

        $edulink -> save();

        session()->flash("success","Data Update Successful");

        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $edulink = Edulink::findOrFail($id);

        $edulink->delete();

        session()->flash("success","Data Delete Successful");

        return redirect()->back();
    }

    // change status

    public function edulinkstatus(Request $request){


        $roedulinkle = Edulink::findOrFail($request["id"]);

        $edulink->status_id = $request["status_id"];

        $edulink -> save();

    }
}
