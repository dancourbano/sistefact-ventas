<?php
/**
 * Created by PhpStorm.
 * User: PERSONAL
 * Date: 14/12/16
 * Time: 10:07 AM
 */

namespace App\Http\Business;


use App\Mail\ChangeManager;
use Illuminate\Support\Facades\Mail;

class CRUDManager {

    public static function changeManagerCustomer($customerBEntity,$tipo,$id,$user){
        $data=array();
        $date='';


        if($tipo=='crear'){
            $data=array(
                'identificador'=>$id,
                'nombre' => $customerBEntity->getName(),
                'apellidos'=>$customerBEntity->getLastName(),
                'documento' => $customerBEntity->getIdentification(),
                'email'=>$customerBEntity->getEmail(),
                'estadoCivil'=>$customerBEntity->getMaritalStatus(),
                'telefono1'=>$customerBEntity->getPhone1(),
                'telefono2'=>$customerBEntity->getPhone2(),
                'Tipo'=>$customerBEntity->getType(),
                'Cumpleaños'=>$customerBEntity->getBirthday(),
                'Ciudad'=>$customerBEntity->getCity(),
                'Direccion'=>$customerBEntity->getAddress(),
                'fechaCreacion'=>$customerBEntity->getAuditoryInformation()->getCreatedDate()
            );
            $date=$customerBEntity->getAuditoryInformation()->getCreatedDate();
        }
        if($tipo=='editar'){
            $data=array(
                'identificador'=>$id,
                'nombre' => $customerBEntity->getName(),
                'apellidos'=>$customerBEntity->getLastName(),
                'documento' => $customerBEntity->getIdentification(),
                'email'=>$customerBEntity->getEmail(),
                'estadoCivil'=>$customerBEntity->getMaritalStatus(),
                'telefono1'=>$customerBEntity->getPhone1(),
                'telefono2'=>$customerBEntity->getPhone2(),
                'tipo'=>$customerBEntity->getType(),
                'cumpleaños'=>$customerBEntity->getBirthday(),
                'ciudad'=>$customerBEntity->getCity(),
                'direccion'=>$customerBEntity->getAddress(),
                'fechaModificacion'=>$customerBEntity->getAuditoryInformation()->getModifiedDate()
            );
            $date=$customerBEntity->getAuditoryInformation()->getModifiedDate();
        }

        $parametros=array(
            'tipo'=>$tipo,
            'tabla'=>'Cliente',
            'fecha'=>$date,
            'usuario'=>$user
        );
        Mail::to('gps-adm-jnisi@hotmail.com','Administracion GPSJnisi')
            ->send(new ChangeManager($data,$parametros));
    }
    public static function changeManagerDriver($driverBEntity,$tipo,$id,$user){
        $data=array();
        $date='';


        if($tipo=='crear'){
            $data=array(
                'identificador'=>$id,
                'nombre' => $driverBEntity->getName(),
                'apellidos'=>$driverBEntity->getLastName(),
                'telefono'=>$driverBEntity->getPhone(),
                'idVehiculo'=>$driverBEntity->getVehicleId(),
                'direccion'=>$driverBEntity->getAddress(),
                'fechaCreacion'=>$driverBEntity->getAuditoryInformation()->getCreatedDate()
            );
            $date=$driverBEntity->getAuditoryInformation()->getCreatedDate();
        }
        if($tipo=='editar'){
            $data=array(
                'identificador'=>$id,
                'nombre' => $driverBEntity->getName(),
                'apellidos'=>$driverBEntity->getLastName(),
                'telefono'=>$driverBEntity->getPhone(),
                'idVehiculo'=>$driverBEntity->getVehicleId(),
                'direccion'=>$driverBEntity->getAddress(),
                'fechaModificacion'=>$driverBEntity->getAuditoryInformation()->getModifiedDate()
            );
            $date=$driverBEntity->getAuditoryInformation()->getModifiedDate();
        }

        $parametros=array(
            'tipo'=>$tipo,
            'tabla'=>'Conductor',
            'fecha'=>$date,
            'usuario'=>$user
        );
        Mail::to('gps-adm-jnisi@hotmail.com','Administracion GPSJnisi')
            ->send(new ChangeManager($data,$parametros));
    }

