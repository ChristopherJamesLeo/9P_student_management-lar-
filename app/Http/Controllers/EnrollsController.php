<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Enroll;
use App\Models\Stage;
use App\Models\Post;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

use App\Notifications\EnrollEmailNotify; 

use App\Jobs\EnrollMailJob;

use App\Mail\EnrollMailBox; 

class EnrollsController extends Controller
{

    public function index()
    {
        $data["enrolls"] = Enroll::filter()->searchonly()->orderby("created_at","desc")->paginate(30);
        $data["stages"] = Stage::whereIn("id",["1","2","3"])->pluck("name","id");

        $data["filterRoles"] = Post::orderBy("updated_at","desc")->get();
        
        return view("enrolls.index",$data);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this -> validate($request,[
            "image" => "required|image|mimes:jpg,jpeg,png|max:3072"
        ]);

        $enroll = new Enroll();
        $enroll -> post_id = $request["post_id"];
        $enroll -> user_id = Auth::user()->id;
        $enroll -> stage_id = $request["stage_id"];

        // dd($request["image"]);

        if(file_exists($request["image"])){

            $file = $request->file("image");

            $fname = $file->getClientOriginalName();

            $newfilename = uniqid().time().$fname;

            $file -> move(public_path("assets/imgs/enrolls/"),$newfilename);

            $filepath = "assets/imgs/enrolls/".$newfilename;

            $enroll -> image = $filepath;
        }
        
        $enroll -> save();

        $user = Auth::user();

        $post_slug = $enroll->slug;

        $emailnotidata = [
            
            "name" => $enroll->postname(),
            "stage" => $enroll -> stagename(),
            "url" => url("posts/".$post_slug)

        ];


        Notification::send($user, new EnrollEmailNotify($emailnotidata));

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
        // dd($request["stage_id"]);

        $enroll = Enroll::findOrFail($id);

        $enroll -> stage_id = $request["stage_id"];

        $enroll -> admit_by = Auth::user()->id;

        $enroll -> save();

        $data = [
            "to" => $enroll->user->email,
            "subject" => $enroll-> post -> name ,
            "starttime" => $enroll->post->starttime,
            "endtime" => $enroll->post->endtime,
            "startdate" => $enroll->post->startdate,
            "enddate" => $enroll->post->enddate,
            "username" => $enroll -> user -> name,
            "stage" => $enroll -> stage -> name,
            "stage_id" => $enroll -> stage -> id,
            "admit_by" => $enroll -> admit -> name,
            "zoomid" => $enroll -> post -> zoomid,
            "passcode" => $enroll -> post -> passcode

        ];

        dispatch(new EnrollMailJob($data));

        session()->flash("success","Enroll " . $enroll -> stage -> name . " Successful");

        return redirect()->back();
    }


    public function destroy(string $id)
    {
        // $enroll = Enroll::findOrFail($id);

        // // dd($enroll);

        // $file = $enroll->image;

        // if(File::exists($file)){
        //     File::delete($file);
        // }

        // $enroll->delete();
        
        // session()->flash("success","Enroll Delete Successful");

        // return redirect()->back();
    }
}
