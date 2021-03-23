<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $AdminMessage;

    public function __construct($AdminMessage)
    {
        $this->AdminMessage = $AdminMessage;
    }

    
    public function build()
    {
        return $this->view('emails.AdminMessage');
    }
}
