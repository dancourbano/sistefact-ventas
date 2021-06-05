<?php

namespace App\Console\Commands;

use App\Http\Business\CustomerBL;
use App\Http\Business\InvoiceBL;
use App\Mail\Invoice;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
class GenerateInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:generateInvoice';

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
        $invoices = \App\Http\Model\Invoice::where('repeatInvoice',2)->get();

        foreach ($invoices as $invoice) {
            $datetimeDB = new \DateTime($invoice["createdDate"]);
            $daysDB = $datetimeDB->format('d');
            $datetime = new \DateTime();
            $days = $datetime->format('d');
            $invoiceBL=new InvoiceBL();
            $detailInvoices=$invoiceBL->getDetailInvoice($invoice['invoiceId']);

            if ($daysDB == $days) {

                $id = DB::table('invoice')->insertGetId(
                    array(
                        'taxType' => $invoice["taxType"],
                        'tax' => $invoice["tax"],
                        'disccountValue' => $invoice["disccountValue"],
                        'subtotal' => $invoice["subtotal"],
                        'datePayMax' => $invoice["datePayMax"],
                        'status' => "0",
                        'disccountType' => $invoice["disccountType"],
                        'total' => $invoice["total"],
                        'is_sendEmail' => $invoice["is_sendEmail"],
                        'repeatInvoice' => $invoice["repeatInvoice"],
                        'notes' => $invoice["notes"],
                        'debt' => $invoice["total"],
                        'customerId' => $invoice["customerId"],
                        'delayedPaymentDetailInvoiceId' => $invoice["delayedPaymentDetailInvoiceId"],
                        'methodpayment' => $invoice["methodpayment"],
                        'createdDate' => $datetime->format('Y-m-d H:i:s'),
                        'createdBy' => "0"
                    )
                );
                foreach($detailInvoices as $detailInvoice){
                    $idDetail = DB::table('detailinvoice') -> insertGetId(
                        array(
                            'price' => $detailInvoice->price,
                            'status' => $detailInvoice->status,
                            'quantity' => $detailInvoice->quantity,
                            'description' => $detailInvoice->description,
                            'invoiceId' => $id,
                            'packageId' => $detailInvoice->packageId,
                            'itemId' => $detailInvoice->itemId,
                            'vehicleId' => $detailInvoice->vehicleId
                        )
                    );
                }
                if($invoice['is_sendEmail']==1){
                    $invoiceBL=new InvoiceBL();
                    $invoiceNew=$invoiceBL->getInvoiceAndDetail($id);
                    $customerBL=new CustomerBL();
                    $customer=$customerBL->getCustomer($invoiceNew['invoice']->customerId);

                    $nombre=$customer['name']." ".$customer['lastName'];
                    $email=$customer['email'];

                    if($email!=null){
                        Mail::to($email,$nombre)
                            ->send(new Invoice($invoiceNew));
                    }

                }

            }

        }
    }
}
