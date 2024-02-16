<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnrollMailBox extends Mailable 
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this -> data = $data;

        // dd($this -> data["subject"]);
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->data["stage"] ." for ". $this -> data["subject"],
        );
    }


    public function content(): Content
    {
        if($this->data["stage_id"] == 1){
            return new Content(
                view: 'mailtemplate.enrollapprove',
            );
        }elseif($this->data["stage_id"] == 3){
            return new Content(
                view: 'mailtemplate.enrollreject',
            );
        }

        
    }


    public function attachments(): array
    {
        return [];
    }
}
