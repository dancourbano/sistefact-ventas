<?php

namespace App\Http\Entities;

class DetailPackageBusinessentity extends BaseBusinessEntity implements BusinessEntityInterface
{
    private $detailPackageId;
    private $basePrice;
    private $quantity;
    private $itemId;
    private $packageId;

    /**
     * @param mixed $detailPackageId
     */
    public function setDetailPackageId($detailPackageId)
    {
        $this->detailPackageId = $detailPackageId;
    }

    /**
     * @return mixed
     */
    public function getDetailPackageId()
    {
        return $this->detailPackageId;
    }


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
     * @param mixed $packageId
     */
    public function setPackageId($packageId)
    {
        $this->packageId = $packageId;
    }

    /**
     * @return mixed
     */
    public function getPackageId()
    {
        return $this->packageId;
    }

    public function setAllFromDataRowDB($dataRowDB)
    {

    }
    public function setAllFromDataRowHTTP($dataRowHTTP)
    {
        if($dataRowHTTP == null)
            return;

        if(array_key_exists('detailPackageId', $dataRowHTTP))
            $this->setDetailPackageId(trim($dataRowHTTP['detailPackageId']));

        if(array_key_exists('basePrice', $dataRowHTTP))
            $this->setBasePrice(trim($dataRowHTTP['basePrice']));

        if(array_key_exists('quantity', $dataRowHTTP))
            $this->setQuantity(trim($dataRowHTTP['quantity']));

        if(array_key_exists('itemId', $dataRowHTTP))
            $this->setItemId(trim($dataRowHTTP['itemId']));

        if(array_key_exists('packageId', $dataRowHTTP))
            $this->setPackageId(trim($dataRowHTTP['packageId']));
    }

    function validate($validationType){}
}