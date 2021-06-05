<?php
/**
 * Created by PhpStorm.
 * User: PERSONAL
 * Date: 03/11/16
 * Time: 12:51 PM
 */

namespace App\Http\Entities;


class DetailInvoiceBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface {

    private $detailInvoiceId;
    private $price;
    private $status;
    private $quantity;
    private $description;
    private $invoiceId;
    private $packageId;
    private $itemId;
    private $vehicleId;

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
     * @param mixed $detailInvoiceId
     */
    public function setDetailInvoiceId($detailInvoiceId)
    {
        $this->detailInvoiceId = $detailInvoiceId;
    }

    /**
     * @return mixed
     */
    public function getDetailInvoiceId()
    {
        return $this->detailInvoiceId;
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

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
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
     * @param mixed $vehicleId
     */
    public function setVehicleId($vehicleId)
    {
        $this->vehicleId = $vehicleId;
    }

    /**
     * @return mixed
     */
    public function getVehicleId()
    {
        return $this->vehicleId;
    }

    public function setAllFromDataRowDB($dataRowDB)
    {

    }
    public function setAllFromDataRowHTTP($dataRowHTTP)
    {

        if($dataRowHTTP == null)
            return;
        if(array_key_exists('detailInvoiceId', $dataRowHTTP))
            $this->setDetailInvoiceId(trim($dataRowHTTP['detailInvoiceId']));

        if(array_key_exists('price', $dataRowHTTP))
            $this->setPrice(trim($dataRowHTTP['price']));

        if(array_key_exists('status', $dataRowHTTP))
            $this->setStatus(trim($dataRowHTTP['status']));

        if(array_key_exists('quantity', $dataRowHTTP))
            $this->setQuantity(trim($dataRowHTTP['quantity']));

        if(array_key_exists('description', $dataRowHTTP))
            $this->setDescription(trim($dataRowHTTP['description']));

        if(array_key_exists('invoiceId', $dataRowHTTP))
            $this->setInvoiceId(trim($dataRowHTTP['invoiceId']));

        if(array_key_exists('itemId', $dataRowHTTP))
            $this->setItemId(trim($dataRowHTTP['itemId']));

        if(array_key_exists('packageId', $dataRowHTTP))
            $this->setPackageId(trim($dataRowHTTP['packageId']));

        if(array_key_exists('vehicleId', $dataRowHTTP))
            $this->setVehicleId(trim($dataRowHTTP['vehicleId']));

    }


    function validate($validationType){

    }
}