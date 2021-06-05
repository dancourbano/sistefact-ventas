<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Payment extends Model {

    protected $primaryKey = 'paymentId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $table = 'payment';

    public static function getPayments(){
        $payments = DB::table('payment')
            -> select(
                'payment.*',
                'invoice.debt as debt',
                'invoice.datePayMax as datePayMax'
            )
            -> join('invoice','payment.invoiceId','=','invoice.invoiceId')
            -> get();

        return $payments;
    }

    public static function getPaymentsByInvoiceId($invoiceId){
        $payments = DB::table('payment')
            -> where('payment.invoiceId', $invoiceId)
            -> select('payment.*')
            -> get();

        return $payments;
    }

    public static function getPayment($paymentId){
        $payment = Payment::where('paymentId','=',$paymentId)
            -> select(
                'payment.*',
                'invoice.debt as debt'
            )
            -> join('invoice','payment.invoiceId','=','invoice.invoiceId')
            -> first();

        return $payment->toArray();
    }

    public static function createPayment($paymentBEntity){
        $paymentId = DB::table('payment')->insertGetId(
            array(
                'paymethod' => $paymentBEntity -> getPaymethod(),
                'quantity' => $paymentBEntity -> getQuantity(),
                'invoiceId'=> $paymentBEntity -> getInvoiceId(),
                'paymentName'=> $paymentBEntity -> getPaymentName(),
                'createdDate'=> $paymentBEntity -> getAuditoryInformation()->getCreatedDate(),
                'createdBy'=>$paymentBEntity -> getAuditoryInformation()->getCreatedBy(),
                'observation' =>$paymentBEntity -> getObservation()
            )
        );

        return $paymentId;
    }

    public static function updatePayment($paymentBEntity){
        DB::table('payment')
            ->where('paymentId',$paymentBEntity->getPaymentId())
            ->update(
                array(
                    'paymethod' => $paymentBEntity -> getPaymethod(),
                    'quantity' => $paymentBEntity -> getQuantity(),
                    'invoiceId'=> $paymentBEntity -> getInvoiceId(),
                    'paymentName'=> $paymentBEntity -> getPaymentName(),
                    'observation'=> $paymentBEntity -> getObservation(),
                    'modifiedDate'=>$paymentBEntity->getAuditoryInformation()->getCreatedDate(),
                    'modifiedBy'=>$paymentBEntity->getAuditoryInformation()->getModifiedBy()
                )
            );
    }

    public static function deletePayment($paymentId){
        DB::table('payment')
            ->where('paymentId', $paymentId)
            ->delete();
    }

}