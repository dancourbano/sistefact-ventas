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



class VehicleOutdated extends Model {

    protected $primaryKey = 'vehicleId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */


    protected $table    = 'vehicleoutdated';
    public static function allVehicle(){

         $vehicles = DB::table('vehicleoutdated')
            -> select('vehicleoutdated.*')
            -> get();
        return $vehicles;
    }
   
    
    
    public static function createVehicle($vehicleBEntity){
        $vehicleId=DB::table('vehicleoutdated')->insertGetId(
            array(
                
                'placa'=> $vehicleBEntity->getPlaca(),
                'phone'=> $vehicleBEntity->getPhone(),                 
                'typeCommandSmsId'=> $vehicleBEntity->getTypeCommandSmsId()
            )
        );

        
        return $vehicleId;
    }
    public static function updateVehicle($vehicleBEntity){
        $result =  DB::table('vehicleoutdated')
            ->where('vehicleId',$vehicleBEntity->getVehicleId())
            ->update(
                array(

                    'placa'=> $vehicleBEntity->getPlaca(),
                    'phone'=> $vehicleBEntity->getPhone(),
                    'typeCommandSmsId'=> $vehicleBEntity->getTypeCommandSmsId()
                )
            );
        return $result;
    }

    public static function deleteVehicle($idVehicle){
         

        DB::table('vehicleoutdated')
            ->where('vehicleoutdated.vehicleId', $idVehicle)
            ->delete();
    }

    

     
}