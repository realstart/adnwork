<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminSend extends Mailable
{
    use Queueable, SerializesModels;
    public $feedback;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {      
        if($this->feedback['task_status'] == "del")
        { 
            return $this->subject("Expired your post !")->view('email.adminsend');  
        }            
        else
        {
            return $this->subject("Update on your post !")->view('email.adminsend');  
        }
    }
}
