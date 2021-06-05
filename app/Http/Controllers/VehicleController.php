<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:03
 */

namespace App\Http\Controllers;




use App\Http\Model\Vehicle;
use Redirect;
use Schema;
use App\Http\Business\VehicleBL;
use App\Http\Business\PhoneBL;
use App\Http\Business\CustomerBL;
use Illuminate\Http\Request;
use App\Http\Entities\ApplicationMessage;
use App\Http\Entities\CustomizerViewBusinessEntity;
use App\Http\Entities\VehicleBusinessEntity;
use App\Http\Entities\PhoneBusinessEntity;


class VehicleController extends Controller {


    public function index(Request $request)
    {
        $vehicleBL= new VehicleBL();
        $vehicleBE= $vehicleBL->allActives();
        $customerBL=new customerBL();
        $customerList = $customerBL->all();
        return view('vehicle.vehicleManagement')->with(compact('vehicleBE','customerList'));

    }

    public function showHistory(Request $request)
    {
        $vehicleBL= new VehicleBL();
        $vehicleBE= $vehicleBL->history();
        $customerBL=new customerBL();
        $customerList = $customerBL->all();
        return view('vehicle.history')->with(compact('vehicleBE','customerList'));

    }
    public function showVehicle($action, $vehicleId){

        $data=new CustomizerViewBusinessEntity();
        $vehicleList=array();
        $data->setDisabled('');
        $data->setViewAction($action);
        $customerBL=new customerBL();
        $customerList = $customerBL->all();
        $vehicleBL=new VehicleBL();
        if( $action == "show"){//Informacion de pedido

        }else{
            if( $action =="edit"){//NUEVO Pedido
                $data->setDisabled('disabled');
                $data->setMode('edit');
                $vehicleList = $vehicleBL->getVehicle($vehicleId);

            }
            if($action=="create"){
                $vehicleShortNumber=$vehicleBL->getLastShortNumberVehicle();
                $vehicleShortNumber=(int)$vehicleShortNumber+1;
                $data->setMode('create');
                $vehicleList = array(
                    'vehicleId'=> '0',
                    'placa'=> '',
                    'sn'=> '',
                    'shortNumber'=> sprintf("%04d",$vehicleShortNumber),
                    'motorNumber'=> '',
                    'year'=> '',
                    'brandCar'=> '',
                    'modelClass'=> '',
                    'chasisSerie'=> '',
                    'registerDate'=> '',
                    'comment'=> '',
                    'classCar'=> '',
                    'internalNumber'=> '',
                    'status'=> 1,
                    'telMov'=> '',
                    'telCla'=> '',
                    'telEmergency'=> '',
                    'createdBy'=> '',
                    'createdDate'=> '',
                    'modifiedBy'=> '',
                    'modifiedDate'=> '',
                    'sim'=> '',
                    'gpsId'=> '',
                    'mg'=> '',
                    'mandated'=> '',
                    'personTelEmergency'=> '',
                    'brandDevice'=> '',
                    'notInformationCel'=> '',
                    'notInformationName'=> '',
                    'parkingplace'=> '',
                    'customerId'=> ''
                );
            }
        }
        
        return view('vehicle.vehicle')->with(
            array(
                'vehicleList'=>$vehicleList,
                'data'=>$data->toArrayBase(),
                'customerList'=>$customerList
            ));
    }




    public function getVehicle($vehicleId){

        try{
            $vehicleBL=new VehicleBL();
            $data = $vehicleBL->getVehicle($vehicleId);
            return response()->json($data);
        }catch(Exception $e){
            ApplicationMessage::setErrorMessageDetail($e->getMessage());

        }


    }
    public function sendDataVehicle($action,Request $request)
    {
        try {
            //Guardar información de request en entidad

            $request = $request->all();
            $vehicleBEntity = new VehicleBusinessEntity();
            $vehicleBEntity->setAllFromDataRowHTTPBase($request['formData']);

            // 1st Create or Update the Vehicle

            $vehicleBL=new VehicleBL();

            if ($action == "create") {
                $vehicleId = $vehicleBL->createVehicle($vehicleBEntity);
                $vehicleBEntity -> setVehicleId($vehicleId);
                ApplicationMessage::setMessageDetail("Vehiculo Creado Correctamente");
            } else {
                //Actualizar información de Cliente
                $vehicleBL->updateVehicle($vehicleBEntity);
                ApplicationMessage::setMessageDetail("Vehiculo Actualizado Correctamente");
            }

            // 2nd Create or update the phones
            $PhoneBL = new PhoneBL();
            $PhoneBEntity = new PhoneBusinessEntity();

            if( isset($request['emergencyContacts']) ){
                $emergencyContacts = $request['emergencyContacts'];

                foreach ($emergencyContacts as $emergencyContact) {
                    $PhoneBEntity -> setAllFromDataRowHTTP($emergencyContact);
                    $PhoneBEntity -> setVehicleId($vehicleBEntity -> getVehicleId());

                    if($PhoneBEntity -> getPhoneId() == -1){
                        $PhoneBL -> createPhone($PhoneBEntity);
                    } else {
                        $PhoneBL -> updatePhone($PhoneBEntity);
                    }
                }
            }

            
            if(isset( $request['phonesDeleted'])){
                $phonesDeleted = $request['phonesDeleted'];

                foreach ($phonesDeleted as $phoneDeletedId) {
                    $PhoneBL -> deletePhone($phoneDeletedId);
                }
            }



        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
        return response()->json(ApplicationMessage::toArray());

    }

    public function deleteVehicle($vehicleId){
        try{
            $vehicleBL=new VehicleBL();
            $vehicleBL->deleteVehicle($vehicleId);

        }catch (Exception $e){

        }
        return redirect()->action('VehicleController@index');
    }
    public function getVehiclesOfCustomer($customerId){
        $data=array();
        try{
            $vehicleBL=new VehicleBL();
            $data=$vehicleBL->getVehiclesOfCustomer($customerId);

        }catch (Exception $e){

        }
        return response()->json($data);
    }
    public function showContact($vehicleId){
        $data=array();
        try{
            $vehicleBL=new VehicleBL();
            $data=$vehicleBL->getInformationOfContact($vehicleId);

            return response()->json($data);

        }catch (Exception $e){

        }
    }

    public function getEmergencyContacts($vehicleId)
    {
        try {
            $PhoneBL = new PhoneBL();
            $phones = $PhoneBL -> getPhonesByVehicleId($vehicleId);
            return $phones;

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
        }
        return response()->json(ApplicationMessage::toArray());
        
    }
}
