<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $body)
    {
        $this->subject = $subject;
        $this->body = $body;
        //$this->filename = $filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.name')->with([
            'subject' => $this->subject,
            'body' => $this->body,
        ])->subject($this->subject);
//        return $this->view('email.name')->with([
//                        'subject' => $this->subject,
//                        'body' => $this->body,
//                    ])->subject($this->subject)->attach('uploads/'.$this->filename);
    }
}
