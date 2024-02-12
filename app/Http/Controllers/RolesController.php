<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

use App\Models\Role;
use App\Models\Status;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(7);

        $statuses = Status::whereIn("id",["3","4"])->get()->pluck("name","id");

        return view("roles.index",compact('roles',"statuses"));
    }

    public function store(Request $request){
        $this -> validate(request(),[
            "name" => "required"
        ]);

        $userId = Auth::user()->id;

        Role::create([
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

        $role = Role::findOrFail($id);

        $role -> name = $request["name"];
        $role -> status_id = $request["status_id"];
        $role -> user_id = Auth::user()->id;

        $role -> save();

        session()->flash("success","Data Update Successful");

        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        session()->flash("success","Data Delete Successful");

        return redirect()->back();
    }

    // change status

    public function rolestatus(Request $request){

        // dd($request["id"]);

        $role = Role::findOrFail($request["id"]);

        $role->status_id = $request["status_id"];

        $role -> save();

    }
}
