<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Tag;
use App\Models\Status;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(5);

        $statuses = Status::whereIn("id",["3","4"])->get()->pluck("name","id");

        return view("tags.index",compact('tags',"statuses"));
    }

    public function store(Request $request){
        $this -> validate(request(),[
            "name" => "required"
        ]);

        $userId = Auth::user()->id;

        Tag::create([
            "name" => $request["name"],
            "user_id" => $userId
        ]);

        session()->flash("success","Data Insert Successful");

        return redirect()->back();

    }
    
    public function update(Request $request, string $id)
    {

        $this -> validate(request(),[
            "name" => "required",
            "status_id" => "required|in:3,4",
        ]);

        $tag = Tag::findOrFail($id);

        $tag -> name = $request["name"];
        $tag -> status_id = $request["status_id"];
        $tag -> user_id = Auth::user()->id;

        $tag -> save();

        session()->flash("success","Data Update Successful");

        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);

        $tag->delete();

        session()->flash("success","Data Delete Successful");

        return redirect()->back();
    }


    public function changestatus(Request $request){

        $tag = Tag::findOrFail($request["id"]);

        $tag->status_id = $request["status_id"];

        $tag -> save();

    }
}
