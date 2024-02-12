<?php

namespace App\Livewire\Status;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

use App\Models\Status;

class Create extends Component
{
    public $name ;
    // public $statuses;
    public function save(){
        
        $this->validate([
            "name" => "required"
        ]);

        $user_id = Auth::user()->id;

        Status::create([
            "name" => $this -> name,
            "user_id" => $user_id
        ]);

        $this -> name = "";

        session()->flash("success","Create Successful");

        $statuses = Status::all();



    }

    

    public function render()
    {
        return view('livewire.status.create',[
            "statuses" => Status::all(),
        ]);
    }
}
