<?php

namespace App\Http\Entities;

class MovementBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface
{
    private $movementId;
    private $quantity;
    private $type;
    private $description;
    private $concept;
    private $sender;
    private $comprobanteNumber;
    private $paymentId;

    /**
     * @param mixed $comprobanteNumber
     */
    public function setComprobanteNumber($comprobanteNumber)
    {
        $this->comprobanteNumber = $comprobanteNumber;
    }

    /**
     * @return mixed
     */
    public function getComprobanteNumber()
    {
        return $this->comprobanteNumber;
    }

    /**
     * @param mixed $concept
     */
    public function setConcept($concept)
    {
        $this->concept = $concept;
    }

    /**
     * @return mixed
     */
    public function getConcept()
    {
        return $this->concept;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $movementId
     */
    public function setMovementId($movementId)
    {
        $this->movementId = $movementId;
    }

    /**
     * @return mixed
     */
    public function getMovementId()
    {
        return $this->movementId;
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
     * @param mixed $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

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



    public function setAllFromDataRowDB($dataRowDB)
    {

    }

    public function setAllFromDataRowHTTP($dataRowHTTP)
    {
        if($dataRowHTTP == null)
            return;

        if(array_key_exists('movementId', $dataRowHTTP))
            $this->setMovementId(trim($dataRowHTTP['movementId']));

        if(array_key_exists('quantity', $dataRowHTTP))
            $this->setQuantity(trim($dataRowHTTP['quantity']));

        if(array_key_exists('type', $dataRowHTTP))
            $this->setType($dataRowHTTP['type']);

        if(array_key_exists('description', $dataRowHTTP))
            $this->setDescription($dataRowHTTP['description']);

        if(array_key_exists('concept', $dataRowHTTP))
            $this->setConcept($dataRowHTTP['concept']);

        if(array_key_exists('sender', $dataRowHTTP))
            $this->setSender($dataRowHTTP['sender']);

        if(array_key_exists('comprobanteNumber', $dataRowHTTP))
            $this->setComprobanteNumber($dataRowHTTP['comprobanteNumber']);

        if(array_key_exists('paymentId', $dataRowHTTP))
            $this->setPaymentId($dataRowHTTP['paymentId']);

    }


    function validate($validationType){}
}