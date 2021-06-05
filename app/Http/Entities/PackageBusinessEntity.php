<?php

namespace App\Http\Entities;

class PackageBusinessentity extends BaseBusinessEntity implements BusinessEntityInterface
{
    private $packageId;
    private $name;
    private $basePrice;

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
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public function setAllFromDataRowDB($dataRowDB)
    {

    }
    public function setAllFromDataRowHTTP($dataRowHTTP)
    {
        if($dataRowHTTP == null)
            return;

        if(array_key_exists('packageId', $dataRowHTTP))
            $this->setPackageId(trim($dataRowHTTP['packageId']));

        if(array_key_exists('name', $dataRowHTTP))
            $this->setName(trim($dataRowHTTP['name']));

        if(array_key_exists('basePrice', $dataRowHTTP))
            $this->setBasePrice($dataRowHTTP['basePrice']);
    }

    function validate($validationType){}
}