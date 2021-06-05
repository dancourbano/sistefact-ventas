<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CommandSms extends Model {

    protected $primaryKey = 'typeCommandSmsId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $table = 'typecommandsms';

    public static function getTypes(){
        $phonesSms = DB::table('typecommandsms')
            -> select('typecommandsms.*')
            -> get();

        return $phonesSms;
    }

     
    public static function getTypeCommandSmsById($typeCommandSmsId){
        $phone = DB::table('typecommandsms')
            -> where('typeCommandSmsId','=',$typeCommandSmsId)
            -> select('typecommandsms.*')
            -> get();

        return $phone->toArray();
    }
     public static function createTypeCommandSms($typeCommandSmsBEntity){
        DB::table('typecommandsms')
            ->insert(
                array(
                    'type' => $typeCommandSmsBEntity -> getType(),                    
                    'status'=> $typeCommandSmsBEntity -> getStatus()
                )
            );
    }
    public static function updateTypeCommandSms($typeCommandSmsBEntity){
        DB::table('typecommandsms')
            ->where('typeCommandSmsId',$typeCommandSmsBEntity->getTypeCommandSmsId())
            ->update(
                array(                     
                    'type' => $typeCommandSmsBEntity -> getType(),
                    'status' => $typeCommandSmsBEntity -> getStatus()
                )
            );
    }


    public static function getCommandByTypeId($typeCommandSmsId){
        $sql= DB::table('commandsms as cs')
            ->select('cs.*')             
            ->where('typeCommandSmsId',"=",$typeCommandSmsId)
            ->get();
        return $sql;
    }

    public static function createComandSms($commandSmsBEntity){
        DB::table('commandsms')
            ->insert(
                array(
                    'name' => $cCommandSmsBEntity -> getName(),                    
                    'typeCommandSmsId'=> $commandSmsBEntity -> getTypeCommandSmsId(),
                    'orderCommand'=>$commandSmsBEntity ->getOrderCommand()
                )
            );
    }

    public static function updateCommandSms($commandSmsBEntity){
        DB::table('commandsms')
            ->where('commandSmsId',$commandSmsBEntity->getCommandSmsId())
            ->update(
                array(                     
                    'name' => $commandSmsBEntity -> getName(),
                    'typeCommandSmsId' => $commandSmsBEntity -> getTypeCommandSmsId(),
                    'orderCommand'=>$commandSmsBEntity ->getOrderCommand()
                )
            );
    }

    public static function deleteTypeCommandSms($typeCommandSmsId){
        DB::table('typecommandsms')
            ->where('typeCommandSmsId', $typeCommandSmsId)
            ->delete();
    }

    public static function deleteCommandSms($commandSmsId){
        DB::table('commandsms')
            ->where('commandSmsId', $commandSmsId)
            ->delete();
    }

}