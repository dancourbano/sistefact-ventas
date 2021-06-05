<?php

namespace App\Http\Business;
use \App\Http\Model\Maintenance;
use \App\Http\Entities;
use DB;
use App\Http\Entities\ApplicationMessage;
use Illuminate\Support\Facades\Auth;


class maintenanceBL {

    public function getMaintenances()
    {
        $maintenances = Maintenance::getMaintenances();
        return $maintenances;
    }

    public function getMaintenancesByVehicleId($vehicleId)
    {
        $maintenances = Maintenance::getMaintenancesByVehicleId($vehicleId);
        return $maintenances;
    }

    public function getMaintenance($maintenanceId)
    {
        $maintenance = Maintenance::getMaintenance($maintenanceId);
        return (array)$maintenance;
    }

    public function createMaintenance($maintenanceBEntity)
    {
        $maintenanceBEntity -> getAuditoryInformation()
            ->setCreatedDate(date("Y-m-d H:i:s"));
        $maintenanceBEntity->getAuditoryInformation()->setCreatedBy(Auth::user()->id);
        try {
            DB::beginTransaction();                             // Init transaction
            $maintenanceId = Maintenance::createMaintenance($maintenanceBEntity);            // Create maintenance
            DB::commit();                                       // Confirm operation
            CRUDManager::changeManagerMaintenance($maintenanceBEntity,'crear',$maintenanceId,Auth::user()->name);
            return $maintenanceId;
            ApplicationMessage::setMessageDetail('Creación correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function updateMaintenance($maintenanceBEntity)
    {
        $maintenanceBEntity->getAuditoryInformation()
            ->setModifiedDate(date("Y-m-d H:i:s"));
        $maintenanceBEntity->getAuditoryInformation()
            ->setModifiedBy(Auth::user()->id);
        try {
            DB::beginTransaction();                             // Init transaction
            Maintenance::updateMaintenance($maintenanceBEntity);            // Update maintenance
            DB::commit();                                       // Confirm operation
            CRUDManager::changeManagerMaintenance($maintenanceBEntity,'editar',$maintenanceBEntity->getMaintenanceId(),Auth::user()->name);
            ApplicationMessage::setMessageDetail('Actualizacion correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function deleteMaintenance($maintenanceId)
    {
        try {
            DB::beginTransaction();                             // Init transaction
            Maintenance::deleteMaintenance($maintenanceId);     // Delete maintenance
            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Eliminacion correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function filterMaintenanceByDate($parameters)
    {
        try {
            $startDate = $parameters['startDate'];
            $endDate = $parameters['endDate'];

            $maintenancesFiltered = Maintenance::filterMaintenanceByDate($startDate,$endDate);
            return $maintenancesFiltered;
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
        
    }

}