<?php

namespace App\Http\Entities;

class PaymentBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface
{
    private $paymentId;
    private $paymethod;
    private $quantity;
    private $invoiceId;
    private $paymentName;
    private $observation;

    /**
     * @param mixed $paymentId
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
    }

    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @param mixed $paymethod
     */
    public function setPaymethod($paymethod)
    {
        $this->paymethod = $paymethod;
    }

    /**
     * @return mixed
     */
    public function getPaymethod()
    {
        return $this->paymethod;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $invoiceId
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;
    }

    /**
     * @return mixed
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     * @param mixed $paymentName
     */
    public function setPaymentName($paymentName)
    {
        $this->paymentName = $paymentName;
    }

    /**
     * @return mixed
     */
    public function getPaymentName()
    {
        return $this->paymentName;
    }

    /**
     * @param mixed $observation
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;
    }

    /**
     * @return mixed
     */
    public function getObservation()
    {
        return $this->observation;
    }



    public function setAllFromDataRowDB($dataRowDB)
    {

    }

    public function setAllFromDataRowHTTP($dataRowHTTP)
    {
        if($dataRowHTTP == null)
            return;

        if(array_key_exists('paymentId', $dataRowHTTP))
            $this->setPaymentId(trim($dataRowHTTP['paymentId']));

        if(array_key_exists('paymethod', $dataRowHTTP))
            $this->setPaymethod(trim($dataRowHTTP['paymethod']));

        if(array_key_exists('quantity', $dataRowHTTP))
            $this->setQuantity($dataRowHTTP['quantity']);

        if(array_key_exists('invoiceId', $dataRowHTTP))
            $this->setInvoiceId($dataRowHTTP['invoiceId']);

        if(array_key_exists('paymentName', $dataRowHTTP))
            $this->setPaymentName($dataRowHTTP['paymentName']);

        if(array_key_exists('observation', $dataRowHTTP))
            $this->setObservation($dataRowHTTP['observation']);
    }


    function validate($validationType){}
}