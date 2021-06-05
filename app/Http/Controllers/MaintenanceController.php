<?php
/**
 * User: Oscar
 * Date: 11/11/16
 * Time: 17:00 PM
 */

namespace App\Http\Controllers;
use Redirect;
use Schema;
use App\Http\Business\MaintenanceBL;
use App\Http\Business\VehicleBL;
use App\Http\Entities\MaintenanceBusinessEntity;
use App\Http\Entities\ApplicationMessage;
use Illuminate\Http\Request;

class MaintenanceController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $MaintenanceBL = new MaintenanceBL();
        $maintenances = $MaintenanceBL -> getMaintenances();
        return view('maintenance.index')
            -> with(compact('maintenances'));
    }

    public function getMaintenances($vehicleId){
        $MaintenanceBL = new MaintenanceBL();
        $maintenances = $MaintenanceBL -> getMaintenancesByVehicleId($vehicleId);
        return $maintenances; 
    }

    public function create($vehicleId)
    {
        $VehicleBL = new VehicleBL();
        $VehicleData = $VehicleBL->getVehicle($vehicleId);

        $dataMaintenance = array(
            'maintenanceId' => 0,
            'vehicleId' => $vehicleId,
            'detail' => '',
            'placa' => $VehicleData['placa'],
            'maintenanceDate' => '',
            'status' => 0
        );

        $action = 'create';
        return view('maintenance.maintenance')
            -> with(compact('action','dataMaintenance'));
    }

    public function edit($maintenanceId)
    {
        $MaintenanceBL = new MaintenanceBL();
        $dataMaintenance = $MaintenanceBL -> getMaintenance($maintenanceId);
        $action = 'edit';

        return view('maintenance.maintenance')
            -> with(compact('action','dataMaintenance'));
    }

    public function delete($maintenanceId)
    {
        $MaintenanceBL = new MaintenanceBL();
        $MaintenanceBL -> deleteMaintenance($maintenanceId);

        return redirect()->action('VehicleController@index');
    }

    public function sendDataMaintenance($action,Request $request)
    {
        try {
            $maintenanceBEntity = new MaintenanceBusinessEntity();
            $maintenanceBEntity -> setAllFromDataRowHTTPBase($request->all());

            $MaintenanceBL = new MaintenanceBL();

            if ($action == "create") {
                $MaintenanceBL -> createMaintenance($maintenanceBEntity);
                ApplicationMessage::setMessageDetail('Mantenimiento creado correctamente.');
            }

            if ($action == "edit") {
                $MaintenanceBL -> updateMaintenance($maintenanceBEntity);
                ApplicationMessage::setMessageDetail('Mantenimiento editado correctamente.');
            }

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
        }
        return response()->json(ApplicationMessage::toArray());
    }

    public function filterMaintenance1(Request $request){

        try {
            $parameters = $request->all();                      // Receive the data from the ajax request
            $MaintenanceBL = new MaintenanceBL();                     // To processing data by parameters

           return $MaintenanceBL -> filterMaintenanceByDate($parameters); // Finally return the data filtered

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
            return response()->json(ApplicationMessage::toArray());
        }


    }
}