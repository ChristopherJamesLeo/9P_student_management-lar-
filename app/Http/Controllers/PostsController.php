<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Enroll;
use App\Models\Status;
use App\Models\Tag;
use App\Models\Type;
use App\Models\Day;
use App\Models\Dayable;

class PostsController extends Controller
{

    public function index()
    {
        $data['posts'] = Post::filter()->searchonly()->paginate(4);

        $data["filterRoles"] = Post::orderBy("updated_at","desc")->get();
        
        return view("posts.index",$data);
    }


    public function create()
    {
        $data["days"] = Day::where("status_id",3)->get();
        $data["types"] = Type::where("status_id",3)->pluck("name","id");
        $data["tags"] = Tag::where("status_id",3)->pluck("name","id");
        $data["atts"] = Status::whereIn("id",["1","2"])->pluck("name","id");
        $data["statuses"] = Status::whereIn("id",["7","8","11"])->pluck("name","id");
        $data["gettoday"] = Carbon::today()->format("Y-m-d");
        return view("posts.create",$data);
    }


    public function store(Request $request)
    {
        // dd($request["image"]);
        $this -> validate($request,[
            "image" => "image|mimes:jpg,jpeg,png|max:3072",
            "name" => "required|unique:posts,name",
            "passcode" => "required|unique:posts,passcode",
            "startdate" => "required",
            "enddate" => "required",
            "starttime" => "required",
            "endtime" => "required",
            "tag_id" => "required",
        ]);

        $userId = Auth::user()->id;
        $post = new Post();
        $post -> name = $request["name"];
        $post -> passcode = $request["passcode"];
        $post -> startdate = $request["startdate"];
        $post -> enddate = $request["enddate"];
        $post -> starttime = $request["starttime"];
        $post -> endtime = $request["endtime"];
        $post -> fee = $request["fee"];
        $post -> content = $request["content"];
        $post -> slug = Str::slug($request["name"]);
        $post -> tag_id = $request["tag_id"];
        $post -> type_id = $request["type_id"];
        $post -> attshow = $request["attshow"];
        $post -> status_id = $request["status_id"];
        $post -> user_id = $userId;

        // dd($request["image"]);

        if(file_exists($request["image"])){

            // dd("true");

            $file = $request->file("image");

            $fname = $file->getClientOriginalName();

            $newfilename = uniqid().time().$fname;

            $file -> move(public_path("assets/imgs/posts/"),$newfilename);

            $filepath = "assets/imgs/posts/".$newfilename;

            $post -> image = $filepath;
        }

        $post -> save();


        if($post->id){
            if($request["days"] > 0){
                // dd($request["dayable_type"]);
                for($i = 0 ; $i < count($request["days"]) ; $i++){
                    Dayable::create([
                        "day_id" => $request["days"][$i],
                        "dayable_id" => $post->id,
                        "dayable_type" => $request["dayable_type"]
                    ]);
                }
            }
        }

        session()->flash("success","Data Insert Successful");

        return redirect()->route("posts.index");

    }


    public function show(string $slug)
    {
        // $data["post"] = Post::findOrFail($id); 

        $data["post"] = Post::where("slug",$slug)->firstOrFail();

        $id = $data["post"]->id;

        // dd($id);

        $data["days"] = Day::where("status_id",3)->get();

        $data["types"] = Type::where("status_id",3)->pluck("name","id");

        $data["tags"] = Tag::where("status_id",3)->pluck("name","id");

        $data["atts"] = Status::whereIn("id",["1","2"])->pluck("name","id");

        $data["statuses"] = Status::whereIn("id",["7","8","11"])->pluck("name","id");

        $data["gettoday"] = Carbon::today()->format("Y-m-d");

        $data["enrolls"] = Enroll::where("post_id",$id)->orderBy("updated_at","desc")->get();

        return view("posts.show",$data);
    }


    public function edit(string $slug)
    {
        $data["post"] = Post::where("slug",$slug)->firstOrFail();

        $id = $data["post"]->id;
        
        $data["days"] = Day::where("status_id",3)->get();

        $data["dayables"] = $data["post"]->days()->get();

        $data["types"] = Type::where("status_id",3)->pluck("name","id");

        $data["tags"] = Tag::where("status_id",3)->pluck("name","id");

        $data["atts"] = Status::whereIn("id",["1","2"])->pluck("name","id");

        $data["statuses"] = Status::whereIn("id",["7","8","11"])->pluck("name","id");

        $data["gettoday"] = Carbon::today()->format("Y-m-d");

        return view("posts.edit",$data);
    }


    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            "image" => "required|image|mimes:jpg,jpeg,png,jpg.webp|max:3072",
            "name" => "required|unique:posts,name,".$id,
            "passcode" => "required|unique:posts,passcode,".$id,
            "startdate" => "required",
            "enddate" => "required",
            "starttime" => "required",
            "endtime" => "required",
            "tag_id" => "required",
        ]);
        
        
        $post = Post::findOrFail($id);

        // dd($post);
        $file = $post->image;
        
        $userId = Auth::user()->id;

        $post -> name = $request["name"];
        $post -> passcode = $request["passcode"];
        $post -> startdate = $request["startdate"];
        $post -> enddate = $request["enddate"];
        $post -> starttime = $request["starttime"];
        $post -> endtime = $request["endtime"];
        $post -> fee = $request["fee"];
        $post -> content = $request["content"];
        $post -> slug = Str::slug($request["name"]);
        $post -> tag_id = $request["tag_id"];
        $post -> type_id = $request["type_id"];
        $post -> attshow = $request["attshow"];
        $post -> status_id = $request["status_id"];
        $post -> user_id = $userId;
        
                // dd($request["image"]);
        
        if(file_exists($request["image"])){


    
            if(File::exists($file)){
                File::delete($file);
            }

            $file = $request->file("image");
        
            $fname = $file->getClientOriginalName();
        
            $newfilename = uniqid().time().$fname;
        
            $file -> move(public_path("assets/imgs/posts/"),$newfilename);
        
            $filepath = "assets/imgs/posts/".$newfilename;
        
            $post -> image = $filepath;
        }
        
        $post -> save();

        $days = Dayable::where("dayable_type",request("dayable_type"))->where("dayable_id",$post->id)->delete();
        
        
        if($post->id){
            if($request["days"] > 0){
                // dd($request["dayable_type"]);
                for($i = 0 ; $i < count($request["days"]) ; $i++){
                    Dayable::create([
                        "day_id" => $request["days"][$i],
                        "dayable_id" => $post->id,
                        "dayable_type" => $request["dayable_type"]
                    ]);
                }
            }
        }
        
        session()->flash("success","Data Update Successful");
        
        return redirect()->route("posts.show",$id);
    }


    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        $file = $post->image;

        if(File::exists($file)){
            File::delete($file);
        }

        $days = Dayable::where("dayable_type",request("dayable_type"))->where("dayable_id",$post->id)->delete();

        $comments = Comment::where("commentable_id",$post->id)->where("commentable_type","App\Models\Post")->delete();

        $post->delete();
        
        session()->flash("success","Post Delete Successful");

        return redirect()->route("posts.index");
    }


}
