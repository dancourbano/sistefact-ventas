<?php

namespace App\Http\Entities;

class DetailMaintenanceBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface
{
    private $detailmaintenanceId;
    private $latches;
    private $panic;
    private $claxon;
    private $onOff;
    private $microphone;
    private $detail;
    private $vehicleId;

    /**
     * @param mixed $detailmaintenanceId
     */
    public function setDetailMaintenanceId($detailmaintenanceId)
    {
        $this->detailmaintenanceId = $detailmaintenanceId;
    }

    /**
     * @return mixed
     */
    public function getDetailMaintenanceId()
    {
        return $this->detailmaintenanceId;
    }

    /**
     * @param mixed $latches
     */
    public function setLatches($latches)
    {
        $this->latches = $latches;
    }

    /**
     * @return mixed
     */
    public function getLatches()
    {
        return $this->latches;
    }

    /**
     * @param mixed $panic
     */
    public function setPanic($panic)
    {
        $this->panic = $panic;
    }

    /**
     * @return mixed
     */
    public function getPanic()
    {
        return $this->panic;
    }

    /**
     * @param mixed $claxon
     */
    public function setClaxon($claxon)
    {
        $this->claxon = $claxon;
    }

    /**
     * @return mixed
     */
    public function getClaxon()
    {
        return $this->claxon;
    }

    /**
     * @param mixed $onOff
     */
    public function setOnOff($onOff)
    {
        $this->onOff = $onOff;
    }

    /**
     * @return mixed
     */
    public function getOnOff()
    {
        return $this->onOff;
    }

    /**
     * @param mixed $microphone
     */
    public function setMicrophone($microphone)
    {
        $this->microphone = $microphone;
    }

    /**
     * @return mixed
     */
    public function getMicrophone()
    {
        return $this->microphone;
    }

    /**
     * @param mixed $detail
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
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

        if(array_key_exists('detailmaintenanceId', $dataRowHTTP))
            $this->setDetailMaintenanceId(trim($dataRowHTTP['detailmaintenanceId']));

        if(array_key_exists('latches', $dataRowHTTP))
            $this->setLatches(trim($dataRowHTTP['latches']));

        if(array_key_exists('claxon', $dataRowHTTP))
            $this->setClaxon(trim($dataRowHTTP['claxon']));

        if(array_key_exists('onOff', $dataRowHTTP))
            $this->setOnOff(trim($dataRowHTTP['onOff']));

        if(array_key_exists('microphone', $dataRowHTTP))
            $this->setMicrophone(trim($dataRowHTTP['microphone']));

        if(array_key_exists('detail', $dataRowHTTP))
            $this->setDetail(trim($dataRowHTTP['detail']));

        if(array_key_exists('panic', $dataRowHTTP))
            $this->setPanic($dataRowHTTP['panic']);

        if(array_key_exists('vehicleId', $dataRowHTTP))
            $this->setVehicleId($dataRowHTTP['vehicleId']);
    }


    function validate($validationType){}
}