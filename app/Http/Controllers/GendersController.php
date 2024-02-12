<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

use App\Models\Gender;
use App\Models\Status;

class GendersController extends Controller
{
    public function index()
    {
        $genders = Gender::paginate(7);

        $statuses = Status::whereIn("id",["3","4"])->get()->pluck("name","id");

        return view("genders.index",compact('genders',"statuses"));
    }

    public function store(Request $request){
        $this -> validate(request(),[
            "name" => "required"
        ]);

        $userId = Auth::user()->id;

        Gender::create([
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

        $gender = Gender::findOrFail($id);

        $gender -> name = $request["name"];
        $gender -> status_id = $request["status_id"];
        $gender -> user_id = Auth::user()->id;

        $gender -> save();

        session()->flash("success","Data Update Successful");

        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $gender = Gender::findOrFail($id);

        $gender->delete();

        session()->flash("success","Data Delete Successful");

        return redirect()->back();
    }

    // change status

    public function genderstatus(Request $request){

        // dd($request["id"]);

        $gender = Gender::findOrFail($request["id"]);

        $gender->status_id = $request["status_id"];

        $gender -> save();

    }
}
