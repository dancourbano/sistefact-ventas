<?php

namespace App\Http\Entities;

class PhoneBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface
{
    private $phoneId;
    private $name;
    private $phone;
    private $vehicleId;
    private $dni;

    /**
     * @param mixed $phoneId
     */
    public function setPhoneId($phoneId)
    {
        $this->phoneId = $phoneId;
    }

    /**
     * @return mixed
     */
    public function getPhoneId()
    {
        return $this->phoneId;
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

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
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

    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }



    public function setAllFromDataRowDB($dataRowDB)
    {

    }

    public function setAllFromDataRowHTTP($dataRowHTTP)
    {
        if($dataRowHTTP == null)
            return;

        if(array_key_exists('phoneId', $dataRowHTTP))
            $this->setPhoneId(trim($dataRowHTTP['phoneId']));

        if(array_key_exists('name', $dataRowHTTP))
            $this->setName(trim($dataRowHTTP['name']));

        if(array_key_exists('phone', $dataRowHTTP))
            $this->setPhone($dataRowHTTP['phone']);

        if(array_key_exists('vehicleId', $dataRowHTTP))
            $this->setVehicleId($dataRowHTTP['vehicleId']);

        if(array_key_exists('dni', $dataRowHTTP))
            $this->setDni($dataRowHTTP['dni']);
    }


    function validate($validationType){}
}