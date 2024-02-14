<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Enroll;
class EnrollsController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $enroll = new Enroll();
        $enroll -> post_id = $request["post_id"];
        $enroll -> user_id = Auth::user()->id;
        $enroll -> save();
        
        session()->flash("success","Enroll Successful");
        return redirect()->back();
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
