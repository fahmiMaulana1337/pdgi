<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    private $data=[];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *ai
     * @return $this
     */
    public function build()
    {
        // return $this->from('fird4andriani@gmail.com','Firda Andriani')
        // ->subject($this->data['subject'])
        // ->view('emails.index')->with('data',$this->data);

        return $this->subject("Surat Masuk")
        ->view('emails.index');
    }
}
