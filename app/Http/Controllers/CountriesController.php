<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Country;
use App\Models\Status;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = Country::paginate(7);

        $statuses = Status::whereIn("id",["3","4"])->get()->pluck("name","id");

        return view("countries.index",compact('countries',"statuses"));
    }

    public function store(Request $request){
        $this -> validate(request(),[
            "name" => "required"
        ]);

        $userId = Auth::user()->id;

        Country::create([
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

        $country = Country::findOrFail($id);

        $country -> name = $request["name"];
        $country -> status_id = $request["status_id"];
        $country -> user_id = Auth::user()->id;

        $country -> save();

        session()->flash("success","Data Update Successful");

        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $country = Country::findOrFail($id);

        $country->delete();

        session()->flash("success","Data Delete Successful");

        return redirect()->back();
    }

    // change status

    public function countrystatus(Request $request){

        // dd($request["id"]);

        $country = Country::findOrFail($request["id"]);

        $country->status_id = $request["status_id"];

        $country -> save();

    }
}
