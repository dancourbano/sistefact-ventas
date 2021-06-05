<?php

namespace App\Http\Business;
use \App\Http\Model\CommandSms;
use \App\Http\Entities\UsersBusinessEntity;
use App\Http\Entities\ApplicationMessage;
use Illuminate\Support\Facades\DB;
use \App\Http\Model\VehicleOutdated;
use Illuminate\Support\Facades\Auth;
class SmsSendBL {
    public function all()
    {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0MjQ3OTQwMywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY0MjMxLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.8Hd-fP9TnsCU4QUHgJgGWezv-fAT-Sy4L8PYWxUA9yI';
    $phone_number = "+51950933191";
    
    $message = "Test 1";
     
    $deviceID = 105480;
    $options = [];

    $smsGateway = new SmsGateway($token);
    //$result = $smsGateway->sendMessageToNumber($phone_number, $message, $deviceID, $options);
 
            $vehicleOutdatedBE = VehicleOutdated::allVehicle();
        return  $vehicleOutdatedBE;
    }

    public function sendCommandSMS()
    {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0MjQ3OTQwMywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY0MjMxLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.8Hd-fP9TnsCU4QUHgJgGWezv-fAT-Sy4L8PYWxUA9yI';
        $phone_number = "+51955057875";    
        $message = "Test 2";     
        $deviceID = 105480;
        $options = [];
        $smsGateway = new SmsGateway($token);
        $result = $smsGateway->sendMessageToNumber($phone_number, $message, $deviceID, $options);
        //$messageId=$result['response'][0]['id'];
        //$messageString=$smsGateway->searchMessage();
        
       //print_r($messageString);
        return  $result;
    }

    public function allTypeCommandSMS()
    {
        $typeCommandSmsBE = CommandSms::all();
        return  $typeCommandSmsBE;
    }

    public function getVehicleOutdated($vehicleId)
    {
        $vehicleOutdatedBE = VehicleOutdated::find($vehicleId);
        return  $vehicleOutdatedBE;
    }

    public function updateVehicle($vehicleBEntity)
    {
        try {
        DB::beginTransaction();
            //Instanciar Entity indicando el tipo Customer


            //Crear Customer
            VehicleOutdated::updateVehicle($vehicleBEntity);
            //Confirmar Operación
            DB::commit();
            ApplicationMessage::setMessageDetail('Vehiculo actualizado correctamente.');
             
            
         } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción
            DB::rollback();
        }
        return ApplicationMessage::toArray();
    }
    public function createVehicle($vehicleBEntity)
    {
         try {
        DB::beginTransaction();
            //Instanciar Entity indicando el tipo Customer


            //Crear Customer
            $id = VehicleOutdated::createVehicle($vehicleBEntity);
            //Confirmar Operación
            DB::commit();
            ApplicationMessage::setMessageDetail('Vehiculo creado correctamente.');
             
            return $id;
         } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción
            DB::rollback();
        }
        return ApplicationMessage::toArray();
    }
    public function deleteVehicle($vehicleId)
    {
        //Crear Cliente


        try {
            VehicleOutdated::deleteVehicle($vehicleId);

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
        return ApplicationMessage::toArray();
    }
     
}