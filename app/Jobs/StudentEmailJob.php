<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\StudentEmailBox;


class StudentEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data ;
    public function __construct($data)
    {
        $this -> data = $data;

        // dd($this -> data);
    }


    public function handle(): void
    {
        Mail::to($this -> data["to"])->cc("admin@gmail.com")->send(new StudentEmailBox($this -> data));
    }
}
