<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Phone extends Model {

    protected $primaryKey = 'phoneId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $table = 'phone';

    public static function getPhones(){
        $phones = DB::table('phone')
            -> select('phone.*')
            -> get();

        return $phones;
    }

    public static function getPhonesByVehicleId($vehicleId){
        $phones = DB::table('phone')
            -> where('phone.vehicleId', $vehicleId)
            -> select('phone.*')
            -> get();

        return $phones;
    }

    public static function getPhone($phoneId){
        $phone = DB::table('phone')
            -> where('phoneId','=',$phoneId)
            -> select('phone.*')
            -> get();

        return $phone->toArray();
    }

    public static function createPhone($phoneBEntity){
        DB::table('phone')
            ->insert(
                array(
                    'name' => $phoneBEntity -> getName(),
                    'dni' => $phoneBEntity -> getDni(),
                    'phone' => $phoneBEntity -> getPhone(),
                    'vehicleId'=> $phoneBEntity -> getVehicleId()
                )
            );
    }

    public static function updatePhone($phoneBEntity){
        DB::table('phone')
            ->where('phoneId',$phoneBEntity->getPhoneId())
            ->update(
                array(
                    'dni' => $phoneBEntity -> getDni(),
                    'name' => $phoneBEntity -> getName(),
                    'phone' => $phoneBEntity -> getPhone()
                )
            );
    }

    public static function deletePhone($phoneId){
        DB::table('phone')
            ->where('phoneId', $phoneId)
            ->delete();
    }

    public static function deletePhonesByVehicleId($vehicleId){
        DB::table('phone')
            ->where('vehicleId', $vehicleId)
            ->delete();
    }

}