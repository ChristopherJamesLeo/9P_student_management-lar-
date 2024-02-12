<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Type;
use App\Models\Status;


class TypesController extends Controller
{
    public function index()
    {
        $types = Type::paginate(5);

        $statuses = Status::whereIn("id",["3","4"])->get()->pluck("name","id");

        return view("types.index",compact('types',"statuses"));
    }

    public function store(Request $request){
        $this -> validate(request(),[
            "name" => "required"
        ]);

        $userId = Auth::user()->id;

        Type::create([
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

        $type = Type::findOrFail($id);

        $type -> name = $request["name"];
        $type -> status_id = $request["status_id"];
        $type -> user_id = Auth::user()->id;

        $type -> save();

        session()->flash("success","Data Update Successful");

        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $type = Type::findOrFail($id);

        $type->delete();

        session()->flash("success","Data Delete Successful");

        return redirect()->back();
    }

    // change status

    public function typestatus(Request $request){

        // dd($request["id"]);

        $type = Type::findOrFail($request["id"]);

        $type->status_id = $request["status_id"];

        $type -> save();

    }
}
