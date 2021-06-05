<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 12/10/2016
 * Time: 11:07
 */

namespace App\Http\Entities;


class VehicleOutdatedBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface{
    private $vehicleId;
    private $typeCommandSmsId;
    private $placa;
    private $phone;
    /**
     * @param mixed $phoneId
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

     /**
     * @param mixed $phoneId
     */
    public function setTypeCommandSmsId($typeCommandSmsId)
    {
        $this->typeCommandSmsId = $typeCommandSmsId;
    }

    /**
     * @return mixed
     */
    public function getTypeCommandSmsId()
    {
        return $this->typeCommandSmsId;
    }

    /**
     * @param mixed $tipo
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }

    /**
     * @return mixed
     */
    public function getPlaca()
    {
        return $this->placa;
    }
    /**
     * @param mixed $tipo
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
    public function setAllFromDataRowDB($dataRowDB)
    {

    }

    public function setAllFromDataRowHTTP($dataRowHTTP)
    {


        if($dataRowHTTP == null)
            return;
        if(array_key_exists('vehicleId', $dataRowHTTP))
            $this->setVehicleId(trim($dataRowHTTP['vehicleId']));
        if(array_key_exists('placa', $dataRowHTTP))
            $this->setPlaca($dataRowHTTP['placa']);
        if(array_key_exists('typeCommandSmsId', $dataRowHTTP))
            $this->setTypeCommandSmsId($dataRowHTTP['typeCommandSmsId']);
        if(array_key_exists('phone', $dataRowHTTP))
            $this->setPhone($dataRowHTTP['phone']);         
    }


    function validate($validationType){}
}