<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

use App\Models\City;
use App\Models\Status;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::paginate(7);

        $statuses = Status::whereIn("id",["3","4"])->get()->pluck("name","id");

        return view("cities.index",compact('cities',"statuses"));
    }

    public function store(Request $request){
        $this -> validate(request(),[
            "name" => "required"
        ]);

        $userId = Auth::user()->id;

        City::create([
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

        $city = City::findOrFail($id);

        $city -> name = $request["name"];
        $city -> status_id = $request["status_id"];
        $city -> user_id = Auth::user()->id;

        $city -> save();

        session()->flash("success","Data Update Successful");

        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $city = City::findOrFail($id);

        $city->delete();

        session()->flash("success","Data Delete Successful");

        return redirect()->back();
    }

    // change status

    public function citystatus(Request $request){

        // dd($request["id"]);

        $city = City::findOrFail($request["id"]);

        $city->status_id = $request["status_id"];

        $city -> save();

    }
}
