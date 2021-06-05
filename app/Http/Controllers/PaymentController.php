<?php
/**
 * User: Oscar
 * Date: 31/10/16
 * Time: 19:00 PM
 */

namespace App\Http\Controllers;
use Redirect;
use Schema;
use App\Http\Business\PaymentBL;
use App\Http\Business\InvoiceBL;
use App\Http\Entities\PaymentBusinessEntity;
use App\Http\Entities\ApplicationMessage;
use Illuminate\Http\Request;

class PaymentController extends Controller {
    public function index()
    {
        $PaymentBL = new PaymentBL();
        $payments = $PaymentBL -> all();
        return view('payment.index')
            -> with(compact('payments'));
    }

    public function getPayments($invoiceId)
    {
        $PaymentBL = new PaymentBL();
        $payments = $PaymentBL -> getPaymentsByInvoiceId($invoiceId);
        return $payments;
    }

    public function create($invoiceId)
    {
        $InvoiceBL = new InvoiceBL();
        $invoiceData = $InvoiceBL -> getInvoiceAndDetail($invoiceId);
        $debt = $invoiceData['invoice'] -> debt;
        $customer = $invoiceData['invoice'] -> customerLastName . " " . $invoiceData['invoice'] -> customerName;

        $dataPayment = array(
            'paymentId' => 0,
            'paymethod' => '',
            'quantity' => 0.00,
            'invoiceId' => $invoiceId,
            'paymentName' => $customer,
            'observation' => '',
            'debt' => $debt
        );

        $action = 'create';
        return view('payment.payment')
            -> with(compact('action','dataPayment'));
    }

    public function edit($paymentId)
    {
        $PaymentBL = new PaymentBL();
        $dataPayment = $PaymentBL -> getPayment($paymentId);
        $action = 'edit';

        return view('payment.payment')
            -> with(compact('action','dataPayment'));
    }

    public function delete($paymentId)
    {
        $PaymentBL = new PaymentBL();
        $PaymentData = $PaymentBL -> getPayment($paymentId);
        $PaymentBL -> deletePayment(
            $paymentId,
            $PaymentData['invoiceId'],
            $PaymentData['quantity']
        );
        return redirect()->action('PaymentController@index');
    }

    public function sendDataPayment($action,Request $request)
    {
        try {
            $paymentBEntity = new PaymentBusinessEntity();
            $paymentBEntity -> setAllFromDataRowHTTPBase($request->all());

            $PaymentBL = new PaymentBL();

            if ($action == "create") {
                $PaymentBL -> createPayment($paymentBEntity);
                ApplicationMessage::setMessageDetail('Pago creado correctamente.');
            }

            if ($action == "edit") {
                $oldPaymentData = $PaymentBL -> getPayment($paymentBEntity -> getPaymentId());
                $PaymentBL -> updatePayment(
                    $paymentBEntity,
                    $oldPaymentData['quantity']
                );
                ApplicationMessage::setMessageDetail('Pago editado correctamente.');
            }

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
        }
        return response()->json(ApplicationMessage::toArray());
    }

    public function existPayment($invoiceId){
        try{
            $paymentBL=new PaymentBL();
            $count=$paymentBL->existPayment($invoiceId);
        }catch(Exception $e){
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
        }
        $data=array(
            'count'=>$count
        );
        return response()->json($data);
    }
}