    public static function changeManagerVehicle($vehicleBEntity,$tipo,$id,$user){
        $data=array();
        $date='';


        if($tipo=='crear'){
            $data=array(
                'identificador'=>$id,
                'placa'=> $vehicleBEntity->getPlaca(),
                'sn'=> $vehicleBEntity->getSn(),
                'shortNumber'=> $vehicleBEntity->getShortNumber(),
                'motorNumber'=> $vehicleBEntity->getMotorNumber(),
                'year'=> $vehicleBEntity->getYear(),
                'brandCar'=> $vehicleBEntity->getBrandCar(),
                'modelClass'=> $vehicleBEntity->getModelClass(),
                'chasisSerie'=> $vehicleBEntity->getChasisSerie(),
                'registerDate'=> $vehicleBEntity->getRegisterDate(),
                'comment'=> $vehicleBEntity->getComment(),
                'classCar'=> $vehicleBEntity->getClassCar(),
                'internalNumber'=> $vehicleBEntity->getInternalNumber(),
                'status'=> $vehicleBEntity->getStatus(),
                'telMov'=> $vehicleBEntity->getTelMov(),
                'telCla'=> $vehicleBEntity->getTelCla(),
                'telEmergency'=> $vehicleBEntity->getTelEmergency(),
                'createdDate'=> $vehicleBEntity->getAuditoryInformation()->getCreatedDate(),
                'sim'=> $vehicleBEntity->getSim(),
                'gpsId'=> $vehicleBEntity->getGpsId(),
                'mg'=> $vehicleBEntity->getMg(),
                'mandated'=> $vehicleBEntity->getMandated(),
                'personTelEmergency'=> $vehicleBEntity->getPersonTelEmergency(),
                'brandDevice'=> $vehicleBEntity->getBrandDevice(),
                'notInformationCel'=> $vehicleBEntity->getNotInformationCel(),
                'notInformationName'=> $vehicleBEntity->getNotInformationName(),
                'parkingplace'=> $vehicleBEntity->getParkingplace(),
                'customerId'=> $vehicleBEntity->getCustomerId()
            );
            $date=$vehicleBEntity->getAuditoryInformation()->getCreatedDate();
        }
        if($tipo=='editar'){
            $data=array(
                'identificador'=>$id,
                'placa'=> $vehicleBEntity->getPlaca(),
                'sn'=> $vehicleBEntity->getSn(),
                'shortNumber'=> $vehicleBEntity->getShortNumber(),
                'motorNumber'=> $vehicleBEntity->getMotorNumber(),
                'year'=> $vehicleBEntity->getYear(),
                'brandCar'=> $vehicleBEntity->getBrandCar(),
                'modelClass'=> $vehicleBEntity->getModelClass(),
                'chasisSerie'=> $vehicleBEntity->getChasisSerie(),
                'registerDate'=> $vehicleBEntity->getRegisterDate(),
                'comment'=> $vehicleBEntity->getComment(),
                'classCar'=> $vehicleBEntity->getClassCar(),
                'internalNumber'=> $vehicleBEntity->getInternalNumber(),
                'status'=> $vehicleBEntity->getStatus(),
                'telMov'=> $vehicleBEntity->getTelMov(),
                'telCla'=> $vehicleBEntity->getTelCla(),
                'telEmergency'=> $vehicleBEntity->getTelEmergency(),
                'modifiedDate'=> $vehicleBEntity->getAuditoryInformation()->getModifiedDate(),
                'sim'=> $vehicleBEntity->getSim(),
                'gpsId'=> $vehicleBEntity->getGpsId(),
                'mg'=> $vehicleBEntity->getMg(),
                'mandated'=> $vehicleBEntity->getMandated(),
                'personTelEmergency'=> $vehicleBEntity->getPersonTelEmergency(),
                'brandDevice'=> $vehicleBEntity->getBrandDevice(),
                'notInformationCel'=> $vehicleBEntity->getNotInformationCel(),
                'notInformationName'=> $vehicleBEntity->getNotInformationName(),
                'parkingplace'=> $vehicleBEntity->getParkingplace(),
                'customerId'=> $vehicleBEntity->getCustomerId()
            );
            $date=$vehicleBEntity->getAuditoryInformation()->getModifiedDate();
        }

        $parametros=array(
            'tipo'=>$tipo,
            'tabla'=>'Vehiculos',
            'fecha'=>$date,
            'usuario'=>$user,
        );
        Mail::to('gps-adm-jnisi@hotmail.com','Administracion GPSJnisi')
            ->send(new ChangeManager($data,$parametros));
    }

