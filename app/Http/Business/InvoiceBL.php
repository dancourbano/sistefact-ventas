<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:08
 */
namespace App\Http\Business;
use App\Http\Entities\DetailInvoiceBusinessEntity;
use App\Http\Entities\ApplicationMessage;
use App\Http\Entities\MovementBusinessEntity;
use App\Http\Entities\PackageBusinessentity;
use App\Http\Entities\PaymentBusinessEntity;
use App\Http\Model\Driver;
use App\Http\Model\Invoice;
use App\Http\Model\Item;
use App\Http\Model\DetailPackage;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use App\Http\Business\PackageBL;
use Illuminate\Support\Facades\Auth;


class InvoiceBL {
    public function all()
    {
        $invoiceBE = Invoice::getInvoice();
        return  $invoiceBE;
    }
    public function allInvoicesAndPlaca(){
        $invoiceBE=Invoice::getInvoicesAndPlaca();
        return $invoiceBE;
    }

    public function createInvoice($invoiceBEntity,$listaProductos)
    {
        //Crear factura
        $invoiceId='';
        $invoiceBEntity->getAuditoryInformation()
            ->setCreatedDate(date("Y-m-d H:i:s"));
        $invoiceBEntity->getAuditoryInformation()->setCreatedBy(Auth::user()->id);
        try {
            DB::beginTransaction();

            $invoiceId=Invoice::createInvoice($invoiceBEntity);

            DB::commit();

            $detailInvoiceBEntity = new DetailInvoiceBusinessEntity();
            // inicializamos contador i => contador de productos en el formulario

            $i = 0;

            foreach ($listaProductos as $producto) {

                $i++;

        }

            // si no hay productos mostrar mensaje de que no hay productos

            if ($i == 0) {

                return "No agrego Productos";

                ApplicationMessage::setMessageDetail(MessageStorage::$PACKPR_UPDT_OK);

            } // Si existen productos procedemos a guardarlos


            else {

                //contador que verificara cuantos productos que ya existen en la bd

                $numberProductsOnBD = 0;

                //contador que verificara cuantos productos nuevos hay formulario

                $numberNoProductsOnBD = 0;

                foreach ($listaProductos as $producto) {

                    $detailInvoiceBEntity->setAllFromDataRowHTTP($producto);
                    $detailInvoiceBEntity->setInvoiceId($invoiceId);
                    $date = date("Y-m-d H:i:s");

                    $detailInvoiceBEntity->getAuditoryInformation()
                        ->setCreatedDate($date);

                    DB::beginTransaction();

                    $confirmaBD = Invoice::createDetailInvoice($detailInvoiceBEntity);

                    //Confirmar Operación

                    DB::commit();

                    if ($confirmaBD == false) {

                        $numberProductsOnBD++;

                    } else if ($confirmaBD == true) {

                        $numberNoProductsOnBD++;
                    }

                    //descontamos la cantidad de productos

                    if($detailInvoiceBEntity->getItemId()!=0){
                        $itemBL=new ItemBL();
                        $item=$itemBL->getItem($detailInvoiceBEntity->getItemId());
                        if($item['type']==1){
                            Item::decrementProductStock($item['itemId'],$detailInvoiceBEntity->getQuantity());
                        }
                    }

                    //descontamos la cantidad de productos de un paquete si es que los contiente
                    if($detailInvoiceBEntity->getPackageId()!=0){

                        $detailPackage=DetailPackage::getDetailPackagesAndTypeFromPackage($detailInvoiceBEntity->getPackageId());
                        foreach ($detailPackage as $item) {
                            if($item['typeItem']==1){
                                Item::decrementProductStock($item['itemId'],$item['quantity']);
                            }
                        }
                    }


                }

            }

            if($invoiceBEntity->getStatus()=='1'){  // If the new invoice is registered as paid

                // Create a payment with the information from the invoice.

                // Create a payment

                $paymentBEntity = new PaymentBusinessEntity();
                $customerBL=new CustomerBL();

                    $customer=$customerBL->getCustomer($invoiceBEntity->getCustomerId());
                    $paymentBEntity->setInvoiceId($invoiceId);
                    $paymentBEntity->setPaymethod($invoiceBEntity->getMethodPayment());
                    $paymentBEntity->setQuantity($invoiceBEntity->getTotal());
                    $paymentBEntity->setPaymentName($customer['name']." ".$customer['lastName']);
                    $paymentBEntity->getAuditoryInformation()->setCreatedDate(date("Y-m-d H:i:s"));
                    $paymentBEntity->getAuditoryInformation()->setCreatedBy(Auth::user()->id);

                $PaymentBL = new PaymentBL();
                $paymentId = $PaymentBL -> createPayment($paymentBEntity);

                // Create a movement(revenue) with the information from the invoice and the payment.

                $movementBEntity = new MovementBusinessEntity();
                    $movementBEntity -> setQuantity($invoiceBEntity->getTotal());
                    $movementBEntity -> setType(1);
                    $movementBEntity -> setDescription("");
                    $movementBEntity -> setConcept("Pago correspondiente a la factura " .  $invoiceId);
                    $movementBEntity -> setSender($customer['name']." ".$customer['lastName']);
                    $movementBEntity -> setComprobanteNumber($invoiceId);
                    $movementBEntity -> setPaymentId($paymentId);

                $movementBL = new MovementBL();
                $movementBL -> createMovement($movementBEntity);


                // Create a movement 

            }

            return $invoiceId;
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción
            DB::rollback();
        }


    }

