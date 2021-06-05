<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Entities\ApplicationMessage;
use App\Http\Entities\CustomizerViewBusinessEntity;
use App\Http\Entities\UsersBusinessEntity;
use App\Http\Business\UsersBL;
use App\Http\Model\Vehicle;
use Redirect;
use Schema;
 
use App\Http\Business\PhoneBL;
use App\Http\Business\CustomerBL;
use App\Http\Entities\VehicleOutdatedBusinessEntity;
use App\Http\Business\TypeCommandSmsBL;
use App\Http\Entities\PhoneBusinessEntity;
use App\Http\Business\SmsSendBL;


class SmsSendController extends Controller
{
    /**
     * Show a list of users
     * @return \Illuminate\View\View
     */
    public function __construct()
    {

        $this->middleware('auth', ['except => getLogout']);
    }
    public function index(Request $request)
    {
        $smsSendBL= new SmsSendBL();
        $vehicleOutdatedBE= $smsSendBL->all();
        $typeCommandSmsList=$smsSendBL->allTypeCommandSMS();
        return view('sendSMS.sendSMSManagement')->with(compact('vehicleOutdatedBE','typeCommandSmsList'));

    }
    public function typeSMS(Request $request)
    {
        $smsSendBL= new TypeCommandSmsBL();        
        $typeCommandSmsList=$smsSendBL->all();
        return view('sendSMS.typeCommandSMSManagement')->with(compact('typeCommandSmsList'));

    }
    public function typeSMSCreateEdit($action,$typeCommandSmsId)
    {
        $typeCommandSmsBL= new TypeCommandSmsBL();        
        //$typeCommandSmsList=$smsSendBL->allTypeCommandSMS();
        $data=new CustomizerViewBusinessEntity();
        //$vehicleOutdated=array();
        $data->setDisabled('');
        $data->setViewAction($action);        
        //$smsSendBL=new SmsSendBL();
        //$typeCommandSmsList= $smsSendBL->allTypeCommandSMS();
        if( $action == "show"){//Informacion de pedido

        }else{
             
            if( $action =="edit"){//NUEVO Pedido
                $data->setDisabled('disabled');
                $data->setMode('edit');
                $typeCommandSMS = $typeCommandSmsBL->getTypeCommandSms($typeCommandSmsId);
                 
            }
            if($action=="create"){                
                $data->setMode('create');
                $typeCommandSMS = array(
                    'typeCommandSmsId'=> '0',
                    'type'=> '',                 
                    'status'=> ''
                );
                 
            }
        }
        return view('sendSMS.typeCommandSMS')->with(
            array(
                 
                'typeCommandSMS'=>$typeCommandSMS,
                'data'=>$data->toArrayBase() 
                 
            ));
    }
    public function sendCommandSms()
    {
      try {
            //Guardar información de request en entidad

            

            // 1st Create or Update the Vehicle

            $smsSendBL=new SmsSendBL();
            $result=$smsSendBL->sendCommandSMS();
            
            ApplicationMessage::setMessageDetail();            

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
        return response()->json(ApplicationMessage::toArray());
  
    }
    public function getCommandSms(){
        try {
            $PhoneBL = new PhoneBL();
            $phones = $PhoneBL -> getPhonesByVehicleId($vehicleId);
            return $phones;

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
        }
        return response()->json(ApplicationMessage::toArray());
    }
    public function sendDataVehicle($action,Request $request)
    {
        try {
            //Guardar información de request en entidad

            $request = $request->all();
            $vehicleOutdatedBEntity = new VehicleOutdatedBusinessEntity();
            $vehicleOutdatedBEntity->setAllFromDataRowHTTPBase($request['formData']);

            // 1st Create or Update the Vehicle

            $smsSendBL=new SmsSendBL();

            if ($action == "create") {
                $vehicleId = $smsSendBL->createVehicle($vehicleOutdatedBEntity);
                $vehicleOutdatedBEntity -> setVehicleId($vehicleId);
                ApplicationMessage::setMessageDetail("Vehiculo Creado Correctamente");
            } else {
                //Actualizar información de Cliente
                $smsSendBL->updateVehicle($vehicleOutdatedBEntity);
                ApplicationMessage::setMessageDetail("Vehiculo Actualizado Correctamente");
            }

           


        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
        return response()->json(ApplicationMessage::toArray());

    }
  

     public function showVehicle($action, $vehicleId){

        $data=new CustomizerViewBusinessEntity();
        $vehicleOutdated=array();
        $data->setDisabled('');
        $data->setViewAction($action);        
        $smsSendBL=new SmsSendBL();
        $typeCommandSmsList= $smsSendBL->allTypeCommandSMS();
        if( $action == "show"){//Informacion de pedido

        }else{
            if( $action =="edit"){//NUEVO Pedido
                $data->setDisabled('disabled');
                $data->setMode('edit');
                $vehicleOutdated = $smsSendBL->getVehicleOutdated($vehicleId);

                 
            }
            if($action=="create"){                
                $data->setMode('create');
                $vehicleOutdated = array(
                    'vehicleId'=> '0',
                    'placa'=> '',                 
                    'phone'=> '', 
                    'typeCommandSmsId'=> ''
                );
            }
        }
        
        return view('sendSMS.sendSMS')->with(
            array(
                'vehicleList'=>$vehicleOutdated,
                'typeCommandSmsList'=>$typeCommandSmsList,
                'data'=>$data->toArrayBase(),                
            ));
    }

    public function deleteVehicle($vehicleId){
        try{
            $smsSendBL=new SmsSendBL();
            $smsSendBL->deleteVehicle($vehicleId);

        }catch (Exception $e){

        }
        return redirect()->action('SmsSendController@index');
    }

}