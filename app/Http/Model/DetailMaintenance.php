<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class DetailMaintenance extends Model {

    protected $primaryKey = 'detailmaintenanceId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $table = 'detailmaintenance';

    public static function getDetailMaintenances(){
        $detailMaintenances = DB::table('detailmaintenance')
            -> select(
                'detailmaintenance.*',
                'vehicle.placa as placa')
            -> join('vehicle','vehicle.vehicleId','=','detailmaintenance.vehicleId')
            -> get();

        return $detailMaintenances;
    }

    public static function getDetailMaintenanceByVehicleId($vehicleId){
        $detailMaintenance = DB::table('detailmaintenance')
            -> where('detailmaintenance.vehicleId', $vehicleId)
            -> select('detailmaintenance.*')
            -> get();

        return $detailMaintenance;
    }

    public static function getDetailMaintenance($detailmaintenanceId){
        $detailMaintenance = DetailMaintenance::where('detailmaintenanceId','=',$detailmaintenanceId)
            -> select(
                'detailmaintenance.*',
                'vehicle.placa as placa')
            -> join('vehicle','vehicle.vehicleId','=','detailmaintenance.vehicleId')
            -> first();

        return $detailMaintenance->toArray();
    }

    public static function createDetailMaintenance($vehicleId, $createdDate,$createdBy){
        DB::table('detailmaintenance')->insert(
            array(
                'vehicleId' => $vehicleId,
                'createdDate' => $createdDate,
                'modifiedDate' => $createdDate,
                'createdBy' => $createdBy
            )
        );
    }

    // To create detailMaintenance for vehicles that are already registered and doesn't have their detailManteinance

    /*
    
        drop function if exists createDetailMaintenanceForVehicles;
        delimiter %

        create function createDetailMaintenanceForVehicles()
            returns varchar(50)
            begin
                DECLARE done INT DEFAULT FALSE;
                declare _vehicleId int;
                declare vehicleCursor cursor for select vehicleId from vehicle;
                DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
                
                open vehicleCursor;
                
                    bucle1: loop
                    
                        fetch vehicleCursor into _vehicleId;
                        
                        if done then 
                            leave bucle1; 
                        end if; 
                        
                        insert into detailmaintenance(vehicleId,createdDate,modifiedDate) values(_vehicleId,now(),now());
                        
                    end loop;
                    
                close vehicleCursor;
                
                return "Detalles de mantinimientos creados";
            
            end; %
        delimiter ;

        select createDetailMaintenanceForVehicles();
    
    */

    public static function updateDetailMaintenance($detailMaintenanceBEntity){
        DB::table('detailmaintenance')
            ->where('detailmaintenanceId',$detailMaintenanceBEntity->getDetailMaintenanceId())
            ->update(
                array(
                    'latches' => $detailMaintenanceBEntity -> getLatches(),
                    'panic' => $detailMaintenanceBEntity -> getPanic(),
                    'claxon' => $detailMaintenanceBEntity -> getClaxon(),
                    'onOff' => $detailMaintenanceBEntity -> getOnOff(),
                    'microphone' => $detailMaintenanceBEntity -> getMicrophone(),
                    'detail' => $detailMaintenanceBEntity -> getDetail(),
                    'modifiedDate' => $detailMaintenanceBEntity -> getAuditoryInformation()->getModifiedDate(),
                    'modifiedBy' => $detailMaintenanceBEntity -> getAuditoryInformation()->getModifiedBy()
                )
            );
    }

    public static function deleteDetailMaintenance($vehicleId){
        DB::table('detailmaintenance')
            ->where('detailmaintenance.vehicleId', $vehicleId)
            ->delete();
    }

}