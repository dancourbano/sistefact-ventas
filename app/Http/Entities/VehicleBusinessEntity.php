<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 12/10/2016
 * Time: 11:07
 */

namespace App\Http\Entities;


class VehicleBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface{
    private $vehicleId;
    private $placa;
    private $sn;
    private $shortNumber;
    private $motorNumber;
    private $year;
    private $brandCar;
    private $modelClass;
    private $chasisSerie;
    private $registerDate;
    private $comment;
    private $classCar;
    private $internalNumber;
    private $status;
    private $telMov;
    private $telCla;
    private $telEmergency;
    private $createdBy;
    private $createdDate;
    private $modifiedBy;
    private $modifiedDate;
    private $sim;
    private $gpsId;
    private $mg;
    private $mandated;
    private $personTelEmergency;
    private $brandDevice;
    private $notInformationCel;
    private $notInformationName;
    private $parkingplace;
    private $customerId;
    private $customerName;
    private $customerLastName;
    private $historyId;
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
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * @param mixed $placa
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }

    /**
     * @return mixed
     */
    public function getSn()
    {
        return $this->sn;
    }

    /**
     * @param mixed $sn
     */
    public function setSn($sn)
    {
        $this->sn = $sn;
    }

    /**
     * @return mixed
     */
    public function getShortNumber()
    {
        return $this->shortNumber;
    }

    /**
     * @param mixed $shortNumber
     */
    public function setShortNumber($shortNumber)
    {
        $this->shortNumber = $shortNumber;
    }

    /**
     * @return mixed
     */
    public function getMotorNumber()
    {
        return $this->motorNumber;
    }

    /**
     * @param mixed $motorNumber
     */
    public function setMotorNumber($motorNumber)
    {
        $this->motorNumber = $motorNumber;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getBrandCar()
    {
        return $this->brandCar;
    }

    /**
     * @param mixed $brandCar
     */
    public function setBrandCar($brandCar)
    {
        $this->brandCar = $brandCar;
    }

    /**
     * @return mixed
     */
    public function getModelClass()
    {
        return $this->modelClass;
    }

    /**
     * @param mixed $model
     */
    public function setModelClass($modelClass)
    {
        $this->modelClass = $modelClass;
    }

    /**
     * @return mixed
     */
    public function getChasisSerie()
    {
        return $this->chasisSerie;
    }

    /**
     * @param mixed $chasisSerie
     */
    public function setChasisSerie($chasisSerie)
    {
        $this->chasisSerie = $chasisSerie;
    }

    /**
     * @return mixed
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * @param mixed $registerDate
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getClassCar()
    {
        return $this->classCar;
    }

    /**
     * @param mixed $classCar
     */
    public function setClassCar($classCar)
    {
        $this->classCar = $classCar;
    }

    /**
     * @return mixed
     */
    public function getInternalNumber()
    {
        return $this->internalNumber;
    }

    /**
     * @param mixed $internalNumber
     */
    public function setInternalNumber($internalNumber)
    {
        $this->internalNumber = $internalNumber;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
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
    public function getTelMov()
    {
        return $this->telMov;
    }

    /**
     * @param mixed $telMov
     */
    public function setTelMov($telMov)
    {
        $this->telMov = $telMov;
    }

    /**
     * @return mixed
     */
    public function getTelCla()
    {
        return $this->telCla;
    }

    /**
     * @param mixed $telCla
     */
    public function setTelCla($telCla)
    {
        $this->telCla = $telCla;
    }

    /**
     * @return mixed
     */
    public function getTelEmergency()
    {
        return $this->telEmergency;
    }

    /**
     * @param mixed $telEmergency
     */
    public function setTelEmergency($telEmergency)
    {
        $this->telEmergency = $telEmergency;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param mixed $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return mixed
     */
    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

    /**
     * @param mixed $modifiedBy
     */
    public function setModifiedBy($modifiedBy)
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * @return mixed
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }

    /**
     * @param mixed $modifiedDate
     */
    public function setModifiedDate($modifiedDate)
    {
        $this->modifiedDate = $modifiedDate;
    }

    /**
     * @return mixed
     */
    public function getSim()
    {
        return $this->sim;
    }

    /**
     * @param mixed $sim
     */
    public function setSim($sim)
    {
        $this->sim = $sim;
    }

    /**
     * @return mixed
     */
    public function getGpsId()
    {
        return $this->gpsId;
    }

    /**
     * @param mixed $gpsId
     */
    public function setGpsId($gpsId)
    {
        $this->gpsId = $gpsId;
    }

    /**
     * @return mixed
     */
    public function getMg()
    {
        return $this->mg;
    }

    /**
     * @param mixed $mg
     */
    public function setMg($mg)
    {
        $this->mg = $mg;
    }

    /**
     * @return mixed
     */
    public function getMandated()
    {
        return $this->mandated;
    }

    /**
     * @param mixed $mandated
     */
    public function setMandated($mandated)
    {
        $this->mandated = $mandated;
    }

    /**
     * @return mixed
     */
    public function getPersonTelEmergency()
    {
        return $this->personTelEmergency;
    }

    /**
     * @param mixed $personTelEmergency
     */
    public function setPersonTelEmergency($personTelEmergency)
    {
        $this->personTelEmergency = $personTelEmergency;
    }

    /**
     * @return mixed
     */
    public function getBrandDevice()
    {
        return $this->brandDevice;
    }

    /**
     * @param mixed $brandDevice
     */
    public function setBrandDevice($brandDevice)
    {
        $this->brandDevice = $brandDevice;
    }

    /**
     * @return mixed
     */
    public function getNotInformationCel()
    {
        return $this->notInformationCel;
    }

    /**
     * @param mixed $notInformationCel
     */
    public function setNotInformationCel($notInformationCel)
    {
        $this->notInformationCel = $notInformationCel;
    }

    /**
     * @return mixed
     */
    public function getNotInformationName()
    {
        return $this->notInformationName;
    }

    /**
     * @param mixed $notInformationName
     */
    public function setNotInformationName($notInformationName)
    {
        $this->notInformationName = $notInformationName;
    }

    /**
     * @return mixed
     */
    public function getParkingplace()
    {
        return $this->parkingplace;
    }

    /**
     * @param mixed $parkingplace
     */
    public function setParkingplace($parkingplace)
    {
        $this->parkingplace = $parkingplace;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return mixed
     */
    public function getCustomerLastName()
    {
        return $this->customerLastName;
    }

    /**
     * @param mixed $customerLastName
     */
    public function setCustomerLastName($customerLastName)
    {
        $this->customerLastName = $customerLastName;
    }

    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param mixed $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
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
        if(array_key_exists('vehicleId', $dataRowHTTP))
            $this->setVehicleId(trim($dataRowHTTP['vehicleId']));
        if(array_key_exists('placa', $dataRowHTTP))
            $this->setPlaca($dataRowHTTP['placa']);
        if(array_key_exists('sn', $dataRowHTTP))
            $this->setSn($dataRowHTTP['sn']);
        if(array_key_exists('shortNumber', $dataRowHTTP))
            $this->setShortNumber($dataRowHTTP['shortNumber']);
        if(array_key_exists('motorNumber', $dataRowHTTP))
            $this->setMotorNumber($dataRowHTTP['motorNumber']);
        if(array_key_exists('year', $dataRowHTTP))
            $this->setYear($dataRowHTTP['year']);
        if(array_key_exists('brandCar', $dataRowHTTP))
            $this->setBrandCar($dataRowHTTP['brandCar']);
        if(array_key_exists('modelClass', $dataRowHTTP))
            $this->setModelClass($dataRowHTTP['modelClass']);
        if(array_key_exists('chasisSerie', $dataRowHTTP))
            $this->setChasisSerie($dataRowHTTP['chasisSerie']);
        if(array_key_exists('registerDate', $dataRowHTTP))
            $this->setRegisterDate($dataRowHTTP['registerDate']);
        if(array_key_exists('comment', $dataRowHTTP))
            $this->setComment($dataRowHTTP['comment']);
        if(array_key_exists('classCar', $dataRowHTTP))
            $this->setClassCar($dataRowHTTP['classCar']);
        if(array_key_exists('internalNumber', $dataRowHTTP))
            $this->setInternalNumber($dataRowHTTP['internalNumber']);
        if(array_key_exists('status', $dataRowHTTP))
            $this->setStatus($dataRowHTTP['status']);
        if(array_key_exists('telMov', $dataRowHTTP))
            $this->setTelMov($dataRowHTTP['telMovNumber']);
        if(array_key_exists('telCla', $dataRowHTTP))
            $this->setTelCla($dataRowHTTP['telCla']);
        if(array_key_exists('telEmergency', $dataRowHTTP))
            $this->setTelEmergency($dataRowHTTP['telEmergency']);
        if(array_key_exists('sim', $dataRowHTTP))
            $this->setSim($dataRowHTTP['sim']);
        if(array_key_exists('gpsId', $dataRowHTTP))
            $this->setGpsId($dataRowHTTP['gpsId']);
        if(array_key_exists('mg', $dataRowHTTP))
            $this->setMg($dataRowHTTP['mg']);
        if(array_key_exists('mandated', $dataRowHTTP))
            $this->setMandated($dataRowHTTP['mandated']);
        if(array_key_exists('personTelEmergency', $dataRowHTTP))
            $this->setPersonTelEmergency($dataRowHTTP['personTelEmergency']);
        if(array_key_exists('brandDevice', $dataRowHTTP))
            $this->setBrandDevice($dataRowHTTP['brandDevice']);
        if(array_key_exists('notInformationCel', $dataRowHTTP))
            $this->setNotInformationCel($dataRowHTTP['notInformationCel']);
        if(array_key_exists('notInformationName', $dataRowHTTP))
            $this->setNotInformationName($dataRowHTTP['notInformationName']);
        if(array_key_exists('parkingplace', $dataRowHTTP))
            $this->setParkingplace($dataRowHTTP['parkingplace']);
        if(array_key_exists('customerId', $dataRowHTTP))
            $this->setCustomerId($dataRowHTTP['customerId']);
        if(array_key_exists('customerName', $dataRowHTTP))
            $this->setCustomerName($dataRowHTTP['customerName']);
        if(array_key_exists('customerLastName', $dataRowHTTP))
            $this->setCustomerLastName($dataRowHTTP['customerLastName']);
        if(array_key_exists('historyId', $dataRowHTTP))
            $this->setHistoryId($dataRowHTTP['historyId']);
    }


    function validate($validationType){}
}