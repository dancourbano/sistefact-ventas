<?php

namespace App\Console\Commands;
use App\Http\Business;
use App\Http\Entities;

use Illuminate\Console\Command;

class DelayedPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delayedPayment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $invoiceBL = new Business\InvoiceBL();

        // (1) get all the invoices

        $invoices= $invoiceBL->all();

        // (2) for each invoice if debt > 0

        foreach ($invoices as $invoice) {
            if( $invoice -> debt > 0 ){

                // (2.1) get the datePayMax from the invoice, and format it
                $invoiceDate = new \DateTime( $invoice -> datePayMax );
                $invoiceDate = $invoiceDate -> format('Y-m-d');

                // (2.2) get the first date for the delayedPaymentDate = datePayMax + 6 days
                $delayedPaymentDate = date('Y-m-d',strtotime('+6 days', strtotime($invoiceDate)));
                $today = date('Y-m-d');

                // (2.3) compare if today >= datePayMax + 6 days
                if( $today >= $delayedPaymentDate ){

                    // Manage : create if delayedPaymentDetailInvoiceId is NULL else add it +1

                    $DetailInvoiceBEntity = new Entities\DetailInvoiceBusinessEntity();
                    $DetailInvoiceBEntity -> setQuantity(1);
                    $DetailInvoiceBEntity -> setInvoiceId( $invoice -> invoiceId );

                    $DetailInvoiceBEntity -> setDescription( 'Mora de pago de fecha ' . $delayedPaymentDate . ' hasta ' . $today );

                    if( $invoice -> delayedPaymentDetailInvoiceId == NULL ){
                        $DetailInvoiceBEntity -> setPrice(1);
                        $detailInvoiceId = $invoiceBL -> createDetailInvoice($DetailInvoiceBEntity);
                        $invoiceBL -> setDelayedPaymentId($invoice -> invoiceId,$detailInvoiceId );
                    } else {
                        $delayedPaymentDetailInvoiceData = $invoiceBL -> getDetailInvoiceById( $invoice -> delayedPaymentDetailInvoiceId );
                        $DetailInvoiceBEntity -> setDetailInvoiceId($delayedPaymentDetailInvoiceData -> detailinvoiceId);
                        $DetailInvoiceBEntity -> setPrice(((float)$delayedPaymentDetailInvoiceData -> price )+ 1);
                        $invoiceBL -> updateDetailInvoice($DetailInvoiceBEntity);
                    }
                }
                $invoiceBL -> reCalculateInvoice($invoice -> invoiceId);
            }
        }

        $this->info('done successfully!');


    }
}
