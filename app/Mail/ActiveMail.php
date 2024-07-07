<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActiveMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data     =   $data;
    }

    public function build()
    {
        return $this->subject('Kích hoạt tài khoản tại website')
                    ->view('mail.active', [
                        'data'      => $this->data
                    ]);
    }
}
