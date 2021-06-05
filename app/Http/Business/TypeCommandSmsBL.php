<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:08
 */
namespace App\Http\Business;
use App\Http\Entities\ApplicationMessage;
use App\Http\Model\TypeCommandSms;
use App\Http\Model\CommandSms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TypeCommandSmsBL {
    public function all()
    {
        $typeCommandSmsBE = TypeCommandSms::all();
        return  $typeCommandSmsBE;
    }
    public function getTypeCommandSms($typeCommandSmsId)
    {
        $typeCommandSmsBE = TypeCommandSms::find($typeCommandSmsId);
        return  $typeCommandSmsBE;
    }
    public function updateTypeCommandSms($driverBEntity,$typeCommandSmsId)
    {
        try {
            //Iniciar Transacción

             
            TypeCommandSms::updateTypeCommandSms($driverBEntity,$typeCommandSmsId);

            ApplicationMessage::setMessageDetail('Tipo de Comando actualizados correctamente.');
            CRUDManager::changeManagerDriver($driverBEntity,'editar',$typeCommandSmsId,Auth::user()->name);
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
    }
    public function createTypeCommandSms($driverBEntity)
    {
        //Crear conductor

         
        try {
            //Iniciar Transacción
            DB::beginTransaction();

            //Crear driver
            $id = TypeCommandSms::createTypeCommandSms($driverBEntity);
            //Confirmar Operación
            DB::commit();
            ApplicationMessage::setMessageDetail('Tipo de Comando creado correctamente.');
            CRUDManager::changeManagerDriver($driverBEntity,'crear',$id,Auth::user()->name);
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción
            DB::rollback();
        }
    }
    public function deleteTypeCommandSms($driverId)
    {
        //eliminar Conductor

        try {
            Driver::deleteTypeCommandSms($driverId);

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
    }
     
    public function getAllCommandSmsByType($typeCommandSmsId){
    	
            $commandSms = CommandSms::getCommandByTypeId($typeCommandSmsId);
            return $commandSms;
            
            
    }
    public function getCommandSms($commandSmsId)
    {
        $commandSmsBE = CommandSms::find($commandSmsId);
        return  $commandSmsBE;
    }
    public function updateCommandSms($commandSmsBEntity,$commandSmsId)
    {
        try {
            //Iniciar Transacción

             
            CommandSms::updateCommandSms($commandSmsBEntity,$commandSmsId);

            ApplicationMessage::setMessageDetail('Tipo de Comando actualizados correctamente.');
            //CRUDManager::changeManagerDriver($driverBEntity,'editar',$typeCommandSmsId,Auth::user()->name);
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
    }
    public function createCommandSms($commandSmsBEntity)
    {
        //Crear conductor

         
        try {
            //Iniciar Transacción
            DB::beginTransaction();

            //Crear driver
            $id = CommandSms::createCommandSms($commandSmsBEntity);
            //Confirmar Operación
            DB::commit();
            ApplicationMessage::setMessageDetail('Tipo de Comando creado correctamente.');
            //CRUDManager::changeManagerDriver($driverBEntity,'crear',$id,Auth::user()->name);
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción
            DB::rollback();
        }
    }
    public function deleteCommandSms($commandSmsId)
    {
        //eliminar Conductor

        try {
            CommandSms::deleteCommandSms($commandSmsId);

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
    }
}