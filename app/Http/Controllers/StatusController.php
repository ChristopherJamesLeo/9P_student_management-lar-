<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Status;

class StatusController extends Controller
{

    public function index()
    {
        return view("statuses.index");
    }

    
    public function update(Request $request, string $id)
    {
        // dd($request);
        $this -> validate(request(),[
            "name" => "required",
        ]);

        $status = Status::findOrFail($id);

        $status -> name = $request["name"];
        $status -> user_id = Auth::user()->id;

        $status -> save();

        session()->flash("success","Data Update Successful");

        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $status = Status::findOrFail($id);

        $status->delete();

        session()->flash("success","Data Delete Successful");

        return redirect()->back();
    }
}
