<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAcknowledgement extends Mailable
{
    use Queueable, SerializesModels;
    public $UserAcknowledgement;

    public function __construct($Acknowledgement)
    {
        $this->UserAcknowledgement = $Acknowledgement;
    }

    
    public function build()
    {
        return $this->view('emails.UserAcknowledgement');
    }
}
