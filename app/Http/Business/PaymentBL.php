<?php

namespace App\Http\Business;
use \App\Http\Model\Payment;
use \App\Http\Model\Invoice;
use \App\Http\Model\Movement;
use \App\Http\Entities;
use App\Http\Entities\MovementBusinessEntity;
use DB;
use App\Http\Entities\ApplicationMessage;
use Illuminate\Support\Facades\Auth;


class PaymentBL {
    public function all()
    {
        $paymentBE = Payment::getPayments();
        return  $paymentBE;
    }

    public function getPaymentsByInvoiceId($invoiceId)
    {
        $payments = Payment::getPaymentsByInvoiceId($invoiceId);
        return $payments;
    }

    public function getPayment($paymentId)
    {
        $payment = Payment::getPayment($paymentId);
        return (array)$payment;
    }

    public function createPayment($paymentBEntity)
    {
        $paymentBEntity -> getAuditoryInformation()
            ->setCreatedDate(date("Y-m-d H:i:s"));
        $paymentBEntity->getAuditoryInformation()->setCreatedBy(Auth::user()->id);
        try {
            DB::beginTransaction();                                     // Init transaction

            $paymentId = Payment::createPayment($paymentBEntity);       // Create payment

            Invoice::makePaymentInvoice(                                // For updating the new debt on the invoice
                $paymentBEntity -> getInvoiceId(),
                $paymentBEntity -> getQuantity()
            );

            // Creation of the new movement (revenue) belonging to the the payment

            $movementBEntity = new MovementBusinessEntity();
                $movementBEntity -> setQuantity($paymentBEntity -> getQuantity());
                $movementBEntity -> setType(1);
                $movementBEntity -> setDescription("");
                $movementBEntity -> setConcept("Pago correspondiente a la factura " .  $paymentBEntity -> getInvoiceId());
                $movementBEntity -> setSender($paymentBEntity -> getPaymentName());
                $movementBEntity -> setComprobanteNumber( $paymentBEntity -> getInvoiceId() );
                $movementBEntity -> setPaymentId($paymentId);

            $movementBL = new MovementBL();
            $movementBL -> createMovement($movementBEntity);


            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Creación correcta.');

            return $paymentId;

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function updatePayment($paymentBEntity, $oldQuantity)
    {
        $paymentBEntity->getAuditoryInformation()
            ->setModifiedDate(date("Y-m-d H:i:s"));
        $paymentBEntity->getAuditoryInformation()->setModifiedBy(Auth::user()->id);
        try {
            DB::beginTransaction();                             // Init transaction
            Payment::updatePayment($paymentBEntity);            // Update payment

            Invoice::makePaymentInvoice(                        // For updating the new debt on the invoice
                $paymentBEntity -> getInvoiceId(),
                ($paymentBEntity -> getQuantity()) - $oldQuantity
            );

            // Update the movement belonging to the payment

                $movementBEntity = new MovementBusinessEntity();
                $movementBEntity->getAuditoryInformation()->setModifiedDate(date("Y-m-d H:i:s"));
                $movementBEntity->getAuditoryInformation()->setModifiedBy(Auth::user()->id);
                $movementBEntity->setQuantity($paymentBEntity->getQuantity());
                $movementBEntity->setPaymentId($paymentBEntity->getPaymentId());

                Movement::updateMovementQuantity($movementBEntity);

            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Actualización correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function deletePayment($paymentId, $invoiceId, $quantity)
    {
        try {
            DB::beginTransaction();                        // Init transaction
            Payment::deletePayment($paymentId);            // Delete payment

            Invoice::makePaymentInvoice(                   // For updating the new debt on the invoice
                $invoiceId,
                -1 * $quantity
            );

            Movement::deleteMovementByPaymentId($paymentId);

            DB::commit();                                  // Confirm operation

            ApplicationMessage::setMessageDetail('Eliminación correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }
    public function existPayment($invoiceId){

        try{
            $count = Payment::where('invoiceid', '=', $invoiceId)->count();
        }catch(Exception $e){
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
        return $count;
    }
}