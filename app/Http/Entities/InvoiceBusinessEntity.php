<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 27/06/2015
 * Time: 22:31
 */
namespace App\Http\Entities;


class InvoiceBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface
{

    private $invoiceId;
    private $taxType;
    private $tax;
    private $disccountValue;
    private $subtotal;
    private $datePayMax;
    private $status;
    private $disccountType;
    private $total;
    private $is_sendEmail;
    private $repeatInvoice;
    private $notes;
    private $debt;
    private $methodpayment;
    private $delayedPaymentDetailInvoiceId;
    private $customerId;

    /**
     * @return mixed
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     * @param mixed $invocieId
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId= $invoiceId;
    }

    /**
     * @return mixed
     */
    public function getTaxType()
    {
        return $this->taxType;
    }

    /**
     * @param mixed $taxType
     */
    public function setTaxType($taxType)
    {
        $this->taxType= $taxType;
    }

    /**
     * @return mixed
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param mixed $taxType
     */
    public function setTax($tax)
    {
        $this->tax= $tax;
    }

    /**
     * @return mixed
     */
    public function getDisccountValue()
    {
        return $this->disccountValue;
    }

    /**
     * @param mixed $disccountValue
     */
    public function setDisccountValue($disccountValue)
    {
        $this->disccountValue= $disccountValue;
    }

    /**
     * @return mixed
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * @param mixed $subtotal
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal= $subtotal;
    }

    /**
     * @return mixed
     */
    public function getDatePayMax()
    {
        return $this->datePayMax;
    }

    /**
     * @param mixed $datePayMax
     */
    public function setDatePayMax($datePayMax)
    {
        $this->datePayMax= $datePayMax;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status= $status;
    }

    /**
     * @return mixed
     */
    public function getDisccountType()
    {
        return $this->disccountType;
    }

    /**
     * @param mixed $disccountType
     */
    public function setDisccountType($disccountType)
    {
        $this->disccountType= $disccountType;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total= $total;
    }

    /**
     * @return mixed
     */
    public function getIsSendEmail()
    {
        return $this->is_sendEmail;
    }

    /**
     * @param mixed $is_sendEmail
     */
    public function setIsSendEmail($is_sendEmail)
    {
        $this->is_sendEmail= $is_sendEmail;
    }


    /**
     * @return mixed
     */
    public function getRepeatInvoice()
    {
        return $this->repeatInvoice;
    }

    /**
     * @param mixed $repeatInvoice
     */
    public function setRepeatInvoice($repeatInvoice)
    {
        $this->repeatInvoice= $repeatInvoice;
    }


    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes= $notes;
    }

    /**
     * @return mixed
     */
    public function getDebt()
    {
        return $this->debt;
    }

    /**
     * @param mixed $debt
     */
    public function setDebt($debt)
    {
        $this->debt= $debt;
    }

    /**
     * @return mixed
     */
    public function getMethodPayment()
    {
        return $this->methodpayment;
    }

    /**
     * @param mixed $methodpayment
     */
    public function setMethodPayment($methodpayment)
    {
        $this->methodpayment= $methodpayment;
    }

    /**
     * @return mixed
     */
    public function getDelayedPaymentDetailInvoiceId()
    {
        return $this->delayedPaymentDetailInvoiceId;
    }

    /**
     * @param mixed $paymentLateType
     */
    public function setDelayedPaymentDetailInvoiceId($delayedPaymentDetailInvoiceId)
    {
        $this->delayedPaymentDetailInvoiceId= $delayedPaymentDetailInvoiceId;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId= $customerId;
    }
    public function setAllFromDataRowDB($dataRowDB)
    {

    }
    public function setAllFromDataRowHTTP($dataRowHTTP)
    {

        if($dataRowHTTP == null)
            return;
        if(array_key_exists('invoiceId', $dataRowHTTP))
            $this->setInvoiceId(trim($dataRowHTTP['invoiceId']));

        if(array_key_exists('taxType', $dataRowHTTP))
            $this->setTaxType($dataRowHTTP['taxType']);

        if(array_key_exists('tax', $dataRowHTTP))
            $this->setTax($dataRowHTTP['tax']);

        if(array_key_exists('disccountValue', $dataRowHTTP))
            $this->setDisccountValue($dataRowHTTP['disccountValue']);

        if(array_key_exists('subtotal', $dataRowHTTP))
            $this->setSubtotal($dataRowHTTP['subtotal']);

        if(array_key_exists('datePayMax', $dataRowHTTP))
            $this->setDatePayMax($dataRowHTTP['datePayMax']);

        if(array_key_exists('status', $dataRowHTTP))
            $this->setStatus($dataRowHTTP['status']);

        if(array_key_exists('disccountType', $dataRowHTTP))
            $this->setDisccountType($dataRowHTTP['disccountType']);

        if(array_key_exists('total', $dataRowHTTP))
            $this->setTotal($dataRowHTTP['total']);

        if(array_key_exists('is_sendEmail', $dataRowHTTP))
            $this->setIsSendEmail($dataRowHTTP['is_sendEmail']);

        if(array_key_exists('repeatInvoice', $dataRowHTTP))
            $this->setRepeatInvoice($dataRowHTTP['repeatInvoice']);

        if(array_key_exists('notes', $dataRowHTTP))
            $this->setNotes($dataRowHTTP['notes']);

        if(array_key_exists('debt', $dataRowHTTP))
            $this->setDebt($dataRowHTTP['debt']);

        if(array_key_exists('methodpayment', $dataRowHTTP))
            $this->setMethodPayment($dataRowHTTP['methodpayment']);

        if(array_key_exists('customerId', $dataRowHTTP))
            $this->setCustomerId($dataRowHTTP['customerId']);

        if(array_key_exists('delayedPaymentDetailInvoiceId', $dataRowHTTP))
            $this->setDelayedPaymentDetailInvoiceId($dataRowHTTP['delayedPaymentDetailInvoiceId']);


    }


    function validate($validationType){

    }
}