<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $invoice=array();
    public function __construct($invoice)
    {
        $this->invoice=$invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('gpsjnisi@gmail.com')
                    ->subject('Envio de Factura Digital')
                    ->view('invoice.invoiceEmail');
    }
}
