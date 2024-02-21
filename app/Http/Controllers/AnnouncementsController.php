<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Notification;
use App\Notifications\AnnouncementNotify;

use App\Models\Announcement;
use App\Models\Status;
use App\Models\Role;
use App\Models\User;

use App\Models\Post;
use App\Models\Tag;


class AnnouncementsController extends Controller
{

    public function index()
    {
        $data["announcements"] = Announcement::orderby("updated_at","desc")->paginate(10);
        $data["posts"] = Post::all();

        // dd($data["posts"]);
        $data["statuses"] = Status::whereIn("id",["7","8"])->pluck("name","id");
        $data["roles"] = Role::pluck("name","id");


        $type = "App\Notifications\AnnouncementNotify";

        $getNotis = \DB::table("notifications")->where("type",$type)->where("notifiable_id",Auth::user()->id)->pluck("id");


        foreach ($getNotis as $getNoti) {
            \DB::table("notifications")->where("id", $getNoti)->update(["read_at" => now()]);;
        }
        
        

        return view("announcements.index",$data);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this -> validate(request(),[
            "image" => "image|mimes:jpg,jpeg,png,jpg.webp|max:3072",
            "title" => "required",
            "message" => "required",
            "post_id" => "required",
            "role_id" => "required"
        ]);

        $announcement = new Announcement();
        $announcement->title = $request["title"];
        $announcement->message = $request["message"];
        $announcement->post_id = $request["post_id"];
        $announcement->role_id = $request["role_id"];
        $announcement->user_id = Auth::user()->id;

        if(file_exists($request["image"])){

            $file = $request->file("image");
        
            $fname = $file->getClientOriginalName();
        
            $newfilename = uniqid().time().$fname;
        
            $file -> move(public_path("assets/imgs/announcements/"),$newfilename);
        
            $filepath = "assets/imgs/announcements/".$newfilename;
        
            $announcement -> image = $filepath;
        }

        $announcement -> save();

        $data = [
            "id"=> $announcement->id,
            "title" => $announcement -> title,
            "message" => $announcement -> message,
        ]; 

        $users = User::where("role_id",$announcement->role_id)->get();

        Notification::send($users,new AnnouncementNotify($data));

        session()->flash("success","Announcement Insert Successful");
        
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
        $this -> validate($request,[
            "image" => "image|mimes:jpg,jpeg,png,jpg.webp|max:3072",
            "title" => "required",
            "message" => "required",
            "post_id" => "required",
            "role_id" => "required"
        ]);
        
        
        $announcement = Announcement::findOrFail($id);
        
        $file = $announcement->image;
    
        // dd($post);

        $userId = Auth::user()->id;

        $announcement->title = $request["title"];
        $announcement->message = $request["message"];
        $announcement->post_id = $request["post_id"];
        $announcement->role_id = $request["role_id"];
        $announcement->user_id = Auth::user()->id;
        $announcement->status_id = $request["status_id"];
        
        
        if(file_exists($request["image"])){


            if(File::exists($file)){
                File::delete($file);
            }
            

            $file = $request->file("image");
        
            $fname = $file->getClientOriginalName();
        
            $newfilename = uniqid().time().$fname;
        
            $file -> move(public_path("assets/imgs/announcements/"),$newfilename);
        
            $filepath = "assets/imgs/announcements/".$newfilename;
        
            $announcement -> image = $filepath;
        }
        
        $announcement -> save();
        
        session()->flash("success","Data Update Successful");
        
        return redirect()->back();
    }


    public function destroy(string $id)
    {
        $announcement = Announcement::findOrFail($id);

        $file = $announcement->image;

        if(File::exists($file)){
            File::delete($file);
        }


        $announcement->delete();
        
        session()->flash("success","Announcement Delete Successful");

        return redirect()->back();
    }

    public function markednoti(){
        $type = "App\Notifications\AnnouncementNotify";

        $getNotis = \DB::table("notifications")->where("type",$type)->where("notifiable_id",Auth::user()->id)->pluck("id");


        foreach ($getNotis as $getNoti) {
            \DB::table("notifications")->where("id", $getNoti)->delete();
        }


        return redirect()->back();
    }
}
