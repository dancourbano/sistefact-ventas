<?php

namespace App\Http\Business;

use \App\Http\Model\Phone;
use \App\Http\Entities;
use DB;
use App\Http\Entities\ApplicationMessage;

class PhoneBL {
    public function all()
    {
        $phones = Phone::getPhones();
        return  $phones;
    }

    public function getPhonesByVehicleId($vehicleId)
    {
        $phones = Phone::getPhonesByVehicleId($vehicleId);
        return $phones;
    }

    public function getPhone($phoneId)
    {
        $phone = Phone::getPhone($phoneId);
        return (array)$phone;
    }

    public function createPhone($phoneBEntity)
    {
        try {
            DB::beginTransaction();                             // Init transaction
            Phone::createPhone($phoneBEntity);                  // Create phone
            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Creación correcta.');
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function updatePhone($phoneBEntity)
    {
        try {
            DB::beginTransaction();                             // Init transaction
            Phone::updatePhone($phoneBEntity);                  // Update phone
            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Actualización correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function deletePhone($phoneId)
    {
        try {
            DB::beginTransaction();                             // Init transaction
            Phone::deletePhone($phoneId);                       // Delete phone
            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Eliminación correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

}