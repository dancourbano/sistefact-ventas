<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class TypeCommandSms extends Model {

    protected $primaryKey = 'typeCommandSmsId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $table = 'typeCommandSms';

     

    

    public static function createTypeCommandSms($typeCommandSmsBEntity){
        $typeCommandSmsId = DB::table('typeCommandSms')->insertGetId(
            array(
                'type' => $typeCommandSmsBEntity -> getType(),
                'status' => $typeCommandSmsBEntity -> getStatus()
                
            )
        );

        return $typeCommandSmsId;
    }
    
     
    public static function updateTypeCommandSms($typeCommandSmsBEntity){
        DB::table('typeCommandSms')
            ->where('typeCommandSmsId',$typeCommandSmsBEntity->getTypeCommandSmsId())
            ->update(
                array(
                    'type' => $typeCommandSmsBEntity -> getType(),
                    'status' => $typeCommandSmsBEntity -> getStatus(),
                     
                )
            );
    }

    public static function deleteTypeCommandSms($typeCommandSmsId){
        DB::table('typeCommandSms')
            ->where('typeCommandSmsId', $typeCommandSmsId)
            ->delete();
    }

}