<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:06
 */


namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class Driver extends Model {

    protected $primaryKey = 'driverId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */


    protected $table    = 'driver';

    public static function getDrivers(){
        $drivers = DB::table('driver')
            -> select(
                'driver.*',
                'vehicle.placa as placa'
            )
            -> join('vehicle','driver.vehicleId','=','vehicle.vehicleId')
            -> get();

        return $drivers;
    }

    public static function createDriver($driverBEntity){
        $id=DB::table('driver')->insertGetId(
            array(
                'name' => $driverBEntity->getName(),
                'lastName'=>$driverBEntity->getLastName(),
                'phone'=>$driverBEntity->getPhone(),
                'vehicleId'=>$driverBEntity->getVehicleId(),
                'address'=>$driverBEntity->getAddress(),
                'identification'=>$driverBEntity->getIdentification(),
                'createdDate'=>$driverBEntity->getAuditoryInformation()->getCreatedDate(),
                'createdBy'=>$driverBEntity->getAuditoryInformation()->getCreatedBy()
            )
        );
    }
    public static function updateDriver($driverBEntity,$driverId){
        $result =  DB::table('driver')
            ->where('driverId',$driverId)
            ->update(
                array(
                    'name' => $driverBEntity->getName(),
                    'lastName'=>$driverBEntity->getLastName(),
                    'phone'=>$driverBEntity->getPhone(),
                    'vehicleId'=>$driverBEntity->getVehicleId(),
                    'address'=>$driverBEntity->getAddress(),
                    'identification'=>$driverBEntity->getIdentification(),
                    'modifiedDate'=>$driverBEntity->getAuditoryInformation()->getModifiedDate(),
                    'modifiedBy'=>$driverBEntity->getAuditoryInformation()->getModifiedBy()
                )
            );
        //return $result;
    }
    public static function deleteDriver($driverId){
        DB::table('driver')
            ->where('driverId', $driverId)
            ->delete();
    }




}