    public function getInvoiceAndDetail($invoiceId){
        try{
            $data['invoice'] = array();
            $data['invoice'] = Invoice::getDataInvoice($invoiceId);
            $data['invoiceDetail'] = array();
            $data['invoiceDetail'] = Invoice::getDetailInvoice($invoiceId);
            return $data;
        }catch(Exception $e){
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
    }
    public function getDetailInvoice($invoiceId){
        try{

            $data = Invoice::getDetailInvoice($invoiceId);
            return $data;
        }catch(Exception $e){
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
    }
    public function getDetailInvoiceById($detailInvoiceId){
        try{
            $detailInvoiceData = array();
            $detailInvoiceData = Invoice::getDetailInvoiceById($detailInvoiceId);
            return $detailInvoiceData;
        }catch (Exception $e){
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
    }

    public function getFilterInvoice($valuesFilter){

        try{
            $data=array();
            $data=Invoice::filterInvoice($valuesFilter);
            return $data;
        }catch (Exception $e){
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
    }
    public function getInvoiceForDashboard($month, $year){
        try{
            $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $days = array_fill(0,$days,0);
            $invoices = Invoice::getInvoice();
            foreach ($invoices as $invoice) {
                if((int)date("m",strtotime($invoice->createdDate)) == $month && (int)date("Y",strtotime($invoice->createdDate)) == $year){
                    $days[(int)date("d", strtotime($invoice -> createdDate))] += $invoice -> total;
                }
            }



            return $days;
        }catch(Exception $e){
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
    }


    public function deleteInvoice($invoiceId)
    {
        //eliminar Factura y movimientos o

        try {
            Invoice::deleteDetailInvoice($invoiceId);
            Invoice::deleteInvoice($invoiceId);

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción
        }
    }

    public function createDetailInvoice($DetailInvoiceBusinessEntity)
    {
        try {
            DB::beginTransaction();                                         // Init transaction
            $detailInvoiceId = Invoice::createDetailInvoice($DetailInvoiceBusinessEntity);     // Create detailInvoice
            DB::commit();                                                   // Confirm operation

            ApplicationMessage::setMessageDetail('Creación correcta.');

            return $detailInvoiceId;

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                                 // Undo transaction
        }
    }

    public function updateDetailInvoice($DetailInvoiceBusinessEntity)
    {
        try {
            DB::beginTransaction();                                         // Init transaction
            Invoice::updateDetailInvoice($DetailInvoiceBusinessEntity);     // Create detailInvoice
            DB::commit();                                                   // Confirm operation

            ApplicationMessage::setMessageDetail('Modificación de mora correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                                 // Undo transaction
        }
    }

    public function reCalculateInvoice($invoiceId){
        try {
            DB::beginTransaction();
            Invoice::reCalculateInvoice($invoiceId);
            DB::commit();
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
    }

    public function setDelayedPaymentId($invoiceId,$delayedPaymentId)
    {
        try {
            DB::beginTransaction();
            Invoice::setDelayedPaymentId($invoiceId,$delayedPaymentId);
            DB::commit();
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
    }


}