    public static function changeManagerMaintenance($maintenanceBEntity,$tipo,$id,$user){
        $data=array();
        $date='';

        if($tipo=='crear'){
            $data=array(
                'identificador'=>$id,
                'detalle' => $maintenanceBEntity -> getDetail(),
                'idVehiculo' => $maintenanceBEntity -> getVehicleId(),
                'fechaMantenimiento' => $maintenanceBEntity -> getMaintenanceDate(),
                'fechaCreacion' => $maintenanceBEntity -> getAuditoryInformation()->getCreatedDate()
            );
            $date=$maintenanceBEntity -> getAuditoryInformation()->getCreatedDate();
        }
        if($tipo=='editar'){
            $data=array(
                'identificador'=>$id,
                'detalle' => $maintenanceBEntity -> getDetail(),
                'idVehiculo' => $maintenanceBEntity -> getVehicleId(),
                'fechaMantenimiento' => $maintenanceBEntity -> getMaintenanceDate(),
                'fechaModificacion' => $maintenanceBEntity -> getAuditoryInformation()->getModifiedDate()
            );
            $date=$maintenanceBEntity -> getAuditoryInformation()->getModifiedDate();
        }

        $parametros=array(
            'tipo'=>$tipo,
            'tabla'=>'Mantenimiento',
            'fecha'=>$date,
            'usuario'=>$user
        );
        Mail::to('gps-adm-jnisi@hotmail.com','Administracion GPSJnisi')
            ->send(new ChangeManager($data,$parametros));
    }
    public static function changeManagerDetailMaintenance($detailMaintenanceBEntity,$tipo,$user){
        $data=array();
        $date='';

        if($tipo=='editar'){
            $data=array(
                'latches' => $detailMaintenanceBEntity -> getLatches(),
                'panic' => $detailMaintenanceBEntity -> getPanic(),
                'claxon' => $detailMaintenanceBEntity -> getClaxon(),
                'onOff' => $detailMaintenanceBEntity -> getOnOff(),
                'microphone' => $detailMaintenanceBEntity -> getMicrophone(),
                'detail' => $detailMaintenanceBEntity -> getDetail(),
                'modifiedDate' => $detailMaintenanceBEntity -> getAuditoryInformation()->getModifiedDate()
            );
            $date=$detailMaintenanceBEntity -> getAuditoryInformation()->getModifiedDate();
        }

        $parametros=array(
            'tipo'=>$tipo,
            'tabla'=>'Detalle de Mantenimiento',
            'fecha'=>$date,
            'usuario'=>$user
        );
        Mail::to('gps-adm-jnisi@hotmail.com','Administracion GPSJnisi')
            ->send(new ChangeManager($data,$parametros));
    }
    public static function createManagerDetailMaintenance($vehicleId,$createdDate,$tipo,$user){
        $data=array();
        $date='';

        if($tipo=='crear'){
            $data=array(
                'vehicleId' => $vehicleId,
                'createdDate' => $createdDate
            );
            $date=$createdDate;
        }

        $parametros=array(
            'tipo'=>$tipo,
            'tabla'=>'Detalle de Mantenimiento',
            'fecha'=>$date,
            'usuario'=>$user
        );
        Mail::to('gps-adm-jnisi@hotmail.com','Administracion GPSJnisi')
            ->send(new ChangeManager($data,$parametros));
    }
} 