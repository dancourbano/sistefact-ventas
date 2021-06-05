<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeManager extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data=array();
    public $parametros=array();
    public function __construct($data,$parametros)
    {
        $this->data=$data;
        $this->parametros=$parametros;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('gpsjnisi@gmail.com')
            ->view('emails.CRUDManagerEmail');
    }
}
