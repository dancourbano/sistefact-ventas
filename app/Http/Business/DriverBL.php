<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:08
 */
namespace App\Http\Business;
use App\Http\Entities\ApplicationMessage;
use App\Http\Model\Driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DriverBL {
    public function all()
    {
        $driverBE = Driver::getDrivers();
        return  $driverBE;
    }
    public function getDriver($driverId)
    {
        $driverBE = Driver::find($driverId);
        return  $driverBE;
    }
    public function updateDriver($driverBEntity,$driverId)
    {
        try {
            //Iniciar Transacción

            $driverBEntity->getAuditoryInformation()
                ->setModifiedDate(date("Y-m-d H:i:s"));
            $driverBEntity->getAuditoryInformation()->setModifiedBy(Auth::user()->id);
            Driver::updateDriver($driverBEntity,$driverId);

            ApplicationMessage::setMessageDetail('Conductor actualizado correctamente.');
            CRUDManager::changeManagerDriver($driverBEntity,'editar',$driverId,Auth::user()->name);
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
    }
    public function createDriver($driverBEntity)
    {
        //Crear conductor

        $driverBEntity->getAuditoryInformation()
            ->setCreatedDate(date("Y-m-d H:i:s"));
        $driverBEntity->getAuditoryInformation()->setCreatedBy(Auth::user()->id);
        try {
            //Iniciar Transacción
            DB::beginTransaction();

            //Crear driver
            $id = Driver::createDriver($driverBEntity);
            //Confirmar Operación
            DB::commit();
            ApplicationMessage::setMessageDetail('Conductor creado correctamente.');
            CRUDManager::changeManagerDriver($driverBEntity,'crear',$id,Auth::user()->name);
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción
            DB::rollback();
        }
    }
    public function deleteDriver($driverId)
    {
        //eliminar Conductor

        try {
            Driver::deleteDriver($driverId);

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
    }
}