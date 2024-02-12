<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Day;
use App\Models\Status;

class DaysController extends Controller
{
    public function index()
    {
        $days = Day::paginate(7);

        $statuses = Status::whereIn("id",["3","4"])->get()->pluck("name","id");

        return view("days.index",compact('days',"statuses"));
    }

    public function store(Request $request){
        $this -> validate(request(),[
            "name" => "required"
        ]);

        $userId = Auth::user()->id;

        Day::create([
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

        $day = Day::findOrFail($id);

        $day -> name = $request["name"];
        $day -> status_id = $request["status_id"];
        $day -> user_id = Auth::user()->id;

        $day -> save();

        session()->flash("success","Data Update Successful");

        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $day = Day::findOrFail($id);

        $day->delete();

        session()->flash("success","Data Delete Successful");

        return redirect()->back();
    }

    // change status

    public function daystatus(Request $request){

        // dd($request["id"]);

        $day = Day::findOrFail($request["id"]);

        $day->status_id = $request["status_id"];

        $day -> save();

    }
}
