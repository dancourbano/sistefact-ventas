<?php

namespace App\Http\Entities;

class ItemBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface
{
    private $itemId;
    private $descripcion;
    private $basePrice;
    private $type;
    private $itemNumber;
    private $status;
    private $itemNumCurrent;
    private $historyId;
    /**
     * @param mixed $basePrice
     */
    public function setBasePrice($basePrice)
    {
        $this->basePrice = $basePrice;
    }

    /**
     * @return mixed
     */
    public function getBasePrice()
    {
        return $this->basePrice;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param mixed $itemNumCurrent
     */
    public function setItemNumCurrent($itemNumCurrent)
    {
        $this->itemNumCurrent = $itemNumCurrent;
    }

    /**
     * @return mixed
     */
    public function getItemNumCurrent()
    {
        return $this->itemNumCurrent;
    }

    /**
     * @param mixed $itemNumber
     */
    public function setItemNumber($itemNumber)
    {
        $this->itemNumber = $itemNumber;
    }

    /**
     * @return mixed
     */
    public function getItemNumber()
    {
        return $this->itemNumber;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
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
     * @return mixed
     */
    public function getHistoryId()
    {
        return $this->historyId;
    }

    /**
     * @param mixed $historyId
     */
    public function setHistoryId($historyId)
    {
        $this->historyId = $historyId;
    }


    public function setAllFromDataRowDB($dataRowDB)
    {

    }
    public function setAllFromDataRowHTTP($dataRowHTTP)
    {
        if($dataRowHTTP == null)
            return;

        if(array_key_exists('itemId', $dataRowHTTP))
            $this->setItemId(trim($dataRowHTTP['itemId']));

        if(array_key_exists('productId', $dataRowHTTP))
            $this->setItemId(trim($dataRowHTTP['productId']));

        if(array_key_exists('descripcion', $dataRowHTTP))
            $this->setDescripcion($dataRowHTTP['descripcion']);

        if(array_key_exists('basePrice', $dataRowHTTP))
            $this->setBasePrice($dataRowHTTP['basePrice']);

        if(array_key_exists('type', $dataRowHTTP))
            $this->setType($dataRowHTTP['type']);

        if(array_key_exists('itemNumber', $dataRowHTTP))
            $this->setItemNumber($dataRowHTTP['itemNumber']);

        if(array_key_exists('status', $dataRowHTTP))
            $this->setStatus($dataRowHTTP['status']);

        if(array_key_exists('itemNumCurrent', $dataRowHTTP))
            $this->setItemNumCurrent($dataRowHTTP['itemNumCurrent']);
        if(array_key_exists('historyId', $dataRowHTTP))
            $this->setHistoryId($dataRowHTTP['historyId']);
    }


    function validate($validationType){}
}