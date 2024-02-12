<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Stage;
use App\Models\Status;

class StagesController extends Controller
{
    public function index()
    {
        $stages = Stage::paginate(5);

        $statuses = Status::whereIn("id",["3","4"])->get()->pluck("name","id");

        return view("stages.index",compact('stages',"statuses"));
    }

    public function store(Request $request){
        $this -> validate(request(),[
            "name" => "required"
        ]);

        $userId = Auth::user()->id;

        Stage::create([
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

        $stage = Stage::findOrFail($id);

        $stage -> name = $request["name"];
        $stage -> status_id = $request["status_id"];
        $stage -> user_id = Auth::user()->id;

        $stage -> save();

        session()->flash("success","Data Update Successful");

        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $stage = Stage::findOrFail($id);

        $stage->delete();

        session()->flash("success","Data Delete Successful");

        return redirect()->back();
    }


    public function stagestatus(Request $request){

        $stage = Stage::findOrFail($request["id"]);

        $stage->status_id = $request["status_id"];

        $stage -> save();

    }
}
