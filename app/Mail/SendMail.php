<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
    public $id;
    public $hashVerification;

    public function __construct($name, $subject, $id, $hashVerification)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->id = $id;
        $this->hashVerification = $hashVerification;
    }

    public function build(){
        return $this->view('email.verification')->subject($this->subject);
    }

    public function attachments(): array
    {
        return [];
    }
}
