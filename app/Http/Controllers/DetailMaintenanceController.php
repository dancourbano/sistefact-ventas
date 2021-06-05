<?php
/**
 * User: Oscar
 * Date: 06/12/16
 * Time: 01:14 PM
 */

namespace App\Http\Controllers;
use Redirect;
use Schema;
use App\Http\Business\DetailMaintenanceBL;
use App\Http\Business\VehicleBL;
use App\Http\Entities\DetailMaintenanceBusinessEntity;
use App\Http\Entities\ApplicationMessage;
use Illuminate\Http\Request;

class DetailMaintenanceController extends Controller {

    public function getDetailMaintenance($vehicleId){
        $DetailMaintenanceBL = new DetailMaintenanceBL();
        $detailMaintenance = $DetailMaintenanceBL -> getDetailMaintenanceByVehicleId($vehicleId);
        return $detailMaintenance;
    }

    public function edit($detailMaintenanceId)
    {
        $DetailMaintenanceBL = new DetailMaintenanceBL();
        $dataDetailMaintenance = $DetailMaintenanceBL -> getDetailMaintenance($detailMaintenanceId);
        $action = 'edit';

        return view('detailmaintenance.detailMaintenance')
            -> with(compact('action','dataDetailMaintenance'));
    }

    public function sendDataDetailMaintenance($action,Request $request)
    {
        try {
            $detailMaintenanceBEntity = new DetailMaintenanceBusinessEntity();
            $detailMaintenanceBEntity -> setAllFromDataRowHTTPBase($request->all());

            $DetailMaintenanceBL = new DetailMaintenanceBL();

            if ($action == "edit") {
                $DetailMaintenanceBL -> updateDetailMaintenance($detailMaintenanceBEntity);
                ApplicationMessage::setMessageDetail('Detalle de Mantenimiento editado correctamente.');
            }

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
        }
        return response()->json(ApplicationMessage::toArray());
    }
}