<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        if(!empty($this->data['status']))
        {
            if($this->data['status'] == 're_contact')
            {
                return $this->subject("Request Contact")->view('email.replyemail');
            }
            elseif($this->data['status'] == 'communication')
            {
               
                return $this->subject("You received message!")->view('email.communication');
            }
        }
        else
        {
            return $this->view('email.replyemail');
        }        
    }
}
