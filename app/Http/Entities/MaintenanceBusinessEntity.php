<?php

namespace App\Http\Entities;

class MaintenanceBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface
{
    private $maintenanceId;
    private $maintenanceDate;
    private $detail;
    private $vehicleId;
    private $status;

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
     * @param mixed $maintenanceDate
     */
    public function setMaintenanceDate($maintenanceDate)
    {
        $this->maintenanceDate = $maintenanceDate;
    }

    /**
     * @return mixed
     */
    public function getMaintenanceDate()
    {
        return $this->maintenanceDate;
    }

    /**
     * @param mixed $maintenanceId
     */
    public function setMaintenanceId($maintenanceId)
    {
        $this->maintenanceId = $maintenanceId;
    }

    /**
     * @return mixed
     */
    public function getMaintenanceId()
    {
        return $this->maintenanceId;
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


    public function setAllFromDataRowDB($dataRowDB)
    {

    }

    public function setAllFromDataRowHTTP($dataRowHTTP)
    {
        if($dataRowHTTP == null)
            return;

        if(array_key_exists('maintenanceId', $dataRowHTTP))
            $this->setMaintenanceId(trim($dataRowHTTP['maintenanceId']));

        if(array_key_exists('maintenanceDate', $dataRowHTTP))
            $this->setMaintenanceDate(trim($dataRowHTTP['maintenanceDate']));

        if(array_key_exists('detail', $dataRowHTTP))
            $this->setDetail($dataRowHTTP['detail']);

        if(array_key_exists('vehicleId', $dataRowHTTP))
            $this->setVehicleId($dataRowHTTP['vehicleId']);

        if(array_key_exists('status', $dataRowHTTP))
            $this->setStatus($dataRowHTTP['status']);
    }


    function validate($validationType){}
}