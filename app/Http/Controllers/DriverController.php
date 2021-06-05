<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:03
 */

namespace App\Http\Controllers;




use App\Http\Business\DriverBL;
use App\Http\Business\VehicleBL;
use App\Http\Entities\DriverBusinessEntity;
use Redirect;
use Schema;;
use Illuminate\Http\Request;
use App\Http\Entities\ApplicationMessage;
use App\Http\Entities\CustomizerViewBusinessEntity;
use Illuminate\Support\Facades\DB;


class DriverController extends Controller {


    public function index(Request $request)
    {
        $driverBL= new DriverBL();
        $driverBE= $driverBL->all();
        return view('driver.index')->with(compact('driverBE'));

    }

    public function showDriver($action, $driverId){

        $data=new CustomizerViewBusinessEntity();
        $driver=array();
        $data->setDisabled('');
        $data->setViewAction($action);
        $vehicleBL=new VehicleBL();
        $vehicleList = $vehicleBL->all();
        if( $action == "show"){//Informacion del conductor

        }else{
            if( $action =="edit"){//NUEVO conductor
                $data->setDisabled('disabled');
                $data->setMode('edit');
                $driverBL=new DriverBL();
                $driver = $driverBL->getDriver($driverId);
            }
            if($action=="create"){
                $data->setMode('create');
                $driver = array(
                    'driverId' => '0',
                    'name' => '',
                    'lastName'=> '',
                    'phone'=> '',
                    'vehicleId'=>'',
                    'address'=> '',
                    'identification'=>''
                );
            }
        }

        return view('driver.driver')->with(
            array(
                'driver'=>$driver,
                'data'=>$data->toArrayBase(),
                'vehicleList'=>$vehicleList

            ));
    }

    public function sendDataDriver($action,$driverId,Request $request)
    {
        //echo $action;
        //die();
        try {
            $driverBEntity = new DriverBusinessEntity();
            //Guardar información de request en entidad

            $driverBEntity->setAllFromDataRowHTTPBase($request->all());
            //Validar Operación

            $driverBL=new DriverBL();
            if ($action == "create") {
                $driverBL->createDriver($driverBEntity);

            }
            if ($action == "edit") {
                $driverBL->updateDriver($driverBEntity,$driverId);

            }

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
        return response()->json(ApplicationMessage::toArray());

    }

    public function delete($driverId){
        try{
            $driverBL=new DriverBL();
            $driverBL->deleteDriver($driverId);

        }catch (Exception $e){

        }
        return redirect()->action('DriverController@index');
    }
}
