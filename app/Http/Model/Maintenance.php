<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Maintenance extends Model {

    protected $primaryKey = 'maintenanceId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $table = 'maintenance';

    public static function getMaintenances(){
        $maintenances = DB::table('maintenance')
            -> select(
                'maintenance.*',
                'vehicle.placa as placa')
            -> join('vehicle','vehicle.vehicleId','=','maintenance.vehicleId')
            -> get();

        return $maintenances;
    }

    public static function getMaintenancesByVehicleId($vehicleId){
        $maintenances = DB::table('maintenance')
            -> where('maintenance.vehicleId', $vehicleId)
            -> select('maintenance.*')
            -> get();

        return $maintenances;
    }

    public static function getMaintenance($maintenanceId){
        $maintenance = Maintenance::where('maintenanceId','=',$maintenanceId)
            -> select(
                'maintenance.*',
                'vehicle.placa as placa')
            -> join('vehicle','vehicle.vehicleId','=','maintenance.vehicleId')
            -> first();

        return $maintenance->toArray();
    }

    public static function createMaintenance($maintenanceBEntity){
        DB::table('maintenance')->insert(
            array(
                'detail' => $maintenanceBEntity -> getDetail(),
                'vehicleId' => $maintenanceBEntity -> getVehicleId(),
                'maintenanceDate' => $maintenanceBEntity -> getMaintenanceDate(),
                'createdDate' => $maintenanceBEntity -> getAuditoryInformation()->getCreatedDate(),
                'createdBy' => $maintenanceBEntity -> getAuditoryInformation()->getCreatedBy(),
                'status' => $maintenanceBEntity -> getStatus()
            )
        );
    }

    public static function updateMaintenance($maintenanceBEntity){
        DB::table('maintenance')
            ->where('maintenanceId',$maintenanceBEntity->getMaintenanceId())
            ->update(
                array(
                    'detail' => $maintenanceBEntity -> getDetail(),
                    'vehicleId' => $maintenanceBEntity -> getVehicleId(),
                    'maintenanceDate' => $maintenanceBEntity -> getMaintenanceDate(),
                    'modifiedDate' => $maintenanceBEntity -> getAuditoryInformation()->getModifiedDate(),
                    'modifiedBy' => $maintenanceBEntity -> getAuditoryInformation()->getModifiedBy(),
                    'status' => $maintenanceBEntity -> getStatus()
                )
            );
    }

    public static function deleteMaintenance($maintenanceId){
        DB::table('maintenance')
            ->where('maintenanceId', $maintenanceId)
            ->delete();
    }

    public static function filterMaintenanceByDate($startDate,$endDate){

        //SQL QUERY : select * from maintenance where createdDate BETWEEN..
    try{

            $query = Maintenance::query();

            // [1] SELECT *

                $query = $query -> select(
                        'maintenance.*',
                        'vehicle.placa as placa'
                        )
                        -> join('vehicle','vehicle.vehicleId','=','maintenance.vehicleId');

            // [2] WHERE maintenanceDate BETWEEN ...

                $query = $query -> whereBetween(DB::raw('DATE(maintenanceDate)'),[$startDate,$endDate]);

            // [3] ORDER BY maintenanceDate ASC

                $query = $query -> orderBy('maintenanceDate','ASC');

            $maintenancesFiltered = $query -> get();

            return $maintenancesFiltered;

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                          // Undo transaction
            return response()->json(ApplicationMessage::toArray());
        }

        
    }

}