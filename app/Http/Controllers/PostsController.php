<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use App\Models\Post;
use App\Models\Status;
use App\Models\Tag;
use App\Models\Type;
use App\Models\Day;

class PostsController extends Controller
{

    public function index()
    {
        $data['posts'] = Post::paginate(4);
        return view("posts.index",$data);
    }


    public function create()
    {
        return view("posts.create");
    }


    public function store(Request $request)
    {
        //
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


    // change status

    public function poststatus(Request $request){

        // dd($request["id"]);

        $role = Post::findOrFail($request["id"]);

        $role->status_id = $request["status_id"];

        $role -> save();

    }
}
