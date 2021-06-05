<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 27/06/2015
 * Time: 22:31
 */
namespace App\Http\Entities;


class DriverBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface
{

    private $driverId;
    private $name;
    private $lastName;
    private $phone;
    private $vehicleId;
    private $address;
    private $identification;

    /**
     * @param mixed $identification
     */
    public function setIdentification($identification)
    {
        $this->identification = $identification;
    }

    /**
     * @return mixed
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * @return mixed
     */
    public function getDriverId()
    {
        return $this->driverId;
    }

    /**
     * @param mixed $driverId
     */
    public function setDriverId($driverId)
    {
        $this->driverId = $driverId;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
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
    public function getVehicleId()
    {
        return $this->vehicleId;
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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }





    public function setAllFromDataRowDB($dataRowDB)
    {

    }
    public function setAllFromDataRowHTTP($dataRowHTTP)
    {


        if($dataRowHTTP == null)
            return;
        if(array_key_exists('driverId', $dataRowHTTP))
            $this->setDriverId(trim($dataRowHTTP['driverId']));

        if(array_key_exists('name', $dataRowHTTP))
            $this->setName($dataRowHTTP['name']);

        if(array_key_exists('lastName', $dataRowHTTP))
            $this->setLastName($dataRowHTTP['lastName']);

        if(array_key_exists('phone', $dataRowHTTP))
            $this->setPhone($dataRowHTTP['phone']);

        if(array_key_exists('vehicleId', $dataRowHTTP))
            $this->setVehicleId($dataRowHTTP['vehicleId']);

        if(array_key_exists('address', $dataRowHTTP))
            $this->setAddress($dataRowHTTP['address']);

        if(array_key_exists('identification', $dataRowHTTP))
            $this->setIdentification($dataRowHTTP['identification']);
    }


    function validate($validationType){}
}