<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:06
 */


namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Invoice extends Model {

    protected $primaryKey = 'invoiceId';
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */


    protected $table    = 'invoice';

    public static function getInvoicesAndPlaca(){
        $sql= DB::select("SELECT invoice.* ,
                                detailinvoice.vehicleId,
                                vehicle.placa,
                                customer.name as customerName,
                                customer.identification as customerIdentification,
                                customer.address as customerAddress,
                                customer.phone1 as customerPhone1,
                                customer.phone2 as customerPhone2,
                                customer.email as customerEmail,
                                customer.city as customerCity,
                                customer.lastName as customerLastName
                        FROM sistefact.invoice
                        LEFT JOIN detailinvoice ON invoice.invoiceId=detailinvoice.invoiceId AND detailinvoice.vehicleId>0
                        LEFT JOIN vehicle ON vehicle.vehicleId=detailinvoice.vehicleId
                        LEFT JOIN customer ON customer.customerId=invoice.customerId
                        GROUP BY invoice.invoiceId" );
        return $sql;
    }

    public static function createInvoice($invoiceBEntity){
        $id=DB::table('invoice')->insertGetId(
            array(
                'taxType' =>$invoiceBEntity->getTaxType() ,
                'tax'=> $invoiceBEntity->getTax(),
                'disccountValue'=>$invoiceBEntity->getDisccountValue(),
                'subtotal'=>$invoiceBEntity->getSubtotal(),
                'datePayMax'=>$invoiceBEntity->getDatePayMax(),
                'status'=>$invoiceBEntity->getStatus(),
                'disccountType'=>$invoiceBEntity->getDisccountType(),
                'total'=>$invoiceBEntity->getTotal(),
                'is_sendEmail'=>$invoiceBEntity->getIsSendEmail(),
                'repeatinvoice'=>$invoiceBEntity->getRepeatInvoice(),
                'notes'=>$invoiceBEntity->GetNotes(),
                'debt'=>$invoiceBEntity->getDebt(),
                'customerId'=>$invoiceBEntity->getCustomerId(),
                'delayedPaymentDetailInvoiceId'=>$invoiceBEntity->getDelayedPaymentDetailInvoiceId(),
                'methodpayment'=> $invoiceBEntity->getMethodPayment(),
                'createdDate'=>$invoiceBEntity->getAuditoryInformation()->getCreatedDate(),
                'createdBy'=>$invoiceBEntity->getAuditoryInformation()->getCreatedBy()
            )
        );
        return $id;
    }

    public static function makePaymentInvoice($invoiceId,$quantity){
        DB::table('invoice')
            -> where('invoice.invoiceId',$invoiceId)
            -> decrement('invoice.debt', $quantity);

        $invoice = Invoice::find( $invoiceId );
        if ($invoice -> debt == 0){
            $invoice -> status = 1;
        } else {
            $invoice -> status = 0;
        }

        $invoice -> save();
    }

    public static function reCalculateInvoice($invoiceId){

        $total = DB::table('detailinvoice')
            -> select(DB::raw('sum(price * quantity) as total'))
            -> where('invoiceId',$invoiceId)
            -> first();
        $total = $total->total;

        $payments = DB::table('payment')
            -> select(DB::raw('sum(quantity) as quantity'))
            -> where('invoiceId',$invoiceId)
            -> first();
        $payments = $payments->quantity;

        $tax = $total * 0.18;
        $tax = round($tax, 2);
        $subtotal = $total - $tax;

        $invoice = Invoice::find( $invoiceId );
        $invoice -> total = $total;
        $invoice -> subtotal = $subtotal;
        $invoice -> tax = $tax;
        $invoice -> debt = $total - $payments;

        $invoice -> save();
    }

    public static function createDetailInvoice($detailInvoiceBEntity){
        $id = DB::table('detailinvoice') -> insertGetId(
            array(
                'price' => $detailInvoiceBEntity->getPrice(),
                'status' => $detailInvoiceBEntity->getStatus(),
                'quantity' => $detailInvoiceBEntity->getQuantity(),
                'description' => $detailInvoiceBEntity->getDescription(),
                'invoiceId' => $detailInvoiceBEntity->getInvoiceId(),
                'packageId' => $detailInvoiceBEntity->getPackageId(),
                'itemId' => $detailInvoiceBEntity->getItemId(),
                'vehicleId' => $detailInvoiceBEntity->getVehicleId()
            )
        );
        return $id;
    }

    public static function updateDetailInvoice($detailInvoiceBEntity){

        DB::table('detailinvoice')
            ->where('detailinvoiceId',$detailInvoiceBEntity -> getDetailInvoiceId())
            ->update(
                array(
                    'price' => $detailInvoiceBEntity->getPrice(),
                    'status' => $detailInvoiceBEntity->getStatus(),
                    'quantity' => $detailInvoiceBEntity->getQuantity(),
                    'description' => $detailInvoiceBEntity->getDescription(),
                    'invoiceId' => $detailInvoiceBEntity->getInvoiceId()
                )
            );
    }

    public static function filterInvoice($valuesFilter){

        $startEmission='';
        $endEmission='';
        $startPayment='';
        $endPayment='';
        $status='';
        $debt='';
        $debtValue=0.00;
        $sql=array();
        if($valuesFilter == null)
            return;

        //obtenemos los valores de las variables startEmission y endEmission
        if(array_key_exists('startEmission', $valuesFilter)&&array_key_exists('endEmission', $valuesFilter)){
            $startEmission=$valuesFilter['startEmission'];
            $endEmission=$valuesFilter['endEmission'];
        }

        if(array_key_exists('startPayment', $valuesFilter)&&array_key_exists('endPayment', $valuesFilter)){
            $startPayment=$valuesFilter['startPayment'];
            $endPayment=$valuesFilter['endPayment'];
        }
        if(array_key_exists('status', $valuesFilter)){
            $status=$valuesFilter['status'];
        }
        if(array_key_exists('debt', $valuesFilter)){
            $debt=$valuesFilter['debt'];
        }





        if($status==''&&$debt==''){//status y debt no seleccionados
            $sql= DB::select("SELECT invoice.* ,
                                detailinvoice.vehicleId,
                                vehicle.placa,
                                customer.name as customerName,
                                customer.identification as customerIdentification,
                                customer.address as customerAddress,
                                customer.phone1 as customerPhone1,
                                customer.phone2 as customerPhone2,
                                customer.email as customerEmail,
                                customer.city as customerCity,
                                customer.lastName as customerLastName
                        FROM sistefact.invoice
                        LEFT JOIN detailinvoice ON invoice.invoiceId=detailinvoice.invoiceId AND detailinvoice.vehicleId>0
                        LEFT JOIN vehicle ON vehicle.vehicleId=detailinvoice.vehicleId
                        LEFT JOIN customer ON customer.customerId=invoice.customerId
                        WHERE (DATE_FORMAT(invoice.createdDate,'%Y-%m-%d') BETWEEN '".$startEmission."' AND '".$endEmission."') AND
                        (DATE_FORMAT(invoice.datePayMax,'%Y-%m-%d') BETWEEN '".$startPayment."' AND '".$endPayment."')
                        GROUP BY invoice.invoiceId" );
        }
        if($status!=''&&$debt==''){//status seleccionado y debt no
            $sql= DB::select("SELECT invoice.* ,
                                detailinvoice.vehicleId,
                                vehicle.placa,
                                customer.name as customerName,
                                customer.identification as customerIdentification,
                                customer.address as customerAddress,
                                customer.phone1 as customerPhone1,
                                customer.phone2 as customerPhone2,
                                customer.email as customerEmail,
                                customer.city as customerCity,
                                customer.lastName as customerLastName
                        FROM sistefact.invoice
                        LEFT JOIN detailinvoice ON invoice.invoiceId=detailinvoice.invoiceId AND detailinvoice.vehicleId>0
                        LEFT JOIN vehicle ON vehicle.vehicleId=detailinvoice.vehicleId
                        LEFT JOIN customer ON customer.customerId=invoice.customerId
                        WHERE (DATE_FORMAT(invoice.createdDate,'%Y-%m-%d') BETWEEN '".$startEmission."' AND '".$endEmission."') AND
                        (DATE_FORMAT(invoice.datePayMax,'%Y-%m-%d') BETWEEN '".$startPayment."' AND '".$endPayment."') AND
                        (invoice.status=".$status.")
                        GROUP BY invoice.invoiceId" );
        }
        if($status==''&&$debt!=''){//status no seleccionado y debt si
            if($debt=='0'){
                $sql= DB::select("SELECT invoice.* ,
                                detailinvoice.vehicleId,
                                vehicle.placa,
                                customer.name as customerName,
                                customer.identification as customerIdentification,
                                customer.address as customerAddress,
                                customer.phone1 as customerPhone1,
                                customer.phone2 as customerPhone2,
                                customer.email as customerEmail,
                                customer.city as customerCity,
                                customer.lastName as customerLastName
                        FROM sistefact.invoice
                        LEFT JOIN detailinvoice ON invoice.invoiceId=detailinvoice.invoiceId AND detailinvoice.vehicleId>0
                        LEFT JOIN vehicle ON vehicle.vehicleId=detailinvoice.vehicleId
                        LEFT JOIN customer ON customer.customerId=invoice.customerId
                        WHERE (DATE_FORMAT(invoice.createdDate,'%Y-%m-%d') BETWEEN '".$startEmission."' AND '".$endEmission."') AND
                        (DATE_FORMAT(invoice.datePayMax,'%Y-%m-%d') BETWEEN '".$startPayment."' AND '".$endPayment."') AND
                        (invoice.debt=".$debtValue.")
                        GROUP BY invoice.invoiceId" );
            }else{
                $sql= DB::select("SELECT invoice.* ,
                                detailinvoice.vehicleId,
                                vehicle.placa,
                                customer.name as customerName,
                                customer.identification as customerIdentification,
                                customer.address as customerAddress,
                                customer.phone1 as customerPhone1,
                                customer.phone2 as customerPhone2,
                                customer.email as customerEmail,
                                customer.city as customerCity,
                                customer.lastName as customerLastName
                        FROM sistefact.invoice
                        LEFT JOIN detailinvoice ON invoice.invoiceId=detailinvoice.invoiceId AND detailinvoice.vehicleId>0
                        LEFT JOIN vehicle ON vehicle.vehicleId=detailinvoice.vehicleId
                        LEFT JOIN customer ON customer.customerId=invoice.customerId
                        WHERE (DATE_FORMAT(invoice.createdDate,'%Y-%m-%d') BETWEEN '".$startEmission."' AND '".$endEmission."') AND
                        (DATE_FORMAT(invoice.datePayMax,'%Y-%m-%d') BETWEEN '".$startPayment."' AND '".$endPayment."') AND
                        (invoice.debt > ".$debtValue.")
                        GROUP BY invoice.invoiceId" );
            }

        }
        if($status!=''&&$debt!=''){//status y debt seleccionados
            if($debt=='0'){

                $sql= DB::select("SELECT invoice.* ,
                                detailinvoice.vehicleId,
                                vehicle.placa,
                                customer.name as customerName,
                                customer.identification as customerIdentification,
                                customer.address as customerAddress,
                                customer.phone1 as customerPhone1,
                                customer.phone2 as customerPhone2,
                                customer.email as customerEmail,
                                customer.city as customerCity,
                                customer.lastName as customerLastName
                        FROM sistefact.invoice
                        LEFT JOIN detailinvoice ON invoice.invoiceId=detailinvoice.invoiceId AND detailinvoice.vehicleId>0
                        LEFT JOIN vehicle ON vehicle.vehicleId=detailinvoice.vehicleId
                        LEFT JOIN customer ON customer.customerId=invoice.customerId
                        WHERE (DATE_FORMAT(invoice.createdDate,'%Y-%m-%d') BETWEEN '".$startEmission."' AND '".$endEmission."') AND
                        (DATE_FORMAT(invoice.datePayMax,'%Y-%m-%d') BETWEEN '".$startPayment."' AND '".$endPayment."') AND
                        (invoice.status = ".$status.") AND
                        (invoice.debt = ".$debtValue.")
                        GROUP BY invoice.invoiceId" );
            }else{
                $sql= DB::select("SELECT invoice.* ,
                                detailinvoice.vehicleId,
                                vehicle.placa,
                                customer.name as customerName,
                                customer.identification as customerIdentification,
                                customer.address as customerAddress,
                                customer.phone1 as customerPhone1,
                                customer.phone2 as customerPhone2,
                                customer.email as customerEmail,
                                customer.city as customerCity,
                                customer.lastName as customerLastName
                        FROM sistefact.invoice
                        LEFT JOIN detailinvoice ON invoice.invoiceId=detailinvoice.invoiceId AND detailinvoice.vehicleId>0
                        LEFT JOIN vehicle ON vehicle.vehicleId=detailinvoice.vehicleId
                        LEFT JOIN customer ON customer.customerId=invoice.customerId
                        WHERE (DATE_FORMAT(invoice.createdDate,'%Y-%m-%d') BETWEEN '".$startEmission."' AND '".$endEmission."') AND
                        (DATE_FORMAT(invoice.datePayMax,'%Y-%m-%d') BETWEEN '".$startPayment."' AND '".$endPayment."') AND
                        (invoice.status = ".$status.") AND
                        (invoice.debt > ".$debtValue.")
                        GROUP BY invoice.invoiceId" );
            }
        }

        return $sql;
    }


    public static function getInvoice(){
        $sql = DB::table('invoice')
            -> select(
                'invoice.*',
                'customer.name as customerName',
                'customer.identification as customerIdentification',
                'customer.address as customerAddress',
                'customer.phone1 as customerPhone1',
                'customer.phone2 as customerPhone2',
                'customer.email as customerEmail',
                'customer.city as customerCity',
                'customer.lastName as customerLastName')
            -> join('customer','customer.customerId','=','invoice.customerId')
            -> get();
        return $sql;
    }

    public static function getDataInvoice($invoiceId){
        $sql = DB::table('invoice')
            -> select(
                'invoice.invoiceId',
                'invoice.taxType',
                'invoice.tax',
                'invoice.disccountValue',
                'invoice.subtotal',
                'invoice.datePayMax',
                'invoice.status',
                'invoice.disccountType',
                'invoice.total',
                'invoice.is_sendEmail',
                'invoice.repeatinvoice',
                'invoice.notes',
                'invoice.debt',
                'invoice.customerId',
                'invoice.delayedPaymentDetailInvoiceId',
                'invoice.methodpayment',
                'invoice.createdDate',
                'customer.name as customerName',
                'customer.identification as customerIdentification',
                'customer.address as customerAddress',
                'customer.phone1 as customerPhone1',
                'customer.phone2 as customerPhone2',
                'customer.email as customerEmail',
                'customer.city as customerCity',
                'customer.lastName as customerLastName')
            -> where('invoice.invoiceId',$invoiceId)
            -> join('customer','customer.customerId','=','invoice.customerId')
            -> first();
        return $sql;
    }

    public static function getDetailInvoice($invoiceId){
        $sql = DB::table('detailinvoice')
            -> select(
                'detailinvoice.detailinvoiceId',
                'detailinvoice.price',
                'detailinvoice.status',
                'detailinvoice.quantity',
                'detailinvoice.description',
                'detailinvoice.invoiceId',
                'detailinvoice.packageId',
                'detailinvoice.itemId',
                'detailinvoice.vehicleId')
            -> where('detailinvoice.invoiceId',$invoiceId)
            -> get();

        return $sql;
    }

    public static function getDetailInvoiceById($detailInvoiceId){
        $sql = DB::table('detailinvoice')
            -> select('*')
            -> where('detailinvoice.detailInvoiceId',$detailInvoiceId)
            -> first();

        return $sql;
    }

    public static function filterProfit($valuesFilter){

        $startEmission='';
        $endEmission='';
        $data=array();
        if($valuesFilter == null)
            return;

        //obtenemos los valores de las variables startEmission y endEmission
        if(array_key_exists('startEmission', $valuesFilter)&&array_key_exists('endEmission', $valuesFilter)){
            $startEmission=$valuesFilter['startEmission'];
            $endEmission=$valuesFilter['endEmission'];
        }

        $day= DB::select("SELECT
                DATE_FORMAT(invoice.createdDate,'%y-%m-%d') as date,
                SUM(invoice.total) totalSale,
                SUM(invoice.debt) totalDebt
                FROM invoice
                WHERE DATE_FORMAT(invoice.createdDate,'%Y-%m-%d')
                BETWEEN '".$startEmission."' AND '".$endEmission."'
                GROUP BY DATE_FORMAT(invoice.createdDate,'%d')
                ORDER BY invoice.createdDate
            ");


        $month= DB::select("SELECT
            DATE_FORMAT(invoice.createdDate,'%y') as year,
            DATE_FORMAT(invoice.createdDate,'%m') as month,
            SUM(invoice.total) totalSale,
            SUM(invoice.debt) totalDebt
            FROM invoice
            WHERE DATE_FORMAT(invoice.createdDate,'%Y-%m-%d')
            BETWEEN '".$startEmission."' AND '".$endEmission."'
            GROUP BY DATE_FORMAT(invoice.createdDate,'%m'),DATE_FORMAT(invoice.createdDate,'%y') order by invoice.createdDate;
            ");


        $year= DB::select("SELECT
            DATE_FORMAT(invoice.createdDate,'%y') as year,
            SUM(invoice.total) totalSale,
            SUM(invoice.debt) totalDebt
            FROM invoice
            WHERE DATE_FORMAT(invoice.createdDate,'%Y-%m-%d')
            BETWEEN '".$startEmission."' AND '".$endEmission."'
            GROUP BY DATE_FORMAT(invoice.createdDate,'%y') order by invoice.createdDate
            ");
        $profit=DB::select("SELECT
            count(*) as totalInvoices,
            SUM(invoice.total) as totalSale,
            SUM(invoice.debt) as totalDebt
            FROM invoice
            WHERE DATE_FORMAT(invoice.createdDate,'%Y-%m-%d')
            BETWEEN '".$startEmission."' AND '".$endEmission."'
            ");

        $data=array(
            'day' => $day,
            'month'=>$month,
            'year'=>$year,
            'profit'=>$profit
        );

        return $data;
    }
    public static function filterInvoicing($valuesFilter){

        $startEmission='';
        $endEmission='';
        $customerId='';
        $status='';
        $data=array();
        if($valuesFilter == null)
            return;

        //obtenemos los valores de las variables startEmission y endEmission
        if(array_key_exists('startEmission', $valuesFilter)&&array_key_exists('endEmission', $valuesFilter)){
            $startEmission=$valuesFilter['startEmission'];
            $endEmission=$valuesFilter['endEmission'];
        }

        if(array_key_exists('customerId',$valuesFilter)){
            $customerId=$valuesFilter['customerId'];
        }

        if(array_key_exists('status',$valuesFilter)){
            $status=$valuesFilter['status'];
        }


        if($status==''){

            $sql= DB::table('detailinvoice')
                -> select(
                    'detailinvoice.quantity',
                    'detailinvoice.price',
                    'detailinvoice.status',
                    'detailinvoice.description',
                    'detailinvoice.invoiceId',
                    'detailinvoice.packageId',
                    'detailinvoice.itemId',
                    'detailinvoice.vehicleId',
                    'invoice.invoiceId',
                    'invoice.taxType',
                    'invoice.tax',
                    'invoice.disccountValue',
                    'invoice.subtotal',
                    'invoice.datePayMax',
                    'invoice.status',
                    'invoice.disccountType',
                    'invoice.total',
                    'invoice.is_sendEmail',
                    'invoice.repeatinvoice',
                    'invoice.notes',
                    'invoice.debt',
                    'invoice.customerId',
                    'invoice.delayedPaymentDetailInvoiceId',
                    'invoice.methodpayment',
                    'invoice.createdDate',
                    'customer.name as customerName',
                    'customer.identification as customerIdentification',
                    'customer.address as customerAddress',
                    'customer.phone1 as customerPhone1',
                    'customer.phone2 as customerPhone2',
                    'customer.email as customerEmail',
                    'customer.city as customerCity',
                    'customer.lastName as customerLastName')
                -> join('invoice','invoice.invoiceId','=','detailinvoice.invoiceId')
                -> join('customer','customer.customerId','=','invoice.customerId')
                -> whereBetween(DB::raw('DATE_FORMAT(invoice.createdDate,"%Y-%m-%d")'),[$startEmission,$endEmission])
                ->Where( function ($query) use ($customerId){
                    if(!empty($customerId)) {
                        $query->where('invoice.customerId','=',$customerId);
                    } else {
                        $query->whereNotNull('invoice.customerId');
                    }
                })
                -> get();

        }else{

            $sql= DB::table('detailinvoice')
                -> select(
                    'detailinvoice.detailInvoiceId',
                    'detailinvoice.quantity',
                    'detailinvoice.price',
                    'detailinvoice.status',
                    'detailinvoice.description',
                    'detailinvoice.invoiceId',
                    'detailinvoice.packageId',
                    'detailinvoice.itemId',
                    'detailinvoice.vehicleId',
                    'invoice.invoiceId',
                    'invoice.taxType',
                    'invoice.tax',
                    'invoice.disccountValue',
                    'invoice.subtotal',
                    'invoice.datePayMax',
                    'invoice.status',
                    'invoice.disccountType',
                    'invoice.total',
                    'invoice.is_sendEmail',
                    'invoice.repeatinvoice',
                    'invoice.notes',
                    'invoice.debt',
                    'invoice.customerId',
                    'invoice.delayedPaymentDetailInvoiceId',
                    'invoice.methodpayment',
                    'invoice.createdDate',
                    'customer.name as customerName',
                    'customer.identification as customerIdentification',
                    'customer.address as customerAddress',
                    'customer.phone1 as customerPhone1',
                    'customer.phone2 as customerPhone2',
                    'customer.email as customerEmail',
                    'customer.city as customerCity',
                    'customer.lastName as customerLastName')
                -> join('invoice','invoice.invoiceId','=','detailinvoice.invoiceId')
                -> join('customer','customer.customerId','=','invoice.customerId')
                -> whereBetween(DB::raw('DATE_FORMAT(invoice.createdDate,"%Y-%m-%d")'),[$startEmission,$endEmission])
                ->Where( function ($query) use ($customerId){
                    if(!empty($customerId)) {
                        $query->where('invoice.customerId','=',$customerId);
                    } else {
                        $query->whereNotNull('invoice.customerId');
                    }
                })
                ->where('invoice.status','=',$status)
                -> get();
        }
        $invoicing=DB::select("SELECT
	            SUM(detailinvoice.quantity) as quantityItems,
                COUNT(detailinvoice.packageId) quantityPackages
                FROM detailinvoice
                JOIN invoice ON invoice.invoiceId=detailinvoice.invoiceId
                 WHERE DATE_FORMAT(invoice.createdDate,'%Y-%m-%d')
                BETWEEN '".$startEmission."' AND '".$endEmission."'
            ");


        $data=array(
            'detailinvoice'=>$sql,
            'invoicing'=>$invoicing
        );
        return $data;
    }

    public static function deleteInvoice($invoiceId){
        DB::table('invoice')
            ->where('invoiceId', $invoiceId)
            ->delete();
    }
    public static function deleteDetailInvoice($invoiceId){
        DB::table('detailinvoice')
            ->where('invoiceId', $invoiceId)
            ->delete();
    }

    public static function setDelayedPaymentId($invoiceId, $delayedPaymentId){

        $invoice = Invoice::find( $invoiceId );
        $invoice -> delayedPaymentDetailInvoiceId = $delayedPaymentId;

        $invoice -> save();
    }

}