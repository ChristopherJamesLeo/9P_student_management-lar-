<?php

namespace App\Livewire\Post;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Post;


class Comment extends Component
{

    public $description ;

    public $post_id;

    public $comments;

    public function mount($post_id){
        $this -> post_id = $post_id;
    }

    public function addcomment(){

        $userId = Auth::user()->id;
        $commentable_type = "App\Models\Post";
        $this -> description;

        \DB::table("comments")->insert([
            "description" => $this->description,
            "user_id" => $userId,
            "commentable_id" => $this->post_id,
            "commentable_type" => $commentable_type,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        $this->description = "";

        // $post = \DB::table("comments")->where("commentable_id",$this->post_id)->where("commentable_type","App\Models\Post")->get();

        $post = Post::findOrFail($this->post_id);

        $this->comments = $post->comments()->orderBy("created_at","desc")->get();

        // dd($this->comments);

        session()->flash("success","Comment Successful");

        return redirect()->back()->with('success', 'Comment added successfully');
    }
    public function render()
    {
        $post = Post::findOrFail($this->post_id);

        $this->comments = $post->comments()->orderBy("created_at","desc")->get();

        return view('livewire.post.comment' , [
            'comments' => $this->comments,
        ]);
    }
}
