<?php

namespace App\Http\Business;
use \App\Http\Model\DetailMaintenance;
use \App\Http\Entities;
use DB;
use App\Http\Entities\ApplicationMessage;
use Illuminate\Support\Facades\Auth;


class detailMaintenanceBL {

    public function getDetailMaintenances()
    {
        $detailMaintenances = DetailMaintenance::getDetailMaintenances();
        return $detailMaintenances;
    }

    public function getDetailMaintenanceByVehicleId($vehicleId)
    {
        $detailMaintenance = DetailMaintenance::getDetailMaintenanceByVehicleId($vehicleId);
        return $detailMaintenance;
    }

    public function getDetailMaintenance($detailMaintenanceId)
    {
        $detailMaintenance = DetailMaintenance::getDetailMaintenance($detailMaintenanceId);
        return (array)$detailMaintenance;
    }

    public function updateDetailMaintenance($detailMaintenanceBEntity)
    {
        $detailMaintenanceBEntity->getAuditoryInformation()
            ->setModifiedDate(date("Y-m-d H:i:s"));
        $detailMaintenanceBEntity->getAuditoryInformation()->setModifiedBy(Auth::user()->id);

        try {
            DB::beginTransaction();                             // Init transaction
            DetailMaintenance::updateDetailMaintenance($detailMaintenanceBEntity);            // Update detaildetailMaintenance
            DB::commit();                                       // Confirm operation
            CRUDManager::changeManagerDetailMaintenance($detailMaintenanceBEntity,'editar',$detailMaintenanceBEntity->getDetailMaintenanceId(),Auth::user()->name);
            ApplicationMessage::setMessageDetail('Actualizacion correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function deleteDetailMaintenance($detailMaintenanceId)
    {
        try {
            DB::beginTransaction();                             // Init transaction
            DetailMaintenance::deleteDetailMaintenance($detailMaintenanceId);     // Delete detaildetailMaintenance
            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Eliminacion correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

}