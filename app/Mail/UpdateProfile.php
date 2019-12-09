<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateProfile extends Mailable
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
            if($this->data['status'] == 'del')
            {
                return $this->subject("Post Deleted")->view('email.updateprofile');
            }
            elseif($this->data['status'] == 'postup')
            {
                return $this->subject("Post Updated")->view('email.updateprofile');
            }
            elseif($this->data['status'] == 'verify')
            {
                return $this->subject("Email verified successfully!")->view('email.updateprofile');
            }            
            elseif($this->data['status'] == 'sendlink')
            {
                return $this->subject("Email Verify")->view('email.updateprofile');
            }
            else
            {
                return $this->view('email.updateprofile');
                
            }
            
        }            
        else
        {
            return $this->view('email.updateprofile');
            
        }
        
    }
}
