<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Receipts extends Mailable
{
    use Queueable, SerializesModels;
    public $receipts;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receipts)
    {
        $this->receipts = $receipts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Admin Send")->view('email.receipts');
    }
}
