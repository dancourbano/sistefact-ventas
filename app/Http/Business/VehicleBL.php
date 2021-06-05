<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 14/10/2016
 * Time: 10:21
 */

namespace App\Http\Business;
use \App\Http\Model\Vehicle;
use \App\Http\Entities\VehicleBusinessEntity;
use App\Http\Entities\ApplicationMessage;
use DB;
use Illuminate\Support\Facades\Auth;



class VehicleBL {
    public function all()
    {
        $customerBE = Vehicle::allVehicle();
        return  $customerBE;
    }
    public function allActives()
    {
        $customerBE = Vehicle::AllActives();
        return  $customerBE;
    }
    public function history()
    {
        $customerBE = Vehicle::history();
        return  $customerBE;
    }
    public function getVehicle($vehicleId)
    {
        $vehicleBE = Vehicle::find($vehicleId);
        return  $vehicleBE;
    }
    public function getLastShortNumberVehicle()
    {
        $vehicleBE = Vehicle::getLastShortNumber();
        return  $vehicleBE->shortNumber;
    }
    public function updateVehicle($vehicleBEntity)
    {
        try {
            //Iniciar Transacción

            //Log::info(Input::get('name'));
            //Log::info(Input::get('customerId'));
            $vehicleBEntity->getAuditoryInformation()
                ->setModifiedDate(date("Y-m-d H:i:s"));
            $vehicleBEntity->getAuditoryInformation()
                ->setModifiedBy(Auth::user()->id);

            Vehicle::updateVehicle($vehicleBEntity);
            CRUDManager::changeManagerVehicle($vehicleBEntity,'editar',$vehicleBEntity->getVehicleId(),Auth::user()->name);
            if($vehicleBEntity->getStatus()==0){
                $vehicleBEntity->setHistoryId($vehicleBEntity->getVehicleId());
                $vehicleBEntity->getAuditoryInformation()
                    ->setCreatedDate(date("Y-m-d H:i:s"));
                $vehicleBEntity->getAuditoryInformation()
                    ->setCreatedBy(Auth::user()->id);
                Vehicle::createVehicle($vehicleBEntity);
            }
            ApplicationMessage::setMessageDetail('Cliente actualizado correctamente.');
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
        return ApplicationMessage::toArray();
    }
    public function createVehicle($vehicleBEntity)
    {
        //Crear Cliente

        $vehicleBEntity->getAuditoryInformation()
            ->setCreatedDate(date("Y-m-d H:i:s"));
        $vehicleBEntity->getAuditoryInformation()
            ->setCreatedBy(Auth::user()->id);

        try {
            //Iniciar Transacción
            DB::beginTransaction();
            //Instanciar Entity indicando el tipo Customer


            //Crear Customer
            $id = Vehicle::createVehicle($vehicleBEntity);
            //Confirmar Operación
            DB::commit();
            ApplicationMessage::setMessageDetail('Cliente creado correctamente.');
            CRUDManager::changeManagerVehicle($vehicleBEntity,'crear',$id,Auth::user()->name);
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
            Vehicle::deleteVehicle($vehicleId);

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
        return ApplicationMessage::toArray();
    }

    public function getVehiclesOfCustomer($customerId)
    {
            $data=array();
        try {
            $data=Vehicle::getVehiclesOfCustomer($customerId);

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
        return $data;
    }
    public function getInformationOfContact($vehicleId){
        $data=array();
        try {
            $data=Vehicle::getInformationOfContact($vehicleId);

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
        return $data;
    }
}