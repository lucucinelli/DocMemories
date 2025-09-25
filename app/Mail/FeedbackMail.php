<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $data;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $data)
    {
        $this->user = $user;
        $this->data = $data;
    }


    public function build()
    {
        return $this->subject('Nuovo feedback ricevuto')
                    ->view('emails.form-feedback')
                    ->with('user', $this->user)
                    ->with('data', $this->data);
    }
}
