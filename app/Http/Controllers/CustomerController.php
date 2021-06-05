<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:03
 */

namespace App\Http\Controllers;




use App\Http\Model\Customer;
use Redirect;
use Schema;;
use App\Http\Business\CustomerBL;
use Illuminate\Http\Request;
use App\Http\Entities\ApplicationMessage;
use App\Http\Entities\CustomizerViewBusinessEntity;
use App\Http\Entities\CustomerBusinessEntity;


class CustomerController extends Controller {


    public function index(Request $request)
    {
        $customerBL= new CustomerBL();
        $customerBE= $customerBL->all();
        return view('customer.customerManagement')->with(compact('customerBE'));

    }





    public function destroy($id)
    {
        Customer1::destroy($id);

        return redirect()->route(config('quickadmin.route').'.customer1.index');
    }


    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Customer1::destroy($toDelete);
        } else {
            Customer1::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.customer1.index');
    }
    public function showCustomer($action, $customerId){

        $data=new CustomizerViewBusinessEntity();
        $customerList=array();
        $data->setDisabled('');
        $data->setViewAction($action);
        if( $action == "show"){//Informacion de pedido

        }else{
            if( $action =="edit"){//NUEVO Pedido
                $data->setDisabled('disabled');
                $data->setMode('edit');
                $customerBL=new CustomerBL();
                $customerList = $customerBL->getCustomer($customerId);
            }
            if($action=="create"){
                $data->setMode('create');
                $customerList = array(
                    'customerId' => '0',
                    'name' => '',
                    'identification' => '',
                    'email'=> '',
                    'lastName'=> '',
                    'maritalStatus'=> '',
                    'phone1'=> '',
                    'phone2'=>'',
                    'type'=>'',
                    'city'=>'',
                    'birthday'=>'',
                    'address'=> ''
                );
            }
        }

        return view('customer.customer')->with(
            array(
                'customerList'=>$customerList,
                'data'=>$data->toArrayBase(),
                'action'=>$action
            ));
    }


    public function getFilterCustomerPerMonth($year){
        try{
            //Llamar a método de Modelo
            $customers = Customer::getCustomers();
            $months = array_fill(0,12,0);

            foreach ($customers as $customer) {
                if($year == (int)date("Y", strtotime($customer -> createdDate))){
                    $months[((int)date("m", strtotime($customer -> createdDate))) - 1] ++;
                }
            }


            return $months;
        }catch(Exception $e){
            // ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
    }

    public function getCustomer($customerId){

        try{
            $customerBL=new CustomerBL();
            $data = $customerBL->getCustomer($customerId);
            return response()->json($data);
        }catch(Exception $e){
            ApplicationMessage::setErrorMessageDetail($e->getMessage());

        }

    }
    public function showVehicles($customerId){

        try{
            $customerBL=new CustomerBL();
            $data = $customerBL->showVehicles($customerId);
            return response()->json($data);
        }catch(Exception $e){
            ApplicationMessage::setErrorMessageDetail($e->getMessage());

        }

    }
    public function getFilterAllCustomer(){

        try{
            $customerBL=new CustomerBL();
            $data = $customerBL->all();
            return response()->json($data);
        }catch(Exception $e){
            ApplicationMessage::setErrorMessageDetail($e->getMessage());

        }

    }
    public function sendDataCustomer($action,Request $request)
    {
        //echo $action;
        //die();
        $id=0;
        try {
            $customerBEntity = new CustomerBusinessEntity();
            //Guardar información de request en entidad

            $customerBEntity->setAllFromDataRowHTTPBase($request->all());
            //Validar Operación

            $CustomerBL=new CustomerBL();
            if ($action == "create") {
                $id=$CustomerBL->createCustomer($customerBEntity);

                ApplicationMessage::setMessageDetail("Cliente Creado Correctamente");
            } else {
                //A
                //ctualizar información de Cliente


                $CustomerBL->updateCustomer($customerBEntity);
                ApplicationMessage::setMessageDetail("Cliente Actualizado Correctamente");
            }

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
        return response()->json($id);

    }

    public function deleteCustomer($customerId){

        try{

            $customerBL=new CustomerBL();
            $customerBL->deleteCustomer($customerId);
            ApplicationMessage::setMessageDetail("Cliente Eliminado Correctamente");
        }catch (Exception $e){
            ApplicationMessage::setErrorMessageDetail("No es posible Eliminar el Cliente");

        }
        //return redirect()->action('CustomerController@index');


        return response()->json(ApplicationMessage::toArray());
    }

    public function crud(){
        return view('emails.CRUDManagerEmail');
    }
}
