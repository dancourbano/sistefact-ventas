<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:06
 */


namespace App\Http\Model;

use App\Http\Business\CRUDManager;
use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;



class Vehicle extends Model {

    protected $primaryKey = 'vehicleId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */


    protected $table    = 'vehicle';
    public static function allVehicle(){

        $sql= DB::table('vehicle as v')
            ->select('v.*','c.name as customerName','c.lastName as customerLastName')
            ->join('customer as c', 'v.customerId', '=', 'c.customerId')
            ->where('historyId',"=",Null)
            ->get();
        return $sql;
    }
    public static function history(){

        $sql= DB::table('vehicle as v')
            ->select('v.*','c.name as customerName','c.lastName as customerLastName')
            ->join('customer as c', 'v.customerId', '=', 'c.customerId')
            ->where('historyId',"!=",Null)
            ->get();
        return $sql;
    }
    public static function AllActives(){

        $sql= DB::table('vehicle as v')
            ->select('v.*','c.name as customerName','c.lastName as customerLastName')
            ->join('customer as c', 'v.customerId', '=', 'c.customerId')
            ->where('status',"!=",0)
            ->get();
        return $sql;
    }
    public static function getLastShortNumber(){
        return DB::table('vehicle')
            ->select('vehicle.shortNumber')
            ->where('status',1)
            ->orderBy('vehicle.shortNumber', 'desc')->first();

    }
    public static function createVehicle($vehicleBEntity){
        $vehicleId=DB::table('vehicle')->insertGetId(
            array(
                
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
                'createdBy'=> $vehicleBEntity->getAuditoryInformation()->getCreatedBy(),
                'sim'=> $vehicleBEntity->getSim(),
                'gpsId'=> $vehicleBEntity->getGpsId(),
                'mg'=> $vehicleBEntity->getMg(),
                'mandated'=> $vehicleBEntity->getMandated(),
                'personTelEmergency'=> $vehicleBEntity->getPersonTelEmergency(),
                'brandDevice'=> $vehicleBEntity->getBrandDevice(),
                'notInformationCel'=> $vehicleBEntity->getNotInformationCel(),
                'notInformationName'=> $vehicleBEntity->getNotInformationName(),
                'parkingplace'=> $vehicleBEntity->getParkingplace(),
                'customerId'=> $vehicleBEntity->getCustomerId(),
                'historyId'=> $vehicleBEntity->getHistoryId()
            )
        );

        // Creation of detailMaintenance for this car

        DetailMaintenance::createDetailMaintenance($vehicleId,$vehicleBEntity->getAuditoryInformation()->getCreatedDate(),$vehicleBEntity->getAuditoryInformation()->getCreatedBy());
        CRUDManager::createManagerDetailMaintenance($vehicleId,$vehicleBEntity->getAuditoryInformation()->getCreatedDate(),'crear',Auth::user()->name);
        return $vehicleId;
    }
    public static function updateVehicle($vehicleBEntity){
        $result =  DB::table('vehicle')
            ->where('vehicleId',$vehicleBEntity->getVehicleId())
            ->update(
                array(

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
                    'modifiedBy'=> $vehicleBEntity->getAuditoryInformation()->getModifiedBy(),
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
                )
            );
        return $result;
    }

    public static function deleteVehicle($idVehicle){
        DB::table('maintenance')
            ->where('maintenance.vehicleId', $idVehicle)
            ->delete();

        Phone::deletePhonesByVehicleId($idVehicle);

        DetailMaintenance::deleteDetailMaintenance($idVehicle);

        DB::table('vehicle')
            ->where('vehicle.vehicleId', $idVehicle)
            ->delete();
    }

    public static function getVehiclesOfCustomer($customerId){
        $sql= DB::table('vehicle')
                ->select(
                    'vehicle.placa',
                    'vehicle.brandCar',
                    'vehicle.modelClass',
                    'vehicle.customerId',
                    'vehicle.vehicleId'
                )
                ->where('vehicle.customerId','=',$customerId)
                ->get();

    return $sql;
    }

    public static function getInformationOfContact($vehicleId){
        $customer= DB::table('vehicle')
            ->select(
                'customer.name as customerName',
                'customer.lastName as customerLastName',
                'customer.phone1 as customerPhone1',
                'customer.phone2 as customerPhone2'
            )
            ->where('vehicle.vehicleId','=',$vehicleId)
            ->join('customer', 'vehicle.customerId', '=', 'customer.customerId')
            ->get();

        $driver= DB::table('vehicle')
            ->select(
                'driver.name as driverName',
                'driver.lastName as driverLastName',
                'driver.phone as driverPhone'
            )
            ->where('vehicle.vehicleId','=',$vehicleId)
            ->join('driver', 'vehicle.vehicleId', '=', 'driver.vehicleId')
            ->get();

        $vehicle= DB::table('vehicle')
            ->select(
                'vehicle.mandated',
                'vehicle.telMov as mandatedMov',
                'vehicle.telCla as mandatedCla',
                'vehicle.personTelEmergency',
                'vehicle.telEmergency',
                'vehicle.customerId'
            )
            ->where('vehicle.vehicleId','=',$vehicleId)
            ->get();


        $phones = DB::table('phone')
            -> select(
                    '*'
                )
            -> where('phone.vehicleId','=',$vehicleId)
            -> get();
            
        $data=array(
            'customer' => $customer,
            'driver'=>$driver,
            'vehicle'=>$vehicle,
            'phones' => $phones 
        );

        return $data;
    }
}